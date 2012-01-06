<?php
  // Run from http://pluralsightgraphapiphpdemo.localhost/ locally
  require_once("./lib/facebook.php");

  $config = array();
  $config['appId'] = getenv('FACEBOOK_APP_ID');
  $config['secret'] = getenv('FACEBOOK_SECRET');

  $facebook = new Facebook($config);

  // Get user
  $user = $facebook->getUser();
  $loginUrl = null;

  if ($user) {
    try {
      $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
      error_log($e);
      $user = null;
    }
  } else {
    $loginUrl = $facebook->getLoginUrl();
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pluralsight PHP Graph API Demo Page</title>
  </head>

  <body>
    <?php if ($user): ?>
    <div id="name">Hello <?php echo($user_profile['name']) ?><div>
    <?php else: ?>
    <p>Please click <a href="<?php echo $loginUrl ?>">here</a> to log into Facebook</p>
    <?php endif ?>
  </body>
</html>
