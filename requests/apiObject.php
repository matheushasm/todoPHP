<?php

class Options {
    private $url;
    private $method;
    private array $headers;

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($u) {
        $this->url = $u;
    }

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($m) {
        $this->method = $m;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function setHeaders($h) {
        $this->headers = [...$h];
    }
}

class Request {
    private $options;

    public function __construct(Options $driver) {
        $this->options = $driver;
    }
    
    public function newRequest() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->options->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->options->getMethod(),
            CURLOPT_HTTPHEADER => $this->options->getHeaders()
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            return $result;
        }
    }
}