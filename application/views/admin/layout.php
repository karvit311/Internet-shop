<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Главная</title>
	</head>
	<body>
    <div id="head-index">
        <ul id="head-list-my" class="list-group">
            <li class="dropdown list-group-item ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
            <li class="list-group-item">Our Workers</li>
            <li class="list-group-item"><a href="/main/products">Our products</a></li>
            <li class="list-group-item"><a href="/main/signup">Sign up</a></li>
        </ul>
        <br>
        <br>
        <hr >
    </div>
    <?php require_once(ROOT . '/application/views/'.$content_view);?>
	</body>
</html>