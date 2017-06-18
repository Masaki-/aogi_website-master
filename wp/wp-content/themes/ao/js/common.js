// JavaScript Document
/****************************************************************
 * タブきりかえ
 ****************************************************************/
//$(document).ready(function() {
   //$(".tab").hide();
   //$(".from-tab ul li:first").addClass("selected").show();
   //$(".tab:first").show();
   //$(".from-tab ul li").click(function() {
		//$(".from-tab ul li").removeClass("selected");
		//$(this).addClass("selected");
		//$(".tab").hide();
		//var activeTab = $(this).find("a").attr("href");
		//$(activeTab).fadeIn();
		//return false;
     //});
//});

$(function() {
	$('.from-tab li').click(function() {
		var index = $('.from-tab li').index(this);
		$('.tab').css('display','none');
		$('.tab').eq(index).css('display','block');
		$('.from-tab li').removeClass('selected');
		$(this).addClass('selected')
	});
});

