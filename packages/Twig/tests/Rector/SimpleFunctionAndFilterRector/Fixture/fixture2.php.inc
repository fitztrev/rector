<?php

namespace  Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Fixture;

use Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Source\TwigExtension;
use Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Source\TwigFilterMethod;

final class SomeExtension2 extends TwigExtension
{
    public function getFilters()
    {
        return [
            'is_mobile' => new TwigFilterMethod($this, 'isMobile'),
        ];
    }
}

?>
-----
<?php

namespace  Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Fixture;

use Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Source\TwigExtension;
use Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Source\TwigFilterMethod;

final class SomeExtension2 extends TwigExtension
{
    public function getFilters()
    {
        return [
            new \Rector\Twig\Tests\Rector\SimpleFunctionAndFilterRector\Source\TwigSimpleFilter('is_mobile', [$this, 'isMobile']),
        ];
    }
}

?>
