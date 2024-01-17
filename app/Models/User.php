<?php

namespace App\Models;

// use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes,  AuthenticableTrait;
    // use Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'image',
        'role_id',
    ];

    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class, 'id');
    }
    public function candidate()
    {
        return $this->hasMany(Candidate::class);
    }

    public function setImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $filename = date('d-m-Y') . '_' . $value->getClientOriginalName();
            Storage::put("users/{$filename}", file_get_contents($value));
            $this->attributes['image'] = "users/{$filename}";
        } else {
            $this->attributes['image'] = $value;
        }
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return Storage::url($value);
        }
        return null;
    }
}
