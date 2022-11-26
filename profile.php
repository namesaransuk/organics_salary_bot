<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <!--https://dribbble.com/shots/2210153-Day-057-Twitter-Profile-->

  <div class="container">

    <div class="card-profile">
      <img src="<?php echo $profile->picture ?>" class="card-profile_visual" alt="">

      <div class="card-profile_user-infos">
        <span class="infos_name"><?php echo $profile->name ?></span>
        <span class="infos_nick"><?php echo $CustomerID . " : " . $Name . " " . $Surname ?></span>

        <a href="#"></a>
      </div>

      <div class="card-profile_user-stats">
        <div class="stats-holder">
          <div class="user-stats">
            <strong>ตำแหน่ง</strong>
            <span><?php echo $Role ?></span>
            <br>
            <button class="bubbly-button">คลิกเพื่อดูสลิป</button>
          </div>
          <!-- <div class="user-stats">
            <strong>Following</strong>
            <span>561</span>
          </div> -->
          <!-- <div class="user-stats">
            <strong>Followers</strong>
            <span>718</span>
          </div> -->
        </div>
      </div>

    </div>

  </div>
  <!-- partial -->
  <script src="script.js"></script>

</body>

</html>