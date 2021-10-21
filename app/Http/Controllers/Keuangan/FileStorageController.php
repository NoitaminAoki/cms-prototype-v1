<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Keuangan\PengajuanDana,
    Keuangan\JurnalHarian,
    Keuangan\ResumeJurnal,
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
}
