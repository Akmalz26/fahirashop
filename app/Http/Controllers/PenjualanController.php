<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //get all penjualans from Models
        $penjualans = penjualan::latest()->get();

        //return view with data
        return view('penjualan.index', compact('penjualans'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tgl_penjualan'     => 'required',
            'total_harga'     => 'required',
            'id_penjualan'     => 'required',
        ]);

        //create penjualan
        $penjualan = penjualan::create([
            'tgl_penjualan'     => $request->tgl_penjualan, 
            'total_harga'     => $request->total_harga, 
            'id_pelanggan'     => $request->id_pelanggan, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $penjualan  
        ]);
    }

    public function show(penjualan $penjualan)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data penjualan',
            'data'    => $penjualan  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $penjualan
     * @return void
     */
    public function update(Request $request, penjualan $penjualan)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tgl_penjualan'     => 'required',
            'total_harga'     => 'required',
            'id_pelanggan'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create penjualan
        $penjualan->update([
            'tgl_penjualan'     => $request->tgl_penjualan, 
            'total_harga'     => $request->total_harga, 
            'id_pelanggan'     => $request->id_pelanggan, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $penjualan  
        ]);
    }

    public function destroy($id)
    {
        //delete penjualan by ID
        penjualan::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data penjualan Berhasil Dihapus!.',
        ]); 
    }
}
