<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailSewa;
use App\Models\Penyewaan;
use App\Models\RiwayatPenyewaan;
use App\Models\DetailRiwayatPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenyewaanController extends Controller
{
    public function Penyewaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_status_sewa' => 'required|numeric',
            'id_penyewa' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $event = Penyewaan::select('penyewaan.no_invoice', 'penyewaan.tgl_sewa', 'penyewaan.tgl_kembali', 'penyewaan.durasi', 'penyewaan.total', 'penyewaan.id_status_sewa')
            ->where('penyewaan.id_status_sewa', $request->id_status_sewa)
            ->where('penyewaan.id_penyewa', $request->id_penyewa)
            ->get();

        if ($event) {
            $hasil = [];
            foreach ($event as $e) {
                $hasil[] = [
                    'no_invoice' => $e->no_invoice,
                    'tgl_sewa' => $e->tgl_sewa,
                    'tgl_kembali' => $e->tgl_kembali,
                    'durasi' => $e->durasi,
                    'total' => $e->total,
                    'id_status_sewa' => $e->id_status_sewa,
                    'barang' => DetailSewa::join('barang', 'detail_sewa.id_barang', '=', 'barang.id_barang')
                        ->join('penyewaan', 'detail_sewa.id_sewa', '=', 'penyewaan.id_sewa')
                        ->select('barang.nama_barang', 'barang.serial_number', 'detail_sewa.subtotal')
                        ->where('penyewaan.no_invoice', $e->no_invoice)
                        ->where('penyewaan.id_status_sewa', $request->id_status_sewa)
                        ->where('penyewaan.id_penyewa', $request->id_penyewa)
                        ->get()
                ];
            }
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data Penyewaan',
                'data' => $hasil
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data Penyewaan',
                'data' => ''
            ], 500);
        }
    }

    public function riwayatPenyewaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_status_sewa' => 'required|numeric',
            'id_penyewa' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $event = RiwayatPenyewaan::select('no_invoice', 'tgl_sewa', 'tgl_kembali', 'durasi', 'total', 'id_status_sewa')
            ->where('id_status_sewa', $request->id_status_sewa)
            ->where('id_penyewa', $request->id_penyewa)
            ->get();

        if ($event) {
            $hasil = [];
            foreach ($event as $e) {
                $hasil[] = [
                    'no_invoice' => $e->no_invoice,
                    'tgl_sewa' => $e->tgl_sewa,
                    'tgl_kembali' => $e->tgl_kembali,
                    'durasi' => $e->durasi,
                    'total' => $e->total,
                    'id_status_sewa' => $e->id_status_sewa,
                    'barang' => DetailRiwayatPenyewaan::join('barang', 'detail_riwayat_penyewaan.id_barang', '=', 'barang.id_barang')
                        ->join('riwayat_penyewaan', 'detail_riwayat_penyewaan.id_riwayat_penyewaan', '=', 'riwayat_penyewaan.id_riwayat_penyewaan')
                        ->select('barang.nama_barang', 'barang.serial_number', 'detail_riwayat_penyewaan.subtotal')
                        ->where('riwayat_penyewaan.no_invoice', $e->no_invoice)
                        ->where('riwayat_penyewaan.id_status_sewa', $request->id_status_sewa)
                        ->where('riwayat_penyewaan.id_penyewa', $request->id_penyewa)
                        ->get()
                ];
            }
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data Riwayat Penyewaan',
                'data' => $hasil
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data Riwayat Penyewaan',
                'data' => ''
            ], 500);
        }
    }

    public function detailRiwayatPenyewaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_invoice' => 'required',
            'id_status_sewa' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        if ($request->id_status_sewa == 1 || $request->id_status_sewa == 2) {
            $event = Penyewaan::select('penyewaan.no_invoice', 'penyewaan.tgl_sewa', 'penyewaan.tgl_kembali', 'penyewaan.durasi', 'penyewaan.total', 'penyewaan.id_status_sewa')
                ->where('penyewaan.id_status_sewa', $request->id_status_sewa)
                ->where('penyewaan.id_penyewa', $request->id_penyewa)
                ->get();

            if ($event) {
                $hasil = [];
                foreach ($event as $e) {
                    $hasil[] = [
                        'no_invoice' => $e->no_invoice,
                        'tgl_sewa' => $e->tgl_sewa,
                        'tgl_kembali' => $e->tgl_kembali,
                        'durasi' => $e->durasi,
                        'total' => $e->total,
                        'id_status_sewa' => $e->id_status_sewa,
                        'barang' => DetailSewa::join('barang', 'detail_sewa.id_barang', '=', 'barang.id_barang')
                            ->join('penyewaan', 'detail_sewa.id_sewa', '=', 'penyewaan.id_sewa')
                            ->select('barang.nama_barang', 'barang.serial_number', 'detail_sewa.subtotal')
                            ->where('penyewaan.no_invoice', $e->no_invoice)
                            ->where('penyewaan.id_status_sewa', $request->id_status_sewa)
                            ->where('penyewaan.id_penyewa', $request->id_penyewa)
                            ->get()
                    ];
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mendapatkan data Detail Penyewaan',
                    'data' => $hasil
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mendapatkan data Detail Penyewaan',
                    'data' => ''
                ], 500);
            }
        } else if ($request->id_status_sewa == 3 || $request->id_status_sewa == 4) {
            $event = RiwayatPenyewaan::select('no_invoice', 'tgl_sewa', 'tgl_kembali', 'durasi', 'total', 'id_status_sewa')
                ->where('id_status_sewa', $request->id_status_sewa)
                ->where('id_penyewa', $request->id_penyewa)
                ->get();

            if ($event) {
                $hasil = [];
                foreach ($event as $e) {
                    $hasil[] = [
                        'no_invoice' => $e->no_invoice,
                        'tgl_sewa' => $e->tgl_sewa,
                        'tgl_kembali' => $e->tgl_kembali,
                        'durasi' => $e->durasi,
                        'total' => $e->total,
                        'id_status_sewa' => $e->id_status_sewa,
                        'barang' => DetailRiwayatPenyewaan::join('barang', 'detail_riwayat_penyewaan.id_barang', '=', 'barang.id_barang')
                            ->join('riwayat_penyewaan', 'detail_riwayat_penyewaan.id_riwayat_penyewaan', '=', 'riwayat_penyewaan.id_riwayat_penyewaan')
                            ->select('barang.nama_barang', 'barang.serial_number', 'detail_riwayat_penyewaan.subtotal')
                            ->where('riwayat_penyewaan.no_invoice', $e->no_invoice)
                            ->where('riwayat_penyewaan.id_status_sewa', $request->id_status_sewa)
                            ->where('riwayat_penyewaan.id_penyewa', $request->id_penyewa)
                            ->get()
                    ];
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mendapatkan data Detail Riwayat Penyewaan',
                    'data' => $hasil
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mendapatkan data Detail Riwayat Penyewaan',
                    'data' => ''
                ], 500);
            }
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penyewa' => 'required|numeric',
            'no_invoice' => 'required|string',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date',
            'durasi' => 'required|numeric',
            'total' => 'required|numeric',
            'pajak' => 'required|numeric',
            'id_status_sewa' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $penyewaan = Penyewaan::create([
            'id_penyewa' => $request->id_penyewa,
            'no_invoice' => $request->no_invoice,
            'tgl_sewa' => $request->tgl_sewa,
            'tgl_kembali' => $request->tgl_kembali,
            'durasi' => $request->durasi,
            'total' => $request->total,
            'pajak' => $request->pajak,
            'id_status_sewa' => $request->id_status_sewa,
        ]);

        $hasil = Penyewaan::select('id_sewa', 'id_penyewa', 'no_invoice', 'tgl_sewa', 'tgl_kembali', 'durasi', 'total', 'pajak', 'id_status_sewa')
        ->where('no_invoice', $request->no_invoice)
        ->get();

        if ($penyewaan) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan data penyewaan',
                'data' => $hasil
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data penyewaan',
                'data' => ''
            ], 500);
        }
    }

    public function storedetail(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_sewa' => 'required|numeric',
            'id_barang' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $detail = DetailSewa::create([
            'id_sewa' => $request->id_sewa,
            'id_barang' => $request->id_barang,
            'subtotal' => $request->subtotal
        ]);

        if ($detail) {
            Barang::where('id_barang', $request->id_barang)->update([
                'status' => '0'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan data detail penyewaan',
                'data' => $detail
            ], 200);
            
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data detail penyewaan',
                'data' => ''
            ], 500);
        }
    }
}
