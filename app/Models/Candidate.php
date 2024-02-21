<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candidate extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'candidates';
    protected $guarded = false;

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    public function types(): belongsToMany
    {
        return $this->belongsToMany(Type::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'evaluated_user_id', 'user_id');
    }
    public function scopeByName(Builder $query, $name)
    {
        $query->where('name', 'like', "%{$name}%");
    }
}
