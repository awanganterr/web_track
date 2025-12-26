<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\AgendaKegiatan;
use App\Policies\SuratMasukPolicy;
use App\Policies\SuratKeluarPolicy;
use App\Policies\AgendaKegiatanPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(SuratMasuk::class, SuratMasukPolicy::class);
        Gate::policy(SuratKeluar::class, SuratKeluarPolicy::class);
        Gate::policy(AgendaKegiatan::class, AgendaKegiatanPolicy::class);

        // View Composer for Sidebar Badges (Admin Only)
        \Illuminate\Support\Facades\View::composer('components.sidebar', function ($view) {
            $pendingSuratMasuk = 0;
            $pendingSuratKeluar = 0;
            $pendingAgenda = 0;

            if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === 'admin') {
                $pendingSuratMasuk = SuratMasuk::where('status', 'pending')->count();
                $pendingSuratKeluar = SuratKeluar::where('status', 'pending')->count();
                $pendingAgenda = AgendaKegiatan::where('status', 'pending')->count();
            }

            $view->with('pendingSuratMasuk', $pendingSuratMasuk)
                 ->with('pendingSuratKeluar', $pendingSuratKeluar)
                 ->with('pendingAgenda', $pendingAgenda);
        });
    }
}
