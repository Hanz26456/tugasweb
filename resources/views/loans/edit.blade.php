@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <h3>Edit Peminjaman</h3>

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <select name="member_id" class="form-control" disabled>
                <option value="{{ $loan->member->id }}">{{ $loan->member->name }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <select name="book_id" class="form-control" disabled>
                <option value="{{ $loan->book->id }}">{{ $loan->book->title }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Peminjaman</label>
            <input type="date" name="borrow_date" class="form-control" value="{{ $loan->borrow_date }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" class="form-control" value="{{ $loan->due_date }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pengembalian</label>
            <input type="date" name="return_date" class="form-control" value="{{ $loan->return_date }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Denda</label>
            <input type="text" class="form-control" value="Rp {{ number_format($loan->fine, 0, ',', '.') }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" class="form-control" value="{{ $loan->returned ? 'Dikembalikan' : 'Dipinjam' }}" disabled>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
