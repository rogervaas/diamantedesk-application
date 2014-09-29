<?php
/*
 * Copyright (c) 2014 Eltrino LLC (http://eltrino.com)
 *
 * Licensed under the Open Software License (OSL 3.0).
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://opensource.org/licenses/osl-3.0.php
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@eltrino.com so we can send you a copy immediately.
 */
namespace Eltrino\DiamanteDeskBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EltrinoDiamanteDeskBundle extends Bundle
{
    public function boot()
    {
        if (!Type::hasType('branch_logo')) {
            Type::addType('branch_logo', 'Eltrino\DiamanteDeskBundle\Infrastructure\Persistence\Doctrine\DBAL\Types\BranchLogoType');
        }
        if (!Type::hasType('priority')) {
            Type::addType(
                'priority',
                'Eltrino\DiamanteDeskBundle\Infrastructure\Persistence\Doctrine\DBAL\Types\TicketPriorityType'
            );
        }
        if (!Type::hasType('file')) {
            Type::addType(
                'file',
                'Eltrino\DiamanteDeskBundle\Infrastructure\Persistence\Doctrine\DBAL\Types\AttachmentFileType'
            );
        }
        if (!Type::hasType('status')) {
            Type::addType(
                'status',
                'Eltrino\DiamanteDeskBundle\Infrastructure\Persistence\Doctrine\DBAL\Types\TicketStatusType'
            );
        }
        if (!Type::hasType('source')) {
            Type::addType(
                'source',
                'Eltrino\DiamanteDeskBundle\Infrastructure\Persistence\Doctrine\DBAL\Types\TicketSourceType'
            );
        }

        $em = $this->container->get('doctrine.orm.default_entity_manager');
        $conn = $em->getConnection();

        $conn->getDatabasePlatform()
            ->registerDoctrineTypeMapping('FILE', 'string');
    }
}
