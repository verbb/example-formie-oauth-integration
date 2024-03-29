<?php
namespace modules\formieoauth\integrations;

use verbb\formie\base\Crm;
use verbb\formie\elements\Form;
use verbb\formie\elements\Submission;
use verbb\formie\models\IntegrationCollection;
use verbb\formie\models\IntegrationField;
use verbb\formie\models\IntegrationFormSettings;

use Craft;

use verbb\auth\base\OAuthProviderInterface;
use verbb\auth\providers\Generic as GenericProvider;

class ExampleCrmOAuthAlt extends Crm implements OAuthProviderInterface
{
    // Static Methods
    // =========================================================================

    public static function supportsOAuthConnection(): bool
    {
        return true;
    }

    public static function getOAuthProviderClass(): string
    {
        return GenericProvider::class;
    }

    public static function displayName(): string
    {
        return Craft::t('formie', 'Example CRM OAuth Alt');
    }


    // Public Methods
    // =========================================================================

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

    public function getIconUrl(): string
    {
        return Craft::$app->getAssetManager()->getPublishedUrl("@modules/formieoauth/resources/icon.svg", true);
    }

    public function getDescription(): string
    {
        return Craft::t('formie', 'This is an example crm integration.');
    }

    public function getSettingsHtml(): string
    {
        return Craft::$app->getView()->renderTemplate('formie-oauth/example-oauth/_plugin-settings', [
            'integration' => $this,
        ]);
    }

    public function getFormSettingsHtml($form): string
    {
        return Craft::$app->getView()->renderTemplate('formie-oauth/example-oauth/_form-settings', [
            'integration' => $this,
            'form' => $form,
        ]);
    }

    public function fetchFormSettings()
    {
        $settings = [];

        // ...

        return new IntegrationFormSettings($settings);
    }

    public function sendPayload(Submission $submission): bool
    {
        // ...

        return true;
    }
}
