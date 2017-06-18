<?php
/*----------------------------------------
	賢威6.2

	パンくず表示をする関数拡張

	第1版（賢威6.0）　2012.12.14
	第2版（賢威6.1）　2013. 6.20
	第3版（賢威6.1/6.2）　2015. 1.16

	WEBライダー
----------------------------------------*/

function the_breadcrumbs( $separator = '', $multiple_separator = ' | ' ) {

	if (is_front_page() && !is_paged()) {
		return true;
	}

	global $wp_query;

	echo '<li class="first" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">';
	echo '<a href="'.get_bloginfo('url').'" itemprop="url">';
	echo '<span itemprop="title">'.AO義塾.' &nbsp;></span>';
	echo '</a>';
	echo "</li>\n";

	$queried_object = $wp_query->get_queried_object();

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$max_page = get_max_page();

	if (is_home()) {
		if ($paged > 1) {
			if (!is_front_page()) {
				echo "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".home_url()."\" itemprop=\"url\"><span itemprop=\"title\">";
				echo get_the_title(get_option('page_for_posts'));
				echo("</span></a></li>\n");
			}

			echo "<li><span>". __('Archive List for blog','keni').show_page_number()."</span></li>\n";

		} else {
			echo "<li>";
			echo get_the_title(get_option('page_for_posts'));
			echo("</li>\n");
		}

	} else if( is_page() ){

		if( $queried_object->post_parent ) {
			echo "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\">";
			echo( get_page_parents_keni( $queried_object->post_parent, $separator ) );
			echo( $separator );
			echo("</li>\n");
		}
		echo "<li><span>";
		the_title();
		echo("</span></li>\n");

	} else {

		breadcrumbs_page_for_posts();

		if( is_archive() ) {

			if( is_category() ) {

				if( $queried_object->category_parent ) {
					$parent = get_category_parents($queried_object->category_parent, true, "");
					$parent = str_replace('">', '" rel="category" itemprop="url"><span itemprop="title">', $parent);
					$parent = str_replace('</a>', '</span></a>', $parent);
					$parent = str_replace("</a><a ", "</a></li>\n<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a ", $parent);
					echo '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">'.$parent."</li>\n";
				}

				if ($paged > 1) {
					echo "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_category_link($queried_object->cat_ID)."\" itemprop=\"url\"><span itemprop=\"title\">へ戻る";
					echo single_cat_title();
					echo "</span></a></li>\n";
					echo "<li><span>".sprintf( __('Archive List for %s','keni'), single_cat_title("",false)).show_page_number()."</span></li>\n";
				} else {

					echo "<li><span>";
					echo single_cat_title();
					echo "</span></li>\n";
				}

			} else if(is_year()) {
				if ($paged > 1) {
					echo("<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_year_link(date("Y",get_post_time()))."\" itemprop=\"url\"><span itemprop=\"title\">");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('Y','keni')));
					echo("</span></a></li>\n");
					echo("<li><span>");
					echo archive_title_keni();
					echo("</span></li>\n");
				} else {
					echo("<li><span>");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('Y','keni')));
					echo("</span></li>\n");
				}

			} else if(is_month()) {
				if ($paged > 1) {
					echo("<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_year_link(date("Y/m",get_post_time()))."\" itemprop=\"url\"><span itemprop=\"title\">");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('F Y','keni')));
					echo("</span></a></li>\n");
					echo("<li><span>");
					echo archive_title_keni();
					echo("</span></li>\n");
				} else {
					echo("<li><span>");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('F Y','keni')));
					echo("</span></li>\n");
				}

			} else if(is_day()) {
				if ($paged > 1) {
					echo("<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_year_link(date("Y/m/d",get_post_time()))."\" itemprop=\"url\"><span itemprop=\"title\">");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('F j, Y','keni')));
					echo("</span></a></li>\n");
					echo("<li><span>");
					echo archive_title_keni();
					echo("</span></li>\n");
				} else {
					echo("<li><span>");
					echo sprintf( __('Archive List for %s','keni'), get_the_time(__('F j, Y','keni')));
					echo("</span></li>\n");
				}

			} else if( is_author() ) {
				echo("<li><span>");
				echo get_the_author().sprintf( __('Archive List for authors','keni'));
				echo show_page_number();
				echo("</span></li>\n");

			} else if(isset($_GET['paged']) && !empty($_GET['paged'])) {
				echo("<li><span>");
				_e('Archive List for blog','keni') ;
				echo("</li>\n");

			} else if( is_tag() ){

				if( $queried_object->category_parent ) {
					$parent = get_category_parents($queried_object->category_parent, true, "");
					$parent = str_replace('">', '" rel="category" itemprop="url"><span itemprop="title">', $parent);
					$parent = str_replace('</a>', '</span></a>', $parent);
					$parent = str_replace("</a><a ", "</a></li>\n<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a ", $parent);
					echo '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">'.$parent."</li>\n";
				}

				if ($paged > 1) {
					echo "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_tag_link($queried_object->term_id)."\" itemprop=\"url\"><span itemprop=\"title\">";
					echo single_cat_title();
					echo "</span></a></li>\n";
					echo "<li><span>".sprintf( __('Archive List for %s','keni'), single_cat_title("",false)).show_page_number()."</span></li>\n";
				} else {
					echo "<li><span>";
					echo single_cat_title();
					echo "</span></li>\n";
				}
			}
		} else if( is_attachment()) {
			echo("<li><span>");
			the_title();
			echo("</span></li>\n");

		} else if( is_single()) {
			$category = get_the_category_list_keni( $separator, 'multiple', false, $multiple_separator );

			if (mb_ereg("^<",$category)) {
				/* echo $category; */

			} else {
				$categoryList = get_post_type_object(get_post_type());
				echo("<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_bloginfo('url').'/'.get_post_type()."/\" itemprop=\"url\"><span itemprop=\"title\">".$categoryList->labels->name."</span></a></li>\n");
				echo("<li><span>");
				the_title();
				echo("</li>\n");
			}

		} else if( is_search()) {
			echo("<li><span>");
			printf( __('Search Result for %s','keni'), esc_html(get_search_query()));
			echo show_page_number();
			echo("</span></li>\n");
		} else if( is_404()) {
			echo("<li><span>");
			echo( __('Sorry, but you are looking for something that isn&#8217;t here.','keni'));
			echo("</span></li>\n");
		} else {

			echo("<li><span>");
			the_title();
			echo("</li>\n");
		}
	}

	wp_reset_query();
}


