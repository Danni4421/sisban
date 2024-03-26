<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenerima extends Model
{
    use HasFactory;

    /**
     * Table model
     * 
     *  @var string
     */
    protected $table = 'kriteria_penerima';

    /**
     * Primary key attribute
     * 
     *  @var string
     */
    protected $primaryKey = 'id_kriteria';

    /**
     * Fillable attribute
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kriteria',
        'bobot'
    ];
}
