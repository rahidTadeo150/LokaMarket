<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Pengajuan Toko - LokaMarket</title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background-color: #FFF9F2;
        font-family: Arial, Helvetica, sans-serif;
        color: #3B2115;
    "
>

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="background-color: #FFF9F2; padding: 40px 15px;"
    >
        <tr>
            <td align="center">

                <!-- Container -->
                <table
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                        max-width: 600px;
                        background-color: #ffffff;
                        border-radius: 20px;
                        overflow: hidden;
                    "
                >

                    <!-- Header -->
                    <tr>
                        <td
                            style="
                                background: #FF6B00;
                                padding: 30px 30px;
                                text-align: center;
                            "
                        >

                            <div
                                style="
                                    width: 58px;
                                    height: 58px;
                                    margin: 0 auto 14px;
                                    background-color: #ffffff;
                                    border-radius: 16px;
                                    line-height: 58px;
                                    font-size: 28px;
                                    font-weight: bold;
                                    color: #FF6B00;
                                "
                            >
                                L
                            </div>

                            <h1
                                style="
                                    margin: 0;
                                    color: #ffffff;
                                    font-size: 24px;
                                    line-height: 1.3;
                                "
                            >
                                LokaMarket
                            </h1>

                            <p
                                style="
                                    margin: 8px 0 0;
                                    color: #FFF3E2;
                                    font-size: 14px;
                                "
                            >
                                Marketplace UMKM Lokal
                            </p>

                        </td>
                    </tr>


                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 35px;">

                            <h2
                                style="
                                    margin: 0 0 15px;
                                    font-size: 22px;
                                    color: #3B2115;
                                "
                            >
                                Verifikasi Pengajuan Toko
                            </h2>

                            <p
                                style="
                                    margin: 0 0 20px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #72594B;
                                "
                            >
                                Halo,
                            </p>

                            <p
                                style="
                                    margin: 0 0 20px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #72594B;
                                "
                            >
                                Terima kasih telah mengajukan pendaftaran toko
                                di <strong style="color: #FF6B00;">LokaMarket</strong>.
                            </p>

                            <p
                                style="
                                    margin: 0 0 25px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #72594B;
                                "
                            >
                                Untuk melanjutkan proses pengajuan, silakan
                                verifikasi alamat email Anda dengan menekan
                                tombol di bawah ini.
                            </p>


                            <!-- Store Info -->
                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="
                                    margin-bottom: 30px;
                                    background-color: #FFF9F2;
                                    border-radius: 14px;
                                "
                            >
                                <tr>
                                    <td style="padding: 20px;">

                                        <p
                                            style="
                                                margin: 0 0 6px;
                                                font-size: 12px;
                                                color: #8D776A;
                                            "
                                        >
                                            PENGAJUAN TOKO
                                        </p>

                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 18px;
                                                font-weight: bold;
                                                color: #3B2115;
                                            "
                                        >
                                            {{ $pending->nama_toko }}
                                        </p>

                                    </td>
                                </tr>
                            </table>


                            <!-- Button -->
                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                            >
                                <tr>
                                    <td align="center">

                                        <a
                                            href="{{ route('cust.formDaftarToko.verify', ['token' => $pending->token_verifikasi]) }}"
                                            style="
                                                display: inline-block;
                                                padding: 14px 28px;
                                                background-color: #FF6B00;
                                                color: #ffffff;
                                                text-decoration: none;
                                                font-size: 14px;
                                                font-weight: bold;
                                                border-radius: 10px;
                                            "
                                        >
                                            Verifikasi Email
                                        </a>

                                    </td>
                                </tr>
                            </table>


                            <!-- Expired -->
                            <p
                                style="
                                    margin: 25px 0 0;
                                    text-align: center;
                                    font-size: 12px;
                                    line-height: 1.6;
                                    color: #8D776A;
                                "
                            >
                                Link verifikasi ini berlaku selama
                                <strong>30 menit</strong>.
                            </p>


                            <!-- Divider -->
                            <div
                                style="
                                    height: 1px;
                                    background-color: #F1DCC8;
                                    margin: 30px 0;
                                "
                            ></div>


                            <p
                                style="
                                    margin: 0;
                                    font-size: 13px;
                                    line-height: 1.7;
                                    color: #8D776A;
                                "
                            >
                                Jika Anda tidak merasa melakukan pengajuan
                                toko di LokaMarket, Anda dapat mengabaikan
                                email ini.
                            </p>

                        </td>
                    </tr>


                    <!-- Footer -->
                    <tr>
                        <td
                            style="
                                padding: 22px 30px;
                                background-color: #FFF3E2;
                                text-align: center;
                            "
                        >

                            <p
                                style="
                                    margin: 0 0 5px;
                                    font-size: 13px;
                                    font-weight: bold;
                                    color: #3B2115;
                                "
                            >
                                LokaMarket
                            </p>

                            <p
                                style="
                                    margin: 0;
                                    font-size: 11px;
                                    color: #8D776A;
                                "
                            >
                                Menghubungkan kebutuhanmu dengan UMKM lokal.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>