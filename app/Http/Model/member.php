<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = 'member';
    protected $primaryKey="id";
    public $timestamps = false;
}
