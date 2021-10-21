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

use App\Http\Livewire\Manage\{
    LvRoles as LvRolesAdmin,
    LvUserRoles as LvUserRolesAdmin,
};

use App\Http\Livewire\Perencanaan\{
    LvDivisi,
    LvMaterialDetail,
    LvListSubItem,
    
    LvTemplateRab,
};

use App\Http\Livewire\Keuangan\{
    LvKasBesar,
    LvPengajuanDana,
    LvPengajuanDanaCreate,
    LvRealisasiDana,
    LvRealisasiDanaCreate,
    LvKwitansi,
    LvKwitansiCreate,
    LvJurnalHarian,
    LvJurnalHarianCreate,
    LvJurnalKeuangan,
};

use App\Http\Livewire\Master\{
    LvMsCode,
    LvMsSubCode,
    LvMsSatuan,
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
    Route::prefix('perencanaan')->name('perencanaan.')->group(function () {
        Route::get('/divisi', LvDivisi::class)->name('divisi.index');
        Route::get('/material-detail', LvMaterialDetail::class)->name('material_detail.index');
        Route::get('/list-sub-item', LvListSubItem::class)->name('list_sub_item.index');
        Route::get('/template-rab', LvTemplateRab::class)->name('template_rab.index');
    });
    /* END PERENCANAAN */
    
    /* KEUANGAN */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::middleware(['permission:kas-besar view'])->group(function () {
            Route::get('/kas-besar', LvKasBesar::class)->name('kas_besar.index');
        });
        Route::middleware(['permission:pengajuan-dana view'])->group(function () {
            Route::get('/pengajuan-dana', LvPengajuanDana::class)->name('pengajuan_dana.index');
            Route::get('/pengajuan-dana/create', LvPengajuanDanaCreate::class)->middleware('permission:pengajuan-dana add')->name('pengajuan_dana.create');
        });
        Route::middleware(['permission:realisasi-dana view'])->group(function () {
            Route::get('/realisasi-dana', LvRealisasiDana::class)->name('realisasi_dana.index');
            Route::get('/realisasi-dana/{pengajuan_dana_id}/create', LvRealisasiDanaCreate::class)->middleware('permission:realisasi-dana add')->name('realisasi_dana.create');
        });
        Route::middleware(['permission:kwitansi view'])->group(function () {
            Route::get('/kwitansi', LvKwitansi::class)->name('kwitansi.index');
            Route::get('/kwitansi/create', LvKwitansiCreate::class)->middleware('permission:kwitansi add')->name('kwitansi.create');
        });
        Route::middleware(['permission:jurnal-harian view'])->group(function () {
            Route::get('/jurnal-harian', LvJurnalHarian::class)->name('jurnal_harian.index');
            // Route::get('/jurnal-harian/create', LvJurnalHarianCreate::class)->middleware('permission:jurnal-harian add')->name('jurnal_harian.create');
        });
        Route::middleware(['permission:jurnal-keuangan view'])->group(function () {
            Route::get('/jurnal-keuangan', LvJurnalKeuangan::class)->name('jurnal_keuangan.index');
        });
    });
    /* END KEUANGAN */
    
    /* MASTER */
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/code', LvMsCode::class)->name('code.index');
        Route::get('/code/{parent_code_id}/sub-codes', LvMsSubCode::class)->name('code.sub_code');
        
        Route::get('/satuan', LvMsSatuan::class)->name('satuan.index');
    });
    /* END MASTER */
    
    /* TEMPLATE EXCEL */
    Route::get('templates/excel/jurnal-harian', [FileStorageController::class, 'exportExcel']);
    /* END TEMPLATE EXCEL */
    
    /* FILE STORAGE */
    Route::get('files/keuangan/realisasi-dana/{id}/img', [FileStorageController::class, 'fileRealisasiDana'])->name('file.keuangan.realisasi_dana');
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
