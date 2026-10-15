<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(): JsonResponse
    {
        // Retrieve all companies along with their associated users
        $companies = Company::with('users')->get();
        return response()->json($companies);
    }

    public function show($id): JsonResponse
    {
        // Retrieve a specific company along with its associated users
        $company = Company::with('users')->findOrFail($id);
        return response()->json($company);
    }

    public function store(Request $request): JsonResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            
        ]);

        // Create a new company
        $company = Company::create($validated);

        return response()->json($company, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $company = Company::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'website' => ['sometimes', 'nullable', 'url', 'max:255'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:50'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],
        ]);

        $company->update($validated);

        return response()->json($company);
    }

    // Add a destroy method to delete a company
    public function destroy(int $id): JsonResponse
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully.']);
    }
}