<?php
// src/Security/GithubUserProvider.php
namespace App\Security;
use App\Entity\User;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Symfony\Component\Security\Core\User\UserProviderInterface;
//…
class GithubUserProvider implements UserProviderInterface
{
    private $client;
    private $serializer;
    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }
    public function loadUserByUsername($username) : User
    {
        $response = $this->client->get('https://api.github.com/user?access_token='.$username);
        $result = $response->getBody()->getContents();
        $userData = $this->serializer->deserialize($result, 'array', 'json');
        if (!$userData) {
            throw new \LogicException('Did not managed to get your user info from Github.');
        }
        $user = new User(
            $userData['login'],
            $userData['name'],
            $userData['email'],
            $userData['avatar_url'],
            $userData['html_url']
        );
        return $user;
    }
    // …
}