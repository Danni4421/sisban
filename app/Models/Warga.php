<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'nik',
        'id_user',
        'no_kk',
        'nama',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'umur',
        'no_hp',
        'penghasilan',
        'level',
        'foto_ktp',
        'slip_gaji',
    ];

    /**
     * @return HasOne
     */
    public function account()
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

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
