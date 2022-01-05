<?php
/**
 * Acceptance tests for switching users.
 */

/**
 * Test class.
 */
class SwitchUserCest {
	public function _before( AcceptanceTester $I ) {
		$I->comment( 'As an administrator' );
		$I->comment( 'I need to be able to switch between users' );
		$I->comment( 'In order to access different user accounts' );

		$I->haveUserInDatabase( 'editor', 'editor' );
	}

	public function SwitchToEditorAndBack( AcceptanceTester $I ) {
		// Given I am logged in as admin
		$I->loginAsAdmin();
		// When I switch to user "editor"
		$I->switchToUser( 'editor' );
		// Then I should see a status message that says "Switched to editor"
		$I->seeAdminSuccessNotice( 'Switched to editor' );
		// And I should be logged in as "editor"
		$I->loggedInAs( 'editor' );

		// When I go to the dashboard
		$I->amOnAdminPage( '/' );
		// And I switch back to "admin"
		$I->switchBack( 'admin' );
		// Then I should see a status message that says "Switched back to admin"
		$I->seeAdminSuccessNotice( 'Switched back to admin' );
		// And I should be logged in as "admin"
		$I->loggedInAs( 'admin' );
	}

	public function SwitchOffAndBack( AcceptanceTester $I ) {
		// Given I am logged in as admin
		$I->loginAsAdmin();
		// When I switch off
		$I->switchOff();
		// Then I should be logged out
		$I->loggedOut();

		// When I switch back to "admin"
		$I->switchBack( 'admin' );
		// Then I should be logged in as "admin"
		$I->loggedInAs( 'admin' );
	}
}
