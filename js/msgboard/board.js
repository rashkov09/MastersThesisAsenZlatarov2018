var messageRefreshTo;
var usersRefreshTo;

/**************************************************************************************************/
function getLastMessageRow(){
    rows = document.getElementsByClassName('msgrow');
    return rows[0];
}
/**************************************************************************************************/
function refreshMessages(){
    lastid = getLastMessageRow().id;
    self = window.location.href.toString().split('?')[0];
    respondTo( self + '?msgid='+lastid,onUnreadMessages);
    clearTimeout(messageRefreshTo);
    messageRefreshTo = window.setTimeout( refreshMessages, 1000 );
}
/**************************************************************************************************/
function doInsertRowsBottom(messages){
    rows = document.getElementsByClassName('msgrow');
    lastRow = rows[rows.length-1];
    var div = document.createElement('table');
    div.innerHTML = messages;
    newnodes = div.getElementsByClassName('msgrow');
    tbod = lastRow.parentElement;
    console.log(' inserting ' + newnodes.length);
    while (newnodes.length>0){
	tbod.appendChild(newnodes[0]);
    }
    t1 = document.getElementById('chat');
    t1.scrollTo(0,t1.clientHeight);
}
/**************************************************************************************************/
function doInsertRows(messages){
    var div = document.createElement('table');
    div.innerHTML = messages;
    newnodes = div.getElementsByClassName('msgrow');
    lastRow = getLastMessageRow();
    tbod = lastRow.parentElement;
    while (newnodes.length>0){
	tbod.insertBefore(newnodes[0], lastRow);
    }
}
/**************************************************************************************************/
function onUnreadMessages(){
    if (http_request.readyState == 4) {
	if (http_request.status == 200) {
	    var messages = http_request.responseText;
	    messages = messages.trim();
	    if (messages.length==0){ return; }
	    doInsertRows(messages);
	}
    }
}
/**************************************************************************************************/
function sendMsg(){
    clearTimeout(messageRefreshTo);
    fld = document.getElementById('newmessage');
    newmsg = fld.value;
    fld.value='';
    self = window.location.href.toString().split('?')[0];
    console.log(self);
    makePOSTRequestNoResponse('k_board.php' , 'newmsg='+encodeURIComponent(newmsg));
    messageRefreshTo = window.setTimeout( refreshMessages, 1 );
}
/**************************************************************************************************/
function onUsersList(){
    if (http_request.readyState == 4) {
	if (http_request.status == 200) {
	    document.getElementById('post_footer').innerHTML = http_request.responseText;
	}
    }
}
/**************************************************************************************************/
function refreshUsers(){
    clearTimeout(messageRefreshTo);
    clearTimeout(usersRefreshTo);
    self = window.location.href.toString().split('?')[0];
    respondTo(self + '?active_sessions=1', onUsersList);
    usersRefreshTo = window.setTimeout( refreshUsers, 20000 );
    messageRefreshTo = window.setTimeout( refreshMessages, 1000 );
}
/**************************************************************************************************/