<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\InvalidArgumentException;

class ClientController extends Controller
{
    protected $client_id;
    protected $client_secret;
    protected $passport_server;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client_id = '3';
        $this->client_secret = '4n7f3qHSqMzB2v28JO1KYx2hxgcOWp7Z4rePmq1m';
        $this->passport_server = 'http://localhost:8000';
    }

    /**
     * Redirecting for authorization
     *
     * @param \Illuminate\Http\Request $Request
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        $request->session()->put('state', $state = \Str::random(40));

        $query = http_build_query([
            'client_id'     => $this->client_id,
            'redirect_uri'  => url('callback'),
            'response_type' => 'code',
            'scope'         => '',
            'state'         => $state,
        ]);

        return redirect($this->passport_server . '/oauth/authorize?' . $query);
    }

    /**
     * Converting authorization codes to access tokens
     *
     * @param \Illuminate\Http\Request $Request
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $response = Http::asForm()->post($this->passport_server . '/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope'         => '*',
        ]);

        return $response->json();
    }
}
