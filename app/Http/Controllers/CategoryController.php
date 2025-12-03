<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::ordered()->paginate(15);
        return view('dashboard.admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:categories,code',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $category = Category::create($validated);

        // Log category creation
        ActivityLog::logActivity(
            'category_created',
            "Admin membuat kategori baru: {$category->name} ({$category->code})",
            $category
        );

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:categories,code,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $oldData = $category->toArray();
        $category->update($validated);

        // Log category update
        ActivityLog::logActivity(
            'category_updated',
            "Admin memperbarui kategori: {$category->name} ({$category->code})",
            $category
        );

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $categoryCode = $category->code;
        
        // Log category deletion before delete
        ActivityLog::logActivity(
            'category_deleted',
            "Admin menghapus kategori: {$categoryName} ({$categoryCode})",
            $category,
            ['deleted_category_id' => $category->id]
        );

        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

