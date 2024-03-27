<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    use HasFactory;
    protected $table = 'carrera';

    protected $fillable = ['id_carrera', 'nombre_carrera', 'area_academica_id_area'];

    protected $primaryKey = 'id_carrera';

    public  $timestamps = false;

    public function area_academica()
    {
        return $this -> belongsTo(area_academica::class);
    }

    public function estudiante()
    {
        return $this ->  hasMany(estudiante::class);
    }
}
