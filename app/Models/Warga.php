<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'warga';

    /**
     * Primary key attribute
     * 
     * @var string
     */
    protected $primaryKey = 'nik';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kk',
        'nama',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'umur',
        'no_hp',
        'pekerjaan',
        'penghasilan',
        'level',
        'foto_ktp'
    ];

    /**
     * Model relationship with Keluarga
     * 
     * @return BelongsTo
     */
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }

    public function bansos()
    {
        return $this->hasMany(PenerimaBansos::class, 'nik', 'nik');
    }
}
