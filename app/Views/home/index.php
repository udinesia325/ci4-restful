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
        <div class="modal-header">
          <div class="btn-close" data-bs-dismiss="modal"></div>
        </div>
        <div class="modal-body">
          <form action="<?= base_url(
            "v1/auth/login"
          ) ?> " method="post" accept-charset="utf-8" id="myform" autocomplete="off">
            <div class="form-group">
              <input class="form-control" type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" id="password" placeholder="password">
	    </div>
	    <div class="form-group">
	      <button class="btn btn-sm btn-primary" type="submit">Login</button>  
	    </div>
          </form>
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
<script>
eruda.init()

  function init() {
    if (localStorage.getItem("login") == null || localStorage.getItem("login").length == 0) {
      $(".btn-logout").hide()
    }
    $("#myform").on("submit",function(e){
	e.preventDefault()
	$.ajax({
	    type:"post",
	    url: $(this).attr("action"),
	    data:$(this).serialize(),
	    success:handleSuccess,
	    error: (error)=> console.log(error)
	   })
    })

  }
function handleSuccess(data){
    $(".btn-close").click()
    $(".btn-login").hide()
    $(".btn-logout").show(500)
    localStorage.setItem("login",JSON.stringify(data))
    $(".btn-logout").on("click",handleLogout)
}
function handleLogout(){
    const data = JSON.parse(localStorage.getItem("login"))
    $.ajax({
    type:"get",
    url: `http://localhost:8080/v1/auth/logout?token=${data.token}`,
    success: () => {
	localStorage.removeItem("login")
	$(".btn-login").show()
	$(".btn-logout").hide()	
}
})

//alert("logout")
}
  $(document).ready(init)

</script>
</body
</html>
