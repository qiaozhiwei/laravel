<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //
    protected $table = 'admin_user';
    protected $primaryKey="id";
    public $timestamps = false;
}
