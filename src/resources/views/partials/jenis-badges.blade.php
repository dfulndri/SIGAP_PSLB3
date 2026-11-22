{{--
  Badge jenis pengaduan berwarna sesuai kategori.
  Parameter: $pengaduan, $stack (true = satu baris per badge, default true)
--}}
@php $stack = $stack ?? true; @endphp
@foreach ($pengaduan->jenis_aduan_items as $ja)
    <span class="badge-kat {{ $stack ? 'd-table mb-1' : 'me-1' }}"
        style="background:{{ $ja['warna'] }}1a;color:{{ $ja['warna'] }}"
        @if ($ja['kategori_nama']) title="{{ $ja['kategori_nama'] }}" @endif>{{ $ja['nama'] }}</span>
@endforeach
