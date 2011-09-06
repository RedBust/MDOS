<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="MDOS est un botnet à but éducatif non lucratif exploitant des failles de serveur HTTP." />
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, education, test, slowloris, ralentir, site, pirate, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="<?php echo $url; ?>" />
    <meta name="robots" content="Index,Follow" />
    <meta name="language" content="fr" />
    <meta http-equiv="imagetoolbar" content="no" />
    <?php echo $special_data; ?>
</head>

<body bgcolor="#FFFFFF">
<div id = "userbar" align = "right">
<a id = "contact" href = "mailto:&#114;&#101;&#100;&#098;&#117;&#115;&#116;&#064;&#104;&#111;&#116;&#109;&#097;&#105;&#108;&#046;&#102;&#114;">contact&nbsp;</a>
<a id = "forum" href = "">forum&nbsp;</a>
</div>
<div id = "postbar"><hr size = "1px" color = "#34BEED"</div>
<div id = "logo"><a  href = "<?php echo $url ?>" ><img src="template/<?php echo $default_theme; ?>/logo_final.png" alt = "MDOS"></a></div>
<div id = "bar"></div>

<?php switch($info_tab): ?>
<?php case "attack": ?>
<div id = "tab"><img src = "template/<?php echo $default_theme; ?>/attacktab.png" id = "tabimg"></div>
<div id = "active"><img src = "template/<?php echo $default_theme; ?>/attaque_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "template/<?php echo $default_theme; ?>/client_a.png" onmouseover = "this.src='template/<?php echo $default_theme; ?>/client_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/client_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "template/<?php echo $default_theme; ?>/log_a.png"  onmouseover = "this.src='template/<?php echo $default_theme; ?>/log_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/log_a.png'"></a></div>
<form id = "contener" method="post" action = "#">
<textarea name="textinput" id = "textinput"></textarea>
<div id = "buttonbar">
<img src = "template/<?php echo $default_theme; ?>/check.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'check'">
<img src = "template/<?php echo $default_theme; ?>/attack.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'attack'">
<img src = "template/<?php echo $default_theme; ?>/else.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'else {'">
<img src = "template/<?php echo $default_theme; ?>/}.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + '}'">
<img src = "template/<?php echo $default_theme; ?>/{.png" id = "subbar" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + '{'">
<img src = "template/<?php echo $default_theme; ?>/restart.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'restart'">
<img src = "template/<?php echo $default_theme; ?>/resynchronize.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'resynchronize'">
<img src = "template/<?php echo $default_theme; ?>/vegetate.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'check'"></div>
</br>
<div id = "send">
<input border=0 src="template/<?php echo $default_theme; ?>/send.png" type="image" name = "update" value = "update" align="middle">
</div>
</form>
<?php break;?>
<?php case "zomb": ?>
<div id = "tab"><img src = "template/<?php echo $default_theme; ?>/zombtab.png" id = "tabimg"></div>
<div id = "active"><img src = "template/<?php echo $default_theme; ?>/client_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=attack"><img src = "template/<?php echo $default_theme; ?>/attaque_a.png"  onmouseover = "this.src='template/<?php echo $default_theme; ?>/attaque_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/attaque_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "template/<?php echo $default_theme; ?>/log_a.png"  onmouseover = "this.src='template/<?php echo $default_theme; ?>/log_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/log_a.png'"></a></div>
<?php break;?>
<?php case "log": ?>
<div id = "tab"><img src = "template/<?php echo $default_theme; ?>/logtab.png" id = "tabimg"></div>
<div id = "active"><img src = "template/<?php echo $default_theme; ?>/log_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=attack"><img src = "template/<?php echo $default_theme; ?>/attaque_a.png"  onmouseover = "this.src='template/<?php echo $default_theme; ?>/attaque_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/attaque_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "template/<?php echo $default_theme; ?>/client_a.png" onmouseover = "this.src='template/<?php echo $default_theme; ?>/client_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/client_a.png'"></a></div>
<div id = "logdata">
<div id = "loglist"><?php echo $htmlog;?>
<div id = "splitbar"><hr size = "1px" color = "#34BEED" width = "70%"></div>
<div id = "clearlog" onclick = 'window.location.replace("user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log&act=clear");'></div>
</div>
</div>
<?php break;?>
<?php default: ?>
<div id = "tab"><img src = "template/<?php echo $default_theme; ?>/attacktab.png" id = "tabimg"></div>
<div id = "active"><img src = "template/<?php echo $default_theme; ?>/attaque_c.png" id = ""></div>
<div id = "notactive"><a  href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "template/<?php echo $default_theme; ?>/client_a.png" onmouseover = "this.src='template/<?php echo $default_theme; ?>/client_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/client_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "template/<?php echo $default_theme; ?>/log_a.png"  onmouseover = "this.src='template/<?php echo $default_theme; ?>/log_h.png'" onmouseout = "this.src = 'template/<?php echo $default_theme; ?>/log_a.png'"></a></div>
<?php break;?>
<?php endswitch ?>
</body>
</html>