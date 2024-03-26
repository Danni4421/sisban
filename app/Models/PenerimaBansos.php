<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenerimaBansos extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'penerima_bansos';

    /**
     * Primary key attribute
     * 
     * @var array<int, string>
     */
    protected $primaryKey = [
        'nik',
        'id_bansos'
    ];

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'tanggal_penerimaan'
    ];

    /** 
     * Model relationship with warga
     * 
     * @return HasMany
     */
    public function penerima()
    {
        return $this->hasMany(Warga::class, 'nik', 'nik');
    }

    /**
     * Model relationship with Bansos
     * 
     * @return BelongsTo
     */
    public function bansos()
    {
        return $this->belongsTo(Bansos::class, 'id_bansos', 'id_bansos');
    }
}
