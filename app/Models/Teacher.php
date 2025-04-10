<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function assistances(): HasMany
    {
        //return $this->hasMany(AssistanceTeacher::class)->orderBy('id', 'desc');
        return $this->hasMany(AssistanceTeacher::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

}
