<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="itemQtyModal"
>
    <div
        class="modal-dialog modal-sm"
        role="document"
    >
        <form action="{{route('admin.transactions.item.qty')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Quantitas <span id="item_name"></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="item_id" id="item_id">
                    <input class="form-control" name="add_qty" id="add_qty">
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Tutup
                    </button>

                    <button onclick="showLoading()"" type="submit" class="btn btn-primary">
                        Ubah
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>