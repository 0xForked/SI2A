<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @include('document.partials.bootstrap')
        @include('document.partials.style')
        <title>{{$transaction->ref_no}}</title>
    </head>
    <body>
        <section class="section">
            <div class="section-head mt-3 text-center">
                <div class="letter-cop">
                    <span style="display:block;font-size:15px;font-weight:bold;">
                        PEMERINTAH PROVINSI SULAWESI UTARA
                    </span>
                    <span style="display:block;font-size:20px;font-weight:bold;">
                        DINAS KESEHATAN DAERAH
                    </span>
                    <span style="display:block;font-size:11px;">
                        JALAN 17 AGUSTUS TELEPON 850809, 862892 FAX. (0431) 850809
                    </span>
                    <span style="display:block;font-size:11px;">
                        E-Mail: dinkessulut17@gmail.com
                    </span>
                    <span style="display:block;font-size:11px;">
                        MANADO 95119
                    </span>
                </div>
                <hr class="line ml-3 mr-3 mt-3">
            </div>
            <div class="section-body">
                <div class="letter-info text-center mb-3">
                    <span style="display:block;font-size:11px;font-weight:bold;">
                        SURAT BUKTI BARANG KELUAR (SBBK)
                    </span>
                    <span style="display:block;font-size:11px;font-weight:bold;">
                        NO. ...../BUFFER/SDKFARMALKES/...../{{date('Y')}}
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-12 letter-no">
                        <table class="ml-3">
                            <tr style="font-size:11px;font-weight:bold;">
                                <td>
                                    Untuk <br>
                                    No Surat
                                </td>
                                <td>
                                    :   @php
                                            $assign_by = json_decode($transaction->assign_by);
                                            $customer =  "";
                                            if (isset($transaction->customer)) {
                                                $customer = $transaction->customer->name;
                                            }
                                            else {
                                                $customer = (isset($assign_by->customer)) ? $assign_by->customer : 'NOT_DEFINED';
                                            }
                                            echo $customer
                                        @endphp <br>
                                    : {{$transaction->letter_no}}
                                </td>
                                <td style="padding-top:20px;padding-left:70px">
                                    Tgl. Surat: {{ date('d/m/Y', strtotime($transaction->updated_at)) }}
                                </td>
                                <td style="padding-top:20px;padding-left:100px">
                                    No. Agenda : -
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="list m-3">
                    <table class="table table-bordered" style="font-size:11px;">
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
                            @foreach ($transaction->items as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->product->unit->description}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->product->expired_date}}</td>
                                    <td>{{$item->product->bets_number}}</td>
                                    <td>Rp.{{rupiah($item->product->price_sell)}},-</td>
                                    <td>Rp.{{rupiah($item->total)}},-</td>
                                    <td>{{$transaction->funding}}</td>
                                </tr>
                            @endforeach
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
                                <td>Rp.{{rupiah($transaction->total)}},-</td>
                                <td style="border: none !important;"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="section-footer" style="margin-top:30px">
                <table style="font-size:11px;">
                    <tr>
                        <td style="padding-left:80px">
                            <span style="display:block;font-weight:bold;pading-top:150px">
                                Yang Mengeluarkan
                            </span>
                            <span style="display:block;font-weight:bold;margin-top:80px">
                                .............................................................
                                <br>NIP.
                            </span>
                        </td>
                        <td style="padding-left:200px">
                            <span style="display:block;font-weight:bold;">
                                Manado, {{date('d')}} Januari 2020
                                <br>Yang Menerima
                            </span>
                            <span style="display:block;font-weight:bold;margin-top:64px">
                                ...............................................................
                                <br>NIP.
                            </span>
                        </td>
                    </tr>
                </table>
                <table style="font-size:11px;margin-top:50px">
                    <tr class="text-center">
                        <td style="padding-left:280px">
                            <span style="display:block;font-weight:bold;">
                                Mengetahui Pejabat
                            </span>
                            <span style="display:block;font-weight:bold;margin-top:80px">
                                <span style="text-decoration:underline;">{{app_settings()['site_default_people_name_assign']->value}}</span>
                                <br>NIP. {{app_settings()['site_default_people_nip_assign']->value}}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </body>
</html>