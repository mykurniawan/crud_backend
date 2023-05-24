<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamModel extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primarykey = 'id_peminjaman';
    // public $timestamp = false;
    public $timestamps    = false;

    protected $fillable = [
        'id_buku', 'id_mahasiswa','id_jurusan', 'tgl_peminjaman','status' ,'tenggat'
    ];
}
