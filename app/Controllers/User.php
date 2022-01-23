<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        if (!session()->get('nama') or session()->get('rule') != 1) {
            return redirect()->to(base_url() . "/dashboard");
        }
        echo view('user');
    }
    public function muatData()
    {
        echo json_encode($this->userModel->where("hapus", NULL)->findAll());
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "password" =>  password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
            "rule" => $this->request->getPost("jabatan")
        ];

        $this->userModel->save($data);

        echo json_encode("");
    }

    public function hapus()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id = $this->request->getPost("id");
        if ($id) {
            $tanggal = date('Y-m-d h:m:s', strtotime('today'));
            $this->userModel->update($id, ["hapus" => $tanggal]);
            echo json_encode("");
        } else {
            echo json_encode("id kosong");
        }
    }
}
