<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianModel extends Model
{

    protected $table = "antrian";
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'noMeja', 'tanggal', 'status', 'idUser'];
}
