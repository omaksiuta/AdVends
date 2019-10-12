<?php
/**
 * Sweet Dessert Framework: social networks
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('sweet_dessert_socials_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_socials_theme_setup', 1 );
	function sweet_dessert_socials_theme_setup() {

		if ( !is_admin() ) {
			// Add og:image meta tag for facebook
			add_action( 'wp_head', 'sweet_dessert_facebook_og_tags', 5 );
		}
	
		// List of social networks for site sharing and user profiles
		sweet_dessert_storage_set('share_links', array(
			'blogger' =>		sweet_dessert_get_protocol().'://www.blogger.com/blog_this.pyra?t&u={link}&n={title}',
			'bobrdobr' =>		sweet_dessert_get_protocol().'://bobrdobr.ru/add.html?url={link}&title={title}&desc={descr}',
			'delicious' =>		sweet_dessert_get_protocol().'://delicious.com/save?url={link}&title={title}&note={descr}',
			'designbump' =>		sweet_dessert_get_protocol().'://designbump.com/node/add/drigg/?url={link}&title={title}',
			'designfloat' =>	sweet_dessert_get_protocol().'://www.designfloat.com/submit.php?url={link}',
			'digg' =>			sweet_dessert_get_protocol().'://digg.com/submit?url={link}',
			'evernote' =>		'https://www.evernote.com/clip.action?url={link}&title={title}',
			'facebook' =>		sweet_dessert_get_protocol().'://www.facebook.com/sharer.php?u={link}',
			'friendfeed' =>		sweet_dessert_get_protocol().'://www.friendfeed.com/share?title={title} - {link}',
			'google' =>			sweet_dessert_get_protocol().'://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk={link}&title={title}&annotation={descr}',
			'gplus' => 			'https://plus.google.com/share?url={link}', 
			'identi' => 		sweet_dessert_get_protocol().'://identi.ca/notice/new?status_textarea={title} - {link}', 
			'juick' => 			sweet_dessert_get_protocol().'://www.juick.com/post?body={title} - {link}',
			'linkedin' => 		sweet_dessert_get_protocol().'://www.linkedin.com/shareArticle?mini=true&url={link}&title={title}', 
			'liveinternet' =>	sweet_dessert_get_protocol().'://www.liveinternet.ru/journal_post.php?action=n_add&cnurl={link}&cntitle={title}',
			'livejournal' =>	sweet_dessert_get_protocol().'://www.livejournal.com/update.bml?event={link}&subject={title}',
			'mail' =>			sweet_dessert_get_protocol().'://connect.mail.ru/share?url={link}&title={title}&description={descr}&imageurl={image}',
			'memori' =>			sweet_dessert_get_protocol().'://memori.ru/link/?sm=1&u_data[url]={link}&u_data[name]={title}', 
			'mister-wong' =>	sweet_dessert_get_protocol().'://www.mister-wong.ru/index.php?action=addurl&bm_url={link}&bm_description={title}', 
			'mixx' =>			sweet_dessert_get_protocol().'://chime.in/chimebutton/compose/?utm_source=bookmarklet&utm_medium=compose&utm_campaign=chime&chime[url]={link}&chime[title]={title}&chime[body]={descr}', 
			'moykrug' =>		sweet_dessert_get_protocol().'://share.yandex.ru/go.xml?service=moikrug&url={link}&title={title}&description={descr}',
			'myspace' =>		sweet_dessert_get_protocol().'://www.myspace.com/Modules/PostTo/Pages/?u={link}&t={title}&c={descr}', 
			'newsvine' =>		sweet_dessert_get_protocol().'://www.newsvine.com/_tools/seed&save?u={link}&h={title}',
			'odnoklassniki' =>	sweet_dessert_get_protocol().'://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl={link}&title={title}', 
			'pikabu' =>			sweet_dessert_get_protocol().'://pikabu.ru/add_story.php?story_url={link}',
			'pinterest' =>		sweet_dessert_get_protocol().'://pinterest.com/pin/create/button/?url={link}&media={image}&description={title}',
			'posterous' =>		sweet_dessert_get_protocol().'://posterous.com/share?linkto={link}&title={title}',
			'postila' =>		sweet_dessert_get_protocol().'://postila.ru/publish/?url={link}&agregator=sweet_dessert',
			'reddit' =>			sweet_dessert_get_protocol().'://reddit.com/submit?url={link}&title={title}', 
			'rutvit' =>			sweet_dessert_get_protocol().'://rutvit.ru/tools/widgets/share/popup?url={link}&title={title}', 
			'stumbleupon' =>	sweet_dessert_get_protocol().'://www.stumbleupon.com/submit?url={link}&title={title}', 
			'surfingbird' =>	sweet_dessert_get_protocol().'://surfingbird.ru/share?url={link}', 
			'technorati' =>		sweet_dessert_get_protocol().'://technorati.com/faves?add={link}&title={title}', 
			'tumblr' =>			sweet_dessert_get_protocol().'://www.tumblr.com/share?v=3&u={link}&t={title}&s={descr}', 
			'twitter' =>		'https://twitter.com/intent/tweet?text={title}&url={link}',
			'vk' =>				sweet_dessert_get_protocol().'://vk.com/share.php?url={link}&title={title}&description={descr}',
			'vk2' =>			sweet_dessert_get_protocol().'://vk.com/share.php?url={link}&title={title}&description={descr}',
			'webdiscover' =>	sweet_dessert_get_protocol().'://webdiscover.ru/share.php?url={link}',
			'yahoo' =>			sweet_dessert_get_protocol().'://bookmarks.yahoo.com/toolbar/savebm?u={link}&t={title}&d={descr}',
			'yandex' =>			sweet_dessert_get_protocol().'://zakladki.yandex.ru/newlink.xml?url={link}&name={title}&descr={descr}',
			'ya' =>				sweet_dessert_get_protocol().'://my.ya.ru/posts_add_link.xml?URL={link}&title={title}&body={descr}',
			'yosmi' =>			sweet_dessert_get_protocol().'://yosmi.ru/index.php?do=share&url={link}'
			)
		);

	}
}


/* Social Share and Profile links
-------------------------------------------------------------------------------- */

