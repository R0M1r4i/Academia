<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota_eta extends Model
{
    use HasFactory;

    protected $table = 'notaeta';

    public  $timestamps = false;
    protected  $fillable= ['id_nota_eta','nota','fecha','estudiante_dni_estudiante' ];

    protected  $primaryKey = 'id_nota_eta';

    public  function estudiante()
    {
        return $this -> belongsTo(estudiante::class);
    }


}
