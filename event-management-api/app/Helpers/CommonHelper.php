<?php
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
if (!function_exists('isAdmin')) {

    function isAdmin()
    {
        if (Auth::user()->utype == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('isUser')) {

    function isUser()
    {
        if (Auth::user()->utype == 'user') {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('apiSuccessMessage')) {

    function apiSuccessMessage($message = "Record Updated", $data = [], $responseCode = 200)
    {
        $response = ['success' => 1, 'message' => $message, "data" => (object) $data];
        return response()->json($response, $responseCode);
    }
}
if (!function_exists('commonErrorMessage')) {

    function commonErrorMessage($message = "", $data = [], $responeCode = 203)
    {
        if ($message == "") {
            $message = config("constants.commonErrorMessage");
        }
        $response = ['success' => 0, 'message' => $message, "data" => (object) $data];
        return response()->json($response, $responeCode);
    }
}
if(! function_exists('removeSpecialCharecter')){
    function removeSpecialCharecter($string = ""){
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
if (!function_exists('uploadImage')) {

    function uploadImage($image, $width = 128, $height = 128)
    {
        $thumbails_path = config("constants.THUMBNAIL_PATH");
        $images_path = config("constants.IMAGE_PATH");
        File::isDirectory($thumbails_path) or File::makeDirectory($thumbails_path, 0777, true, true);
        File::isDirectory($images_path) or File::makeDirectory($images_path, 0777, true, true);
        $rand = str_shuffle('storylife');
        $image_name = $rand . time() . '.' . $image->getClientOriginalExtension();
        $destination_path = $thumbails_path;

        $resize_image = Image::make($image->getRealPath());
        // $resize_image->resize($width, $height, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destination_path . '/' . $image_name);

        // $resize_image->resize($width, $height, function ($constraint) {
        //     //$constraint->aspectRatio();
        //     //$constraint->upsize();
        // })->save($destination_path . '/' . $image_name);

        $resize_image->fit($width, $height, function ($constraint) {
            //$constraint->upsize();
        })->save($destination_path . '/' . $image_name);

        //save orignal image in images folder
        $destination_path = $images_path;
        if($image->move($destination_path, $image_name)){
            return $image_name;
        }else{
            return "";
        }
    }
}
if (!function_exists('uploadVideo')) {

    function uploadVideo($file)
    {
        $video_path = config("constants.VIDEO_PATH");
        File::isDirectory($video_path) or File::makeDirectory($video_path, 0777, true, true);
        $rand = str_shuffle('monster');
        $video_name = $rand.time().'.'.$file->getClientOriginalExtension();

        //save orignal video in video folder
        $destination_path = $video_path;
        if($file->move($destination_path, $video_name)){
            return $video_name;
        }else{
            return "";
        }
    }
}
if (!function_exists('getThumbnailUrl')) {

    function getThumbnailUrl($filename = "")
    {
        $path = config('constants.THUMBNAIL_URL');
        return url($path) . '/' . $filename;
    }
}
if (!function_exists('getImageUrl')) {

    function getImageUrl($filename = "")
    {
        $path = config('constants.IMAGE_URL');
        return url($path) . '/' . $filename;
    }
}
if (!function_exists('getDummyImageUrl')) {

    function getDummyImageUrl($filename = "avatar.png")
    {
        $path = config('constants.DUMMY_IMAGE_URL');
        return url($path) . '/' . $filename;
    }
}