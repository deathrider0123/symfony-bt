<?php
namespace App\Command;

use App\Service\Import;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:import';

    private $importer;

    public function __construct(Import $importer)
    {
        $this->importer = $importer;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Imports a file.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you import data file...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'File IMPORT',
            '============',
            '',
        ]);

        //execute import data
        $nbrImported = $this->importer->import();

        $output->writeln("number of imported products => : " . $nbrImported);

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        return 0;
    }

}