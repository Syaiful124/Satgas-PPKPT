<?php
namespace App\Policies;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PengaduanPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pengaduan $pengaduan): bool
    {
        return $user->id === $pengaduan->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pengaduan $pengaduan): bool
    {
        // User bisa update jika laporan itu miliknya DAN statusnya masih 'menunggu'
        return $user->id === $pengaduan->user_id && $pengaduan->status === 'menunggu';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pengaduan $pengaduan): bool
    {
        // User bisa hapus jika laporan itu miliknya DAN statusnya masih 'menunggu'
        return $user->id === $pengaduan->user_id && $pengaduan->status === 'menunggu';
    }
}
