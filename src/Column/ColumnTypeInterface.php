<?php

namespace Jeandanyel\ListBundle\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ColumnTypeInterface
{
    public function configureOptions(OptionsResolver $optionsResolver): void;
    public function getParent(): ?string;
}
