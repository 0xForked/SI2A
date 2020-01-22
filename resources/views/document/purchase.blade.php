@extends('layouts._body.document')

@section('title', 'Purchase Document Print Out')

@section('content')
    <section class="section">
        <div class="section-head mt-5 text-center">
            <div class="letter-cop">
                <span style="display:block;font-size:23px;font-weight:bold;">
                    PEMERINTAH PROVINSI SULAWESI UTARA
                </span>
                <span style="display:block;font-size:30px;font-weight:bold;">
                    DINAS KESEHATAN DAERAH
                </span>
                <span style="display:block;font-size:16px;">
                    JALAN 17 AGUSTUS TELEPON 850809, 862892 FAX. (0431) 850809
                </span>
                <span style="display:block;font-size:16px;">
                    E-Mail: dinkessulut17@gmail.com
                </span>
                <span style="display:block;font-size:16px;">
                    MANADO 95119
                </span>
            </div>
            <div class="letter-logo">
            </div>
            <hr class="line ml-3 mr-3">
        </div>
        <div class="section-body">
            <div class="letter-info text-center">
                <span style="display:block;font-size:16px;font-weight:bold;">
                    SURAT BUKTI BARANG MASUK (SBBM)
                </span>
                <span style="display:block;font-size:16px;font-weight:bold;">
                    NO. <span class="ml-3 mr-3"></span>/BUFFER/SDKFARMALKES/<span class="ml-3 mr-3"></span>/{{date('Y')}}
                </span>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 letter-no">
                    <table class="ml-3">
                        <tr style="font-size:16px;font-weight:bold;">
                            <td>Untuk</td>
                            <td>: UPTD RS TIPE C NOONGAN</td>
                        </tr>
                        <tr style="font-size:16px;font-weight:bold;">
                            <td>No Surat</td>
                            <td>: 08/UPTD.RS.TC.N/I/2019</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <span style="font-size:16px;font-weight:bold;position:absolute;bottom:0;right:0;left:0">
                        Tgl. Surat: {{ date('d/m/Y') }}
                    </span>
                </div>
                <div class="col-md-4">
                    <span style="font-size:16px;font-weight:bold;position:absolute;bottom:0;left:0;margin-left:75px">
                        No. Agenda : -
                    </span>
                </div>
            </div>
            <div class="list m-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Satuan Kemasan</th>
                            <th>Jumlah</th>
                            <th>Kadaluarsa</th>
                            <th>Nomor Bets</th>
                            <th>Harga Satuan (Rp)</th>
                            <th>Jumlah Harga (Rp)</th>
                            <th>Sumber Dana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pertamax</td>
                            <td>Botol</td>
                            <td>10</td>
                            <td>Jun 2020</td>
                            <td>LCO123</td>
                            <td>10000</td>
                            <td>100000</td>
                            <td>APBN 2020</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                            <td><b>TOTAL</b></td>
                            <td>100000</td>
                            <td style="border: none !important;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section-footer" style="margin-top:200px">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4 mt-4">
                    <span style="display:block;font-size:16px;font-weight:bold;">
                        Yang Mengeluarkan
                    </span>
                    <span style="display:block;font-size:16px;font-weight:bold;margin-top:80px">
                        .............................................................
                        <br>NIP.
                    </span>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 ml-5 pl-5">
                    <span style="display:block;font-size:16px;font-weight:bold;">
                        Manado, 8 Januari 2020
                        <br>Yang Menerima
                    </span>
                    <span style="display:block;font-size:16px;font-weight:bold;margin-top:80px">
                        ...............................................................
                        <br>NIP.
                    </span>
                </div>
                <div class="col-md-1"></div>
                <div class="col-12 text-center mt-5">
                    <span style="display:block;font-size:16px;font-weight:bold;">
                        Mengetahui Pejabat
                    </span>
                    <span style="display:block;font-size:16px;font-weight:bold;margin-top:80px">
                        <span style="text-decoration:underline;">Gerald Rundengan, S.Si.,MPH.Apt.</span>
                        <br>NIP. 19740307 1995 03 1002
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-style')
    <style>
        html body {
            height:100%;
            margin:0;
            overflow-x: hidden;
            font-family: "Times New Roman", Times, serif !important;
        }
        .line {
            border: 0;
            border-top: 7px double black;
            text-align: center;
        }
        .line:after {
            display: inline-block;
            position: relative;
            top: -15px;
            padding: 0 10px;
            background: black;
            color: black;
            font-size: 18px;
        }
        .section-footer {
            margin-top:auto;
        }
    </style>
@endsection