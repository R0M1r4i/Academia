<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especialidad extends Model
{

    use HasFactory;

    protected  $table = 'especialidad';

    protected $fillable = ['id_especialidad', 'nombre'];

    protected $primaryKey  = 'id_especialidad';

    public $timestamps = false;

    public function estudiante()
    {
        return $this->hasMany(estudiante::class);
    }




}