//---------------------------------------------------------------------------
//	パンくずで表示するためにページの情報を取得する関数
//---------------------------------------------------------------------------

function get_page_parents_keni( $page, $separator )
{
	$pankuzu = "";

	$post = get_posts( "include=".$page."&post_type=page" );

	$pankuzu = '<a href="'.get_permalink( $page ).'" itemprop="url"><span itemprop="title">'.$post[0]->post_title.'</span></a>';

	if( $post[0]->post_parent )
	{
		$pankuzu = get_page_parents_keni( $post[0]->post_parent, $separator ) . "</li>\n<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\">" . $pankuzu;
	}

	return $pankuzu;
}




function get_the_category_list_keni($separator = '', $parents='', $post_id = false, $multiple_separator = '/') {
	global $wp_rewrite;
	$categories = get_the_category($post_id);
	if (empty($categories))
		return apply_filters('the_category', __('Uncategorized', 'keni'), $separator, $parents);

	$rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

	$cat_rows = count($categories);

	$thelist = '';
	$i = $cat_no = 0;

	foreach ( $categories as $category ) {

		if ($category->parent) {
			// 親カテゴリーのパンくずを取得
			$parent = get_category_parents($category->parent, true, "");
			$parent = str_replace('">', '" rel="category" itemprop="url"><span itemprop="title">', $parent);
			$parent = str_replace('</a>', '</span></a>', $parent);
			$parent = str_replace("</a><a ", "</a></li>\n<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a ", $parent);

			$thelist .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">'.$parent."</li>\n";
		}

		$thelist .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__('View all posts in %s', 'keni'), $category->name) . '" ' . $rel . ' itemprop="url"><span itemprop="title">';
		$thelist .= "$category->cat_name</span></a></li>\n";
		break;
	}

	$thelist .= "<li><span>".get_the_title()."</span></li>\n";

	return apply_filters('the_category', $thelist, $separator, $parents);

}


function list_categories_keni( $entries = false, $entriesnum = false, $hatenabm = false ) {
	$html = "";
	$postsnumhtml = "";

	$categories = get_categories();

	foreach( $categories as $category) {
		if( empty( $category->category_parent ) ) {
			if( $entriesnum == true ) {
				$posts = get_posts( 'category=' .$category->cat_ID . '&numberposts=-1' );
				$postsnumhtml = '&nbsp;('. count( $posts ) .')';
			}
			$html .= "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><span itemprop=\"title\">";
			$html .= '<a href="'. get_category_link( $category->cat_ID ) .'" itemprop="url"><span itemprop="title">'. $category->name .'</span></a>' . $postsnumhtml;

			if( $entries == true ) $html .= list_postlist_categories_keni( $category->cat_ID, $hatenabm );

			$html .= list_parent_categories_keni( $category->cat_ID, $entries, $entriesnum );
			$html .= "</li>\n";
		}
	}

	if( $html != "" ) $html = "<ul>". $html ."</ul>\n";
	echo( $html );
}


