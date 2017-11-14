<?php
namespace AppBundle\Util;

use \Symfony\Component\HttpFoundation\Response;

class ResponseUtil
{
    public static function response($response = [])
    {
        $response['data'] = (isset($response['data'])) ? $response['data'] : [];
        $response['message'] = (isset($response['message'])) ? $response['message'] : '';
        $response['status'] = (isset($response['status'])) ? $response['status'] : Response::HTTP_OK;

        return json_encode($response);
    }


}