<?php

use yii\db\Migration;

/**
 * Class m180216_150334_initial_user_rbac
 */
class m180216_150334_initial_user_rbac extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$auth = Yii::$app->authManager;
	
		// add the rule
		$profileOwnerRule = new \common\rbac\ProfileOwnerRule;
		$auth->add( $profileOwnerRule );
		
		/*
		 * User Permissions
		 */
		// add "createUser" permission
		$createUser = $auth->createPermission('createUser');
		$createUser->description = 'Permission to create user';
		$auth->add( $createUser );
	
		// add "readUser" permission
		$readUser = $auth->createPermission('readUser');
		$readUser->description = 'Permission to read a user';
		$auth->add( $readUser );
		
		// add "updateUser" permission
		$updateUser = $auth->createPermission('updateUser');
		$updateUser->description = 'Permission to update a user';
		$auth->add( $updateUser );
		
		// add "deleteUser" permission
		$deleteUser = $auth->createPermission('deleteUser');
		$deleteUser->description = 'Permission to delete a user';
		$auth->add( $deleteUser );
	
		// add "listUser" permission
		$listUsers = $auth->createPermission('listUsers');
		$listUsers->description = 'Permission to list users';
		$auth->add( $listUsers );
		
		/*
		 * Profile Permissions
		 */
		// add "createUserProfile" permission
		$createUserProfile = $auth->createPermission('createUserProfile');
		$createUserProfile->description = 'Permission to create user profile';
		$auth->add( $createUserProfile );
	
		// add "readProfile" permission
		$readUserProfile = $auth->createPermission('readUserProfile');
		$readUserProfile->description = 'Permission to read a user profile';
		$auth->add( $readUserProfile );
	
		// add "updateUserProfile" permission
		$updateUserProfile = $auth->createPermission('updateUserProfile');
		$updateUserProfile->description = 'Permission to update a user profile';
		$auth->add( $updateUserProfile );
	
		// add "deleteUserProfile" permission
		$deleteUserProfile = $auth->createPermission('deleteUserProfile');
		$deleteUserProfile->description = 'Permission to delete a user profile';
		$auth->add( $deleteUserProfile );
	
		// add "listUserProfiles" permission
		$listUserProfiles = $auth->createPermission('listUserProfiles');
		$listUserProfiles->description = 'Permission to list user profiles';
		$auth->add( $listUserProfiles );
	
		// add the "updateOwnPost" permission and associate the rule with it.
		$updateOwnProfile = $auth->createPermission('updateOwnProfile');
		$updateOwnProfile->description = 'Update own profile';
		$updateOwnProfile->ruleName = $profileOwnerRule->name;
		$auth->add( $updateOwnProfile );
		$auth->addChild( $updateOwnProfile, $updateUserProfile );
	
		// add "User" role and give this role the "createPost" permission
		$userRole = $auth->createRole('User' );
		$userRole->description = "User Role";
		$auth->add( $userRole );
		$auth->addChild( $userRole, $createUserProfile );
		
		// allow "userRole" to update their own profile
		$auth->addChild( $userRole, $updateOwnProfile );
		
		$userAdminRole = $auth->createRole( "UserAdmin" );
		$userAdminRole->description = "User Administrator Role";
		$auth->add( $userAdminRole );
		$auth->addChild( $userAdminRole, $createUser );
		$auth->addChild( $userAdminRole, $readUser );
		$auth->addChild( $userAdminRole, $updateUser );
		$auth->addChild( $userAdminRole, $deleteUser );
		$auth->addChild( $userAdminRole, $listUsers );
		
		$userProfileAdminRole = $auth->createRole( "ProfileAdmin" );
		$userProfileAdminRole->description = "User Profile Administrator";
		$auth->add( $userProfileAdminRole );
		$auth->addChild( $userProfileAdminRole, $createUserProfile );
		$auth->addChild( $userProfileAdminRole, $readUserProfile );
		$auth->addChild( $userProfileAdminRole, $updateUserProfile );
		$auth->addChild( $userProfileAdminRole, $deleteUserProfile );
		$auth->addChild( $userProfileAdminRole, $listUserProfiles );
	
		// add "SuperAdmin" role and give this role the "updatePost" permission
		// as well as the permissions of the "author" role
		$superUser = $auth->createRole('SuperUser');
		$superUser->description = "ALL POWERFULL USER Role";
		$auth->add( $superUser );
		$auth->addChild( $superUser, $userAdminRole );
		$auth->addChild( $superUser, $userProfileAdminRole );
		$auth->addChild( $superUser, $userRole );
		
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$auth = Yii::$app->authManager;
	
		$auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_150334_initial_user_rbac cannot be reverted.\n";

        return false;
    }
    */
}
