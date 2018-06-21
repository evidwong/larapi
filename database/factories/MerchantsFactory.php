<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Merchant::class, function (Faker $faker) {
    $updated_at = $faker->dateTimeThisMonth();
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);
    $service_expire = $faker->dateTimeThisMonth();
    $service_start=$faker->dateTimeThisMonth($service_expire);

    return [
        'name' =>$faker->name,
        'type' =>$faker->company,
        'contact' =>$faker->userName,
        'hand_phone' =>$faker->phoneNumber,
        'tech_ad' =>$faker->userName,
        'tel_phone' =>$faker->phoneNumber,
        'city' =>$faker->city,
        'address' =>$faker->address,
        'login_times' =>$faker->randomNumber(),
        'query_times' =>$faker->randomNumber(),
        'service_start' =>$service_start,
        'service_expire' =>$service_expire,
        'auth_time' =>$faker->time('H:i:s'),
        'auth_speed' =>$faker->randomNumber(),
        'auth_number' =>$faker->randomNumber(),
        'auth_key' =>$faker->randomKey(),
        'auth_ip' =>$faker->ipv4,
        'auth_brand' =>$faker->company,
        'remarks' =>$faker->sentence,
        'pics' =>$faker->sentence,
        'status' =>1,
        'operator_id' =>1,
        'operator_name' =>'Test',
        'auth_start_time' =>$faker->time('H:i:s'),
        'auth_end_time' =>$faker->time('H:i:s'),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
