@extends('layouts._body.admin')

@section('title', 'Barang - Produk')

@section('content')
<div class="section-body">
    <h2 class="section-title">Produk</h2>
    <p class="section-lead">Daftar Produk.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Produk</h4>
                    <div class="card-header-form">
                        <form
                            method="GET"
                            action=""
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
                    <button class="btn btn-primary ml-2" onClick="window.location='{{ route('admin.users.create') }}'"><i class="fas fa-plus"></i> Tambah baru</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Harga/Satuan</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th width="300">Aksi</th>
                            </tr>
                            {{-- @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">
                                        {{ ($users->currentpage()-1) * $users->perpage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <div class="badge badge-light">
                                            {{ $user->getRoleNames()->first() }}
                                        </div>
                                    </td>
                                    <td>
                                        <a
                                            href="#"
                                            data-toggle="modal"
                                            data-target="#statusModal"
                                            data-status="{{ $user->status }}"
                                        >
                                            @if ($user->status == 'ACTIVE')
                                                <div class="badge badge-success">{{$user->status}}</div>
                                            @else
                                                <div class="badge badge-secondary">{{$user->status}}</div>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $user->id }}, 'users')"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                        >
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{-- {{ $users->links() }} --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('custom-include')
@include('admin.user-mgmt.users.status')
@endsection

@section('custom-script')
@include('admin.user-mgmt.users.script')
@endsection --}}