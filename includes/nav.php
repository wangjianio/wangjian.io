<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/NavSelector.php'; ?>

    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index">Wang Jian IO</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">

        <?php $nav_selector->printRightNav($nav_type); ?>

        <?php $nav_selector->printLeftNav($nav_type, $subnav_type); ?>

        </div>
      </div>
    </nav>

<script>
  function dynamicNavbar() {
    var url = window.location.pathname;
    
    if (url == '/projects/money/login') {
      return false;
    }
    
    var pattern = /^\/projects\/money\//i;
    var result = pattern.test(url);
    return result;
  }
  if (dynamicNavbar()) {
    $('.navbar-brand').addClass('hidden-sm');
  }
  /*
  $(function () {
    // alert(window.location.pathname);
    // var pathname = window.location.pathname;
    // var result = pattern.test(url);

    var c_pathname = window.location.pathname;
    var encode_c_pathname = encodeURIComponent(c_pathname);
    // console.log(encode_c_pathname);
    
    $("nav li a").each(function(){
      var a_pathname = $(this)[0].pathname;
      if (a_pathname) {
        var encode_a_pathname = encodeURIComponent(a_pathname);
        // console.log(encode_a_pathname);
      }
      
      var pattern = new RegExp("^" + encode_a_pathname, 'i');
      var result = pattern.test(encode_c_pathname);
      // console.log(result);

      if (result) {
        $(this).parent().addClass('active')
      }


      // var pattern = "^\\" + href;
      // console.log(pattern)
      // var pattern = new RegExp("^" + href, 'i');
      // console.log(pattern.test(window.location.pathname))
    });  
  })
  */
</script>