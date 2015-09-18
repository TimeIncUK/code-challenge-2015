<?php

namespace TimeInc\CatsVsDogsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomepageController
 * @package TimeInc\CatsVsDogsBundle\Controller
 */
class HomepageController extends Controller
{
    public function homepageAction(Request $request)
    {
        $animalClient = $this->get('animal_provider');

        return $this->render('TimeIncCatsVsDogsBundle:Homepage:homepage.html.twig', [
            'cat' => $animalClient->fetchCat(),
            'dog' => $animalClient->fetchDog(),
        ]);
    }
}
