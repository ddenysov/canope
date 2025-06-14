<?php
declare(strict_types=1);

namespace Zinc\Core\Container\Symfony;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Zinc\Core\Command\Bridge\Symfony\MessengerCommandBus;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\Command\CommandHandlerInterface;
use Zinc\Core\DataStore\Bridge\PDO\PdoDataStore;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Event\Bridge\Symfony\MessengerEventBus;
use Zinc\Core\Event\EventBusInterface;
use Zinc\Core\Event\EventHandlerInterface;
use Zinc\Core\Integration\Bridge\InMemory\InMemoryMessagePublisher;
use Zinc\Core\Integration\MessagePublisherInterface;
use Zinc\Core\Messaging\Symfony\RoadRunner\RoadRunnerFactory;
use Zinc\Core\Query\Bridge\Symfony\MessengerQueryBus;
use Zinc\Core\Query\ListQuery;
use Zinc\Core\Query\MapQueryStringResolver;
use Zinc\Core\Query\QueryBusInterface;
use Zinc\Core\Query\QueryHandlerInterface;
use Zinc\Core\Validator\CommandValidatorInterface;
use Zinc\Core\Validator\Symfony\CommandValidator;

class SymfonyCoreBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(CommandHandlerInterface::class)
            ->addTag('messenger.message_handler');
        $container->registerForAutoconfiguration(EventHandlerInterface::class)
            ->addTag('messenger.message_handler');
        $container->registerForAutoconfiguration(QueryHandlerInterface::class)
            ->addTag('messenger.message_handler');


        $definition = (new Definition(RoadRunnerFactory::class))
            ->setAutowired(true)          // зависимости через автоворинг
            ->setPublic(false)            // наружу не светим
            ->addTag('messenger.transport_factory');

        $container->setDefinition(RoadRunnerFactory::class, $definition);
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()->set(MapQueryStringResolver::class)->tag('controller.argument_value_resolver', ['priority' => 50])->autowire();

        $container->services()->set(
            QueryBusInterface::class, MessengerQueryBus::class
        )->autowire();
        $container->services()->set(
            CommandBusInterface::class, MessengerCommandBus::class
        )->autowire();
        $container->services()->set(
            EventBusInterface::class, MessengerEventBus::class
        )->autowire();
        $container->services()->set(
            DataStoreInterface::class, PdoDataStore::class
        )->autowire()->public();
        $container->services()->set(
            MessagePublisherInterface::class, InMemoryMessagePublisher::class
        )->autowire()->public();
        $container->services()->set(
            CommandValidatorInterface::class, CommandValidator::class
        )->autowire()->public();

        $container->services()->alias('Psr\Log\LoggerInterface', 'monolog.logger')->public();
        $container->services()->set(ListQuery::class)->autowire()->public();
    }

    #[\Override] public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->extension('monolog', [
            'handlers' => [
                'file_log'       => [
                    'type'  => 'stream',
                    'path'  => '%kernel.logs_dir%/%kernel.environment%.log',
                    'level' => 'debug',
                ],
                'syslog_handler' => [
                    'type'  => 'syslog',
                    'level' => 'error',
                ],
            ],
        ]);
        $container->extension('framework', [
            'serializer' => true,
            'messenger'  => [
                'transports' => [
                    'rr' => 'rr://...',
                ],
            ],
            'validation' => [
                'enabled' => true,
                'mapping' => [
                    'paths' => [
                        '%kernel.project_dir%/config/validation',
                    ],
                ],
            ],
        ]);
    }


}