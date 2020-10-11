<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
	 public function show()
    {
        $data_product = product::join('customers', 'customers.id_customers', 'product.id_customers')->get();
        return Response()->json($data_product);
    }

    public function detail($id)
    {
        if(orders::where('id', $id)->exists()) 
        {
            $data_product = orders::join('customers', 'customers.id_customers', 'product.id_customers')
                                     ->where('product.id', '=', $id)
                                     ->get();

            return Response()->json($data_product);   
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
    			'nama_barang' 	=> 'required',
    			'jenis_barang'	=> 'required',
    			'warna'			=> 'required',
    			'id_costumers'	=> 'required'	
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$simpan = product::create([
    		'nama_barang' 	=> $request->nama_barang,
    		'jenis_barang'	=> $request->jenis_barang,
    		'warna' 		=> $request->warna,
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
