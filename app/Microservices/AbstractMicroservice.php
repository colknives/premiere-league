<?php

namespace App\Microservices;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;

use App\Helpers\CurlServiceResponse;

class AbstractMicroservice
{
	protected $method = '';

	protected $baseUrl = '';

    protected $url = '';

    private $query = '';

    private $payload = [];

    protected $headers = [];

    protected $timeout = '60';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->getBaseUrl(),
            'timeout' => $this->getTimeout()
        ]);
    }

	public function call()
	{
		try {

            $response = $this->client->request(
                $this->method,
                $this->url,
                [
                    'json' => $this->payload,
                    'query' => $this->query,
                    'headers' => $this->headers
                ]
            );

            return $this->successResponse($response);

        } catch (ClientException $e) {

            return $this->failedResponse($e->hasResponse(), $e);

        } catch (ServerException $e) {

            return $this->failedResponse($e->hasResponse(), $e);

        } catch (RequestException $e) {

            return $this->failedResponse($e->hasResponse(), $e);

        }
	}

	protected function failedResponse($hasResponse, $e)
    {
        if ($hasResponse) {

            $response = new CurlServiceResponse($e->getResponse());

            $response->setMessage("Something went wrong, please try again.");

            return $response->response();
        }

        return $this->requestTimeout();
    }

    protected function successResponse(Response $response)
    {
        $response = new CurlServiceResponse($response);

        $response->setMessage("Request Successful..");

        return $response->response();
    }


    private function requestTimeout()
    {
        $response = new CurlServiceResponse();

        $response->setMessage("Request Timeout..")->setStatus(504);

        return $response->response();
    }

    private function getTimeout() 
    {
        return $this->timeout;
    }

    private function getBaseUrl() {

        if ($this->baseUrl == null) {
            throw new \Exception('Please provide valid base uri');
        }

        return $this->baseUrl;
    }
}
