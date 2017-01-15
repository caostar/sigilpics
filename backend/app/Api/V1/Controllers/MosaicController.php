<?php
namespace App\Api\V1\Controllers;
use JWTAuth;
use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MosaicController extends Controller
{
    use Helpers;
    public function index()
    {
        $rawFiles = app('App\Http\Controllers\AdminController')->getFiles();
        $parsedFiles = [];

        foreach($rawFiles as $f){
            if(strpos($f->mimeType,"image") > -1){
                $fileParsed = array(
                    'id' => $f->id,
                    'downLoadFile' => env('APP_URL')."/downloadFile/".$f->id,
                    'viewOnDrive' => $f->webViewLink,
                    'gDriveThumbnailLink' => $f->thumbnailLink,
                    //'proxyThumbnailLink' => env('APP_URL')."/proxyThumb?url=".$f->thumbnailLink,
                    'thumbnailLink' => $f->thumbnailLink,
                    'originalFilename' => $f->originalFilename,
                    'name' => $f->name,
                    'modifiedTime' => $f->modifiedTime,
                    'size' => $f->size,
                    'width' => $f->imageMediaMetadata['width'],
                    'height' => $f->imageMediaMetadata['height'],
                    'displayName' => $f->lastModifyingUser->displayName,
                    'displayPic' => $f->lastModifyingUser->photoLink,
                    'altitude' => $f->imageMediaMetadata->location['altitude'],
                    'latitude' => $f->imageMediaMetadata->location['latitude'],
                    'longitude' => $f->imageMediaMetadata->location['longitude'],
                );
                //
                $parsedFiles[] = $fileParsed;
            }            
        }

        return $parsedFiles;
    }
}