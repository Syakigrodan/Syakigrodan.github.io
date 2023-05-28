<?php

namespace App\Http\Controllers;

use App\Models\BarangModels;
use Illuminate\Http\Request;

class Barang extends Controller
{
    public function index()
    {
        $barang = BarangModels::all();
        $data = [
            'title' => 'Barang | MyApp',
            'active' => 'Barang',
            'barang' => $barang
        ];
        return view('barang.index', $data);
    }
    public function save(Request $request)
    {
        BarangModels::create($request->except(['_token', 'simpan']));
        return redirect()->to(url('barang'))->with('dataTambah', 'Data Berhasil Di Tambah');
    }
    public function destroy($id)
    {
        $barang = BarangModels::find($id);
        $barang->delete();
        return redirect()->to(url('barang'));
    }
    public function edit($id, Request $request)
    {
        $barang = BarangModels::find($id);
        $barang->update($request->except(['_token', 'simpan']));
        return redirect()->to(url('barang'));
    }
    public function update($id)
    {
        $barang = BarangModels::find($id);
        return view('editBarang', $barang);
    }
}
