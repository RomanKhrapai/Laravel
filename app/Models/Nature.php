<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    use HasFactory;
    protected $table = 'natures';
    protected $fillable = ['name'];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
