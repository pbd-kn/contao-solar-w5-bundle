<?php

declare(strict_types=1);


namespace Pbdkn\SolarW5Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


/* Da die Bundle Klasse "AjaxArticleBundle" lautet siehe ajaxAriticleBundle.php
 * muss die Dependency Injection Klasse "AjaxArticleExtension" lauten
 */
 
class SolarW5Extension extends Extension
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        //echo "PBD PBD dependencInjection SolarW5Bundle file SolarW5Extension load service";
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');
    }
}

