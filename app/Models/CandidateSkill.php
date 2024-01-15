<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    protected $table = 'candidate_skill';
    public $timestamps = false;
    use HasFactory;
}
