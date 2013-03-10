<?php
	/* CONFIGRATION FILE FOR TUTLAGE PLAYGROUND */
	
	/* 
		** FOLLOWING ARE THE REQUIRED ARRAY TO ADD DIFFERENT JS LIBRARIES LIKE JQUERY, MOOTOOLS ETC **
	*/
	
	/* Libraries names you want to include */
	
	$js_array = array(
		'Plain Javascript',
		'Jquery',
		'MooTools',
		'Prototype',
		'YUI3.6',
		'Dojo',
		'ExtJs'
	);


	/* Source of the above libraries with their names as array key */

	$js_libs = array(
		'Plain Javascript' => '',
		'Jquery' => '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>',
		'MooTools' => '<script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>',
		'Prototype' => '<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>',
		'YUI3.6' => '<script src="http://yui.yahooapis.com/3.6.0/build/yui/yui-min.js"></script>',
		'Dojo' => '<script src="//ajax.googleapis.com/ajax/libs/dojo/1.8.0/dojo/dojo.js"></script>',
		'ExtJs' => '<script src="//ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js"></script>'
	);

	/* Onready function for the above keys with their names as array key */

	$js_onReadyFunctions = array(
		'Plain Javascript' => '** CODE **',
		'Jquery' => "$(function(){** CODE **})",
		'MooTools' => "window.addEvent('domready', function() {** CODE **})",
		'Prototype' => "document.observe('dom:loaded', function() {** CODE **})",
		'YUI3.6' => 'YUI().use("node", function(Y){ Y.on("domready", function(){** CODE **});})',
		'Dojo' => "dojo.addOnLoad(function(){** CODE **})",
		'ExtJs' => "Ext.onReady(function(){** CODE **})"
	);
	/*  Array to decide where to load js code ( It can inside head OR before body closing tag */
	$js_on_load_position = array('Inside Head','Before Body Closing Tag');
?>