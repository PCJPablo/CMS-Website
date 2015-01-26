<!DOCTYPE html>
	<html>
		<head>
			<title>
			
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href='../index.php?page=<?php echo $_POST['idwebpage'] ?>'>back</a><br>
		<?php
        require "../../Business/Article.php";

        echo Article::removeArticle($_POST['idarticle']);
		?>
	</body>
	</html>