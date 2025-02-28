@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - ' . $member->name)

@section('content')
    <h3>Riwayat Peminjaman - {{ $member->name }}</h3>

    <!-- Tombol Unduh PDF ditempatkan di atas tabel -->
    <a href="{{ route('members.history.pdf', ['member' => $member->id]) }}" class="btn btn-primary mb-3">
        Unduh PDF
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->borrow_date }}</td>
                    <td>{{ $loan->return_date ?? 'Belum dikembalikan' }}</td>
                    <td>{{ $loan->returned ? 'Dikembalikan' : 'Dipinjam' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol Kembali ditempatkan di bawah tabel -->
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
