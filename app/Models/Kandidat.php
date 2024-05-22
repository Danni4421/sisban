<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'kandidat';

    /** @var string */
    protected $primaryKey = 'id_kandidat';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id_bansos',
        'nik'
    ];

    /**
     * Make model relationship with Kandidat Penerima (Warga)
     * 
     * @return BelongsTo
     */
    public function kandidat()
    {
        return $this->belongsTo(Warga::class, 'nik', 'nik');
    }

    /**
     * Make model relationship with Bansos
     * 
     * @return BelongsTo
     */
    public function bansos()
    {
        return $this->belongsTo(Bansos::class, 'id_bansos', 'id_bansos');
    }
}
