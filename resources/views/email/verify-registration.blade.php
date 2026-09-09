<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Email LokaMarket</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #FFF9F2;
    font-family: Arial, Helvetica, sans-serif;
">

    <div style="
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
    ">

        <div style="
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        ">

            {{-- Icon --}}
            <div style="
                width: 64px;
                height: 64px;
                margin: 0 auto 20px;
                border-radius: 50%;
                background: #FFF1E0;
                line-height: 64px;
                font-size: 28px;
            ">
                ✉️
            </div>

            {{-- Title --}}
            <h1 style="
                margin: 0;
                color: #3B2115;
                font-size: 26px;
            ">
                Verifikasi Email Anda
            </h1>

            {{-- Greeting --}}
            <p style="
                margin-top: 20px;
                color: #72594B;
                font-size: 15px;
                line-height: 1.7;
            ">
                Halo <strong>{{ $pending->username }}</strong>,
            </p>

            <p style="
                color: #72594B;
                font-size: 15px;
                line-height: 1.7;
            ">
                Terima kasih telah mendaftar di
                <strong>LokaMarket</strong>.
            </p>

            <p style="
                color: #72594B;
                font-size: 15px;
                line-height: 1.7;
            ">
                Silakan klik tombol di bawah ini untuk
                memverifikasi alamat email Anda.
            </p>

            {{-- Button --}}
            <div style="margin: 30px 0;">

                <a
                    href="{{ $verificationUrl }}"
                    style="
                        display: inline-block;
                        padding: 14px 28px;
                        background-color: #F97316;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 10px;
                        font-weight: bold;
                        font-size: 15px;
                    "
                >
                    Verifikasi Email
                </a>

            </div>

            {{-- Expiration --}}
            <p style="
                color: #72594B;
                font-size: 13px;
                line-height: 1.6;
            ">
                Link verifikasi ini berlaku selama
                <strong>30 menit</strong>.
            </p>

            {{-- Fallback URL --}}
            <p style="
                color: #999999;
                font-size: 12px;
                line-height: 1.6;
                word-break: break-all;
            ">
                Jika tombol tidak dapat diklik, buka link berikut:
            </p>

            <p style="
                color: #F97316;
                font-size: 12px;
                word-break: break-all;
            ">
                {{ $verificationUrl }}
            </p>

            <hr style="
                margin: 30px 0;
                border: none;
                border-top: 1px solid #eeeeee;
            ">

            <p style="
                margin: 0;
                color: #999999;
                font-size: 12px;
            ">
                Email ini dikirim secara otomatis oleh LokaMarket.
            </p>

        </div>

    </div>

</body>

</html>