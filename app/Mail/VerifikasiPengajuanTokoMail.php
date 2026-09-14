<?php

namespace App\Mail;

use App\Models\pending_pengajuan_toko;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiPengajuanTokoMail extends Mailable
{
    use Queueable, SerializesModels;

    public pending_pengajuan_toko $pending;

    public function __construct(pending_pengajuan_toko $pending)
    {
        $this->pending = $pending;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Pengajuan Toko - LokaMarket'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.verify-pengajuan-toko'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}