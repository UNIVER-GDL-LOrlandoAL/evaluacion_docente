<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class npsReport implements FromCollection,WithHeadings
{
  /**
  * @return \Illuminate\Support\Collection
  */

    public function headings(): array
    {
          return [
              'recomienda_univer',
              'comentarios',
              'Carrera',
              'Grado',
              'plantel'
              
              
          ];
    }
    public function collection()
    {
        ini_set('memory_limit', '900M');
      
               
$results = DB::table('nps')
    ->select(
        'recomienda_univer',
        'comentarios',
        'alumnos.carrera',
        'grados.descripcion',
        'nps.plantel_id'
       
    )->join('alumnos', 'nps.alumno_id', '=', 'alumnos.id_pwc')
    ->join('grados', 'alumnos.grado_id', '=', 'grados.id')
    ->get();

                 



         return $results;

    }
}
