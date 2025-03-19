<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua buku dari database
        $books = Book::all();
        
        // Kembalikan respons dengan status 200 dan data buku dalam format JSON
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan request
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'required|numeric',
            'isbn' => 'required|string|unique:books',
            'category_id' => 'required|exists:categories,id', // Pastikan category_id ada di tabel categories
            'location' => 'required|string',
            'quantity' => 'required|numeric',
        ]);
        
        // Membuat buku baru berdasarkan data yang tervalidasi
        $book = Book::create($validated);
        
        // Kembalikan respons dengan status 201 (Created) dan data buku yang baru dibuat
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari buku berdasarkan ID
        $book = Book::find($id);
        
        // Jika buku tidak ditemukan, kembalikan pesan 404
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Jika buku ditemukan, kembalikan data buku dengan status 200
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mencari buku berdasarkan ID
        $book = Book::find($id);
        
        // Jika buku tidak ditemukan, kembalikan pesan 404
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Validasi inputan request
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'required|numeric',
            'isbn' => 'required|string|unique:books,isbn,' . $id,  // Unik kecuali untuk buku ini
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'quantity' => 'required|numeric',
        ]);

        // Memperbarui data buku
        $book->update($validated);

        // Kembalikan respons dengan data buku yang sudah diperbarui
        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari buku berdasarkan ID
        $book = Book::find($id);
        
        // Jika buku tidak ditemukan, kembalikan pesan 404
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Menghapus buku
        $book->delete();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Book deleted'], 200);
    }
}
