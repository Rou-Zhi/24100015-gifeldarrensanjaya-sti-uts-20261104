
@extends('layouts.app')

@section('title', 'Data Mata Kuliah')
@section('heading', 'Data Mata Kuliah')

@section('content')

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <x-fas-circle-check class="me-2" />
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Data Mata Kuliah -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <x-fas-book-open class="me-2 text-success" />
                Daftar Mata Kuliah
            </h5>

            <a href="{{ route('matakuliah.create') }}" class="btn btn-success">
                <x-fas-plus />
                Tambah Mata Kuliah
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kode</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($matakuliah as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $item->kode }}
                                    </span>
                                </td>
                                <td>{{ $item->nama_matakuliah }}</td>

                                <td class="text-center">
                                    <a href="{{ route('matakuliah.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit">
                                        <x-fas-pen />
                                    </a>

                                    <form action="{{ route('matakuliah.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                            <x-fas-trash />
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <x-fas-folder-open class="fs-2 mb-3 d-block" />
                                    Belum ada data mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

@endsection