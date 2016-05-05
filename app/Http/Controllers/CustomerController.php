<?php

namespace App\Http\Controllers;

use App\Customer;
use Input;
use Session;
use Illuminate\Support\Facades\Redirect;
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
        $customers = Customer::with('address')->paginate();
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
        );
        $validator = Validator(\Input::all(), $rules);

        $customer = new Customer;
        $customer->name       = \Input::get('name');
        $customer->save();

        // redirect
        Session::flash('message', 'Successfully created nerd!');
        return Redirect::to('customers');
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
