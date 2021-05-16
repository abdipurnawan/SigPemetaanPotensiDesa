<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Wisata extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'tb_tempat_wisata';

    public function desa(){
        return $this->belongsTo('App\Desa', 'id_desa');
    }

    public function potensi(){
        return $this->belongsTo('App\JenisPotensi', 'id_potensi');
    }
}
