<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerAddress;
use App\CustomerContact;
use Input;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    public function create($id){

        $customer_contact = new CustomerContact;

        $customer_contact->customer_id = $id;
        $customer_contact->name_contact = \Input::get('name_contact');
        $customer_contact->phone = \Input::get('phone');
        $customer_contact->cell = \Input::get('cell');
        $customer_contact->save();

        Session::flash('message', 'Contato cadastrado com sucesso!');
        return Redirect::to('customers/'.$id.'/edit');

    }

    public function destroy($id){

        //delete
        $customer_contact = CustomerContact::find($id);
        $customer_contact->delete();

        return Redirect::back()->with('message','Contato deletado com sucesso!');
    }
}
