<?php
/**
 * Index
 * 
 * This is the website's homepage. Since this project only implements a simple user 
 * management system, everything will happen on this page. Therefore, all HTTP requests
 * redirect to this file.
 */

/**
 * Project's constants definitions
 * 
 * For this project, we will use a MySQL database but it could be adapted to fit with
 * other technologies such as NoSQL.
 * 
 * * You could put these definitions in a config.php file and include it
 * * along the functions. If you want to put your private API keys in here
 * * and don't want to publish them on a repository, you could add the 
 * * config.php file to .gitignore and create a config-sample.php file, 
 * * which has the same options but with empty values. Then, before you
 * * import your config.php file, check if it exists and if it doesn't, you
 * * can clone the sample file.
 * 
 */
/** Database info */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'php-session');

/** Attempt database connection */
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
define('DB_CONNECTED', $db !== false);

require_once __DIR__ . '/services/accountService.php';

/**
 * Functions to hook up our site with Session Management
 */

/** Get the register form data */
function getRegisterFormData() {
  $res = array(
    'name' => '',
    'username' => '',
    'password' => '',
    'errors'   => array(
      'name' => false,
      'username' => false,
      'password' => false,
    ),
  );
  //TODO: add form data to array
  return $res;
}


/**
 * The website's content
 * 
 * * A good practice would be to divide your website's content into
 * * multiple components. I like going with:
 * *   -  Header  DOCTYPE, html and body opening, head, navbar and hero
 * *   -  Main    The content
 * *   -  Footer  Footer, scripts, body and html closing
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Session</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php if (!DB_CONNECTED): ?>
    <?php // The view if a database connection could not be established ?>
    <h1>There must have been a mistake..</h1>
    <p>We were unable to connect to the database.</p>
  <?php else: ?>
    <?php $formData = getRegisterFormData() ?>
    <div class="container">
      <h1>Welcome to PHP Session!</h1>
      <div style="height:100px"></div>
      <div class="row">
        <div class="col" style="padding-right:32px;margin-right:32px;border-right:1px solid black">
          <h2>Register</h2>
          <div style="height:16px"></div>
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

            <label for="name">Full Name</label>
            <input class="form-control" type="text" name="name" id="name"<?php if ($formData['errors']['name']) echo ' is-invalid' ?> value="<?php echo $formData['name'] ?>">
            <?php if ($formData['errors']['name']): ?>
              <div class="invalid-feedback"><?php echo $formData['errors']['name'] ?></div>
            <?php endif ?>

            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username"<?php if ($formData['errors']['username']) echo ' is-invalid' ?> value="<?php echo $formData['username'] ?>">
            <?php if ($formData['errors']['username']): ?>
              <div class="invalid-feedback"><?php echo $formData['errors']['username'] ?></div>
            <?php endif ?>

            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password"<?php if ($formData['errors']['password']) echo ' is-invalid' ?> value="<?php echo $formData['password'] ?>">
            <?php if ($formData['errors']['password']): ?>
              <div class="invalid-feedback"><?php echo $formData['errors']['password'] ?></div>
            <?php endif ?>

            <div style="height:16px"></div>


            <button class="btn btn-primary" type="submit">Register</button>

          </form>
        </div>
        <div class="col">
          <h2>Login</h2>
          <p>Already registered? Login here!</p>
        </div>
      </div>
    </div>
  <?php endif ?>    
</body>
</html>