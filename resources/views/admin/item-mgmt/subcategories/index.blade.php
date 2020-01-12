@extends('layouts._body.admin')

@section('title', 'Barang - Subkategori')

@section('content')
<div class="section-body">
    <h2 class="section-title">Subkategori</h2>
    <p class="section-lead">Daftar Subkategori Barang.</p>
    @include('layouts._part.flash')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah baru</h4>
                </div>
                <div class="card-body">
                    <form
                        method="post"
                        action="{{ route('admin.items.subcategories.store') }}"
                    >
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control h-auto" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
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
                    <h4>Daftar Subkategori Barang</h4>
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
                                <th>Kategori</th>
                                <th>Total Produk</th>
                                <th width="200">Aksi</th>
                            </tr>
                            @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td class="text-center">
                                        {{ ($subcategories->currentpage()-1) * $subcategories->perpage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $subcategory->name }}
                                    </td>
                                    <td>
                                        {{ $subcategory->description }}
                                    </td>
                                    <td>
                                        @if ($subcategory->category)
                                            <a href="{{ route('admin.items.categories.index') }}?search={{ $subcategory->category->name }}">
                                                {{ $subcategory->category->name }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $subcategory->products_count }}
                                    </td>
                                    <td>
                                        <a
                                            href="#"
                                            class="btn btn-warning"
                                            onclick="showSubcategory({{ $subcategory->id }})"
                                            data-toggle="modal"
                                            data-target="#editSubcategory"
                                        >
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $subcategory->id }}, 'subcategories')"
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
                            {{ $subcategories->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-include')
@include('admin.item-mgmt.subcategories.edit')
@endsection

@section('custom-script')
@include('admin.item-mgmt.subcategories.script')
@endsection