<?php

declare(strict_types=1);

/*
 * This file is part of TinymcePluginFontawesome.
 * Peter Broghammer in Anlehnung an Icon Picker Bundle von Marko Cupic
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 * @license LGPL-3.0+
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/fontawesome-icon-picker-bundle
 */

namespace Pbdkn\SolarW5Bundle\DependencyInjection;

use Pbdkn\ContaoTinymcePluginFontawesomeBundle\Config;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const ROOT_KEY = 'pbdkn_contao_solar_w5';       
    // also nun zum Mitschreiben. Dieser String wird auch von Contao verwendet.
    // es ist der name der Klasse in PbdknContaoTinymcePluginFontawesomeBundle und damit der Name des Bundles.
    // Symfony mach daraus nach CamelCaseAuswertung pbdkn_contao_tinymce_plugin_fontawesome_bundle
    // in getname der Extension kann das bundle weggelassen werden, aber sonst muss es so sein
    // pbdkn_contao_tinymce_plugin_fontawesome
    // es ist wohl deshalb so gemacht damit im Treebuilder fuer die Konfiguration dieser String auch verwendet werden kann
    // s. getName in PBDContaoTinyPluginFontawesomeExtension
    // Metadaten habe ich mittels download von https://fontawesome.com/doies werden in der function movePluginFiles nach 
    // assets/font-awesome/webfonts/ kopiert. Sie müssen irgendwo liegen, damit man von der Seite aus darauf zugreifen kann.
    // eine andere Möglickeit wäre vielleicht sie unter public abzulegen.
    
    // Config::FONTAWESOME_VERSION wird in src/config.php gesetzt
    public function getConfigTreeBuilder(): TreeBuilder
    {
//echo "PBD Configuration getConfigTreeBuilder rootKey " . self::ROOT_KEY."\n";
//echo "PBD Configuration getConfigTreeBuilder defaultPath ".'https://use.fontawesome.com/releases/v'.\Pbdkn\ContaoTinymcePluginFontawesomeBundle\Config::FONTAWESOME_VERSION.'/js/all.js'."\n";
//echo "PBD Configuration getConfigTreeBuilder defaultPath ".'https://use.fontawesome.com/releases/v'.Config::FONTAWESOME_VERSION.'/js/all.js'."\n";
     //               ->defaultValue('https://use.fontawesome.com/releases/v'.Config::FONTAWESOME_VERSION.'/js/all.js')
        $treeBuilder = new TreeBuilder(self::ROOT_KEY);
        // siehe https://symfony.com/doc/current/components/config/definition.html
        $treeBuilder->getRootNode()
           ->children()
                ->scalarNode('default_template')
                    ->defaultValue('@Pbdkn/SolarW5Bundle/default_template.html.twig')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
