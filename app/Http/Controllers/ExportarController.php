<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Integrante;
use App\Semillero;
use App\Periodo;
use App\Coordinador;
use App\Actividad;
use Response;
use DB;

use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class ExportarController extends Controller
{
    public function export1(Request $request)
    {
        //RUTA DE LA PLANTILLA
        $path = './FIN13.xls';
        //RUTA DE LA DESCARGA
        $descarga = './FIN13Inicial.xlsx';
       /*  $semillero = Semillero::select('semillero')->where('id_semillero',$request->id_semillero)->get(); */
        $semillero = Semillero::find($request->id_semillero);

        $periodo = Periodo::find($request->id_periodo);
        $semestre = substr($periodo->periodo,strrpos($periodo->periodo, '-')+1);


        $coordinador = Coordinador::select('nombre_usuario','apellido_usuario')
        ->where('coordinadores.id_semillero',$request->id_semillero)
        ->join('users','users.id_usuario','coordinadores.id_usuario')
        ->get();


        $integrantes = Integrante::select('documento','nombre_usuario','apellido_usuario','tipo_usuario','telefono','email')
        ->where([
            ['integrantes.id_semillero',$request->id_semillero],
            ['integrantes.id_periodo',$request->id_periodo]
            ])->join('users','users.id_usuario','integrantes.id_usuario')
        ->join('periodos','periodos.id_periodo','integrantes.id_periodo')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')->get();

        $actividades = Actividad::select('actividad','responsable','recursos','mes','registro','producto')
        ->where([
            ['actividades.id_semillero',$request->id_semillero],
            ['actividades.id_periodo',$request->id_periodo]
        ])->get();



        //INDICAMOS QUE VAMOS A USAR LA PLANTILLA

        $spreadsheet = IOFactory::load($path);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet2 = $spreadsheet->getSheet(1);

        $count1 = 10;
        $count2 = 6;
        //Se inserta el nombre del semillero
        $sheet1->setCellValue('E4', $semillero->semillero);
        $sheet1->setCellValue('E5', $coordinador[0]->nombre_usuario.' '.$coordinador[0]->apellido_usuario);
        $sheet1->setCellValue('E6', $periodo->periodo);

        if($semestre=='1'){
            $sheet1->setCellValue('D9', 'F');
            $sheet1->setCellValue('E9', 'M');
            $sheet1->setCellValue('F9', 'A');
            $sheet1->setCellValue('G9', 'M');
            $sheet1->setCellValue('H9', 'J');
        }else{
            $sheet1->setCellValue('D9', 'A');
            $sheet1->setCellValue('E9', 'S');
            $sheet1->setCellValue('F9', 'O');
            $sheet1->setCellValue('G9', 'N');
            $sheet1->setCellValue('H9', 'D');
        }


        foreach($actividades as $actividad){
            $sheet1->setCellValue('A'.$count1, $actividad->actividad);
            $sheet1->setCellValue('B'.$count1, $actividad->responsable);
            $sheet1->setCellValue('C'.$count1, $actividad->recursos);
            if($actividad->recursos == 2 || $actividad->recursos == 8){
                $sheet1->setCellValue('D'.$count1, 'X');
            }elseif($actividad->recursos == 3 || $actividad->recursos == 9){
                $sheet1->setCellValue('E'.$count1, 'X');
            }elseif($actividad->recursos == 4 || $actividad->recursos == 10){
                $sheet1->setCellValue('F'.$count1, 'X');
            }elseif($actividad->recursos == 5 || $actividad->recursos == 11){
                $sheet1->setCellValue('G'.$count1, 'X');
            }else{
                $sheet1->setCellValue('H'.$count1, 'X');
            }
            $sheet1->setCellValue('I'.$count1, $actividad->registro);
            $sheet1->setCellValue('J'.$count1, $actividad->producto);
            $count1++;
        }


        foreach($integrantes as $integrante){
            $sheet2->setCellValue('A'.$count2, $integrante->nombre_usuario.' '.$integrante->apellido_usuario);
            $sheet2->setCellValue('B'.$count2, $integrante->tipo_usuario);
            $sheet2->setCellValue('C'.$count2, $integrante->documento);
            $sheet2->setCellValue('D'.$count2, $integrante->telefono);
            $sheet2->setCellValue('E'.$count2, $integrante->email);
            $count2++;
        }
        //INICIALIZAMOS EL EXCEL CON LAS INSERCIONES
        $writer = new Xlsx($spreadsheet);
        //LO GUARDAMOS CON EL NOMBRE
        $writer->save('FIN13Inicial.xlsx');

        return Response::download($descarga);
       /*  return $writer; */

       /*  return Excel::download(new UsersExport, 'users.xlsx'); */
    }


    public function export2(Request $request)
    {
        //RUTA DE LA PLANTILLA
        $path = './FIN13.xls';
        //RUTA DE LA DESCARGA
        $descarga = './FIN13Final.xlsx';
       /*  $semillero = Semillero::select('semillero')->where('id_semillero',$request->id_semillero)->get(); */
        $semillero = Semillero::find($request->id_semillero);

        $periodo = Periodo::find($request->id_periodo);
        $semestre = substr($periodo->periodo,strrpos($periodo->periodo, '-')+1);


        $coordinador = Coordinador::select('nombre_usuario','apellido_usuario')
        ->where('coordinadores.id_semillero',$request->id_semillero)
        ->join('users','users.id_usuario','coordinadores.id_usuario')
        ->get();


        $integrantes = Integrante::select('documento','nombre_usuario','apellido_usuario','tipo_usuario','telefono','email')
        ->where([
            ['integrantes.id_semillero',$request->id_semillero],
            ['integrantes.id_periodo',$request->id_periodo]
            ])->join('users','users.id_usuario','integrantes.id_usuario')
        ->join('periodos','periodos.id_periodo','integrantes.id_periodo')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')->get();

        $actividades = Actividad::select('actividad','responsable','recursos','mes','registro','estado')
        ->where([
            ['actividades.id_semillero',$request->id_semillero],
            ['actividades.id_periodo',$request->id_periodo]
        ])->get();



        //INDICAMOS QUE VAMOS A USAR LA PLANTILLA

        $spreadsheet = IOFactory::load($path);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet2 = $spreadsheet->getSheet(1);

        $count1 = 10;
        $count2 = 6;
        //Se inserta el nombre del semillero
        $sheet1->setCellValue('E4', $semillero->semillero);
        $sheet1->setCellValue('E5', $coordinador[0]->nombre_usuario.' '.$coordinador[0]->apellido_usuario);
        $sheet1->setCellValue('E6', $periodo->periodo);

        if($semestre=='1'){
            $sheet1->setCellValue('D9', 'F');
            $sheet1->setCellValue('E9', 'M');
            $sheet1->setCellValue('F9', 'A');
            $sheet1->setCellValue('G9', 'M');
            $sheet1->setCellValue('H9', 'J');
        }else{
            $sheet1->setCellValue('D9', 'A');
            $sheet1->setCellValue('E9', 'S');
            $sheet1->setCellValue('F9', 'O');
            $sheet1->setCellValue('G9', 'N');
            $sheet1->setCellValue('H9', 'D');
        }


        foreach($actividades as $actividad){
            $sheet1->setCellValue('A'.$count1, $actividad->actividad);
            $sheet1->setCellValue('B'.$count1, $actividad->responsable);
            $sheet1->setCellValue('C'.$count1, $actividad->recursos);
            if($actividad->recursos == 2 || $actividad->recursos == 8){
                $sheet1->setCellValue('D'.$count1, 'X');
            }elseif($actividad->recursos == 3 || $actividad->recursos == 9){
                $sheet1->setCellValue('E'.$count1, 'X');
            }elseif($actividad->recursos == 4 || $actividad->recursos == 10){
                $sheet1->setCellValue('F'.$count1, 'X');
            }elseif($actividad->recursos == 5 || $actividad->recursos == 11){
                $sheet1->setCellValue('G'.$count1, 'X');
            }else{
                $sheet1->setCellValue('H'.$count1, 'X');
            }
            $sheet1->setCellValue('I'.$count1, $actividad->registro);
            $sheet1->setCellValue('J'.$count1, $actividad->estado);
            $count1++;
        }


        foreach($integrantes as $integrante){
            $sheet2->setCellValue('A'.$count2, $integrante->nombre_usuario.' '.$integrante->apellido_usuario);
            $sheet2->setCellValue('B'.$count2, $integrante->tipo_usuario);
            $sheet2->setCellValue('C'.$count2, $integrante->documento);
            $sheet2->setCellValue('D'.$count2, $integrante->telefono);
            $sheet2->setCellValue('E'.$count2, $integrante->email);
            $count2++;
        }
        //INICIALIZAMOS EL EXCEL CON LAS INSERCIONES
        $writer = new Xlsx($spreadsheet);
        //LO GUARDAMOS CON EL NOMBRE
        $writer->save('FIN13Final.xlsx');

        return Response::download($descarga);
       /*  return $writer; */

       /*  return Excel::download(new UsersExport, 'users.xlsx'); */
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
