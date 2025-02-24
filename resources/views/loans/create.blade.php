@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <h3>Tambah Peminjaman</h3>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <select name="member_id" class="form-control" required>
                <option value="">Pilih Anggota</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <select name="book_id" class="form-control" required>
                <option value="">Pilih Buku</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Peminjaman</label>
            <input type="date" name="borrow_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
