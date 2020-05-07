"use strict";

(function(l){

var statusTimer = true,
    ajaxPath = 'Ajax.php',
    ajaxPage = 'Chat';

l.stopTimer = function()
{
    statusTimer = false;
};

l.continueTimer = function()
{
    statusTimer = true;
};

l.updateChat = function()
{
    if(!statusTimer)
    {
        return;
    }

    $.post(ajaxPath, {page: ajaxPage, action: 'update'}, function(data){
        var html = '';

        data = JSON.parse(data);
        if(data)
        {
            data.forEach(function(li){
                html += '<li>'+li.user+' ('+li.ip+'): '+li.message+'</li>';
            });
        }

        $('#list').html(html);
    });
};

l.sendMessage = function()
{
    var message = $('#text').val();
    var login = $('#login').val();

    if(!message || !login)
    {
        return;
    }

    $.post(ajaxPath, {page: ajaxPage, action: 'send', message: message, login: login}, function(data){
        l.updateChat();
    });
};

l.init = function()
{
    setInterval(l.updateChat, 1000);
};

l.init();

})(window.CHAT);