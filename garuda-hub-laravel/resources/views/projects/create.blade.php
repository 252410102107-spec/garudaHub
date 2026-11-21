@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
    <p><a href="{{ route('projects.index') }}">&larr; Kembali</a></p>
    <h2>Tambah Proyek</h2>

    <form method="POST" action="{{ route('projects.store') }}" class="card">
        @csrf
        @include('projects._form')
        <button type="submit" class="btn">Simpan</button>
    </form>
@endsection