<?php include_once( 'libs/render.php' );?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Code Editor - Playground</title>
	<meta name="description" content="tutlage playground is an online code editor similar to jsfiddle and jsbin, it allows you to write and test your code right into browser" />
	<meta name="keywords" content="online code editor,test jsvascript online, html5 code editor,canvas browser editor" />
	<meta name="author" content="thetutlage" />
	<link rel="stylesheet" href="CodeMirror/lib/codemirror.css">
	<link rel="stylesheet" href="CodeMirror/theme/monokai.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="CodeMirror/lib/codemirror.js"></script>
	<script src="CodeMirror/lib/util/closetag.js"></script>
	<script src="CodeMirror/mode/javascript/javascript.js"></script>
	<script src="CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="CodeMirror/mode/css/css.js"></script>
	<script src="CodeMirror/mode/xml/xml.js"></script>
	<script src="CodeMirror/mode/php/php.js"></script>
	<script src="CodeMirror/mode/clike/clike.js"></script>
	<script type="text/javascript" src="js/hotkeys.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<link rel="stylesheet" href="css/playground.css" />
</head>
<body>
	<div id="bodyWrapper">
		<div class="modal-backdrop"></div>
		<div id="header">
		</div><!-- end header -->

		<form method="post" action="index.php" name="codeRunner">

			<div class="popUpdialog">
				<ul>
					<li><a href="#"> Add External Css And Js Files </a></li>
				</ul>
				<div class="popUpBody">
					<input type="text" name="load_js_css_file" placeholder="Add File Url Here" id="load_js_css_file" class="input_text"/>
					<a href="#" id="add_js_css_file" class="add_button"><span> + </span></a>
					<h2> Added Files </h2>
					<ul id="files_tab">
						<?php if(isset($_SESSION['existing_external_libs'])) { echo $_SESSION['existing_external_libs']; } ?>
					</ul>
					<br />
					<a href="#" class="button green" style="text-align:center;" id="done_loading_external_sheets"> I am Done </a>
				</div><!-- end popUpBody -->
			</div>


			<div id="sidebar">
				<h2 id="logo"><img src="images/logo.png" /><span class="contributor"> by Aman Virk </h2>
				<div id="interact">
					<a href="#" onclick="document.codeRunner.submit();return false;" class="button green"> Run <span class="icon play">CTRL + S</span></a>
					<?php if(isset($html_structure) && !empty($html_structure)) { ?> 
					<a href="#" onclick="show_confirm(); return false; " class="button red"> Reset <span class="icon">ALT + R</span></a>
					<a href="download.php" class="button fade"> Download <span class="icon">ALT + D</span></a>
					<?php } ?>
					<a href="#" class="button fade" id="add_ex_files"> Add Files <?php if(isset($_SESSION['external_libs_count']) && $_SESSION['external_libs_count'] != 0) { echo '<span class="resources_count">'.$_SESSION['external_libs_count'].'</span>'; }?><span class="icon">ALT + A</span></a>
				</div><!-- end interact -->
	
				<div id="info_copyright">
					<span class="official_logo">
						<a href="http://www.thetutlage.com" target="_blank"><img src="images/logo_footer.png" /></a>
					</span>
	
				</div>
			</div><!-- end sidebar -->

			<!-- SETTING USER FILE -->
			<input type="hidden" name="filename" value="<?php if(isset($username)) { echo $username; } ?>" id="filename"/>
			<input type="hidden" name="active_tab" value="<?php if(isset($_SESSION['active_tab'])) { echo $_SESSION['active_tab'];} else { echo 'html'; }?>" id="active_tab"/>
			<!-- SETTING USER FILE  -->

			<div id="compiler">
				<div id="editorWrapper" class="box">
					<div id="editor">
						<div id="codeplaceWrapper">
							<!-- CODE CLASS STARTS HERE -->
							<div id="html_area" class="areaBox onTop">
								<h2>Html
								</h2>
								<div class="textareaWrapper">
									<textarea id="html_code" name="html_code" class="codeEdtitor"><?php if(isset($_SESSION['playground_html'])) { echo $_SESSION['playground_html']; } ?></textarea>
								</div>
							</div><!-- end html -->
							<!-- END CODE CLASS STARTS HERE -->

							<!-- CODE CLASS STARTS HERE -->
							<div id="css_area" class="areaBox">
								<h2>CSS
								</h2>
								<div class="textareaWrapper">
									<textarea id="css_code" name="css_code" class="codeEdtitor"><?php if(isset($_SESSION['playground_css'])) { echo $_SESSION['playground_css']; } ?></textarea>
								</div>
							</div><!-- end css -->
							<!-- END CODE CLASS STARTS HERE -->

							<!-- CODE CLASS STARTS HERE -->
							<div id="comments_area" class="areaBox">
								<h2>Comments
								</h2>
								<div class="textareaWrapper">
									<textarea id="comments_code" name="comments_code" class="codeEdtitor"><?php if(isset($_SESSION['playground_comments'])) { echo $_SESSION['playground_comments']; } ?></textarea>
								</div>
							</div><!-- end css -->
							<!-- END CODE CLASS STARTS HERE -->

							<!-- REQUIRED TO DELETE UNWANTED FILES -->
							<div id="load"></div>
							<!-- REQUIRED TO DELETE UNWANTED FILES -->

							<!-- CODE CLASS STARTS HERE -->
							<div id="js_area" class="areaBox">
								<h2>Js
									<label for="Add To">OnLoad
									<select name="add_to" id="add_to">
										<?php
										if(isset($_SESSION['js_default_position']))
										{
											echo '<option value="'.$_SESSION['js_default_position'].'" selected="selected">'.$_SESSION['js_default_position'].'</option>';
											foreach($left_positions as $key => $value)
											{
												echo '<option value="'.$value.'">'.$value.'</option>';
											}
										}
										else
										{
											foreach($js_on_load_position as $key => $value)
											{
												echo '<option value="'.$value.'">'.$value.'</option>';
											}
										}
										?>
									</select>
									</label>

									<label for="Format">Format
										<select name="onload" id="onload">
											<?php
												if(isset($_SESSION['selected_js_lib'])){
													echo '<option value="'.$_SESSION['selected_js_lib'].'" selected="selected">'.$_SESSION['selected_js_lib'].'</option>';
													foreach($left_js_array as $key => $value)
													{
														echo '<option value="'.$value.'">'.$value.'</option>';
													}
												}
												else
												{
													foreach($js_array as $key => $value)
													{
														echo '<option value="'.$value.'">'.$value.'</option>';
													}
												}
											?>
										</select>
									</label>
								</h2>
								<div class="textareaWrapper">
									<textarea id="js_code" name="js_code" class="codeEdtitor"><?php if(isset($_SESSION['playground_js'])) { echo $_SESSION['playground_js']; } ?></textarea>
								</div>
							</div><!-- end css -->
							<!-- END CODE CLASS STARTS HERE -->
						</div><!-- end codePlaceWrapper -->
					</div><!-- end editor -->
					<div id="nav">
						<a href="#" id="html" class="active"> Html </a>
						<a href="#" id="css"> Css </a>
						<a href="#" id="js"> Js </a>
						<a href="#" id="comments"> Comments </a>
					</div><!-- end nav -->
				</div><!-- end editorWrapper -->
			</form>
				
			<div id="outputWrapper" class="test">
				<div class="frameArea">
					<iframe id="outputPreview" <?php if(isset($filename)) { echo 'src="'.$filename.'"'; } ?>></iframe>
				</div>
				
				<div id="outputNav">
					<strong>Output</strong>
				</div>
				<a href="#" class="fullscreen off"> Toogle FullScreen </a>
			</div>
			
		</div><!-- end compiler -->
	</div><!-- end bodyWrapper -->
	<script>
		   var editor = CodeMirror.fromTextArea(document.getElementById("js_code"), {
			mode: "javascript",
			lineWrapping: true,
			lineNumbers: true,
			extraKeys: {
				"Ctrl-S": function(instance) { Save() },
				"Alt-D": function(instance) { Download() },
				"Alt-R": function(instance) { show_confirm() },
				"Alt-A": function(instance) { showPopUp() }
			}
			});
			var editor = CodeMirror.fromTextArea(document.getElementById("html_code"), {
			mode: "text/html",
			lineWrapping: true,
			lineNumbers: true,
			extraKeys: {
				"'>'": function(cm) { cm.closeTag(cm, '>'); },
				"'/'": function(cm) { cm.closeTag(cm, '/'); },
				"Ctrl-S": function(instance) { Save() },
				"Alt-D": function(instance) { Download() },
				"Alt-R": function(instance) { show_confirm() },
				"Alt-A": function(instance) { showPopUp() }
			}
			});
			var editor = CodeMirror.fromTextArea(document.getElementById("css_code"), {
			mode: "css",
			lineWrapping: true,
			lineNumbers: true,
			extraKeys: {
				"Ctrl-S": function(instance) { Save() },
				"Alt-D": function(instance) { Download() },
				"Alt-R": function(instance) { show_confirm() },
				"Alt-A": function(instance) { showPopUp() }
			}
			});
			var editor = CodeMirror.fromTextArea(document.getElementById("comments_code"), {
			mode: "text/plain",
			lineWrapping: true,
			lineNumbers: true,
			extraKeys: {
				"Ctrl-S": function(instance) { Save() },
				"Alt-D": function(instance) { Download() },
				"Alt-R": function(instance) { show_confirm() },
				"Alt-A": function(instance) { showPopUp() }
			}
			});
	</script>
</body>
</html>
