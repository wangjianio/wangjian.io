<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <script src="/scripts/jquerys-3.2.1.min.js"></script>
    <script>
      function placeFooter() {
        var footerHeight = $("footer").outerHeight();

        if ($(document).height() + footerHeight != $(window).height()) {
          $("footer").removeClass("navbar-fixed-bottom");
        }

        if ($(document).height() == $(window).height()) {
          $("footer").addClass("navbar-fixed-bottom");
        }
      }

      $(document).ready(placeFooter);
      window.onresize = placeFooter;
    </script>
  </head>

  <body>
    <div style="width:100%; height:400px; border:10px solid gray">content</div>
    <footer style="width:100%; height:100px; border:10px solid gray">footer</footer>
  </body>

</html>
