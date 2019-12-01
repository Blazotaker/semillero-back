<?php

namespace App\Http\Controllers;

use App\Semillero;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Coordinador;

class SemilleroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $semillero = Semillero::select(
                'semilleros.id_semillero',
                'semilleros.siglas as siglas_semillero',
                'semilleros.semillero',
                'semilleros.objetivo',
                'semilleros.descripcion',
                'semilleros.id_grupo',
                'grupos.siglas',
                'grupos.grupo',
                'grupos.id_categoria',
                'grupos.id_facultad',
                'grupos.cod_colciencias'
            )
                ->join('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                // ->join('facultades','facultades.id_facultad','semilleros.id_facultad')
                ->get();
            if ($semillero->isEmpty()) {
                return response()->json('', 204);
            } else {

                return $semillero;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function indexAvailable()
    {
        try {
            $grupo = Semillero::select('semilleros.id_semillero', 'semilleros.semillero', 'semilleros.siglas')
                ->leftJoin('coordinadores', 'coordinadores.id_semillero', 'semilleros.id_semillero')
                ->where('coordinadores.id_coordinador', null)
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {
                return ($grupo);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function indexPublico()
    {
        try {
            $semillero = Semillero::select(
                'semilleros.id_semillero',
                'semilleros.siglas as semillero_sigla',
                'semilleros.semillero',
                'semilleros.id_grupo',
                'semilleros.objetivo',
                'semilleros.descripcion',
                'grupos.siglas as grupo_sigla',
                'grupos.id_facultad',
                'facultades.facultad',
                'usuarios.nombre_usuario',
                'usuarios.apellido_usuario',
                'usuarios.email',
                'usuarios.telefono'
            )

                /* ->leftJoin('categorias', 'categorias.id_categoria', 'grupos.id_categoria') */
                ->leftJoin('coordinadores', 'coordinadores.id_semillero', 'semilleros.id_semillero')
                ->leftJoin('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
                ->leftJoin('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                ->leftJoin('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->get();
            if ($semillero->isEmpty()) {
                return response()->json('', 204);
            } else {

                return ($semillero);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $semillero = Semillero::where('semillero', $request->semillero)->get();
            if (!$semillero->isEmpty()) {
                return response()->json('', 221);
            } else {

                Semillero::create($request->all());
                return response()->json('El semillero ha sido creado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $semillero = Semillero::where('id_semillero', $id)
                ->join('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                ->get();
            if ($semillero->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $semillero;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function showPorGrupos($id)
    {
        try {
            $semillero = Semillero::select("id_semillero", "semillero", "objetivo", "descripcion", "semilleros.siglas")->where('semilleros.id_grupo', $id)
                ->join('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                ->get();
            if ($semillero->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $semillero;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $semillero = Semillero::find($id);
            if ($semillero == null) {
                return response()->json('', 204);
            } else {
                return $semillero;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $semillero = Semillero::where('id_semillero', $id)->get();
            if ($semillero->isEmpty()) {
                return response()->json('', 204);
            } else {
                Semillero::where('id_semillero', $id)->update($request->all());
                return response()->json("Semillero actualizado");;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $semillero = Semillero::where('id_semillero', $id)->get();
            if ($semillero->isEmpty()) {
                return response('', 204);
            } else {
                Semillero::where('id_semillero', $id)->delete();
                return response()->json("Semillero eliminado");;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }

    public function solicitud(Request $request)
    {

        $data = $request;

        try {
            $coordinador = Coordinador::select('usuarios.nombre_usuario', 'usuarios.apellido_usuario', 'semilleros.semillero', 'usuarios.email', 'semilleros.siglas')
                ->leftJoin('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                ->leftJoin('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
                ->where('coordinadores.id_semillero', $request->id_semillero)->first();
            $union = [];
            $union['coordinador'] =  $coordinador;
            $union['data'] = $data;
            Mail::send('mails.solicitud', ['union' => $union], function ($d) use ($request, $coordinador) {
                $d->from('semilleros@elpoli.edu.co', 'Solicitud de ingreso al semillero' . $coordinador->semillero);
                $d->sender($request->email, 'Semilleros');
                $d->to($coordinador->email, 'Semilleros');
                $d->subject('Mensaje Recibido');
                // $message->priority(3);
                // $message->attach('pathToFile');
            });

            return response()->json('La solicitud ha sido enviada');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
