<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{InputInterface, ArrayInput};
use Symfony\Component\Console\Output\{OutputInterface, BufferedOutput};
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use \Exception;

#[AsCommand(
    name: 'doctrine:database:init-test',
    description: 'Initializes or resets test database to initial state.',
    aliases: ['doctrine:database:initialize-test'],
)]
class InitializeTestDatabaseCommand extends Command
{
    public function __construct(private readonly KernelInterface $kernel)
    {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $application = self::getApplication();

        $application->find('doctrine:database:drop')
            ->run(new ArrayInput([
                '--env' => 'test',
                '--force' => true,
            ]), $output);

        $application->find('doctrine:database:create')
            ->run(new ArrayInput([
                '--env' => 'test',
            ]), $output);

        $application->find('doctrine:migrations:migrate')
            ->run(new ArrayInput([
                '--env' => 'test',
            ]), $output);

        $application->find('doctrine:fixtures:load')
            ->run(new ArrayInput([
                '--env' => 'test',
                '--group' => 'group',
            ]), $output);

        return Command::SUCCESS;
    }
}
