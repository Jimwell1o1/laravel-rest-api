<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomersResource;

use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json([
        //     'status' => true,

        // ]);

        return CustomersResource::collection(Customer::all());
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
                //Validate first the input
                $validateUser = Validator::make($request->all(), 
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:customers|max:255',
                ]);

                //if validation has errors
                if($validateUser->fails()){
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }
                //if validation is successful
                $customer = Customer::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email
                ]);
                //return an api
                return response()->json([
                    'status' => true,
                    'message' => 'Customer Created Successfully',
                    new CustomersResource($customer)

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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // return new CustomersResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update([
                'first_name' => 'Sample First Name',
                'last_name' => 'Sample Last Name',
                'email' => 'sample@email.com'
            ]);

            
            //return an api
            return response()->json([
                'status' => true,
                'message' => 'Customer Updated Successfully',
                new CustomersResource($customer)

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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            if($customer->cars->count() > 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Sorry, the Customer has still at least one car.',
                ], 200);
            }

            $customer->delete();
            return response()->json([
                'status' => true,
                'message' => 'Customer deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getcustomer_cars(Customer $customer_id)
    {
        if($customer_id->cars->count() <= 0){
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the Customer do not have any car.',
            ], 200);
        }
        else{
            return $customer_id->cars;
        }

    }
}