// Add social network
// Example: 1) add_share_link('pinterest', 'url');
//			2) add_share_link(array('pinterest'=>'url', 'dribble'=>'url'));
if (!function_exists('sweet_dessert_add_share_link')) {
	function sweet_dessert_add_share_link($soc, $url='') {
		if (!is_array($soc)) $soc = array($soc => $url);
		sweet_dessert_storage_set('share_links', array_merge( sweet_dessert_storage_get('share_links'), $soc ) );
	}
}

// Return (and show) share social links
if (!function_exists('sweet_dessert_show_share_links')) {
	function sweet_dessert_show_share_links($args) {
		if ( sweet_dessert_get_custom_option('show_share')=='hide' ) return '';

		$args = array_merge(array(
			'post_id' => 0,						// post ID
			'post_link' => '',					// post link
			'post_title' => '',					// post title
			'post_descr' => '',					// post descr
			'post_thumb' => '',					// post featured image
			'size' => 'tiny',					// icons size: tiny|small|big
			'style' => sweet_dessert_get_theme_setting('socials_type')=='images' ? 'bg' : 'icons',	// style for show icons: icons|images|bg
			'type' => 'block',					// share block type: list|block|drop
			'popup' => true,					// open share url in new window or in popup window
			'counters' => sweet_dessert_get_custom_option('show_share_counters')=='yes',	// show share counters
			'direction' => sweet_dessert_get_custom_option('show_share'),				// share block direction
			'caption' => sweet_dessert_get_custom_option('share_caption'),				// share block caption
			'share' => sweet_dessert_get_theme_option('share_buttons'),					// list of allowed socials
			'echo' => true						// if true - show on page, else - only return as string
			), $args);

		if (count($args['share'])==0) return '';
		$empty = false;
		foreach ($args['share'] as $k=>$v) {
			if (!is_array($v) || implode('', $v)=='') 
				$empty = true;
			break;
		}
		if ($empty) return '';
		
		$upload_info = wp_upload_dir();
		$upload_url = $upload_info['baseurl'];

		$output = '<div class="sc_socials sc_socials_type_icons sc_socials_shape_round sc_socials_size_'.esc_attr($args['size']).' sc_socials_share' . ($args['type']=='drop' ? ' sc_socials_drop' : ' sc_socials_dir_' . esc_attr($args['direction'])) . '">'
			. ($args['caption']!='' ? '<span class="share_caption">'.($args['caption']).'</span>' : '');

		if (is_array($args['share']) && count($args['share']) > 0) {
			foreach ($args['share'] as $soc) {
				$icon = $args['style']=='icons' || sweet_dessert_strpos($soc['icon'], $upload_url)!==false ? $soc['icon'] : sweet_dessert_get_socials_url(basename($soc['icon']));
				if ($args['style'] == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $parts[0];
				} else {
					$sn = basename($soc['icon']);
					$sn = sweet_dessert_substr($sn, 0, sweet_dessert_strrpos($sn, '.'));
					if (($pos=sweet_dessert_strrpos($sn, '_'))!==false)
						$sn = sweet_dessert_substr($sn, 0, $pos);
				}
				$url = $soc['url'];
				if (empty($url)) $url = sweet_dessert_storage_get_array('share_links', $sn);
			
				$link = str_replace(
					array('{id}', '{link}', '{title}', '{descr}', '{image}'),
					array(
						urlencode($args['post_id']),
						urlencode($args['post_link']),
						urlencode(strip_tags($args['post_title'])),
						urlencode(strip_tags($args['post_descr'])),
						urlencode($args['post_thumb'])
						),
					$url);
				$output .= '<div class="sc_socials_item' . (!empty($args['popup']) ? ' social_item_popup' : '') . '">'
						. '<a href="'.esc_url($soc['url']).'"'
						. ' class="social_icons social_'.esc_attr($sn).'"'
						. ($args['style']=='bg' ? ' style="background-image: url('.esc_url($icon).');"' : '')
						. ($args['popup'] ? ' data-link="' . esc_url($link) .'"' : ' target="_blank"')
						. ($args['counters'] ? ' data-count="'.esc_attr($sn).'"' : '') 
					. '>'
					. ($args['style']=='icons' 
						? '<span class="' . esc_attr($soc['icon']) . '"></span>' 
						: ($args['style']=='images' 
							? '<img src="'.esc_url($icon).'" alt="'.esc_attr($sn).'" />' 
							: '<span class="sc_socials_hover" style="background-image: url('.esc_url($icon).');"></span>'
							)
						)
					. '</a>'
					. ($args['type']=='drop' ? '<i>' . trim(sweet_dessert_strtoproper($sn)) . '</i>' : '')
					. '</div>';
			}
		}
		$output .= '</div>';
		if ($args['echo']) sweet_dessert_show_layout($output);
		return $output;
	}
}


