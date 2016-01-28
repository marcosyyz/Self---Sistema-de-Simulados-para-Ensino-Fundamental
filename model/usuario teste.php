a<?php

require('User.php');

// INSERT a new user.
$user = new User(0, 'Frank', 'American');
$user->insert($dbc);  // done!

// UPDATE an existing user.
$user = User::db_user_by_id($dbc, 223);
$user->setFirst('Johnny');
$user->update($dbc);  // done!

mysqli_close($dbc);

?>


