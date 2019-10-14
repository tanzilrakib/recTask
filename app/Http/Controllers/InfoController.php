<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Info;
use App\Jobs\EnlistInfo;
use Validator;

class InfoController extends Controller
{
    
	// Returns landing page with enlisting form
	protected function index()
    {
        return view('welcome');
    }

    // Shows enlisted info to authed users
	protected function showList()
    {	
    	$infoList = Info::paginate(2);
        return view('info-list')->with('infoList', $infoList );
    }


    // Creates and enlists Info
    protected function enlistInfo(Request $request)
    {
    	// Validates the request data
        $this->validate($request, [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'regex:/^[0-9\+]{1,}[0-9\-]{3,15}$/u', 'string','max:100'],
        ]);

        // Triggers asynchronously queued job for list creation
        EnlistInfo::dispatch($request->all());

        // Returns back to the page
        return redirect()->route('landing');
    }

}
