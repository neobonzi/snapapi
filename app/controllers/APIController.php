<?php

use \Illuminate\Http\Response as IlluminateResponse;

class APIController extends BaseController {
	/**
	 * @var int
	 */
	protected $statusCode = IlluminateResponse::HTTP_OK;

	/**
	 * Responds with an internal server error
	 * @param string $message 
	 * @return Response
	 */
	public function respondServerError($message = "Internal server error!") {
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);	
	}

	public function respondUnprocessableEntity($message = "Unprocessable entity!") {
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	/**
	 * Returns error when resource is not found
	 * @param string $message
	 * @return Response
	 */
	public function respondNotFound($message = "Not found!")
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}
	/**
	 * Returns error when resource is unauthorized
	 * @param string $message 
	 * @return Response
	 */
	public function respondUnauthorized($message = "Not authorized!")
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
	}

	/**
	 * Generic all OK response
	 * @param array $data 
	 * @param array $headers 
	 * @return Response
	 */
	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * Responds with an error given current status code.
	 * @param string $message 
	 * @return Response
	 */
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
