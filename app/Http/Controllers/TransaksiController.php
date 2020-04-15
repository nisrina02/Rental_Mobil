<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Validator;
use Auth;

class TransaksiController extends Controller
{
    public function show(){
      if(Auth::user()->level=="petugas"){
        $data=Transaksi::all();
        return response()->json($data);
      }
    }

    public function store(Request $req){
      if(Auth::user()->level=="petugas"){
        $validator = Validator::make($req->all(), [
          'id_petugas' => 'required',
          'id_penyewa' => 'required',
          'tgl_sewa' => 'required',
          'tgl_deadline' => 'required',
          'tgl_kembali' => 'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=Transaksi::insert([
            'id_petugas' => $req->id_petugas,
            'id_penyewa' => $req->id_penyewa,
            'tgl_sewa' => $req->tgl_sewa,
            'tgl_deadline' => $req->tgl_deadline,
            'tgl_kembali' => $req->tgl_kembali
          ]);

          $status = "1";
          $messege = "Berhasil menambahkan data transaksi";

          return response()->json(compact('status', 'messege'));

        }
      } else {
        echo "Hanya petugas yang bisa mengakses!";
      }
    }

    public function update($id, Request $req){
      if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(), [
          'id_petugas' => 'required',
          'id_penyewa' => 'required',
          'tgl_sewa' => 'required',
          'tgl_deadline' => 'required',
          'tgl_kembali' => 'required'
        ]);

        if($validator->fails()){
          return response()->json($validator->errors());
        }

        $ubah = Transaksi::where('id', $id)->update([
          'id_petugas' => $req->id_petugas,
          'id_penyewa' => $req->id_penyewa,
          'tgl_sewa' => $req->tgl_sewa,
          'tgl_deadline' => $req->tgl_deadline,
          'tgl_kembali' => $req->tgl_kembali
        ]);

        $status="1";
        $messege="Berhasil mengupdate data transaksi";

        return response()->json(compact('status', 'messege'));

      } else {
        echo "Hanya petugas yang bisa mengakses!";
      }
    }

    public function destroy($id){
      if(Auth::user()->level=="petugas"){
        $hapus = Transaksi::where('id', $id)->delete();

        $status="1";
        $messege="Berhasil menghapus data transaksi";

        return response()->json(compact('status', 'messege'));
      } else {
        echo "Hanya petugas yang dapat mengakses!";
      }
    }
}
