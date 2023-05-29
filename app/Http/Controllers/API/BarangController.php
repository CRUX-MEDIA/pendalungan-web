<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function dataBarang() {
        $barang = Barang::join('kategori', 'kategori.id_kategori', '=', 'barang.id_kategori')
                        ->orderBy('id_barang', 'desc')
                        ->get();
        $no = 0;
        $data = array();
        foreach ($barang as $list) {
            $no++;
            $row = array();
            $row['no'] = $no;
            $row['nama_barang'] = $list->nama_barang;
            $row['kategori'] = $list->nama_kategori;
            $row['spesifikasi'] = $list->spek_barang;
            $row['harga_sewa_rp'] = "Rp. ". format_uang($list->harga_sewa);
            $row['harga_sewa'] = $list->harga_sewa;
            $data[] = $row;
        }
        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil',
            'data' => $data
        ], 200);
    }
}
