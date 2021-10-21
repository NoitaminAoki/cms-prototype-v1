<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

use App\Http\Controllers\Auth\{
    Admin\LoginController as AdminLoginController,
};

use App\Http\Controllers\Keuangan\{
    FileStorageController,
};

use App\Http\Livewire\Dashboard\{
    LvDashboard,
};

use App\Http\Livewire\Pelaksanaan\{
    LvPelaksanaan,
    Keuangan\LvKeuangan,
    Keuangan\LvPengajuanDana,
    Keuangan\LvJurnalKeuangan,
    Keuangan\LvJurnalHarian,
    Keuangan\LvResumeJurnal,
};

use App\Http\Livewire\Manage\{
    LvRoles as LvRolesAdmin,
    LvUserRoles as LvUserRolesAdmin,
};

use App\Http\Livewire\Keuangan\{
    LvKasBesar,
    LvRealisasiDana,
};

use App\Http\Livewire\Master\{
    LvMsCode,
    LvMsSubCode,
};

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return redirect(route('dashboard')); /* jangan diganti ke login [FIX ERROR] */
});

Route::middleware(['auth:web,admin', 'verified'])->group(function () {
    Route::get('/dashboard', LvDashboard::class)->name('dashboard');
    
    /* PERENCANAAN */
    // Route::prefix('perencanaan')->name('perencanaan.')->group(function () {
    // });
    /* END PERENCANAAN */

    /* PELAKSANAAN */
    Route::prefix('pelaksanaan')->name('pelaksanaan.')->group(function () {
        Route::get('/', LvPelaksanaan::class)->name('index');
        
        Route::prefix('keuangan')->name('keuangan.')->group(function () {
            Route::get('/', LvKeuangan::class)->name('index');
            Route::middleware(['permission:pengajuan-dana view'])->group(function () {
                Route::get('/pengajuan-dana', LvPengajuanDana::class)->name('pengajuan_dana.index');
            });
            Route::middleware(['permission:jurnal-keuangan view'])->group(function () {
                Route::get('/jurnal-keuangan', LvJurnalKeuangan::class)->name('jurnal_keuangan.index');
            });
            Route::middleware(['permission:jurnal-harian view'])->group(function () {
                Route::get('/jurnal-harian', LvJurnalHarian::class)->name('jurnal_harian.index');
            });
            Route::middleware(['permission:jurnal-harian view'])->group(function () {
                Route::get('/resume-jurnal', LvResumeJurnal::class)->name('resume_jurnal.index');
            });
        });
    });
    /* END PELAKSANAAN */
    
    /* KEUANGAN */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::middleware(['permission:kas-besar view'])->group(function () {
            Route::get('/kas-besar', LvKasBesar::class)->name('kas_besar.index');
        });
        Route::middleware(['permission:realisasi-dana view'])->group(function () {
            Route::get('/realisasi-dana', LvRealisasiDana::class)->name('realisasi_dana.index');
        });
    });
    /* END KEUANGAN */
    
    /* MASTER */
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/code', LvMsCode::class)->name('code.index');
        Route::get('/code/{parent_code_id}/sub-codes', LvMsSubCode::class)->name('code.sub_code');
    });
    /* END MASTER */
    
    /* FILE STORAGE */
    Route::get('images/keuangan/pengajuan-dana/{id}/img', [FileStorageController::class, 'imagePengajuanDana'])->name('image.keuangan.pengajuan_dana');
    Route::get('images/keuangan/jurnal-harian/{id}/img', [FileStorageController::class, 'imageJurnalHarian'])->name('image.keuangan.jurnal_harian');
    Route::get('images/keuangan/resume-jurnal/{id}/img', [FileStorageController::class, 'imageResumeJurnal'])->name('image.keuangan.resume_jurnal');
    /* END FILE STORAGE */
});


Route::prefix('/admin')->name('admin.')->group(function(){
    //Login Routes
    Route::get('/login',[AdminLoginController::class, 'loginForm'])->name('login');
    Route::post('/login',[AdminLoginController::class, 'login']);
    Route::post('/logout',[AdminLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    /* MANAGE (ADMIN) */
    Route::prefix('manage')->name('manage.')->group(function () {
        Route::get('/roles', LvRolesAdmin::class)->name('roles.index');
        
        Route::get('/user-roles', LvUserRolesAdmin::class)->name('user_roles.index');
    });
    /* END MANAGE (ADMIN) */
    
});
