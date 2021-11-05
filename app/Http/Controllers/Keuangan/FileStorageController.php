<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class FileStorageController extends Controller
{
    public function imageStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');

        if (Storage::disk('sector_disk')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_disk')->path($base_path.$filename);
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function imageSectorStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');

        if (Storage::disk('sector_base')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_base')->path($base_path.$filename);
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function pdfStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');

        if (Storage::disk('sector_disk')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_disk')->path($base_path.$filename);
            return response()
            ->file($path, array('Content-Type' =>'application/pdf'));
            
        }
        
        abort(404);
    }

    public function testerResponse()
    {
            
            $path = Storage::disk('local')->path('image/example-image.jpg');
            $type = File::mimeType($path);
            
            return response()
            ->file($path, array('Content-Type' =>$type));

    }
}
