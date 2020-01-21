@extends('layouts._body.admin')

@section('title', 'Transaksi ' . transaction_type(app('request')->input('type')))

@section('content')
<div class="section-body">
    <h2 class="section-title">{{transaction_type(app('request')->input('type'))}}</h2>
    <p class="section-lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. .</p>
    @include('layouts._part.flash')

    <div class="row">
        <div class="col-md-7">
            <div class="card-transparent">
                <div class="mt-3">
                    <h5>Daftar Produk ({{$products->count()}})</h5>
                </div>
                <div class="card-body">
                    @if ($products->count() > 0)
                        <div class="row" id="products-list">
                            @include('admin.transactions.product')
                        </div>
                    @else
                        <span>Tidak ada produk tersedia . . .</span>
                    @endif
                </div>
                <div class="text-center">
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
                    <h4>Transaksi Pembelian (STOK) <br> Ref : {{($transaction) ? $transaction->ref_no : 'NONE'}}</h4>
                    <div class="card-header-form" data-toggle="tooltip" data-placement="top" title="Transaksi Belum Selesai">
                        <button class="btn btn-primary" value="search"  data-toggle="modal"
                        data-target="#lastUncompletedTrasactionModal">
                            <i class="far fa-list-alt"></i>
                        </button>
                    </div>
                </div>
                @if ($transaction)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($transaction->items as $item)
                                    <tr>
                                        <td class="align-middle" style="font-weight:bold">1</td>
                                        <td class="align-middle" >
                                            <span style="font-size:13px;font-weight:bold;"> {{$item->name}} </span>
                                        </td>
                                        <td class="align-middle" style="font-size:13px;font-weight:bold;">
                                            Rp.{{rupiah($item->price)}},-
                                        </td>
                                        {{-- <td class="align-middle" width="120">
                                            <div class="qty">
                                                <span class="minus bg-dark mt-1">-</span>
                                                <input type="number" class="count" name="qty" value="{{$item->qty}}">
                                                <span class="plus bg-dark mt-1">+</span>
                                            </div>
                                        </td> --}}
                                        {{-- <td>
                                            <div class="center">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-sm btn-default  btn-number " onclick="OnChangeCountButton(this)" data-type="minus" data-field="quant[1]"><span class="minus bg-dark mt-1">-</span></button>
                                                    </span>
                                                    <input name="quant[1]" onkeydown="inputnumeronkeydown(event)" class="form-control input-sm input-number planQuantity" value="0" min="0" max="100" type="text">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-sm btn-default btn-number" onclick="OnChangeCountButton(this)" data-type="plus" data-field="quant[1]"><span class="plus bg-dark mt-1">+</span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td class="align-middle">
                                            <a href="#" class="btn btn-icon btn-outline-info" data-toggle="modal"
                                            data-target="#itemQtyModal" onclick="addQty({{$item->id}},'{{$item->name}}',{{$item->qty}});">
                                                {{$item->qty}}
                                            </a>
                                        </td>
                                        <td class="align-middle" style="font-size:13px;font-weight:bold;">
                                            Rp.{{rupiah($item->total)}},-
                                        </td>
                                        <td class="align-middle" width="10">
                                            <a  href="{{ route('admin.transactions.item.remove', $item->id) }}"
                                                onclick="showLoading();event.preventDefault();
                                                document.getElementById('remove-item-form').submit();"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form
                                                id="remove-item-form"
                                                action="{{ route('admin.transactions.item.remove', $item->id) }}"
                                                method="POST"
                                                style="display: none;"
                                            >
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if (count($transaction->items) == 0)
                                Item belum ditambahkan
                            @endif
                            @if (count($transaction->items) > 0)
                                <hr>
                                <div class="float-right text-bold">
                                    <table>
                                        <tr>
                                            <td class="pr-3">
                                                <h5>Disc  </h5>
                                            </td>
                                            <td>
                                                <h5>: 0%</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pr-3">
                                                <h5>Tax  </h5>
                                            </td>
                                            <td>
                                                <h5>: 0%</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pr-3">
                                                <h5>Subtotal  </h5>
                                            </td>
                                            <td>
                                                <h5>: Rp.{{rupiah($transaction->brutto)}},-</h5>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                        @if (count($transaction->items) > 0)
                            <hr>
                            <div class="float-right text-bold">
                                <table>
                                    <tr>
                                        <td class="flaot-left pr-5">
                                            <h5>Total  </h5>
                                        </td>
                                        <td>
                                            <h5>: Rp.{{rupiah($transaction->total)}},-</h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                    @if (count($transaction->items) > 0)
                    <div class="card-footer bg-whitesmoke">
                        <button class="btn btn-primary btn-block">Proses</button>
                    </div>
                    @endif
                @endif
           </div>
        </div>
    </div>
</div>
@endsection

@section('custom-include')
@include('admin.transactions.purchase.add-qty')
@include('admin.transactions.purchase.latest-transaction')
@include('admin.transactions.purchase.open-transaction')
@endsection

@section('custom-script')
@include('admin.transactions.script')
@endsection


