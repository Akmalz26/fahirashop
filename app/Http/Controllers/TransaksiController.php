<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //get all transaksis from Models
        $transaksis = Transaksi::with('pelanggan', 'kasir')->get();
        $produks = Produk::all();
        $pelanggans = pelanggan::all();
        $kasirs = Kasir::all();

        //return view with data
        return view('transaksi.index', compact('transaksis', 'produks','pelanggans', 'kasirs'));
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_produk'   => 'required',
            'id_pelanggan'   => 'required',
            'id_kasir'   => 'required',
            'tgl'    => 'required',
            'jumlah'  => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create transaksi
        $transaksi = Transaksi::create([
            'id_produk'     => $request->id_produk, 
            'id_pelanggan'     => $request->id_pelanggan, 
            'id_kasir'     => $request->id_kasir, 
            'tgl'     => $request->tgl, 
            'jumlah'   => $request->jumlah
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $transaksi  
        ]);
    }

    public function show(Transaksi $transaksi)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data transaksi',
            'data'    => $transaksi  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $transaksi
     * @return void
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_produk'   => 'required',
            'id_pelanggan'   => 'required',
            'id_kasir'   => 'required',
            'tgl'    => 'required',
            'jumlah'  => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create transaksi
        $transaksi->update([
            'id_produk'     => $request->id_produk, 
            'id_pelanggan'     => $request->id_pelanggan, 
            'id_kasir'     => $request->id_kasir, 
            'tgl'     => $request->tgl, 
            'jumlah'   => $request->jumlah
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $transaksi  
        ]);
    }

    public function destroy($id)
    {
        //delete transaksi by ID
        Transaksi::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data transaksi Berhasil Dihapus!.',
        ]); 
    }
}
