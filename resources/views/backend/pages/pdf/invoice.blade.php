<!DOCTYPE html>
<html lang="en">

<head>
    <title>Invoice Order</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Roboto:400,700');

        /* Your CSS styles here */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        div,
        p,
        a,
        li,
        td {
            -webkit-text-size-adjust: none;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        .ExternalClass {
            width: 100%;
            background-color: #ffffff;
        }

        body {
            width: 100%;
            height: 100%;
            background-color: #e1e1e1;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        html {
            width: 100%;
        }

        p {
            padding: 0 !important;
            margin-top: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 0 !important;
            margin-left: 0 !important;
        }

        .visibleMobile {
            display: none;
        }

        .hiddenMobile {
            display: block;
        }

        @media only screen and (max-width: 600px) {
            body {
                width: auto !important;
            }

            table[class=fullTable] {
                width: 96% !important;
                clear: both;
            }

            table[class=fullPadding] {
                width: 85% !important;
                clear: both;
            }

            table[class=col] {
                width: 45% !important;
            }

            .erase {
                display: none;
            }
        }

        @media only screen and (max-width: 420px) {
            table[class=fullTable] {
                width: 100% !important;
                clear: both;
            }

            table[class=fullPadding] {
                width: 85% !important;
                clear: both;
            }

            table[class=col] {
                width: 100% !important;
                clear: both;
            }

            table[class=col] td {
                text-align: left !important;
            }

            .erase {
                display: none;
                font-size: 0;
                max-height: 0;
                line-height: 0;
                padding: 0;
            }

            .visibleMobile {
                display: block !important;
            }

            .hiddenMobile {
                display: none !important;
            }
        }
    </style>
</head>


<!-- Header -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tr>
        <td height="20"></td>
    </tr>
    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>

                <tr>
                    <td>
                        <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullPadding">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="220" border="0" cellpadding="0" cellspacing="0"
                                            align="left" class="col">
                                            <tbody>
                                                <tr>
                                                    <td align="left">
                                                        <img src="{{ asset('/images/logo.png') }}" width="75"
                                                            height="32" alt="logo" border="0" />
                                                    </td>
                                                </tr>
                                                <tr class="hiddenMobile">
                                                    <td height="40"></td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #5b5b5b;  line-height: 18px; vertical-align: top; text-align: left;">
                                                        Hello,
                                                        <b>{{ $orderdetail->order->customer->nama_customer }}</b>.
                                                        <br> Berikut detail informasi tagihan layanan yang wajib
                                                        dibayarkan.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="220" border="0" cellpadding="0" cellspacing="0"
                                            align="right" class="col">
                                            <tbody>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 21px; color: #4680FF; letter-spacing: -1px;  line-height: 1; vertical-align: top; text-align: right;">
                                                        Invoice
                                                    </td>
                                                </tr>
                                                <tr>
                                                <tr class="hiddenMobile">
                                                    <td height="50"></td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #5b5b5b;  line-height: 18px; vertical-align: top; text-align: right;">
                                                        Invoice Number : <b
                                                            style="font-size: 12px; color: #232323;">{{ $orderdetail->invoice_number }}</b><br />
                                                        Jatuh Tempo : <b
                                                            style="font-size: 12px; color: #232323;">{{ Carbon\Carbon::parse($orderdetail->due_date)->format('d F Y') }}</b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- /Header -->
<!-- Order Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                    bgcolor="#ffffff">
                    <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                            <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="40"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <th style="font-size: 12px;  color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="52%" align="left">
                                                <b>Paket</b>
                                            </th>
                                            <th style="font-size: 12px;  color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                align="left">
                                                <b>Jatuh Tempo</b>
                                            </th>
                                            <th style="font-size: 12px;  color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                align="center">
                                                <b>Status</b>
                                            </th>
                                            <th style="font-size: 12px;  color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                align="right">
                                                <b>Tagihan</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td height="1" style="background: #bebebe;" colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td height="10" colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px;  color: #4680FF;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                class="article">
                                                {{ $orderdetail->order->paket->nama_paket . ' (' . $orderdetail->order->paket->jenis_paket . ')' }}
                                            </td>
                                            <td
                                                style="font-size: 12px;  color: #4680FF;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                {{ Carbon\Carbon::parse($orderdetail->due_date)->format('d F Y') }}
                                            </td>
                                            <td align="center">
                                                @if ($orderdetail->is_payed == 1)
                                                    <p
                                                        style="font-size: 12px;  color: #4680FF;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                        Lunas</p>
                                                @elseif($orderdetail->is_payed == 0)
                                                    <p
                                                        style="font-size: 12px;  color: #ff4646;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                        Belum Lunas</p>
                                                @else
                                                    <p>Isolir</p>
                                                @endif
                                            </td>
                                            <td style="font-size: 12px;  color: #4680FF;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                align="right">
                                                @php
                                                    $formatted_price = Number::currency(
                                                        $orderdetail->order->paket->harga_paket,
                                                        'IDR',
                                                        'id',
                                                    );
                                                @endphp
                                                {{ str_replace(',00', '', $formatted_price) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="1" colspan="4"
                                                style="border-bottom:1px solid #e4e4e4"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Order Details -->
<!-- Total -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
    bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>

                                <!-- Table Total -->
                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="font-size: 12px;  color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Biaya Admin
                                            </td>
                                            <td
                                                style="font-size: 12px;  color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                @php
                                                    $admin_price = Number::currency(
                                                        $orderdetail->biaya_admin,
                                                        'IDR',
                                                        'id',
                                                    );
                                                @endphp
                                                @if ($orderdetail->biaya_admin == 0)
                                                    -
                                                @else
                                                    {{ str_replace(',00', '', $admin_price) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px;  color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Grand Total </strong>
                                            </td>
                                            <td
                                                style="font-size: 12px;  color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>
                                                    @php
                                                        $grand = Number::currency(
                                                            $orderdetail->order->paket->harga_paket +
                                                                $orderdetail->biaya_admin,
                                                            'IDR',
                                                            'id',
                                                        );
                                                    @endphp
                                                    {{ str_replace(',00', '', $grand) }}
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /Table Total -->

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Total -->
<!-- Information -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
    bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                            <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="40"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                    align="left" class="col">

                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="font-size: 12px;  color: #4680FF; line-height: 1; vertical-align: top; ">
                                                                <strong>INFORMASI PEMBAYARAN</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 10px;  color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                <b>PT. Global Data Network</b></br>
                                                                Jl. Dinoyo Tenun No 109, RT.006/RW.003, Kel, Keputran,
                                                                Kec, Tegalsari, </br>Kota Surabaya, Jawa Timur 60265.
                                                                Phone : <a href="tel:+6285731770730">085731770730</a> /
                                                                <a href="tel:+6285648747901">085648747901</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>


                                                <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                    align="right" class="col">
                                                    <tbody>
                                                        <tr class="visibleMobile">
                                                            <td height="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 12px;  color: #4680FF; line-height: 1; vertical-align: top; ">
                                                                <strong>METODE BAYAR</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 10px;  color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                Transfer ke salah satu rekening terlampir, dan lampirkan bukti pembayaran ke WA sebagai bukti bayar</br></br>
                                                                MANDIRI : <b>1410014462964</b></br>
                                                                BCA : <b>8220725511</b></br>
                                                                BRI : <b>319201004897506</b></br>
                                                                BNI : <b>1255306543</b></br>
                                                                AN :  <a style="font-size: 10px;  color: #4680FF;"><b>PUTUT WAHYUDI</b></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="hiddenMobile">
                            <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="30"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Information -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
    bgcolor="#e1e1e1">

    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                <tr>
                    <td>
                        <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullPadding">
                            <tbody>
                                <tr>
                                    <td
                                        style="font-size: 10px; color: #5b5b5b;  line-height: 18px; vertical-align: top; text-align: left;">
                                        <p>Kami ingin mengucapkan terima kasih atas kepercayaan Anda menggunakan layanan
                                            internet kami.
                                            Semoga layanan yang kami berikan dapat memenuhi kebutuhan Anda dengan baik.
                                            Terima kasih atas dukungan dan kesetiaan Anda sebagai pelanggan kami.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="spacer">
                    <td height="50"></td>
                </tr>

            </table>
        </td>
    </tr>
    <tr>
        <td height="20"></td>
    </tr>
</table>
