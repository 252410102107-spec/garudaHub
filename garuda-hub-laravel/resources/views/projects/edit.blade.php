@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
    <p><a href="{{ route('projects.show', $project) }}">&larr; Kembali</a></p>
    <h2>Edit Proyek</h2>

    <form method="POST" action="{{ route('projects.update', $project) }}" class="card">
        @csrf
        @method('PUT')
        @include('projects._form')
        <button type="submit" class="btn">Perbarui</button>
    </form>
@endsection