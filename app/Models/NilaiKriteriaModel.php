<?php

namespace App\Models;
use App\Models\KriteriaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'nilai_kriteria';
    protected $primaryKey = 'id'; // atau sesuaikan dengan primary key yang Anda tentukan

    protected $fillable = [
        'kode_kriteria',
        'keterangan',
        'nilai',
    ];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kode_kriteria', 'kode_kriteria');
    }
}
