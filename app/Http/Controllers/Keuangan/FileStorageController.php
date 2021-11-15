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
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }

    public function imageSectorStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');

        if (Storage::disk('sector_base')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_base')->path($base_path.$filename);
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }
    
    public function pdfStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');
        
        if (Storage::disk('sector_disk')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_disk')->path($base_path.$filename);
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }

    public function tester()
    {
        $details = (object) [
            'divisi' => "Keuangan",
            'path' => "images/keuangan/jurnal-harian/",
            'image_name' => "JURNAL - JULI 2021 - 2.jpg",
            'file_name' => "J03T3FSNbFO7AGhmKL4zOHJyXRGPwKu5mI7rsGCBHte0I.jpg",
        ];
        $details->pathToImage = Storage::disk('sector_disk')->path($details->path.$details->file_name);
        dump(public_path());
        dump(public_path() . '/' . $details->pathToImage);
        dd(env('SECTOR_PUBLIC_PATH') . '/' . $details->pathToImage);
        return view('layouts.mail.notification-mail')
        ->with(['data' => $details]);
    }
}
