<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'name',
        'address',
        'description',
        'image',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function receivedReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'evaluated_company_id', 'id');
    }

    public function scopeByName(Builder $query, $name)
    {
        $query->where('name', 'like', "%{$name}%");
    }
}
