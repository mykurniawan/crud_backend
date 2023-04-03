<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator; //menambahkan sebuah data <- postman
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mahasiswa; // +model

class MahasiswaCon extends Controller
{
    // get
    public function getM()
    {
        $dtM = Mahasiswa::get();
        return response()->json($dtM);
    }

    //menampilkan berdasarkan id
    public function getid($id)
    {
        $dt_mahasiswa = mahasiswa::where('id', '=', $id)->get();
        return response()->json($dt_mahasiswa);
    }

    // create 
    public function createmahasiswa(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson());
        }
        $create = Mahasiswa::create([
            'nama' => $req->nama,
            'jeniskelamin' => $req->jeniskelamin,
            'alamat' => $req->alamat

        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data mahasiswa.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data mahasiswa.']);
        }
    }

    // update 
    public function updatemahasiswa(Request $req, $id)
    {
        $validate = Validator::make($req->all(), [
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson());
        }
        $update = Mahasiswa::where('id', $id)->update([
            'nama' => $req->get('nama'),
            'jeniskelamin' => $req->get('jeniskelamin'),
            'alamat' => $req->get('alamat'),
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengaptudate data mahasiswa.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengaptudate data mahasiswa.']);
        }
    }

    // delete 
    public function deletemahasiswa($id)
    {
        $delete = Mahasiswa::where('id', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses delet data mahasiswa.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal delet data mahasiswa.']);
        }
    }
}
