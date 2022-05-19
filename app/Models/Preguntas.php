<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preguntas extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['desPregunta', 'activo', 'idExamen'];

    protected $searchableFields = ['*'];

    protected $table = 'tbl_preguntas';

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function examenes()
    {
        return $this->belongsTo(Examenes::class, 'idExamen');
    }

    public function allRespuestas()
    {
        return $this->belongsToMany(Respuestas::class, 'examenes_preguntas');
    }
}
