<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Module;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('category')
            ->latest()
            ->paginate(15);
        
        return view('dashboard.admin.modules.index', compact('modules'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('dashboard.admin.modules.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'total_questions' => 'nullable|integer|min:0',
            'passing_grade' => 'required|numeric|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_published' => 'boolean',
            'show_ranking' => 'boolean',
            'show_answer_after_submit' => 'boolean',
            'max_attempts' => 'required|integer|min:1',
        ]);

        // Generate code automatically based on category
        $category = Category::findOrFail($validated['category_id']);
        $categoryCode = strtoupper($category->code ?? 'MOD');
        
        // Find the next available number for this category
        $lastModule = Module::where('code', 'like', $categoryCode . '-%')
            ->orderByRaw('CAST(SUBSTRING(code, ' . (strlen($categoryCode) + 2) . ') AS UNSIGNED) DESC')
            ->first();
        
        $nextNumber = 1;
        if ($lastModule) {
            $lastNumber = (int) substr($lastModule->code, strlen($categoryCode) + 1);
            $nextNumber = $lastNumber + 1;
        }
        
        // Generate code and ensure uniqueness
        do {
            $code = $categoryCode . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            $exists = Module::where('code', $code)->exists();
            if ($exists) {
                $nextNumber++;
            }
        } while ($exists);
        
        $validated['code'] = $code;
        
        // Set total_questions to 0 by default
        $validated['total_questions'] = 0;
        $module = Module::create($validated);

        // Log module creation
        ActivityLog::logActivity(
            'module_created',
            "Admin membuat modul baru: {$module->title} ({$module->code})",
            $module,
            ['category_id' => $module->category_id, 'duration' => $module->duration]
        );

        return redirect()->route('admin.modules.index')
            ->with('success', 'Modul berhasil dibuat.');
    }

    public function show(Module $module)
    {
        $module->load(['category', 'questions.options', 'rankings.user']);
        return view('dashboard.admin.modules.show', compact('module'));
    }

    public function edit(Module $module)
    {
        $categories = Category::active()->ordered()->get();
        return view('dashboard.admin.modules.edit', compact('module', 'categories'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:modules,code,' . $module->id,
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'total_questions' => 'nullable|integer|min:0',
            'passing_grade' => 'required|numeric|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_published' => 'boolean',
            'show_ranking' => 'boolean',
            'show_answer_after_submit' => 'boolean',
            'max_attempts' => 'required|integer|min:1',
        ]);

        // Don't update total_questions manually - it's auto-calculated from questions count
        unset($validated['total_questions']);
        $oldData = $module->toArray();
        $module->update($validated);

        // Log module update
        $changes = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value) {
                $changes[$key] = ['old' => $oldData[$key], 'new' => $value];
            }
        }

        ActivityLog::logActivity(
            'module_updated',
            "Admin memperbarui modul: {$module->title} ({$module->code})",
            $module,
            ['changes' => $changes]
        );

        return redirect()->route('admin.modules.index')
            ->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(Module $module)
    {
        $moduleTitle = $module->title;
        $moduleCode = $module->code;
        
        // Log module deletion before delete
        ActivityLog::logActivity(
            'module_deleted',
            "Admin menghapus modul: {$moduleTitle} ({$moduleCode})",
            $module,
            ['deleted_module_id' => $module->id]
        );

        $module->delete();
        return redirect()->route('admin.modules.index')
            ->with('success', 'Modul berhasil dihapus.');
    }
}

