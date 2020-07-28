<?php

use App\User;
use App\Model\Payment;
use App\Model\Promotor;
use App\Model\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route Payment
Route::post('/finish', function(){
    return redirect()->route('welcome');
})->name('payment.finish');

Route::post('/payment/store', 'PaymentController@submitPayment')->name('payment.store');
Route::post('/notification/handler', 'PaymentController@notificationHandler')->name('notification.handler');

//////////////////////////////////////////////////////////////////////////////////////////////////

// Route Location Select
Route::get('/getDataProvince','LocationController@getDataProvince')->name('getDataProvince');
Route::get('/select/city/{id}',array('as'=>'select.city', 'uses'=>'LocationController@selectCity'));
Route::get('/select/district/{id}',array('as'=>'select.district', 'uses'=>'LocationController@selectDistrict'));
/////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/', function() {
    $user = User::all()->count();
    $tournaments = Tournament::paginate(6);
    $count = Tournament::all()->count();
    $promotor = Promotor::all()->count();
    $payment = Payment::where('status','success')->count();
    return view('home',compact('user','tournaments','promotor','payment','count'));
});
// Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['web', 'auth', 'roles']], function () {
    
    Route::group(['roles' => ['Admin', 'promotor', 'Member']], function () {
        
        Route::get('/tournament/detail/{id}', 'TournamentController@show')->name('tournament.detail');
        
        Route::get('/complain', 'ComplainController@index')->name('complain');
        
        Route::get('/profile', 'UserController@index')->name('profile');

    });
    
    Route::group(['roles' => 'Member'], function () {
        Route::get('upgrade', 'UserController@upgrade')->name('upgrade');
    });
    Route::group(['roles' => 'Admin'], function () {
        Route::get('/listPromotors', 'PromotorController@index')->name('list.Promotors');

        Route::get('/listUsers', 'HomeController@userTable')->name('list.Users');
        
        Route::put('/userRole/{role}','HomeController@changeRole')->name('change.Role');
            
    });

    Route::group(['roles' => ['Member', 'Admin']], function () {

        Route::get('/getDataPayment/{id}', 'TeamController@getDataPayment')->name('getDataPayment');

        Route::get('/listTeams', 'TeamController@index')->name('list.Teams');
        
        Route::get('/listTeams/athlete/{id}', 'TeamController@athleteByTeam')->name('list.AthleteByTeam');
        
        Route::post('/team', 'TeamController@store')->name('team.store');
            
        Route::post('/athlete', 'TeamController@addAthlete')->name('athlete.store');

        Route::get('/team/{id}', 'TeamController@destroyTeam')    ->name('team.destroy');

        Route::get('/athlete/{id}', 'TeamController@destroyAthlete')->name('athlete.destroy');

    });
    
    Route::group(['roles' => ['Promotor', 'Admin']], function () {
        Route::get('/listTournaments', 'TournamentController@index')->name('list.Tournaments');

        Route::get('/tournament/{id}', 'TournamentController@destroy')->name('tournament.destroy');
            
        Route::get('/tournament', 'TournamentController@create')->name('tournament.create');
            
        Route::post('/tournament', 'TournamentController@store')->name('turnament.store');
            
        Route::get('/tournament/edit/{id}', 'TournamentController@edit')->name('tournament.edit');
            
        Route::put('/tournament/{id}', 'TournamentController@update')->name('tournament.update');
            
    });
    
});
