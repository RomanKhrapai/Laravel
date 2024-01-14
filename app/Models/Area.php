<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $fillable = ['name'];
    // protected $guarded = false;
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
    public function candidate()
    {
        return $this->hasMany(Candidate::class);
    }
}
