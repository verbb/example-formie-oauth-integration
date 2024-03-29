<?php
namespace modules\formieoauth\auth;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use verbb\auth\base\ProviderTrait;

class MyProvider extends AbstractProvider
{
    // Traits
    // =========================================================================

    use BearerAuthorizationTrait;
    use ProviderTrait;


    // Public Methods
    // =========================================================================

    public function getBaseAuthorizationUrl(): string
    {
        return 'https://accounts.zoho.com/oauth/v2/auth';
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return 'https://accounts.zoho.com/oauth/v2/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return 'https://accounts.zoho.com/oauth/user/info';
    }

    public function getApiUrl(): string
    {
        return 'https://www.zohoapis.com';
    }

    public function getBaseApiUrl(): ?string
    {
        return $this->getApiUrl();
    }


    // Protected Methods
    // =========================================================================

    protected function getDefaultScopes(): array
    {
        return ['aaaserver.profile.READ'];
    }

    protected function getScopeSeparator(): string
    {
        return ' ';
    }

    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                ($data['error']['message'] ?? $response->getReasonPhrase()),
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return null;
    }
}
