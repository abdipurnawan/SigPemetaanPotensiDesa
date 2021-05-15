<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Desa extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'tb_desa';
}
