<?php
/**
 * Created by PhpStorm.
 * User: trannhatbao
 * Date: 11/14/17
 * Time: 11:08 AM
 */

namespace AppBundle\Controller;


use AppBundle\Util\ResponseUtil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class APIController extends Controller
{
    public function response($requestData) {
        $responseData = ResponseUtil::response($requestData);
        return new Response($responseData);
    }
}