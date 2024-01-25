<?php

declare(strict_types=1);


namespace Pbdkn\SolarW5Bundle\Controller\ContentElement\FE;

use Contao\Config;
use Contao\ContentModel;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\String\HtmlDecoder;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\Environment;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\Template;
use Contao\FrontendTemplate;
use Contao\Input;
use Contao\PageModel;
use Contao\Pagination;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Exception as DoctrineDBALDriverException;
use Doctrine\DBAL\Exception as DoctrineDBALException;
use Pbdkn\SolarW5Bundle\Util\CgiUtil;
use FOS\HttpCacheBundle\Http\SymfonyResponseTagger;
use Twig\Environment as TwigEnvironment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Pbdkn\SolarW5Bundle\Controller\ContentElement\AbstractSolarController;
use Pbdkn\SolarW5Bundle\Controller\ContentElement\DependencyAggregate;

/**
 * Class SolarW5BundleController
 *
 * @ContentElement(FeSolarTestController::TYPE, category="Solar-FE")
 */
//#[AsContentElement(category: 'gallery_creator_elements')]
//#[AsContentElement(category: 'fe_solar_test_elements')]
#[AsContentElement(category: 'fe_solar_test_elements', template: 'content_element/Solartest')]
class FeSolarTestController extends AbstractSolarController
{
    public const TYPE = 'Solartest';
    protected ContaoFramework $framework;
    protected Connection $connection;
    protected ?SymfonyResponseTagger $responseTagger;
    protected ?string $viewMode = null;
    protected ?ContentModel $model;
    protected ?PageModel $pageModel;
    protected TwigEnvironment $twig;

    // Adapters
    protected Adapter $config;
    protected Adapter $environment;
    protected Adapter $input;
    protected Adapter $stringUtil;
    
    private $Spiele = array();

    public function __construct(
      DependencyAggregate $dependencyAggregate, 
      ContaoFramework $framework, 
      TwigEnvironment $twig, 
      HtmlDecoder $htmlDecoder, 
      ?SymfonyResponseTagger $responseTagger)    
    {
        //\System::log('PBD Spielecontroller ', __METHOD__, TL_GENERAL);

        parent::__construct($dependencyAggregate);  // standard Klassen plus akt. Wettbewerb lesen
                                                    // AbstractSolarController übernimmt sie in die akt Klasse
//        \System::log('PBD Spielecontroller nach dependencyAggregate', __METHOD__, TL_GENERAL);
        $this->framework = $framework;
        $this->twig = $twig;
        $this->htmlDecoder = $htmlDecoder;
        $this->responseTagger = $responseTagger;         //  FriendsOfSymfony/FOSHttpCacheBundle https://foshttpcachebundle.readthedocs.io/en/latest/ 

        // Adapters
        $this->config = $this->framework->getAdapter(Config::class);
        $this->environment = $this->framework->getAdapter(Environment::class);
        $this->input = $this->framework->getAdapter(Input::class);
        $this->stringUtil = $this->framework->getAdapter(StringUtil::class);

    }
    public function __invoke(Request $request, ContentModel $model, string $section, array $classes = null, PageModel $pageModel = null): Response
    {
        // Do not parse the content element in the backend
        if ($this->scopeMatcher->isBackendRequest($request)) {   // wird im Backend beim ce angeeigt
            return new Response( 'PBD Backend Response');
                
            return new Response(
                $this->twig->render('@Solartest/Backend/backend_element_view.html.twig',  
                ['Wettbewerb'=>'Solar Test'])
            );
        }

        $this->model = $model;
        $this->pageModel = $pageModel;

        // Set the item from the auto_item parameter and remove auto_item from unused route parameters
        if (isset($_GET['auto_item']) && '' !== $_GET['auto_item']) {
            $this->input->setGet('auto_item', $_GET['auto_item']);
        }
        return parent::__invoke($request, $this->model, $section, $classes);
    }
    
    /**
     * Generate the content element
     * https://github.com/markocupic/gallery-creator-bundle/tree/2.x
     * https://github.com/markocupic/gallery-creator-bundle/blob/2.x/src/Controller/ContentElement/GalleryCreatorController.php
     */
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $nm = $template->getName();
        $data=$template->getData();
        $datav="";
        //foreach ($data as $k=>$v) $datav.="data[$k]: $v <br>";
        foreach ($data as $k=>$v) $datav.="data[$k]: <br>";
        return new Response( 'PBD Response von FeSolarTestController<br>name: '.$nm.' datalen: '.count($data).'<br>datav '.$datav);
        return $template->getResponse();

    }
}
