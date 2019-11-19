<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mes_actividad;
use App\Integrante;
use App\Semillero;
use App\Periodo;
use App\Coordinador;
use App\Actividad;
use App\Producto;
use App\Proyecto;
use Response;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class ExportarController extends Controller
{
    public function exportFin13I(Request $request, $id)
    {
        //RUTA DE LA PLANTILLA
        $path = './FIN13.xls';
        //RUTA DE LA DESCARGA
        $descarga = './FIN13Inicial.xlsx';
        /*  $semillero = Semillero::select('semillero')->where('id_semillero',$request->id_semillero)->get(); */
        $datos = Periodo::select('periodos.id_semillero', 'periodo', 'semillero')
            ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
            ->where('id_periodo', $id)->first();


        /*  $periodo = Periodo::find($id); */
        $semestre = substr($datos->periodo, strrpos($datos->periodo, '-') + 1);


        $coordinador = Coordinador::select('nombre_usuario', 'apellido_usuario')
            ->join('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
            ->where('coordinadores.id_semillero', $datos->id_semillero)
            ->first();


        $integrantes = Integrante::select('documento', 'nombre_usuario', 'apellido_usuario', 'tipo_usuario', 'telefono', 'email')
            ->where([
                ['integrantes.id_periodo', $id]
            ])->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
            ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
            ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')->get();

        /* $actividades = Actividad::select('actividad','responsable','recursos','mes','registro','producto')
        ->where([
            ['actividades.id_semillero',$request->id_semillero],
            ['actividades.id_periodo',$id]
        ])->get(); */

        $actividades = Actividad::select('actividades.id_actividad', 'actividad', 'responsable', 'recursos', 'registro')
            ->where('actividades.id_periodo', $id)
            ->leftJoin('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
            ->get();
        //return $actividades;


        //INDICAMOS QUE VAMOS A USAR LA PLANTILLA

        $spreadsheet = IOFactory::load($path);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet2 = $spreadsheet->getSheet(1);

        $count1 = 10;
        $count2 = 6;
        //Se inserta el nombre del semillero
        $sheet1->setCellValue('E4', $datos->semillero);
        $sheet1->setCellValue('E5', $coordinador->nombre_usuario . ' ' . $coordinador->apellido_usuario);
        $sheet1->setCellValue('E6', $datos->periodo);

        if ($semestre == '1') {
            $sheet1->setCellValue('D9', 'F');
            $sheet1->setCellValue('E9', 'M');
            $sheet1->setCellValue('F9', 'A');
            $sheet1->setCellValue('G9', 'M');
            $sheet1->setCellValue('H9', 'J');
        } else {
            $sheet1->setCellValue('D9', 'A');
            $sheet1->setCellValue('E9', 'S');
            $sheet1->setCellValue('F9', 'O');
            $sheet1->setCellValue('G9', 'N');
            $sheet1->setCellValue('H9', 'D');
        }


        foreach ($actividades as $actividad) {
            $sheet1->setCellValue('A' . $count1, $actividad->actividad);
            $sheet1->setCellValue('B' . $count1, $actividad->responsable);
            $sheet1->setCellValue('C' . $count1, $actividad->recursos);

            $mes_actividades = Mes_actividad::where('id_actividad', $actividad->id_actividad)->get();
            foreach ($mes_actividades as $mes_actividad) {
                if ($mes_actividad->id_mes == 2 || $mes_actividad->id_mes == 8) {
                    $sheet1->setCellValue('D' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 3 || $mes_actividad->id_mes == 9) {
                    $sheet1->setCellValue('E' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 4 || $mes_actividad->id_mes == 10) {
                    $sheet1->setCellValue('F' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 5 || $mes_actividad->id_mes == 11) {
                    $sheet1->setCellValue('G' . $count1, 'X');
                } else {
                    $sheet1->setCellValue('H' . $count1, 'X');
                }
            }

            $sheet1->setCellValue('I' . $count1, $actividad->registro);
            $cadena = '';

            $productos = Producto::where('id_actividad', $actividad->id_actividad)->get();
            foreach ($productos as $producto) {
                $cadena = $cadena . ' ' . $producto->producto;
            }
            $sheet1->setCellValue('J' . $count1, $cadena);

            $count1++;
        }


        foreach ($integrantes as $integrante) {
            $sheet2->setCellValue('A' . $count2, $integrante->nombre_usuario . ' ' . $integrante->apellido_usuario);
            $sheet2->setCellValue('B' . $count2, $integrante->tipo_usuario);
            $sheet2->setCellValue('C' . $count2, $integrante->documento);
            $sheet2->setCellValue('D' . $count2, $integrante->telefono);
            $sheet2->setCellValue('E' . $count2, $integrante->email);
            $count2++;
        }
        //INICIALIZAMOS EL EXCEL CON LAS INSERCIONES
        $writer = new Xlsx($spreadsheet);
        //LO GUARDAMOS CON EL NOMBRE
        $writer->save('FIN13Inicial.xlsx');

        return Response::download($descarga);
        /*  return $writer; */

        /*  return Excel::download(new usuariosExport, 'usuarios.xlsx'); */
    }


    public function exportFin13F(Request $request,$id)
    {
        //RUTA DE LA PLANTILLA
        $path = './FIN13.xls';
        //RUTA DE LA DESCARGA
        $descarga = './FIN13Final.xlsx';
        /*  $semillero = Semillero::select('semillero')->where('id_semillero',$request->id_semillero)->get(); */
        $datos = Periodo::select('periodos.id_semillero', 'periodo', 'semillero')
            ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
            ->where('id_periodo', $id)->first();


        /*  $periodo = Periodo::find($id); */
        $semestre = substr($datos->periodo, strrpos($datos->periodo, '-') + 1);


        $coordinador = Coordinador::select('nombre_usuario', 'apellido_usuario')
            ->join('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
            ->where('coordinadores.id_semillero', $datos->id_semillero)
            ->first();


        $integrantes = Integrante::select('documento', 'nombre_usuario', 'apellido_usuario', 'tipo_usuario', 'telefono', 'email')
            ->where([
                ['integrantes.id_periodo', $id]
            ])->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
            ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
            ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')->get();

        /* $actividades = Actividad::select('actividad','responsable','recursos','mes','registro','producto')
        ->where([
            ['actividades.id_semillero',$request->id_semillero],
            ['actividades.id_periodo',$id]
        ])->get(); */

        $actividades = Actividad::select('actividades.id_actividad', 'actividad', 'responsable', 'recursos', 'registro','estado')
            ->where('actividades.id_periodo', $id)
            ->leftJoin('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
            ->get();
        //return $actividades;


        //INDICAMOS QUE VAMOS A USAR LA PLANTILLA

        $spreadsheet = IOFactory::load($path);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet2 = $spreadsheet->getSheet(1);

        $count1 = 10;
        $count2 = 6;
        //Se inserta el nombre del semillero
        $sheet1->setCellValue('E4', $datos->semillero);
        $sheet1->setCellValue('E5', $coordinador->nombre_usuario . ' ' . $coordinador->apellido_usuario);
        $sheet1->setCellValue('E6', $datos->periodo);

        if ($semestre == '1') {
            $sheet1->setCellValue('D9', 'F');
            $sheet1->setCellValue('E9', 'M');
            $sheet1->setCellValue('F9', 'A');
            $sheet1->setCellValue('G9', 'M');
            $sheet1->setCellValue('H9', 'J');
        } else {
            $sheet1->setCellValue('D9', 'A');
            $sheet1->setCellValue('E9', 'S');
            $sheet1->setCellValue('F9', 'O');
            $sheet1->setCellValue('G9', 'N');
            $sheet1->setCellValue('H9', 'D');
        }


        foreach ($actividades as $actividad) {
            $sheet1->setCellValue('A' . $count1, $actividad->actividad);
            $sheet1->setCellValue('B' . $count1, $actividad->responsable);
            $sheet1->setCellValue('C' . $count1, $actividad->recursos);

            $mes_actividades = Mes_actividad::where('id_actividad', $actividad->id_actividad)->get();
            foreach ($mes_actividades as $mes_actividad) {
                if ($mes_actividad->id_mes == 2 || $mes_actividad->id_mes == 8) {
                    $sheet1->setCellValue('D' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 3 || $mes_actividad->id_mes == 9) {
                    $sheet1->setCellValue('E' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 4 || $mes_actividad->id_mes == 10) {
                    $sheet1->setCellValue('F' . $count1, 'X');
                } elseif ($mes_actividad->id_mes == 5 || $mes_actividad->id_mes == 11) {
                    $sheet1->setCellValue('G' . $count1, 'X');
                } else {
                    $sheet1->setCellValue('H' . $count1, 'X');
                }
            }

            $sheet1->setCellValue('I' . $count1, $actividad->registro);
            $cadena = '';

            /* $productos = Producto::where('id_actividad', $actividad->id_actividad)->get();
            foreach ($productos as $producto) {
                $cadena = $cadena . ' ' . $producto->producto;
            } */
            $sheet1->setCellValue('J' . $count1, $actividad->estado);

            $count1++;
        }


        foreach ($integrantes as $integrante) {
            $sheet2->setCellValue('A' . $count2, $integrante->nombre_usuario . ' ' . $integrante->apellido_usuario);
            $sheet2->setCellValue('B' . $count2, $integrante->tipo_usuario);
            $sheet2->setCellValue('C' . $count2, $integrante->documento);
            $sheet2->setCellValue('D' . $count2, $integrante->telefono);
            $sheet2->setCellValue('E' . $count2, $integrante->email);
            $count2++;
        }
        //INICIALIZAMOS EL EXCEL CON LAS INSERCIONES
        $writer = new Xlsx($spreadsheet);
        //LO GUARDAMOS CON EL NOMBRE
        $writer->save('FIN13Final.xlsx');

        return Response::download($descarga);
        /*  return $writer; */

        /*  return Excel::download(new usuariosExport, 'usuarios.xlsx'); */
    }

    public function exportPDF($id){
        $integrantes = Integrante::select('documento', 'nombre_usuario', 'apellido_usuario', 'tipo_usuario', 'telefono', 'email')
        ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
        ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
        ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
        ->where([
                ['integrantes.id_periodo', $id]
        ])->get();

        $periodo = Periodo::select('periodos.periodo','fecha_inicio','fecha_fin')->where('id_periodo',$id)
        ->first();

        $actividades = Actividad::select('actividades.id_actividad', 'actividad', 'responsable', 'recursos', 'registro','estado')
        ->where('actividades.id_periodo', $id)
        ->leftJoin('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
        ->get();

        $proyectos = Proyecto::where('proyectos.id_proyecto',$id)->get();


        $pdf = PDF::loadView('pdf.documento',compact('integrantes','actividades','periodo','proyectos'));
        return $pdf->download('integrantes.pdf');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
