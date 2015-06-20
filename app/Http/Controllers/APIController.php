<?php namespace App\Http\Controllers;

class APIController extends Controller {

    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @return mixed
     */
    private function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param mixed $data
     * @param array $headers
     * @param null $options
     * @return mixed
     */
    private function respond($data, array $headers = [], $options = null)
    {
        return response()->json($data, $this->getStatusCode(), $headers, $options);
    }

    /**
     * @param mixed $payload
     * @param null $options
     * @param array $headers
     * @return array
     */
    public function respondSuccess($payload = null, $options = null, $headers = [])
    {
        return $this->respond([
            'status' => 'success',
            'payload' => $payload
        ],
            $headers,
            $options
        );
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondWithFail($message, $code, $error = null)
    {
        return $this->respond([
            'status' => 'fail',
            'payload' => [
                'message' => $message,
                'code' => $code,
                'error' => $error
            ]
        ]);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondWithError($message, $code, $error = null)
    {
        return $this->respond([
            'status' => 'error',
            'payload' => [
                'message' => $message,
                'code' => $code,
                'error' => $error
            ]
        ]);
    }

    /**
     * ------------------
     * 200s HTTP Status Codes
     * ------------------
     */

    /**
     * @param null $payload
     * @param mixed $options
     * @return array
     */
    public function respondOK($payload = null, $options = JSON_UNESCAPED_SLASHES)
    {
        return $this->respondSuccess($payload, $options);
    }

    /**
     * @param $payload
     * @param mixed $options
     * @return array
     */
    public function respondCreated($payload, $options = JSON_UNESCAPED_SLASHES)
    {
        return $this->setStatusCode(201)->respondSuccess($payload, $options);
    }

    /**
     * ------------------
     * 400s HTTP Status Codes
     * ------------------
     */

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondBadRequest($message = 'Missing required request data', $code = 300, $error = null)
    {
        return $this->setStatusCode(400)->respondWithFail($message, $code, $error);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondInvalidAuth($message = 'Invalid auth credentials', $code = 101, $error = null)
    {
        return $this->setStatusCode(401)->respondWithFail($message, $code, $error);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondForbidden($message = 'Not authorized', $code = 102, $error = null)
    {
        return $this->setStatusCode(403)->respondWithFail($message, $code, $error);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondNotFound($message = 'Not found', $code = 150, $error = null)
    {
        return $this->setStatusCode(404)->respondWithFail($message, $code, $error);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondPreconditionFail($message = 'X-Auth-Token header missing', $code = 302, $error = null)
    {
        return $this->setStatusCode(412)->respondWithFail($message, $code, $error);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondUnprocessable($message = 'Validation error', $code = 250, $error = null)
    {
        return $this->setStatusCode(422)->respondWithFail($message, $code, $error);
    }

    /**
     * ------------------
     * 500s HTTP Status Codes
     * ------------------
     */

    /**
     * @param string $message
     * @param int $code
     * @param $error
     * @return mixed
     */
    public function respondServerError($message = 'Server error', $code = 500, $error = null)
    {
        return $this->setStatusCode(500)->respondWithError($message, $code, $error);
    }

}