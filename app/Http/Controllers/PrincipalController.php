<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Materias;
use App\Models\Preguntas;
use Illuminate\Http\Request;
use App\Models\Respuestas;
use App\Models\User;
use App\Models\Nps;
use App\Models\AlumnosGrupos;
use App\Models\ResultadosMentorCoordina;
use App\Models\Alumnos;
use Illuminate\Support\Facades\Hash;
use App\Models\EvaluacionContestada;
use App\Exports\resultadosReport;
use App\Exports\materiasReport;
use App\Exports\coordinadorReport;
use App\Exports\npsReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Models\Planteles;

class PrincipalController extends Controller
{
    public function index()
    {
        $materias = DB::table('alumnos')
        ->leftjoin('alumnos_grupos', function ($join){
            $join->on('alumnos_grupos.alumno_id', '=', 'alumnos.id');
        })
         ->leftjoin('materias', function ($join){
            $join->on('materias.grupo', '=', 'alumnos_grupos.grupo');
        })
            ->where('materias.alumno',Auth::user()->username)
         ->select('materias.descripcion','materias.docente AS docente','materias.contestada','materias.id')
            ->distinct()
         ->get();

        $materiasContestadas = Materias::where('alumno',Auth::user()->username)->where('contestada' , 1)->count();
        $materiasAContestar = Materias::where('alumno',Auth::user()->username)->where('contestada' , 0)->count();
        $EvaluaContestadas = ResultadosMentorCoordina::where('alumno_id',Auth::user()->username)->first();
        $npsContestadas = Nps::where('alumno_id',Auth::user()->username)->first();

        $finalizo = 0;
        if ($materias->count() == $materiasContestadas)
        {
            $finalizo = 1;
        }
        return view('dashboard',compact('materias','finalizo','EvaluaContestadas','npsContestadas'));
    }
    public function store(Request $request)
    {
        $resultados = new ResultadosMentorCoordina();
        $resultados->coordinador = $request->coordinador;
        $resultados->porCoor = $request->porCoordi;
        $resultados->mentor = $request->mentor;
        $resultados->porMentor = $request->porMentor;
        $resultados->plantel_id = auth()->user()->alumno->plantel->descripcion;
        $resultados->alumno_id = auth()->user()->username;
        $resultados->save();
        return redirect('principal');

    }

