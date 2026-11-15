<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class notificationLokaMarket extends Notification
{
    use Queueable;

    protected string $judul;

    protected string $pesan;

    protected string $url;

    protected string $icon;

    public function __construct(
        string $judul,
        string $pesan,
        string $url,
        string $icon = 'fa-bell'
    ) {
        $this->judul = $judul;
        $this->pesan = $pesan;
        $this->url = $url;
        $this->icon = $icon;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'judul' => $this->judul,
            'pesan' => $this->pesan,
            'url' => $this->url,
            'icon' => $this->icon,
        ];
    }
}
