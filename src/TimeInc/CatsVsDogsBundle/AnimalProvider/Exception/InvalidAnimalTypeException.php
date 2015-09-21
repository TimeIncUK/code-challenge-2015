<?php
namespace TimeInc\CatsVsDogsBundle\AnimalProvider\Exception;

/**
 * Class InvalidAnimalTypeException
 *
 * @package TimeInc\CatsVsDogsBundle\AnimalProvider\Exception
 */
class InvalidAnimalTypeException extends \Exception
{
    /**
     * Override the constructor to build a more useful error message
     *
     * @param string     $attemptedType The animal we're trying with
     * @param array      $expectedTypes The allowed types of animals
     * @param \Exception $previous      The previous exception
     */
    public function __construct($attemptedType, array $expectedTypes, \Exception $previous = null)
    {
        $message = 'Given type "'.$attemptedType.'" did not match requirements of ['.implode(', ', $expectedTypes).']';
        parent::__construct($message, 0, $previous);
    }
}
