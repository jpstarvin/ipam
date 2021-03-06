function openModal(url,action){
	window.showModalDialog(url, window, 'dialogWidth:500px;dialogHeight:500px;center:yes;resizable:yes;status:no;scrollbars:no;menubar:no;titlebar:no;toolbar:no;');
	if( action != "search")
		window.location.reload();			
}

function confirmDelete(url){
	if (confirm("Delete?"))
		location.href=url
}

function confirmNetworkDelete(url){
        if (confirm("This will delete all ipaddresses assigned to this network. Continue?"))
                location.href=url
}

function confirmNetgroupDelete(url){
        if (confirm("You must delete the networks in this group before deleting the netgroup or the delete will fail. Continue?"))
                location.href=url
}

function showNotificationBar(message, duration, bgColor, txtColor, height) {
 
    /*set default values*/
    duration = typeof duration !== 'undefined' ? duration : 1500;
    bgColor = typeof bgColor !== 'undefined' ? bgColor : "#F4E0E1";
    txtColor = typeof txtColor !== 'undefined' ? txtColor : "#A42732";
    height = typeof height !== 'undefined' ? height : 40;
    /*create the notification bar div if it doesn't exist*/
    if ($('#notification-bar').size() == 0) {
        var HTMLmessage = "<div class='notification-message' style='text-align:center; line-height: " + height + "px;'> " + message + " </div>";
        $('body').prepend("<div id='notification-bar' style='display:none; width:1024px; height:" + height + "px; background-color: " + bgColor + "; position: fixed; z-index: 100; color: " + txtColor + ";border-bottom: 1px solid " + txtColor + ";'>" + HTMLmessage + "</div>");
    }
    /*animate the bar*/
    $('#notification-bar').slideDown(function() {
        setTimeout(function() {
            $('#notification-bar').slideUp(function() {});
        }, duration);
    });
}


