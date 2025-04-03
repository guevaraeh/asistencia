<?php

namespace App\Exports;

use App\Models\AssistanceTeacher;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id) 
    {
        $this->id = $id;
    }

    public function collection()
    {
        //return AssistanceTeacher::all();
        $assistance_teacher = AssistanceTeacher::select([
                DB::raw("DATE_FORMAT(created_at, '%Y/%m/%d %r')"),
                'training_module',
                'period',
                'turn',
                'didactic_unit',
                DB::raw("DATE_FORMAT(checkin_time, '%Y/%m/%d %r')"),
                DB::raw("DATE_FORMAT(departure_time, '%Y/%m/%d %r')"),
                'theme',
                'place',
                'educational_platforms',
                'remarks',
                ]) //periods.name
            ->where('teacher_id', $this->id)
            ->orderBy('id', 'desc')
            ->get();
        return $assistance_teacher;
    }

    public function headings(): array
    {
        return [
            "Fecha de creación",
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
