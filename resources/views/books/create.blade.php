@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h3>Tambah Buku</h3>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="publisher" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
