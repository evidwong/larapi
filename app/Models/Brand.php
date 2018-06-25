<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table='car_brand_dbs';
    public $fillable=['brand_id','brand_name','db_name','db_host','db_port','index_name','index_type','index_host','index_port'];
}
