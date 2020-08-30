<?php

namespace App\Services\Common;


class ResponseService implements ResponseServiceInterface
{
    /**
     * create success response object
     * @param $data
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    public static function success($data, $message = null)
    {
        $content = [ 'data' => $data];
        if (isset($message))
            $content['msg'] = $message;

        return response()->json($content, self::STATUS_CODE_SUCCESS);
    }
    /**
     * create success response object
     * @param $data
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    public static function create($data, $message = null)
    {
        $content = [ 'data' => $data];
        if (isset($message))
            $content['msg'] = $message;

        return response()->json($content, self::STATUS_CODE_SUCCESS);
    }

    /**
     * create response object for flow errors
     * @param $status
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    public static function error($status, $message= null)
    {
        $content = [
            'error'  =>ResponseService::mapStatusToMessageInFlowError()[$status]
        ];
        if (isset($message))
            $content['msg'] = $message;

        return response()->json($content, $status);
    }

    /**
     * map status code to message error
     * @return array
     */
    public static function mapStatusToMessageInFlowError()
    {
        return [
            self::STATUS_CODE_FLOW_ERROR_500 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_500'),
            self::STATUS_CODE_FLOW_ERROR_401 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_401'),
            self::STATUS_CODE_FLOW_ERROR_430 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_430'),
            self::STATUS_CODE_FLOW_ERROR_400 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_400'),
            self::STATUS_CODE_FLOW_ERROR_404 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_404'),
            self::STATUS_CODE_FLOW_ERROR_432 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_432'),
            self::STATUS_CODE_FLOW_ERROR_406 => __('error.flow_error.STATUS_CODE_FLOW_ERROR_406'),
        ];
    }
}
