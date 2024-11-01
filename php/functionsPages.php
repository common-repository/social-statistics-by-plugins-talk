<?php

function ptssAboutStyle () {
?>
	<style>
		@font-face
		{
			font-family: pluginsTalkFont;
			src: url('<?php echo PTSS_BASE_URL.'/assets/pluginsTalk.ttf'; ?>');
		} 
		#ptssMainContent {
			font-family: pluginsTalkFont,century gothic, Segoe UI Light, Segoe UI, open sans, arial;
			font-size: 16px;
		}
		.menu_toggle {
			padding:15px 15px 15px 15px;
			color: black;
			cursor: pointer;
			font-size:22px;	
		}
		.menu_toggle a {
			color: black;
			text-decoration: none;
		}
		.toggle_content {
			padding:15px 15px 15px 15px;
			overflow: hidden;
			font-size: 16px;
			letter-spacing: 1px;
		}
		.toggle_content a {
			text-decoration: none;
		}
		.toggle_content button {
			padding: 4px 10px;
		}
	</style>
<?php	
}


function ptssStyle () {
?>
	<style>
		.ptssCenter {
			text-align: center;
		}
		.slider-outer {
			width: 94px;
			height: 27px;
			overflow: hidden;
		}
		.slider {			
			width: 147px;
			height: 27px;
		}
		.tablesorter a {
			text-decoration: none;
		}		
	</style>
<?php
}

function ptssShowHelp () {
?>
<br></br>
<div class="menu_toggle" style="background:#fec7ff"><a href="http://dev.pluginstalk.com/contact-us" target="_blank">Need Any Help & Support?</a></div>
	<div class="toggle_content" style="background:#fec7ff">
		<p>
			Don&#8217;t know how to use the plugin? Or do you have any problem using our plugin?<br/>
			Just leave a comment on <a href="http://dev.pluginstalk.com/social-statistics" target="_blank">this page</a> or you can directly <a href="http://dev.pluginstalk.com/contact-us" target="_blank">contact us by email</a> ( contact@pluginstalk.com )
		</p>
	</div>
<?php
}

function ptssGetTweetCount($url)
{
    $twitterEndpoint = "http://urls.api.twitter.com/1/urls/count.json?url=%s";
    $fileData = file_get_contents(sprintf($twitterEndpoint, $url));
    $json = json_decode($fileData, true);
    unset($fileData);
    return $json['count'];
}

function ptssPinterestCount($url)
{
    $pinterestAPIurl = "http://api.pinterest.com/v1/urls/count.json?callback=&url=%s";
    $fileData = file_get_contents(sprintf($pinterestAPIurl, $url));
	$fileData = str_replace( "(", "", $fileData);
	$fileData = str_replace( ")", "", $fileData);
	$fileData = str_replace( "receiveCount", "", $fileData);
    $json = json_decode($fileData, true);
    unset($fileData);
    return $json['count'];
}

function ptssLinkedInCount($url)
{
    $linkedinAPIurl = "http://www.linkedin.com/countserv/count/share?url=%s&format=json";
    $fileData = file_get_contents(sprintf($linkedinAPIurl, $url));
    $json = json_decode($fileData, true);
    unset($fileData);
    return $json['count'];
}

