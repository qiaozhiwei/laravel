<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class music extends Model
{
    protected $primaryKey="id";
    protected $table = 'x-admin_music';
    public $timestamps = false;
}
