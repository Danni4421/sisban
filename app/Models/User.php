<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * Table model
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * Primary key attribute
     * 
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Model relationship with Pengurus like ['rt', 'rw', 'admin']
     * 
     * @return HasOne
     */
    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'id_user', 'id_user');
    }

    /**
     * Model relationship with Kepala Keluarga for authentication
     */
    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_user', 'id_user');
    }
}
