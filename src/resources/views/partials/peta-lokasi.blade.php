{{--
    Pemilih lokasi pada peta (gaya SIPANDAI): satu kolom koordinat + peta dengan satu pin.

    Parameter:
      $id        string  id unik per halaman           (default 'peta')
      $latName   string  name input latitude           (default 'koordinat_lat')
      $lngName   string  name input longitude          (default 'koordinat_lng')
      $lat,$lng  nilai awal (boleh null)
      $hint      teks bantuan di bawah peta (opsional)
      $readonly  true = hanya menampilkan peta + pin, tanpa input
      $height    tinggi peta dalam px                  (default 260)

    Cara memilih titik (mode edit):
      - klik peta atau geser pin
      - cari alamat / nama tempat
      - ketik atau tempel "lat,lng" atau link Google Maps lalu tekan "Set Nilai"
--}}
@php
    $id = $id ?? 'peta';
    $latName = $latName ?? 'koordinat_lat';
    $lngName = $lngName ?? 'koordinat_lng';
    $lat = $lat ?? null;
    $lng = $lng ?? null;
    $readonly = $readonly ?? false;
    $height = $height ?? 260;
    $hint = $hint ?? null;
@endphp

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <style>
            .peta-lokasi .peta-canvas {
                border: 1px solid #dee2e6;
                border-radius: 8px;
                z-index: 0;
            }

            .peta-lokasi .peta-hasil {
                max-height: 220px;
                overflow-y: auto;
            }

            .peta-lokasi .peta-hasil .list-group-item {
                font-size: .82rem;
                cursor: pointer;
            }

            .peta-lokasi .peta-status {
                font-size: .8rem;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            window.petaLokasi = function(o) {
                const el = (s) => document.getElementById(o.id + '-' + s);
                const DEFAULT_CENTER = [-6.1783, 106.6319]; // Kab. Tangerang
                const NUM = '(-?\\d{1,3}(?:\\.\\d+)?)';

                const map = L.map(el('map'), {
                    scrollWheelZoom: false
                }).setView(DEFAULT_CENTER, 11);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                // scroll-zoom hanya aktif setelah peta diklik agar tidak mengganggu scroll halaman
                map.on('click', () => map.scrollWheelZoom.enable());
                map.on('mouseout', () => map.scrollWheelZoom.disable());

                let marker = null;

                const valid = (la, ln) => isFinite(la) && isFinite(ln) && Math.abs(la) <= 90 && Math.abs(ln) <= 180;
                const fmt = (v) => Number(v).toFixed(6);
                const say = (msg, ok) => {
                    const p = el('pesan');
                    if (!p) return;
                    p.textContent = msg || '';
                    p.className = 'peta-status form-text ' + (ok === false ? 'text-danger' : (ok ? 'text-success' :
                    ''));
                };

                // Membaca "lat,lng" atau berbagai bentuk link Google Maps
                function parse(text) {
                    let t = (text || '').trim();
                    if (!t) return null;
                    try {
                        t = decodeURIComponent(t);
                    } catch (e) {}
                    const pats = [
                        new RegExp('!3d' + NUM + '!4d' + NUM), // titik tempat
                        new RegExp('@' + NUM + ',\\s*' + NUM), // pusat tampilan
                        new RegExp('[?&](?:q|ll|query|destination|center)=\\s*' + NUM + '\\s*,\\s*' + NUM),
                        new RegExp('^\\s*' + NUM + '\\s*[,;\\s]\\s*' + NUM + '\\s*$') // lat,lng polos
                    ];
                    for (const re of pats) {
                        const m = t.match(re);
                        if (m && valid(parseFloat(m[1]), parseFloat(m[2]))) {
                            return {
                                lat: parseFloat(m[1]),
                                lng: parseFloat(m[2])
                            };
                        }
                    }
                    return null;
                }

                function write(la, ln) {
                    if (el('lat')) {
                        el('lat').value = fmt(la);
                        el('lng').value = fmt(ln);
                    }
                    const inp = el('input');
                    if (inp) inp.value = fmt(la) + ',' + fmt(ln);
                    const link = 'https://www.google.com/maps?q=' + fmt(la) + ',' + fmt(ln);
                    const p = el('pesan');
                    if (p) {
                        p.className = 'peta-status form-text text-success';
                        p.innerHTML = '';
                        p.append('Titik terpilih: ' + fmt(la) + ', ' + fmt(ln) + ' · ');
                        const a = document.createElement('a');
                        a.href = link;
                        a.target = '_blank';
                        a.rel = 'noopener';
                        a.textContent = 'Buka di Google Maps';
                        p.append(a);
                    }
                    if (marker) marker.bindPopup(fmt(la) + ', ' + fmt(ln));
                }

                function place(la, ln, recenter) {
                    if (!marker) {
                        marker = L.marker([la, ln], {
                            draggable: !o.readonly
                        }).addTo(map);
                        if (!o.readonly) {
                            marker.on('dragend', () => {
                                const c = marker.getLatLng();
                                write(c.lat, c.lng);
                            });
                        }
                    } else {
                        marker.setLatLng([la, ln]);
                    }
                    if (recenter) map.setView([la, ln], Math.max(map.getZoom(), 16));
                    write(la, ln);
                }

                function clearPoint() {
                    if (marker) {
                        map.removeLayer(marker);
                        marker = null;
                    }
                    if (el('lat')) {
                        el('lat').value = '';
                        el('lng').value = '';
                    }
                    if (el('input')) el('input').value = '';
                    say('Titik belum dipilih.', null);
                    map.setView(DEFAULT_CENTER, 11);
                }

                // nilai awal
                const la0 = parseFloat(o.lat),
                    ln0 = parseFloat(o.lng);
                if (valid(la0, ln0) && !(la0 === 0 && ln0 === 0)) {
                    place(la0, ln0, false);
                    map.setView([la0, ln0], 16);
                } else if (!o.readonly) {
                    say('Titik belum dipilih. Klik peta, cari alamat, atau tempel koordinat / link Google Maps.', null);
                }
                setTimeout(() => map.invalidateSize(), 250);
                window.addEventListener('resize', () => map.invalidateSize());

                if (o.readonly) return;

                // klik peta
                map.on('click', (e) => place(e.latlng.lat, e.latlng.lng, false));

                // Set Nilai
                function setNilai() {
                    const raw = el('input').value;
                    const r = parse(raw);
                    if (r) {
                        place(r.lat, r.lng, true);
                        return;
                    }
                    if (!raw.trim()) {
                        say('Isi koordinat dulu, contoh: -6.173333,106.457222', false);
                        return;
                    }
                    if (/goo\.gl|maps\.app/i.test(raw)) {
                        say('Link pendek (maps.app.goo.gl) tidak bisa dibaca. Buka link-nya di browser, lalu salin link panjang atau koordinatnya.',
                            false);
                    } else {
                        say('Format tidak dikenali. Gunakan "lat,lng" (contoh: -6.173333,106.457222) atau link Google Maps.',
                            false);
                    }
                }
                el('set').addEventListener('click', setNilai);
                el('input').addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        setNilai();
                    }
                });
                // menempel langsung diproses
                el('input').addEventListener('paste', () => setTimeout(() => {
                    if (parse(el('input').value)) setNilai();
                }, 0));
                el('hapus').addEventListener('click', clearPoint);

                // Cari alamat (OpenStreetMap Nominatim)
                async function cari() {
                    const q = el('cari').value.trim();
                    const box = el('hasil');
                    box.innerHTML = '';
                    if (q.length < 3) return;
                    const btn = el('cari-btn');
                    btn.disabled = true;
                    try {
                        const url = 'https://nominatim.openstreetmap.org/search?format=jsonv2&limit=6&countrycodes=id' +
                            '&viewbox=106.35,-5.95,106.80,-6.40&accept-language=id&q=' + encodeURIComponent(q);
                        const res = await fetch(url);
                        const data = await res.json();
                        if (!data.length) {
                            const d = document.createElement('div');
                            d.className = 'list-group-item text-muted';
                            d.textContent =
                                'Alamat tidak ditemukan. Coba kata kunci lain, atau klik langsung pada peta.';
                            box.append(d);
                        }
                        data.forEach((r) => {
                            const b = document.createElement('button');
                            b.type = 'button';
                            b.className = 'list-group-item list-group-item-action';
                            b.textContent = r.display_name;
                            b.addEventListener('click', () => {
                                place(parseFloat(r.lat), parseFloat(r.lon), true);
                                box.innerHTML = '';
                            });
                            box.append(b);
                        });
                    } catch (err) {
                        const d = document.createElement('div');
                        d.className = 'list-group-item text-danger';
                        d.textContent =
                            'Pencarian alamat gagal (periksa koneksi internet). Anda tetap bisa klik peta atau isi koordinat.';
                        box.append(d);
                    } finally {
                        btn.disabled = false;
                    }
                }
                el('cari-btn').addEventListener('click', cari);
                el('cari').addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        cari();
                    }
                });
            };
        </script>
    @endpush
