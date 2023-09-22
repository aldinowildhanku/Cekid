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
<script>
    function checkIDFF() {
    jQuery('#hasil-cek').val('')
    var idff = jQuery('#user_id').val();
    if(idff == ''){
        jQuery('#hasil-cek').html('<div class="alert mt-3 alert-danger" >Mohon Masukan Data ID</div>');
    } else {
        jQuery('#hasil-cek').html('<div class="alert mt-3 alert-info"><i class="fa fa-spinner fa-spin"></i> Mohon Tunggu</div>');
        jQuery.ajax({
            url: '<?php echo ('api/api_freefire.php')?>',
            dataType: 'JSON',
            type: 'post',
            data: {
                user_id: idff
            },
            success: function(nickff) {
                var response_status = nickff.status;
                var namav = nickff.nama;
                var output = namav;


                if (response_status == "error_server") {
                  jQuery('#hasil-cek').html('<div class="alert mt-3 alert-danger" >Data Tidak Ditemukan</div>');
                }else if(response_status == "error_1"){
                    jQuery('#hasil-cek').html('<div class="alert mt-3 alert-danger" >Server Sedang Sibuk bisa dicoba kembali beberapa menit kedepan</div>');
                } else if (response_status == "ok") {
                  jQuery('#hasil-cek').html('<div class="alert mt-3 alert-success"><i class="fa fa-check-square"></i> Nickname: '+output+'</div>');
                }
                // jQuery('#nickml').val(nickml);
            }
        });
    }
}
</script>
<div class="container">
  <h2>Checking ID GAME</h2>
  <form action="/action_page.php">
    <div class="form-group">
      <label for="email">User ID:</label>
      <input type="email" class="form-control" id="user_id" placeholder="Enter email" name="user_id">
    </div>
    <div class="form-group">
      <label for="pwd">Server ID:</label>
      <input type="password" class="form-control" id="server_id" placeholder="Enter password" name="server_id">
    </div>
    <div class="mb-3" id="hasil-cek"></div>
    <input type="button" class="btn btn-success" onclick="checkIDFF()" value="CEK NICKNAME" />
  </form>
</div>

</body>

</html>