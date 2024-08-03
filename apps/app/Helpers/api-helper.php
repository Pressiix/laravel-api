<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiHelper
{
    public static function get($url, $params = [], $headers = [])
    {
        $client = new Client();
        try {
            $response = $client->request('GET', $url, [
                'query' => $params,
                'headers' => $headers
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error
            return ['error' => $e->getMessage()];
        }
    }

    public static function post($url, $data = [], $headers = [])
    {
        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'form_params' => $data,
                'headers' => $headers
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error
            return ['error' => $e->getMessage()];
        }
    }

    public static function put($url, $data = [], $headers = [])
    {
        $client = new Client();
        try {
            $response = $client->request('PUT', $url, [
                'form_params' => $data,
                'headers' => $headers
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete($url, $params = [], $headers = [])
    {
        $client = new Client();
        try {
            $response = $client->request('DELETE', $url, [
                'query' => $params,
                'headers' => $headers
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error
            return ['error' => $e->getMessage()];
        }
    }

    public static function patch($url, $data = [], $headers = [])
    {
        $client = new Client();
        try {
            $response = $client->request('PATCH', $url, [
                'form_params' => $data,
                'headers' => $headers
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle the error
            return ['error' => $e->getMessage()];
        }
    }
}
