@extends('layouts._body.admin')

@section('title', 'Barang - Tambah Produk')

@section('content')
<div class="section-body">
    <h2 class="section-title">Produk</h2>
    <p class="section-lead">Tambah Produk.</p>

    @if(!$errors->any())
        @include('layouts._part.flash')
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('admin.items.products.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">SKU <br>(Kode Serial)</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control @error('sku') is-invalid @enderror"
                                    value="{{ old('sku') }}"
                                    name="sku"
                                    required
                                    autofocus
                                >
                                @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Bets <br>(Kode Produksi)</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control @error('bets_number') is-invalid @enderror"
                                    value="{{ old('bets_number') }}"
                                    name="bets_number"
                                >
                                @error('bets_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Otorisasi <br>(Kode Izin Edar/Kode Identitas Produk)</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control @error('marketing_authorization_number') is-invalid @enderror"
                                    value="{{ old('marketing_authorization_number') }}"
                                    name="marketing_authorization_number"
                                >
                                @error('marketing_authorization_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Kedaluwarsa</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control datepicker @error('expired_date') is-invalid @enderror"
                                    value="{{ old('expired_date') }}"
                                    name="expired_date"
                                >
                                @error('expired_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-7">
                                <select
                                    class="custom-select select2"
                                    name="category"
                                    id="category"
                                    style="width:100%"
                                >
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ strtoupper($category->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subkategori</label>
                            <div class="col-sm-12 col-md-7">
                                <select
                                    class="custom-select select2"
                                    name="subcategory_id"
                                    id="subcategory"
                                    style="width:100%"
                                    disabled
                                >
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="number"
                                    name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}"
                                >
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Satuan</label>
                            <div class="col-sm-12 col-md-7">
                                <select
                                    class="custom-select select2"
                                    name="unit_id"
                                    style="width:100%"
                                >
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->name . ' ('.ucwords($unit->description).')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status <br>(dalam transaksi)</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-control custom-radio">
                                    <input
                                        type="radio"
                                        id="statusAktif"
                                        value="ACTIVE"
                                        name="status"
                                        class="custom-control-input"
                                    >
                                    <label
                                        class="custom-control-label"
                                        for="statusAktif"
                                    >
                                        Aktifkan
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input
                                        type="radio"
                                        id="statusNonaktif"
                                        value="DEACTIVE"
                                        name="status"
                                        class="custom-control-input"
                                    >
                                    <label
                                        class="custom-control-label"
                                        for="statusNonaktif"
                                    >
                                        Non-Aktifkan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('custom-style')
    <link rel="stylesheet" href="{{asset('assets/css/daterangepicker.css')}}">
@endsection

@section('custom-script')
    <script src="{{asset('assets/js/modules/daterangepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            let categorySelected = $('#category').val()
            if(categorySelected && categorySelected != 0) {
                onCategorySelected(categorySelected)
            }
        })

        $('#category').on('change', function () {
            var valueSelected = this.value
            if(valueSelected && valueSelected != 0) {
                onCategorySelected(valueSelected)
            }
        })

        function onCategorySelected(categoryId) {
            $("#subcategory").empty()
            setSubcategory(categoryId)
        }

        function setSubcategory(categoryId) {
            $('#subcategory').removeAttr('disabled')
            getSubcategories(categoryId)
                .then(data => {
                    data.forEach(subcategory => {
                        var name = subcategory.name
                        nameFormat = name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase()
                        })
                        $("#subcategory").append("<option value='"+subcategory.id+"'>"+nameFormat+"</option>")
                        $('#subcategory').trigger('change')
                    })
                })
                .catch(reason => console.log(reason.message))
        }

        async function getSubcategories(categoryId) {
            try {
                var apiUri = '/api/v1/category/'+categoryId+'/subcategories'
                const apiUrl = await(fetch(apiUri))
                const subcategories = await apiUrl.json()
                return subcategories
            }
            catch(err) { console.log(err) }
        }

    </script>
@endsection

