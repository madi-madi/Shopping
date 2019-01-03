<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\UploadedFile;
use App\Http\Controllers\disk;

use App\Upload;
class FtpController extends Controller
{
    //


    public function index(){

    	return view('ftp');
    }

    public function store(Request $request){


    	$image = $request->file('image');

        $file_type = $image->getClientOriginalExtension();

        $ftp_conn = "ftp.byethost7.com";

        $filename = time().'.'.$request->image->getClientOriginalExtension();

        $directory = "public_html";
        $filepath = "http://185.27.134.9/index.php/".$directory;
 
       $files =  Storage::disk('ftp')->putFileAs($directory, $image, $filename);


                $upload = new Upload;
        $upload->file_name = $filename ;
        $upload->file_type = $file_type ;
        $upload->file_path = $filepath ; 
        $upload->save();


    }
}
