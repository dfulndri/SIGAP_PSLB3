{{-- Dropdown filter jenis pengaduan (dikelompokkan per kategori). Nilai: "kategori:{id}" atau kode jenis. --}}
@php
    $filterKategori = \App\Models\MasterKategoriPengaduan::with('jenis')->orderBy('urutan')->orderBy('nama')->get();
@endphp
<select name="jenis" class="form-select form-select-sm">
    <option value="">Semua Jenis</option>
    @foreach ($filterKategori as $k)
        <optgroup label="{{ $k->nama }}">
            <option value="kategori:{{ $k->id }}"
                {{ request('jenis') === 'kategori:' . $k->id ? 'selected' : '' }}>
                Semua {{ $k->nama }}
            </option>
            @foreach ($k->jenis as $j)
                <option value="{{ $j->kode }}" {{ request('jenis') === $j->kode ? 'selected' : '' }}>
                    {{ $j->nama }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>