// Return social icons links
if (!function_exists('sweet_dessert_prepare_socials')) {
	function sweet_dessert_prepare_socials($list, $style='') {
		if (empty($style)) $style = sweet_dessert_get_theme_setting('socials_type')=='images' ? 'bg' : 'icons';
		$output = '';
		$upload_info = wp_upload_dir();
		$upload_url = $upload_info['baseurl'];
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $soc) {
				if (empty($soc['url'])) continue;
				$cur_style = $style=='icons' && sweet_dessert_strpos($soc['icon'], $upload_url)!==false ? 'bg' : $style;
				$icon = $cur_style=='icons' || sweet_dessert_strpos($soc['icon'], $upload_url)!==false ? $soc['icon'] : sweet_dessert_get_socials_url(basename($soc['icon']));
				if ($cur_style == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $parts[0];
				} else {
					$sn = basename($soc['icon']);
					$sn = sweet_dessert_substr($sn, 0, sweet_dessert_strrpos($sn, '.'));
					if (($pos=sweet_dessert_strrpos($sn, '_'))!==false)
						$sn = sweet_dessert_substr($sn, 0, $pos);
				}
				$output .= '<div class="sc_socials_item' . (sweet_dessert_strpos($soc['icon'], $upload_url)!==false ? ' sc_socials_item_custom' : '') . '">'
						. '<a href="'.esc_url($soc['url']).'" target="_blank" class="social_icons social_'.esc_attr($sn).'"'
						. ($cur_style=='bg' ? ' style="background-image: url('.esc_url($icon).');"' : '')
						. '>'
						. ($cur_style=='icons' 
							? '<span class="icon-' . esc_attr($sn) . '"></span>' 
							: ($cur_style=='images' 
								? '<img src="'.esc_url($icon).'" alt="" />' 
								: '<span class="sc_socials_hover" style="background-image: url('.esc_url($icon).');"></span>'))
						. '</a>'
						. '</div>';
			}
		}
		return $output;
	}
}
	
	
/* Twitter
-------------------------------------------------------------------------------- */

