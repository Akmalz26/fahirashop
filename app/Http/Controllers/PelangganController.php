<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //get all pelanggans from Models
        $pelanggans = pelanggan::latest()->get();

        //return view with data
        return view('pelanggan.index', compact('pelanggans'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'alamat'     => 'required',
            'tlp'     => 'required',
            'email'   => 'required|unique:pelanggans'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     // return response()->json($validator->errors(), 422);
        //     return response()->json(['errors' => ['email' => ['Email sudah ada']]], 422);
        // }

        

        //create pelanggan
        $pelanggan = pelanggan::create([
            'nama'     => $request->nama, 
            'alamat'     => $request->alamat, 
            'tlp'     => $request->tlp, 
            'email'   => $request->email
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $pelanggan  
        ]);
    }

    public function show(pelanggan $pelanggan)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data pelanggan',
            'data'    => $pelanggan  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $pelanggan
     * @return void
     */
    public function update(Request $request, pelanggan $pelanggan)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'alamat'     => 'required',
            'tlp'     => 'required',
            'email'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create pelanggan
        $pelanggan->update([
            'nama'     => $request->nama, 
            'alamat'     => $request->alamat, 
            'tlp'     => $request->tlp, 
            'email'   => $request->email
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $pelanggan  
        ]);
    }

    public function destroy($id)
    {
        //delete pelanggan by ID
        pelanggan::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan Berhasil Dihapus!.',
        ]); 
    }
}
