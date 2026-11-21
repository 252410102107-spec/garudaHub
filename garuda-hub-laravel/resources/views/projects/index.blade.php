@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
    <h2>Daftar Proyek</h2>
    <p><a href="{{ route('projects.create') }}" class="btn">+ Tambah Proyek</a></p>

    @forelse ($projects as $project)
        <div class="card">
            <h3 style="margin:0 0 6px">
                <a href="{{ route('projects.show', $project) }}">{{ $project->judul }}</a>
                <span class="badge {{ $project->status }}">{{ $project->status }}</span>
            </h3>
            <div class="muted">
                {{ $project->kategori }} · oleh {{ $project->client->name }} ·
                Budget Rp {{ number_format($project->budget_min, 0, ',', '.') }}
                - Rp {{ number_format($project->budget_max, 0, ',', '.') }} ·
                {{ $project->bids_count }} penawaran
            </div>
        </div>
    @empty
        <p>Belum ada proyek.</p>
    @endforelse
@endsection