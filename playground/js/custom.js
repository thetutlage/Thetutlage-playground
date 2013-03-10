$(function(){

	activeTab();

	$('#nav a').click(function(){
		$('.areaBox').removeClass('onTop');
		$('#nav a').removeClass('active');
		$(this).addClass('active');
		$('#'+$(this).attr("id")+"_area").addClass('onTop');
		$('#active_tab').val($(this).attr("id"));
		resizeCodeMirror();
		return false;
	});
	
	function activeTab(){
		var active_tab = $('#active_tab').val();
		$('.areaBox').removeClass('onTop');
		$('#nav a').removeClass('active');
		$('#nav a#'+active_tab).addClass('active');
		$('#'+(active_tab)+"_area").addClass('onTop');
		resizeCodeMirror();
	}

	$(window).resize(function(){
		resizeCodeMirror();
	});
	
	function resizeCodeMirror(){
		parentHeight = $('.areaBox').height();
		newParentHeight = parseInt(parentHeight) - 30;
		aboveParentHeight = parseInt(parentHeight) - 25;
		$('.CodeMirror-scroll').css("height",newParentHeight+"px");
		$('.textareaWrapper').css("height",aboveParentHeight+"px");
	}
	resizeCodeMirror();

	function deleteFiles(){
		$('#load').load('libs/delete.php');
	}
	deleteFiles();
	function loadExtenalResources(url){
		
		var regex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
		if(regex.test(url))
		{
			var add_file_name = url.substring(url.lastIndexOf('/') + 1);
			var type = add_file_name.split('.');
			var extension = type[type.length -1 ];
	
			if(extension == 'css' || extension == 'js')
			{
				$('#files_tab').append('<li><a href="'+url+'" target="_blank">'+add_file_name+'</a><input type="hidden" name="jsfile_php[]" value="'+url+'"/><span class="cross">x</span></li>');
			}
			else
			{
				alert('Only Js and Css files are allowed');
			}
		}
		else
		{
			alert('Pass in valid url');
		}
	}
	
	$('#add_js_css_file').click(function(){
		var add_file_name_url = $('#load_js_css_file').val();
		if(add_file_name_url.length == '')
		{
			alert('Enter valid file url');
		}
		else
		{
			loadExtenalResources(add_file_name_url);
		}
		return false;
	})
	
	function showPopUp(){
		$('.popUpdialog').show();
		$('.modal-backdrop').show();
	}

	function hidePopUp(){
		$('.popUpdialog').hide();
		$('.modal-backdrop').hide();
	}

	
	$('#add_ex_files').click(function(){
		showPopUp();
		return false;
	})
	
	$('.modal-backdrop').click(function(){
		hidePopUp();
	})
	
	$('#done_loading_external_sheets').click(function(){
		hidePopUp();
		return false;
	})
	
	$('.cross').live("click",function(){
		$(this).closest('li').remove();
	});
	
	if($.browser.msie){
		window.location = 'notsupported.html';
	}

	$(document).bind('keydown','ctrl+s',function(){
		document.codeRunner.submit();
		return false;
	});

	$(document).bind('keydown','alt+d',function(){
		Download();
		return false;
	});

	$(document).bind('keydown','alt+r',function(){
		show_confirm();
		return false;
	});
	$(document).bind('keydown','alt+a',function(){
		showPopUp();
		return false;
	});

	$('#outputWrapper').hover(function(){
		$('.fullscreen').animate({
			"opacity": 1
		});
	},function(){
		$('.fullscreen').animate({
			"opacity": 0
		});
	});
	
	$('.fullscreen').click(function(){
		if($(this).hasClass('off'))
		{
			fullScreen();
			$(this).addClass('on').removeClass('off');
		}
		else
		{
			exitfullScreen()
			$(this).addClass('off').removeClass('on');
		}
		return false;
	})
	
});

function show_confirm()
{
	var con = confirm("Resting playgrond will clear all the code. Do you wish to continue ?");
	if(con ==true)
	{
		window.location = 'reset.php';
	}
	else
	{
		return false;
	}
}

function Save(){
	document.codeRunner.submit();
}

function Download(){
	window.location = 'download.php';
}

function showPopUp(){
	$('.popUpdialog').show();
	$('.modal-backdrop').show();
}

function fullScreen(){
	$('#outputWrapper').css({
		"width": "100%",
		"left": 0,
		"top": 0
	});
	$('#compiler').css({
		"top": "0",
		"left": "0"
	});
	$('#editorWrapper').hide();
	$('#sidebar').hide();
}
function exitfullScreen(){
	$('#outputWrapper').css({
		"width": "50%",
		"left": "50%"
	});
	$('#compiler').css({
		"top": "40px",
		"left": "200px"
	});
	$('#editorWrapper').show();
	$('#sidebar').show();
}

