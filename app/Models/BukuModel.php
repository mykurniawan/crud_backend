<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;
    protected $table      = 'buku';
    protected $primarykey = 'id_buku';
    public $timestamps    = false;
    public $fillable      = ['judul_buku', 'jenis_buku', 'pengarang'];
}
