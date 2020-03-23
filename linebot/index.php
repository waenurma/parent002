<?php session_start();?>
<?php
include 'h.php';
$user_id= $_REQUEST["user_id"];
$id_card = $_REQUEST["id_card"];
?>

<style type="text/css">

#btn{
width:100%;
}
</style>
<title>หน้าหลัก</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <style type="text/css">
  </style>
  <style type="text/css"> body {
      font-family: 'Kanit', sans-serif;
        background: linear-gradient(to top,#6699CC 0%, #6699CC 100%);
        color: black;
}</style>
  <style>
      body {
        font-family: 'Kanit', sans-serif;
      }
    </style>
<div class="container" style="padding-top:100px">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color:#6699FF">
      <h3 align="center">
      <span class="glyphicon glyphicon-lock"> </span>
      ลงชื่อเข้าใช้งาน </h3>
      <form  name="formlogin" action="connect.php?user_id=<?php echo $user_id,$id_card; ?>" method="POST" id="login" class="form-horizontal">
        <div class="form-group">
        <input type="hidden"  name="id_card" class="form-control" required placeholder="บัตรประชาชน" />
        <div class="form-group">
        <div class="col-sm-12">
            <input type="text"  name="id_card" class="form-control" required placeholder="บัตรประชาชน" />
          </div>
        </div>
        <div class="form-group">
        <div class="col-sm-12">
            <input type="date"  name="Bdate" class="form-control" required placeholder="วันเดือนปี" />
          </div>
        </div>
        <div class="form-group">
         <div class="col-sm-12">
            <input type="text"  name="tell" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit"  class="btn btn-success" id="btn">
            <span class="glyphicon glyphicon-log-in"> </span>
             ลงทะเบียน  </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>