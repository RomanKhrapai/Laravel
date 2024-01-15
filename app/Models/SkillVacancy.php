<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillVacancy extends Model
{
    protected $table = 'skill_vacancy';
    public $timestamps = false;
    use HasFactory;
}
