# Example Formie OAuth Integration
This is an example [Craft CMS](https://www.craftcms.com/) module for [Formie](https://github.com/verbb/formie) that shows how using the [Auth module](https://github.com/verbb/auth) can be used to connect with OAuth-based providers.

> [!NOTE]
> New to modules? Read our [blog post](https://verbb.io/blog/everything-you-need-to-know-about-modules) on getting started.

The following guide uses [Zoho CRM](https://www.zoho.com/en-au/crm/) to provider a real-world and working example. 

We cover two approaches.

## Using a `GenericProvider`
The simplest approach is to use the `verbb\auth\providers\Generic` class for your integration. This takes care of many provider use-cases, where you just want to provide some endpoint URLs and maybe some scopes.

```php
<?php
namespace modules\formieoauth\integrations;

use verbb\formie\base\Crm;

use verbb\auth\base\OAuthProviderInterface;
use verbb\auth\providers\Generic as GenericProvider;

class ExampleCrmOAuthAlt extends Crm implements OAuthProviderInterface
{
    public static function getOAuthProviderClass(): string
    {
        return GenericProvider::class;
    }

    public function getOAuthProviderConfig(): array
    {
        $config = parent::getOAuthProviderConfig();
        $config['urlAuthorize'] = 'https://accounts.zoho.com/oauth/v2/auth';
        $config['urlAccessToken'] = 'https://accounts.zoho.com/oauth/v2/token';
        $config['urlResourceOwnerDetails'] = 'https://accounts.zoho.com/oauth/user/info';
        $config['scopes'] = ['aaaserver.profile.READ'];
        $config['scopeSeparator'] = ' ';

        return $config;
    }
}
```

Here, we tell the Formie integration which [Auth](https://github.com/verbb/auth) provider to use. If there's already a supported provider there, you should use that!

Then, we use `getOAuthProviderConfig()` to provide any additional [`league/oauth2-client`](https://github.com/thephpleague/oauth2-client) settings for the provider.

## Custom Auth class
The more involved approach is to create your own [`league/oauth2-client`](https://github.com/thephpleague/oauth2-client) client, where you have total control over the logic of authentication.
