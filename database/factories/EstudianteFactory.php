<?php

namespace Database\Factories;

use App\Models\estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected  $modal = estudiante::class;

    public function definition()
    {
        return [
            'dni_estudiante' => $this->faker->unique()->numberBetween(10000000, 99999999), // Número de 8 dígitos
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'n_celular' => $this->faker->numberBetween(100000000, 999999999), // Número de 9 dígitos
            'direccion' => $this->faker->sentence(6),
            'colegio' => $this->faker->sentence(2), // Hasta 30 caracteres
            'sede' => $this->faker->sentence(2),
            'celular_apoderado' => $this->faker->numberBetween(100000000, 999999999), // Número de 9 dígitos
            'estado_de_pago' => $this->faker->randomElement(['pagado', 'pendiente']),
            'pago' => $this->faker->randomFloat(2, 0, 1000),
            'referencia' => $this->faker->sentence(5), // Hasta 70 caracteres
            'conducta' => 'excelente',
            'observacion' => $this->faker->sentence(2), // Hasta 255 caracteres
            'especialidad' => $this->faker->sentence(2), // Hasta 70 caracteres

            'foto' => $this->faker->imageUrl(640, 480, 'people'),
        ];
    }
}
