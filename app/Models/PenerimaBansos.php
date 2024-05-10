<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'id_bansos',
        'tanggal_penerimaan'
    ];

    /** 
     * Model relationship with warga
     * 
     * @return HasOne
     */
    public function warga()
    {
        return $this->hasOne(Warga::class, 'nik', 'nik');
    }

    /**
     * Model relationship with Bansos
     * 
     * @return HasOne
     */
    public function bansos()
    {
        return $this->hasOne(Bansos::class, 'id_bansos', 'id_bansos');
    }

    public static function getRecipientAmount()
    {
        return self::all()->count();
    }

    /**
     * @return int
     */
    public static function getRecipientAmountByRt(string $rt)
    {
        $recipientAmount = self::leftJoin('warga', 'warga.nik', '=', 'penerima_bansos.nik')
            ->leftJoin('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
            ->where('keluarga.rt', $rt)
            ->groupBy('keluarga.rt')
            ->select('keluarga.rt', DB::raw('COUNT(penerima_bansos.nik) as total'))
            ->first();

        return !is_null($recipientAmount) ? $recipientAmount->total : 0;
    }
}
