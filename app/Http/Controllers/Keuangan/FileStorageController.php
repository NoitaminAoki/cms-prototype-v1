<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Keuangan\PengajuanDana,
    Keuangan\JurnalHarian,
    Keuangan\ResumeJurnal,
    Keuangan\RealisasiDana,
    Keuangan\ProgressKeuangan,

    Umum\AsetPerusahaan,
    Umum\InventoriPerusahaan,
    Umum\LaporanKegiatan,
    Umum\LegalitasPerusahaan,
    Umum\SdmPerusahaan,
};

class FileStorageController extends Controller
{
    public function imagePengajuanDana($id)
    {
        $file = PengajuanDana::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function imageJurnalHarian($id)
    {
        $file = JurnalHarian::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageResumeJurnal($id)
    {
        $file = ResumeJurnal::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageRealisasiDana($id)
    {
        $file = RealisasiDana::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageProgressKeuangan($id)
    {
        $file = ProgressKeuangan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function imageAsetPerusahaan($id)
    {
        $file = AsetPerusahaan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageInventoriPerusahaan($id)
    {
        $file = AsetPerusahaan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageLaporanKegiatan($id)
    {
        $file = LaporanKegiatan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageLegalitasPerusahaan($id)
    {
        $file = LegalitasPerusahaan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
    public function imageSdmPerusahaan($id)
    {
        $file = SdmPerusahaan::findOrFail($id);
        $path = storage_path('app/'.$file->image_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
}
