<?php

namespace App\Policies;

use App\Models\SuratMasuk;
use App\Models\User;

class SuratMasukPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SuratMasuk $suratMasuk): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SuratMasuk $suratMasuk): bool
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $suratMasuk->created_by && $suratMasuk->status === 'pending';
    }

    public function delete(User $user, SuratMasuk $suratMasuk): bool
    {
        return $user->role === 'admin';
    }
}
