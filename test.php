<!DOCTYPE html>
<html>

    <head>

        <title>onresize test</title>

    </head>

    <body>
        <p>Resize the browser window to fire the resize event.</p>

        <p>Window height: <span id="height"></span></p>
        <p>Window width: <span id="width"></span></p>

        <script type="text/javascript">
            var heightOutput = document.querySelector('#height');
            var widthOutput = document.querySelector('#width');

            function resize() {
                heightOutput.textContent = document.documentElement.clientHeight;
                widthOutput.textContent = document.documentElement.clientWidth;
            }

            window.onresize = resize;

        </script>
    </body>

</html>
