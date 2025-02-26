<?php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class MemberController extends Controller
{
    /**
     * Menampilkan daftar anggota
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Menampilkan form tambah anggota
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Menyimpan data anggota ke database
     */
    public function store(Request $request)
    {
        // ✅ Debugging: Periksa data yang dikirim dari form
        Log::info('Data Masuk:', $request->all());

        // ✅ Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email',
            'membership_type' => 'required|string',
            'join_date' => 'required|date',
            'status' => 'required|string',
        ]);

        // ✅ Simpan ke database
        try {
            Member::create($validated);
            return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan anggota: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail anggota
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Menampilkan form edit anggota
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Memperbarui data anggota
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'membership_type' => 'required|string',
            'join_date' => 'required|date',
            'status' => 'required|string',
        ]);
    
        try {
            // 🔍 Cek sebelum update
            Log::info('Sebelum Update:', $member->toArray());
    
            // 🔍 Cek data yang diterima dari form
            Log::info('Data Diterima:', $validated);
    
            // 🔄 Update data
            $member->update($validated);
    
            // 🔍 Cek setelah update
            Log::info('Setelah Update:', $member->refresh()->toArray());
    
            return redirect()->route('members.index')->with('success', 'Anggota berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui anggota: ' . $e->getMessage());
        }
    }
    

    /**
     * Menghapus data anggota
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();
            return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }
    public function history(Member $member)
    {
        // Ambil data peminjaman berdasarkan member_id
        $loans = $member->loans()->with('book')->get();
    
        return view('members.history', compact('member', 'loans'));
    }
    public function exportPdf(Member $member)
{
    $loans = $member->loans()->with('book')->get();

    $pdf = FacadePdf::loadView('members.history_pdf', compact('member', 'loans'));
    return $pdf->download('riwayat_peminjaman_' . $member->name . '.pdf');
}

}
