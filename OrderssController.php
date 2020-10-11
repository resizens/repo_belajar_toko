<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\orders;
use Illuminate\Support\Facades\Validator;

class OrderssController extends Controller
{
    public function show()
    {
        $data_orders = orders::join('customers', 'customers.id_customers', 'orders.id_customers')->get();
        return Response()->json($data_orders);
    }

    public function detail($id)
    {
        if(orders::where('id', $id)->exists()) 
        {
            $data_orders = orders::join('customers', 'customers.id_customers', 'orders.id_customers')
                                     ->where('orders.id', '=', $id)
                                     ->get();

            return Response()->json($data_orders);   
        }

        else 
        {
            return Response()->json(['message' => 'Tidak ditemukan']);
        }

    }


    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'nama_customers' 	=> 'required',
    			'nama_barang'		=> 'required',
    			'jenis_barang'		=> 'required',
    			'warna'				=> 'required',
    			'tanggal_pesan'		=> 'required',
    			'tanggal_datang'	=> 'required',
    			'pembayaran'		=> 'required',    			
    			'alamat'			=> 'required',
    			'id_customers'		=> 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$simpan = orders::create([
    		'nama_customers'	=> $request->nama_customers,
    		'nama_barang'		=> $request->nama_barang,
    		'jenis_barang'		=> $request->jenis_barang,
    		'warna'				=> $request->warna,
    		'tanggal_pesan'		=> $request->tanggal_pesan,
    		'tanggal_datang'	=> $request->tanggal_datang,
    		'pembayaran'		=> $request->pembayaran,
    		'alamat'			=> $request->alamat,
    		'id_customers'		=> $request->id_customers

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
