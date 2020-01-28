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
        <form action="{{route('admin.transactions.process', (($transaction) ? $transaction->id : ''))}}" method="post">
            @csrf
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
                        <textarea class="form-control h-auto" name="note"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sumber Dana</label>
                        <input type="text" name="funding"  class="form-control">
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
                                    <input type="text" style="width:240px;" class="form-control" name="customer_name_input" id="customer_name_input" placeholder="Masukkan nama pembeli">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="control-label ">Data Pejabat Penerima</div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="supplier_pejabat" id="supplier_pejabat_radio" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description" id="supplier_pejabat_description">
                                        Default
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-4 ml-5" id="site_default_people_name_assign_container">
                                <input type="text" style="width:240px;" class="form-control mb-2" name="site_default_people_name_assign" id="site_default_people_name_assign" value="{{app_settings()['site_default_people_name_assign']->value}}" readonly>
                                <input type="text" style="width:240px;" class="form-control" name="site_default_people_nip_assign" id="site_default_people_nip_assign" value="{{app_settings()['site_default_people_nip_assign']->value}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
                        Proses Transaksi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>