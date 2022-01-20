<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
             View::share('menus', (object)[
                 'admin'=>[
                     (object)['name'=>'Manage Libraries','route' => 'libraries', 'icon'=>'fad fa-books'],
                     (object)['name'=>'Manage Books','route' => 'manage.books', 'icon'=>'fad fa-books'],
                     (object)['name'=>'Borrowing','route' => 'borrowings', 'icon'=>'fad fa-add'],
                 ],
                 'student'=>[
//                      (object)['name'=>'Borrow Book','route' =>'student.borrowings', 'icon'=>'fad fa-add'],
                 ],
             ]);
    }
}
