<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ibadah extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'tb_tempat_ibadah';

    public function desa(){
        return $this->belongsTo('App\Desa', 'id_desa');
    }
}
