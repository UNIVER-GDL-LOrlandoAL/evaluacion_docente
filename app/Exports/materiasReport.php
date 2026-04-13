<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class materiasReport implements FromCollection,WithHeadings
{
  /**
  * @return \Illuminate\Support\Collection
  */

    public function headings(): array
    {
          return [
              'alumno_id',
              'nombres_alumno',
              'area',
              'carrera',
              'materia',
              'docente',
              'plantel',
              'grupo',
              'contestado_status',
              'correo_personal',
              'correo_principal',
              'curp',
              'telefono_casa',
              'celular'
              
          ];
    }
    public function collection()
    {
        ini_set('memory_limit', '9000M');
      
               
$results = DB::table('materias')
    ->select(
        'materias.alumno',
        'alumnos.nombre_completo',
        'alumnos.area',
        'alumnos.carrera',
        DB::raw('materias.descripcion as Materia'),
        'materias.docente',
        DB::raw('planteles.descripcion as plantel'),
        'materias.grupo',
           DB::raw("CASE 
            WHEN materias.contestada = 0 THEN 'No'
            WHEN materias.contestada = 1 THEN 'Si'
            ELSE 'Otro'
            END as contestada"),
        'alumnos.correop',
        'alumnos.correoi',
        'alumnos.curp',
        'alumnos.telefono',
        'alumnos.celular'
    )
    ->join('planteles', 'materias.plantel_id', '=', 'planteles.id')
    ->join('alumnos', 'materias.alumno', '=', 'alumnos.id_pwc')
    ->get();

                 



         return $results;

    }
}
