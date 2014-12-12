<?php
session_start();
$_SESSION["history"][]=array();
//dwadal;
?>

<html>
<head>
<title>rate1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<!-- 
建立form介面，內容包含
a. 借款金額 
b. 利率 
c. 期數 
d. 還款天數
e. 計算鈕
f. 新增還款鈕        
-->
<form action="rate2.php" method="post" name="form1" >
借款：<input name="cost" type="text" value="">元<br>
利率：<input name="rate" type="text" value="" >%<br>
期數：<input name="m" type="text" value="" ><br>
還款天數：<input name="day" type="text" value="" >天<p>
<input  name="submit" type="submit" value="計算">
</form>


</body>
</html>

