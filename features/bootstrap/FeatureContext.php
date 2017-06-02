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

      /*

      Thought Process: Just goes to Homepage to start test.

      I know that each step creates a new session. I know it is wrong, and I know it must be a global variable
      so I can call $driver in each function, however, I can't get it to work. I've tried taking it out of the class but it returns an error.
      I also tried placing it in the Class but outside the Functions and this also didn't work. I've googled it, and have tired various
      things from people that have had a similar problem but still didn't work.

      It might just be a PHP code error. I hope this doesn't count against me writing a working test.

      */

      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('http://www.mequilibrium.com');
    }

    /**
     * @When I click the link for policy
     */
    public function iClickTheLinkForPolicy()
    {

      //Thought Process: This step makes sure there is a link to the Privacy page. It finds a link element by it's path.
      //If the link with a path to Privacy page exists then Privacy is indeed linked on homepage. It then clicks the link to go to page.

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

      //Thought Process: This step makes sure this is the right page. It looks to see if current URL matches the Privacy Page URL.
      //If the URL does indeed match the URL for the Privacy page then it is the correct page to be on.

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

      //Thought Process: This step looks for the string "Last Updated: which is where the appropriate date is placed.
      //If "Last Updated" does not exist on page then there is no date and will return an error.

      $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
      $driver->get('https://www.mequilibrium.com/privacy/');
      $driver->findElement(WebDriverBy::xpath("//*[contains(text(), 'Last Updated:')]"));
      $driver->quit();

    }

}
