$(window).load(function() {
    $(".tabset").each(function(){
    var set = $(this);
    var btn = set.find("ul.tabset_tab li a");
    var setpael = set.find("ul.tabset_tab li a.select");
    var panel = set.find(".tabset_panel div");
    var setpanelID = $(setpael).attr("href");
     
    //パネル初期設定
    $(panel).hide();
    $(".tabset_panel div"+setpanelID).show();
     
      //アクション
        $(btn).click(function(){
        $(btn).removeClass("select");
        $(this).addClass("select");
        $(panel).hide();
        $($(this).attr("href")).show();
        //return false;
        });
    });
});