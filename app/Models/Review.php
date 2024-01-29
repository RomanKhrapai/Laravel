<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'reviews';
    protected $guarded = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'parent_id', 'id');
    }

    public function evaluatedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluated_user_id', 'id');
    }

    public function evaluatedCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'evaluated_company_id', 'id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Review::class, 'parent_id', 'id');
    }

    public function scopeByName(Builder $query, $name)
    {
        $query->where('name', 'like', "%{$name}%");
    }
}
