<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="addItemModal"
>
    <div
        class="modal-dialog modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <span id="item_name"></span>
                <input type="hidden" name="transaction_id" id="transaction_id" value={{$transaction->id}}>
                <input type="hidden" name="item_id" id="item_id">
                <input type="number" name="item_qty" id="item_qty" class="form-control p-5">
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Tutup
                </button>

                <a  href="{{ route('admin.transactions.open', 'purchase') }}"
                    onclick="event.preventDefault();
                    document.getElementById('open-transaction-form').submit();"
                    class="btn btn-primary"
                >
                    Tambah Item
                </a>
                <form
                    id="open-transaction-form"
                    action="{{ route('admin.transactions.open', 'purchase') }}"
                    method="POST"
                    style="display: none;"
                >
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>