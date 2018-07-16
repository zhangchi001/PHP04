<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>图片显示</title>
 	<style>
			


			div{

				width:200px;
				height:200px;
				border:1px solid red;
				float:left;
				margin-left:8px;
			}
 	</style>
 </head>
 <body>
		
			<h2><?php echo ((isset($abc) && ($abc !== ""))?($abc):"游客"); ?></h2>



			<?php if(is_array($res)): foreach($res as $key=>$vo): ?><div>
				

				<?php if(!empty($vo["imgpath"])): ?><img src="/think04/Project/Shop/Public<?php echo ($vo["imgpath"]); ?>" alt=""><?php endif; ?>



				<?php if(empty($vo["imgpath"])): ?>没有图片<?php endif; ?>

				<h2><?php echo ($vo["nm"]); ?></h2>

			</div><?php endforeach; endif; ?>
 </body>
 </html>