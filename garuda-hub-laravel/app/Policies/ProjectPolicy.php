<?php
// NIM: 252410102107

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function create(User $user): bool
    {
        return $user->role === 'klien';
    }

    public function update(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $user->id === $project->client_id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $user->id === $project->client_id;
    }
}
