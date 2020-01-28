@extends('layouts._body.admin')

@section('title', "Laporan - Barang {$type}")

@section('content')
<div class="section-body">
    <h2 class="section-title">Laporan Barang ({{$type}})</h2>
    <p class="section-lead">Daftar Barang ({{$type}}).</p>
    @include('layouts._part.flash')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Filter Data</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="date_mo">Starting Date</label>
                                <input type="text" name="starting_date_mo" id="starting_date_mo" class="form-control datepicker" value="">
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="date_mo">Ending Date</label>
                                <input type="text" name="ending_date_mo" id="ending_date_mo" class="form-control datepicker" value="">
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="form-group">
                                <label for="date_mo">Berdasarkan</label>
                                <select class="form-control" name="status" id="status">
                                    <option
                                        value="COMPLETE"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "COMPLETE") ? 'selected' : '')
                                            : ''
                                        }}
                                    >ID</option>
                                    <option
                                        value="UNCOMPLETED"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "UNCOMPLETED") ? 'selected' : '')
                                            : ''
                                        }}
                                    >SKU</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="date_mo">Urutan</label>
                                <select class="form-control" name="status" id="status">
                                    <option
                                        value="COMPLETE"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "COMPLETE") ? 'selected' : '')
                                            : ''
                                        }}
                                    >Ascending (kecil ke besar)</option>
                                    <option
                                        value="UNCOMPLETED"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "UNCOMPLETED") ? 'selected' : '')
                                            : ''
                                        }}
                                    >Descending (besar ke kecil)</option>
                                </select>
                            </div>
                        </div>
                        <div
                            class="col-12 col-sm-4 col-md-1"
                            style="display: flex !important; flex: 1 0 50%; align-items: center; justify-content: center;">
                            <button
                                class="btn btn-primary btn-create btn-block "
                                id="go_filter"
                                disabled
                            >
                                GO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Barang ({{$type}})</h4>
                    <div class="card-header-form">
                        @php
                            $item_type = ($type == 'Kedaluwarsa') ? "expired" : "stock";
                        @endphp
                        <form
                            method="GET"
                            action="{{ route('admin.reports.items.list', $item_type) }}"
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            @if ($type == 'Stok')
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Persediaan</th>
                                    <th>Status</th>
                                </tr>
                            @endif
                            @if ($type == 'Kedaluwarsa')
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kedaluwarsa</th>
                                    <th>Status</th>
                                </tr>
                            @endif
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ ($products->currentpage()-1) * $products->perpage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <b>Serial</b>: {{ $product->sku }} <br>
                                        <b>Produksi</b>: {{ $product->bets_number }} <br>
                                        <b>Identitas</b>: {{ $product->marketing_authorization_number }} <br>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if ($type == 'Stok')
                                            {{ $product->stock }}
                                        @endif
                                        @if ($type == 'Kedaluwarsa')
                                            {{ $product->expired_date }}
                                        @endif
                                    </td>
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
                <div class="card-footer float-right">
                    <a
                        class="btn btn-primary float-right disabled"
                        href=""
                        target="_blank"
                    >
                        <i class="fas fa-file-pdf"></i>
                        Preview
                    </a>
                    <a
                        class="btn btn-primary float-right mr-2 disabled"
                        href="?download"
                    >
                        <i class="fas fa-file-download"></i>
                        Download
                    </a>
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
            window.location='{{ route('admin.reports.items.list', $item_type) }}'
        }
    });
</script>
@endsection