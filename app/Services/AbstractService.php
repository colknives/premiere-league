<?php

namespace App\Services;

class AbstractService
{
	protected $response;

	/**
	 * Get response
	 * 
     * @return mixed $response
     */
	public function response() {
        return $this->response;
    }

    /**
     * Generate response message
     *
     * @param int $status
     * @param string $message
     * @param array $data
     * @return object
     */
    protected function generateResponse($status, $message, $data = []) {
        return (object) [
                    "status" => $status,
                    "message" => __("messages.{$message}", $data)
        ];
    }
}
