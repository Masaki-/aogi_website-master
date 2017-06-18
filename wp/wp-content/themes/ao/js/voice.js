//検索メニュー
$(function(){
	$(".search > a").click(function () {
     $(".search_detail").slideToggle();
     $(".arrow").toggleClass("arrow_rotate");
   });
});