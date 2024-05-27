<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'alternative';

    /** @var string */
    protected $primaryKey = 'id_alternative';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id_alternative',
        'id_bansos',
        'no_kk',
        'is_qualified'
    ];

    /**
     * Make model relationship with Kandidat Penerima (Warga)
     * 
     * @return BelongsTo
     */
    public function kandidat()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
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
