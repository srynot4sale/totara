Feature: Manage Organisation
  In order to maintain the site organisation
  As an administrator
  I want to be able to add, edit and delete organisations

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: No organisations
    Given there are no organisation records
      And I am logged in as admin
      And I am on the manage organisations page
    Then I should see "No organisations defined"

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: Fail to create a organisation without required fields
    Given there is a organisation framework and 1 depth
      And I am logged in as admin
      And I am on the manage organisations page
      And I press "Add new organisation"
      And I press "Save changes"
    Then I should see "Missing organisation full name"
      And I should see "Missing organisation short name"

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: Add a new organisation
    Given there is a organisation framework and 1 depth
      And I am logged in as admin
      And I am on the manage organisations page
      And I press "Add new organisation"
      And I fill in "fullname" with "My organisation fullname"
      And I fill in "shortname" with "My shortname"
      And I press "Save changes"
    Then I should see "My organisation fullname"

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: Add a new child organisation
    Given there is a organisation framework and 2 depth
      And I am logged in as admin
      And I am on the manage organisations page
      And I add an organisation
      And I press "Add new organisation"
      And I select "My organisation fullname" from "parentid"
      And I fill in "fullname" with "My child organisation fullname"
      And I fill in "shortname" with "My child shortname"
      And I press "Save changes"
    Then I should see "My child organisation fullname"

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: Edit an organisation
    Given there is a organisation framework and 1 depth
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I add an organisation
      And I edit the 1st organisation table entry
      And I fill in "fullname" with "My organisation fullname revised"
      And I press "Save changes"
    Then I should see "My organisation fullname revised"

  @store_org
  @store_org_framework
  @store_org_depth
  Scenario: Delete an organisation
    Given there is a organisation framework and 1 depth
      And I am logged in as admin
      And I am on the manage organisations page with editing on
      And I add an organisation
      And I delete the 1st organisation table entry and confirm
    Then I should not see "My organisation fullname"
