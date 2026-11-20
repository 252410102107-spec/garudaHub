<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client')
            ->withCount('bids')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load(['client', 'bids.developer']);

        return view('projects.show', compact('project'));
    }
}