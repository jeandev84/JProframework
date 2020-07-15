<?php
namespace Jan\Foundation\Commands;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;



/**
 * Class ServerCommand
 * @package Jan\Foundation\Commands
*/
class ServerCommand extends Command
{

    /** @var string  */
    protected $name = 'server';


    /** @var string  */
    protected $description = 'Run server on the port 8000, http://localhost:8000/';


    /**
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     * @return mixed
    */
    public function execute(InputInterface $input, OutputInterface $output)
    {
         $output->writeln('Server run to address http://localhost:8000');
         $msg = shell_exec('php -S localhost:8000 -t public -d display_errors=1');
         $output->write($msg);
    }
}