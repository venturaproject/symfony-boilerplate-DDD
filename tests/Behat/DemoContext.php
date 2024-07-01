<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

class DemoContext extends MinkContext implements Context
{
    /**
     * @Given I visit :path
     */
    public function iVisitPath($path)
    {
        $this->visit($path);
        $statusCode = $this->getSession()->getStatusCode();
        if ($statusCode !== 200) {
            throw new \Exception(sprintf('Expected status code 200, but got %d', $statusCode));
        }
    }

    /**
     * @Then I should see at least :count :element
     */
    public function iShouldSeeAtLeastCountElements($count, $element)
    {
        $elements = $this->getSession()->getPage()->findAll('css', '.' . $element);
        if (count($elements) < $count) {
            // Imprimir el HTML de la página para depuración
            echo $this->getSession()->getPage()->getContent();
            throw new \Exception(sprintf('Expected at least %d "%s" elements, but found %d', $count, $element, count($elements)));
        }
    }

    /**
     * @Then I should see the text :text
     */
    public function iShouldSeeTheText($text)
    {
        $pageContent = $this->getSession()->getPage()->getText();
        if (strpos($pageContent, $text) === false) {
            // Imprimir el HTML de la página para depuración
            echo $this->getSession()->getPage()->getContent();
            throw new \Exception(sprintf('The text "%s" was not found on the page.', $text));
        }
    }
}
