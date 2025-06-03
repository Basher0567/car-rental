<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
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
    public function customerPage(){
        $list=Customer::get();
        return Inertia::render('CustomerPage',['list'=>$list]);
    }
    public function customerSavePage(Request $request){
        $customer_id=$request->query('id');
        $list=Customer::where('id',$customer_id)->first();
        return Inertia::render('CustomerSavePage',['list'=>$list]);
    }
    public function createCustomer(Request $request){
       try{
         $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $address=$request->input('address');
        Customer::create([
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'address'=>$address
        ]);
        $data=['message'=>'Customer Added Successful','status'=>true,'error'=>''];
        return redirect()->route('customerPage')->with($data);
       }catch(Exception $e){
            $data=['message'=>'Customer Added  Not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('customerSavePage')->with($data);
       }
    }
    public function updateCustomer(Request $request){
        try{
            $customer_id=$request->input('id');
            Customer::where('id',$customer_id)->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'phone'=>$request->input('phone'),
                'address'=>$request->input('address')
            ]);
            $data=['message'=>'Customer Update Successful','status'=>true,'error'=>''];
            return redirect()->route('customerPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Customer Update Not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('customerSavePage')->with($data);
        }
    }
    public function deleteCustomer(Request $request){
        try{
            $customer_id=$request->id;
            Customer::where('id',$customer_id)->delete();
            $data=['message'=>'Customer Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('customerPage')->with($data);
        }catch(Exception $e){
            $data=['message'=>'Customer Delete Not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('customerSavePage')->with($data);
        }

    }
    public function customerById(Request $request){
        $customer_id=$request->input('id');
        return Customer::where('id',$customer_id)->first();
    }
    public function customerList(Request $request){
        return Customer::get();
    }
    public function customerDetailsPage(Request $request){
        $customer_id=$request->query('id');
        $customers=Customer::where('id',$customer_id)->first();
        return Inertia::render('CustomerDetailsPage',['customer'=>$customers]);
    }
}
