<?php

namespace TimeInc\CatsVsDogsBundle\AnimalProvider;

use TimeInc\CatsVsDogsBundle\Document\Cat;
use TimeInc\CatsVsDogsBundle\Document\Dog;

/**
 * Interface ProviderInterface.
 */
interface ProviderInterface
{
    /**
     * @return Cat
     */
    public function fetchCat();

    /**
     * @return Dog
     */
    public function fetchDog();
}
