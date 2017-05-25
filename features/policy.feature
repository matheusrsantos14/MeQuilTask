Feature: Policy
  In order to see the Privacy Policy page
  As a user on the home page
  I must have access to a Private Policy link

Scenario: Find and click link
  Given I am on the home page
  When I click the link for policy
  Then I should see the policy page
  And Update Date Should Be Correct
