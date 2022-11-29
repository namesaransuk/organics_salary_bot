<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organics Legendary</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./style.css">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="profile-container">

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
          <!-- <a href="logout.php">ออกจากระบบ</a> -->
        </div>
      </div>

    </div>

  </div>
  <!-- partial -->
  <script src="script.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>