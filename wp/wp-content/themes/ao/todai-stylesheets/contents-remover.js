
$(function()  {
  console.log("サクセス2");
  // 現在ページのURL取得
  	var url   = location.href;
    console.log(url);
	
	var array = ['.html/1', '.html/2','.html/3','.html/4','.html/5','.html/6','.html/7','.html/8','.html/9'   ];
	console.log(array);
	
	if ( url.indexOf(".html/2") != -1) {
  	 $(".interview-wrap").remove();
	 }
	 else if ( url.indexOf(".html/3") != -1) {
  	 $(".interview-wrap").remove();
	 }
	 else if ( url.indexOf(".html/4") != -1) {
  	 $(".interview-wrap").remove();
	 }
	 else if ( url.indexOf(".html/5") != -1) {
  	 $(".interview-wrap").remove();
	 }
	 else if ( url.indexOf(".html/6") != -1) {
  	 $(".interview-wrap").remove();
	 }
  	
});
