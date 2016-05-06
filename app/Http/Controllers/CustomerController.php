<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerAddress;
use Input;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::with('address')->paginate(10);
        return View('customers.index', array(
            'customers' => $customers
        ));
    }

    public function create()
    {
        return View('customers.create');
    }

    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'cnpj'       => 'required',
            'image'       => 'required',
            'active'       => 'required',
            'zipcode'       => 'required',
            'street'       => 'required',
            'neighborhood'       => 'required',
            'city'       => 'required',
            'state'       => 'required',
        );
        $validator = Validator(\Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('customers/create')
                ->withErrors($validator)
                ->withInput(\Input::except('password'));
        } else {
            // store
            $customer = new Customer;
            $address = new CustomerAddress;

            // upload image
            $destinationPath = 'img/customers-logo/'; // upload path
            $extension = \Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            \Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

            // save customer
            $customer->name = \Input::get('name');
            $customer->cnpj = \Input::get('cnpj');
            $customer->image = $fileName;
            $customer->active = \Input::get('active');
            $customer->save();

            // save address
            $address->customer()->associate($customer); // foreign key
            $address->zipcode = \Input::get('zipcode');
            $address->street = \Input::get('street');
            $address->complement = \Input::get('complement');
            $address->neighborhood = \Input::get('neighborhood');
            $address->city = \Input::get('city');
            $address->state = \Input::get('state');
            $address->save();

            // redirect
            Session::flash('message', 'Cliente cadastrado com sucesso!');
            return Redirect::to('customers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
