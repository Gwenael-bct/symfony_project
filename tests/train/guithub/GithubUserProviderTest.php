<?php

namespace App\Tests\train\guithub;

use App\Security\GithubUserProvider;
use App\traintest\guithub\GithubUserProvider;
use http\Env\Request;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GithubUserProviderTest extends WebTestCase
{
    public function testUser()
    {
        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];
        $client = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $serializer = $this
            ->getMockBuilder('JMS\Serializer\Serializer')
            ->disableOriginalConstructor()
            ->getMock();

        $streamedResponse = $this
            ->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();
        $streamedResponse->method('getContents')->willReturn('foo');
        $response->method('getBody')->willReturn($streamedResponse);
        $githubUserProvider = new GithubUserProvider($client, $serializer);
        $user = $githubUserProvider->loadUserByUsername('an-access-token');
    }


}