if (!function_exists('sweet_dessert_get_twitter_data')) {
	function sweet_dessert_get_twitter_data($cfg) {
		return function_exists('trx_utils_twitter_acquire_data') 
				? trx_utils_twitter_acquire_data(array(
						'mode'            => 'user_timeline',
						'consumer_key'    => $cfg['consumer_key'],
						'consumer_secret' => $cfg['consumer_secret'],
						'token'           => $cfg['token'],
						'secret'          => $cfg['secret']
					))
				: '';
	}
}

if (!function_exists('sweet_dessert_prepare_twitter_text')) {
	function sweet_dessert_prepare_twitter_text($tweet) {
		$text = $tweet['text'];
		if (!empty($tweet['entities']['urls']) && count($tweet['entities']['urls']) > 0) {
			foreach ($tweet['entities']['urls'] as $url) {
				$text = str_replace($url['url'], '<a href="'.esc_url($url['expanded_url']).'" target="_blank">' . ($url['display_url']) . '</a>', $text);
			}
		}
		if (!empty($tweet['entities']['media']) && count($tweet['entities']['media']) > 0) {
			foreach ($tweet['entities']['media'] as $url) {
				$text = str_replace($url['url'], '<a href="'.esc_url($url['expanded_url']).'" target="_blank">' . ($url['display_url']) . '</a>', $text);
			}
		}
		return $text;
	}
}

// Return Twitter followers count
if (!function_exists('sweet_dessert_get_twitter_followers')) {
	function sweet_dessert_get_twitter_followers($cfg) {
		$data = sweet_dessert_get_twitter_data($cfg); 
		return $data && isset($data[0]['user']['followers_count']) ? $data[0]['user']['followers_count'] : 0;
	}
}



/* Facebook
-------------------------------------------------------------------------------- */

if (!function_exists('sweet_dessert_get_facebook_likes')) {
	function sweet_dessert_get_facebook_likes($account) {
		$fb = get_transient("facebooklikes");
		if ($fb !== false) return $fb;
		$fb = '?';
		$url = esc_url(sweet_dessert_get_protocol().'://graph.facebook.com/'.($account));
		$headers = get_headers($url);
		if (sweet_dessert_strpos($headers[0], '200')) {
			$json = sweet_dessert_fgc($url);
			$rez = json_decode($json, true);
			if (isset($rez['likes']) ) {
				$fb = $rez['likes'];
				set_transient("facebooklikes", $fb, 60*60);
			}
		}
		return $fb;
	}
}


// Add facebook meta tags for post/page sharing
if (!function_exists('sweet_dessert_facebook_og_tags')) {
	function sweet_dessert_facebook_og_tags() {
		global $post;
		if ( !is_singular() || sweet_dessert_storage_get('blog_streampage')) return;
		if (has_post_thumbnail( $post->ID )) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>' . "\n";
		}
	}
}


/* Feedburner
-------------------------------------------------------------------------------- */

if (!function_exists('sweet_dessert_get_feedburner_counter')) {
	function sweet_dessert_get_feedburner_counter($account) {
		$rss = get_transient("feedburnercounter");
		if ($rss !== false) return $rss;
		$rss = '?';
		$url = esc_url(sweet_dessert_get_protocol().'://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.($account));
		$headers = get_headers($url);
		if (sweet_dessert_strpos($headers[0], '200')) {
			$xml = sweet_dessert_fgc($url);
			preg_match('/circulation="(\d+)"/', $xml, $match);
			if ($match[1] != 0) {
				$rss = $match[1];
				set_transient("feedburnercounter", $rss, 60*60);
			}
		}
		return $rss;
	}
}
?>