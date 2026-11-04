<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::with(['mahasiswa', 'matakuliah'])
            ->latest('tanggal_absensi')
            ->get();

        return view('absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::orderBy('name')->get();
        $matakuliah = Matakuliah::orderBy('nama_matakuliah')->get();

        return view('absensi.create', compact('mahasiswa', 'matakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'tanggal_absensi' => 'required|date',

            'absensi' => 'required|array',
            'absensi.*.mahasiswa_id' => 'required|exists:mahasiswas,id',
            'absensi.*.status_absen' => 'required|in:H,I,S,A',
        ]);

        // Cegah absensi ganda pada tanggal dan mata kuliah yang sama
        $sudahAda = Absensi::where('matakuliah_id', $validated['matakuliah_id'])
            ->where('tanggal_absensi', $validated['tanggal_absensi'])
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->with('error', 'Absensi untuk mata kuliah dan tanggal tersebut sudah tersedia.');
        }

        DB::transaction(function () use ($validated) {
            foreach ($validated['absensi'] as $item) {
                Absensi::create([
                    'mahasiswa_id' => $item['mahasiswa_id'],
                    'matakuliah_id' => $validated['matakuliah_id'],
                    'tanggal_absensi' => $validated['tanggal_absensi'],
                    'status_absen' => $item['status_absen'],
                ]);
            }
        });

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
