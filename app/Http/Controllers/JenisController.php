<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;
use Validator;
use Auth;

class JenisController extends Controller
{
    public function show(){
      if(Auth::user()->level=="admin"){
        $data=Jenis::all();
        return response()->json($data);
      }
    }

    public function store(Request $req){
      if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(), [
          'jenis_mobil' => 'required',
          'harga' => 'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=Jenis::insert([
            'jenis_mobil' => $req->jenis_mobil,
            'harga' => $req->harga
          ]);

          $status = "1";
          $messege = "Berhasil menambahkan data jenis mobil";

          return response()->json(compact('status', 'messege'));

        }
      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function update($id, Request $req){
      if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(), [
          'jenis_mobil' => 'required',
          'harga' => 'required'
        ]);

        if($validator->fails()){
          return response()->json($validator->errors());
        }

        $ubah = Jenis::where('id', $id)->update([
          'jenis_mobil' => $req->jenis_mobil,
          'harga' => $req->harga
        ]);

        $status="1";
        $messege="Berhasil mengupdate data jenis mobil";

        return response()->json(compact('status', 'messege'));

      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function destroy($id){
      if(Auth::user()->level=="admin"){
        $hapus = Jenis::where('id', $id)->delete();

        $status="1";
        $messege="Berhasil menghapus data jenis mobil";

        return response()->json(compact('status', 'messege'));
      } else {
        echo "Hanya admin yang dapat mengakses!";
      }
    }
}
