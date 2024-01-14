<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $table = 'professions';
    protected $fillable = ['name'];

    public function skill()
    {
        return $this->hasMany(Skill::class, 'id');
    }
    public function profession()
    {
        return $this->hasMany(Profession::class);
    }
}
