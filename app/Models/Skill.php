<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $table = 'skills';
    protected $fillable = ['name', 'profession_id'];

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class);
    }
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
}
