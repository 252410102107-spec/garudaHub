@extends('layouts.app')

@section('title', $project->judul)

@section('content')
    <p><a href="{{ route('projects.index') }}">&larr; Kembali</a></p>

    <div class="card">
        <h2 style="margin-top:0">
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

    <h3>Penawaran ({{ $project->bids->count() }})</h3>
    <div class="card">
        @if ($project->bids->isEmpty())
            <p class="muted">Belum ada penawaran.</p>
        @else
            <table>
                <thead>
                    <tr><th>Developer</th><th>Harga</th><th>Durasi</th><th>Proposal</th><th></th></tr>
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
@endsection