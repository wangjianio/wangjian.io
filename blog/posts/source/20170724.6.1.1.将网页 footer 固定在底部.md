我想

```javascript
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
```