<script>
var str="<strong>利用AI开发网络病毒</strong>";
var patt1=/(?<=<strong>).*(?=<\/strong>)/g;
document.write(str.match(patt1));

</script>