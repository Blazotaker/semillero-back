<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Semillero;
use Response;
use DB;

use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExportarController extends Controller
{
    public function export(Request $request)
    {
        //RUTA DE LA PLANTILLA
        $path = './FIN13.xls';
        //RUTA DE LA DESCARGA
        $descarga = './Fin13.xlsx';
       /*  $semillero = Semillero::select('semillero')->where('id_semillero',$request->id_semillero)->get(); */
        $semillero = Semillero::find($request->id_semillero);
        $usuarios = User::all();
        //INDICAMOS QUE VAMOS A USAR LA PLANTILLA
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $count = 10;
        //Se inserta el nombre del semillero
        $sheet->setCellValue('E4', $semillero->semillero);

        foreach($usuarios as $usuario){
            $sheet->setCellValue('A'.$count, $usuario->email);
            $count++;
        }
        //INICIALIZAMOS EL EXCEL CON LAS INSERCIONES
        $writer = new Xlsx($spreadsheet);
        //LO GUARDAMOS CON EL NOMBRE
        $writer->save('Fin13.xlsx');
        
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
