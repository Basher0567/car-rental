<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
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
    public function carPage(){
        $list=Car::get();
        return Inertia::render('CarPage',['list'=>$list]);
    }
      public function carSavePage(Request $request){
         $car_id = $request->query('id');
         $list=Car::where('id',$car_id)->first();
        return Inertia::render('CarSavePage',['list'=>$list]);
    }
    public function createCar(Request $request){
        //return $request->all();
       try{
        $name=$request->input('name');
        $brand=$request->input('brand');
        $model=$request->input('model');
        $year=$request->input('year');
        $car_type=$request->input('car_type');
        $daily_rent_price=$request->input('daily_rent_price');
        $availability=$request->input('availability');
        $image=$request->input('image');
        $data=[
            'name'=>$name,
            'brand'=>$brand,
            'model'=>$model,
            'year'=>$year,
            'car_type'=>$car_type,
            'daily_rent_price'=>$daily_rent_price,
            'availability'=>$availability,
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');

            $fileName = time().'.'.$image->getClientOriginalExtension();
            $filePath = 'uploads/'.$fileName;

            $image->move(public_path('uploads'), $fileName);
            $data['image'] = $filePath;
        }

        Car::create($data);
       $data=['message'=>'Car Added Successful','status'=>true,'error'=>''];
       return redirect()->route('carPage')->with($data);
       }catch(Exception $e){
        $data=['message'=>'Car Not Added Successful','status'=>false,'error'=>$e->getMessage()];
       return redirect()->route('carSavePage')->with($data);
       }
    }
    public function updateCar(Request $request){
        try{
            $car_id=$request->input('id');
            Car::where('id',$car_id)->update([
                'name'=>$request->input('name'),
                'brand'=>$request->input('brand'),
                'model'=>$request->input('model'),
                'year'=>$request->input('year'),
                'car_type'=>$request->input('car_type'),
                'daily_rent_price'=>$request->input('daily_rent_price'),
                'availability'=>$request->input('availability'),
                'image'=>$request->input('image')
            ]);
            $data=['message'=>'Car Update Successful','status'=>true,'error'=>''];
            return redirect()->route('carPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Car Update Not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('carSavePage')->with($data);
        }
    }
    public function deleteCar(Request $request){
        //return $request->id;
        try{
            $car_id=$request->id;
            //dd($car_id);
            Car::where('id',$car_id)->delete();
            $data=['message'=>'Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('carPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Delete Not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('carPage')->with($data);
        }
    }
    public function carById(Request $request){
        $car_id=$request->input('id');
        return Car::where('id',$car_id)->first();
    }
    public function carList(Request $request){
        return Car::get();
    }
    public function carDetailsPage(Request $request){
        $car_id = $request->query('id');
        $carDetails=Car::where('id',$car_id)->first();
        return Inertia::render('CarDetailPage',['carDetails'=>$carDetails]);
    }

}
