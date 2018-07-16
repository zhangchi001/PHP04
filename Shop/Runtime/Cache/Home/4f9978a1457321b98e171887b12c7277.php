<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>图片上传</title>
 </head>
 <body>


 		<form action="/think04/Project/index.php/Home/Index/show" method="post" enctype="multipart/form-data">
			商品名:<input type="text" name="shopname" / ><br /><br />
			图片:  <input type="file" name="pic[]" /><br />
			图片:  <input type="file" name="pic[]" /><br />
			图片:  <input type="file" name="pic[]" /><br />
			图片:  <input type="file" name="pic[]" /><br />
			图片:  <input type="file" name="pic[]" /><br />
			图片:  <input type="file" name="pic[]" /><br />
			
			<br />
			<input type="submit" value="提交">

 		</form>
 	
 </body>
 </html>