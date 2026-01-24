<?php
DEFINE('NOTLOGGEDIN', 'anonymous');
//DEFINE('MEMBER', 'logged-in');
DEFINE('CONTRIBUTOR', 'can-suggest');
DEFINE('CUSTODIAN', 'owns-pages');
DEFINE('EDITOR', 'is-editor');
DEFINE('SUPERADMIN', 'is-superadmin');
DEFINE('USERROLE', 'is-user');

variable('all-roles', [
	USERROLE => [],
	NOTLOGGEDIN => [ 'about' => 'Not Logged In',   'status' => 'Not Logged In', 'demo-name' => 'Anon' ],
//	MEMBER => [ 'key' => 'logged-in',   'status' => 'Member', 'demo-name' => 'Smith' ],
	CONTRIBUTOR => [ 'about' => 'persons who can suggest additions and edits of General topics and Directory Listings.',
		'status' => 'Contributing User', 'demo-name' => 'Jack' ],
	CUSTODIAN => [ 'about' => 'Subject Matter Experts who review and approve suggestions from Contributing Users',
		'status' => 'Dedicated Page Custodian', 'demo-name' => 'David' ],
	EDITOR => [ 'about' => 'members approve Contributing User applications, approve new content, appoint Dedicated Page Custodians for new content, and link new content to WMM items.',   'status' => 'Editorial Team', 'demo-name' => 'Ganesh' ],
	SUPERADMIN => [ 'about' =>'Those who upload approved suggestions etc', 'status' => 'Webmaster', 'demo-name' => 'Imran' ],
]);

variable('all-countries', [
	'india' => 'India',
	'nigeria' => 'Nigeria',
	'trinidad-and-tobago' => 'Trinidad and Tobago',
	'united-kingdom' => 'The United Kingdom',
	'world' => 'Rest of World', 
]);
