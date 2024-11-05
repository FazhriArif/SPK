<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_alternatif', 
        'nama_alternatif'
    ];

    public static function boot()
    {
        parent::boot();

        static::updated(function ($alternatif) {
            DB::table('nilai_alter')
                ->where('nama_alternatif', $alternatif->getOriginal('nama_alternatif'))
                ->update(['nama_alternatif' => $alternatif->nama_alternatif]);
        });
    }
}
