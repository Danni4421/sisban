<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     *  @var string
     */
    protected $table = 'notification';

    /**
     * Primary key attribute
     * 
     *  @var string
     */
    protected $primaryKey = 'no_kk';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kk',
        'is_readed_rt',
        'is_readed_rw',
    ];

    /**
     * Model relationship with Pengajuan
     * 
     * @return BelongsTo
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'no_kk', 'no_kk');
    }
}