function list_parent_categories_keni( $parent_id = 0, $entries = false, $entriesnum = false ) {
	$html = "";

	$categories = get_categories( 'child_of=' . $parent_id );

	foreach( $categories as $category ) {
		if( $category->category_parent == $parent_id ) {
			if( $entriesnum == true ) {
				$posts = get_posts( 'category=' .$category->cat_ID . '&numberposts=-1' );
				$postsnumhtml = '&nbsp;('. count( $posts ) .')';
			}

			$html .= "<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><span itemprop=\"title\">";
			$html .= '<a href="'. get_category_link( $category->cat_ID ) .'" itemprop="url"><span itemprop="title">'. $category->name .'</span></a>' . $postsnumhtml;

			if( $entries == true ) $html .= list_postlist_categories_keni( $category->cat_ID, $hatenabm );
			$html .= list_parent_categories_keni( $category->cat_ID, $entries, $entriesnum );

			$html .= '</li>';
		}
	}

	if( $html != "" ) return '<ul class="sub">'. $html .'</ul>';
	else return $html;
}


function list_postlist_categories_keni( $category_id, $hatenabm = false ) {
	global $post;

	$html = "";

	query_posts( 'cat=' .$category_id . '&posts_per_page=-1' );

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();

			if( in_category( $category_id ) ) {
				$html .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_permalink( $post->ID ) . '" itemprop="url"><span itemprop="title">' . $post->post_title . '</span></a>';
				if ( true == $hatenabm ) $html .= get_hatena_bookmark(get_permalink($post->ID));
				$html .= '</li>';
			}
		}
	}
	wp_reset_query();

	if( $html != "" ) $html = '<ul class="sub">' . $html . '</ul>';
	return $html;
}



function list_parent_pagelist_keni( $page_id )
{
	$html = "";

	$posts = get_posts( 'post_parent=' .$page_id . '&showposts=-1&post_type=page' );

	if( count( $posts ) > 0 )
	{
		foreach( $posts as $post )
		{
			if( $post->post_parent == $page_id )
			{
				$html .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"';
				$html .= '<a href="' . get_permalink( $post->ID ) . '" itemprop="url">' . $post->post_title . '</a>';
				$html .= list_parent_pagelist_keni( $post->ID );
				$html .= '</li>';
			}
			else
			{
				$html .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">\n<a href="' . get_permalink( $post->ID ) . '" itemprop="url"><span itemprop="title">' . $post->post_title . '</span></a></li>';
			}
		}
	}
	if( $html != "" ) $html = '<ul class="sub">'. $html .'</ul>';
	return $html;
}


function meta_page_number() {
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if ($paged > 1) {
		return "（".$paged."ページ目）";
	}
}


function get_page_number() {
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$max_page = get_max_page();
	if ($max_page > 1) {
		return $paged."ページ";
	}
}

function show_page_number() {
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$max_page = get_max_page();
	if ($max_page > 1 && $paged > 1) {
		return "（".$paged.' / '.$max_page."ページ）";
	} else {
		return "";
	}
}

function get_max_page() {
	global $wp_query;
	return $wp_query->max_num_pages;
}


function breadcrumbs_page_for_posts() {
	if (get_option('page_for_posts') > 0) {
		$page_of_posts = get_page(get_option('page_for_posts'));
		$page_of_posts->post_name;
		echo("<li itemscope=\"itemscope\" itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a href=\"".get_bloginfo('url').'/'.$page_of_posts->post_name."/\" itemprop=\"url\"><span itemprop=\"title\">");
		echo get_the_title(get_option('page_for_posts'));
		echo("</span></a></li>\n");
	}
}

//---------------------------------------------------------------------------
//	パンくず表示を実現するためのカテゴリー情報を表示する関数
//---------------------------------------------------------------------------

function the_category_keni($separator = '', $parents='', $post_id = false, $multiple_separator = '/') {
	echo get_the_category_list_keni($separator, $parents, $post_id, $multiple_separator);
}

?>
