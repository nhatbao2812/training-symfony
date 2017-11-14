<?php
namespace AppBundle\Controller;

use AppBundle\Util\ResponseUtil;
use AppBundle\Util\uploadCVUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TestController extends APIController
{

    /**
     * @Route("/-", name="testController")
     */
    public function test() {
        //because array_size > number of slug in url, all parameters from the number of slug will be query string ex: /lucky/2/abc?test=abc
       echo "hello";
       //$url=$this->generateUrl("lucky_number",array("numb"=>2));
       return $this->redirectToRoute("lucky_number",array("numb"=>2, "test"=>"bao"),301);

    }

    /**
     * @Route("/testDisplay", name="testDisplay")
     */
    public function testDisplay() {
        return $this->render("child.html.twig");

    }

    /**
     * @Route ("/hello", name="hello_get")
     * @Method({"GET"})
     */
    public function helloGet(Request $request) {
        return $this->render("hello.html.twig",array("input"=>''));
    }

    /**
     * @Route ("/hello", name="hello_post")
     * @Method({"POST"})
     */
    public function helloPost(Request $request) {
        //echo   $request->headers->get('content_type');
        $requestData = [
            'data' =>  $_POST['hello'],
            'message' => 'success',
            'status' =>  Response::HTTP_OK
        ];
        $responseData = ResponseUtil::response($requestData);
        $response = new Response($responseData);
        return $response;
 //       return $this->render("hello.html.twig",array("input"=>$_POST['hello']));
    }

    /**
     * @Route ("/upload", name="upload")
     * @Method({"POST"})
     */
    public function uploadfile(Request $request) {

        $files = $request->files;
        $file = $files[0];

        if(!UploadCVUtil::checkFileExtension($file)) {
            $requestData = [
                'data' => $file->getFilename(),
                'message' => 'Invalid extension',
                'status' => Response::HTTP_BAD_REQUEST
            ];

            return $this->response($requestData);
        }

        if(!UploadCVUtil::checkFileSize($file)) {
            $requestData = [
                'data' => $file->getFilename(),
                'message' => 'File size must be less or equal 2 MB',
                'status' => Response::HTTP_BAD_REQUEST
            ];

            return $this->response($requestData);
        }

        $target_file = UploadCVUtil::TARGET_DIR . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $requestData = [
            'data' => $file->getFilename(),
            'message' => 'Success',
            'status' => Response::HTTP_OK
        ];
        return $this->response($requestData);
    }



//    /**
//     * @Route("/lucky/{numb}", name="lucky_number")
//     */
//    public function number($numb)
//    {
//        $number = mt_rand(0, 100);
//        return $this->render('number.html.twig', array(
//            'number' => $number,'sign'=>$numb
//        ));
//    }
}