<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="lastUncompletedTrasactionModal"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
               <h5>List Uncompleted Transactions</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                @if ($uncompleted_transactions)
                                    Tidak ada transaksi yang belum selesai
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        @foreach ($uncompleted_transactions as $transaction)
                            <tr>
                                <td class="align-middle" style="font-weight:bold"> {{$loop->iteration}} </td>
                                <td class="align-middle" >
                                    <span style="font-size:15px;font-weight:bold;"> {{$transaction->ref_no}} </span>
                                </td>
                                <td>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Buka Transaksi">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>