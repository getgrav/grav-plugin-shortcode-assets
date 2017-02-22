<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Uri;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class AssetsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('assets', function(ShortcodeInterface $sc) {

            $type = $sc->getParameter('type', $sc->getBbCode());

            $options = [];
            $optionals = ['priority', 'pipeline', 'media', 'loading', 'group'];

            foreach ($optionals as $option) {
                $value = $sc->getParameter($option);
                if (isset($value)) {
                    $options[$option] = $value;
                }
            }

            $content = trim(strip_tags($sc->getContent()));

            $data = explode("\n", $content);
            $page = $this->shortcode->getPage();

            if (in_array($type, ['css','js'])) {
                foreach ($data as $key => $value) {
                    if (!Uri::isValidUrl($value)) {
                        $path_parts = pathinfo($value);
                        if ($path_parts['dirname'] == '.') {
                            $asset_page = $page;
                        } else {
                            $asset_page = $this->grav['pages']->dispatch($path_parts['dirname'], true);
                        }

                        if ($asset_page) {
                            $path = str_replace(GRAV_ROOT, '', $asset_page->path());
                            $data[$key] =  $path . '/' . $path_parts['basename'];
                        }
                    }
                }
            }

            if ($type == 'css' || $type == 'js' || $type == null) {
                foreach ($data as $entry) {
                    $this->shortcode->addAssets($type, [$entry, $options]);
                }
            } elseif ($type == 'inlineCss' || $type == 'inlineJs') {
                $this->shortcode->addAssets($type,  $content);
            }
        });
    }
}