function ptssShowSocialStatistics() {
	if( isset( $_GET['show'] ) || true ) {
		$facebook = true;
		$twitter = true;
		$pinterest = true;
		$linkedin = true;
		
		if( isset( $_GET['facebook'] ) ) {
			$facebook = true;
		}
		if( isset( $_GET['twitter'] ) ) {
			$twitter = true;
		}
		if( isset( $_GET['pinterest'] ) ) {
			$pinterest = true;
		}
		if( isset( $_GET['linkedin'] ) ) {
			$linkedin = true;
		}		
		
	global $post;
	$args = array( 'numberposts' => -1, 'orderby' => 'post_date' );
	$postslist = get_posts( $args );
	$counter=1;
?>
		<h2>Get Social Statistics Of Each Post</h2>
		<br />
		<table border=0 cellpadding=5 cellspacing=0 id="ptssTable" class="tablesorter">
		<thead style="cursor:pointer"> 
		<tr> 
			<td class="ptssCenter" colspan="3"><!--Just click on the headings to sort it. Hold shift for multiple sorting :)--></td> 
			<?php if( $facebook ) { ?>
			<td class="ptssCenter" colspan="4"><img src="<?php echo PTSS_BASE_URL.'/images/facebook-logo.jpg'; ?>" border="0" /></td> 
			<?php } ?>
			<?php if( $twitter ) { ?>
			<td class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/twitter-logo.jpg'; ?>" border="0" /></td>
			<?php } ?>
			<?php if( $pinterest ) { ?>
			<td class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/pinterest-logo.jpg'; ?>" border="0" /></td>
			<?php } ?>
			<?php if( $linkedin ) { ?>
			<td class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/linkedin-logo.jpg'; ?>" border="0" /></td>
			<?php } ?> 
		</tr> 
		<tr> 
			<th>#</th> 
			<th>Post ID</th> 
			<th>Post Title</th>
			<?php if( $facebook ) { ?>
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/facebook-total.jpg'; ?>" border="0" /></th> 
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/facebook-likes.jpg'; ?>" border="0" /></th> 
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/facebook-shares.jpg'; ?>" border="0" /></th> 
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/facebook-comments.jpg'; ?>" border="0" /></th> 
			<?php } ?>
			<?php if( $twitter ) { ?>
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/twitter-tweets.jpg'; ?>" border="0" /></th> 
			<?php } ?>
			<?php if( $pinterest ) { ?>
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/pinterest-pin.jpg'; ?>" border="0" /></th> 
			<?php } ?>
			<?php if( $linkedin ) { ?>
			<th class="ptssCenter"><img src="<?php echo PTSS_BASE_URL.'/images/linkedin-logo-small.jpg'; ?>" border="0" /></th>
			<?php } ?> 
		</tr> 
		</thead> 
		<tbody>
<?php
foreach ($postslist as $post) :  
	setup_postdata($post);
	$source_url = get_permalink( get_the_ID() );
	$source_url = urlencode( $source_url );
	$url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".$source_url;
	$xml = file_get_contents($url);
	$xml = simplexml_load_string($xml);
	$shares =  $xml->link_stat->share_count;
	$likes =  $xml->link_stat->like_count;
	$comments = $xml->link_stat->comment_count;
	$total = $xml->link_stat->total_count;
	
	$tweets = ptssGetTweetCount( $source_url );
	//$plusOne = ptssGetPlusone( $source_url ) ;
	$pins = ptssPinterestCount( $source_url ) ;
	$linkedinShares = ptssLinkedInCount( $source_url ) ;
?>
			<tr style="background:<?php if($counter%2==0){ echo '#f0f0f0'; } else { echo '#b2d6ff'; } ?>">
				<td><?php echo $counter; ?></td>
				<td><?php echo get_the_ID(); ?></td>
				<td><a href="/?p=<?php echo get_the_ID(); ?>" target="_blank"><?php the_title(); ?></a></td>
				<?php if( $facebook ) { ?>
				<td class="ptssCenter"><?php echo "$total"; ?></td>
				<td class="ptssCenter"><?php echo "$likes"; ?></td>
				<td class="ptssCenter"><?php echo "$shares"; ?></td>
				<td class="ptssCenter"><?php echo "$comments"; ?></td>
				<?php } ?>
				<?php if( $twitter ) { ?>
				<td class="ptssCenter"><?php echo "$tweets"; ?></td>
				<?php } ?>
				<?php if( $pinterest ) { ?>
				<td class="ptssCenter"><?php echo "$pins"; ?></td>
				<?php } ?>
				<?php if( $linkedin ) { ?>
				<td class="ptssCenter"><?php echo "$linkedinShares"; ?></td>
				<?php } ?>
			</tr>
<?php
	$counter=$counter+1;
endforeach;
?>
		</tbody>
		</table>

<?php
	}
}

/*
function ptssGetPlusone($url) {
 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    $curl_results = curl_exec ($curl);
    curl_close ($curl);
 
    $json = json_decode($curl_results, true);
 
    return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}
*/

function ptssShowHeader () {
?>
	<div style="overflow: hidden">
		<div style="height: 150px; float: left">
			<a href="http://pluginstalk.com" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/logo_x150.png' ?>" style="height: inherit;"></a>
		</div>
		<div style="float: right">
			<a href="https://www.PluginsTalk.com" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/visitWebsite.png' ?>"  border="0" width="163px"></a>
			<br />
			<a href="https://www.facebook.com/PluginsTalk" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/likeUsOnFacebook.png' ?>"  border="0"></a>
			<br />
			<a href="https://www.twitter.com/PluginsTalk" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/followUsOnTwitter.png' ?>"  border="0"></a>
		</div>
	</div>
<?php
}


