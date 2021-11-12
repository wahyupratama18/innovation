<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response};
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

class ProfileViewController extends Controller
{
    private function rendering(string $title, string $view, Request $sessions = null): Response
    {
        return Inertia::render('Profile/Overlay', [
            'sessions' => $sessions
                ? (new UserProfileController)->sessions($sessions)->all()
                : null,
            'title' => $title,
            'view' => $view
        ]);
    }
    
    public function info(): Response
    {
        return $this->rendering('Perbarui Profil', 'update-profile');
    }

    public function password(): Response
    {
        return $this->rendering('Perbarui Kata Sandi', 'update-password');
    }

    public function twoFactor(): Response
    {
        return $this->rendering('Autentikasi Dua Faktor', 'two-factor');
    }

    public function sessions(Request $request): Response
    {
        return $this->rendering('Sesi Masuk', 'sessions', $request);
    }

    public function deletion(): Response
    {
        return $this->rendering('Konfirmasi hapus akun', 'deletion');
    }
}
