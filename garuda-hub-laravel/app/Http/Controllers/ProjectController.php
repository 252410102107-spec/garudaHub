<?php
// NIM: 252410102107

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

    public function create()
    {
        Gate::authorize('create', Project::class);

        return view('projects.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Project::class);

        $data = $this->validated($request);
        $data['client_id'] = $request->user()->id; // dari session, bukan dari form

        $project = Project::create($data);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $project->update($this->validated($request));

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul'        => ['required', 'string', 'max:200'],
            'deskripsi'    => ['required', 'string', 'max:5000'],
            'kategori'     => ['required', 'string', 'max:50'],
            'budget_min'   => ['required', 'integer', 'min:0'],
            'budget_max'   => ['required', 'integer', 'gte:budget_min'],
            'batas_lelang' => ['required', 'date'],
            'status'       => ['required', 'in:terbuka,ditutup'],
        ]);
    }
}
