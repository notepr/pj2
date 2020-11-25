<?php

namespace App\Http\Controllers\Api\Traits;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
trait CallApi {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $base_url = 'https://api.notepr.xyz/api/';
    //private $base_url = 'http://localhost:8080/github/api.bkacad.xyz/public/api/';
    private $key  = 'duongbavl';
    private $body = [];
    public function getApi($url) {
        $url    = $this->base_url . $url;
        $client = new \GuzzleHttp\Client();
        try {
            $request  = $client->createRequest("GET", $url, ['body' => array_merge($this->body, ['key' => $this->key])]);
            $response = $client->send($request)->getBody();
            return json_decode($response, true);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function postApi($url) {
        $url    = $this->base_url . $url;
        $client = new \GuzzleHttp\Client();
        try {
            $request  = $client->createRequest("POST", $url, ['body' => array_merge($this->body, ['key' => $this->key])]);
            $response = $client->send($request)->getBody();
            return json_decode($response, true);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function postRaw($url) {
        $client = new \GuzzleHttp\Client();
        try {
            $request  = $client->createRequest("POST", $url, ['body' => $this->body]);
            $response = $client->send($request)->getBody();
            return json_decode($response, true);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function setBody($body) {
        $this->body = $body;
        return $this;
    }
    public function getBody() {
        return $this->body;
    }
}