@extends('layouts.app')

@section('title', $project->judul)

@section('content')
<p><a href="{{ route('projects.index') }}">&larr; Kembali</a></p>

<div class="card">
    <h2 class="tight">
        {{ $project->judul }}
        <span class="badge {{ $project->status }}">{{ $project->status }}</span>
    </h2>
    <p>{{ $project->deskripsi }}</p>
    <div class="muted">
        Kategori: {{ $project->kategori }}<br>
        Klien: {{ $project->client->name }}<br>
        Budget: Rp {{ number_format($project->budget_min, 0, ',', '.') }}
        - Rp {{ number_format($project->budget_max, 0, ',', '.') }}<br>
        Batas lelang: {{ $project->batas_lelang->format('d M Y') }}
    </div>
</div>

@can('update', $project)
<div class="actions">
    <a href="{{ route('projects.edit', $project) }}" class="btn">Edit</a>
    <form method="POST" action="{{ route('projects.destroy', $project) }}"
        data-confirm="Yakin hapus proyek ini?">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>
@endcan

<h3>Penawaran ({{ $project->bids->count() }})</h3>
<div class="card">
    @if ($project->bids->isEmpty())
    <p class="muted">Belum ada penawaran.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>Developer</th>
                <th>Harga</th>
                <th>Durasi</th>
                <th>Proposal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->bids as $bid)
            <tr>
                <td>{{ $bid->developer->name }}</td>
                <td>Rp {{ number_format($bid->harga, 0, ',', '.') }}</td>
                <td>{{ $bid->durasi }} hari</td>
                <td>{{ $bid->proposal }}</td>
                <td>@if ($bid->is_winner) <span class="badge terbuka">Pemenang</span> @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@foreach ($project->bids->filter(fn ($b) => $b->is_winner) as $bid)
<h3>Rating untuk {{ $bid->developer->name }}</h3>
<div class="card">
    @if ($bid->rating)
        <p><strong>{{ $bid->rating->skor }} / 5</strong></p>
        @if ($bid->rating->komentar)
            <p>{{ $bid->rating->komentar }}</p>
        @endif
    @else
        @can('rate', $bid)
        <form method="POST" action="{{ route('ratings.store', $bid) }}">
            @csrf
            <label>Skor (1-5)</label>
            <select name="skor">
                @foreach (range(1, 5) as $n)
                <option value="{{ $n }}" @selected(old('skor') == $n)>{{ $n }}</option>
                @endforeach
            </select>
            @error('skor') <div class="error">{{ $message }}</div> @enderror

            <label>Komentar</label>
            <textarea name="komentar" rows="3">{{ old('komentar') }}</textarea>
            @error('komentar') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn">Kirim Rating</button>
        </form>
        @else
        <p class="muted">Belum ada rating.</p>
        @endcan
    @endif
</div>
@endforeach
@endsection
