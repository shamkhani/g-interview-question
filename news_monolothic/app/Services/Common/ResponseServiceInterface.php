<?php

namespace App\Services\Common;

/**
 * Interface MariaDBRepositoryInterface. All the repositories should implement this interface.
 *
 * @author  Mostafa Shamkhani
 */
interface ResponseServiceInterface
{
    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_CREATE = 201;

    const STATUS_CODE_FLOW_ERROR_500 = 500;   // internal serve error
    const STATUS_CODE_FLOW_ERROR_401 = 401;   // token expired
    const STATUS_CODE_FLOW_ERROR_430 = 430;   // invalid token
    const STATUS_CODE_FLOW_ERROR_432 = 432;   // invalid credential
    const STATUS_CODE_FLOW_ERROR_400 = 400;   // token not provided
    const STATUS_CODE_FLOW_ERROR_404 = 404;   // not found
    const STATUS_CODE_FLOW_ERROR_406 = 406;   // not acceptable

    /**
     * create success response object
     * @param $data
     * @param null $message
     */
    public static function success($data, $message= null);

    /**
     * create response object for flow errors
     * @param $status
     * @param null $message
     */
    public static function error($status, $message= null);


}
