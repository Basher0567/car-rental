<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentalController extends Controller
{
    public function rentalPage1(){
        $list=Rental::with('car','user')->get();
        return Inertia::render('RentalPage1',['list'=>$list]);
    }
    public function rentalHistory(){
        $list=Rental::with('car','user')->get();
        return Inertia::render('RentalHistory',['list'=>$list]);
    }
}
