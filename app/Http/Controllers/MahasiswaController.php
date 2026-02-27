<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\AlamatMahasiswa;
use Illuminate\Http\Request;

class MahasiswaController
{
    // index.php lama → tampilkan semua data
    public function index()
    {
        $mahasiswa = Mahasiswa::with('alamat')->orderByDesc('id')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // create.php lama → tampilkan form tambah
    public function create()
    {
        return view('mahasiswa.create');
    }

    // create.php lama → proses simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nim'      => 'required|unique:mahasiswa,nim',
            'nama'     => 'required',
            'jurusan'  => 'required',
            'alamat'   => 'required',
            'kota'     => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required|max:10',
        ]);

        $mhs = Mahasiswa::create([
            'nim'     => $request->nim,
            'nama'    => $request->nama,
            'jurusan' => $request->jurusan,
        ]);

        AlamatMahasiswa::create([
            'mahasiswa_id' => $mhs->id,
            'alamat'       => $request->alamat,
            'kota'         => $request->kota,
            'provinsi'     => $request->provinsi,
            'kode_pos'     => $request->kode_pos,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // update.php lama → tampilkan form edit
    public function edit($id)
    {
        $mhs = Mahasiswa::with('alamat')->findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // update.php lama → proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim'      => 'required|unique:mahasiswa,nim,' . $id,
            'nama'     => 'required',
            'jurusan'  => 'required',
            'alamat'   => 'required',
            'kota'     => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required|max:10',
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update([
            'nim'     => $request->nim,
            'nama'    => $request->nama,
            'jurusan' => $request->jurusan,
        ]);

        $mhs->alamat->update([
            'alamat'   => $request->alamat,
            'kota'     => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diupdate!');
    }

    // delete.php lama → hapus data
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete(); // alamat otomatis terhapus karena onDelete cascade

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
