<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/{numb}", name="lucky_number", requirements={"numb": "\d+"})
     */
    public function numberAction($numb)
    {

        $number = $numb+mt_rand(0, 100);
        return $this->render('number.html.twig', array(
            'number' => $number,'sign'=>"add",
            'link' => 'http://symfony.local/hello'
        ));
    }

    /**
     * @Route("/lucky", name="lucky")
     */
    public function number()
    {

        $number = mt_rand(0, 100);
        return $this->render('number.html.twig', array(
            'number' => $number,'sign'=>"add",
            'link' => 'http://symfony.local/hello'
        ));
    }

    /**
     * @Route("/test", name="test")
     */
    public function test() {
        //because array_size > number of slug in url, all parameters from the number of slug will be query string ex: /lucky/2/abc?test=abc
        $url=$this->generateUrl("lucky_number",array('numb' => 2,'cha'=>'abc','test'=>'abc'));
        //var_dump($url);
        return $this->redirectToRoute('testController');
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