<?php
namespace Jan\Foundation\Console;


use Jan\Component\Console\Contracts\InputInterface;
use Jan\Component\Console\Contracts\OutputInterface;
use Jan\Component\DI\Contracts\ContainerInterface;
use Jan\Contracts\Console\Kernel as ConsoleKernelContract;



/**
 * Class Kernel
 * @package Jan\Foundation\Console
*/
class Kernel implements ConsoleKernelContract
{

    /**
     * @var ContainerInterface
    */
    protected $container;


    /**
     * Default commands
     *
     * @var array
    */
    protected $commands = [];



    /**
     * Kernel constructor.
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
         $this->container = $container;
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     * @throws \Exception
    */
    public function handle(InputInterface $input, OutputInterface $output)
    {
            //
    }


    /**
     * @param InputInterface $input
     * @param $status
     * @return mixed
     */
    public function terminate(InputInterface $input, $status)
    {
         //
    }

}