<?php
namespace modules\formieoauth;

use modules\formieoauth\integrations\ExampleCrmOAuth;
use modules\formieoauth\integrations\ExampleCrmOAuthAlt;

use verbb\formie\events\RegisterIntegrationsEvent;
use verbb\formie\services\Integrations;

use yii\base\Event;

use verbb\base\base\Module;

class FormieOAuth extends Module
{
    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        Event::on(Integrations::class, Integrations::EVENT_REGISTER_INTEGRATIONS, function(RegisterIntegrationsEvent $event) {
            $event->crm[] = ExampleCrmOAuth::class;
            $event->crm[] = ExampleCrmOAuthAlt::class;
        });
    }
    
}

