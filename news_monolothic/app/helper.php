<?php

use Illuminate\Http\Request;

function getUploadFileName($file){
    $fileNameExt = $file->getClientOriginalName();
    $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
    $fileExt = $file->getClientOriginalExtension();
    return $fileName.'_'.time().'.'.$fileExt;
}
