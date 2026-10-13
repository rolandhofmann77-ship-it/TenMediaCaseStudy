<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; //Cardinality (1:n)
use Illuminate\Database\Eloquent\Relations\BelongsToMany; //Cardinality (m:n)

class Company extends Model
{
    use HasFactory;
    //defining the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description',
        'website',
        'email',
        'phone',
        'address',
    ];

    //method to get all jobs associated with a specific company
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    //method to get all users associated with a specific company (table 'company_user')
    //timestamps() method is used to automatically manage the created_at and updated_at timestamps in the pivot table
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
