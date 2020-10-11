<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customers;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
	public function show()
	{
		return customers::all();
	}

    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'id_customers' 	=> 'required',
    			'nama' 			=> 'required',
    			'gender'		=> 'required',
    			'alamat'		=> 'required'    			
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$simpan = customers::create([
    		'id_customers' 	=> $request->id_customers,
    		'nama'			=> $request->nama,
    		'gender' 		=> $request->gender,
    		'alamat'		=> $request->alamat    		
    	]);

    	if($simpan)
    	{
    		return Response()->json(['status' => 1]);
    	}
    	else
    	{
    		return Response()->json(['status' => 0]);
    	}
    }
}
