<?php
	include_once( 'config.php' );
	$back_to_js_structure = '';
	$append_structure = '';
	$x = 0;
	$active_tab = 'html';
	if($_POST)
	{
		session_start();
		$html = stripslashes($_POST['html_code']);
		$css = $_POST['css_code'];
		$js = stripslashes($_POST['js_code']);
		$onload = $_POST['onload'];
		$comments = $_POST['comments_code'];
		$add_to = $_POST['add_to'];

		$select_array = array($onload);
		$left_js_array = array_diff($js_array,$select_array);
		$left_positions = array_diff($js_on_load_position,array($add_to));

		$active_tab = $_POST['active_tab'];

		foreach($js_libs as $key => $value){
			$js_lib_to_add = $js_libs[$onload];
		}

		foreach($js_onReadyFunctions as $key => $value){
			$js_onready_to_add = $js_onReadyFunctions[$onload];
			$js_onready_with_code = str_replace('** CODE **',$js,$js_onready_to_add);
		}
		
		if(isset($_POST['jsfile_php']) && !empty($_POST['jsfile_php']))
		{
			foreach($_POST['jsfile_php'] as $external_files)
			{
				$pieces = explode("/", $external_files);
				$file_name = end($pieces);
				$file_type_break = explode('.',$file_name);
				if(end($file_type_break) == 'css')
				{
					$file_structure = '<link rel="stylesheet" href="'.$external_files.'" />';
				}
				if(end($file_type_break) == 'js')
				{
					$file_structure = '<script type="text/javascript" src="'.$external_files.'"></script>';
				}
				$back_to_js_structure .= '<li><a href="'.$external_files.'" target="_blank">'.$file_name.'</a><input type="hidden" name="jsfile_php[]" value="'.$external_files.'"/><span class="cross">x</span></li>';
				$append_structure .= '<!-- EXTERNAL FILES -->'.$file_structure. '<!-- END EXTERNAL FILES -->';
				$x++;
			}
		}
		else
		{
			$append_structure = '';
			$back_to_js_structure = '';
		}

		if(!empty($js))
		{
			$js_block = 
			'
<!-- START JS CODE -->
<script type="text/javascript">
	'.$js_onready_with_code.'
</script>
<!-- END JS CODE -->
			';
		}
		else
		{
			$js_block = '';
		}

		if(!empty($css))
		{
			$css_block = 
			'
<!-- START CSS CODE -->
<style type="text/css">
	'.$css.'
</style>
<!-- END CSS CODE -->
			';
		}
		else
		{
			$css_block = '';
		}

		if(!empty($comments))
		{
$comments_block = '
<!--
** START USER COMMENTS **
'.$comments.'
** END USER COMMENTS **
-->';
		}
		else{
			$comments_block = '';
		}
		$dir = 'axjQMP/';
		$username = $_POST['filename'];
		if(empty($username))
		{
			$username = $dir.strtotime("now").'.html';
		}
		$filename = $username;
		$filehandle = fopen($filename, 'w') or die("can't open file");

$html_structure = '
'.$comments_block.'
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">';
$html_structure	.=
$js_lib_to_add
.$append_structure;
if($add_to == 'Inside Head')
{
	$html_structure .= $js_block;
}

$html_structure	.= $css_block.'
</head>
<body>
'.$html;
if($add_to == 'Before Body Closing Tag')
{
	$html_structure .= $js_block;
}
$html_structure	.='
</body>
</html>';

	$_SESSION['mashed_code'] = $html_structure;
	$_SESSION['js_library'] = $js_lib_to_add;
	$_SESSION['external_libraries'] = $append_structure;
	$_SESSION['playground_js'] = $js;
	$_SESSION['playground_css'] = $css;
	$_SESSION['playground_html'] = $html;
	$_SESSION['playground_comments'] = $comments;
	$_SESSION['selected_js_lib'] = $onload;
	$_SESSION['existing_external_libs'] = $back_to_js_structure;
	$_SESSION['external_libs_count'] = $x;
	$_SESSION['active_tab'] = $active_tab;
	$_SESSION['js_default_position'] = $add_to;

	fwrite($filehandle,$html_structure);
	fclose($filehandle);
}
?>