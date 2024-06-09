<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hutang extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'hutang';

    /** @var string */
    protected $primaryKey = 'id_hutang';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id_hutang',
        'no_kk',
        'jumlah',
        'keterangan',
        'bukti_hutang',
    ];

    /**
     * Make relationship with Keluarga
     * 
     * @return HasOne
     */
    public function has_debtor()
    {
        return $this->hasOne(Keluarga::class, 'no_kk', 'no_kk');
    }
}
