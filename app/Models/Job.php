<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; //Cardinality (n:1)

class Job extends Model
{
    protected $table = 'job_listings'; //specific table name because of Laravel queue table 'jobs'

    //defining the fillable attributes for mass assignment
    protected $fillable = [
        'company_id',
        'user_id',
        'title',
        'description',
        'location',
        'employment_type',
        'salary',
        'currency',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
