<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bani Yas</title>
  <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?> ">
</head>
<body>

  <!-- modal -->
  <div class="modal fade" id="modal">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-body">
          ini modal
          <button data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir midal -->


  <button class="btn btn-login btn-primary btn-sm" data-bs-target="#modal" data-bs-toggle="modal">Login</button>
  <button class="btn btn-logout btn-danger btn-sm">Logout</button>

  <script src="<?= base_url("eruda/eruda.js") ?> "></script>
  <script src="<?= base_url("jquery.min.js") ?> "></script>
  <script src="<?= base_url("js/bootstrap.min.js") ?> "></script>
</script>
<script src="<?= base_url("js/script.js") ?> "></script>
</body>
</html>