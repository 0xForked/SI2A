@extends('layouts._body.admin')

@section('title', 'Barang - Kategori')

@section('content')
<div class="section-body">
    <h2 class="section-title">Kategori</h2>
    <p class="section-lead">Daftar Kategori Barang.</p>
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
                        action="{{ route('admin.items.categories.store') }}"
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
                    <h4>Daftar Kategori Barang</h4>
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
                                <th>Total Subkategori</th>
                                <th width="200">Aksi</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">
                                        {{ ($categories->currentpage()-1) * $categories->perpage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ strtoupper($category->name) }}
                                    </td>
                                    <td>
                                        {{ ucwords($category->description) }}
                                    </td>
                                    <td>
                                        {{ $category->subcategories_count }}
                                    </td>
                                    <td>
                                        <a
                                            href="#"
                                            class="btn btn-warning"
                                            onclick="showCategory({{ $category->id }})"
                                            data-toggle="modal"
                                            data-target="#editCategory"
                                        >
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $category->id }}, 'categories')"
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
                            {{ $categories->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-include')
@include('admin.item-mgmt.categories.edit')
@endsection

@section('custom-script')
@include('admin.item-mgmt.categories.script')
@endsection