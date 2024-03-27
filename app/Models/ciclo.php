<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciclo extends Model
{
    use HasFactory;

    protected $table = 'ciclo';
    protected $fillable = ['id_ciclo', 'nombre_ciclo', 'inicio', 'fin'];


    public $timestamps = false;

    protected  $primaryKey = 'id_ciclo';

    public function  curso()
    {
        return $this ->hasMany(curso::class);
    }
}
