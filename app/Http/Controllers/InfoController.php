<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Info;
use Validator;
use Session;

class InfoController extends Controller
{
    

	protected function index()
    {
        return view('welcome');
    }


	protected function showList()
    {	
    	$infoList = Info::paginate(2);
        return view('info-list')->with('infoList', $infoList );
    }

    protected function enlistInfo(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'regex:/^[0-9\+]{1,}[0-9\-]{3,15}$/u', 'string','max:100'],
        ]);

        if($this->createList($request->all())){
			Session::flash('message', 'Info enlisted!'); 
			Session::flash('alert-class', 'alert-success'); 
        }
        else{
        	Session::flash('message', 'Failed to enlist info!'); 
			Session::flash('alert-class', 'alert-danger'); 
        }

        return redirect()->route('landing');
    }

    /**
     * Create a list item after validation.
     *
     * @param  array  $data
     * @return \App\Form
     */
    protected function createList(array $data)
    {
        return Info::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
}
