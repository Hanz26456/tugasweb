@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h3>Daftar Peminjaman</h3>
    <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->member->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->borrow_date }}</td>
                    <td>{{ $loan->due_date }}</td>
                    <td>{{ $loan->return_date ?? '-' }}</td>
                    <td>Rp {{ number_format($loan->fine, 0, ',', '.') }}</td>
                    <td>
                        @if ($loan->returned)
                            <span class="badge bg-success">Dikembalikan</span>
                        @else
                            <span class="badge bg-warning">Dipinjam</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
