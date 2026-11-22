{{--
  Pilihan Jenis Pengaduan, dikelompokkan per Kategori.
  Parameter: $selected = array kode jenis yang terpilih.
--}}
@php
    $selected = array_values((array) ($selected ?? []));
    $opsi = \App\Models\Pengaduan::jenisAduanOptions($selected);
    $kolom = $opsi->count() === 1 ? 12 : 6;
@endphp

<label class="form-label">Jenis Pengaduan <span class="text-danger">*</span></label>
<div class="text-muted mb-2" style="font-size:.76rem">Pilih satu atau lebih jenis pengaduan sesuai laporan yang diterima.
</div>

<div class="row g-3">
    @forelse ($opsi as $kat)
        <div class="col-12 col-lg-{{ $kolom }}">
            <div class="h-100" style="border:1px solid {{ $kat->warna }}55;border-radius:10px;overflow:hidden">
                <div class="d-flex align-items-center gap-2 px-3 py-2"
                    style="background:{{ $kat->warna }}14;border-bottom:1px solid {{ $kat->warna }}33">
                    <i class="bi {{ $kat->ikon }}" style="color:{{ $kat->warna }}"></i>
                    <strong style="font-size:.84rem;color:{{ $kat->warna }}">{{ $kat->nama }}</strong>
                </div>
                <div class="px-3 py-2">
                    @foreach ($kat->jenis as $j)
                        <div class="form-check py-1">
                            <input class="form-check-input" type="checkbox" name="jenis_aduan[]"
                                value="{{ $j->kode }}" id="ja_{{ $j->kode }}"
                                {{ in_array($j->kode, $selected, true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ja_{{ $j->kode }}" style="font-size:.84rem">
                                {{ $j->nama }}
                                @if (!$j->is_active || !$kat->is_active)
                                    <span class="badge bg-secondary ms-1">nonaktif</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning mb-0" style="font-size:.82rem">
                Belum ada jenis pengaduan yang aktif. Tambahkan terlebih dahulu di
                <a href="{{ route('admin.jenis-pengaduan.index') }}">Master Data → Jenis Pengaduan</a>.
            </div>
        </div>
    @endforelse
</div>

@error('jenis_aduan')
    <div class="text-danger mt-2" style="font-size:.82rem">{{ $message }}</div>
@enderror
@error('jenis_aduan.*')
    <div class="text-danger mt-2" style="font-size:.82rem">{{ $message }}</div>
@enderror
