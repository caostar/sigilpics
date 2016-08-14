<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Googl;

use App\Token;

class HomeController extends Controller
{
    public function index()
    {
        return view('login');
    }


    public function login(Googl $googl, Request $request)
    {
        $client = $googl->client();

        if ($request->has('code')) {

            $client->authenticate($request->input('code'));
            //$token = $client->getAccessToken();
            //
            $tokenModel = new Token();
            $tokenModel->plataform = 'googledrive';
            $tokenModel->token = json_encode($client->getAccessToken());
            $tokenModel->save();
            $token = Token::first();

        } else if (!Token::where('plataform', 'googledrive')->first()){
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        }else{
            $token = Token::where('plataform', 'googledrive')->first();
            //check if we need to refresh the token
            $client->setAccessToken($token->token);
            if ($client->isAccessTokenExpired()) {
                //print_r("Ok. Token expirado. Vamos renovar.<br/><br/>");
                $tokenData = $client->getAccessToken();
                //print_r("<br/><br/>tokenData:<br/>");
                //print_r($tokenData);
                $refreshToken = $tokenData['refresh_token'];
                //print_r("<br/><br/>refreshToken:<br/>");
                //print_r($refreshToken);
                $client->refreshToken($refreshToken);

                //print_r("<br/><br/>npvp token:<br/>");
                $newToken = $client->getAccessToken();
                $newToken['refresh_token'] = $refreshToken;
                //print_r($newToken);

                $token->token = json_encode($newToken);
                $token->save();

            }
        }
        //
        /*$plus = new \Google_Service_Plus($client);

        $google_user = $plus->people->get('me');
        $id = $google_user['id'];

        $email = $google_user['emails'][0]['value'];
        $first_name = $google_user['name']['givenName'];
        $last_name = $google_user['name']['familyName'];*/

        session([
            'user' => [
                /*'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,*/
                'token' => $token->token
            ]
        ]);

        flash('You are now logged in.');
        return redirect('dashboard');
   }
}