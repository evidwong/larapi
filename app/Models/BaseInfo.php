<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
{
    protected $table = 'base_infos';
    public $fillable = ['name','type','status','pid'];
}
