<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'simulate')]
class SimulateCommand extends Command
{

    protected function configure(): void
    {
        $this
            ->setName('simulate')
            ->addArgument(
                'commands',
                InputArgument::IS_ARRAY,
                'List of numeric commands'
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        
        // Read the stdin or the arguments of the commant
        $stdin = '';
        $input = (!stream_isatty(STDIN)) ? stream_get_contents(STDIN) : implode(' ', $input->getArgument('commands'));
        $input = str_replace("\n", " ", str_replace(',', ' ', $input));
        $commands = explode(" ", $input);

        // Create a board with the first two values
        $board = [];
        $boardWidth = intval($commands[0]);
        $boardHeight = intval($commands[1]);
        for ($col = 0; $col < $boardWidth; $col++) {
            for ($row = 0; $row < $boardHeight; $row++) {
                $board[$col][$row] = $col . ' - ' . $row;
            }
        }
        
        // Create a token, for the moment just an array
        $positionCol = intval($commands[2]);
        $positionRow = intval($commands[3]);
        $token = ['col' => $positionCol, 'row' => $positionRow, 'direction' => 'N'];

        // Get the rest of the movements
        $movements = array_slice($commands, 4);

        // Parse each movement
        foreach ($movements as $movement) {
            dump('--'  . $movement . '--');
            switch ($movement) {
                case 0:
                    dd('--END--', $token);
                    break;
                case 1:
                    if ($token['direction'] === 'N') {
                        $token['row'] = $token['row'] - 1;
                    }
                    if ($token['direction'] === 'E') {
                        $token['col'] = $token['col'] + 1;
                    }
                    if ($token['direction'] === 'S') {
                        $token['row'] = $token['row'] + 1;
                    }
                    if ($token['direction'] === 'W') {
                        $token['col'] = $token['col'] - 1;
                    }
                    dump($token);
                break;
                case 2:
                    if ($token['direction'] === 'N') {
                        $token['row'] = $token['row'] + 1;
                    }
                    if ($token['direction'] === 'E') {
                        $token['col'] = $token['col'] - 1;
                    }
                    if ($token['direction'] === 'S') {
                        $token['row'] = $token['row'] - 1;
                    }
                    if ($token['direction'] === 'W') {
                        $token['col'] = $token['col'] + 1;
                    }
                    dump($token);
                break;
                case 3:
                    $conversion = [
                        'N' => 'E',
                        'E' => 'S',
                        'S' => 'W',
                        'W' => 'N'];
                    $token['direction'] = $conversion[$token['direction']];
                    dump($token);
                break;
                case 4:
                    $conversion = [
                        'N' => 'W',
                        'W' => 'S',
                        'S' => 'E',
                        'E' => 'N'];
                    $token['direction'] = $conversion[$token['direction']];
                    dump($token);
                break;
            }
        }
        
        // For the moment dump the results
        // so we get a proper idea that the algo is working
        dd($board, $token, $board[$token["col"]][$token["row"]]);

        return Command::SUCCESS;
    }

}