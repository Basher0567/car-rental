<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use Exception;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Car;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function rentalPage(){
        $list=Rental::with('car','user')->get();
        return Inertia::render('RentalPage',['list'=>$list]);
    }
    public function rentalSavePage(Request $request){
        $rental_id=$request->query('id');
        $users=User::get();
        $cars=Car::get();
        $list=Rental::where('id',$rental_id)->first();
        return Inertia::render('RentalSavePage',['cars'=>$cars,'users'=>$users,'list'=>$list]);
    }
    public function createRental(Request $request){
        try{
            $user_id=$request->input('user_id');
            $car_id=$request->input('car_id');
            $start_date=$request->input('start_date');
            $end_date=$request->input('end_date');
            $total_cost=$request->input('total_cost');
            $status=$request->input('status');
            Rental::create([
                'user_id'=>$user_id,
                'car_id'=>$car_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'total_cost'=>$total_cost,
                'status'=>$status
            ]);
            $data=['message'=>'Rental Create Successful','status'=>true,'error'=>''];
            return redirect()->route('rentalPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Rental Create not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('rentalSavePage')->with($data);
        }
    }
    public function updateRental(Request $request){
        try{
            $rental_id=$request->input('id');
            Rental::where('id',$rental_id)->update([
                'user_id'=>$request->input('user_id'),
                'car_id'=>$request->input('car_id'),
                'start_date'=>$request->input('start_date'),
                'end_date'=>$request->input('end_date'),
                'total_cost'=>$request->input('total_cost'),
                'status'=>$request->input('status')
            ]);
            $data=['message'=>'Rental Update Successful','status'=>true,'error'=>''];
            return redirect()->route('rentalPage')->with($data);
        }catch(Exception $e){
              $data=['message'=>'Rental Update not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('rentalSavePage')->with($data);
        }

    }
    public function deleteRental(Request $request,$id){
        //return $request->all();
        //return $id;
       try{
            $rental_id=$id;
            Rental::where('id',$rental_id)->delete();
             $data=['message'=>'Rental Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('rentalPage')->with($data);
       }catch(Exception $e){
            $data=['message'=>'Rental Delete not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('rentalSavePage')->with($data);
       }
    }
    public function rentalById(Request $request){
         $rental_id=$request->input('id');
         return Rental::where('id',$rental_id)->first();
    }
    public function rentalList(Request $request){
        return Rental::get();
    }
}
