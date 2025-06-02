<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboardPage(Request $request){
        $car=Car::count();
        $availability=Car::where('availability','available')->count();
        $rental=Rental::count();
        $total_cost=Rental::sum('total_cost');
        $data=[
            'car'=>$car,
            'availability'=>$availability,
            'rental'=>$rental,
            'total_cost'=>$total_cost
        ];
        return Inertia::render('DashboardPage',['list'=>$data]);
    }
    public function summary(Request $request){
        /*$car=Car::count();
        $availability=Car::sum('availability');
        $rental=Rental::count();
        $total_cost=Rental::sum('total_cost');
        return [
            'car'=>$car,
            'availability'=>$availability,
            'rental'=>$rental,
            'total_cost'=>$total_cost
        ];*/
    }
}
