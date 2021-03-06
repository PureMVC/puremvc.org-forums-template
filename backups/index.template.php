<?php
// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '1.1';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = false;

	/* Use plain buttons - as oppossed to text buttons? */
	$settings['use_buttons'] = false;

	/* Show sticky and lock status seperate from topic icons? */
	$settings['seperate_sticky_lock'] = false;
}

// The main sub template above the content.
function template_main_above() {
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	?>
<!doctype html public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<meta http-equiv="Content-Style-Type" content="text/css"/>

	<meta name="description" content="PureMVC is a free Open Source Model-View-Controller Framework. It has implementations for nearly every major development platform including ActionScript (Flex, Flash, FlashLite Mobile, AIR), C# (.NET, Windows Mobile, Silverlight), ColdFusion, Java (Standard, Mobile and Enterprise Editions, Servlets, Applets, JavaFX), PHP, Python (wxPython, Google App Engine)"/>
	<meta name="keywords" content="PureMVC, Design Patterns, MVC, ActionScript, AS2, AS3, Flash, Flex, AIR,.NET, Python, C#, ColdFusion, Tamarin, Mozilla, Adobe, RIA, Rich Internet Applications, Software Development, Java, J2EE, Flex, GUI, UI, GUI Design, UI Design, User Interface, Google App Engine"/>
	<meta name="robots" content="index, follow"/>

	<script type="text/javascript" src="/Themes/default/script.js?fin11"></script>

	<link rel="shortcut icon" href="http://puremvc.org/images/favicon.ico"/>
	
	<link rel="stylesheet" href="http://puremvc.org/templates/js_element_blue/css/template_css.css" media="screen" type="text/css"/>
	<link rel="alternate stylesheet" href="http://puremvc.org/templates/js_element_blue/css/800.css" type="text/css" title="fluid"/>
<script language="javascript" type="text/javascript" src="http://puremvc.org/templates/js_element_blue/js/styleswitcher.js"></script>

<?php echo 
	'<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";
	// ]]></script>
	<title>', $context['page_title'], '</title>
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style.css?fin11" />
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/print.css?fin11" media="print" />';

	/* Internet Explorer 4/5 and Opera 6 just don't do font sizes properly. (they are big...)
		Thus, in Internet Explorer 4, 5, and Opera 6 this will show fonts one size smaller than usual.
		Note that this is affected by whether IE 6 is in standards compliance mode.. if not, it will also be big.
		Standards compliance mode happens when you use xhtml... */
	if ($context['browser']['needs_size_fix'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/fonts-compat.css" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" target="_blank" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name'], ' - RSS" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="' . $scripturl . '?board=' . $context['current_board'] . '.0" />';

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'];
?>
	</head>
<body id="pagebg" onload="PreloadFlag = true;">
<script type="text/javascript">js_init();</script>
	<div id="twrap">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="maintable">
			<tr>
				<td rowspan="4" valign="top" id="leftshadow"><img src="http://puremvc.org/templates/js_element_blue/images/tl.png" alt="topleft" width="5" height="145"/>
				</td>
				<td colspan="1" valign="top" id="headerblock">
					<div id="headercontainer">
						<div id="header">
							<div id="logo"><h1><a href="http://puremvc.org/index.php?option=com_frontpage&amp;Itemid=1" title="PureMVC">PureMVC</a></h1>
							</div>
							<div id="accessbuttons">
								<div class="access"><a href="index.php" title="Increase Text Size" onClick="changeFontSize(1);return false;"><img src="http://puremvc.org/templates/js_element_blue/images/larger.png" alt="larger" width="20" height="20" border="0"/></a><a href="index.php" title="Decrease Text Size" onClick="changeFontSize(-1);return false;"><img src="http://puremvc.org/templates/js_element_blue/images/smaller.png" alt="smaller" width="17" height="17" border="0"/></a><a href="index.php" title="Revert text styles to default" onClick="revertStyles(); return false;"><img src="http://puremvc.org/templates/js_element_blue/images/reset.png" alt="reset" width="20" height="20" border="0"/></a><a href="index.php?option=com_rss&amp;feed=RSS2.0&amp;no_html=1" title="RSS Syndicate" id="rss"><img src="http://puremvc.org/templates/js_element_blue/images/rssicon.png" alt="larger" width="20" height="20" border="0"/></a><a href="http://futurescale.com" title="Futurescale, Inc." id="futurescale"><img src="http://puremvc.org/templates/js_element_blue/images/fs-icon-button.png" alt="Futurescale, Inc." width="20" height="20" border="0"/></a>
									<ul id="theme">
										<li id="theme-fixed"><a href="#" onClick="setActiveStyleSheet('', 1);return false;" title="Switch to fixed-width version"><img src="http://puremvc.org/templates/js_element_blue/images/fixed.png" width="20" height="20" alt="fixed-width"/></a></li>
										<li id="theme-fluid"><a href="#" onClick="setActiveStyleSheet('fluid', 1);return false;" title="Switch to fluid-width version"><img src="http://puremvc.org/templates/js_element_blue/images/fluid.png" width="20" height="20" alt="fluid-width"/></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div id="navcontainer">
							<div id="navbar">
								<ul id="mainlevel">
									<li><a href="http://puremvc.org/component/option,com_frontpage/Itemid,1/" class="mainlevel" id="active_menu">Home</a></li>
									<li><a href="http://puremvc.org/content/view/67/178/" class="mainlevel">About</a></li>
									<li><a href="http://trac.puremvc.org/PureMVC" class="mainlevel">Code</a></li>
									<li><a href="http://puremvc.org/content/view/98/189/" class="mainlevel">Docs</a></li>
									<li><a href="http://puremvc.org/content/section/3/188/" class="mainlevel">FAQ</a></li>
									<li><a href="http://forums.puremvc.org" class="mainlevel">Forums</a></li>
									<li><a href="http://puremvc.org/content/category/1/1/181/" class="mainlevel">News</a></li>
									<li><a href="http://puremvc.org/content/blogsection/9/176/" class="mainlevel">Showcase</a></li>
									<li><a href="http://puremvc.org/component/option,com_contact/Itemid,3/" class="mainlevel">Contact</a></li>
									<li><a href="http://jobs.puremvc.org/" class="mainlevel">Jobs</a></li>
								</ul>
							</div>
						</div>
					</div>
				</td>
				<td rowspan="4" valign="top" id="rightshadow"><img src="http://puremvc.org/templates/js_element_blue/images/tr.png" alt="topright" width="5" height="145"/>
				</td>
			</tr>

			<tr>
				<td id="main" align="center">
					<table width="99%" align="center">
	<tr><td>
				<?php

	// The logo, user information, news, and menu.
	echo '<br />
	<table cellspacing="0" cellpadding="4" border="0" align="center" class="tborder">
		<tr style="background-color: #ffffff;">
			<td valign="middle" align="center">';

	// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '
				', $txt['hello_member'], ' <b>', $context['user']['name'], '</b>', $context['allow_pm'] ? ', ' . $txt[152] . ' <a href="' . $scripturl . '?action=pm">' . $context['user']['messages'] . ' ' . ($context['user']['messages'] != 1 ? $txt[153] : $txt[471]) . '</a>' . $txt['newmessages4'] . ' ' . $context['user']['unread_messages'] . ' ' . ($context['user']['unread_messages'] == 1 ? $txt['newmessages0'] : $txt['newmessages1']) : '', '.';

		// Are there any members waiting for approval?
		if (!empty($context['unapproved_members']))
			echo '<br />
				', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'];

		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '<br />
				<b>', $txt[616], '</b>';
	}
	// Otherwise they're a guest - so politely ask them to register or login.
	else
		echo '
				', $txt['welcome_guest'];

	echo '
				<br />', $context['current_time'], '
			</td>
		</tr>
		<tr class="windowbg2">
			<td valign="middle" align="center">';

	// Show the menu here, according to the menu sub template.
	template_menu();

	echo '
			</td>
		</tr>';

	// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '
		<tr class="windowbg2">
			<td height="24" align="center">
				<b>', $txt[102], ':</b> ', $context['random_news_line'], '
			</td>
		</tr>';

	echo '
	</table>

	<br />
	<table cellspacing="0" cellpadding="10" border="0" align="center" class="tborder">
		<tr><td valign="top" style="background-color: #ffffff;">';

?>

				
<?php
}


