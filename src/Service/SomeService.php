<?php 

namespace App\Service;

use Twig\Environment;

class SomeService
{
    public function __construct(
        private Environment $twig,
    ) {
    }

    public function someMethod()
    {        
        $htmlContents = $this->twig->render('test/blog_home.html.twig', [
            'category' => 'Sample Category',
            'promotions' => ['promotions - 1', 'promotions - 2'],
        ]);
    }
}


?>