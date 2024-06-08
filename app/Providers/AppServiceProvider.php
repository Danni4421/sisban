<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.form-group', 'form-group');

        // Inputs
        Blade::component('components.input.input-field', 'input');
        Blade::component('components.input.radio', 'input.radio');
        Blade::component('components.button', 'button');
        Blade::component('components.label', 'label');

        // Forms
        Blade::component('components.forms.form-data-anggota', 'input.form-anggota');

        // Currency
        Blade::directive('currency', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });

        // Datatables
        Builder::useVite();
    }
}
