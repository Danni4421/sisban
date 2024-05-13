<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'pengajuan';

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
        'no_kk',
        'status_pengajuan',
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

    /**
     * Model relationship with Keluarga
     * 
     * @return HasOne
     */
    public function notification()
    {
        return $this->hasOne(Notification::class, 'no_kk', 'no_kk');
    }

    public static function getIncomingDataAmount()
    {
        return self::leftJoin('keluarga', 'keluarga.no_kk', '=', 'pengajuan.no_kk')
            ->select('keluarga.rt', DB::raw('COUNT(pengajuan.no_kk) as total'))
            ->groupBy('keluarga.rt')
            ->get();
    }

    public static function getAllSentedDataAmount()
    {
        return self::leftJoin('keluarga', 'keluarga.no_kk', '=', 'pengajuan.no_kk')
            ->where('is_printed', 1)
            ->select('keluarga.rt', DB::raw('COUNT(pengajuan.no_kk) as total'))
            ->groupBy('keluarga.rt')
            ->get();
    }

    public static function getAllAcceptantAmount()
    {
        return self::leftJoin('keluarga', 'keluarga.no_kk', '=', 'pengajuan.no_kk')
            ->where('status_pengajuan', 'diterima')
            ->select('keluarga.rt', DB::raw('COUNT(pengajuan.no_kk) as total'))
            ->groupBy('keluarga.rt')
            ->get();
    }

    public static function getAcceptantAmountPerRt()
    {
        return self::leftJoin('keluarga', 'keluarga.no_kk', '=', 'pengajuan.no_kk')
            ->where('status_pengajuan', 'diterima')
            ->select('keluarga.rt', DB::raw('COUNT(pengajuan.no_kk) as total'))
            ->groupBy('keluarga.rt')
            ->orderBy('keluarga.rt')
            ->get();
    }
}
