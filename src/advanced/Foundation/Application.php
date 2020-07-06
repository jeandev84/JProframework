<?php
namespace Jan\Foundation;


use Closure;
use Exception;
use Jan\Component\DI\Container;
use Jan\Component\DI\Exceptions\ResolverDependencyException;
use Jan\Component\Http\Contracts\RequestInterface;
use Jan\Component\Http\Contracts\ResponseInterface;
use Jan\Component\Routing\Exception\RouterException;
use Jan\Component\Routing\Route;
use Jan\Foundation\Exceptions\NotFoundHttpException;
use ReflectionException;


/**
 * Class Application
 * @package Jan\Foundation
 *
 * Application  :  JFramework
 * Author       :  Jean-Claude <jeanyao@mail.com>
*/
class Application extends Container
{

    /**
     * The Jan framework version.
     */
    const VERSION = '1.0.0';


    /**
     * The base path for Jan installation
     *
     * @var string
     */
    protected $basePath;



    /** @var array  */
    protected $namespaces = [];



    /**
     * Create a new application instance.
     *
     * Application constructor.
     * @param string $basePath
     * @return void
     * @throws ReflectionException
    */
    public function __construct(string $basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->loadCoreAliases();
        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        // $this->registerCoreContainerAliases();
    }



    /**
     * Get the version number of application.
     *
     * @return string
    */
    public function version()
    {
        return self::VERSION;
    }


    /**
     * Set the base path for the application.
     *
     * @param string $basePath
     * @return $this
    */
    public function setBasePath(string $basePath)
    {
        if ($basePath) {
            $this->basePath = rtrim($basePath, '\/');
        }

        $this->bindPathsInContainer();
        return $this;
    }


    /**
     * Bind all of the application paths in the container
     *
     * @return void
    */
    protected function bindPathsInContainer()
    {
        $this->bind('base.path', $this->basePath);
    }


    /**
     * Register the basic info the container.
     *
     * @return void
    */
    protected function registerBaseBindings()
    {
         $this->instance('app', $this);
         $this->instance(Container::class, $this);
    }


    /**
     * Register all of the base service providers
     *
     * @return void
     * @throws ReflectionException
    */
    protected function registerBaseServiceProviders()
    {
         // add only providers without runServiceProvider
         // get all providers and run them
         $this->addServiceProviders([
             \Jan\Foundation\Providers\FileSystemServiceProvider::class,
             \Jan\Foundation\Providers\AppServiceProvider::class,
             \Jan\Foundation\Providers\RouteServiceProvider::class,
             \Jan\Foundation\Providers\ViewServiceProvider::class
         ]);
    }


    /**
     * Register the core class aliases int the container
     *
     * @return void
    */
    protected function registerCoreContainerAliases()
    {
        if($aliases = $this->coreAliases())
        {
            foreach ($aliases as $alias => $original)
            {
                $this->setAlias($alias, $original);
            }
        }
    }


    public function loadCoreAliases()
    {
          // Autoloading
    }

    /**
     * @return string[]
    */
    private function coreAliases()
    {
        /*
        return [
          'Jan\Component\DI\Container' => 'Jan\Component\DI\Contracts\ContainerInterface',
          'Jan\Component\Http\Request' => 'Jan\Component\Http\Contracts\RequestInterface',
          'Jan\Component\Http\Response' => 'Jan\Component\Http\Contracts\ResponseInterface',
        ];
        */
    }
}