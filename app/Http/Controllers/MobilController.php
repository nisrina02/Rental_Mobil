<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use Validator;
use Auth;

class MobilController extends Controller
{
    public function show(){
      if(Auth::user()->level=="admin"){
        $data=Mobil::all();
        return response()->json($data);
      }
    }

    public function store(Request $req){
      if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(), [
          'nama_mobil' => 'required',
          'merk' => 'required',
          'plat_nomor' => 'required',
          'id_jenis' => 'required',
          'keterangan' => 'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=Mobil::insert([
            'nama_mobil' => $req->nama_mobil,
            'merk' => $req->merk,
            'plat_nomor' => $req->plat_nomor,
            'id_jenis' => $req->id_jenis,
            'keterangan' => $req->keterangan
          ]);

          $status = "1";
          $messege = "Berhasil menambahkan data mobil";

          return response()->json(compact('status', 'messege'));

        }
      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function update($id, Request $req){
      if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(), [
          'nama_mobil' => 'required',
          'merk' => 'required',
          'plat_nomor' => 'required',
          'id_jenis' => 'required',
          'keterangan' => 'required'
        ]);

        if($validator->fails()){
          return response()->json($validator->errors());
        }

        $ubah = Mobil::where('id', $id)->update([
          'nama_mobil' => $req->nama_mobil,
          'merk' => $req->merk,
          'plat_nomor' => $req->plat_nomor,
          'id_jenis' => $req->id_jenis,
          'keterangan' => $req->keterangan
        ]);

        $status="1";
        $messege="Berhasil mengupdate data mobil";

        return response()->json(compact('status', 'messege'));

      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function destroy($id){
      if(Auth::user()->level=="admin"){
        $hapus = Mobil::where('id', $id)->delete();

        $status="1";
        $messege="Berhasil menghapus data mobil";

        return response()->json(compact('status', 'messege'));
      } else {
        echo "Hanya admin yang dapat mengakses!";
      }
    }
}
