<?php

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

//reset the database after each test
uses(RefreshDatabase::class);

//automated test to check if anyone can view the list of jobs
test('anyone can view the list of jobs', function () {
    $company = Company::factory()->create();
    $user = User::factory()->create();

    Job::create([
        'company_id' => $company->id,
        'user_id' => $user->id,
        'title' => 'PHP Developer',
        'description' => 'Develop web applications with Laravel.',
        'location' => 'Berlin',
        'employment_type' => 'Full-time',
        'salary' => 45000,
        'currency' => 'EUR',
    ]);

    $response = $this->getJson('/api/jobs');
    
    $response->assertOk()
        ->assertJsonFragment([
            'title' => 'PHP Developer',
        ]);
});

//automated test to check if another user cannot update a job
test('another user cannot update a job', function () {
    $company = Company::factory()->create();
    $creator = User::factory()->create();
    $otherUser = User::factory()->create();

    $job = Job::create([
        'company_id' => $company->id,
        'user_id' => $creator->id,
        'title' => 'PHP Developer',
        'description' => 'Develop web applications with Laravel.',
    ]);

    $token = $otherUser->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->putJson('/api/jobs/' . $job->id, [
             'title' => 'Changed title',
        ]);

    $response->assertForbidden();

    expect($job->fresh()->title)->toBe('PHP Developer');
});

//automated test to check if the creator of a job can update their own job
test ('creator can update their own job', function () {
    $company = Company::factory()->create();
    $creator = User::factory()->create();

    $job = Job::create([
        'company_id' => $company->id,
        'user_id' => $creator->id,
        'title' => 'PHP Developer',
        'description' => 'Develop web applications with Laravel.',
    ]);

    $token = $creator->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->putJson('/api/jobs/' . $job->id, [
             'title' => 'Senior PHP Developer',
        ]);

    $response->assertOk();

    expect($job->fresh()->title)->toBe('Senior PHP Developer');
});

//automated test to check if another user cannot delete a job
test('another user cannot delete a job', function () {
    $company = Company::factory()->create();
    $creator = User::factory()->create();
    $otherUser = User::factory()->create();

    $job = Job::create([
        'company_id' => $company->id,
        'user_id' => $creator->id,
        'title' => 'PHP Developer',
        'description' => 'Develop web applications with Laravel.',
    ]);

    $token = $otherUser->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->deleteJson('/api/jobs/' . $job->id);

    $response->assertForbidden();

    expect(Job::find($job->id))->not()->toBeNull();
});

//automated test to check if the creator of a job can delete their own job
test('creator can delete their own job', function () {
    $company = Company::factory()->create();
    $creator = User::factory()->create();

    $job = Job::create([
        'company_id' => $company->id,
        'user_id' => $creator->id,
        'title' => 'PHP Developer',
        'description' => 'Develop web applications with Laravel.',
    ]);

    $token = $creator->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->deleteJson('/api/jobs/' . $job->id);

    $response->assertOk()->assertJson([
        'message' => 'Job deleted successfully',
    ]);

    expect(Job::find($job->id))->toBeNull();
});