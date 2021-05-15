<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sekolah extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'tb_sekolah';

    public function desa(){
        return $this->belongsTo('App\Desa', 'id_desa');
    }
}
