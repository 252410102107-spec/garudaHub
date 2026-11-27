@php $p = $project ?? null; @endphp

<label>Judul</label>
<input type="text" name="judul" value="{{ old('judul', $p?->judul) }}">
@error('judul') <div class="error">{{ $message }}</div> @enderror

<label>Deskripsi</label>
<textarea name="deskripsi" rows="5">{{ old('deskripsi', $p?->deskripsi) }}</textarea>
@error('deskripsi') <div class="error">{{ $message }}</div> @enderror

<label>Kategori</label>
<input type="text" name="kategori" value="{{ old('kategori', $p?->kategori) }}">
@error('kategori') <div class="error">{{ $message }}</div> @enderror

<label>Budget minimum (Rp)</label>
<input type="number" name="budget_min" value="{{ old('budget_min', $p?->budget_min ?? 0) }}">
@error('budget_min') <div class="error">{{ $message }}</div> @enderror

<label>Budget maksimum (Rp)</label>
<input type="number" name="budget_max" value="{{ old('budget_max', $p?->budget_max ?? 0) }}">
@error('budget_max') <div class="error">{{ $message }}</div> @enderror

<label>Batas lelang</label>
<input type="date" name="batas_lelang" value="{{ old('batas_lelang', $p?->batas_lelang?->format('Y-m-d')) }}">
@error('batas_lelang') <div class="error">{{ $message }}</div> @enderror

<label>Status</label>
<select name="status">
    @foreach (['terbuka', 'ditutup'] as $s)
    <option value="{{ $s }}" @selected(old('status', $p?->status ?? 'terbuka') === $s)>{{ $s }}</option>
    @endforeach
</select>
@error('status') <div class="error">{{ $message }}</div> @enderror