function template_main_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
		</td></tr>
	</table>';

	// Show a vB style login for quick login?
	if ($context['show_quick_login'])
	{
		echo '
	<table cellspacing="0" cellpadding="0" border="0" align="center">
		<tr><td nowrap="nowrap" align="right">
			<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/sha1.js"></script>

			<form action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '"', empty($context['disable_login_hashing']) ? ' onsubmit="hashLoginPassword(this, ¥'' . $context['session_id'] . '¥');"' : '', '><br />
				<input type="text" name="user" size="7" />
				<input type="password" name="passwrd" size="7" />
				<select name="cookielength">
					<option value="60">', $txt['smf53'], '</option>
					<option value="1440">', $txt['smf47'], '</option>
					<option value="10080">', $txt['smf48'], '</option>
					<option value="43200">', $txt['smf49'], '</option>
					<option value="-1" selected="selected">', $txt['smf50'], '</option>
				</select>
				<input type="submit" value="', $txt[34], '" /><br />
				', $txt['smf52'], '
				<input type="hidden" name="hash_passwrd" value="" />
			</form>
		</td></tr>
	</table>';
	}

	// Don't show a login box, just a break.
	else
		echo '
	<br />';

	// Show the "Powered by" and "Valid" logos, as well as the copyright.  Remember, the copyright must be somewhere!
	echo '
	<br />

	<table cellspacing="0" cellpadding="3" border="0" align="center">
		<tr>
			<td valign="middle" align="center">
				', theme_copyright(), '
			</td>
		</tr>
	</table>';

	// Show the load time?
	if ($context['show_load_time'])
		echo '
	<div align="center" class="smalltext">
		', $txt['smf301'], $context['load_time'], $txt['smf302'], $context['load_queries'], $txt['smf302b'], '
	</div>';

	// The following will be used to let the user know that some AJAX process is running
	echo '
	<div id="ajax_in_progress" style="display: none;', $context['browser']['is_ie'] && !$context['browser']['is_ie7'] ? 'position: absolute;' : '', '">', $txt['ajax_in_progress'], '</div>';

	?></td>
			</tr>
		</table>
		</td>
			</tr>
		</table>
		<div id="footerbar">
			<div class="rightcorner">
			</div>
		</div>
	</div>
	<div class="designer">
		<a href="http://futurescale.com" title="Futurescale, Inc.">Copyright ｩ 2006-2008 Futurescale, Inc.</a>
	</div>
