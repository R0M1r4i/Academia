<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    use HasFactory;

    protected  $table = 'horario';

    protected $fillable = ['id', 'h_inicio', 'h_final','nombre'];

    protected $primaryKey  = 'id';

    public $timestamps = false;

    public function estudiante()
    {
        return $this->hasMany(estudiante::class);
    }
}
