eruda.init()

function init() {
  if (localStorage.getItem("data") == null) {
    $(".btn-logout").hide()
  }
}




$(document).ready(()=>init())