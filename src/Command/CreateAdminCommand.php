<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateAdminCommand extends Command
{
    private $adminManager;
    protected static $defaultName = 'app:admin-user';


    /**
     * CreateAdminCommand constructor.
     * @param UserRepository $adminManager
     */
    public function __construct(UserRepository $adminManager)
    {
        $this->adminManager = $adminManager;
        parent::__construct();
    }

    /**
     * Configurations
     * ->
     */
    protected function configure()
    {
        $this
            ->setDescription('Creates New Admin user')
            ->setHelp('This command allow you to create an Admin User from User Entity Repository')

            ->addArgument('login', InputArgument::REQUIRED, 'Admin name login')
            ->addArgument('password', InputArgument::REQUIRED, 'admin password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $login = $input->getArgument('login');
        $password = $input->getArgument('password');

        if (!empty($login) && !empty($password)) {
            $this->adminManager->createAdminFromCommand(
                $login,
                $password
            );
            $io->success(sprintf("Your login : ".
                $login.
                " & your password : "
                .$password));
            $io->note("pour remplacer l'utilisateur,  veuillez vous connecter à phpmyadmin et le supprimer puis rejouez la commande\"");

        }else{
            throw new \RuntimeException("<options=bold>you password or your login is empty</>");
        }
    }
}
