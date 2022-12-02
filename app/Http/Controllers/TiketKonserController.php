<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiketKonser;

class TiketKonserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TiketKonser::all();
        
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
        $data = new TiketKonser();
        $data->nama_konser = $request->nama_konser;
        $data->tanggal_konser = $request->tanggal_konser;
        $data->jenis_tiket = $request->jenis_tiket;
        $data->harga_tiket = $request->harga_tiket;
        $data->stok_tiket = $request->stok_tiket;
        $data->save();

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
        $data = TiketKonser::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TiketKonser::find($id);
        if($data){
            $data->nama_konser = $request->nama_konser ? $request->nama_konser : $data->nama_konser;
            $data->tanggal_konser = $request->tanggal_konser ? $request->tanggal_konser : $data->tanggal_konser;
            $data->jenis_tiket = $request->jenis_tiket ? $request->jenis_tiket : $data->jenis_tiket;
            $data->harga_tiket = $request->harga_tiket ? $request->harga_tiket : $data->harga_tiket;
            $data->stok_tiket = $request->stok_tiket ? $request->stok_tiket : $data->stok_tiket;
            $data->save();

            return $data;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TiketKonser::find($id);
        if($data){
            $data->delete();
            return["message" => "Delete succes"];
        }else{
            return["message" => "Data not found"];
        }
    }
}
