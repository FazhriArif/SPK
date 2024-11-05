<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HasilModel extends Model
{
    use HasFactory;

    protected $table = 'hasil';
    protected $fillable = [
        'nama_produk', 'rekom_alter', 'waktu_penyimpanan'
    ];
    protected $dates = ['waktu_penyimpanan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->waktu_penyimpanan = Carbon::now();
        });
    }
}
