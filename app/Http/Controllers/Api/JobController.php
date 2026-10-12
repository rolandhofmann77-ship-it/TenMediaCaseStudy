<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    //show all jobs with their associated company and creator (user) information
    public function index(): JsonResponse
    {
        $jobs = Job::with(['company', 'creator'])->get();

        return response()->json($jobs);
    }
}
