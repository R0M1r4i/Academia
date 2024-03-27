<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\sabado;
use App\Models\usuario;

class SabadoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(usuario $usuario): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(usuario $usuario, sabado $sabado): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(usuario $usuario): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(usuario $usuario, sabado $sabado): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(usuario $usuario, sabado $sabado): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, sabado $sabado): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, sabado $sabado): bool
    {
        //
    }
}
