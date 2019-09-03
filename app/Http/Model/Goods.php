<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $primaryKey="id";
    protected $table = 'goods';
    public $timestamps = false;
}
