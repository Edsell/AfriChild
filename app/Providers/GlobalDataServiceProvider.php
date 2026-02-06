<?php

namespace App\Providers;

use App\Models\GeneralSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    if (!app()->runningInConsole()) {
      $settings = GeneralSettings::orderByDesc('id')->first();
      View::share('generalSettings', $settings);
    }
  }
}
