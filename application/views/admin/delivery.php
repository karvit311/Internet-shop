<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/site/index'>Поставки</a>";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Deliveries</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <?php
            if($_SESSION['admin'] = "admin"){
                if (isset($_SESSION['admin_role'])) {
                    if($_SESSION['admin_role'] == 'admin-delivery' || $_SESSION['admin_role'] == 'admin'){
                    ?>
                        <!-- ADDING SUCCESS-->
                        <div class="alert alert-success selecting-department alert-dismissable" style="display: none;" id="flash-msg-selecting-department-for-new-supplier">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>Department've  successfully added!</p>
                        </div>
                        <div id="left-block-search-deliveries-by-city" style="margin-left:-265px;margin-right:15px;margin-top:62px;float:left; border:1px solid #f3d6d6; width:270px;"><h4 style=" text-decoration: underline; ">Search deliveries by cities:</h4>
                            <?php
                                $cities = new \Application\models\Cities();
                                $res_cities = $cities->get_cities();
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="FormControlSearchDeliveriesByCity" style="  ">Cities:</label>
                                    <select class="form-control" id="FormControlSearchDeliveriesByCity">
                                        <option selected>Выбрать...</option>
                                        <?php foreach ($res_cities as $res_city){?>
                                            <option  city_id="<?= $res_city['id']; ?>"><?= $res_city['city'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <input type="button" style= "background:mistyrose; " id="left-block-search-by-city" value="Search" />
                            </form>
                        </div>
                        <div id="left-block-search-deliveries-by-supplier" style="margin-left:-285px;margin-top:247px;float:left; border:1px solid #f3d6d6; width:270px;"><h4 style="text-decoration: underline; ">Search deliveries by suppliers:</h4>
                            <?php
                            $suppliers = new \Application\models\Supplier();
                            $res_suppliers = $suppliers->get_suppliers();
                            ?>
                            <form method="post" class="left-block-search-by-supplier">
                                <div class="form-group">
                                    <label for="FormControlSearchDeliveriesBySupplier" style="  ">Suppliers:</label>
                                    <select class="form-control" id="FormControlSearchDeliveriesBySupplier">
                                        <option selected>Выбрать...</option>
                                        <?php foreach ($res_suppliers as $res_supplier){?>
                                            <option  supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['supplier'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <input type="button" style= "background:mistyrose; " value="Search" id="search_deliveries_by_suppliers"/>
                            </form>
                        </div>
                        <div id="left-block-search-deliveries-by-date" style="margin-left:-285px;margin-top:427px;float:left; border:1px solid #f3d6d6; width:270px;"><h4 style="text-decoration: underline; ">Search deliveries by date:</h4>
                            <form method="post" class="left-block-search-by-date">
                                <div class="form-group" >
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <input type="button" style= "background:mistyrose; " value="Search" id="search_deliveries_by_date"/>
                            </form>
                        </div>
                        <div id="left-block-add-new-supplier" style="float:left;margin-left:-285px;margin-top:553px;border:1px solid #f3d6d6; width:270px;padding:20px;">
                            <button id="add_new_supplier_left_block" class="btn-default" type="button" style="background:rosybrown;color:#d4cbcb;height:50px;', cursive, sans-serif"">Добавить нового поставщика</button>
                        </div>
                        <h2 style="margin-left:400px;  ">Deliveries for current week</h2>
                        <div id="department_for_new_supplier" class="modal">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Select department for new supplier</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <?php
                                            $departments = new \Application\models\Department();
                                            $res_departments = $departments->get_departments_parent('0');
                                            $res_departments->execute(array('0'));
                                        ?>
                                        <div id="department_add_new_supplierModal">
                                            <div style="border:1px solid #f3d6d6; padding: 5px;margin:22px;" class='col-sm-11' >
                                                <label for="SelectDepartment" style="margin-top:18px; ">Выбрать из существующих отделов:</label>
                                                <select class="form-control" id="SelectDepartment">
                                                    <option selected>Все отделы</option>
                                                    <?php foreach ($res_departments as $res_department){?>
                                                        <option id="department_select_modal" department_id="<?= $res_department['id']; ?>"><?= $res_department['department'];?></option>
                                                    <?php }?>
                                                </select>
                                                <div id="subDepartmentAddNewSupplierDepartment">
                                                    <label for="SelectSubDepartment" style="font-size:11px;">Выбрать подотдел:</label><a style="margin-top:30px;margin-right:3px;float:right;" href="#" ><span  class="glyphicon remove_sub_department glyphicon-remove-circle"></span></a>
                                                    <select class="form-control" id="SelectSubDepartment" style="width:90%;">
                                                        <option selected>Выбрать ...</option>
                                                    </select>
                                                </div>
                                                <div style="margin-top:20px;margin-bottom:7px;border:1px solid black;"></div>
                                                <p style="margin-left:235px;">ИЛИ</p>
                                                <div style="margin-top:10px;margin-bottom:17px;border:1px solid black;"></div>
                                                <div>
                                                    <label for="AddNewDepartment">Добавить новый отдел:</label>
                                                    <input type="text" name="department" id="AddNewDepartment" class="form-control" placeholder="Department of new supplier" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="add_new_department_in_new_supplier" id="add_new_department_in_new_supplier" class="btn btn-info" data-dismiss="modal" >Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add_new_supplier_Modal" class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Add new Supplier</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <?php
                                        $deliveries = new \Application\models\Delivery();
                                        $res_deliveries = $deliveries->get_deliveres();
                                        $suppliers = new \Application\models\Supplier();
                                        $res_suppliers = $suppliers->get_suppliers();
                                        ?>
                                        <form method="post" class="feedback" >
                                            <div class="form-group">
                                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 22px; " class="col-sm-5">
                                                    <label for="AddNewInputSupplier">New supplier:</label>
                                                    <input type="text" name="supplier" id="AddNewInputSupplier"  class="form-control" placeholder="new supplier" />
                                                    <label for="SelectNewSupplier" style="font-size:11px;">All suppliers:</label>
                                                    <select class="form-control" id="SelectNewSupplier">
                                                        <option selected>Все поставщики</option>
                                                        <?php foreach ($res_suppliers as $res_supplier){?>
                                                            <option id="supplier_select_modal" supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['supplier'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 22px; " class="col-sm-5">
                                                    <label for="AddNewInfoSupplier">Contacts of new supplier:</label>
                                                    <input type="text" name="info_supplier" id="AddNewInfoSupplier"  class="form-control" placeholder="Contacts of new supplier" />
                                                    <label for="SelectInfoNewSupplier" style="font-size:11px;">All contacts of suppliers:</label>
                                                    <select class="form-control" id="SelectInfoNewSupplier">
                                                        <option selected>Контакты всех поставщиков</option>
                                                        <?php foreach ($res_suppliers as $res_supplier){?>
                                                            <option id="info_supplier_select_modal" supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['info'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="add_new_supplier" id="add_new_supplier" class="btn btn-info" data-dismiss="modal" >Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="edit_delivery_Modal_by_city" class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit delivery</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <?php
                                        $deliveries = new \Application\models\Delivery();
                                        $res_deliveries = $deliveries->get_deliveres();
                                        $suppliers = new \Application\models\Supplier();
                                        $res_suppliers = $suppliers->get_suppliers();
                                        $departments = new \Application\models\Department();
                                        $res_departments = $departments->get_departments();
                                        ?>
                                        <form method="post" class="feedback" >
                                            <div class="form-group">
                                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 20px; " class="col-sm-5">
                                                    <label for="FormEditInputSupplier">Supplier:</label>
                                                    <input type="text" name="supplier" id="FormEditInputSupplier"  class="form-control" placeholder="Supplier" />
                                                    <label for="SelectEditInputSupplier" style="font-size:11px;">All suppliers:</label>
                                                    <select class="form-control" id="SelectEditInputSupplier">
                                                        <option selected>Выбрать другого поставщика</option>
                                                        <?php foreach ($res_suppliers as $res_supplier){?>
                                                            <option id="supplier_select_modal" supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['supplier'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div style="border:1px solid #f3d6d6;padding: 5px;margin:25px 20px;" class="col-sm-5">
                                                    <label for="FormEditInputAddress">Address:</label>
                                                    <input type="text" name="address" id="FormEditInputAddress" class="form-control" placeholder="Address" />
                                                    <label for="SelectEditInputAddress" style="font-size:11px;">All address:</label>
                                                    <select class="form-control" id="SelectEditInputAddress">
                                                        <option selected>Выбрать другой адресс</option>
                                                        <?php foreach ($res_deliveries as $res_delivery){?>
                                                            <option id="yes" delivery_id="<?= $res_delivery['id']; ?>" city_id="<?= $res_delivery['city_id']; ?>"><?= $res_delivery['address'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                     <div id="datetimepicker5" style="margin:20px;"></div>
                                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 20px" >
                                                    <label for="FormEditInputInfo">Contacts of supplier:</label>
                                                    <input type="text" name="info" id="FormEditInputInfo" class="form-control" placeholder="Info" />
                                                    <label for="SelectEditInputInfo" style="font-size:11px;">All contacts of suppliers:</label>
                                                    <select class="form-control" id="SelectEditInputInfo">
                                                        <option selected>Выбрать другую информацию</option>
                                                        <?php foreach ($res_suppliers as $res_supplier){?>
                                                            <option id="supplier_select_modal" supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['info'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div style="border:1px solid #f3d6d6;padding: 5px;margin:25px 20px;" >
                                                    <label for="FormEditInputDepartment">Department:</label>
                                                    <input type="text" name="department" id="FormEditInputDepartment" class="form-control" placeholder="Department" />
                                                    <label for="SelectEditInputDepartment" style="font-size:11px;">All departments:</label>
                                                    <select class="form-control" id="SelectEditInputDepartment">
                                                        <option selected>Выбрать другой отдел</option>
                                                        <?php foreach ($res_departments as $res_department){?>
                                                            <option id="yes" delivery_id="<?= $res_department['id']; ?>" ><?= $res_department['department'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="update_delivery" id="update_delivery" class="btn btn-info" data-dismiss="modal" >Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="change_delivery_Modal_by_city"  class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">All deliveries by city</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                            <table class="table table-dark">
                                                <thead>
                                                <tr>
                                                    <th>Supplier</th>
                                                    <th>Address</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Contacts of supplier</th>
                                                    <th>Department</th>
                                                    <th>Edit</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="change_delivery_Modal_by_supplier"  class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">All deliveries by supplier</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-dark" >
                                            <thead>
                                            <tr>
                                                <th>Supplier</th>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Contacts of supplier</th>
                                                <th>Department</th>
                                                <th>Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add_new_delivery_Modal"  class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Details of delivery(ies) for this day</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <?php
                                        $deliveries = new \Application\models\Delivery();
                                        $res_deliveries = $deliveries->get_deliveres();
                                        $suppliers = new \Application\models\Supplier();
                                        $res_suppliers = $suppliers->get_suppliers();
                                        ?>
                                        <form method="post" class="feedback" >
                                            <div class="form-group">
                                                <label for="FormControlInputAddress">Address:</label>
                                                <select class="form-control" id="FormControlInputAddress">
                                                    <option selected>Выбрать...</option>
                                                    <?php foreach ($res_deliveries as $res_delivery){?>
                                                    <option id="yes" delivery_id="<?= $res_delivery['id']; ?>" city_id="<?= $res_delivery['city_id']; ?>"><?= $res_delivery['address'];?></option>
                                                    <?php }?>
                                                </select>
                                                <label for="FormControlInputSupplier">Supplier:</label>
                                                <select class="form-control" id="FormControlInputSupplier">
                                                    <option selected>Выбрать...</option>
                                                    <?php foreach ($res_suppliers as $res_supplier){?>
                                                        <option id="supplier_select_modal" supplier_id="<?= $res_supplier['id']; ?>"><?= $res_supplier['supplier'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="add_new_delivery" id="add_new_delivery" class="btn btn-info" data-dismiss="modal" >Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="detail_by_time_Modal"  class="modal" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Details of delivery(ies) for this day</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-dark">
                                            <thead>
                                            <tr>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Supplier</th>
                                                <th>Contacts of supplier</th>
                                                <th>Department</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="modal_delivery_date_address"></td>
                                                <td class="modal_delivery_date_date"></td>
                                                <td class="modal_delivery_date_time"></td>
                                                <td class="modal_delivery_date_supplier"></td>
                                                <td class="modal_delivery_date_contacts_of_supplier"></td>
                                                <td class="modal_delivery_date_department"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="detailModal"  class="modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Details of delivery(ies) for this day</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-dark">
                                            <thead>
                                            <tr>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="modal_delivery_date_address"></td>
                                                <td class="modal_delivery_date_date"></td>
                                                <td class="modal_delivery_date_time"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover" style="width:95%;">
                            <thead>
                                <tr style="background: #ffcaca;">
                                    <th>День недели</th>
                                    <th class="day_of_week_monday " date="">Пн.</th>
                                    <th class="day_of_week_tuesday " date="">Вт.</th>
                                    <th class="day_of_week_wednesday " date="">Ср.</th>
                                    <th class="day_of_week_thursday " date="">Чт.</th>
                                    <th class="day_of_week_friday " date="">Пт.</th>
                                    <th class="day_of_week_saturday " date="">Сб.</th>
                                    <th class="day_of_week_sunday " date="">Вс.</th>
                                </tr>
                                <tr>
                                    <th style="background:rosybrown ">Город доставки</th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_monday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_tuesday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_wednesday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_thursday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_friday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_saturday" date=""></th>
                                    <th style="background: #ffcaca;" class="days_of_week day_of_week_sunday" date=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list_cities = new \Application\models\Cities();
                                $cities = $list_cities->get_cities();
                                foreach ($cities as $city){
                                    $list_deliveries_with_city = new \Application\models\Delivery();
                                    $deliveries_city = $list_deliveries_with_city->get_deliveres_conditionals_city_id($city['id']);
                                    $deliveries_city->execute(array($city['id']));
                                    foreach ($deliveries_city as $delivery_city) {
                                        $list_deliveries_with_date = new \Application\models\Delivery();
                                        $deliveries_date = $list_deliveries_with_date->get_deliveres_date_city_id($delivery_city['city_id'],$delivery_city['date']);
                                        $deliveries_date->execute(array($delivery_city['city_id'],$delivery_city['date']));
                                        foreach ($deliveries_date as $delivery) {
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td style="background:rosybrown" class="city_deliver"  time="" city_id="<?php echo $city['id'];?>" ><?= $city['city'];?></td>
                                        <td style="background:white" class="hour_delivery day_of_week_monday" time="" date="" city_id="<?= $city['id'];?>"></td>
                                        <td style="background:#f9eaea" class="hour_delivery day_of_week_tuesday" time="" date="" city_id="<?= $city['id'];?>"></td>
                                        <td style="background:white" class="hour_delivery day_of_week_wednesday" time="" date="" city_id="<?= $city['id'];?>"></td>
                                        <td style="background: #f9eaea" class="hour_delivery day_of_week_thursday" id="" time="" city_id="<?= $city['id'];?>"></td>
                                        <td style="background:white" class="hour_delivery day_of_week_friday" time="" id=""city_id="<?= $city['id'];?>"></td>
                                        <td style="background: #f9eaea" class="hour_delivery day_of_week_saturday" time="" id="" city_id="<?= $city['id'];?>"></td>
                                        <td style="background:white" class="hour_delivery day_of_week_sunday" time="" id="" city_id="<?= $city['id'];?>"></td>
                                    </tr>
                                <?php
                                }?>
                            </tbody>
                        </table>
                        <div style="border:1px solid #f3d6d6;">
                            <h2 style="margin-left:400px;  ">Add new deliveries</h2>
                            <!-- ADDING SUCCESS-->
                            <div class="alert alert-success adding-delivery alert-dismissable" style="display: none;" id="flash-msg-adding-delivery">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i>Success!</h4><p>Delivery've  successfully added!</p>
                                <p><table class="table table-hover"><tr><th>Address</th><th>Date</th><th>Time</th><th>Supplier</th><th>Contacts of supplier</th><th>Department</th></tr>
                                    <tr><td id="address_alert_adding_delivery"></td><td id="date_alert_adding_delivery"></td><td id="time_alert_adding_delivery"></td><td id="supplier_alert_adding_delivery"></td><td id="contacts_of_supplier_alert_adding_delivery"></td><td id="department_alert_adding_delivery"></td></tr></table></p>
                            </div>
                            <form  method="post" id="form1">
                                <div style="overflow:hidden;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div id="datetimepicker4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" style="margin-left:1000px; margin-bottom:15px;background:mistyrose; " value="Add new delivery" id="form_datetimepicker4"/>
                            </form>
                        </div>
                    <?php
                    }else{?>
                        <!-- ERROR PRIVILEGE-->
                        <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование поставок!</p>
                        </div>
                    <?php
                    }
                }else{ ?>
                    <script type="text/javascript">
                        window.location.href = '/main/Login';
                    </script>
                <?php }
            } else {
                header('Location: /main/Login');
            }?>
        </div>
        <div id="output4"></div>
        <div id="output5"></div>
    </body>
</html>
<script src="/application/js/admin.js"></script>
<style>
    .activeClass{
        background: red;
        color:darkgreen;
    }
    .hover{
        background: greenyellow;
        color:darkgreen;
    }
</style>;