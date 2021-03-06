<?php

namespace Doctrine\Bundle\MigrationsBundle\Tests\DependencyInjection;

use Doctrine\Bundle\MigrationsBundle\Command\DoctrineCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use PHPUnit\Framework\TestCase;

class DoctrineCommandTest extends TestCase
{
    public function testConfigureMigrations()
    {
        $configurationMock = $this->getMockBuilder('Doctrine\DBAL\Migrations\Configuration\Configuration')
            ->disableOriginalConstructor()
            ->getMock();

        $configurationMock->method('getMigrations')
            ->willReturn(array());

        DoctrineCommand::configureMigrations($this->getContainer(), $configurationMock);
    }

    private function getContainer()
    {
        return new ContainerBuilder(new ParameterBag(array(
            'doctrine_migrations.dir_name' => __DIR__.'/../../',
            'doctrine_migrations.namespace' => 'test',
            'doctrine_migrations.name' => 'test',
            'doctrine_migrations.table_name' => 'test',
            'doctrine_migrations.organize_migrations' => Configuration::VERSIONS_ORGANIZATION_BY_YEAR,
            'doctrine_migrations.custom_template' => null,
        )));
    }
}
