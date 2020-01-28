@extends('layouts._body.admin')

@section('title', 'Barang - Produk')

@section('content')
<div class="section-body">
    <h2 class="section-title">Produk</h2>
    <p class="section-lead">Daftar Produk.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Produk</h4>
                    <div class="card-header-form">
                        <form
                            method="GET"
                            action="{{ route('admin.items.products.store') }}"
                        >
                            <div class="input-group">
                                <select name="search_key" class="form-control" style="font-size:12px; height:40px" >
                                    <option value="sku" {{
                                        (app('request')->input('search_key'))
                                        ? (((app('request')->input('search_key')) == "sku") ? 'selected' : '')
                                        : ''
                                    }}>SKU</option>
                                    <option value="bets_number" {{
                                        (app('request')->input('search_key'))
                                        ? (((app('request')->input('search_key')) == "bets_number") ? 'selected' : '')
                                        : ''
                                    }}>BETS</option>
                                    <option value="name" {{
                                        (app('request')->input('search_key'))
                                        ? (((app('request')->input('search_key')) == "name") ? 'selected' : '')
                                        : ''
                                    }}>NAMA</option>
                                </select>

                                <input
                                    type="search"
                                    class="form-control ml-3"
                                    placeholder="Kata kunci"
                                    name="search_value"
                                    style="height:40px"
                                    value="{{ (app('request')->input('search_value')) ? app('request')->input('search_value') : ''}}"
                                >

                                <div class="input-group-btn">
                                    <button class="btn btn-primary" value="search" style="height:40px">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-primary ml-2" style="height:40px" onClick="window.location='{{ route('admin.items.products.create') }}'"><i class="fas fa-plus"></i> Tambah baru</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Persediaan</th>
                                <th>Kedaluwarsa</th>
                                <th>Status</th>
                                <th width="300">Aksi</th>
                            </tr>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        {{ ($products->currentpage()-1) * $products->perpage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <b>Serial</b>: {{ $product->sku }} <br>
                                        <b>Produksi</b>: {{ $product->bets_number }} <br>
                                        <b>Identitas</b>: {{ $product->marketing_authorization_number }} <br>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->expired_date }}</td>
                                    <td>
                                        <a
                                            href="#"
                                            data-toggle="modal"
                                            data-target="#statusModal"
                                            data-status="{{ $product->status }}"
                                        >
                                            @if ($product->status == 'ACTIVE')
                                                <div class="badge badge-success">{{$product->status}}</div>
                                            @else
                                                <div class="badge badge-secondary">{{$product->status}}</div>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.items.products.show', $product->id) }}" class="btn btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.items.products.edit', $product->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $product->id }}, 'products')"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                        >
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $products->appends(request()->query())->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1){
            window.location='{{ route('admin.items.products.store') }}'
        }
    });
</script>
@endsection