@extends('layouts._body.admin')

@section('title', 'Data Pemasok')

@section('content')
<div class="section-body">
    <h2 class="section-title">Data Pemasok</h2>
    <p class="section-lead">Daftar data pemasok yang sering menjual produk.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pelangan </h4>
                    <div class="card-header-form">
                        <form
                            method="GET"
                            action="{{ route('admin.suppliers.index') }}"
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
                        data-target="#addSupplier"
                    ><i class="fas fa-plus"></i> Tambah baru</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Email</th>
                                <th>No Telp.</th>
                                <th width="400">Aksi</th>
                            </tr>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="text-center">
                                        {{ ($suppliers->currentpage()-1) * $suppliers->perpage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->city }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>
                                        <button
                                            data-toggle="modal"
                                            data-target="#editSupplier"
                                            onclick="showSupplier({{ $supplier->id }})"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </button>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $supplier->id }}, 'suppliers')"
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
                            {{ $suppliers->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom-include')
@include('admin.supplier-mgmt.add')
@include('admin.supplier-mgmt.edit')
@endsection

@section('custom-script')
@include('admin.supplier-mgmt.script')
@endsection