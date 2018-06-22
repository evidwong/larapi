<?php

namespace App\Observers;

use App\Models\Merchant;
use Auth;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
class MerchantObserver
{
    public function creating(Merchant $merchant)
    {
        //
    }

    public function updating(Merchant $merchant)
    {
        //
    }

    public function saving(Merchant $merchant)
    {
//        $merchant->operator_id = Auth::user()->id;
//        $merchant->operator_name = Auth::user()->name;
    }

    public function saved(Merchant $merchant)
    {
    }
}
