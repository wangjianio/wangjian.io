function placeFooter() {
  var footerHeight = $("footer").outerHeight();

  if ($(document).height() + footerHeight != $(window).height()) {
    $("footer").removeClass("navbar-fixed-bottom");
  }

  if ($(document).height() == $(window).height()) {
    $("footer").addClass("navbar-fixed-bottom");
  }
}

placeFooter();
$(placeFooter);
$(window).on('resize', placeFooter);

// MutationObserver 兼容性测试。因不兼容影响也不大，所以此处只做记录，未做处理。
// var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
// var mutationObserverSupport = !!MutationObserver;

var mo = new MutationObserver(function () {
  placeFooter();
});

var option = {
  'childList': true,
  'subtree': true,
  // 'attributeFilter': ['height'],
};

mo.observe(document.body, option);
