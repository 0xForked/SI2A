<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="addCustomer"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <form
            method="post"
            action="{{ route('admin.customers.store') }}"
        >
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Customer Baru!
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telp.</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mr-auto">
                        <a href="#">Butuh bantuan?</a>
                    </div>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Tutup
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>