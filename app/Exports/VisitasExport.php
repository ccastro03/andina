<?php

namespace App\Exports;

use App\estadisticanegocio;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitasExport implements FromCollection, WithHeadings
{

    public function __construct(String $fechaini, String $fechafin, String $negocio)
    {
        $this->fechaIni = $fechaini;
        $this->fechaFin = $fechafin;
        $this->IdNegocio = $negocio;
    }

    public function collection()
    {
        if($this->IdNegocio !== '' && $this->fechaIni == '' && $this->fechaFin == ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->where('estadisticanegocio.id_negocio', '=', $this->IdNegocio)
            ->get();
        }

        if($this->fechaIni !== '' && $this->fechaFin == '' && $this->IdNegocio == ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->where('estadisticanegocio.exn_fecha', '>=', $this->fechaIni)
            ->get();
        }
        
        if($this->fechaFin !== '' && $this->fechaIni == '' && $this->IdNegocio == ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->where('estadisticanegocio.exn_fecha', '<=', $this->fechaFin)
            ->get();
        }

        if($this->fechaIni !== '' && $this->fechaFin !== '' && $this->IdNegocio !== ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->where('estadisticanegocio.id_negocio', '=', $this->IdNegocio)
            ->whereBetween('estadisticanegocio.exn_fecha', [$this->fechaIni, $this->fechaFin])
            ->get();
        }

        if($this->fechaIni !== '' && $this->fechaFin !== '' && $this->IdNegocio == ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->whereBetween('estadisticanegocio.exn_fecha', [$this->fechaIni, $this->fechaFin])
            ->get();
        }        

        if($this->fechaIni == '' && $this->fechaFin == '' && $this->IdNegocio == ''){
            $negocios = DB::table('estadisticanegocio')
            ->join('negocios', 'negocios.id_negocio', '=', 'estadisticanegocio.id_negocio')
            ->select('estadisticanegocio.id_estneg', 'estadisticanegocio.id_negocio', 'negocios.negoc_nombre', 'estadisticanegocio.exn_fecha')
            ->get();
        }

        return $negocios;
    }

    public function headings(): array
    {
        return [
            '#',
            'ID Negocio',
            'Nombre Negocio',
            'Fecha y Hora',
        ];
    }    
}
