<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Organics Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./register.css">

</head>

<body>
  <?php
  session_start();
  require('connect.php');
  require('LineLogin.php');

  if (isset($_SESSION['profile'])) {
    $profile = $_SESSION['profile'];
    $chkUser = $mysql->query("SELECT * FROM `Customer` WHERE `UserID`='$profile->sub'");
    $mysql->query("UPDATE `customer` SET `Picture`='$profile->picture' WHERE `UserID`='$profile->sub'");
    $user = $chkUser->num_rows;
    if ($user < 1) {
  ?>

      <div class="Wrapper">
        <h1 class="Title">Organics Salary Bot</h1>
        <form action="" method="get">
          <!-- <img id="pictureUrl" width="25%"> -->
          <input type="hidden" id="pictureUrl"/>
          <input type="hidden" id="userId"/>
          <div class="Input">
            <input type="text" id="input" name="emId" class="Input-text" placeholder="Employee">
            <label for="input" class="Input-label">Employee</label>
          </div>
          <div class="Input">
            <input type="text" id="fname" name="emNo" maxlength="13" class="Input-text" placeholder="No. ID">
            <label for="input" class="Input-label">No. ID</label>
          </div>
          <button type="submit" class="bubbly-button">ลงทะเบียน</button>
        </form>
      </div>
    <?php } else { ?>
      <div class="Wrapper">
        <h1 class="Title">Organics Salary Bot</h1>
        <p class="" style="text-align: center;">คุณได้ลงทะเบียนรหัสพนักงานแล้ว</p>
      </div>
  <?php
    }
  }
  ?>
  <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
  <script>
    function runApp() {
      liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").value = profile.pictureUrl;
        document.getElementById("userId").value = profile.userId;
      }).catch(err => console.error(err));
    }
    liff.init({
      liffId: "1657682438-NJG9Om5L",
      withLoginOnExternalBrowser: true
    }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));
  </script>
</body>

</html>