<?php

class ExampleTest extends TestCase
{
    /**
     * The application should boot into the testing environment.
     */
    public function testApplicationBootsInTestingEnvironment(): void
    {
        $this->assertSame('testing', $this->app->environment());
    }
}
