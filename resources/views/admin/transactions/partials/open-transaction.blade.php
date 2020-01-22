<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="openTransactionModal"
>
    <div
        class="modal-dialog modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tidak ada Transaksi pembelian terbaru!
                </h5>
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
                    Buat baru
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