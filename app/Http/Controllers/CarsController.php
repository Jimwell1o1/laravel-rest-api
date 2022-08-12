<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Http\Requests\StoreCarsRequest;
use App\Http\Requests\UpdateCarsRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarsRequest $request)
    {
        try {
            //Validate first the input
            $validateUser = Validator::make($request->all(), 
            [
                'customer_id' => 'required',
                'name' => 'required',
                'model' => 'required',
            ]);

            //if validation has errors
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $customer_exist = Customer::where('id', $request->customer_id)->first();
            if($customer_exist === null){
                return response()->json([
                    'status' => false,
                    'message' => 'Customer does not exist',
                ], 401);
            }

            //if validation is successful
            $customer = Cars::create([
                'customer_id' => $request->customer_id,
                'name' => $request->name,
                'model' => $request->model,
            ]);
            //return an api
            return response()->json([
                'status' => true,
                'message' => 'A Car has been created successfully',

            ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(Cars $cars)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Cars $cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarsRequest  $request
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarsRequest $request, Cars $car_id)
    {
        try {

            $car_id->update([
                'name' => 'New Car',
                'model' => 'New Model'
            ]);

            
            //return an api
            return response()->json([
                'status' => true,
                'message' => 'Car Updated Successfully',

            ], 200);

            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cars $car_id)
    {
        try {

            $car_id->delete();

            return response()->json([
                'status' => true,
                'message' => 'The Car has been deleted successfully.',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
