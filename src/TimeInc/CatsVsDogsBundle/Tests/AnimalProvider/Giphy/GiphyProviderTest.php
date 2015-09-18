<?php

namespace TimeInc\CatsVsDogsBundle\Tests\AnimalProvider\Giphy;

use GuzzleHttp\Client;
use TimeInc\CatsVsDogsBundle\AnimalProvider\Giphy\GiphyProvider;

/**
 * Class GiphyProviderTest.
 */
class GiphyProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Setup the client for both tests.
     */
    public function setUp()
    {
        $this->client = $this->getMockBuilder('GuzzleHttp\Client')
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Tests retrieving a cat.
     */
    public function testFetchCat()
    {
        // init vars
        $apiKey = 'this-is-an-api-key';

        // request expectations
        $tag = GiphyProvider::TYPE_CAT;
        $request = ['query' => ['api_key' => $apiKey, 'tag' => $tag]];

        // response expectations
        $id = 10010;
        $imageUrl = 'this-is-a-test-image-url';
        $imageWidth = 300;
        $imageHeight = 600;
        $response = new ResponseFake();
        $response->setBody(['data' => ['id' => $id, 'image_url' => $imageUrl, 'image_width' => $imageWidth, 'image_height' => $imageHeight]]);

        // init client
        $this->client->expects($this->any())
            ->method('get')
            ->with($this->anything(), $this->equalTo($request))
            ->will($this->returnValue($response));

        // get the cat
        $provider = new GiphyProvider($this->client, $apiKey);
        $animal = $provider->fetchCat();

        // assert an animal with expected data is returned
        $this->assertInstanceOf('TimeInc\CatsVsDogsBundle\Document\Cat', $animal);
        $this->assertEquals($id, $animal->getId());
        $this->assertEquals($imageUrl, $animal->getImageSrc());
        $this->assertEquals($imageWidth, $animal->getWidth());
        $this->assertEquals($imageHeight, $animal->getHeight());
    }

    /**
     * Tests retrieving a dog.
     */
    public function testFetchDog()
    {
        // init vars
        $apiKey = 'this-is-another-api-key';

        // request expectations
        $tag = GiphyProvider::TYPE_DOG;
        $request = ['query' => ['api_key' => $apiKey, 'tag' => $tag]];

        // response expectations
        $id = 23457;
        $imageUrl = 'this-is-another-test-image-url';
        $imageWidth = 200;
        $imageHeight = 400;
        $response = new ResponseFake();
        $response->setBody(['data' => ['id' => $id, 'image_url' => $imageUrl, 'image_width' => $imageWidth, 'image_height' => $imageHeight]]);

        // init client
        $this->client->expects($this->any())
            ->method('get')
            ->with($this->anything(), $this->equalTo($request))
            ->will($this->returnValue($response));

        // get the cat
        $provider = new GiphyProvider($this->client, $apiKey);
        $animal = $provider->fetchDog();

        // assert an animal with expected data is returned
        $this->assertInstanceOf('TimeInc\CatsVsDogsBundle\Document\Dog', $animal);
        $this->assertEquals($id, $animal->getId());
        $this->assertEquals($imageUrl, $animal->getImageSrc());
        $this->assertEquals($imageWidth, $animal->getWidth());
        $this->assertEquals($imageHeight, $animal->getHeight());
    }
}

/**
 * Class ResponseFake.
 */
class ResponseFake
{
    private $response;

    public function setBody($response)
    {
        $this->response = json_encode($response);
    }

    public function getBody()
    {
        return $this->response;
    }
}
