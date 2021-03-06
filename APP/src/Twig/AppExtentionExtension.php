<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtentionExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'plural']),

            //her you put all function call
            
           /*  new TwigFunction('toto', [$this, 'koko']), */
        ];
      
    }

    public function plural(int $count, string $singular, string $plural)
    {
        $result = $count === 1 ? $singular : $plural;
        return  "$count  $result";
    }
    //here to put the function you declare
     public function koko()
    {
        return "tiko web site new new  gooooooooood";
    }
}