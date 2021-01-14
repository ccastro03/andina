<?php

namespace App\Exports;

use App\Busquedas;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BusquedaExport implements FromCollection, WithHeadings
{

    public function __construct(String $fechaini, String $fechafin)
    {
        $this->fechaIni = $fechaini;
        $this->fechaFin = $fechafin;
    }

    public function collection()
    {

        if($this->fechaIni !== '' && $this->fechaFin == ''){
            $negocios = DB::table('busquedas')->where('busquedas.fecha_busqueda', '>=', $this->fechaIni)->get();
        }
        
        if($this->fechaFin !== '' && $this->fechaIni !== ''){
            $negocios = DB::table('busquedas')->where('busquedas.fecha_busqueda', '<=', $this->fechaFin)->get();
        }       

        if($this->fechaIni == '' && $this->fechaFin == ''){
            $negocios = DB::table('busquedas')->get();
        }

        return $negocios;
    }

    public function headings(): array
    {
        return [
            '#',
            'Texto buscado',
            'Localizacion',
            'Dispositivo',
            'Exito',
            'Fecha',
        ];
    } 
}
