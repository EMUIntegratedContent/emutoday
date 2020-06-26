<?php

namespace Emutoday\Http\Controllers\Api;
use Emutoday\Http\Controllers\Controller as Controller;
use Illuminate\Http\Response as IlluminateResponse;


class ApiController extends Controller
{

/**
 * [$statusCode description]
 * @var integer
 */
protected $statusCode = 200;



    /**
     * [getStatusCode description]
     * @return [type] [description]
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * [setStatusCode description]
     * @param [type] $statusCode [description]
     * @return $this [For chaining]
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);

    }

    /**
     * [respondInternalError description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);

    }
    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  [type] $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * [respondWithError description]
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function respondWithError($message)
    {

        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
    public function respondCreatedWithId($message, $record_id)
    {

        return $this->setStatusCode(201)->respond([
          'message' => $message,
          'record_id' => $record_id
        ]);
    }
    public function respondUpdatedWithData($message, $data)
    {

        return $this->setStatusCode(201)->respond([
          'message' => $message,
          'newdata' => $data
        ]);
    }
    public function respondSavedWithData($message, $data)
    {

        return $this->setStatusCode(201)->respond([
          'message' => $message,
          'newdata' => $data
        ]);
    }
    public function respondUpdated($message)
    {

        return $this->setStatusCode(201)->respond([
          'message' => $message
        ]);
    }
    public function respondCreated($message)
    {

        return $this->setStatusCode(201)->respond([
          'message' => $message
        ]);
    }
}
