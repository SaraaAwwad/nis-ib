<!DOCTYPE html>
<html>
<head>
</head>

<body>

<div>
<?php 
if($page!=""){
        $html = $page->html;
        echo htmlspecialchars_decode(stripslashes($html));
    }
?>
</div>
</body>
</html>