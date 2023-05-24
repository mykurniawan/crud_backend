<?php

namespace App\Http\Controllers;

use App\Models\PinjamModel;
use GuzzleHttp\Psr7\Response;
// use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PinjamCon extends Controller
{
    // dengan id 
    public function getpinjam(Request $req, $id)
    {
        $dtPinjam = PinjamModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->join('mahasiswa', 'mahasiswa.id', '=', 'peminjaman.id_mahasiswa')
            ->join('jurusan', 'jurusan.id_jurusan', '=', 'peminjaman.id_jurusan')
            ->orderBy('id_peminjaman', 'desc')
            ->get();
        return Response()->json($dtPinjam);
    }

    // tanpa id 
    public function getpeminjaman(Request $req)
    {
        $dtPinjam = PinjamModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
            ->join('mahasiswa', 'mahasiswa.id', '=', 'peminjaman.id_mahasiswa')
            ->join('jurusan', 'jurusan.id_jurusan', '=', 'peminjaman.id_jurusan')
            ->get();
        return Response()->json($dtPinjam);
    }


    // create pinjam 
    public function pinjam(Request $req)
    {
        $val = Validator::make($req->all(), [
            'id_buku' => 'required',
            'id_mahasiswa' => 'required',
            'id_jurusan' => 'required',
        ]);
        if ($val->fails()) {
            return Response()->json($val->errors()->toJson());
        }
        $tenggat = carbon::now()->addDays(4);
        $save = PinjamModel::create([
            'id_buku' => $req->get('id_buku'),
            'id_mahasiswa' => $req->get('id_mahasiswa'),
            'id_jurusan' => $req->get('id_jurusan'),
            'tgl_peminjaman' => $req->date('Y-m-d H:i:s'),
            'status' => 'Dipinjam',
            'tenggat' => $tenggat
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data Peminjam.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data Peminjam.']);
        }
    }


    //pd
    public function createpeminjaman(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id_buku' => 'required',
            'id_mahasiswa' => 'required',
            'id_jurusan' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $tenggat = carbon::now()->addDays(4);
        $save = PinjamModel::create([
            'id_buku' => $req->get('id_buku'),
            'id_mahasiswa' => $req->get('id_mahasiswa'),
            'id_jurusan' => $req->get('id_jurusan'),
            'tgl_peminjaman' => $req->date('Y-m-d H:i:s'),
            'status' => 'Dipinjam',
            'tenggat' => $tenggat
        ]);
        if($save){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah Peminjaman']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah Peminjaman']);
        }
    }
    
    // update 
    public function updatepinjam(Request $req, $id){
        $validator = Validator::make($req->all(), [
            'id_buku' => 'required',
            'id_mahasiswa' => 'required',
            'id_jurusan' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = PinjamModel::where('id_peminjaman', $id)->update([
            'id_buku' => $req->get('id_buku'),
            'id_mahasiswa' => $req->get('id_mahasiswa'),
            'id_jurusan' => $req->get('id_jurusan'),
        ]);
        if($ubah){
            return Response()->json(['status'=>true,'message' => 'Sukses ubah Peminjaman']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal gagal Peminjaman']);
        }
    }


    // delete 
    public function deletpinjam($id)
    {
        $delete = PinjamModel::where('id_peminjaman', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses delet data peminjaman.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal delet data peminjaman.']);
        }
    }

    public function pengembalian($id){
        $tgl_kembali = Carbon::now();
        $kembali =PinjamModel::where('id_peminjaman',"=", $id)
        ->update([
            'status' => 'Dikembalikan',
            // 'judul_buku' => $req->get('judul_buku'),
            'tgl_kembali' => $tgl_kembali
        ]);
        if($kembali){
            return Response()->json(['status'=>true,'message' => 'Sukses ubah Peminjaman']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal gagal Peminjaman']);
        }
    }

}

//ohya