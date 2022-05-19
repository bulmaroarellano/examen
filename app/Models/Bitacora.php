<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bitacora extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['idUsuario', 'idAccion', 'observaciones'];

    protected $searchableFields = ['*'];

    protected $table = 'tblbitacoras';

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function allAcciones()
    {
        return $this->hasMany(Acciones::class);
    }
}
