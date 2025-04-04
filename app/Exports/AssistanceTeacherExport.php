<?php

namespace App\Exports;

use App\Models\AssistanceTeacher;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssistanceTeacherExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $ini;
    protected $end;

    public function __construct($ini = null, $end = null) 
    {
        $this->ini = $ini;
        $this->end = $end;
    }

    public function collection()
    {
        if($this->ini == null && $this->end == null)
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
            ->orderBy('assistance_teachers.id', 'desc')
            ->get();
            return $assistance_teachers;
        }
        else{
            /*SELECT created_at FROM assistance_teachers WHERE created_at BETWEEN '2025-04-01 00:00:00' AND '2025-04-03 11:59:59' ORDER BY created_at DESC*/
            
            $init_date = $this->ini;
            $end_date = $this->end.' 11:59:59';
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
            //->where('assistance_teachers.created_at', '>=' , $init_date)
            //->where('assistance_teachers.created_at', '<=' , $end_date)
            ->whereBetween('assistance_teachers.created_at', [$init_date, $end_date])
            ->orderBy('assistance_teachers.id', 'desc')
            ->get();
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
