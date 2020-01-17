@extends('layouts._body.admin')

@section('title', 'Transaksi ' . transaction_type(app('request')->input('type')))

@section('content')
<div class="section-body">
    <h2 class="section-title">{{transaction_type(app('request')->input('type'))}}</h2>
    <p class="section-lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. .</p>
    @include('layouts._part.flash')

    <div class="row">
        <div class="col-md-7">
            <div class="card bg-whitesmoke">
                <div class="card-header">
                    <h4>Daftar Produk</h4>
                </div>
                <div class="card-body">
                    @if ($products->count() > 0)
                        <div class="row" id="products-list">
                            @include('admin.transactions.product')
                        </div>
                    @else
                        <span>Tidak ada data tersedia . . .</span>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-5">
           <div class="card">
                <div class="card-header">
                    <h4>Transaksi - {transaction_number}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Nama</th>
                                <th width="120">Jumlah</th>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <span style="font-size:17px;font-weight:bold;"> {nama_produk} </span>
                                </td>
                                <td>
                                    <input class="form-control" type="number">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <button class="btn btn-warning">Clear</button>
                    <button class="btn btn-primary float-right">Proses</button>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
@include('admin.transactions.script')
@endsection


