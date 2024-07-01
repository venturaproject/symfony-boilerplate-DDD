<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

class DemoContext implements Context
{
    private $minkContext;

    public function __construct(MinkContext $minkContext)
    {
        $this->minkContext = $minkContext;
    }

    /**
     * @Given I visit :path
     */
    public function iVisitPath($path)
    {
        $this->minkContext->visit($this->minkContext->locatePath($path));
    }

    /**
     * @Then I should see the text :text
     */
    public function iShouldSeeTheText($text)
    {
        $this->minkContext->assertPageContainsText($text);
    }

    /**
     * @Then I should see at least :count :element
     */
    public function iShouldSeeAtLeastCountElements($count, $element)
    {
        // Implementación para verificar la presencia de al menos ciertos elementos en la página
    }
}
