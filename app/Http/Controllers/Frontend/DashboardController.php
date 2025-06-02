<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use Inertia\Inertia;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboardPage1(){
        $car=Car::count();
        $availability=Car::where('availability','available')->count();
        $rental=Rental::count();
        $data=[
            'car'=>$car,
            'availability'=>$availability,
            'rental'=>$rental,
        ];
        return Inertia::render('DashboardPage1',['list'=>$data]);
    }
}
