<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;

use App\Http\Livewire\Users\UserProfile;
use App\Http\Livewire\Users\UserManagement;

use App\Http\Livewire\Tickets\TicketList;
use App\Http\Livewire\Tickets\MyTickets;
use App\Http\Livewire\Tickets\TicketShow;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::match(['get', 'post'], '/login', Login::class)->name('login');
Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password');//->middleware('signed');

Route::middleware('auth')->group(function () {
    
    Route::get('/my-tickets', MyTickets::class)->name('my-tickets');
    Route::get('/ticket-show/{id}', TicketShow::class)->name('ticket-show');
    Route::get('/ticket-list', TicketList::class)->name('ticket-list')->middleware('admin');
    
    Route::get('/user-profile', UserProfile::class)->name('user-profile');
    Route::get('/user-management', UserManagement::class)->name('user-management')->middleware('admin');

    Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('admin');

});

