<?

/*
 * Index Page for ScummVM
 * by Jeremy Newman <jnewman@dracowulf.com>
 *
 */

// set this for position of this file relative
$file_root = ".";

// load libraries
require($file_root."/include/"."incl.php");

// start of html
html_header("ScummVM");
sidebar_start();

// display welcome table
// don't show this if we are in news mode
if (!$shownews)
{

// Grab list of images from screenshot dir
// and loop through them and add to $shots array
$shots = array();
$images = get_files($file_root."/screenshots","png");
while (list($key,$image) = each($images))
{
        if (ereg("big",$image))
          continue;
        array_push($shots,$image);
}

// counter vars
$total = (count($shots) - 1);
srand((double) microtime() * 1000000);
$randImg = rand(0,$total);

echo html_round_frame_start("About ScummVM","98%","",20);
?>
	<table width="100%" border=0 cellpadding=10 cellspacing=0>
	<tr valign="top">
	  <td width="100%">
		<p>
		  <big><b>What is <font color=green>Scumm</font>VM?</b></big><br>
		  <? echo html_line(); ?>
		</p>

		<p>
		ScummVM is a 'virtual machine' for several classic graphical point-and-click adventure
		games. It is designed to run <a href="http://www.adventuresoft.com">Adventure Soft</a>'s
		<i>Simon the Sorcerer</i> 1 and 2, <a href="http://www.revolution.co.uk">Revolution</a>'s
		<i>Beneath A Steel Sky</i>, and games based on <a href="http://www.lucasarts.com">LucasArts</a>' <font
		color="green">S.C.U.M.M</font> <font color="#666666">(<i>Script Creation Utility for Maniac
		Mansion</i>)</font> system. <font color="green">S.C.U.M.M</font> is used for many games,
		including <i>Monkey Island</i>, <i>Day of the Tentacle</i>, <i>Sam and Max</i> and more.
		Compatability with supported games is continually improving, so check back often.
		</p>
		<p>
		Our forum and IRC channel, <a href="irc://irc.freenode.net/scummvm">#scummvm on
		irc.freenode.net</a>, are open for comments and suggestions. Please read our FAQ
		before posting, particularly regarding support for other adventure games.
		</p>
	  </td>
	  <td>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td>
			<script type="text/javascript">i_jn=<?=$randImg?>;</script>
			<a href="javascript:openWin('./screenshots/big_scummvm_'+i_jn+'.png','scummvm',640,400);"
			onMouseOver="window.status='Click to View Full Size Image';return true;"
			onMouseOut="window.status='';return true;"><img
			src="./screenshots/scummvm_<?=$randImg?>.png" border=0 hspace=5 width=256 height=160
			vspace=5 name="img_jn" alt="Click to view Full Size"></a>
		</td></tr>
		<tr><td>
			<table width="100%" border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td align=left>
				  <a href="javascript:scrshot_jn(<?=$total?>,0);"><img
				  src="./images/back.gif" border=0 width=43 height=23 alt="back"></a>
				</td>
				<td align=right>
				  <a href="javascript:scrshot_jn(<?=$total?>,1);"><img
				  src="./images/next.gif" border=0 width=38 height=23 alt="next"></a>
				</td>
			</tr>
			</table>
		</td></tr>
		</table>
	  </td>
	</tr>
	</table>
<?
echo html_round_frame_end("&nbsp;"),html_br();
}
// end of welcome table

//display News
echo html_round_frame_start("Latest Developments","98%","",20);
echo html_frame_start("","100%",1,1);

// get list of news items
$news = get_files($file_root."/news","xml");
$news = array_reverse ($news);

// loop and display news
$c = 0;
while (list($key,$item) = each($news))
{
	$c++;
	
	// display news item
	$arr = split("\.",$person);
	
	echo html_frame_tr(
			    html_frame_td(
			    		   display_xml($file_root."/news/".$item,'IMG').
					   "<p><big><b><font color=\"#666666\">".display_xml($file_root."/news/".$item,'DATE')."</font>: ".
					   display_xml($file_root."/news/".$item,'NAME')."</b></big><br>\n".
					   html_line()."</p>\n"."<blockquote>\n".
					   display_xml($file_root."/news/".$item,'BODY')."</blockquote>\n".
					   html_p()
			                 )
	                  );
	
	
	// only show 5 records
	if ($c == 4 && !$shownews)
	{
		echo html_frame_tr(
			           html_frame_td(
			                         '<p>[<a href="?shownews=archive">More News...</a>]</p>'."\n"
					        )
				  );
		break;
	}
} // end of news loop

echo html_frame_end();
echo html_round_frame_end("&nbsp;");
//end of news display

// end of html
echo html_p();
sidebar_end();
html_footer();

?>
