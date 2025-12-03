<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('dashboard.admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'site_icon_file' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Get all boolean settings first to handle unchecked checkboxes
        $booleanSettings = Setting::where('type', 'boolean')->pluck('key')->toArray();

        // Handle site_icon file upload
        if ($request->hasFile('site_icon_file')) {
            try {
                $file = $request->file('site_icon_file');
                
                // Validate file
                if (!$file->isValid()) {
                    return redirect()->back()
                        ->with('error', 'File icon tidak valid.')
                        ->withInput();
                }
                
                // Ensure settings directory exists
                $settingsDir = storage_path('app/public/settings');
                if (!File::exists($settingsDir)) {
                    File::makeDirectory($settingsDir, 0755, true);
                }
                
                // Generate unique filename
                $extension = $file->getClientOriginalExtension();
                $filename = 'site-icon-' . time() . '.' . $extension;
                
                // Store file in public disk
                $path = $file->storeAs('settings', $filename, 'public');
                
                // Verify file was stored
                if (!$path) {
                    return redirect()->back()
                        ->with('error', 'Gagal menyimpan file icon. Path tidak valid.')
                        ->withInput();
                }
                
                // Double check file exists
                if (!Storage::disk('public')->exists($path)) {
                    return redirect()->back()
                        ->with('error', 'File icon tidak ditemukan setelah disimpan.')
                        ->withInput();
                }
                
                $iconSetting = Setting::where('key', 'site_icon')->first();
                if ($iconSetting) {
                    // Delete old icon if exists
                    if ($iconSetting->value && Storage::disk('public')->exists($iconSetting->value)) {
                        Storage::disk('public')->delete($iconSetting->value);
                    }
                    $iconSetting->update(['value' => $path]);
                } else {
                    Setting::create([
                        'key' => 'site_icon',
                        'value' => $path,
                        'type' => 'file',
                        'group' => 'general',
                        'description' => 'Icon aplikasi (logo/favicon)',
                    ]);
                }
                
                // Clear cache after updating icon
                Cache::forget('settings');
                
            } catch (\Exception $e) {
                Log::error('Error saving site icon: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Terjadi kesalahan saat menyimpan icon: ' . $e->getMessage())
                    ->withInput();
            }
        }

        // Process submitted settings
        foreach ($request->settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Skip file type settings (handled separately)
                if ($setting->type === 'file') {
                    continue;
                }
                
                // Cast value based on type
                if ($setting->type === 'boolean') {
                    $value = isset($request->settings[$key]) && $request->settings[$key] == '1' ? '1' : '0';
                } elseif ($setting->type === 'number') {
                    $value = is_numeric($value) ? $value : 0;
                                                } elseif ($setting->type === 'color') {
                                                    // Validate and normalize hex color
                                                    $value = trim($value);
                                                    if (!str_starts_with($value, '#')) {
                                                        $value = '#' . $value;
                                                    }
                                                    // Convert 3-digit to 6-digit hex if needed
                                                    if (preg_match('/^#([A-Fa-f0-9]{3})$/', $value)) {
                                                        $value = '#' . $value[1] . $value[1] . $value[2] . $value[2] . $value[3] . $value[3];
                                                    }
                                                    // Validate hex color
                                                    $value = preg_match('/^#([A-Fa-f0-9]{6})$/', $value) ? strtoupper($value) : ($setting->value ?: ($setting->key === 'primary_color' ? '#111827' : '#f97316'));
                } else {
                    $value = $value ?? '';
                }
                
                $setting->update(['value' => $value]);
            } else {
                // Create new setting if doesn't exist
                Setting::create([
                    'key' => $key,
                    'value' => $value ?? '',
                    'type' => 'string',
                    'group' => 'general',
                ]);
            }
        }

        // Handle unchecked boolean checkboxes (they won't be in the request)
        foreach ($booleanSettings as $key) {
            if (!isset($request->settings[$key])) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    $setting->update(['value' => '0']);
                }
            }
        }

        // Clear cache
        Cache::forget('settings');

        // Log settings update
        $updatedSettings = array_keys($request->settings);
        ActivityLog::logActivity(
            'settings_updated',
            "Admin memperbarui pengaturan sistem: " . implode(', ', $updatedSettings),
            null,
            ['updated_keys' => $updatedSettings]
        );

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

