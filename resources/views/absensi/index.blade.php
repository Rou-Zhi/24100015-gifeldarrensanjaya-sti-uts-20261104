@extends('layouts.app')

@section('title', 'Data Absensi')
@section('heading', 'Data Absensi')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <x-fas-circle-check class="me-2" />
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <x-fas-calendar-check class="me-2 text-success" />
                Riwayat Absensi
            </h5>

            <a href="{{ route('absensi.create') }}" class="btn btn-success">
                <x-fas-plus />
                Tambah Absensi
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mata Kuliah</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($absensi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_absensi)->format('d/m/Y') }}</td>
                                <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                                <td>{{ $item->mahasiswa->NIM }}</td>
                                <td>{{ $item->mahasiswa->name }}</td>
                                <td class="text-center">
                                    @php
                                        $status = [
                                            'H' => 'Hadir',
                                            'I' => 'Izin',
                                            'S' => 'Sakit',
                                            'A' => 'Alpa',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $item->status_absen == 'H' ? 'success' : ($item->status_absen == 'A' ? 'danger' : 'warning') }}">
                                        {{ $status[$item->status_absen] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <x-fas-folder-open class="fs-2 mb-3 d-block" />
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection