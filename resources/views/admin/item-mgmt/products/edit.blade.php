@extends('layouts._body.admin')

@section('title', 'Barang - Ubah Produk')

@section('content')
<div class="section-body">
    <h2 class="section-title">Produk</h2>
    <p class="section-lead">Ubah Data Produk.</p>

    @if(!$errors->any())
        @include('layouts._part.flash')
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('admin.items.products.update', $product->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">SKU <br>(Kode Serial)</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control @error('sku') is-invalid @enderror"
                                    value="{{ (old('sku')) ? old('sku') : $product->sku }}"
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
                                    value="{{ (old('bets_number')) ? old('bets_number') : $product->bets_number }}"
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
                                    value="{{ (old('marketing_authorization_number')) ? old('marketing_authorization_number') : $product->marketing_authorization_number }}"
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
                                    value="{{ (old('expired_date')) ? old('expired_date') : $product->expired_date  }}"
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
                                    value="{{ (old('name')) ? old('name') : $product->name }}"
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
                                        <option value="{{ $category->id }}" {{ ($product->subcategory->category->id == $category->id) ? 'selected' : '' }}>
                                            {{ strtoupper($category->name) }}
                                        </option>
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Beli</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="number"
                                    name="price_buy"
                                    class="form-control @error('price_buy') is-invalid @enderror"
                                    value="{{ (old('price_buy')) ? old('price_buy') : $product->price_buy }}"
                                >
                                @error('price_buy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Jual</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="number"
                                    name="price_sell"
                                    class="form-control @error('price_sell') is-invalid @enderror"
                                    value="{{ (old('price_sell')) ? old('price_sell') : $product->price_sell }}"
                                >
                                @error('price_sell')
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
                                        <option value="{{ $unit->id }}" {{ ($product->unit_id == $unit->id) ? 'selected' : ''  }}>
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
                                        {{ ($product->status == 'ACTIVE') ? 'checked' : ''  }}
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
                                        {{ ($product->status == 'DEACTIVE') ? 'checked' : ''  }}
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
            let subcategoryCurrentId = '{{$product->subcategory->id}}'
            if(categorySelected && categorySelected != 0) {
                if (subcategoryCurrentId) {
                    onCategorySelected(categorySelected, subcategoryCurrentId)
                } else {
                    onCategorySelected(categorySelected)
                }
            }
        })

        $('#category').on('change', function () {
            var valueSelected = this.value
            if(valueSelected && valueSelected != 0) {
                onCategorySelected(valueSelected)
            }
        })

        function onCategorySelected(categoryId, selectedSubcategory) {
            $("#subcategory").empty()
            setSubcategory(categoryId, selectedSubcategory)
        }

        function setSubcategory(categoryId, selectedSubcategory) {
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
                        if(selectedSubcategory) {
                            $("#subcategory").val(selectedSubcategory);
                        }
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

