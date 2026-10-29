<?php
namespace App\Controller;

use App\Services\Simulate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * A very rustic page to test the simulation online.
 */
class DefaultController extends AbstractController
{

    // Everything will be done here, this is just a backend test
    // so we will not break our heads making a nice frontend.
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $commandInput = $request->request->get('commands', '');
        $results = [];

        if ($request->isMethod('POST')) {
            $inputLines = str_replace(["\r\n", "\r"], "\n", $commandInput);
            foreach (explode("\n", $inputLines) as $line) {
                $line = trim($line);
                if ($line == '') continue;
                $commands = explode(' ', str_replace([',', "\t"], ' ', $line));
                $results[] = [
                    'input' => $line,
                    'output' => Simulate::run($commands),
                ];
            }
        }

        $resultHtml = '';
        foreach ($results as $result) {
            $resultHtml .= '
                <p>
                    Input:  <code>' . $result['input'] . '</code><br/>
                    Output: <strong> ' . implode(",", $result['output']) . ' </strong>
                </p>';
        }

        $html = '
            <h1>Movement simulator</h1>
            <p>An example input is: <br/>
            4,4,2,2,1,4,1,3,2,3,2,4,1</p>
            <form method="post">
                <label>Enter one simulation per line:</label><br/>
                <textarea name="commands" rows="8"></textarea><br/>
                <button type="submit">Simulate</button>
            </form>
            <br/>
            <section aria-live="polite">
                <h2>Results</h2>
                ' . $resultHtml . '
            </section>';

        return new Response(
            $html,
            Response::HTTP_OK,
            ['Content-Type' => 'text/html; charset=UTF-8']
        );
    }
}