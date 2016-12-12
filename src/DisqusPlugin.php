<?php namespace Samharrison\DisqusPlugin;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Twig_Environment;
use Twig_NodeVisitorInterface;

class DisqusPlugin extends Plugin
{

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'disqus',
                function ($identifier = null, $title = null) {
                    return view(
                        "samharrison.plugin.disqus::comments",
                        [
                            'identifier'    => $identifier,
                            'title'         => $title,
                            'script_only'   => false,
                        ]
                    );
                }
            ),
            new \Twig_SimpleFunction(
                'disqus_script',
                function ($identifier = null, $title = null) {
                    return view(
                        'samharrison.plugin.disqus::comments',
                        [
                            'identifier'    => $identifier,
                            'title'         => $title,
                            'script_only'   => true
                        ]
                    );
                }
            )
        ];
    }

}
