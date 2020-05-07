(function(l){

var statusTimer = true,
    ajaxPath = 'Ajax.php',
    ajaxPage = 'Chat';

l.stopTimer = function()
{
    statusTimer = false;
}

l.continueTimer = function()
{
    statusTimer = true;
}

l.updateChat = function()
{
    if(!statusTimer)
    {
        return;
    }

    $.post(ajaxPath, {page: ajaxPage, action: 'update'}, function(response){

    });
}

l.sendMessage = function()
{
    var message = $('#text').val();

    if(!message)
    {
        return;
    }

    $.post(ajaxPath, {page: ajaxPage, message: message, action: 'send'}, function(response){

    });
}

l.init = function()
{
    setInterval(l.updateChat, 1000);
}

l.init();

})(window.CHAT);