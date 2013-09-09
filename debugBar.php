<?php

require "vendor/autoload.php";
use DebugBar\StandardDebugBar;
use DebugBar\Renderer\JavascriptRenderer;

$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();

$debugbar["messages"]->addMessage("hello world!");
?>
<html>
<head>
    <?php echo $debugbarRenderer->renderHead() ?>
</head>
<body>
...
<?php echo $debugbarRenderer->render() ?>
</body>
</html>

