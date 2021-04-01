<?php


namespace App\Http\Controllers;

use App\Util\Helper;
use Illuminate\Http\Request;


class FileUpload extends Controller
{

    public function fileUpload(Request $req){
//        $req->validate([
//            'file' => 'required|mimes:csv|max:2048'
//        ]);



        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $file = public_path($filePath);

            $customerArr = Helper::csvToArray($file);
            dd($customerArr);
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }

}
