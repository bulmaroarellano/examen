<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examenes extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['idUsuario', 'numPreguntas'];

    protected $searchableFields = ['*'];

    protected $table = 'tblexamenes';

    public function allPreguntas()
    {
        return $this->hasMany(Preguntas::class, 'idExamen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
