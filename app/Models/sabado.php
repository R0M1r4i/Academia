<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sabado extends Model
{
    use HasFactory;

    protected  $table = 'sabado';

    protected $fillable = ['id_sabado', 'fecha'];

    protected  $primaryKey = 'id_sabado';

    public $timestamps = false;


}
