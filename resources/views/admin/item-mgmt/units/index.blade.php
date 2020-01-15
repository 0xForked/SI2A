@extends('layouts._body.admin')

@section('title', 'Barang - Unit')

@section('content')
<div class="section-body">
    <h2 class="section-title">Unit</h2>
    <p class="section-lead">Daftar Unit barang.</p>
    @if(!$errors->any())
        @include('layouts._part.flash')
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah baru</h4>
                </div>
                <div class="card-body">
                    <form
                        method="post"
                        action="{{ route('admin.items.units.store') }}"
                    >
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control h-auto @error('description') is-invalid @enderror" value="{{ old('description') }}" name="description"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button
                            onclick="showLoading()"
                            type="submit"
                            class="btn btn-primary float-right"
                        >
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Unit Barang</h4>
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th width="200">Aksi</th>
                            </tr>
                            @foreach ($units as $unit)
                                <tr>
                                    <td class="text-center">
                                        {{ ($units->currentpage()-1) * $units->perpage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $unit->name }}
                                    </td>
                                    <td>
                                        {{ ucwords($unit->description) }}
                                    </td>
                                    <td>
                                        <a
                                            href="#"
                                            class="btn btn-warning"
                                            onclick="showUnit({{ $unit->id }})"
                                            data-toggle="modal"
                                            data-target="#editUnit"
                                        >
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $unit->id }}, 'units')"
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
                            {{ $units->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-include')
@include('admin.item-mgmt.units.edit')
@endsection

@section('custom-script')
@include('admin.item-mgmt.units.script')
@endsection