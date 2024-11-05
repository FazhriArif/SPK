@extends('layouts.main')
@section('content')
@include('component.sweetAlert')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Perhitungan WP-TOPSIS
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="add-button-container">
                            <h4>Perhitungan WP-TOPSIS</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="perhitunganForm" action="/perhitungan/store" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Pilih Produk</label>
                                <select class="form-control" name="nama_produk" value="{{ old('nama_produk') }}">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produk as $alt)
                                        <option value="{{ $alt->nama_produk }}" {{ old('nama_produk') == $alt->nama_produk ? 'selected' : '' }}>{{ $alt->nama_produk }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="nama_produk_error"></div>
                            </div>

                            @foreach(['c01' => 'Usia', 'c02' => 'Sifat Fisik', 'c03' => 'Kekuatan', 'c04' => 'Harga', 'c05' => 'Diameter', 'c06' => 'Daya Tahan'] as $key => $label)
                                <div class="mb-3">
                                    <label for="{{ $key }}" class="form-label">{{ $label }}</label>
                                    <select class="form-control" name="{{ $key }}" id="{{ $key }}" required>
                                        <option value="">Pilih Bobot</option>
                                        @if($key == 'c01')
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}>>50 Tahun</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>21-50 Tahun</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>11-20 Tahun</option>
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>0-10 Tahun</option>
                                        @elseif($key == 'c02')
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}>Sangat Keras</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>Keras</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>Sedang</option>
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>Lunak</option>
                                        @elseif($key == 'c03')
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}>Sangat Tinggi</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>Tinggi</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>Sedang</option>
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>Rendah</option>
                                        @elseif($key == 'c04')
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>1.500.000-3.000.000</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>3.000.000-5.000.000</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>5.000.000-8.000.000</option>
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}> >8.000.000</option>
                                        @elseif($key == 'c05')
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}>>60 cm</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>41-60 cm</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>21-40 cm</option>
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>0-20 cm</option>
                                        @elseif($key == 'c06')
                                            <option value="4" {{ old($key) == '4' ? 'selected' : '' }}>Tahan hama dan cuaca</option>
                                            <option value="3" {{ old($key) == '3' ? 'selected' : '' }}>Tahan cuaca</option>
                                            <option value="2" {{ old($key) == '2' ? 'selected' : '' }}>Tahan hama</option>
                                            <option value="1" {{ old($key) == '1' ? 'selected' : '' }}>Mudah rapuh</option>
                                        @endif
                                    </select>
                                    <div class="text-danger" id="{{ $key }}_error"></div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success me-2" id="hitungButton">Hitung</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('perhitunganForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

        const form = document.getElementById('perhitunganForm');
        const action = form.action;

        fetch(action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.status === 422) {
                return response.json().then(data => {
                    const errors = data.errors;
                    Object.keys(errors).forEach(key => {
                        const errorElement = document.getElementById(`${key}_error`);
                        if (errorElement) {
                            errorElement.innerText = errors[key][0];
                        }
                    });
                });
            } else if (response.status === 200) {
                window.location.href = '/perhitungan/hasil';
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });
</script>
@endsection
