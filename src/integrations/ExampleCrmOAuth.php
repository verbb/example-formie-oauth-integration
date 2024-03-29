<?php
namespace modules\formieoauth\integrations;

use modules\formieoauth\auth\MyProvider;

use verbb\formie\base\Crm;
use verbb\formie\elements\Form;
use verbb\formie\elements\Submission;
use verbb\formie\models\IntegrationCollection;
use verbb\formie\models\IntegrationField;
use verbb\formie\models\IntegrationFormSettings;

use Craft;

use verbb\auth\base\OAuthProviderInterface;

class ExampleCrmOAuth extends Crm implements OAuthProviderInterface
{
    // Static Methods
    // =========================================================================

    public static function supportsOAuthConnection(): bool
    {
        return true;
    }

    public static function getOAuthProviderClass(): string
    {
        return MyProvider::class;
    }

    public static function displayName(): string
    {
        return Craft::t('formie', 'Example CRM OAuth');
    }


    // Public Methods
    // =========================================================================

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