function ptssShowLinkToUs () {
?>
	<div class="menu_toggle" style="background:#cac9ff">Link To Us</div>
	<div class="toggle_content" style="background:#cac9ff;">
		<p>
		If you like our articles, our work or our plugins and you want to join us through social media then we are available for you here also:
		<p>
		<p>
		<a href="https://www.facebook.com/PluginsTalk" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/likeUsOnFacebook.png' ?>"  border="0"></a> <a href="https://www.twitter.com/PluginsTalk" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/followUsOnTwitter.png' ?>"  border="0"></a> <a href="https://www.PluginsTalk.com" target="_blank"><img src="<?php echo PTSS_BASE_URL.'/images/visitWebsite.png' ?>"  border="0"></a>
		</p>
	</div>
<?php
}


function ptssShowAboutPluginsTalk () {
?>

<div style="overflow:hidden;">
	<div class="menu_toggle" style="background:#99fffb"><a href="http://pluginstalk.com" target="_blank">Something About PluginsTalk.com</a></div>
	<div class="toggle_content" style="background:#99fffb">
		<p><a href="http://pluginstalk.com" target="_blank">PluginsTalk.com</a> is just another website among all of the websites where we strive hard to provide you the detailed information about web browser&#8217;s plugins. The information we provide includes the steps of plugin installation, how does the plugin work, what are the settings of plugin and how we can use the plugin in most effective way. You'll find plugins which you already know about, which you use daily; with some new and most downloaded plugins. We tell about plugins of all major browsers like: Mozilla Firefox, Google Chrome, Safari, Opera & Internet Explorer.
		</p>
		<p>
		If you also know about some plugins which are cool and want to tell the world then you are always welcomed to write about the plugins. You can <a href="http://dev.pluginstalk.com/contact-us" target="_blank">contact us</a> for further information.
		</p>
		<p>
		<a href="http://pluginstalk.com" target="_blank">Click Here</a> to visit <a href="http://pluginstalk.com" target="_blank">PluginsTalk.com</a> and know more about it.
		</p>
	</div>
	<div class="menu_toggle" style="background:#a3ff99"><a href="http://dev.pluginstalk.com" target="_blank">About Our Developer&#8217;s Section</a></div>
	<div class="toggle_content" style="background:#a3ff99">
		<p>
		We do have a developer section where we tell the world about the plugins which we create, be it on any platform like WordPress or any web browser. Here in our developer&#8217;s section you can get help regarding any of our plugins just by leaving comment or contacting us.
		</p>
		<p>
		If you have any new plugin idea which you think is missing or is a paid service then you are free to provide us the actual requirements that you need through our <a href="http://dev.pluginstalk.com/contact-us" target="_blank">contact section</a>, and if we felt that its worth developing the plugin then we&#8217;ll develop it for the world (including you, obviously). In return your name will be written as a idea submitter in that plugin information section. And if you are lucky enough then you&#8217;ll might get special goodies or cash prizes.
		</p>
		<p>
		Are you a developer? Have you developed any plugin and you want to submit it? Or you want to develop the plugin for us and join our PluginsTalk team? Be it any case, you are always welcomed to <a href="http://dev.pluginstalk.com/contact-us" target="_blank">contact us</a> at any time for any reason.
		</p>
	</div>	
	<div class="menu_toggle" style="background:#ffc599">About The Developers</div>
	<div class="toggle_content" style="background:#ffc599">
		<p>
		We started with a very few developers in our team. With time our PluginsTalk team increased as many highly experienced and talented developers kept joining our team. Presently some of our developers are working on YouTube plugins and most of them working on WordPress & Joomla plugins.
		</p>
		<p>
		If you want to join our team and want to do something which you like, want to develop your own idea. You can <a href="http://dev.pluginstalk.com/contact-us" target="_blank">join us</a> at anytime.
		</p>
	</div>
	<div class="menu_toggle" style="background:#fec7ff"><a href="http://dev.pluginstalk.com/contact-us" target="_blank">Contact Us</a></div>
	<div class="toggle_content" style="background:#fec7ff">
		<p>
		We don&#8217;t believe that there must be a reason for someone to contact someone. If you just want to say "Hi!!" or you want to do some professional talking or you want to tell us your secrets or you might want to tell that your height is taller than one of our team member, whatever may be the reason you are always welcomed to contact us. We are always happy to hear from you. If everything goes normal then we&#8217;ll surely reply as soon as possible so that you won&#8217;t have to wait for next conversation to begin.
		</p>
		<p>
		Visit our <a href="http://dev.pluginstalk.com/contact-us" target="_blank">contact section</a> for communicating with us.
		</p>
	</div>
	<?php
		ptssShowLinkToUs ();
	?>
	
</div>
<?php
}

?>