<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respuestas extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['idPregunta', 'desRespuesta', 'correcta', 'activo'];

    protected $searchableFields = ['*'];

    protected $table = 'tblrespuestas';

    protected $casts = [
        'correcta' => 'boolean',
        'activo' => 'boolean',
    ];

    public function allPreguntas()
    {
        return $this->belongsToMany(Preguntas::class, 'examenes_preguntas');
    }
}
