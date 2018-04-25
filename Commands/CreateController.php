<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateController extends Command
{
    protected $commandName = 'app:createcontroller';
    protected $commandDescription = "Create a New Controller";
    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "The name of the new controller";
    protected $commandOptionDescription = 'If set, it will greet in uppercase letters';
    protected $controllersPath = 'controllers/';
    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgumentName);
        if(file_exists($this->controllersPath.$name.'.php')){
            $output->writeln('Controller Already Exist!');
            exit();
        }else{
            file_put_contents('controllers/'.$name.'.php', "<?php\nclass ".ucfirst($name)." extends Controller {\n\n   function __construct() {\n       parent::__construct();\n   }\n\n   function index() {\n\n   }\n}");
            chmod ($this->controllersPath.$name.'.php', 0777);
            $output->writeln('Controller created with success');
            exit();
        }
    }
}