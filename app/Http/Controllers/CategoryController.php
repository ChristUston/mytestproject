<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterItem; // karena many-to-many dengan MasterItem
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan daftar kategori dengan filter nama/kode
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->has('kode') && $request->kode != '') {
            $query->where('kode', 'like', '%' . $request->kode . '%');
        }

        $categories = $query->orderBy('id', 'desc')->get();

        return view('auth.categories.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('auth.categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50|unique:categories,kode',
        ]);

        Category::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        return redirect('categories')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('auth.categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50|unique:categories,kode,' . $category->id,
        ]);

        $category->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        return redirect('categories')->with('success', 'Kategori berhasil diupdate');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // optional: detach semua hubungan many-to-many ke MasterItem
        $category->items()->detach();

        $category->delete();

        return redirect('categories')->with('success', 'Kategori berhasil dihapus');
    }

    // Tampilkan detail kategori beserta item terkait
    public function show($id)
    {
        $category = Category::with('items')->findOrFail($id);
        return view('auth.categories.show', compact('category'));
    }
}
