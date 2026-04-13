<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class coordinadorReport implements FromCollection,WithHeadings
{
  /**
  * @return \Illuminate\Support\Collection
  */

    public function headings(): array
    {
          return [
            'Coordinador',
            'Puntos Coordinador',
            'Comentarios Coordinador',
            'mentor',
            'Puntos Mentor',
            'Comentarios Mentor',
            'Carrera',
            'Grado',
            'plantel'
          ];
    }
    public function collection()
    {
        ini_set('memory_limit', '900M');


$results = DB::table('resultados_mentor_coordina')
    ->select(
        'planteles.coordinador as coordinardo_name',
        'resultados_mentor_coordina.coordinador',
        'porCoor',
        'planteles.mentor as mentor_name',
        'resultados_mentor_coordina.mentor',
        'porMentor',
        'alumnos.carrera',
        'grados.descripcion',
        'resultados_mentor_coordina.plantel_id'

    )->join('alumnos', 'resultados_mentor_coordina.alumno_id', '=', 'alumnos.id_pwc')
    ->join('grados', 'alumnos.grado_id', '=', 'grados.id')
    ->leftJoin('planteles', 'resultados_mentor_coordina.plantel_id', '=', 'planteles.descripcion')
    ->orderBy('resultados_mentor_coordina.coordinador', 'ASC')
    ->get();





         return $results;

    }
}