<script type="text/javascript"><!-- // --><![CDATA[
			window.addEventListener("load", smf_codeFix, false);
			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = 0; i < codeFix.length; i++)
				{
					if (codeFix[i].className == "code" && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0))
						codeFix[i].style.overflow = "scroll";
				}
			}
		// ]]></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1967942-5");
pageTracker._trackPageview();
</script>	
</body>
</html>
<?php
}

// Show a linktree.  This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{
	global $context, $settings, $options;

	// Folder style or inline?  Inline has a smaller font.
	echo '<span class="nav"', $settings['linktree_inline'] ? ' style="font-size: smaller;"' : '', '>';

	// Each tree item has a URL and name.  Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		// Show the | | |-[] Folders.
		if (!$settings['linktree_inline'])
		{
			if ($link_num > 0)
				echo str_repeat('<img src="' . $settings['images_url'] . '/icons/linktree_main.gif" alt="| " border="0" />', $link_num - 1), '<img src="' . $settings['images_url'] . '/icons/linktree_side.gif" alt="|-" border="0" />';
			echo '<img src="' . $settings['images_url'] . '/icons/folder_open.gif" alt="+" border="0" />&nbsp; ';
		}

		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo '<b>', $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '" class="nav">' . $tree['name'] . '</a>' : $tree['name'], '</b>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo $settings['linktree_inline'] ? ' &nbsp;|&nbsp; ' : '<br />';
	}

	echo '</span>';
}

// Show the menu up top.  Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	// Show the [home] and [help] buttons.
	echo '
				<a href="', $scripturl, '">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/home.gif" alt="' . $txt[103] . '" border="0" />' : $txt[103]), '</a>', $context['menu_separator'], '
				<a href="', $scripturl, '?action=help">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/help.gif" alt="' . $txt[119] . '" border="0" />' : $txt[119]), '</a>', $context['menu_separator'];

	// How about the [search] button?
	if ($context['allow_search'])
		echo '
				<a href="', $scripturl, '?action=search">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/search.gif" alt="' . $txt[182] . '" border="0" />' : $txt[182]), '</a>', $context['menu_separator'];

	// Is the user allowed to administrate at all? ([admin])
	if ($context['allow_admin'])
		echo '
				<a href="', $scripturl, '?action=admin">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/admin.gif" alt="' . $txt[2] . '" border="0" />' : $txt[2]), '</a>', $context['menu_separator'];

	// Edit Profile... [profile]
	if ($context['allow_edit_profile'])
		echo '
				<a href="', $scripturl, '?action=profile">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/profile.gif" alt="' . $txt[79] . '" border="0" />' : $txt[467]), '</a>', $context['menu_separator'];

	// The [calendar]!
	if ($context['allow_calendar'])
		echo '
				<a href="', $scripturl, '?action=calendar">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/calendar.gif" alt="' . $txt['calendar24'] . '" border="0" />' : $txt['calendar24']), '</a>', $context['menu_separator'];

	// If the user is a guest, show [login] and [register] buttons.
	if ($context['user']['is_guest'])
	{
		echo '
				<a href="', $scripturl, '?action=login">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/login.gif" alt="' . $txt[34] . '" border="0" />' : $txt[34]), '</a>', $context['menu_separator'], '
				<a href="', $scripturl, '?action=register">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/register.gif" alt="' . $txt[97] . '" border="0" />' : $txt[97]), '</a>';
	}
	// Otherwise, they might want to [logout]...
	else
		echo '
				<a href="', $scripturl, '?action=logout;sesc=', $context['session_id'], '">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/logout.gif" alt="' . $txt[108] . '" border="0" />' : $txt[108]), '</a>';
}

// Generate a strip of buttons, out of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $buttons, $context, $txt, $scripturl;

	if (empty($button_strip))
		return '';

	// Create the buttons...
	foreach ($button_strip as $key => $value)
	{
		if (isset($value['test']) && empty($context[$value['test']]))
		{
			unset($button_strip[$key]);
			continue;
		}
		elseif (!isset($buttons[$key]) || $force_reset)
			$buttons[$key] = '<a href="' . $value['url'] . '" ' .( isset($value['custom']) ? $value['custom'] : '') . '>' . ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . ($value['lang'] ? $context['user']['language'] . '/' : '') . $value['image'] . '" alt="' . $txt[$value['text']] . '" border="0" />' : $txt[$value['text']]) . '</a>';

		$button_strip[$key] = $buttons[$key];
	}

	echo '
		<td ', $custom_td, '>', implode($context['menu_separator'], $button_strip) , '</td>';

}
?>
