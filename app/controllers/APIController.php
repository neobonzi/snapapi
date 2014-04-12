<?php

class APIController extends BaseController {
	/**
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * Returns error when resource is not found
	 *
	 * @return Response
	 */
	public function respondNotFound($message = "Not found!")
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}

	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message) {
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the status code
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
