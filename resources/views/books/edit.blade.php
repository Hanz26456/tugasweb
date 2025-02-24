@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h3>Edit Buku</h3>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
