<?php

namespace App\Helpers;

use App\Models\FileuploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileuploadHelpers
{
    public function storeFile($fileArray)
    {
        $fileOriginalName = $fileArray->getClientOriginalName();
        $fileNameWithoutExtension = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $fileExt = $fileArray->getClientOriginalExtension();

        $path = 'files';
        $filePathName = $fileNameWithoutExtension.'_'.rand(123456789, 999999999).time().'.'.$fileExt;
        $fileArray->move($path, $filePathName);

        return $path.'/'.$filePathName;
    }

    /*******************************************************************************************
                              FOR MULTIPLE FILES
    *******************************************************************************************/
    public static function fileStore($fileItem, $dir = '', $fileName = '')
    {
        
        $fileExt = $fileItem->getClientOriginalExtension();

        $path = $dir;
        if ($fileName) {
            $fileNameWithoutExtension = $fileName;
        }
        $filePathName = rand(123456789, 999999999).time().'.'.$fileExt;
        $fileItem->move($path, $filePathName);

        return $path.'/'.$filePathName;
    }

    public static function filesUpload($files, $dir)
    {
        $fileData = [];

        foreach ($files as $fileItem) {
            $fileData[] = self::fileStore($fileItem, $dir);
        }

        return $fileData;
    }
}
