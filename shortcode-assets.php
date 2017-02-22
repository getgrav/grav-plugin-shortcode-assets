<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class ShortcodeAssetsPlugin
 * @package Grav\Plugin
 */
class ShortcodeAssetsPlugin extends Plugin
{
    protected $handlers;
    protected $assets;

    protected $child_states;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0]
        ];
    }


    /**
     * Initialize configuration
     *
     * @param Event $e
     */
    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }

}
