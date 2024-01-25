<?php
// SolarRequestClass.php
// solar ajax request class liefert gerenderte Teile als json zurueck
// 'data' => $html,  gerendete Info
// 'debug'=>$debug   evtl. debuginfo
declare(strict_types=1);

namespace Pbdkn\SolarW5Bundle\Controller\Ajax;

use Contao\ContentModel;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Contao\FilesModel;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Exception as DoctrineDBALDriverException;
use Doctrine\DBAL\Exception as DoctrineDBALException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Pbdkn\SolarW5Bundle\Util\CgiUtil;
use Pbdkn\SolarW5Bundle\Util\SolarUtil;
use Pbdkn\SolarW5Bundle\Controller\ContentElement\DependencyAggregate;
//include_once(__DIR__.'../../../Resources/contao/phpincludes/verwaltung/cgi.php');


class SolarRequestClass extends AbstractController
{
    private ContaoFramework $framework;
    private Connection $connection; 
    private InsertTagParser $insertTagParser; 
    private TranslatorInterface $translator;
    private CgiUtil $cgiUtil; 
    private SolarUtil $solarUtil; 
    protected $aktWettbewerb=array('aktWettbewerb'=>'','aktAnzgruppen'=>-1,'aktDGruppe'=>'','aktStartdatum'=>'','aktEndedatum'=>'');

        
    public function __construct(
      ContaoFramework $framework,
      Connection $connection,
      InsertTagParser $insertTagParser,
      TranslatorInterface $translator,
      CgiUtil $cgiUtil,
      SolarUtil $solarUtil)
    {
        $this->framework = $framework;
        $this->connection = $connection;
        $this->cgiUtil=$cgiUtil;
        $this->solarUtil=$solarUtil;
        $this->insertTagParser=$insertTagParser; 
        $this->translator=$translator;
                // akt Wettbewerb lesen.
/*
        $stmt = $this->connection->executeQuery("SELECT * from hy_config WHERE Name='Wettbewerb' AND Aktuell = 1 LIMIT 1");
        $row = $stmt->fetchAssociative();
        $this->aktWettbewerb['id']=$row['ID'];
        $this->aktWettbewerb['aktuell']=$row['Aktuell'];
        $this->aktWettbewerb['aktWettbewerb']=$row['Value1'];
        $this->aktWettbewerb['aktAnzgruppen']=$row['Value2'];
        $this->aktWettbewerb['aktDGruppe']=$row['Value3'];
        $this->aktWettbewerb['aktStartdatum']=$row['Value4'];
        $this->aktWettbewerb['aktEndedatum']=$row['Value5'];
*/        
    }
//    /**
//     * @throws \Exception
//     *
//     * @Route("/solar/anzeigewettbewerb/{aktion}/{ID}", 
//     * name="SolarRequestClass::class\anzeigewettbewerb", 
//     * defaults={"_scope" = "frontend"})
//     */

   
}