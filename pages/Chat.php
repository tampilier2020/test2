<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Chat</title>
    <script type="text/javascript">window.CHAT = {};</script>
    <script type="text/javascript" src="js/libs/jq.js"></script>
    <script type="text/javascript" src="js/Chat.js"></script>
</head>

<body class="area">
    <h1 align="center">Chat</h1>
    <div align="center">
        Name: <input type="text" id="login" maxlength="50" />
    </div>
    <div align="center">
        <input type="button" value="Start" onclick="CHAT.continueTimer();" />
        <input type="button" value="Stop" onclick="CHAT.stopTimer();" />
    </div>

    <div align="left">
        <ul id="list"></ul>
    </div>
    <div align="center">
        <input type="text" id="text" maxlength="5000" /> <input type="button" value="Send" onclick="CHAT.sendMessage();" />
    </div>
</body>
</html>