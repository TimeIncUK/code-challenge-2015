<?php

namespace TimeInc\CatsVsDogsBundle\AnimalProvider\Exception;

use Exception;

/**
 * Class AnimalRetrievalFailed.
 */
class AnimalRetrievalFailed extends \Exception
{
    /**
     * @param string         $type
     * @param Exception|null $previous
     */
    public function __construct($type, Exception $previous = null)
    {
        $message = 'The provider failed to fetch an animal of type "'.$type.'"';
        parent::__construct($message, 0, $previous);
    }
}
