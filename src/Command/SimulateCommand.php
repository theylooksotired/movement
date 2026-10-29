<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Services\Simulate;

/**
 * SimulateCommand executes a series of movement commands for then token.
 * This is just an input console command to run the simulation.
 * The whole magic is in the Simulate service.
 */
#[AsCommand(name: 'simulate')]
class SimulateCommand extends Command
{

    /**
     * Configuration of the command.
     */
    protected function configure(): void
    {
        $this
            ->setName('simulate')
            ->addArgument('commands', InputArgument::IS_ARRAY, 'List of numeric commands');
    }

    /**
     * Executes the command.
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        
        // Read the stdin or the arguments of the commant
        $stdin = '';
        $input = (!stream_isatty(STDIN)) ? stream_get_contents(STDIN) : implode(' ', $input->getArgument('commands'));
        
        // Create an array, the elements should be separated by espaces or commas
        $input = str_replace("\n", " ", str_replace(',', ' ', $input));
        $commands = explode(" ", $input);
        
        // Delete any empty elements but keep the keys
        $cleanCommands = [];
        foreach ($commands as $command) {
            if (trim($command) !== '') $cleanCommands[] = $command;
        }

        // Run the simulation using the Simulate service
        $result = Simulate::run($cleanCommands);
        $output->write(implode(",", $result));

        return Command::SUCCESS;
    }

}