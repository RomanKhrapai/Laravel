<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $table = 'vacancies';
    protected $guarded = false;

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
