<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Mahasiswa extends Model
{
    // protected $fillable = [
    //     'NIM',
    //     'name',
    //     'tempat_lahir',
    //     'tanggal_lahir',
    //     'jurusan',
    //     'angkatan'
    // ];

    use HasUuids;

    protected $table = 'mahasiswas';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'NIM',
        'name',
        'jurusan',
    ];
}
