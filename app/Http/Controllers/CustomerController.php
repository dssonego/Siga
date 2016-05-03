<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use App\Customer;

use App\Http\Requests;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $customers = Customer::with('address')->paginate();
        return View('customers.index', array(
            'customers' => $customers
        ));
    }

}
