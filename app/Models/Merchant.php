<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $fillable=['name','type','contact','hand_phone','tech_ad','tel_phone','city','address','login_times','query_times','service_start','service_expire','auth_time','auth_speed','auth_number','auth_key','auth_ip','auth_brand','remarks','pics','status','operator_id','operator_name','auth_start_time','auth_end_time','is_del'];
}
