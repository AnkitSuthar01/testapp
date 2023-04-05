<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {

        $users = ['test1','test2'];
        // $product = '';  

        // if (!$product) {            
        //     throw $this->createNotFoundException('The product does not exist THIS IS TEST!!');

        //     // the above is just a shortcut for:
        //     // throw new NotFoundHttpException('The product does not exist');
        // }

        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
          

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController','users' => $users,
        ]);
    }

    public function number(): Response
    {
        $users  = ['test1','test2']; 
        $number = random_int(0, 100);

        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route('/random/number')]
    public function numberNew(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    public function ajaxPostAction(Request $request): Response
    {

        dd(
            $request->request->all(),
            $request->getPreferredLanguage(['en', 'fr']),
            $request->query->get('param1'),
            $request->request->get('param2'),            
            $request->server->get('HTTP_HOST'),
            $request->files->get('foo'),
            $request->cookies->get('PHPSESSID'),
            $request->headers->get('host'),
            $request->headers->get('content-type')
        );
        dd($request->isXmlHttpRequest());


        if ($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            // Handle the data sent in the request
            // ...
            return new Response('Success!', 200);
        }
        return new Response('Error: not an AJAX request', 400);
    }
}
