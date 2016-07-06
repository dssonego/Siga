<?php

namespace App\Http\Controllers;

use App\Job;
use App\Customer;
use App\JobBriefing;
use App\JobPart;
use App\JobSituation;
use App\User;
use Input;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        date_default_timezone_set('America/Sao_Paulo');
        $date_now = date('Y-m-d');

        $deadline = $request->get('deadline');
        $code = $request->get('code');
        $customer_id = $request->get('customer_id');
        $title = $request->get('title');
        $responsable_id = $request->get('responsable_id');
        $situation_id = $request->get('situation_id');
        
        if((!empty($deadline)) || (!empty($code)) || (!empty($customer_id)) || (!empty($title)) || (!empty($responsable_id)) || (!empty($situation)) ):
            $jobs = Job::where('deadline', 'like', "%$deadline%")
                ->where('code', 'like', "%$code%")
                ->where('customer_id', 'like', "%$customer_id%")
                ->where('title', 'like', "%$title%")
                ->where('responsable_id', 'like', "%$responsable_id%")
                ->where('situation_id', 'like', "%$situation_id%")
                ->orderBy('deadline', 'asc')
                ->paginate(50);

            $search = 0;
        else:
            $jobs = Job::with('customer','responsableJob','requesterJob')
                ->where('responsable_id', Auth::user()->id)
                ->orWhere('requester_id', Auth::user()->id)
                ->orderBy('deadline', 'asc')
                ->paginate(50);

            $search = 1;
        endif;

        $customers = Customer::orderBy('name','asc')
            ->get();
        $users = User::orderBy('name','asc')
            ->get();
        $situations = JobSituation::all();

        $countjobs = count($jobs);

        return View('jobs.index')
            ->with('date_now',$date_now)
            ->with('search',$search)
            ->with('customers',$customers)
            ->with('users',$users)
            ->with('situations',$situations)
            ->with('countjobs',$countjobs)
            ->with('jobs',$jobs);

    }

    public function create(){

        $customers = Customer::orderBy('name','asc')
            ->get();

        $parts = JobPart::orderBy('name','asc')
            ->get();

        $users = User::orderBy('name','asc')
            ->get();

        $situations = JobSituation::all();

        return View('jobs.create')
            ->with('parts',$parts)
            ->with('users',$users)
            ->with('situations',$situations)
            ->with('customers',$customers);
    }
    
    public function store(){

        date_default_timezone_set('America/Sao_Paulo');

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'customer_id'       => 'required',
            'part_id'       => 'required',
            'title'       => 'required',
            'deadline'       => 'required',
            'hour'       => 'required',
            'briefing'       => 'required',
            'responsable_id'       => 'required',
            'situation_id'       => 'required',
        );

        $messages = array(
            'required' => 'Campo obrigatório!',
        );

        $validator = Validator(\Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('jobs/create')
                ->withErrors($validator)
                ->withInput(\Input::except('password'));
        } else {
            // store
            $job = new Job;
            $jobbriefing = new JobBriefing;

            // Verification job exist
            $verification_job = Job::all();
            $verification = count($verification_job);
            // Verification job exist

            // save job
            $job->customer_id = \Input::get('customer_id');
            if($verification == 0):
                 $job->code = "5000A";
            else:
                $job->code = ($verification_job->last()->code+1)."A";
            endif;
            $job->part_id = \Input::get('part_id');
            $job->title = \Input::get('title');
            $job->deadline = \Input::get('deadline');
            $job->hour = \Input::get('hour');
            $job->responsable_id = \Input::get('responsable_id');
            $job->requester_id = Auth::user()->id;
            $job->situation_id = \Input::get('situation_id');
            $job->save();

            // save briefing
            $jobbriefing->job()->associate($job); // foreign key
            $jobbriefing->briefing = \Input::get('briefing');
            $jobbriefing->save();

            // redirect
            Session::flash('message', 'PIT cadastrado com sucesso!');
            return Redirect::to('jobs');
        }

    }

    public function edit($id)
    {
        // first the job
        $job = Job::with('jobBriefing','customer','jobPart','responsableJob','jobSituation')
            ->where('jobs.id', $id)
            ->first();

        $customers = Customer::orderBy('name','asc')
            ->get();

        $parts = JobPart::orderBy('name','asc')
            ->get();

        $users = User::orderBy('name','asc')
            ->get();

        $briefings = JobBriefing::where('job_id', $id)
            ->orderBy('id','desc')
            ->get();

        $situations = JobSituation::all();

        $i=0;

        // show the edit form and pass the customer and contacts
        return View('jobs.edit')
            ->with('customers',$customers)
            ->with('parts',$parts)
            ->with('users',$users)
            ->with('situations',$situations)
            ->with('job',$job)
            ->with('briefings',$briefings)
            ->with('i',$i);
    }

    public function update($id)
    {

        date_default_timezone_set('America/Sao_Paulo');

        //
        $rules = array(
            'customer_id'       => 'required',
            'part_id'       => 'required',
            'title'       => 'required',
            'deadline'       => 'required',
            'hour'       => 'required',
            'briefing'       => 'required',
            'responsable_id'       => 'required',
            'situation_id'       => 'required',
        );

        $messages = array(
            'required' => 'Campo obrigatório!',
        );

        $validator = Validator(\Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('jobs/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // job
            $job = Job::find($id);
            $jobbriefing = JobBriefing::where('job_id', $id)
                ->orderBy('id','desc')
                ->first();

            // save job
            $job->customer_id = \Input::get('customer_id');
            $job->part_id = \Input::get('part_id');
            $job->title = \Input::get('title');
            $job->deadline = \Input::get('deadline');
            $job->hour = \Input::get('hour');
            $job->responsable_id = \Input::get('responsable_id');
            $job->requester_id = Auth::user()->id;
            $job->situation_id = \Input::get('situation_id');
            $job->save();

            // save briefing
            $jobbriefing->briefing = \Input::get('briefing');
            $jobbriefing->save();

            // redirect
            Session::flash('message', 'PIT editado com sucesso!');
            return Redirect::to('jobs/' . $id . '/edit');
        }

    }

    public function alterJob($id){

        date_default_timezone_set('America/Sao_Paulo');

        $jobbriefing = new JobBriefing;
        $job = Job::find($id);
        $last_job_briefing = JobBriefing::where('job_id',$id)
            ->orderBy('id', 'desc')
            ->first();

        //create new briefing
        $jobbriefing->job_id = $id;
        $jobbriefing->save();
        //create new briefing

        // Alter code
        $code = \Input::get('code');
        $last_letter = substr($code, -1);
        $remove_last_letter = substr($code, 0, -1);

        switch($last_letter):
            case "A":
                $job->code = $remove_last_letter."B";
                $job->save();
                break;
            case "B":
                $job->code = $remove_last_letter."C";
                $job->save();
                break;
            case "C":
                $job->code = $remove_last_letter."D";
                $job->save();
                break;
            case "D":
                $job->code = $remove_last_letter."E";
                $job->save();
                break;
            case "E":
                $job->code = $remove_last_letter."F";
                $job->save();
                break;
            case "F":
                $job->code = $remove_last_letter."G";
                $job->save();
                break;
            case "G":
                $job->code = $remove_last_letter."H";
                $job->save();
                break;
            case "H":
                $job->code = $remove_last_letter."I";
                $job->save();
                break;
            case "I":
                $job->code = $remove_last_letter."J";
                $job->save();
                break;
            case "J":
                $job->code = $remove_last_letter."K";
                $job->save();
                break;
            case "K":
                $job->code = $remove_last_letter."L";
                $job->save();
                break;
            case "L":
                $job->code = $remove_last_letter."M";
                $job->save();
                break;
            case "M":
                $job->code = $remove_last_letter."N";
                $job->save();
                break;
            case "N":
                $job->code = $remove_last_letter."O";
                $job->save();
                break;
            case "O":
                $job->code = $remove_last_letter."P";
                $job->save();
                break;
            case "P":
                $job->code = $remove_last_letter."Q";
                $job->save();
                break;
            case "Q":
                $job->code = $remove_last_letter."R";
                $job->save();
                break;
            case "R":
                $job->code = $remove_last_letter."S";
                $job->save();
                break;
            case "S":
                $job->code = $remove_last_letter."T";
                $job->save();
                break;
            case "T":
                $job->code = $remove_last_letter."U";
                $job->save();
                break;
            case "U":
                $job->code = $remove_last_letter."V";
                $job->save();
                break;
            case "V":
                $job->code = $remove_last_letter."X";
                $job->save();
                break;
            case "X":
                $job->code = $remove_last_letter."Y";
                $job->save();
                break;
            case "Y":
                $job->code = $remove_last_letter."Z";
                $job->save();
                break;
            case "Z":
                $job->code = $remove_last_letter."A";
                $job->save();
                break;
        endswitch;
        // Alter code

        //edit last job
        $last_job_briefing->briefing = "<strong>".$code."</strong>"."<br />".$last_job_briefing->briefing;
        $last_job_briefing->save();
        //edit last job

        Session::flash('message', 'PIT '.$job->code.' alterado com sucesso!');
        return Redirect::to('jobs/' . $id . '/edit');
    }
}
