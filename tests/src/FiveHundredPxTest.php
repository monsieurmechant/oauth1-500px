<?php

namespace Mechant\OAuth1\Client\Test\Server;

use Mechant\OAuth1\Client\Server\FiveHundredPx;

class FiveHundredPxTest extends \PHPUnit_Framework_TestCase
{

    public function testItTransformsTheUserDetails()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $user = $client->userDetails($mockApiData, $this->getCredentialsMock());

        $this->assertEquals($mockApiData['user']['id'], $user->uid);
        $this->assertEquals($mockApiData['user']['username'], $user->nickname);
        $this->assertEquals($mockApiData['user']['firstname'], $user->firstName);
        $this->assertEquals($mockApiData['user']['lastname'], $user->lastName);
        $this->assertEquals($mockApiData['user']['fullname'], $user->name);
        $this->assertEquals($mockApiData['user']['email'], $user->email);
        $this->assertEquals($mockApiData['user']['about'], $user->description);
    }

    public function testTheUserObjectsContainsExtraInfo()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $user = $client->userDetails($mockApiData, $this->getCredentialsMock());

        $this->assertEquals($this->getReducedApiUserReturn(), $user->extra);
        $this->assertArrayNotHasKey('id', $user->extra);
        $this->assertArrayNotHasKey('username', $user->extra);
        $this->assertArrayNotHasKey('firstname', $user->extra);
        $this->assertArrayNotHasKey('lastname', $user->extra);
        $this->assertArrayNotHasKey('fullname', $user->extra);
        $this->assertArrayNotHasKey('email', $user->extra);
        $this->assertArrayNotHasKey('about', $user->extra);
    }

    public function testItReturnsAnIdFromDecodedData()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $userUid = $client->userUid($mockApiData, $this->getCredentialsMock());

        $this->assertEquals($mockApiData['user']['id'], $userUid);
    }

    public function testItReturnsAnEmailFromDecodedData()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $userEmail = $client->userEmail($mockApiData, $this->getCredentialsMock());

        $this->assertEquals($mockApiData['user']['email'], $userEmail);
    }

    public function testItReturnsTheScreenNameFromDecodedData()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $userScreenName = $client->userScreenName($mockApiData, $this->getCredentialsMock());

        $this->assertEquals($mockApiData['user']['username'], $userScreenName);
    }
    
    public function testLocationInfoAreGroupedInAnArray()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $mockApiData = $this->getApiUserReturn();
        $user = $client->userDetails($mockApiData, $this->getCredentialsMock());

        $this->assertEquals([
            "city"    => "Paris",
            "state"   => null,
            "country" => "France"
        ], $user->location);
    }

    public function testItImplementsTheInterfaceMethod()
    {
        $client = new FiveHundredPx($this->getServerCredentialsMock());

        $this->assertInternalType('string', $client->urlTemporaryCredentials());
        $this->assertInternalType('string', $client->urlAuthorization());
        $this->assertInternalType('string', $client->urlTokenCredentials());
        $this->assertInternalType('string', $client->urlUserDetails());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getCredentialsMock()
    {
        return $this->getMockBuilder('League\Oauth1\Client\Credentials\TokenCredentials')
            ->getMock();
    }

    /**
     * @return array
     */
    protected function getServerCredentialsMock()
    {
        return [
            'identifier'   => 1234567890,
            'secret'       => 'qwertyuiop',
            'callback_uri' => 'http://local.dev/500px',
        ];
    }

    /**
     * @return array
     */
    protected function getApiUserReturn()
    {
        return [
            'user' => [
                'id'                 => 14634089,
                'username'           => 'ImNotRafS',
                'firstname'          => 'Rick',
                'lastname'           => 'Owens',
                'birthday'           => null,
                'sex'                => null,
                'city'               => 'Paris',
                'state'              => null,
                'country'            => 'France',
                'registration_date'  => '2014-10-31T09:39:57-04:00',
                'about'              => 'Stop destroying the landscape with your outfit.',
                'usertype'           => 0,
                'domain'             => 'imnotrafs.500px.com',
                'locale'             => 'en',
                'fullname'           => 'Rick Owens',
                'userpic_url'        => 'https://secure.gravatar.com/avatar/ddf208f9181e41c73dbefe9a8837f107?s=300&r=g&d=https://pacdn.500px.org/userpic.png',
                'userpic_https_url'  => 'https://secure.gravatar.com/avatar/ddf208f9181e41c73dbefe9a8837f107?s=300&r=g&d=https://pacdn.500px.org/userpic.png',
                'photos_count'       => 123,
                'galleries_count'    => 3,
                'affection'          => 424242,
                'in_favorites_count' => 4242,
                'friends_count'      => 15,
                'followers_count'    => 123456789,
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getReducedApiUserReturn()
    {
        return [
            'birthday'           => null,
            'sex'                => null,
            'registration_date'  => '2014-10-31T09:39:57-04:00',
            'usertype'           => 0,
            'locale'             => 'en',
            'userpic_url'        => 'https://secure.gravatar.com/avatar/ddf208f9181e41c73dbefe9a8837f107?s=300&r=g&d=https://pacdn.500px.org/userpic.png',
            'photos_count'       => 123,
            'galleries_count'    => 3,
            'affection'          => 424242,
            'in_favorites_count' => 4242,
            'friends_count'      => 15,
            'followers_count'    => 123456789,
        ];
    }


}
