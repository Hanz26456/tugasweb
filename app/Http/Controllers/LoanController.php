<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman
     */
    public function index()
    {
        $loans = Loan::with('member', 'book')->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Menampilkan form tambah peminjaman
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();
        return view('loans.create', compact('members', 'books'));
    }

    /**
     * Menyimpan peminjaman baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        // Simpan data peminjaman
        Loan::create([
            'member_id' => $validated['member_id'],
            'book_id' => $validated['book_id'],
            'borrow_date' => $validated['borrow_date'],
            'due_date' => $validated['due_date'],
            'returned' => false,
            'fine' => 0,
        ]);

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit peminjaman
     */
    /**
 * Menampilkan form edit peminjaman
 */
public function edit(Loan $loan)
{
    $members = Member::all();
    $books = Book::all();
    return view('loans.edit', compact('loan', 'members', 'books'));
}

/**
 * Memperbarui data peminjaman
 */
public function update(Request $request, Loan $loan)
{
    $validated = $request->validate([
        'return_date' => 'nullable|date|after_or_equal:borrow_date',
    ]);

    // Hitung denda jika pengembalian terlambat
    $fine = 0;
    if (!empty($validated['return_date']) && \Carbon\Carbon::parse($validated['return_date'])->gt($loan->due_date)) {
        $daysLate = \Carbon\Carbon::parse($validated['return_date'])->diffInDays($loan->due_date);
        $fine = $daysLate * 1000; // Rp 1000 per hari keterlambatan
    }

    // Update peminjaman
    $loan->update([
        'return_date' => $validated['return_date'],
        'fine' => $fine,
        'returned' => !empty($validated['return_date']),
    ]);

    return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil diperbarui');
}


    /**
     * Menghapus peminjaman
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
