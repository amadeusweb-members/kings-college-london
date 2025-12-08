<?php
$section = getSectionFrom(__DIR__);
$menuKey = getSectionKey($section, MENUNAME);

variable(getSectionKey($section, FILELOOKUP), [
	'login' => [ 'relative-path' => 'profile/login.php', 'about' => 'Simple form for now.' ],
	'logout' => [ 'relative-path' => 'profile/logout.php', 'about' => 'Simple form for now.' ],
	'create-profile' => [ 'relative-path' => 'forms/create-profile.tsv', 'about' => 'One of the most important forms.' ],
	'update-profile' => [ 'relative-path' => 'forms/update-profile.tsv', 'about' => 'Here we track all changed.' ],
	'searches' => [ 'relative-path' => 'searches/home.php', 'about' => 'A Member can save searches and reach out to peers and carers.' ],
	'suggest' => [ 'relative-path' => 'forms/suggest.php', 'about' => 'Contributing users will  be able to make suggestions.' ],
	'my-pages' => [ 'relative-path' => 'flows/my-pages.php', 'about' => 'Pages/suggestions owned by the custodian' ],
	'approvals' => [ 'relative-path' => 'flows/approvals.php', 'about' => 'Approvals for Editors' ],
	'site-admin' => [ 'relative-path' => 'flows/site-admin.php', 'about' => 'For Webmaster(s)' ],
]);

$op = [];
$needsLogout = true;

if (role_is(NOTLOGGEDIN)) {
	variable($menuKey, 'Signup / Login');
	$op['login'] = 'Login';
	$op['create-profile'] = 'Sign Up';
	$needsLogout = false;
/*
} else if (role_is(MEMBER)) {
	variable($menuKey, 'Membership');
	$op['update-profile'] = 'My Profile';
	$op['searches'] = 'My Saved Searches';
*/
} else if (role_is(CONTRIBUTOR)) {
	//variable($menuKey, 'Contribute');
	$op['suggest'] = 'Make a Suggestion';
} else if (role_is(CUSTODIAN)) {
	//variable($menuKey, 'My Dashboard');
	$op['my-pages'] = 'My Pages and Dashboard';
} else if (role_is(EDITOR)) {
	//variable($menuKey, 'My Approvals');
	$op['approvals'] = 'Approve Suggestions';
} else if (role_is(SUPERADMIN)) {
	//variable($menuKey, 'Webmaster Tools');
	$op['site-admin'] = 'Site Administration';
}

if (!count($op)) peDie('15', [$op, $_SESSION]);


$me = variable('all-roles')[variable(USERROLE)];
variable($menuKey, $me['demo-name'] .  ' (' . $me['status'] . ')');
variable($menuKey . '_home', 'off');

if ($needsLogout || variable('node') == 'logout') $op['logout'] = 'Logout';

variable(getSectionKey($section, MENUITEMS), $op);
return $op;
