function loadToIFrame(url) {
	mainFrame.location.href = url;
}

$(document).ready( function() {
	$("#nav").click( function() {
		//$("#header").slideToggle(600);
	});

	// show and hide menu
	$('a#slick-toggle').toggle( function() {
		hideMenuControl();
	}, function() {
		showMenuControl();
	});

});

var menuControlStatus = "show";

function showMenuControl(){
	$('#sidebar').fadeIn('fast');
	//$('#main').css("margin-left","204px");
	//margin-left: 207px;
	$('#main').width('80%');
	$('a#slick-toggle').text('<< Hide Menu');
	menuControlStatus = "show";
} 
function hideMenuControl(){ 
	$('#sidebar').hide();
	$('#main').width('100%');
	//$('#main').css("margin-left","0px");
	$('a#slick-toggle').text('Show Menu >>');
	menuControlStatus = "hidden";
}

function isMenuControlShow(){
	return menuControlStatus=="show"?true:false;   
}


function autoIframe(frameId) {
	try {
		frame = document.getElementById(frameId);
		innerDoc = (frame.contentDocument) ? frame.contentDocument
				: frame.contentWindow.document;
		objToResize = (frame.style) ? frame.style : frame;
		objToResize.height = innerDoc.body.scrollHeight + 10;
	} catch (err) {
		window.status = err.message;
	}
}
