<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTENSIONS = '.{php,xml,yaml,yml}';

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir() . '/var/log';
    }

    /**
     * Returns an array of bundles to register.
     *
     * @return iterable|BundleInterface[] An iterable of bundle instances
     */
    public function registerBundles()
    {
        /** @noinspection PhpIncludeInspection */
        $contents = require $this->getProjectDir() . '/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $confDir = $this->getProjectDir() . '/config';

        $routes->import($confDir . '/{routes}/*' . self::CONFIG_EXTENSIONS, '/', 'glob');
        $routes->import($confDir . '/{routes}/' . $this->environment . '/**/*' . self::CONFIG_EXTENSIONS, '/', 'glob');
        $routes->import($confDir . '/{routes}' . self::CONFIG_EXTENSIONS, '/', 'glob');
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir() . '/config';

        $loader->load($confDir . '/{packages}/*' . self::CONFIG_EXTENSIONS, 'glob');
        $loader->load($confDir . '/{packages}/' . $this->environment . '/**/*' . self::CONFIG_EXTENSIONS, 'glob');
        $loader->load($confDir . '/{services}' . self::CONFIG_EXTENSIONS, 'glob');
        $loader->load($confDir . '/{services}_' . $this->environment . self::CONFIG_EXTENSIONS, 'glob');
    }
}
