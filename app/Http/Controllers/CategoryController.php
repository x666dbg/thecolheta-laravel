<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori dengan subkategori dan produk
        return response()->json(Category::with('children', 'products')->get());
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id', // Memastikan parent_id ada
        ]);

        // Membuat kategori baru
        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        // Menampilkan kategori bersama dengan subkategori dan produk
        return response()->json($category->load('children', 'products'));
    }

    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id', // Memastikan parent_id ada
        ]);

        // Update kategori
        $category->update($validated);
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        // Hapus kategori beserta subkategori dan produk jika perlu
        $category->delete();
        return response()->noContent();
    }
}
