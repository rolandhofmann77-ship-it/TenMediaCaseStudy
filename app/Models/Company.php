<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; //Cardinality (1:n)
use Illuminate\Database\Eloquent\Relations\BelongsToMany; //Cardinality (m:n)

class Company extends Model
{
    //method to get all jobs associated with a specific company
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    //method to get all users associated with a specific company (table 'company_user')
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
