<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\Advertisement;
use App\Models\User;
use Auth;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
      //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Schema::defaultStringLength(191);
    Paginator::useBootstrap();
    $setting = Setting::first();
    View::share('setting', $setting);
    Validator::extend('long_text', function ($attribute, $value, $parameters, $validator) {
      $maxCharacterCount = $parameters[0] ?? 5000;
      return strlen($value) <= $maxCharacterCount;
    });
  }
}
