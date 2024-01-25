<?php

declare(strict_types=1);

/*
 * This file is part of Gallery Creator Bundle.
 *
 * (c) Marko Cupic 2022 <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/gallery-creator-bundle
 */

namespace Pbdkn\SolarW5Bundle\Controller\ContentElement;

use Contao\CoreBundle\InsertTag\InsertTagParser;
use Symfony\Contracts\Translation\TranslatorInterface;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\String\HtmlDecoder;
use Doctrine\DBAL\Connection;
use Pbdkn\SolarW5Bundle\Util\CgiUtil;
use Pbdkn\SolarW5Bundle\Util\SolarUtil;

final class DependencyAggregate
{
    public Connection $connection;
    public ScopeMatcher $scopeMatcher;
    public ResponseContextAccessor $responseContextAccessor;
    public InsertTagParser $insertTagParser;
    public HtmlDecoder $htmlDecoder;
    public TranslatorInterface $translator;
    public CgiUtil $cgiUtil;
    public SolarUtil $SolarUtil;
 
    public function __construct(
      Connection $connection, 
      ScopeMatcher $scopeMatcher, 
      ResponseContextAccessor $responseContextAccessor, 
      InsertTagParser $insertTagParser, 
      HtmlDecoder $htmlDecoder,
      TranslatorInterface $translator,
      CgiUtil $cgiUtil,
      SolarUtil $SolarUtil
      )
    {
        $this->cgiUtil = $cgiUtil;
        $this->SolarUtil = $SolarUtil;
        $this->connection = $connection;
        $this->scopeMatcher = $scopeMatcher;
        $this->responseContextAccessor = $responseContextAccessor;
        $this->insertTagParser = $insertTagParser;
        $this->htmlDecoder = $htmlDecoder;
        $this->translator = $translator;
    }
}
