<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota_fast extends Model
{
    use HasFactory;

    protected $table = 'notafasttest';

    public $timestamps = false;

    protected $fillable = ['id_nota_fast','nota','fecha','estudiante_dni_estudiante'];

    protected $primaryKey = 'id_nota_fast';

    public function estudiante()
    {
        return $this -> belongsTo(estudiante::class);
    }
}

