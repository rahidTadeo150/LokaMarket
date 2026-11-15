<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class notificationController extends Controller
{
    public function index()
    {
        // $user = Auth::user();

        // $notifikasi = $user->notifications()
        //     ->latest()
        //     ->paginate(15);

        // $jumlahBelumDibaca = $user->unreadNotifications()->count();

        // return view('notification.index', compact(
        //     'notifikasi',
        //     'jumlahBelumDibaca'
        // ));
    }

    public function read(string $id)
    {
        $notifikasi = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $url = $notifikasi->data['url'] ?? null;

        $notifikasi->markAsRead();

        if (
            ! is_string($url) ||
            ! str_starts_with($url, '/') ||
            str_starts_with($url, '//')
        ) {
            return redirect()->back();
        }

        return redirect()->to($url);
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications()->update([
            'read_at' => now(),
        ]);

        return redirect()->back()->with(
            'success',
            'Semua notifikasi berhasil ditandai sudah dibaca.'
        );
    }

    public function delete(string $id)
    {
        Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail()
            ->delete();

        return redirect()->back()->with(
            'success',
            'Notifikasi berhasil dihapus.'
        );
    }

    public function deleteAll()
    {
        Auth::user()->notifications()->delete();

        return redirect()->back()->with(
            'success',
            'Semua notifikasi berhasil dihapus.'
        );
    }
}
