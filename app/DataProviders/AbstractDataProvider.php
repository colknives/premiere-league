<?php

namespace App\DataProviders;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;

use App\Helpers\CurlServiceResponse;

class AbstractDataProvider
{
	protected $method = '';

	protected $baseUrl = '';

    protected $url = '';

    private $query = '';

    private $payload = [];

    protected $headers = [];

    protected $timeout = '60';

    /**
     * AbstractDataProvider __construct method
     * 
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->getBaseUrl(),
            'timeout' => $this->getTimeout()
        ]);
    }

    /**
     * Initiate request call to data provider
     * 
     * @return object $response
     */
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

    /**
     * Process failed response
     * 
     * @return object response
     */
	protected function failedResponse($hasResponse, $e)
    {
        if ($hasResponse) {

            $response = new CurlServiceResponse($e->getResponse());

            $response->setMessage("Something went wrong, please try again.");

            return $response->response();
        }

        return $this->requestTimeout();
    }

    /**
     * Process success response
     * 
     * @return object response
     */
    protected function successResponse(Response $response)
    {
        $response = new CurlServiceResponse($response);

        $response->setMessage("Request Successful..");

        return $response->response();
    }

    /**
     * Process timeout
     * 
     * @return object response
     */
    private function requestTimeout()
    {
        $response = new CurlServiceResponse();

        $response->setMessage("Request Timeout..")->setStatus(504);

        return $response->response();
    }

    /**
     * Get timeout value
     * 
     * @return integer $timeout
     */
    private function getTimeout() 
    {
        return $this->timeout;
    }

    /**
     * Get base url
     * 
     * @return string $baseUrl
     */
    private function getBaseUrl() {

        if ($this->baseUrl == null) {
            throw new \Exception('Please provide valid base uri');
        }

        return $this->baseUrl;
    }
}
