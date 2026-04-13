<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class resultadosReport implements FromCollection,WithHeadings
{
  /**
  * @return \Illuminate\Support\Collection
  */

    public function headings(): array
    {
          return [
              'sectionID',
              'docente',
              'grupo',
              'materia',
              'plantel',
              '¿El docente muestra un amplio conocimiento y dominio de los contenidos relacionados con la materia que imparte?',
              '¿Es capaz de explicar los conceptos de manera clara y comprensible para los estudiantes?',
              '¿El docente utiliza ejemplos relevantes y actualizados para ilustrar los temas y aplicaciones prácticas de la materia?',
              '¿El docente muestra pasión y entusiasmo por la materia?',
              '¿Cómo calificarías la facilidad del docente para resolver dudas y brindar retroalimentación?',
              '¿El docente se expresa con claridad y es fácil de entender tanto en el aula y/o en las plataformas en línea?',
              '¿El docente explicó de manera clara el objetivo del curso, temario, bibliografía, plazos de entregas, evaluaciones y tareas?',
              '¿El docente proporciona retroalimentación constructiva y oportuna sobre el desempeño académico de los estudiantes?',
              '¿El docente utiliza de manera efectiva las herramientas tecnológicas para mejorar el proceso de enseñanza y aprendizaje?',
              '¿El docente proporciona recursos y materiales adicionales que enriquezcan el aprendizaje (lecturas, videos, ejercicios, etc.)?',
              '¿El docente presenta los contenidos de manera clara y estructurada en ambos formatos ya sea (presencial y/o en línea)?',
              '¿El docente fomenta la participación activa y el debate en clase, ya sea en persona o mediante foros y discusiones en línea?',
              '¿Cómo calificarías la capacidad del docente para adaptarse a los desafíos y cambios que implica el modelo Live Digital Education?',
              'El docente demuestra empatía y comprensión hacia las necesidades de los estudiantes en ambos entornos (presencial y/o en línea)?',
              '¿El docente fomenta el trabajo colaborativo y la interacción entre los estudiantes, ya sea en clase o mediante herramientas en línea?',
              '¿El docente ofrece retroalimentación sobre el progreso general de la clase y toma medidas para mejorar la experiencia de aprendizaje?',
              '¿El docente muestra respeto y empatía hacia todos los estudiantes, sin importar sus diferencias o habilidades?',
              '¿El docente trata a los estudiantes de manera justa y equitativa, proporcionando igualdad de oportunidades para el aprendizaje?',
              '¿El docente actúa de manera ética y profesional en todas sus interacciones con los estudiantes y colegas?',
              '¿El docente demuestra compromiso con la integridad académica y evita prácticas deshonestas o fraudulentas?',
              '¿El docente acude siempre a la clase, de manera puntual y usa la plataforma?',
              '¿El docente sube la información de la clase a la plataforma (video de presentación, semblanza, carta descriptiva, ligas de conexión y grabación de las sesiones) y si la clase es presencial también se presenta en el aula?',
              '¿El docente cumple con el 100% del programa, de acuerdo con el temario y carta descriptiva?',
              '¿El docente evalúa en tiempo y forma, y registra las calificaciones en plataforma?',
              '¿El docente te brinda retroalimentación de las calificaciones?',
              'total',
              'observaciones'

          ];
    }
    public function collection()
    {
        ini_set('memory_limit', '3000M');


$results = DB::table('evaluacion_contestadas')
    ->select(
        'materias.section_id',
        'evaluacion_contestadas.docente',
        'evaluacion_contestadas.grupo',
        'materias.descripcion',
        DB::raw('planteles.descripcion as plantel'),
        'evaluacion_contestadas.pregunta1',
        'evaluacion_contestadas.pregunta2',
        'evaluacion_contestadas.pregunta3',
        'evaluacion_contestadas.pregunta4',
        'evaluacion_contestadas.pregunta5',
        'evaluacion_contestadas.pregunta6',
        'evaluacion_contestadas.pregunta7',
        'evaluacion_contestadas.pregunta8',
        'evaluacion_contestadas.pregunta9',
        'evaluacion_contestadas.pregunta10',
        'evaluacion_contestadas.pregunta11',
        'evaluacion_contestadas.pregunta12',
        'evaluacion_contestadas.pregunta13',
        'evaluacion_contestadas.pregunta14',
        'evaluacion_contestadas.pregunta15',
        'evaluacion_contestadas.pregunta16',
        'evaluacion_contestadas.pregunta17',
        'evaluacion_contestadas.pregunta18',
        'evaluacion_contestadas.pregunta19',
        'evaluacion_contestadas.pregunta20',
        'evaluacion_contestadas.pregunta21',
        'evaluacion_contestadas.pregunta22',
        'evaluacion_contestadas.pregunta23',
        'evaluacion_contestadas.pregunta24',
        'evaluacion_contestadas.pregunta25',
        'evaluacion_contestadas.total',
        'evaluacion_contestadas.observaciones'
    )
    ->join('planteles', 'evaluacion_contestadas.plantel_id', '=', 'planteles.id')
    ->join('materias', 'evaluacion_contestadas.materia', '=', 'materias.id')
    ->get();






         return $results;

    }
}
