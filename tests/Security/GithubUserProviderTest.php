<?php
namespace App\Tests\Security;
use App\Entity\User;
use App\Security\GithubUserProvider;
use PHPUnit\Framework\TestCase;
class GithubUserProviderTest extends TestCase
{
    public function testLoadUserByUsernameReturningAUser()
    {
        $client = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $serializer = $this
            ->getMockBuilder('JMS\Serializer\Serializer')
            ->disableOriginalConstructor()
            ->getMock();
        $response = $this

            ->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();
        $client
            ->expects($this->once()) // Nous nous attendons à ce que la méthode get soit appelée une fois
            ->method('get')
            ->willReturn($response)
        ;
        $streamedResponse = $this

            ->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();
        $response
            ->expects($this->once()) // Nous nous attendons à ce que la méthode getBody soit appelée une fois
            ->method('getBody')
            ->willReturn($streamedResponse);
        $streamedResponse
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('foo');
        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];
        $serializer
            ->expects($this->once()) // Nous nous attendons à ce que la méthode deserialize soit appelée une fois
            ->method('deserialize')
            ->willReturn($userData);
        $githubUserProvider = new GithubUserProvider($client, $serializer);
        $user = $githubUserProvider->loadUserByUsername('an-access-token');
    }
}