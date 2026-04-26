<?php


use App\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
   //return view('welcome');
//});

Auth::routes(['register' => false]);
//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/frontend.login', 'loginForm')->name('frontend.login');
    Route::post('/frontend.login', 'loginSubmit')->name('login.submit');
    Route::get('/frontend.logout', 'logout')->name('frontend.logout');
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('frontend.index');

    Route::get('/search-invite', [App\Http\Controllers\Frontend\FrontendController::class, 'searchInvitePage'])
        ->name('frontend.searchInvitePage');

    Route::post('/search-invite', [App\Http\Controllers\Frontend\FrontendController::class, 'searchInvite'])
        ->name('frontend.searchInvite');

    Route::post('/update-status', [App\Http\Controllers\Frontend\FrontendController::class, 'updateStatus'])
        ->name('frontend.updateStatus');

    Route::get('/download-carte/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'downloadCarte'])
        ->name('frontend.downloadCarte');
});



Route::group([
    "middleware" => ["auth", "auth.administrateur"],
    'as' => 'administrateur.'
], function () {
    // Dashboard Admin
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group([
        "prefix" => "gestutilisateurs",
        "as" => "gestutilisateurs."
    ], function () {
        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        // Route::get('/rolesetpermition', [App\Http\Controllers\UserController::class, 'index'])->name('rolespermissions.index');
    });

    Route::group([
        "prefix" => "gestparametres",
        'as' => 'gestparametres.'
    ], function () {
       Route::get('/', [App\Http\Controllers\ParametreController::class, 'index'])->name('parametres.index');
    Route::post('parametres', [App\Http\Controllers\ParametreController::class, 'store'])->name('parametres.store');
    });




});
Route::group([
    "middleware" => ["auth", "auth.informaticien"],
    'as' => 'informaticien.'
], function () {

    Route::group([
        "prefix" => "gestinvites",
        'as' => 'gestinvites.'
    ], function () {

        Route::get('/', [App\Http\Controllers\InviteController::class, 'index'])
            ->name('invites.index');

        Route::get('/download-pdf', [App\Http\Controllers\InviteController::class, 'downloadPdfDisponibles'])
            ->name('invites.download.pdf');

        Route::get('/create', [App\Http\Controllers\InviteController::class, 'create'])
            ->name('invites.create');

        Route::post('/store', [App\Http\Controllers\InviteController::class, 'store'])
            ->name('invites.store');

        Route::get('/{invite}/edit', [App\Http\Controllers\InviteController::class, 'edit'])
            ->name('invites.edit');

        Route::put('/{invite}', [App\Http\Controllers\InviteController::class, 'update'])
            ->name('invites.update');

        Route::delete('/{invite}', [App\Http\Controllers\InviteController::class, 'destroy'])
            ->name('invites.destroy');

        // ✅ Réinitialisation des statuts
        Route::post('/reset-status', [App\Http\Controllers\InviteController::class, 'resetStatus'])
            ->name('invites.resetStatus');

        // ✅ Suppression massive
        Route::post('/delete-all', [App\Http\Controllers\InviteController::class, 'deleteAll'])
            ->name('invites.deleteAll');

    });

});



