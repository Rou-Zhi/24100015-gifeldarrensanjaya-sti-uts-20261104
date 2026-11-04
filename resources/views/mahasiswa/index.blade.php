@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('heading', 'Data Mahasiswa')

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
                <x-fas-users class="me-2 text-success" />
                Daftar Mahasiswa
            </h5>

            <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                <x-fas-plus />
                Tambah Mahasiswa
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jurusan</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mahasiswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $item->NIM }}
                                    </span>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jurusan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('mahasiswa.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning" title="Edit">
                                        <x-fas-pen />
                                    </a>

                                    <form action="{{ route('mahasiswa.destroy', $item->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                            <x-fas-trash />
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <x-fas-folder-open class="fs-2 mb-3 d-block" />
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection