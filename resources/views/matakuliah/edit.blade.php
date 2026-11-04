
@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')
@section('heading', 'Edit Mata Kuliah')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-semibold">
            <x-fas-pen-to-square class="text-warning me-2" />
            Form Edit Mata Kuliah
        </h5>
    </div>

    <div class="card-body p-4">

        <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kode Mata Kuliah -->
            <div class="mb-3">
                <label for="kode" class="form-label fw-semibold">
                    Kode Mata Kuliah
                </label>

                <input
                    type="text"
                    name="kode"
                    id="kode"
                    class="form-control @error('kode') is-invalid @enderror"
                    value="{{ old('kode', $matakuliah->kode) }}"
                >

                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Nama Mata Kuliah -->
            <div class="mb-4">
                <label for="nama_matakuliah" class="form-label fw-semibold">
                    Nama Mata Kuliah
                </label>

                <input
                    type="text"
                    name="nama_matakuliah"
                    id="nama_matakuliah"
                    class="form-control @error('nama_matakuliah') is-invalid @enderror"
                    value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}"
                >

                @error('nama_matakuliah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('matakuliah.index') }}"
                   class="btn btn-light border">
                    <x-fas-arrow-left class="me-1" />
                    Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    <x-fas-floppy-disk class="me-1" />
                    Perbarui
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
