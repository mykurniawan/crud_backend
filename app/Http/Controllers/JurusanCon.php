<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurusanModel;
use Illuminate\Support\Facades\Validator; //menambahkan sebuah data <- postman
use Illuminate\Support\Facades\DB;


class JurusanCon extends Controller
{
    // get
    public function getJ()
    {
        $dtJ = JurusanModel::get();
        return response()->json($dtJ);
    }

    // menampilkan berdasarkan id 
    public function getidjurusan($id)
    {
        $dtJ = JurusanModel::where('id_jurusan', '=', $id)->get();
        return response()->json($dtJ);
    }

    // create 
    public function createjurusan(Request $req)
    {
        $val = Validator::make($req->all(), [
            'nama_jurusan' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $create = JurusanModel::create([
            'nama_jurusan' => $req->nama_jurusan

        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data jurusan.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data jurusan.']);
        }
    }

    // update 
    public function updatejurusan(Request $req, $id){
        $val = Validator::make($req->all(),[
            'nama_jurusan'=>'required'
        ]);
        if($val->fails()){
            return response()->json($val->errors()->toJson());
        }
        $update = JurusanModel::where('id_jurusan', $id)->update([
            'nama_jurusan'=>$req->get('nama_jurusan')
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengaptudate data jurusan.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengaptudate data jurusan.']);
        }
    }

    // delete 
    public function deletejurusan($id){
        $delete = JurusanModel::where('id_jurusan', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses delet data jurusan.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal delet data jurusan.']);
        }
    }
}
