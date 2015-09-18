<?php

namespace TimeInc\CatsVsDogsBundle\AnimalProvider\Giphy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use TimeInc\CatsVsDogsBundle\AnimalProvider\Exception\AnimalRetrievalFailed;
use TimeInc\CatsVsDogsBundle\AnimalProvider\Exception\InvalidAnimalTypeException;
use TimeInc\CatsVsDogsBundle\AnimalProvider\ProviderInterface;
use TimeInc\CatsVsDogsBundle\Document\Cat;
use TimeInc\CatsVsDogsBundle\Document\Dog;

/**
 * Class GiphyProvider
 *
 * @package TimeInc\CatsVsDogsBundle\AnimalProvider\Giphy
 */
class GiphyProvider implements ProviderInterface
{
    const TYPE_CAT = 'cat';
    const TYPE_DOG = 'dog';

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $giphyApiKey;

    /**
     * GiphyClient constructor.
     *
     * @param Client $httpClient
     * @param string $giphyApiKey
     */
    public function __construct(Client $httpClient, $giphyApiKey)
    {
        $this->httpClient  = $httpClient;
        $this->giphyApiKey = $giphyApiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchCat()
    {
        $response = $this->doApiRequest(self::TYPE_CAT);

        $payload = json_decode((string)$response->getBody(), true);

        $animal = new Cat();
        $animal->setId($payload['data']['id']);
        $animal->setImageSrc($payload['data']['image_url']);
        $animal->setWidth($payload['data']['image_width']);
        $animal->setHeight($payload['data']['image_height']);

        return $animal;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchDog()
    {
        $response = $this->doApiRequest(self::TYPE_DOG);

        $payload = json_decode((string)$response->getBody(), true);

        $animal = new Dog();
        $animal->setId($payload['data']['id']);
        $animal->setImageSrc($payload['data']['image_url']);
        $animal->setWidth($payload['data']['image_width']);
        $animal->setHeight($payload['data']['image_height']);

        return $animal;
    }

    /**
     * Make a request to the API and return an animal
     *
     * @param $type
     *
     * @return ResponseInterface
     *
     * @throws AnimalRetrievalFailed
     * @throws InvalidAnimalTypeException
     */
    protected function doApiRequest($type)
    {
        if ($type !== self::TYPE_FISH && $type !== self::TYPE_DOG) {
            throw new InvalidAnimalTypeException($type, [self::TYPE_CAT, self::TYPE_DOG]);
        }

        try {
            return $this->httpClient->get(
                'http://api.giphy.com/v1/gifs/random',
                [
                    'query' => [
                        'api_key' => $this->giphyApiKey,
                        'tag'     => $type,
                    ],
                ]
            );
        } catch (RequestException $e) {
            throw new AnimalRetrievalFailed($type, $e);
        }
    }
}
