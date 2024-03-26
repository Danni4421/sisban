<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aset extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'aset';

    /**
     * Primary key attribute
     * 
     * @var string
     */
    protected $primaryKey = 'id_aset';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kk',
        'nama_aset',
        'harga_jual',
        'tahun_beli'
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
}
