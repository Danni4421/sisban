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
    protected $primaryKey = 'id_keluarga';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_keluarga',
        'no_kk',
        'rt',
        'daya_listrik',
        'biaya_listrik',
        'biaya_air',
        'pengeluaran',
        'foto_kk',
        'is_kandidat',
        'bukti_biaya_listrik',
        'bukti_biaya_air',
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
     * Model relationship with kepala keluarga
     * 
     * @return hasOne
     */
    public function kepala_keluarga()
    {
        return $this->hasOne(Warga::class, 'no_kk', 'no_kk')->where('level', 'kepala_keluarga');
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

    /**
     * Verify is candidate
     * 
     * @return bool
     */
    public function is_candidate(string $no_kk)
    {
        $keluarga = $this->where('no_kk', $no_kk)->load('pengajuan')->first();


        if ($keluarga->is_kandidat) {
            return !$keluarga->pengajuan || $keluarga->pengajuan->status_pengajuan == "diterima";
        }

        return false;
    }
}
