<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App\Http\AreaAcademicaController;

class area_academica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'area_academica';

    protected $fillable = ['id_area' , 'nombre_area'];
    protected  $primaryKey = 'id_area';

    public function estudiante()
    {
        return $this -> hasMany(estudiante::class);
    }
    public function carrera()
    {
        return $this -> hasMany(carrera::class);
    }
    public function curso()
    {
        return $this->belongsToMany(curso::class, 'area_academica_curso', 'area_id', 'curso_id');
    }

}
