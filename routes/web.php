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
    Keuangan\LvRealisasiDana,
    Keuangan\LvProgressKeuangan,

    Umum\LvUmum,
    Umum\LvAsetPerusahaan,
    Umum\LvInventoriPerusahaan,
    Umum\LvLaporanKegiatan,
    Umum\LvLegalitasPerusahaan,
    Umum\LvSdmPerusahaan,
};

use App\Http\Livewire\Keuangan\{
    LvKasBesar,
};

use App\Http\Livewire\Master\{
    LvMasterAdmin,
    LvUserRoles as LvUserRolesAdmin,
    LvRoles as LvRolesAdmin,
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
            Route::middleware(['permission:jurnal-harian view'])->group(function () {
                Route::get('/jurnal-keuangan', LvJurnalKeuangan::class)->name('jurnal_keuangan.index');
                Route::get('/jurnal-harian', LvJurnalHarian::class)->name('jurnal_harian.index');
            });
            Route::middleware(['permission:jurnal-harian view'])->group(function () {
                Route::get('/resume-jurnal', LvResumeJurnal::class)->name('resume_jurnal.index');
            });
            Route::middleware(['permission:realisasi-dana view'])->group(function () {
                Route::get('/realisasi-dana', LvRealisasiDana::class)->name('realisasi_dana.index');
            });
            Route::middleware(['permission:progress-keuangan view'])->group(function () {
                Route::get('/progress-keuangan', LvProgressKeuangan::class)->name('progress_keuangan.index');
            });
        });
        Route::prefix('umum')->name('umum.')->group(function () {
            Route::get('/', LvUmum::class)->name('index');
            Route::middleware(['permission:aset-perusahaan view'])->group(function () {
                Route::get('/aset-perusahaan', LvAsetPerusahaan::class)->name('aset_perusahaan.index');
            });
            Route::middleware(['permission:inventori-perusahaan view'])->group(function () {
                Route::get('/inventori-perusahaan', LvInventoriPerusahaan::class)->name('inventori_perusahaan.index');
            });
            Route::middleware(['permission:laporan-kegiatan view'])->group(function () {
                Route::get('/laporan-kegiatan', LvLaporanKegiatan::class)->name('laporan_kegiatan.index');
            });
            Route::middleware(['permission:legalitas-perusahaan view'])->group(function () {
                Route::get('/legalitas-perusahaan', LvLegalitasPerusahaan::class)->name('legalitas_perusahaan.index');
            });
            Route::middleware(['permission:sdm-perusahaan view'])->group(function () {
                Route::get('/sdm-perusahaan', LvSdmPerusahaan::class)->name('sdm_perusahaan.index');
            });
        });
    });
    /* END PELAKSANAAN */
    
    /* KEUANGAN */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::middleware(['permission:kas-besar view'])->group(function () {
            Route::get('/kas-besar', LvKasBesar::class)->name('kas_besar.index');
        });
    });
    /* END KEUANGAN */
    
    /* MASTER */
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/', LvMasterAdmin::class)->name('index');
        Route::get('/user-roles', LvUserRolesAdmin::class)->name('user_roles.index');
        Route::get('/roles', LvRolesAdmin::class)->name('roles.index');
        Route::get('/code', LvMsCode::class)->name('code.index');
        Route::get('/code/{parent_code_id}/sub-codes', LvMsSubCode::class)->name('code.sub_code');
    });
    /* END MASTER */
    
    /* FILE STORAGE */
    Route::get('images/keuangan/pengajuan-dana/{id}/img', [FileStorageController::class, 'imagePengajuanDana'])->name('image.keuangan.pengajuan_dana');
    Route::get('images/keuangan/jurnal-harian/{id}/img', [FileStorageController::class, 'imageJurnalHarian'])->name('image.keuangan.jurnal_harian');
    Route::get('images/keuangan/resume-jurnal/{id}/img', [FileStorageController::class, 'imageResumeJurnal'])->name('image.keuangan.resume_jurnal');
    Route::get('images/keuangan/realisasi-dana/{id}/img', [FileStorageController::class, 'imageRealisasiDana'])->name('image.keuangan.realisasi_dana');
    Route::get('images/keuangan/progress-keuangan/{id}/img', [FileStorageController::class, 'imageProgressKeuangan'])->name('image.keuangan.progress_keuangan');
    
    Route::get('images/umum/aset-perusahaan/{id}/img', [FileStorageController::class, 'imageAsetPerusahaan'])->name('image.umum.aset_perusahaan');
    Route::get('images/umum/inventori-perusahaan/{id}/img', [FileStorageController::class, 'imageInventoriPerusahaan'])->name('image.umum.inventori_perusahaan');
    Route::get('images/umum/laporan-kegiatan/{id}/img', [FileStorageController::class, 'imageLaporanKegiatan'])->name('image.umum.laporan_kegiatan');
    Route::get('images/umum/legalitas-perusahaan/{id}/img', [FileStorageController::class, 'imageLegalitasPerusahaan'])->name('image.umum.legalitas_perusahaan');
    Route::get('images/umum/sdm-perusahaan/{id}/img', [FileStorageController::class, 'imageSdmPerusahaan'])->name('image.umum.sdm_perusahaan');
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
        
    });
    /* END MANAGE (ADMIN) */
    
});
