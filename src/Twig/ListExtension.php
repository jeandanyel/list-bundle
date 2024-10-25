<?php

namespace Jeandanyel\ListBundle\Twig;

use Jeandanyel\ListBundle\List\ListViewInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ListExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('list', [$this, 'renderList'], ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    public function renderList(Environment $twig, ListViewInterface $listView): string
    {
        return $twig->render($listView->getTemplatePath(), ['list' => $listView]);
    }
}
