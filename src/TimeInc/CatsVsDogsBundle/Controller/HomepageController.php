<?php

namespace TimeInc\CatsVsDogsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomepageController.
 */
class HomepageController extends Controller
{
    public function homepageAction(Request $request)
    {
        $animalClient = $this->get('animal_provider');

        return $this->render('TimeIncCatsVsDogsBundle:Default:homepage.html.twig', [
            'cat' => $animalClient->fetchCat(),
            'dog' => $animalClient->fetchCat(),
        ]);
    }
}
