<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use Validator;
use Auth;

class DetailController extends Controller
{
    public function show(){
      if(Auth::user()->level=="petugas"){
        $data=Detail::all();
        return response()->json($data);
      }
    }

    public function store(Request $req){
      if(Auth::user()->level=="petugas"){
        $validator = Validator::make($req->all(), [
          'id_trans' => 'required',
          'id_mobil' => 'required',
          'qty' => 'required',
          'subtotal' => 'required',
          'denda' => 'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=Detail::insert([
            'id_trans' => $req->id_trans,
            'id_mobil' => $req->id_mobil,
            'qty' => $req->qty,
            'subtotal' => $req->subtotal,
            'denda' => $req->denda
          ]);

          $status = "1";
          $messege = "Berhasil menambahkan data detail transaksi";

          return response()->json(compact('status', 'messege'));

        }
      } else {
        echo "Hanya petugas yang bisa mengakses!";
      }
    }

    public function update($id, Request $req){
      if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(), [
          'id_trans' => 'required',
          'id_mobil' => 'required',
          'qty' => 'required',
          'subtotal' => 'required',
          'denda' => 'required'
        ]);

        if($validator->fails()){
          return response()->json($validator->errors());
        }

        $ubah = Detail::where('id', $id)->update([
          'id_trans' => $req->id_trans,
          'id_mobil' => $req->id_mobil,
          'qty' => $req->qty,
          'subtotal' => $req->subtotal,
          'denda' => $req->denda
        ]);

        $status="1";
        $messege="Berhasil mengupdate data detail transaksi";

        return response()->json(compact('status', 'messege'));

      } else {
        echo "Hanya petugas yang bisa mengakses!";
      }
    }

    public function destroy($id){
      if(Auth::user()->level=="petugas"){
        $hapus = Detail::where('id', $id)->delete();

        $status="1";
        $messege="Berhasil menghapus data detail transaksi";

        return response()->json(compact('status', 'messege'));
      } else {
        echo "Hanya petugas yang dapat mengakses!";
      }
    }
}
