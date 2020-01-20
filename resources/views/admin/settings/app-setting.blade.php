
@extends('layouts._body.admin')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="section-body">
    <h2 class="section-title">Pengaturan</h2>
    <p class="section-lead">Atur pengaturan dan maksimalkan penggunaan.</p>
    @include('layouts._part.flash')

    <div id="output-status"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Menu Pengaturan</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                data-toggle="pill"
                                role="tab"
                                id="pills-general-tab"
                                href="#pills-general"
                                aria-controls="pills-general"
                                aria-selected="true"
                            >Umum</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-toggle="pill"
                                role="tab"
                                id="pills-contact-tab"
                                href="#pills-contact"
                                aria-controls="pills-contact"
                                aria-selected="true"
                            >Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-toggle="pill"
                                role="tab"
                                id="pills-auth-tab"
                                href="#pills-auth"
                                aria-controls="pills-auth"
                                aria-selected="true"
                            >Otentikasi</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-toggle="pill"
                                role="tab"
                                id="pills-backup-tab"
                                href="#pills-backup"
                                aria-controls="pills-backup"
                                aria-selected="true"
                            >Database</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link disabled text-muted"
                                data-toggle="pill"
                                role="tab"
                                {{-- id="pills-backup-tab" --}}
                                {{-- href="#pills-backup" --}}
                                {{-- aria-controls="pills-backup" --}}
                                aria-selected="true"
                            >Automations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content" id="pills-tabContent">

                <div
                    class="tab-pane fade show active"
                    id="pills-general"
                    role="tabpanel"
                    aria-labelledby="pills-general-tab">
                    <form id="setting-form" action="{{route('admin.app.setting.generals')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>Pengaturan Umum</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    Pengaturan Umum seperti, Judul, Deskripsi, dll.
                                </p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Judul situs</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_title" class="form-control" value="{{$settings['site_title']->value}}">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Deskripsi situs</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control h-auto" name="site_description" id="site-description" rows="3">{{$settings['site_description']->value}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Logo</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                                            <label class="custom-file-label" id="site-logo-label">{{ $settings['site_logo']->value }}</label>
                                        </div>
                                        <div class="form-text text-muted">Ukuran gambar maksimal adalah 2MB</div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
                                            <label class="custom-file-label" id="site-favicon-label">{{ $settings['site_favicon']->value }}</label>
                                        </div>
                                        <div class="form-text text-muted">Ukuran gambar maksimal adalah 128kb</div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kode Pelacakan </label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="site_analytics_id" class="form-control" value="{{$settings['site_analytics_id']->value}}">
                                        <div class="form-text text-muted">Id atau Kode pelacakan untuk <a href="https://support.google.com/analytics/answer/7372977?hl=en">google analitics</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button onclick="showLoading()" type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div
                    class="tab-pane fade"
                    id="pills-contact"
                    role="tabpanel"
                    aria-labelledby="pills-contact-tab">
                    <form id="setting-form" action="{{route('admin.app.setting.contacts')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>Pengaturan Kontak</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    Kontak Dasar
                                </p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Kantor</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_address" class="form-control" value="{{ $settings['site_address']->value }}">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nomor Ponsel Kantor</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone']->value }}">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">E-Mail Kantor</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_email" class="form-control" value="{{ $settings['site_email']->value }}">
                                    </div>
                                </div>
                                <p class="text-muted">
                                    Sosial Media
                                </p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Facebook</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_facebook_link" class="form-control" value="{{ $settings['site_facebook_link']->value }}">
                                    </div>
                                </div>
                                 <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Twitter</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_twitter_link" class="form-control" value="{{ $settings['site_twitter_link']->value }}">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Instagram</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_instagram_link" class="form-control" value="{{ $settings['site_instagram_link']->value }}">
                                    </div>
                                </div>
                                <p class="text-muted">
                                    Peta
                                </p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Titik Kordinat</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="row">
                                            <input type="hidden" name="site_address_coordinate" value="true">
                                            <div class="col">
                                                <div class="form-text text-muted">Latitude</div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="e.g: 1.121212"
                                                    name="site_lat"
                                                    value="{{ extract_location_coordinate($settings['site_address_coordinate']->value)->lat}}"
                                                >
                                            </div>
                                            <div class="col">
                                                <div class="form-text text-muted">Longitude</div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="e.g: 124.121212"
                                                    name="site_lng"
                                                    value="{{extract_location_coordinate($settings['site_address_coordinate']->value)->lng}}"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-text text-muted">Ambil titik kordinat dari <a href="https://maps.google.com" target="_blank">Google Maps</a>, Anda <a href="">Butuh bantuan?</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button onclick="showLoading()" type="submit" class="btn btn-primary" >Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div
                    class="tab-pane fade"
                    id="pills-auth"
                    role="tabpanel"
                    aria-labelledby="pills-auth-tab">
                    <form id="setting-form" action="{{route('admin.app.setting.auth')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>Pengaturan Otentikasi</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    Pengaturan Otentikasi untuk mengaktifkan atau menonaktifkan Pedaftaran, Reset Password dan Email Verifikasi
                                </p>
                                <div class="form-group">
                                    <div class="control-label ml-3">Pengaturan Ulang Kata Sandi</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="site_auth_password_reset" class="custom-switch-input" {{ (app_settings()['site_auth_password_reset']->value) ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">
                                            @if (app_settings()['site_auth_password_reset']->value)
                                                Pengaturan ulang kata sandi diaktifkan
                                            @else
                                                Pengaturan ulang kata sandi dinonaktifkan
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="control-label ml-3">Pendaftaran Pengguna Baru</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="site_auth_registration" class="custom-switch-input" {{ (app_settings()['site_auth_registration']->value) ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">
                                            @if (app_settings()['site_auth_registration']->value)
                                                Pendaftaran pengguna baru diaktifkan
                                            @else
                                                Pendaftaran pengguna baru dinonaktifkan
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="control-label ml-3">Verifikasi Email Pengguna Baru</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="site_auth_email_verify" class="custom-switch-input" {{ (app_settings()['site_auth_email_verify']->value) ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">
                                            @if (app_settings()['site_auth_email_verify']->value)
                                                Verifikasi email untuk pengguna baru diaktifkan
                                            @else
                                                Verifikasi email untuk pengguna baru dinonaktifkan
                                            @endif
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="control-label ml-3">Peran Pengguna Baru</div>
                                    @foreach ($roles as $role)
                                        <div class="custom-control custom-radio ml-5">
                                            <input
                                                type="radio"
                                                id="role{{ $role->id }}"
                                                value="{{ $role->id }}"
                                                name="site_new_user_role"
                                                class="custom-control-input"
                                                {{ ((int)app_settings()['site_new_user_role']->value === $role->id) ? 'checked' : ''}}
                                            >
                                            <label
                                            class="custom-control-label"
                                            for="role{{ $role->id }}"
                                            >
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button onclick="showLoading()" type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div
                    class="tab-pane fade"
                    id="pills-backup"
                    role="tabpanel"
                    aria-labelledby="pills-backup-tab">
                    <div class="card" id="settings-card">
                        <div class="card-header">
                            <h4>Backup Manager</h4>
                            <div class="card-header-form">
                                <a
                                    onclick="showLoading()"
                                    href="{{ route('admin.setting.database.backup') }}"
                                    class="btn btn-primary pull-right float-right"
                                >
                                    <span class="ladda-label">
                                        <i class="fa fa-plus"></i> Backup
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover pb-0 mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th class="text-right">Ukuran</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($backups as $k => $b)
                                            <tr>
                                                <th scope="row">{{ $k+1 }}</th>
                                                <td>
                                                    {{ $b['file_name'] }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}
                                                </td>
                                                <td class="text-right">
                                                    {{ round((int)$b['file_size']/1048576, 2).' MB' }}
                                                </td>
                                                <td class="text-right">
                                                    <a
                                                        class="btn btn-sm btn-success"
                                                        href="{{ route('admin.setting.database.download', urlencode($b['file_name'])) }}"
                                                    >
                                                        <i class="fas fa-cloud-download-alt"></i>
                                                        Unduh
                                                    </a>
                                                    <a
                                                        onclick="showLoading()"
                                                        class="btn btn-sm btn-danger"
                                                        href="{{ route('admin.setting.database.delete', urlencode($b['file_name'])) }}"
                                                    >
                                                        <i class="fas fa-trash-alt"></i>
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-footer bg-whitesmoke">
                            <p class="mt-5 ml-5">
                                <span class="text-info">(*) ~ disini untuk informasi</span>
                            </p>
                            <p class="ml-5">
                                <span class="text-warning">(*) ~ disini untuk peringatan</span>
                            </p>
                        </div>
                    </div>

                    <div class="card" id="settings-card">
                        <div class="card-header">
                            <h4>Restore Database</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body bg-whitesmoke">
                                            <div class="empty-state" data-height="400">
                                                <div class="empty-state-icon">
                                                    <i class="fas fa-download"></i>
                                                </div>
                                                <h2>Import Basis Data</h2>
                                                <p class="lead">
                                                    Import skema basis data hasil export.
                                                    (tipe file adalah <a target="_blank" href="https://fileinfo.com/extension/sql">.sql</a>).
                                                </p>
                                                <form
                                                    id="setting-form"
                                                    action="{{route('admin.setting.database.restore')}}"
                                                    method="POST"
                                                    enctype="multipart/form-data"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group">
                                                        <div class="custom-file text-left" style="margin-top:20px">
                                                            <input type="file" name="site_database" class="custom-file-input" id="site-database">
                                                            <label class="custom-file-label" id="site-database-label">Choose</label>
                                                        </div>
                                                    </div>
                                                    <span class="input-group-btn">
                                                        <button onclick="showLoading()" type="submit" class="btn btn-primary mt-4 ml-2">Mulai Proses Restorasi</button>
                                                    </span>
                                                </form>
                                                <a href="#" class="mt-4 bb">Butuh bantuan?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection