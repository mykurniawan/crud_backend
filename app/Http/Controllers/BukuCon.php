<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator; //menambahkan sebuah data <- postman
use Illuminate\Support\Facades\DB;
use App\Models\BukuModel;
use Illuminate\Http\Request;

class BukuCon extends Controller
{
    // get
    public function getB()
    {
        $dtB = BukuModel::get();
        return response()->json($dtB);
    }

    // get berdasarkan idnya 
    public function getidbuku($id)
    {
        $dataBuku = BukuModel::where('id_buku', '=', $id)->get();
        return response()->json($dataBuku);
    }

    public function createbuku(Request $req)
    {
        $val = Validator::make($req->all(), [
            'judul_buku' => 'required',
            'jenis_buku' => 'required',
            'pengarang' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $create = BukuModel::create([
            'judul_buku' => $req->judul_buku,
            'jenis_buku' => $req->jenis_buku,
            'pengarang' => $req->pengarang

        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data buku.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data buku.']);
        }
    }

    // update 
    public function updatebuku(Request $req, $id)
    {
        $val = Validator::make($req->all(), [
            'judul_buku' => 'required',
            'jenis_buku' => 'required',
            'pengarang' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $update = BukuModel::where('id_buku', $id)->update([
            'judul_buku' => $req->get('judul_buku'),
            'jenis_buku' => $req->get('jenis_buku'),
            'pengarang' => $req->get('pengarang'),
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengaptudate data buku.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengaptudate data buku.']);
        }
    }

    // delete 
    public function deletebuku($id)
    {
        $delete = BukuModel::where('id_buku', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses delet data buku.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal delet data buku.']);
        }
    }
}
