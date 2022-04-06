<?php

namespace App\Repositories;

use App\Models\Detail;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class DetailRepository extends BaseRepository
{
    public function getModel(): Detail
    {
        return new Detail();
        Cache::flush();
    }

    public function seeDetail(): object
    {
        if (request()->page)
        {
            $key = 'details' . request()->page;
        }else{
            $key = 'details';
        }

        if (Cache::has($key))
        {
            $details = Cache::get($key);
        } else{
            if (!empty(Session::get('order_id')))
            {
                $details = Detail::whereOrder_id(Session::get('order_id'))->get();
                Cache::put($key, $details);
            }
        }
        
        return $details;
    }
}
