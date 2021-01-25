<?php

namespace App\Module\User\Application\Command;

use App\Module\User\Application\Facade\UserFacade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{
    protected static $defaultName = 'app:user:add';

    protected function configure()
    {
        $this
            ->setDescription('Adds a new user to the system')
            ->addArgument('name', InputArgument::REQUIRED, 'New user name. It must be unique.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Adding user...');
        $user = UserFacade::instance()->addUser($input->getArgument('name'));
        $output->writeln("Added user with id: {$user->id()} .");

        return Command::SUCCESS;
    }
}
