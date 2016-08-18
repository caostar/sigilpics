<?php
namespace App\Api\V1\Controllers;
use JWTAuth;
use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class MosaicController extends Controller
{
    use Helpers;
    public function index()
    {
        return $this->currentUser()
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }
}