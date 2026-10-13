<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    //Determine whether the user can update the job.
    public function update(User $user, Job $job): bool
    {
        return $job->user_id === $user->id;
    }

    //Determine whether the user can delete the job.
    public function delete(User $user, Job $job): bool
    {
        return $job->user_id === $user->id;
    }

    //ToDo: insert function create() vs store() in JobController.php
}
