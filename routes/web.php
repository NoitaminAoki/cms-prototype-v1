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
    Umum\LvItemAsetPerusahaan,
    Umum\LvInventoriPerusahaan,
    Umum\LvLaporanKegiatan,
    Umum\LvLegalitasPerusahaan,
    Umum\LvItemLegalitasPerusahaan,
    Umum\LvSdmPerusahaan,

    Marketing\LvMarketing,
    Marketing\LvItemMarketing,

    Konstruksi\LvKonstruksi,
    Konstruksi\LvLaporanHarian,
    Konstruksi\LvProgressKemajuan,
    Konstruksi\LvItemProgressKemajuan,
    Konstruksi\LvPhotoKegiatan,
    Konstruksi\LvControlStock,
    Konstruksi\LvResumeKegiatan,
    Konstruksi\LvPerjanjianKontrak,
};

use App\Http\Livewire\Perencanaan\{
    LvPerencanaan,
    LvFinancialAnalysis,
    LvGambarUnitRumah,
    LvKonstruksiUnitRumah,
    LvItemUnitRumah,
    LvKonstruksiSarana,
    LvItemKonstruksiSarana,
    LvBrosurPerumahan,
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
                Route::get('/jurnal-keuangan', LvJurnalHarian::class)->name('jurnal_keuangan.index');
                // Route::get('/jurnal-harian', LvJurnalHarian::class)->name('jurnal_harian.index');
            });
            Route::middleware(['permission:resume-jurnal view'])->group(function () {
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
                Route::get('/aset-perusahaan/{slug}', LvItemAsetPerusahaan::class)->name('aset_perusahaan.item.index');
            });
            Route::middleware(['permission:inventori-perusahaan view'])->group(function () {
                Route::get('/inventori-perusahaan', LvInventoriPerusahaan::class)->name('inventori_perusahaan.index');
            });
            Route::middleware(['permission:laporan-kegiatan view'])->group(function () {
                Route::get('/laporan-kegiatan', LvLaporanKegiatan::class)->name('laporan_kegiatan.index');
            });
            Route::middleware(['permission:legalitas-perusahaan view'])->group(function () {
                Route::get('/legalitas-perusahaan', LvLegalitasPerusahaan::class)->name('legalitas_perusahaan.index');
                Route::get('/legalitas-perusahaan/{slug}', LvItemLegalitasPerusahaan::class)->name('legalitas_perusahaan.item.index');
            });
            Route::middleware(['permission:sdm-perusahaan view'])->group(function () {
                Route::get('/sdm-perusahaan', LvSdmPerusahaan::class)->name('sdm_perusahaan.index');
            });
        });
        Route::prefix('marketing')->name('marketing.')->group(function () {
            Route::middleware(['permission:marketing view'])->group(function () {
                Route::get('/', LvMarketing::class)->name('index');
                Route::get('/marketing/{slug}', LvItemMarketing::class)->name('item.index');
            });
        });
        Route::prefix('konstruksi')->name('konstruksi.')->group(function () {
            Route::get('/', LvKonstruksi::class)->name('index');
            Route::middleware(['permission:laporan-harian view'])->group(function () {
                Route::get('/laporan-harian', LvLaporanHarian::class)->name('laporan_harian.index');
            });
            Route::middleware(['permission:progress-kemajuan view'])->group(function () {
                Route::get('/progress-kemajuan', LvProgressKemajuan::class)->name('progress_kemajuan.index');
                Route::get('/progress-kemajuan/{slug}', LvItemProgressKemajuan::class)->name('progress_kemajuan.item.index');
            });
            Route::middleware(['permission:photo-kegiatan view'])->group(function () {
                Route::get('/photo-kegiatan', LvPhotoKegiatan::class)->name('photo_kegiatan.index');
            });
            Route::middleware(['permission:control-stock view'])->group(function () {
                Route::get('/control-stock', LvControlStock::class)->name('control_stock.index');
            });
            Route::middleware(['permission:resume-kegiatan view'])->group(function () {
                Route::get('/resume-kegiatan', LvResumeKegiatan::class)->name('resume_kegiatan.index');
            });
            Route::middleware(['permission:perjanjian-kontrak view'])->group(function () {
                Route::get('/perjanjian-kontrak', LvPerjanjianKontrak::class)->name('perjanjian_kontrak.index');
            });
        });
    });
    /* END PELAKSANAAN */
    
    /* PERENCANAAN */
    Route::prefix('perencanaan')->name('perencanaan.')->group(function () {
        Route::get('/', LvPerencanaan::class)->name('index');
        
        Route::middleware(['permission:financial-analysis view'])->group(function () {
            Route::get('financial-analysis', LvFinancialAnalysis::class)->name('financial_analysis.index');
        });
        Route::middleware(['permission:gambar-unit-rumah view'])->group(function () {
            Route::get('gambar-unit-rumah', LvGambarUnitRumah::class)->name('gambar_unit_rumah.index');
        });
        Route::middleware(['permission:konstruksi-unit-rumah view'])->group(function () {
            Route::get('konstruksi-unit-rumah', LvKonstruksiUnitRumah::class)->name('konstruksi_unit_rumah.index');
            Route::get('konstruksi-unit-rumah/{slug}', LvItemUnitRumah::class)->name('konstruksi_unit_rumah.item.index');
        });
        Route::middleware(['permission:konstruksi-sarana view'])->group(function () {
            Route::get('konstruksi-sarana', LvKonstruksiSarana::class)->name('konstruksi_sarana.index');
            Route::get('konstruksi-sarana/{slug}', LvItemKonstruksiSarana::class)->name('konstruksi_sarana.item.index');
        });
        Route::middleware(['permission:brosur-perumahan view'])->group(function () {
            Route::get('brosur-perumahan', LvBrosurPerumahan::class)->name('brosur_perumahan.index');
        });

    });
    /* END PERENCANAAN */

    /* KEUANGAN */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::middleware(['permission:kas-besar view'])->group(function () {
            Route::get('/kas-besar', LvKasBesar::class)->name('kas_besar.index');
        });
    });
    /* END KEUANGAN */
    
    /* FILE STORAGE */
    Route::get('files/image/stream', [FileStorageController::class, 'imageStream'])->name('files.image.stream');
    Route::get('files/pdf/stream', [FileStorageController::class, 'pdfStream'])->name('files.pdf.stream');
    /* END FILE STORAGE */
});


Route::prefix('/admin')->name('admin.')->group(function(){
    //Login Routes
    Route::get('/login',[AdminLoginController::class, 'loginForm'])->name('login');
    Route::post('/login',[AdminLoginController::class, 'login']);
    Route::post('/logout',[AdminLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    
    /* MASTER */
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/', LvMasterAdmin::class)->name('index');
        Route::get('/user-roles', LvUserRolesAdmin::class)->name('user_roles.index');
        Route::get('/roles', LvRolesAdmin::class)->name('roles.index');
        Route::get('/code', LvMsCode::class)->name('code.index');
        Route::get('/code/{parent_code_id}/sub-codes', LvMsSubCode::class)->name('code.sub_code');
    });
    /* END MASTER */
    
    /* MANAGE (ADMIN) */
    Route::prefix('manage')->name('manage.')->group(function () {
        
    });
    /* END MANAGE (ADMIN) */
    
});

Route::get('test/email', function(){
  
    return view('layouts.mail.notification-mail');
	$details = ['email' => 's2.DanielAoki@gmail.com'];
  
    dispatch(new App\Jobs\SendEmailNotifJob($details));
  
    dd('send mail successfully !!');
});

Route::get('test/roles', [FileStorageController::class, 'tester']);
