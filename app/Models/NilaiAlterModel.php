<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlterModel extends Model
{
    use HasFactory;

    protected $table = 'nilai_alter';
    protected $primaryKey = 'id_nilai_alter';
    protected $fillable = [
        'nama_alternatif',
        'c01',
        'c02',
        'c03',
        'c04',
        'c05',
        'c06',
    ];

    public function alternatif()
    {
        return $this->belongsTo(AlternatifModel::class, 'nama_alternatif', 'nama_alternatif');
    }
}
