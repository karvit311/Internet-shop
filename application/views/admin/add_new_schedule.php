<?php 
    // use \Application\models\Curier;
    // include('application/models/Curier.php');
    include('application/models/Region.php');
    include('application/models/Schedule.php');
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
    	<meta charset = "UTF-8" name = "viewport" content = "width=device-width, initial-scale=1"/>
    	<title>Inserting Data into MySQL Database using PHP, AJAX, JQuery</title>
    </head>
    <body>
    	<h2 class="admin-add-new-schedule">Добавить новую поездку</h2>
    	<div id="post_form">
            <ul id="add_new_curier_or_region"> 
                <li>
                    <form method="post">
                        <br>
                        <input type="text" id="new_curier"><br>
                        <button type="button" id="add_new_curier">Добавить нового курьера</button>
                    </form> 
                </li>
                <li>
                    <form method="post">
                        <br>
                        <input type="text" id="new_region"><br>
                        <button type ="button"  id="add_new_region">Добавить новый регион доставки</button>
                    </form> 
                    <br> 
                </li>
            </ul>
    		<form method="post" id="add_new_schedule_form">	
                <br>
                <label>Курьер:</label>
                <?php $curier = new \Application\models\Curier();
                    $list = $curier->get_curiers();?>
                    <select id="curier" name="curier"><?php
                        foreach($list as $test) {
                            echo '<option name="'.$test["name"].'" id="'.$test["name"].'">'. $test["name"].'</option>';
                        } ?>
                    </select>
                <br>
                <label>Регион:</label>
                <?php $region = new \Application\models\Region();
                $list = $region->get_regions();?>
                <select id="region" name="region"><?php
                    foreach($list as $test) {
                        echo '<option name="'.$test["name"].'" id="'.$test["name"].'">'. $test["name"].'</option>';
                    } ?>
                </select><br>
                <label>Дата:</label>
                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <div class='input-group date admin-add-new-schedule-datetimepicker1' id='datetimepicker1'>
                                    <input type='text' class="form-control"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="time_in_road"></div>
    			<button type ="button"  id="add_post">Добавить новую поездку</button>
            </form>	
    		<br>
    	</div>
        <h2 class="admin-add-new-schedule-h2-all-trips">Все поездки:</h2>
    	<div id ="result"></div>
        <div id ="result_display"></div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker1').datetimepicker();
    });
</script>