<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;
    protected $table      = 'jurusan';
    protected $primarykey = 'id_jurusan';
    public $timestamps    = false;
    public $fillable      = ['nama_jurusan'];
}
