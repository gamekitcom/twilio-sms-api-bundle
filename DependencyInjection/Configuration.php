<?php

namespace OCSoftwarePL\TwilioSmsApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ocs_twilio_sms_api');

        $rootNode->children()
            ->scalarNode('sender')->isRequired()->end()
            ->scalarNode('account')->isRequired()->end()
            ->scalarNode('token')->isRequired()->end()
            ->scalarNode('callback_url')->defaultNull()->end()
            ->end();
        return $treeBuilder;
    }
}