    /**
    * Muestra la vista con la evaluación de los mentores y coordinadores del alumno.
    *
    * *[Actualización 26/06/2026 - OrlandoAL]
    * - Se modificó la lógica para soportar el manejo de múltiples mentores y coordinadores.
    * - El método ahora consulta la base de datos utilizando el 'plantel_id' y 'grupo_id'
    *    del alumno autenticado para diferenciar y obtener al personal académico correspondiente.
    * - Incluye una validación de respaldo (fallback) para asignar al coordinador general
    *    del plantel en caso de no existir uno asignado específicamente al grupo.
    *
    * @param  int  $id
    * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    */
    public function show($id)
    {
        $user = Auth::user();
        $username = $user->username;

        $plantel_id = DB::table('alumnos')->where('id_pwc', $username)->value('plantel_id');
        $grupo_id = DB::table('alumnos_grupos')->where('id_pwc', $username)->value('grupo_id');

        if (!$plantel_id) {
            return redirect()->back()->with('error', 'No se encontró la información del plantel para este usuario.');
        }
        $coordinadores = DB::table('mentores_coordinadores')
            ->where('plantel_id', $plantel_id)
            ->where('grupo_id', $grupo_id)
            ->where('isCoordinador', 1)
            ->get();

        if ($coordinadores->isEmpty()) {
            $coordinadores = DB::table('mentores_coordinadores')
                ->where('plantel_id', $plantel_id)
                ->where('grupo_id', '999999')
                ->where('isCoordinador', 1)
                ->get();
        }

        $mentores = DB::table('mentores_coordinadores')
            ->where('plantel_id', $plantel_id)
            ->where('grupo_id', $grupo_id)
            ->where('isMentor', 1)
            ->get();

        return view('evaluarMentor', compact('coordinadores', 'mentores'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$preguntas = DB::table('preguntas')
            ->leftjoin('respuestas', function ($join){
            $join->on('preguntas.id', '=', 'respuestas.pregunta_id');
        })->select('preguntas.descripcion AS pregunta','respuestas.descripcion AS respuesta',
                'respuestas.puntos','preguntas.id AS preguntaID','respuestas.id AS respuestaID','respuestas.pregunta_id')
            ->get();
        */

        $respuestas = new Respuestas();
        $respuestas = $respuestas->all();
        $preguntas = new Preguntas();
        $preguntas = $preguntas->all();



        $docente = DB::table('materias')
            ->leftjoin('docentes', function ($join){
            $join->on('docentes.nombre_completo', '=', 'materias.docente');
        })
            ->select('docentes.nombre_completo','materias.descripcion','materias.id','materias.contestada')
            ->where('materias.id',$id)->first();

        if($docente->contestada == 1)
        {
            return redirect('principal');
        }
        else
        {
            return view('evaluar',compact('preguntas','docente','respuestas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'pregunta1' => 'required','pregunta2' => 'required','pregunta3' => 'required','pregunta4' => 'required','pregunta5' => 'required',
            'pregunta6' => 'required','pregunta7' => 'required','pregunta8' => 'required','pregunta9' => 'required','pregunta10' => 'required',
            'pregunta11' => 'required','pregunta12' => 'required','pregunta13' => 'required','pregunta14' => 'required','pregunta15' => 'required',
            'pregunta16' => 'required','pregunta17' => 'required','pregunta18' => 'required','pregunta19' => 'required','pregunta20' => 'required',
            'pregunta21' => 'required','pregunta22' => 'required','pregunta23' => 'required','pregunta24' => 'required', 'pregunta25' => 'required',
            'observaciones' => 'required'
        ]);

        $materias = Materias::find($id);
        $resultados = new EvaluacionContestada();
        $resultados ->pregunta1 = $request->pregunta1;
        $resultados ->pregunta2 = $request->pregunta2;
        $resultados ->pregunta3 = $request->pregunta3;
        $resultados ->pregunta4 = $request->pregunta4;
        $resultados ->pregunta5 = $request->pregunta5;
        $resultados ->pregunta6 = $request->pregunta6;
        $resultados ->pregunta7 = $request->pregunta7;
        $resultados ->pregunta8 = $request->pregunta8;
        $resultados ->pregunta9 = $request->pregunta9;
        $resultados ->pregunta10 = $request->pregunta10;
        $resultados ->pregunta11 = $request->pregunta11;
        $resultados ->pregunta12 = $request->pregunta12;
        $resultados ->pregunta13 = $request->pregunta13;
        $resultados ->pregunta14 = $request->pregunta14;
        $resultados ->pregunta15 = $request->pregunta15;
        $resultados ->pregunta16 = $request->pregunta16;
        $resultados ->pregunta17 = $request->pregunta17;
        $resultados ->pregunta18 = $request->pregunta18;
        $resultados ->pregunta19 = $request->pregunta19;
        $resultados ->pregunta20 = $request->pregunta20;
        $resultados ->pregunta21 = $request->pregunta21;
        $resultados ->pregunta22 = $request->pregunta22;
        $resultados ->pregunta23 = $request->pregunta23;
        $resultados ->pregunta24 = $request->pregunta24;
        $resultados ->pregunta25 = $request->pregunta25;
        $resultados ->alumno_id = Auth::user()->id;
        $resultados ->plantel_id = $materias->plantel_id;
        $resultados ->grupo	 = $materias->grupo;
        $resultados ->materia	 = $materias->id;
        $resultados ->docente = $materias->docente;
        $resultados ->total = $request->pregunta1 + $request->pregunta2 + $request->pregunta3 + $request->pregunta4 + $request->pregunta5 + $resultados ->pregunta6 +$request->pregunta7 +
        $request->pregunta8 + $request->pregunta9 + $request->pregunta10 + $request->pregunta11 + $resultados ->pregunta12 + $resultados ->pregunta13 + $resultados ->pregunta14 + $resultados ->pregunta15 +
        $request->pregunta16 + $request->pregunta17 + $request->pregunta18 + $request->pregunta19 + $resultados ->pregunta20 + $resultados ->pregunta21 + $resultados ->pregunta22 + $resultados ->pregunta23+ $resultados ->pregunta24+ $resultados ->pregunta25;
        $resultados ->observaciones = $request->observaciones;
        $resultados ->save();

        $materias ->contestada = 1;
        $materias ->save();


        return redirect('principal');
    }

    public function CrearUsuarios()
    {

        $targetUserCount = 9000;
        $lockKey = 'crear_usuarios_maestros_lock_2';
        $lockTimeout = 3600;

        // $alumnos = new Alumnos();
        // $alumnos = $alumnos->where('id','>=','1')->where('id','<=','6965')->get();

        $alumnos = Alumnos::orderBy('id', 'asc')
                        ->limit($targetUserCount)
                        ->get();

        $createdCount = 0;

        // foreach ($alumnos as  $alumno)
        // {
        //     $existingUser = User::where('alumno_id', $alumno->id)->first();
        //     if (!$existingUser) {
        //     $usuario = new User();
        //     $usuario->name = $alumno->nombre_completo;
        //     $usuario->username = $alumno->id_pwc;
        //     $usuario->email = $alumno->id_pwc."@alumnos.univer-gdl.edu.mx";
        //     $usuario->password =Hash::make($alumno->curp);
        //     $usuario->alumno_id = $alumno->id;
        //     $usuario->save();
        //
        //    }
        //
        // }
        // return "Listo";

        if (Cache::lock($lockKey, $lockTimeout)->get())
        {
            try {
                $alumnos = Alumnos::orderBy('id', 'asc')
                                    ->limit($targetUserCount)
                                    ->get();

                $createdCount = 0;

                foreach ($alumnos as $alumno)
                {
                    try {
                        $usuario = new User();
                        $usuario->name = $alumno->nombre_completo;
                        $usuario->username = $alumno->id_pwc;
                        $usuario->email = $alumno->id_pwc . "@alumnos.univer-gdl.edu.mx";
                        $usuario->password = Hash::make($alumno->curp);
                        $usuario->alumno_id = $alumno->id;
                        $usuario->save();
                        $createdCount++;
                    } catch (\Illuminate\Database\QueryException $e) {

                        if ($e->getCode() == 23000) {

                        } else {
                            throw $e;
                        }
                    }
                }
                return "Proceso de creación de usuarios desde cero completado. Se crearon " . $createdCount . " usuarios nuevos.";
            } finally {
                Cache::lock($lockKey, $lockTimeout)->release();
            }
        } else {
            return "El proceso de creación de usuarios ya está en curso. Por favor, inténtalo de nuevo más tarde.";
        }

    }

    public function AgregarIds()
    {
        $alumnos = new AlumnosGrupos();
        $alumnos = $alumnos->whereNull('alumno_id')->get();
        $alumnos = $alumnos->whereNull('alumno_id')->get();

        foreach ($alumnos as $alumno)
        {

            $cambio = AlumnosGrupos::where('id_pwc',$alumno->id_pwc)->get();
            $cambio = AlumnosGrupos::where('id_pwc',$alumno->id_pwc)->get();
            foreach ($cambio as $cambio){
                $usuario = Alumnos::where('id_pwc',$cambio->id_pwc)->first();
                $usuario = Alumnos::where('id_pwc',$cambio->id_pwc)->first();
                $cambio->alumno_id = $usuario->id;
                $cambio->save();
            }

        }
        $this->AgregarIdsGrupos();
        return "Listo";


    }
    public function AgregarIdsGrupos()
    {
        $alumnos = new AlumnosGrupos();
        $alumnos = $alumnos->whereNull('grupo_id')->get();
        foreach ($alumnos as $alumno)
        {

            $cambio = AlumnosGrupos::whereNull('grupo_id')->get();
            $cambio = AlumnosGrupos::whereNull('grupo_id')->get();
            foreach ($cambio as $cambio){
                $usuario = Grupos::where('descripcion',$cambio->grupo)->first();
                //dd($cambio);
                //dd($cambio);
                $cambio->grupo_id = $usuario->id;
                $cambio->save();
            }

        }
        return "Listo";

    }

    public function reportes($id)
    {
        if($id == 1)
        {
            return Excel::download(new resultadosReport(), 'resultadoReport.xlsx');
        }
        else if($id == 2)
        {
            return Excel::download(new materiasReport(), 'materiasReport.xlsx');
        }
        else if ($id == 3)
        {
            return Excel::download(new coordinadorReport(), 'coordinadorMentorReport.xlsx');
        }
        else if ($id == 4)
        {
            return Excel::download(new npsReport(), 'npsReport.xlsx');
        }
    }

    public function nps($id)
    {
        return view ('nps');
    }
    public function npsStore(Request $request)
    {

        $resultados = new Nps();
        $resultados->recomienda_univer = $request->puntos;
        $resultados->comentarios = $request->porque;
        $resultados->plantel_id = auth()->user()->alumno->plantel->descripcion;
        $resultados->alumno_id = auth()->user()->username;
        $resultados->save();
        return redirect('principal');

    }


}
