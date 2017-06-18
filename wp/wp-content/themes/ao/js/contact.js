/* -------
     GETメソッド取得
------- */
function GetQueryString()
{
    var result = {};
    if( 1 < window.location.search.length )
    {
        // 最初の1文字 (?記号) を除いた文字列を取得する
        var query = window.location.search.substring( 1 );

        // クエリの区切り記号 (&) で文字列を配列に分割する
        var parameters = query.split( '&' );

        for( var i = 0; i < parameters.length; i++ )
        {
            // パラメータ名とパラメータ値に分割する
            var element = parameters[ i ].split( '=' );

            var paramName = decodeURIComponent( element[ 0 ] );
            var paramValue = decodeURIComponent( element[ 1 ] );

            // パラメータ名をキーとして連想配列に追加する
            result[ paramName ] = paramValue;
        }
    }
    return result;
}
//お問い合わせ校舎自動セレクト
$(function(){
	if (typeof GetQueryString().page !== "undefined") {
		//console.log(GetQueryString().page);
		var page = GetQueryString().page;//?page=の文字取得
		if(page == 'ochanomizu'){//御茶ノ水サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="御茶ノ水サテライト校<ochanomizu@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		//alert('void!');
		if(page == 'yoyogi'){//代々木キャンプ
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="代々木キャンプ<info@aogijuku.com>"]').attr("selected","selected");
		}
		if(page == 'yokohama'){//横浜キャンプ
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="横浜キャンプ<info@aogijuku.com>"]').attr("selected","selected");
		}
		if(page == 'matsudo'){//松戸サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="松戸サテライト校<matsudo@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'mito'){//水戸サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="水戸サテライト校<mito@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'nerima'){//練馬サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="練馬サテライト校<nerima@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'sugamo'){//巣鴨サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="巣鴨サテライト校<sugamo@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'atsugi'){//厚木サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="厚木サテライト校<atsugi@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'shinyokohama'){//新横浜サテライト校
			$('select#changeSelect').children('[value=kanto]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kanto' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="新横浜サテライト校<shinyokohama@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'kanazawa'){//金沢サテライト校
			$('select#changeSelect').children('[value=chubu]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'chubu' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="金沢サテライト校<kanazawa@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'toyama'){//富山サテライト校
			$('select#changeSelect').children('[value=chubu]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'chubu' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="富山サテライト校<toyama@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
		if(page == 'tsu'){//津サテライト校
			$('select#changeSelect').children('[value=kinki]').attr("selected","selected");
			$( '#sendto' ).empty();
			$( '#sendto' ).append( option );
			$( '#sendto option' ).each( function()
			{
				if( !$( this ).hasClass( 'kinki' ) && !$( this ).hasClass( 'select0' ) )
					$( this ).remove();
			});
			$('#sendto').children('[value="津サテライト校<tsu@takeda.tv>,hoge<info@takeda.tv>"]').attr("selected","selected");
		}
	}
});