<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Tambahkan validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        // ✅ Gunakan fill() agar aman dari Mass Assignment
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // ✅ Debugging: Cek data yang masuk
        Log::info('Data Diterima:', $request->all());
    
        // ✅ Validasi Input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // ✅ Update Data
        try {
            $book->update($validated);
            return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
