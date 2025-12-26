<?php

namespace App\Policies;

use App\Models\SuratKeluar;
use App\Models\User;

class SuratKeluarPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SuratKeluar $suratKeluar): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, SuratKeluar $suratKeluar): bool
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $suratKeluar->created_by && $suratKeluar->status === 'pending';
    }

    public function delete(User $user, SuratKeluar $suratKeluar): bool
    {
        return $user->role === 'admin';
    }
}
