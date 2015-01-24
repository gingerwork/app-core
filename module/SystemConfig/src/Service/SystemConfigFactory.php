<?php
/*
 * This file is part of the Ginger Workflow Framework.
 * (c) Alexander Miertsch <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 08.01.15 - 23:50
 */

namespace SystemConfig\Service;

use Application\SharedKernel\ConfigLocation;
use SystemConfig\Definition;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SystemConfigFactory
 *
 * @package SystemConfig\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class SystemConfigFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        return \SystemConfig\Model\GingerConfig::asProjectionFrom(ConfigLocation::fromPath($config['system_config_dir']));
    }
}
 