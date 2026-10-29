<?php
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * Test the simulate command.
 */
class SimulateCommandTest extends KernelTestCase
{

    /**
     * Test the exercise's original input.
     */
    public function testOriginal(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [4, 4, 2, 2, 1, 4, 1, 3, 2, 3, 2, 4, 1, 0]
        ]);
        $applicationTester->assertCommandIsSuccessful();
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('0,1', $output);
    }

    /**
     * If we just send the header we should just get the position of the token if it's valid.
     */
    public function testEmptyCommands(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        // Assert a valid position
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [6, 6, 1, 2]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('1,2', $output);
        // Assert an invalid position
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [6, 3, 0, -4]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('-1,-1', $output);
    }

    /**
     * If the header is invalid (less than 4 commands)
     * it should return an error.
     */
    public function testInvalidHeader(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [1, 2, 3]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('-1,-1', $output);
    }

    /**
     * If the token moves to an invalid position,
     * it should return an error.
     */
    public function testInvalidPositionAfterMove(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [4, 4, 0, 0, 1]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('-1,-1', $output);
    }

    /**
     * Test that a token moves forward.
     */
    public function testMoveForward(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [5, 5, 2, 2, 1]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('2,1', $output);
    }

    /**
     * Test that a token moves backward.
     */
    public function testMoveBackward(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [5, 5, 2, 2, 2]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('2,3', $output);
    }

    /**
     * Test that a token moves right.
     * (Meaning rotating clockwise and advancing one)
     */
    public function testMoveRight(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [5, 5, 2, 2, 3, 1]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('3,2', $output);
    }

    /**
     * Test that a token moves left.
     * (Meaning rotating counterclockwise and advancing one)
     */
    public function testMoveLeft(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [5, 5, 2, 2, 4, 1]
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('1,2', $output);
    }

    /**
     * Test that we insert non numeric commands.
     */
    public function testNonNumericCommands(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $applicationTester = new ApplicationTester($application);
        $applicationTester->run([
            'command' => 'simulate',
            'commands' => [5, 5, 2, 2, 'a', 'b', 'c']
        ]);
        $output = $applicationTester->getDisplay();
        $this->assertStringContainsString('2,2', $output);
    }


}