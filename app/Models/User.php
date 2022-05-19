<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'login',
        'password',
        'email',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'tblusuarios';

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'idUsuario');
    }

    public function allExamenes()
    {
        return $this->hasMany(Examenes::class, 'idUsuario');
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
