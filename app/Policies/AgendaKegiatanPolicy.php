<?php

namespace App\Policies;

use App\Models\AgendaKegiatan;
use App\Models\User;

class AgendaKegiatanPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AgendaKegiatan $agendaKegiatan): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, AgendaKegiatan $agendaKegiatan): bool
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $agendaKegiatan->created_by && $agendaKegiatan->status === 'pending';
    }

    public function delete(User $user, AgendaKegiatan $agendaKegiatan): bool
    {
        return $user->role === 'admin';
    }
}
