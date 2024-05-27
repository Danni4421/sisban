<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bansos extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'bansos';

    /**
     * Primary key attribute
     * 
     * @var string
     */
    protected $primaryKey = 'id_bansos';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_bansos',
        'keterangan',
        'jumlah'
    ];

    /**
     * Model relationship with Penerima Bansos
     * 
     * @return HasMany
     */
    public function penerima()
    {
        return $this->hasMany(PenerimaBansos::class, 'id_bansos', 'id_bansos');
    }

    /**
     * Model relationship with alternative
     * 
     * @return HasMany
     */
    public function alternative()
    {
        return $this->hasMany(Alternative::class, 'no_kk', 'no_kk');
    }
}
