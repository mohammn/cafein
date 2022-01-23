<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\AntrianModel;
use App\Models\MenuModel;
use App\Models\PembelianModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->antrianModel = new AntrianModel();
        $this->menuModel = new MenuModel();
        $this->pembelianModel = new PembelianModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/dashboard");
        }
        return view('laporan');
    }

    public function laporanSemua()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();

        echo json_encode($pembelian);
    }

    public function laporanMenu()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idMenu"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlah"] += $pembelian[$i]["jumlah"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idMenu"],
                    "nama" => $pembelian[$i]["namaMenu"],
                    "jumlah" => $pembelian[$i]["jumlah"],
                    "harga" => $pembelian[$i]["harga"]
                ];
                array_push($dataLaporan, $menu);
            }
        }

        echo json_encode($dataLaporan);
    }

    public function laporanAntrian()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idAntrian"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlahPesan"] += 1;
                    $dataLaporan[$j]["pembayaran"] += $pembelian[$i]["jumlah"] * $pembelian[$i]["harga"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idAntrian"],
                    "nama" => $pembelian[$i]["namaAntrian"],
                    "noMeja" => $pembelian[$i]["noMeja"],
                    "jumlahPesan" => 1,
                    "pembayaran" => $pembelian[$i]["jumlah"] * $pembelian[$i]["harga"]
                ];
                array_push($dataLaporan, $menu);
            }
        }

        echo json_encode($dataLaporan);
    }
}
