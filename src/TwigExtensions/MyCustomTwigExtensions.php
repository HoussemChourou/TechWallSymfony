<?php

namespace App\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class MyCustomTwigExtensions extends AbstractExtension
{
    public function getFilters(){
        return [
            new TwigFilter('defaultImage', [$this, 'defaultImage']),
        ];
    }

    public function defaultImage(string $path):string{
        if(strlen(trim($path))==0){
            return 'pic.png';
        }
        return $path;
    }

}