<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DriverCommand;
use Facebook\WebDriver\WebDriverBy;


require_once 'vendor/autoload.php';
require 'vendor/autoload.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */

    /**
    * @var \webDriver
    */
    private $driver;

    public function __construct()
    {
    }

    /**
     * @Given I am on the home page
     */
    public function iAmOnTheHomePage()
    {
      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('http://www.mequilibrium.com');
    }

    /**
     * @When I click the link for policy
     */
    public function iClickTheLinkForPolicy()
    {
      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('http://www.mequilibrium.com');
      $link = $driver->findElement(WebDriverBy::xpath("//a[@href='WP_HOME/privacy/']"));
      $link->click();
      $driver->quit();
    }

    /**
     * @Then I should see the policy page
     */
    public function iShouldSeeThePolicyPage()
    {
      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('https://www.mequilibrium.com/privacy/');

      $privacyURL = 'https://www.mequilibrium.com/privacy/';
      $currentURL = $driver->getCurrentUrl();

      $currentURL == $privacyURL;
      $driver->quit();
    }

    /**
     * @Then Update Date Should Be Correct
     */
    public function updateDateShouldBeCorrect()
    {
      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('https://www.mequilibrium.com/privacy/');

      $updateDate = $driver->findElement(WebDriverBy::tagName("em"));
      $updateDate == 'Last Updated: October 27th, 2016';
      $driver->quit();
    }


}
