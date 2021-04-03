<?php


namespace App\Http\Controllers;

use App\Util\Helper;
use App\Util\NameParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TheIconic\NameParser\Parser;


class FileUpload extends Controller
{

    public function fileUpload(Request $req){

        $nameparse = new NameParser();

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $file = 'storage/'.$filePath;

            $customerArr = Helper::ConvertCsvToArray($file);

            foreach($customerArr as $key => $element) {
                if ($key === array_key_first($customerArr))
                    continue;

                if(is_array($element))
                {
                    $newElement= array_filter($element);
                    $vaule=$newElement[0];
                    //var_dump($value);
                    $splitValue = explode(" ",$newElement[0]);

                    $nameValue= $nameparse->parse($vaule);

                    /** todo can insert in user table */

                    $response['namesplit'][]  = $nameValue;
                }
            }
            dd($response);
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }


}
