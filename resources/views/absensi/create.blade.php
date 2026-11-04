
@extends('layouts.app')

@section('title', 'Input Absensi')
@section('heading', 'Input Absensi')

@section('content')

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali input berikut:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-semibold">
            <x-fas-calendar-check class="text-success me-2" />
            Form Absensi Mahasiswa
        </h5>
    </div>

    <div class="card-body p-4">

        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf

            <!-- Informasi Absensi -->
            <div class="row mb-4">

                <div class="col-md-6 mb-3">
                    <label for="tanggal_absensi" class="form-label fw-semibold">
                        Tanggal Absensi
                    </label>

                    <input
                        type="date"
                        name="tanggal_absensi"
                        id="tanggal_absensi"
                        class="form-control @error('tanggal_absensi') is-invalid @enderror"
                        value="{{ old('tanggal_absensi', date('Y-m-d')) }}"
                        required
                    >

                    @error('tanggal_absensi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="matakuliah_id" class="form-label fw-semibold">
                        Mata Kuliah
                    </label>

                    <select
                        name="matakuliah_id"
                        id="matakuliah_id"
                        class="form-select @error('matakuliah_id') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Mata Kuliah --</option>

                        @foreach ($matakuliah as $mk)
                            <option
                                value="{{ $mk->id }}"
                                {{ old('matakuliah_id') == $mk->id ? 'selected' : '' }}
                            >
                                {{ $mk->kode }} - {{ $mk->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>

                    @error('matakuliah_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr>

            <!-- Daftar Mahasiswa -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">
                    <x-fas-users class="text-success me-2" />
                    Daftar Mahasiswa
                </h6>

                <span class="badge bg-success">
                    {{ $mahasiswa->count() }} Mahasiswa
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th width="180">Status Kehadiran</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $mhs->NIM }}</td>

                                <td>{{ $mhs->name }}</td>

                                <td>
                                    <input
                                        type="hidden"
                                        name="absensi[{{ $index }}][mahasiswa_id]"
                                        value="{{ $mhs->id }}"
                                    >

                                    <select
                                        name="absensi[{{ $index }}][status_absen]"
                                        class="form-select form-select-sm"
                                        required
                                    >
                                        <option value="H"
                                            {{ old("absensi.$index.status_absen", 'H') == 'H' ? 'selected' : '' }}>
                                            Hadir
                                        </option>

                                        <option value="I"
                                            {{ old("absensi.$index.status_absen") == 'I' ? 'selected' : '' }}>
                                            Izin
                                        </option>

                                        <option value="S"
                                            {{ old("absensi.$index.status_absen") == 'S' ? 'selected' : '' }}>
                                            Sakit
                                        </option>

                                        <option value="A"
                                            {{ old("absensi.$index.status_absen") == 'A' ? 'selected' : '' }}>
                                            Alpa
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('absensi.index') }}"
                   class="btn btn-light border">
                    <x-fas-arrow-left class="me-1" />
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-success"
                    {{ $mahasiswa->isEmpty() ? 'disabled' : '' }}
                >
                    <x-fas-floppy-disk class="me-1" />
                    Simpan Absensi
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
