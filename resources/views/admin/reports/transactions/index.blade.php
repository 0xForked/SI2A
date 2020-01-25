@extends('layouts._body.admin')

@section('title', "Laporan - Transaksi {$type}")

@section('content')
<div class="section-body">
    <h2 class="section-title">Laporan Transaksi {{$type}}</h2>
    <p class="section-lead">Daftar Laporan Transaksi {{$type}}.</p>
    @include('layouts._part.flash')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="date_mo">Starting Date</label>
                                <input type="text" name="starting_date_mo" id="starting_date_mo" class="form-control datepicker" value="{{ $starting_date->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="date_mo">Ending Date</label>
                                <input type="text" name="ending_date_mo" id="ending_date_mo" class="form-control datepicker" value="{{ $ending_date->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="date_mo">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option
                                        value="COMPLETE"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "COMPLETE") ? 'selected' : '')
                                            : ''
                                        }}
                                    >Selesai</option>
                                    <option
                                        value="UNCOMPLETED"
                                        {{
                                            (app('request')->input('status'))
                                            ? (((app('request')->input('status')) == "UNCOMPLETED") ? 'selected' : '')
                                            : ''
                                        }}
                                    >Belum Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="form-group">
                                <label for="date_mo">Nominal Transaksi</label>
                                <select class="form-control" name="nominal" id="nominal">
                                    <option
                                        value="10000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "10000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.10.000,-</option>
                                    <option
                                        value="100000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "100000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.100.000,-</option>
                                    <option
                                        value="1000000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "1000000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.1000.000,-</option>
                                    <option
                                        value="10000000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "10000000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.10.000.000,-</option>
                                    <option
                                        value="100000000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "100000000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.100.000.000,-</option>
                                    <option
                                        value="1000000000"
                                        {{
                                            (app('request')->input('nominal'))
                                            ? (((app('request')->input('nominal')) == "1000000000") ? 'selected' : '')
                                            : ''
                                        }}
                                    >> Rp.1.000.000.000,-</option>
                                </select>
                            </div>
                        </div>
                        <div
                            class="col-12 col-sm-4 col-md-1"
                            style="display: flex !important; flex: 1 0 50%; align-items: center; justify-content: center;">
                            <button
                                class="btn btn-primary btn-create btn-block "
                                id="go_filter"
                            >
                                GO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($transactions->count() > 0)
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
                        @foreach ($transactions as $transaction)
                            <li class="nav-item p-1">
                                <a
                                    class="nav-link"
                                    data-toggle="pill"
                                    role="tab"
                                    id="pills-{{$transaction->ref_no}}-tab"
                                    href="#pills-{{$transaction->ref_no}}"
                                    aria-controls="pills-{{$transaction->ref_no}}"
                                    aria-selected="true"
                                    onclick="loadTransaction({{$transaction->id}});showLoading()"
                                >
                                    No Transaksi : {{$transaction->ref_no}}
                                    <br><span>{{$transaction->updated_at}}</span>
                                    <br><code class="text-{{($transaction->status == 'COMPLETE') ? 'success' : 'muted'}}">
                                        ({{$transaction->status}})
                                    </code>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="card-footer bg-whitesmoke text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $transactions->appends(request()->query())->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-footer">
                    <h4>Transaksi : <span id="transaction_id">Tidak ada yang dipilih</span></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="transaction_item" style="display:none">
                        <table class="table table-bordered table-md" id="table_transaction_item">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke" id="detail_table_transaction_footer"></div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@section('custom-style')
    <link rel="stylesheet" href="{{asset('assets/css/daterangepicker.css')}}">
@endsection

@section('custom-script')
    <script src="{{asset('assets/js/modules/daterangepicker.js')}}"></script>

    <script>
        $('#go_filter').click(function() {
            var startingDate = $('#starting_date_mo').val()
            var endingDate = $('#ending_date_mo').val()
            var status = $('#status').val()
            var nominal = $('#nominal').val()
            window.location = '{{ url('admin/reports/transactions/' . Request::segment(4)) }}'+'/'+startingDate+'/'+endingDate+'?status='+status+'&nominal='+nominal
        });

        function loadTransaction(id) {
            $.ajax({
                url : '{{url("/")}}/api/v1/transaction/'+id
            }).done(function (data) {
                $("#table_transaction_item").find('tbody').empty();
                $("#detail_table_transaction_footer").empty();

                $('#transaction_id').text(data.ref_no)
                $('#loading').hide();
                $('#transaction_item').show();
                data.items.forEach((item, i) => {
                   var item_loop = `
                        <tr>
                            <td class="text-center">`+(i+1)+`</td>
                            <td>
                                <b>Serial</b>: `+item.product.sku+`<br>
                                <b>Produksi</b>: `+item.product.bets_number+`<br>
                                <b>Identitas</b>: `+item.product.marketing_authorization_number+`<br>
                            </td>
                            <td>`+item.name+`</td>
                            <td>`+item.qty+`</td>
                        </tr>
                   `
                   $("#table_transaction_item").find('tbody').append(item_loop).trigger('change');
                });
                var button = `
                    <a
                        class="btn btn-primary float-right"
                        href="{{url('/')}}/admin/document/`+data.id+`"
                        target="_blank"
                    >
                        <i class="fas fa-file-pdf"></i>
                        Preview
                    </a>
                    <a
                        class="btn btn-primary float-right mr-2"
                        href="{{url('/')}}/admin/document/`+data.id+`?download"
                    >
                        <i class="fas fa-file-download"></i>
                        Download
                    </a>
                `
                $('#detail_table_transaction_footer').append(button).trigger('change')
            }).fail(function () {
                alert('Transaction could not be loaded.');
            });
        }
    </script>
@endsection
