<?php

namespace App\Exports;

use App\Models\AssistanceTeacher;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssistanceFilterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $year_month;

    public function __construct($year_month) 
    {
        $this->year_month = $year_month;
    }

    public function collection()
    {
        $ym = explode('-', $this->year_month);
        if(count($ym) > 1)
        {
           $assistance_teachers = AssistanceTeacher::select([
                DB::raw("DATE_FORMAT(assistance_teachers.created_at, '%Y/%m/%d %r')"),
                DB::raw("CONCAT(teachers.lastname,' ',teachers.name) as teacher_name"),
                'assistance_teachers.training_module',
                'assistance_teachers.period',
                'assistance_teachers.turn',
                'assistance_teachers.didactic_unit',
                DB::raw("DATE_FORMAT(assistance_teachers.checkin_time, '%Y/%m/%d %r')"),
                DB::raw("DATE_FORMAT(assistance_teachers.departure_time, '%Y/%m/%d %r')"),
                'assistance_teachers.theme',
                'assistance_teachers.place',
                'assistance_teachers.educational_platforms',
                'assistance_teachers.remarks',
                ]) //periods.name
            ->join('teachers', 'assistance_teachers.teacher_id', '=', 'teachers.id')
            //->join('periods', 'assistance_teachers.period_id', '=', 'period.id')
            ->whereRaw("year(assistance_teachers.created_at) = ? ", [$ym[0]])
            ->whereRaw("month(assistance_teachers.created_at) = ? ", [$ym[1]])
            ->orderBy('assistance_teachers.id', 'desc')
            ->get();
            return $assistance_teachers;
        }
        else{            
            $assistance_teachers = AssistanceTeacher::select([
                DB::raw("DATE_FORMAT(assistance_teachers.created_at, '%Y/%m/%d %r')"),
                DB::raw("CONCAT(teachers.lastname,' ',teachers.name) as teacher_name"),
                'assistance_teachers.training_module',
                'assistance_teachers.period',
                'assistance_teachers.turn',
                'assistance_teachers.didactic_unit',
                DB::raw("DATE_FORMAT(assistance_teachers.checkin_time, '%Y/%m/%d %r')"),
                DB::raw("DATE_FORMAT(assistance_teachers.departure_time, '%Y/%m/%d %r')"),
                'assistance_teachers.theme',
                'assistance_teachers.place',
                'assistance_teachers.educational_platforms',
                'assistance_teachers.remarks',
                ]) //periods.name
            ->join('teachers', 'assistance_teachers.teacher_id', '=', 'teachers.id')
            //->join('periods', 'assistance_teachers.period_id', '=', 'period.id')
            ->whereRaw("year(assistance_teachers.created_at) = ? ", [$ym[0]])
            ->orderBy('assistance_teachers.id', 'desc')
            ->get();
            //dd($assistance_teachers);
            return $assistance_teachers;
        }
    }

    public function headings(): array
    {
        return [
            "Fecha de creación",
            "Apellidos y Nombres", 
            "Módulo Formativo", 
            "Período Académico",
            "Turno/Sección", 
            "Unidad Didáctica",
            "Hora de ingreso a clase",
            "Hora de salida de clase", 
            "Tema de actividad de aprendizaje",
            "Lugar de realización de actividad", 
            "Plataformas educativas de apoyo",
            "Observaciones", 
        ];
    }
}
