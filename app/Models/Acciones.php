<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acciones extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['desAccion', 'activo', 'bitacora_id'];

    protected $searchableFields = ['*'];

    protected $table = 'tblacciones';

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function bitacora()
    {
        return $this->belongsTo(Bitacora::class);
    }
}