@endonce

<div class="peta-lokasi" id="{{ $id }}-wrap">
    @unless ($readonly)
        <div class="mb-2">
            <div class="mb-2">
                <label class="form-label mb-1" for="{{ $id }}-cari">Cari Alamat / Nama Tempat</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="{{ $id }}-cari" autocomplete="off"
                        placeholder="mis. Jl. Insinyur Sutami, Mauk">
                    <button type="button" class="btn btn-outline-secondary" id="{{ $id }}-cari-btn"
                        title="Cari"><i class="bi bi-search"></i></button>
                </div>
                <div class="list-group peta-hasil mt-1" id="{{ $id }}-hasil"></div>
            </div>
            <div>
                <label class="form-label mb-1" for="{{ $id }}-input">Koordinat <span
                        class="text-muted fw-normal">(lat,lng atau link Google Maps)</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="{{ $id }}-input" autocomplete="off"
                        placeholder="-6.173333,106.457222">
                    <button type="button" class="btn btn-maroon" id="{{ $id }}-set">Set Nilai</button>
                    <button type="button" class="btn btn-outline-secondary" id="{{ $id }}-hapus"
                        title="Hapus titik"><i class="bi bi-x-lg"></i></button>
                </div>
            </div>
        </div>
        <div class="peta-status form-text mb-2" id="{{ $id }}-pesan"></div>
        <input type="hidden" name="{{ $latName }}" id="{{ $id }}-lat" value="{{ $lat }}">
        <input type="hidden" name="{{ $lngName }}" id="{{ $id }}-lng" value="{{ $lng }}">
    @endunless

    <div class="peta-canvas" id="{{ $id }}-map" style="height: {{ (int) $height }}px"></div>

    @if ($hint)
        <div class="form-text mt-1">{{ $hint }}</div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.petaLokasi({
                id: @json($id),
                lat: @json($lat),
                lng: @json($lng),
                readonly: @json((bool) $readonly)
            });
        });
    </script>
@endpush
