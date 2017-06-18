//main-bg背景切り替え
$(function(){
	$(window).bind("resize load scroll",function(){
		var top = $(".about_sec").position().top-$(window).scrollTop();
		var right = $(".main-bg-blur").width();
		var bottom = $(".main-bg-blur").height();
		var left = 0;
		$(".main-bg-blur").css("clip","rect("+top+"px,"+right+"px,"+bottom+"px,"+left+"px)");
	});
});

//タブ
$(function(){
   $("#sp_tab_nav .sp_tab_nav_button li a").on("click", function() {
      $("#sp_tab_nav_field div").removeClass("selected_box");
      $(".sp_tab_nav_button li").removeClass("selected");

      $($(this).attr("menu")).addClass("selected_box");
      $($(this).parent()).addClass("selected");
   });
   return false;
});


//タブ2
$(function(){
   $("#sp_tab_nav-2 .sp_tab_nav_button-2 li a").on("click", function() {
      $("#sp_tab_nav_field-2 div").removeClass("selected_box");
      $(".sp_tab_nav_button-2 li").removeClass("selected");

      $($(this).attr("menu")).addClass("selected_box");
      $($(this).parent()).addClass("selected");
   });
   return false;
});


//header_bg fade
$(function(){
   var changeBg = function(){
      setTimeout(function(){
         var index = $(".main-bg-normal > li").index($(".main-bg-normal > li.selected"));
         var next = index + 1;
         if (next >= $(".main-bg-normal > li").length) next = 0;
         $(".main-bg-normal > li").each(function (i) {
            $(this).toggleClass( "selected", (i == next) );
         });
         $(".main-bg-blur > li").each(function (i) {
            $(this).toggleClass( "selected", (i == next) );
         });
         changeBg();
      },6000);
   };
   changeBg();
});


