<?php

namespace App\Console;

use App\Models\asistencia;
use App\Models\estudiante;
use App\Models\sabado;
use App\Models\ciclo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            date_default_timezone_set('America/Lima');

            $fecha_actual = date('Y-m-d');

            // Obtiene el día de la semana (0 para domingo, 6 para sábado)
            $dia_semana = date('w');

            // Obtiene el último ciclo registrado
            $ultimo_ciclo = ciclo::orderBy('id_ciclo', 'desc')->first();

            // Si no hay un ciclo registrado, no se registra la asistencia
            if (!$ultimo_ciclo) {
                return "No hay un ciclo registrado, no se registra la asistencia";
            }

            // Si la fecha actual es anterior al inicio del ciclo o posterior al fin del ciclo, no se registra la asistencia
            if ($fecha_actual < $ultimo_ciclo->inicio || $fecha_actual > $ultimo_ciclo->fin) {
                return "La fecha actual está fuera del ciclo registrado, no se registra la asistencia";
            }

            // Obtiene todos los estudiantes registrados en el último ciclo
            $estudiantes = estudiante::where('ciclo_id_ciclo', $ultimo_ciclo->id_ciclo)->get();

            // Si el día es domingo, no se registra la asistencia
            if ($dia_semana == 0) {

                return "Hoy es domingo, no se registra la asistencia";
            }

            // Para los sábados, verifica si el sábado actual es un día de asistencia
            if ($dia_semana == 6) {
                $sabado_asistencia = sabado::where('fecha', $fecha_actual)->first();
                if (!$sabado_asistencia) {

                    return "Este sábado no se registra la asistencia";
                }
            }

            foreach ($estudiantes as $estudiante) {
                // Verifica si el estudiante ya tiene un registro de asistencia para el día actual
                $registro_asistencia = asistencia::where('estudiante_dni', $estudiante->dni_estudiante)
                    ->where('fecha', $fecha_actual)
                    ->first();

                if (!$registro_asistencia) {
                    // Si no existe un registro de asistencia, se crea uno con valor 'inasistencia'
                    $asistencia = asistencia::create([
                        'valor_asistencia' => 'inasistencia',
                        'estudiante_dni' => $estudiante->dni_estudiante,
                        'hora' => null,
                        'fecha' => $fecha_actual,
                    ]);
                }
            }

            return "Validación de asistencias completada";

        })->everyMinute();
    }



    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}
