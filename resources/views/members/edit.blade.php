@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')

<form action="{{ route('members.update', $member->id) }}" method="POST">
    @csrf
    @method('PUT')  {{-- ⚠️ WAJIB ADA AGAR UPDATE BERJALAN --}}
    
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $member->address) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Keanggotaan</label>
        <input type="text" name="membership_type" class="form-control" value="{{ old('membership_type', $member->membership_type) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Bergabung</label>
        <input type="date" name="join_date" class="form-control" value="{{ old('join_date', $member->join_date) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="Aktif" {{ old('status', $member->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ old('status', $member->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection