<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Reset Password LokaMarket</title>
</head>

<body
    style="
        margin:0;
        padding:0;
        background:#FFF9F2;
        font-family:Arial, Helvetica, sans-serif;
        color:#3D2418;
    "
>

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        style="padding:40px 15px;"
    >

        <tr>
            <td align="center">

                <table
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    style="
                        max-width:560px;
                        background:#ffffff;
                        border-radius:18px;
                        overflow:hidden;
                        border:1px solid #FDE7D2;
                    "
                >

                    {{-- HEADER --}}
                    <tr>
                        <td
                            style="
                                background:#F97316;
                                padding:28px 30px;
                                text-align:center;
                            "
                        >

                            <h1
                                style="
                                    margin:0;
                                    color:#ffffff;
                                    font-size:28px;
                                    font-weight:700;
                                "
                            >
                                LokaMarket
                            </h1>

                            <p
                                style="
                                    margin:8px 0 0;
                                    color:#FFF7ED;
                                    font-size:13px;
                                "
                            >
                                Semua Kebutuhan Lokal,
                                Satu Genggaman
                            </p>

                        </td>
                    </tr>


                    {{-- CONTENT --}}
                    <tr>
                        <td style="padding:35px 30px;">

                            <p
                                style="
                                    margin:0 0 10px;
                                    font-size:15px;
                                    color:#72594B;
                                "
                            >
                                Halo,
                            </p>

                            <h2
                                style="
                                    margin:0 0 15px;
                                    font-size:24px;
                                    color:#3D2418;
                                "
                            >
                                Reset Password
                            </h2>

                            <p
                                style="
                                    margin:0 0 18px;
                                    font-size:14px;
                                    line-height:1.7;
                                    color:#72594B;
                                "
                            >
                                Kami menerima permintaan untuk
                                mengatur ulang password akun
                                LokaMarket Anda.
                            </p>

                            <p
                                style="
                                    margin:0 0 25px;
                                    font-size:14px;
                                    line-height:1.7;
                                    color:#72594B;
                                "
                            >
                                Klik tombol di bawah untuk membuat
                                password baru.
                            </p>


                            {{-- BUTTON --}}
                            <div style="text-align:center;">

                                <a
                                    href="{{ $resetUrl }}"
                                    style="
                                        display:inline-block;
                                        background:#F97316;
                                        color:#ffffff;
                                        text-decoration:none;
                                        padding:13px 28px;
                                        border-radius:999px;
                                        font-size:14px;
                                        font-weight:bold;
                                    "
                                >
                                    Reset Password
                                </a>

                            </div>


                            <p
                                style="
                                    margin:28px 0 0;
                                    font-size:12px;
                                    line-height:1.6;
                                    color:#9CA3AF;
                                "
                            >
                                Link reset password ini akan
                                kedaluwarsa dalam waktu
                                60 menit.
                            </p>

                            <p
                                style="
                                    margin:15px 0 0;
                                    font-size:12px;
                                    line-height:1.6;
                                    color:#9CA3AF;
                                "
                            >
                                Jika Anda tidak meminta reset
                                password, Anda dapat mengabaikan
                                email ini.
                            </p>

                        </td>
                    </tr>


                    {{-- FOOTER --}}
                    <tr>
                        <td
                            style="
                                background:#FFF7ED;
                                padding:20px 30px;
                                text-align:center;
                            "
                        >

                            <p
                                style="
                                    margin:0;
                                    font-size:12px;
                                    color:#9A8174;
                                "
                            >
                                © {{ date('Y') }} LokaMarket
                            </p>

                            <p
                                style="
                                    margin:6px 0 0;
                                    font-size:11px;
                                    color:#B09A8D;
                                "
                            >
                                Platform marketplace produk
                                UMKM lokal Indonesia.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>

    </table>

</body>

</html>