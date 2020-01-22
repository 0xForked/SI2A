<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="processTransactionModal"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5>Proses Penyelesaian Transaksi <br> <span class="text-primary">{{($transaction) ? $transaction->ref_no : ''}}</span></h5>
            </div>
            <div class="modal-body">
                <p>
                    Lengkapi data dibawah ini untuk menyelesaikan transaksi!
                </p>
                <div class="form-group">
                    <label>No. Surat</label>
                    <input type="text" name="letter_no"  class="form-control">
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control h-auto" name="notes"></textarea>
                </div>
                @if (Request::segment(3) == 'selling')
                    <div class="form-group">
                        <div class="control-label ">Data pembeli</div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="customer_select_radio" id="customer_select_radio" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description" id="customer_select_description">
                                        Dinonaktifkan
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-4 ml-5" style="display:none;" id="customer_container">
                                <select
                                    class="custom-select select2"
                                    name="customer_select"
                                    id="customer_select"
                                    style="width:240px;"
                                    disabled
                                >
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ml-5" id="customer_name_container">
                                <input type="text" style="width:240px;" class="form-control" name="custumer_name_input" id="custumer_name" placeholder="Masukkan nama pembeli">
                            </div>
                        </div>
                    </div>
                @endif
                {{-- @if (Request::segment(3) == 'purchase')
                    <div class="form-group">
                        <div class="control-label ">Data pemasok</div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="supplier_select_radio" id="supplier_select_radio" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description" id="supplier_select_description">
                                        Dinonaktifkan
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-4 ml-5" style="display:none;" id="supplier_container">
                                <select
                                    class="custom-select select2"
                                    name="supplier_select"
                                    id="supplier_select"
                                    style="width:240px;"
                                    disabled
                                >
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ml-5" id="supplier_name_container">
                                <input type="text" style="width:240px;" class="form-control" name="supplier_name_input" id="supplier_name" placeholder="Masukkan nama pemasok">
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Tutup
                </button>
                <a  href=""
                    onclick="event.preventDefault();
                    document.getElementById('process-transaction-form').submit();"
                    class="btn btn-primary"
                >
                    Proses Transaksi
                </a>
                <form
                    id="process-transaction-form"
                    action=""
                    method="POST"
                    style="display: none;"
                >
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>