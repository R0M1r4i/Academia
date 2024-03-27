<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';

    protected $fillable = ['id_asistencia', 'valor_asistencia', 'estudiante_dni','docente_dni','fecha','hora'];

    protected $primaryKey = 'id_asistencia';

    public $timestamps = false;

    public function estudiante()
    {
        return $this -> belongsTo(estudiante::class);
    }

    public function docente()
    {
        return $this ->belongsTo(docente::class);
    }



}
