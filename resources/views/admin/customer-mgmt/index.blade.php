@extends('layouts._body.admin')

@section('title', 'Data Pelangan')

@section('content')
<div class="section-body">
    <h2 class="section-title">Data Pelangan</h2>
    <p class="section-lead">Daftar data pelangan yang sering membeli produk.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pelangan </h4>
                    <div class="card-header-form">
                        <form
                            method="GET"
                            action="{{ route('admin.customers.index') }}"
                        >
                            <div class="input-group">
                                <input
                                    type="search"
                                    class="form-control"
                                    placeholder="Cari"
                                    name="search"
                                    value="{{ (app('request')->input('search')) ? app('request')->input('search') : ''}}"
                                >
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" value="search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        data-toggle="modal"
                        data-target="#addCustomer"
                    ><i class="fas fa-plus"></i> Tambah baru</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No Telp.</th>
                                <th width="400">Aksi</th>
                            </tr>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="text-center">
                                        {{ ($customers->currentpage()-1) * $customers->perpage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <button
                                            data-toggle="modal"
                                            data-target="#editCustomer"
                                            onclick="showCustomer({{ $customer->id }})"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </button>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $customer->id }}, 'customers')"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                        >
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $customers->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-include')
@include('admin.customer-mgmt.add')
@include('admin.customer-mgmt.edit')
@endsection

@section('custom-script')
@include('admin.customer-mgmt.script')
@endsection