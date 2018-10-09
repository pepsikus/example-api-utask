<?php

namespace Tests;

trait WithHeaders
{
    /**
     * @var array
     */
    protected $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

    public function setHeaders(array $data = [])
    {
        $this->headers = array_merge($this->headers, $data);

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
