<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiketKonser;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();
        
        return response()->json([
            "message" => "Load Data Success",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $tiket = TiketKonser::find($request->id_konser);

        $data = new Transaksi();
        $data->id_user = $request->user()->id;
        $data->id_konser = $request->id_konser;
        $data->jumlah_tiket = $request->jumlah_tiket;
        $data->total_bayar = $tiket->harga_tiket * $request->jumlah_tiket;
        $data->tanggal_bayar = date('Y-m-d H:i:s');
        $data->save();

        $tiket->stok_tiket -= $request->jumlah_tiket;
        $tiket->save();

        //return $data;
        return response()->json([
            "message" => "Store success",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data not found"];
        }
    }
}
