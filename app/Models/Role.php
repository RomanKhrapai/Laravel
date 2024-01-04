<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    // protected $fillable = ['name'];
    // protected $guarded = false;
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}
