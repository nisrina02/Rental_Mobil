<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyewa;
use Validator;
use Auth;

class PenyewaController extends Controller
{
    public function show(){
      if(Auth::user()->level=="admin"){
        $data=Penyewa::all();
        return response()->json($data);
      }
    }

    public function store(Request $req){
      if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(), [
          'nama_penyewa' => 'required',
          'alamat' => 'required',
          'telp' => 'required',
          'no_ktp' => 'required',
          'foto' => 'required'
        ]);
        if($validator->fails()){
          return response()->json($validator->errors()->toJson(),400);
        }
        else {
          $insert=Penyewa::insert([
            'nama_penyewa' => $req->nama_penyewa,
            'alamat' => $req->alamat,
            'telp' => $req->telp,
            'no_ktp' => $req->no_ktp,
            'foto' => $req->foto
          ]);

          $status = "1";
          $messege = "Berhasil menambahkan data penyewa";

          return response()->json(compact('status', 'messege'));

        }
      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function update($id, Request $req){
      if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(), [
          'nama_penyewa' => 'required',
          'alamat' => 'required',
          'telp' => 'required',
          'no_ktp' => 'required',
          'foto' => 'required'
        ]);

        if($validator->fails()){
          return response()->json($validator->errors());
        }

        $ubah = Penyewa::where('id', $id)->update([
          'nama_penyewa' => $req->nama_penyewa,
          'alamat' => $req->alamat,
          'telp' => $req->telp,
          'no_ktp' => $req->no_ktp,
          'foto' => $req->foto
        ]);

        $status="1";
        $messege="Berhasil mengupdate data penyewa";

        return response()->json(compact('status', 'messege'));

      } else {
        echo "Hanya admin yang bisa mengakses!";
      }
    }

    public function destroy($id){
      if(Auth::user()->level=="admin"){
        $hapus = Penyewa::where('id', $id)->delete();

        $status="1";
        $messege="Berhasil menghapus data penyewa";

        return response()->json(compact('status', 'messege'));
      } else {
        echo "Hanya admin yang dapat mengakses!";
      }
    }
}
