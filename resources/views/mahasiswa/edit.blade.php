@extends('mahasiswa.layout')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Edit Data Mahasiswa</h5>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim', $mhs->nim) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $mhs->nama) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $mhs->jurusan) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kota</label>
                    <input type="text" name="kota" class="form-control" value="{{ old('kota', $mhs->alamat->kota ?? '') }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $mhs->alamat->alamat ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $mhs->alamat->provinsi ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $mhs->alamat->kode_pos ?? '') }}" maxlength="10" required>
                </div>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>
@endsection