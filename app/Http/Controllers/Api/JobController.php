<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    //show all jobs with their associated company and creator (user) information
    public function index(): JsonResponse
    {
        $jobs = Job::with(['company', 'creator'])->get();

        return response()->json($jobs);
    }

    //show a single job with its associated company and creator (user) information
    public function show(int $id): JsonResponse
    {
        $job = Job::with(['company', 'creator'])->findOrFail($id);

        return response()->json($job);
    }

    //create new job listing for authenticated user
    //required fields: company_id, title, description, location
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'size:3'],
        ]);

        //check authenticated user for authorization to create a job listing for the specified company_id
        $user = $request->user();

        if (!$user->companies()->where('companies.id', $validated['company_id'])->exists())
        {
            abort(403, 'You are not authorized to create a job listing for this company.');
        }

        //set the user_id of the job listing to the authenticated user's id
        $validated['user_id'] = $user->id;

        $job = Job::create($validated);

        //state 201: new resource created successfully, return the newly created job with its associated company and creator (user) information
        return response()->json($job->load(['company', 'creator']), 201);
    }

    //update an existing job listing for authenticated user(creator)
    public function update(Request $request, int $id): JsonResponse
    {
        $job = Job::findOrFail($id);

        //check if the authenticated user is authorized to update the job listing
        Gate::authorize('update', $job);

        $validated = $request->validate([
            'company_id' => ['sometimes', 'required', 'integer', 'exists:companies,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'location' => ['sometimes', 'nullable', 'string', 'max:255'],
            'employment_type' => ['sometimes', 'nullable', 'string', 'max:255'],
            'salary' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'currency' => ['sometimes', 'nullable', 'string', 'size:3'],
        ]);

        $job->update($validated);

        return response()->json($job->load(['company', 'creator']));
    }

    //destroy an existing job listing for authenticated user(creator)
    public function destroy(int $id): JsonResponse
    {
        $job = Job::findOrFail($id);

        //check if the authenticated user is authorized to delete the job listing
        Gate::authorize('delete', $job);

        $job->delete();

        return response()->json(['message' => 'Job deleted successfully',
        ]);
    }
}