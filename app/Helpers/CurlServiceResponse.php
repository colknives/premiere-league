<?php

namespace App\Helpers;

use GuzzleHttp\Psr7\Response;

class CurlServiceResponse
{
    protected $message;

    protected $status;

    protected $response;

    protected $result;

    /**
     * CurlServiceResponse __construct method
     *
     * @param Response $response
     */
    public function __construct(Response $response = null)
    {
        $this->response = $response;

        if ($response != null) {
            $this->setStatus($response->getStatusCode());
            $this->setMessage($response->getReasonPhrase());
            $this->setResult($response->getBody());
        }
    }

    /**
     * Get Response Message
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Response Message
     *
     * @param mixed $message
     * @return $this
     */
    public function setMessage($message): CurlServiceResponse
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get Response Status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Response Status
     *
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status): CurlServiceResponse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Response Result
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set Response Status
     *
     * @param mixed $result
     * @return $this
     */
    public function setResult($result): CurlServiceResponse
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get response
     *
     * @return object
     */
    public function response()
    {
        return (object)[
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'result' => json_decode($this->getResult())
        ];
    }
}