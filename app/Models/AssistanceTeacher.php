<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistanceTeacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    //protected $fillable = ['training_module','period','turn','didactic_unit','checkin_time','departure_time','theme','place','educational_platforms','remarks'];
    protected $guarded = ['id'];
}
