<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


use Psr\Log\LoggerInterface;

use App\Service\MessageGenerator;


class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        /*Array Example*/
        $users = [
            'user_first_name' => 'Test',
            'user_last_name' => 'APP',
        ];

        
        $notifications = 'TEST notification. IPSUM- n luctus nibh id arcu semper, id ullamcorper quam dictum. In tincidunt metus at lacus vehicula,';
       
        /*Array Example to view in loop*/
        $articles = [
            '1'=>['id'=>1, 'title' => 'Google article 1','slug'=>'article_1','url'=>'https://www.google.com'], 
            '2'=>['id'=>2, 'title' => 'Facebook article 2','slug'=>'article_2','url'=>'https://www.facebook.com'],
            '3'=>['id'=>3, 'title' => 'Gmail article 3','slug'=>'article_3','url'=>'https://www.gmail.com'],
        ];

        /*Random number generator*/

        $number = random_int(0, 100);


        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
          

        return $this->render('test/index.html.twig', [
            'controller_name'   => 'TestController',
            'users'             => $users,
            'notifications'     => $notifications,
            'articles'          => $articles,
            'number'            => $number
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


    public function blogExample(Request $request): Response
    {

        $page_title = 'BLOG PAGE';

        $userFirstName = 'TEST USER';
        $userNotifications = ['Note - 1 - ibh id arcu semper luctus nibh id arcu semper', 'Note - 2 - ibh id arcu semper luctus nibh id arcu semperibh id arcu semper luctus nibh id arcu semper'];


         /*Array Example to view in loop*/
        $blog = [
            '1'=>[
                'id'        =>1, 
                'title'     => 'Google blog 1',
                'slug'      =>'blog_1',
                'url'       =>'https://www.google.com',
                'content'   =>'luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper.'], 
            '2'=>[
                'id'        =>2, 
                'title'     => 'Google blog 2',
                'slug'      =>'blog_1',
                'url'       =>'https://www.google.com',
                'content'   =>'luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper.'], 
            '3'=>[
                'id'        =>3, 
                'title'     => 'Google blog 3',
                'slug'      =>'blog_1',
                'url'       =>'https://www.google.com',
                'content'   =>'luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper luctus nibh id arcu semper.'],
        ];

        return $this->render('test/blog_home.html.twig', [
            'controller_name'   => 'TestController',
            'blog'              => $blog,
            'page_title'        => $page_title,
            'user_first_name'   => $userFirstName,
            'notifications'     => $userNotifications,
        ]);

    }

    public function showBlog(Request $request, $slug): Response
    {
        dd($slug);
    }

    /*HttpKernel Component EXAMPLE*/

    public function hello(Request $request): Response
    {
        $name = $request->attributes->get('name');
        $content = sprintf('Hello %s!', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));
        return new Response($content);
    }
    


    /*Service Container EXAPLE*/

    #[Route('/products')]
    public function list(LoggerInterface $logger): Response
    {
        $logger->info('Look, I just used a service!');

        exit();
    }

    #[Route('/products/new')]
    public function new(MessageGenerator $messageGenerator): Response
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);

        // dd($message);
        

        return $this->render('test/product_home.html.twig');

    }


}
