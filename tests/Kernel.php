<?php

namespace Eerison\PestPluginApiPlatform\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new ApiPlatformBundle(),
        ];
    }

    public function getCacheDir(): string
    {
        return __DIR__ . '/../var/cache/' . spl_object_hash($this);
    }

    public function configureContainer(ContainerConfigurator $container): void
    {
        // PHP equivalent of config/packages/framework.yaml
        $container->extension('framework', [
            'test' => true,
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('config/{routes}/*.yaml');
        $routes
            ->add('foo_response', '/foo/response/{code}')
            ->controller([$this, 'responseCode'])
        ;
    }

    public function responseCode(int $code): JsonResponse
    {
        return new JsonResponse([
            'number' => random_int(0, 100),
        ], $code);
    }
}
