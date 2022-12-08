
<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://sheet.best/api/sheets/890879ad-c389-4266-aa4a-3ebfdbb1b5a1"); //paste api link
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); 

//change to array format
$result = json_decode($output);

?>

<html>
<head>
<title>Example GetData From Google Sheet.</title>
<style>
 #data {
   font-family: Arial, Helvetica, sans-serif;
   border-collapse: collapse;
   width: 100%;
 }

 #data td, #data th {
   border: 1px solid #ddd;
   padding: 8px;
 }

 #data tr:nth-child(even){background-color: #f2f2f2;}

 #data tr:hover {background-color: #ddd;}

 #data th {
   padding-top: 12px;
   padding-bottom: 12px;
   text-align: left;
   background-color: #04AA6D;
   color: white;
 }

 h2{
    text-align: center;
 }
</style>
</head>
<body>
 <h2>Example Get Data From Google Sheet.</h2>
 <table id="data">
         <thead>
     <tr>
         <th>Fullname</th>
         <th>Gender</th>
         <th>Telephone</th>
         <th>Email</th>
     </tr>
     </thead>
     <tbody>
     <?php if(!empty($result)) : ?>
         <?php foreach($result as $key => $value): ?>
         <tr>
             <td><?php echo $value->รหัสพนักงาน; ?></td>
             <td><?php echo $value->ชื่อ; ?></td>
             <td><?php echo $value->ตำแหน่ง; ?></td>
             <td><?php echo $value->เงินเดือน; ?></td>
         </tr>
         <?php endforeach; ?>
     <?php endif; ?>
     </tbody>
     </table>
</body>
</html>