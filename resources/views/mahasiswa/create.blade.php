@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')
@section('heading', 'Tambah Mahasiswa')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                <x-fas-user-plus class="me-2 text-success" />
                Formulir Mahasiswa
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="NIM" class="form-label">NIM</label>
                    <input type="text" name="NIM" id="NIM"
                        class="form-control @error('NIM') is-invalid @enderror"
                        value="{{ old('NIM') }}" placeholder="Masukkan NIM">

                    @error('NIM')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Masukkan nama mahasiswa">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select name="jurusan" id="jurusan"
                        class="form-select @error('jurusan') is-invalid @enderror">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="Bisnis Digital" @selected(old('jurusan') == 'Bisnis Digital')>
                            Bisnis Digital
                        </option>
                        <option value="Sistem dan Teknologi Informasi"
                            @selected(old('jurusan') == 'Sistem dan Teknologi Informasi')>
                            Sistem dan Teknologi Informasi
                        </option>
                        <option value="Kewirausahaan" @selected(old('jurusan') == 'Kewirausahaan')>
                            Kewirausahaan
                        </option>
                    </select>

                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-success">
                        <x-fas-floppy-disk class="me-1" />
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection