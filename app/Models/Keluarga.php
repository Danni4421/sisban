<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Keluarga extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'keluarga';

    /**
     * Primary key attribute
     * 
     * @var string
     */
    protected $primaryKey = 'no_kk';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'rt',
        'daya_listrik',
        'biaya_listrik',
        'biaya_air',
        'hutang',
        'pengeluaran',
        'foto_kk'
    ];

    /**
     * Model relationship with Anggota Keluarga
     * 
     * @return HasMany
     */
    public function anggota_keluarga()
    {
        return $this->hasMany(Warga::class, 'no_kk', 'no_kk');
    }

    /**
     * Model relationship with Aset
     * 
     * @return HasMany
     */
    public function aset()
    {
        return $this->hasMany(Aset::class, 'no_kk', 'no_kk');
    }

    /**
     * Model relationship with Pengajuan
     * 
     * @return HasOne
     */
    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'no_kk', 'no_kk');
    }
}
