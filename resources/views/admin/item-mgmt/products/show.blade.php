@extends('layouts._body.admin')

@section('title', 'Barang - Detail Produk')

@section('content')
<div class="section-body">
    <h2 class="section-title">Produk</h2>
    <p class="section-lead">Detail Produk.</p>

    @if(!$errors->any())
        @include('layouts._part.flash')
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Produk</h4>
                </div>
                <div class="card-body">
                    <p>Data lengkap mengenai produk</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <td>
                                    <b>
                                        SKU <br>
                                        (Kode Serial)
                                    </b>
                                </td>
                                <td>
                                    {{$product->sku}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Nomor Bets <br>
                                        (Kode Produksi)
                                    </b>
                                </td>
                                <td>
                                    {{$product->bets_number}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Nomor Otorisasi <br>
                                        (Kode Izin Edar/Kode Identitas Produk)
                                    </b>
                                </td>
                                <td>
                                    {{$product->marketing_authorization_number}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Tanggal Kedaluwarsa
                                    </b>
                                </td>
                                <td>
                                    {{$product->expired_date}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Nama
                                    </b>
                                </td>
                                <td>
                                    {{$product->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Kategori
                                    </b>
                                </td>
                                <td>
                                    {{strtoupper($product->subcategory->category->name)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Subkategori
                                    </b>
                                </td>
                                <td>
                                    {{strtoupper($product->subcategory->name)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Harga Beli/Satuan
                                    </b>
                                </td>
                                <td>
                                    Rp. {{rupiah($product->price_buy)}},- / {{$product->unit->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Harga Jual/Satuan
                                    </b>
                                </td>
                                <td>
                                    Rp. {{rupiah($product->price_sell)}},- / {{$product->unit->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Stok (Siap Jual)
                                    </b>
                                </td>
                                <td>
                                    <span class="text-{{($product->stock > app_settings()['site_min_stock_selling']->value) ? 'success' : 'danger'}}">{{$product->stock}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Status (Dalam transaksi)
                                    </b>
                                </td>
                                <td>
                                    <span class="text-{{($product->status == 'ACTIVE') ? 'success' : 'danger'}}">{{$product->status}}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <div class="float-right">
                        <button class="btn btn-warning" type="submit" onClick="window.location='{{ route('admin.items.products.edit', $product->id) }}'">Edit</button>
                        <button
                            class="btn btn-danger"
                            type="submit"
                            onclick="deleteData({{ $product->id }}, 'products')"
                            data-toggle="modal"
                            data-target="#deleteModal"
                        >Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Perubahan</h4>
                </div>
                <div class="card-body">
                    <p>Daftar riwayat perubahan data</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($product->modifiedHistories as $modifHistory)
                            <tr>
                                <td>
                                    <b>
                                        Produk di <span class="text-warning">perbaharui</span> pada {{$modifHistory->created_at}} <br>
                                        oleh <code>{{$modifHistory->user->name}}</code>
                                    </b>
                                </td>
                            </tr>
                            @endforeach
                            @if ($product->modifiedHistories->count() > count($product->modifiedHistories))
                            <tr>
                                <td class="text-center" style ="word-break:break-all;">
                                   <span class="ml-4"> . . . . . . . . . </span>
                                </td> <td width="30"></td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    <b>
                                        Produk di <span class="text-primary">input</span> pada {{$product->created_at}} <br>
                                        oleh <code> {{app('auth')->user()->name}} </code>
                                    </b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    {{-- @if ($product->modifiedHistories->count() > count($product->modifiedHistories))
                    <div class="text-center">
                        <a href="">Lihat Semua Riwayat</a>
                    </div>
                    @endif --}}

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Transaksi (Pembelian)</h4>
                </div>
                <div class="card-body">
                    <p>Daftar transasksi barang masuk</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($transaction_purchase as $transaction)
                                @foreach ( $transaction->items as $item)
                                    <tr>
                                        <td>
                                            <b>
                                                Barang masuk sejumalah {{$item->qty}}  {{$product->unit->description}} (<span class="text-success">Stok Bertambah</span>) <br>
                                                pada tanggal : {{$item->transaction->updated_at}}<br>
                                                nomor transaksi : <a href="">{{$item->transaction->ref_no}}</a>

                                            </b>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                    {{-- @if ($transaction_purchase->count() > 5)
                    <div class="text-center">
                        <a href="">Lihat Semua Riwayat</a>
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Transaksi (Penjualan)</h4>
                </div>
                <div class="card-body">
                    <p>Daftar transaksi barang keluar</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($transaction_selling as $transaction)
                                @foreach ( $transaction->items as $item)
                                    <tr>
                                        <td>
                                            <b>
                                                Barang keluar sejumalah {{$item->qty}} {{$product->unit->description}} (<span class="text-warning">Stok Berkurang</span>)<br>
                                                pada tanggal : {{$item->transaction->updated_at}}<br>
                                                nomor transaksi : <a href="">{{$item->transaction->ref_no}}</a>

                                            </b>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                    {{-- @if ($transaction_selling->count() > 5)
                    <div class="text-center">
                        <a href="">Lihat Semua Riwayat</a>
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
