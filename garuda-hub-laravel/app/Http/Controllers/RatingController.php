<?php
// NIM: 252410102107

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RatingController extends Controller
{
    public function store(Request $request, Bid $bid)
    {
        Gate::authorize('rate', $bid);

        $data = $request->validate([
            'skor'     => ['required', 'integer', 'between:1,5'],
            'komentar' => ['nullable', 'string', 'max:1000'],
        ]);

        $bid->rating()->create($data);

        return redirect()->route('projects.show', $bid->project_id)
            ->with('success', 'Rating berhasil disimpan.');
    }
}
