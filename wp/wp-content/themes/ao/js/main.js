$(function() {

/* -------
    スマホメニュー開閉
------- */

$("#menu_button").click(function(){
    $(".sp_g_nav_field").toggleClass("open");
    $(".sp_g_nav").toggleClass("open");
});

/* -------
    スムーススクロール
------- */

$('a[href^=#]').click(function() {
    var speed = 400;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top - 100;
    $('body,html').animate({scrollTop:position}, speed, 'swing');
    return false;
});

/* -------
     トップに戻るアジャスト
------- */

$(window).bind("scroll resize",function(){
    var h = $(window).height();
    var p = $(".footer_nav > ul").offset().top - $(window).scrollTop() - h;

    $(".pagetop_button").toggleClass("pagetop_button_bottom",(p<0));
    $(".pagetop_button").toggleClass("pagetop_button_hide",($(window).scrollTop() < 200));
});

/* -------
     無料体験誘導アジャスト
------- */

$(window).bind("scroll resize",function(){
    var h = $(window).height();
    var p = $(".sp-footer__eraseposition").offset().top - $(window).scrollTop() - h;

    $(".sp-footer").toggleClass("sp-footer--bottom",(p<0));
    $(".sp-footer").toggleClass("sp-footer--hide",($(window).scrollTop() < 1));
});


/* -------
    article タブ
------- */
$(function(){
   $(".tab ul li a").on("click", function() {
      $(".tab ul li").removeClass("tab_current");
      $(".tab_field div").removeClass("tab_field_show");

      $($(this).attr("menu")).addClass("tab_field_show");
      $($(this).parent()).addClass("tab_current");
   });
   return false;
});

});

/* -------
     タブ固定アジャスト
------- */

$(function() {

  if (!$('.tab')[0])return;

  var tab = $('.tab');

  // メニューのtop座標を取得する
  var offsetTop = tab.offset().top;

  var floatTab = function() {
      // スクロール位置がメニューのtop座標を超えたら固定にする
      if ($(window).scrollTop() > offsetTop - 50) {
          $('body').addClass('is_fixed');
      } else {
          $('body').removeClass('is_fixed');
      }
  };
  $(window).scroll(floatTab);
  $('body').bind('touchmove', floatTab);
});

