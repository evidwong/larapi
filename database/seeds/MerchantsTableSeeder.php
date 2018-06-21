<?php

use Illuminate\Database\Seeder;
use App\Models\Merchant;

class MerchantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $user_ids = User::all()->pluck('id')->toArray();
        // 获取 Faker 实例
//        $faker = app(Faker\Generator::class);
        $merchants = factory(Merchant::class)
            ->times(100)
            ->make();
        Merchant::insert($merchants->toArray());
    }
}
