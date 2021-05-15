<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JenisPotensi extends Authenticatable
{
    protected $table = 'tb_jenis_potensi';
}
