<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'faq';

    /**
     * @var string
     */
    protected $primaryKey = 'id_faq';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'pertanyaan',
        'jawaban',
        'is_solved'
    ];

    /**
     * Model relationship with User
     * 
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
