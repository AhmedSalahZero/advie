<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreMarketRequest;
use App\Http\Requests\UpdateMarketRequest;
use App\Market;

use Illuminate\Http\Request;

class MarketsController extends Controller
{
    public function show($lang)
    {
        return view('frontend.market');
    }
}
