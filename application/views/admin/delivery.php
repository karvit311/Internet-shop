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

    <style>
        #left-block li{
            position:relative;
        }
    </style>
    <body>
        <div class="container">
            <?php
            if($_SESSION['admin'] = "admin")
            {
                if(isset($_GET['logout']))
                {
                    unset($_SESSION['auth_admin']);
                    return $this->redirect('/user/login');
                }
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
            } else {
                header('Location: /main/Login');
            }?>
        </div>
        <div id="output4"></div>
        <div id="output5"></div>
    </body>
</html>
    <script>
    $(document).ready(function() {
        $('#add_new_supplier_left_block').click(function(){
            $("#department_for_new_supplier").modal("show");
            $('#SelectDepartment').change(function(){
                var main_department_id = $('#SelectDepartment option:selected').attr('department_id');
                $.ajax({
                    type: "POST",
                    url: "/admin/GetChildOfDepartment",
                    data: "main_department_id=" + main_department_id,
                    dataType: "json",
                    success: function (res) {
                        var workers = JSON.stringify(res);
                        var obj = JSON.parse(workers);
                        for(var i in obj) {
                            // console.log(obj[i]);
                        }
                        $('#SelectSubDepartment')
                        .find("option").remove();
                        $.each(obj, function(iy, ely) {
                            var department = ely['department'];
                            var department_id = ely['id'];
                            console.log(department);
                            var parent = ely['parent_id'];
                            $('#SelectSubDepartment')
                                .append($('<option>')
                                    .attr('department_id', department_id)
                                    .text(department)
                            );
                        });
                    },
                    error: function () {
                        // alert("Error");
                    }
                });
            });
            $('.remove_sub_department.glyphicon-remove-circle').click(function(){
                // $('#subDepartmentAddNewSupplierDepartment')
                //     .find("option").remove();
                // $('#subDepartmentAddNewSupplierDepartment').val('');
                $('#SelectSubDepartment').val('');
                // $('#subDepartmentAddNewSupplierDepartment')
                //     .find("label").remove();
                $('.remove_sub_department.glyphicon-remove-circle').hide();
            });

            $('#add_new_department_in_new_supplier').click(function(){
                var new_department = $('#AddNewDepartment').val();
                var selected_department_id = $('#SelectDepartment option:selected').attr('department_id');
                var selected_sub_parent_id = $('#SelectSubDepartment option:selected').attr('department_id');

                $.ajax({
                    type: "POST",
                    url: "/main/AddNewDepartment",
                    data: "new_department=" + new_department + "&selected_department_id=" + selected_department_id+ "&selected_sub_parent_id=" + selected_sub_parent_id,
                    // dataType: "json",
                    success: function (res) {
                        var department_id = res;
                        $("#flash-msg-selecting-department-for-new-supplier").show();
                        setTimeout(function () {
                            $("#flash-msg-selecting-department-for-new-supplier").hide();
                        }, 2000);
                        setTimeout(function () {
                            $("#add_new_supplier_Modal").modal("show");
                        }, 2000);

                        $('#add_new_supplier').click(function() {
                            var department_id = res;
                            // alert(department_id);
                            var new_supplier = $('#AddNewInputSupplier').val();
                            var new_info_supplier = $('#AddNewInfoSupplier').val();
                            $.ajax({
                                type: "POST",
                                url: "/admin/AddNewSupplier",
                                data: "new_supplier=" + new_supplier + "&new_info_supplier=" + new_info_supplier + "&new_department=" + department_id,
                                // dataType: "json",
                                success: function (res) {
                                    // alert(res);
                                },
                                error: function () {
                                    alert("Error");
                                }
                            });
                        });
                    },
                    error: function () {
                        alert("Error");
                    }
                });

            });

        });
        $('#search_deliveries_by_suppliers').click(function(){
            var selected_supplier_id = $('select#FormControlSearchDeliveriesBySupplier option:selected').attr('supplier_id');
            $.ajax({
                type: "POST",
                url: "/admin/GetAllDeliveriesForThisSupplier",
                data: "supplier_id=" + selected_supplier_id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    for(var i in response){
                        console.log(response[i]);
                        for(var y in response[i]) {
                            console.log(response[i][y]);
                            $.each($(response[i][y]), function (iy, ely) {
                                var supplier_id = ely['supplier_id'];
                                var city_id = ely['city_id'];
                                var supplier = ely['supplier'];
                                var address = ely['address'];
                                var date = ely['date'];
                                var time = ely['time'];
                                var info = ely['info'];
                                var department = ely['department'];
                                $("#change_delivery_Modal_by_supplier").modal("show");
                                $('#change_delivery_Modal_by_supplier').find('tbody')
                                    .append($('<tr>')
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_supplier'+y)
                                            .attr('supplier_id', supplier_id)
                                            .attr('city_id', city_id)
                                            .text(supplier)
                                        )
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_address'+y)
                                            .text(address)
                                        )
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_date'+y)
                                            .text(date)
                                        )
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_time'+y)
                                            .text(time)
                                        )
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_info'+y)
                                            .text(info)
                                        )
                                        .append($('<td>')
                                            .addClass('modal_change_delivery_date_department'+y)
                                            .text(department)
                                        )
                                        .append($('<td>')
                                            .append($('<a href="#">')
                                                .append($('<span class="glyphicon glyphicon-pencil">')
                                                )
                                            )
                                            .append($('<a href="#">')
                                                .append($('<span class="glyphicon glyphicon-trash">')
                                                )
                                            )
                                        )
                                    );
                            });
                        }
                    }
                    $.each($('.glyphicon.glyphicon-pencil'), function (y, ey) {
                        $(this).click(function () {
                            var supplier_id = $('.modal_change_delivery_date_supplier' + y).attr('supplier_id');
                            var city_id = $('.modal_change_delivery_date_supplier' + y).attr('city_id');
                            var supplier = $('.modal_change_delivery_date_supplier' + y).text();
                            var address = $('.modal_change_delivery_date_address'+ y).text();
                            var date = $('.modal_change_delivery_date_date'+ y).text();
                            var time = $('.modal_change_delivery_date_time'+ y).text();
                            var info = $('.modal_change_delivery_date_info'+ y).text();
                            var department = $('.modal_change_delivery_date_department'+ y).text();
                            $('#change_delivery_Modal_by_supplier').modal('hide');
                            $('#change_delivery_Modal_by_supplier')
                                .find("table tbody tr").remove();
                            $("#edit_delivery_Modal_by_city").modal("show");
                            $('#FormEditInputSupplier' ).attr('supplier_id',supplier_id);
                            var city_id = $('#FormEditInputSupplier').attr('city_id',city_id);
                            $('#FormEditInputSupplier').val(supplier);
                            $('#FormEditInputAddress').val(address);
                            $('#FormEditInputDate').val(date);
                            $('#FormEditInputTime').val(time);
                            $('#FormEditInputInfo').val(info);
                            $('#FormEditInputDepartment').val(department);
                            $('#update_delivery').click(function(){
                                var supplier_id = $('#FormEditInputSupplier').attr('supplier_id');
                                var city_id = $('#FormEditInputSupplier').attr('city_id');
                                var supplier = $('#FormEditInputSupplier').val();
                                var address = $('#FormEditInputAddress').val();
                                var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
                                var val = $('.bootstrap-datetimepicker-widget table td.day').text();
                                var full_time = $('#datetimepicker5').data('DateTimePicker').date();
                                var dateTime = new Date(full_time);
                                dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
                                get_time = moment(dateTime).format("HH:mm:ss");
                                // alert(dateTime);
                                // alert(get_time);
                                var info = $('#FormEditInputInfo').val();
                                var department = $('#FormEditInputDepartment').val();
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/UpdateDelivery",
                                    data: "supplier_id=" + supplier_id +"&supplier=" + supplier +"&city_id=" + city_id +"&address=" + address +"&date=" + dateTime +"&time=" + get_time +"&info=" + info +"&department=" + department,
                                    dataType: "json",
                                    success: function (res) {
                                        var workers = JSON.stringify(res);
                                        var obj = JSON.parse(workers);
                                        $.each(obj, function(iy, ely) {
                                            var address = ely['address'];
                                            var date = ely['date'];
                                            var time = ely['time'];
                                            var supplier_id = ely['supplier_id'];
                                            var supplier = ely['supplier'];
                                            var info = ely['info'];
                                            var department = ely['department'];
                                            console.log(department);
                                            $(".modal_delivery_date_address").html(address);
                                            $(".modal_delivery_date_time").html(time);
                                            $(".modal_delivery_date_date").html(date);
                                            $(".modal_delivery_date_supplier").html(supplier);
                                            $(".modal_delivery_date_contacts_of_supplier").html(info);
                                            $(".modal_delivery_date_department").html(department);
                                        });
                                    },
                                    error: function () {
                                        alert("Error");
                                    }
                                });

                            });
                        });
                    });
                    $('.close').click(function() {
                        $('#change_delivery_Modal_by_supplier')
                            .find("table tbody tr").remove();
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        //////////////////////
        $('#left-block-search-by-city').click(function(){
            var selected_city_id = $('select#FormControlSearchDeliveriesByCity option:selected').attr('city_id');
            $.ajax({
                type: "POST",
                url: "/admin/GetAllDeliveriesForThisCity",
                data: "city_id=" + selected_city_id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    for(var i in response){
                        console.log(response[i]);
                        for(var y in response[i]) {
                            console.log(response[i][y]);
                            $.each($(response[i][y]), function (iy, ely) {
                                var supplier_id = ely['supplier_id'];
                                var city_id = ely['city_id'];
                                var supplier = ely['supplier'];
                                var address = ely['address'];
                                var date = ely['date'];
                                var time = ely['time'];
                                var info = ely['info'];
                                var department = ely['department'];
                                $("#change_delivery_Modal_by_city").modal("show");
                                $('#change_delivery_Modal_by_city').find('tbody')
                                .append($('<tr>')
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_supplier'+y)
                                        .attr('supplier_id', supplier_id)
                                        .attr('city_id', city_id)
                                        .text(supplier)
                                    )
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_address'+y)
                                        .text(address)
                                    )
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_date'+y)
                                        .text(date)
                                    )
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_time'+y)
                                        .text(time)
                                    )
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_info'+y)
                                        .text(info)
                                    )
                                    .append($('<td>')
                                        .addClass('modal_change_delivery_date_department'+y)
                                        .text(department)
                                    )
                                    .append($('<td>')
                                        .append($('<a href="#">')
                                            .append($('<span class="glyphicon glyphicon-pencil">')
                                            )
                                        )
                                        .append($('<a href="#">')
                                            .append($('<span class="glyphicon glyphicon-trash">')
                                            )
                                        )
                                    )
                                );
                            });
                        }
                    }
                    $.each($('.glyphicon.glyphicon-pencil'), function (y, ey) {
                        $(this).click(function () {
                            var supplier_id = $('.modal_change_delivery_date_supplier' + y).attr('supplier_id');
                            var city_id = $('.modal_change_delivery_date_supplier' + y).attr('city_id');
                            var supplier = $('.modal_change_delivery_date_supplier' + y).text();
                            var address = $('.modal_change_delivery_date_address'+ y).text();
                            var date = $('.modal_change_delivery_date_date'+ y).text();
                            var time = $('.modal_change_delivery_date_time'+ y).text();
                            var info = $('.modal_change_delivery_date_info'+ y).text();
                            var department = $('.modal_change_delivery_date_department'+ y).text();
                            $('#change_delivery_Modal_by_city').modal('hide');
                            $('#change_delivery_Modal_by_city')
                                .find("table tbody tr").remove();
                            $("#edit_delivery_Modal_by_city").modal("show");
                            $('#FormEditInputSupplier' ).attr('supplier_id',supplier_id);
                            var city_id = $('#FormEditInputSupplier').attr('city_id',city_id);
                            $('#FormEditInputSupplier').val(supplier);
                            $('#FormEditInputAddress').val(address);
                            $('#FormEditInputDate').val(date);
                            $('#FormEditInputTime').val(time);
                            $('#FormEditInputInfo').val(info);
                            $('#FormEditInputDepartment').val(department);
                            $('#update_delivery').click(function(){
                                var supplier_id = $('#FormEditInputSupplier').attr('supplier_id');
                                var city_id = $('#FormEditInputSupplier').attr('city_id');
                                var supplier = $('#FormEditInputSupplier').val();
                                var address = $('#FormEditInputAddress').val();
                                var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
                                var val = $('.bootstrap-datetimepicker-widget table td.day').text();
                                var full_time = $('#datetimepicker5').data('DateTimePicker').date();
                                var dateTime = new Date(full_time);
                                dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
                                get_time = moment(dateTime).format("HH:mm:ss");
                                // alert(dateTime);
                                // alert(get_time);
                                var info = $('#FormEditInputInfo').val();
                                var department = $('#FormEditInputDepartment').val();
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/UpdateDelivery",
                                    data: "supplier_id=" + supplier_id +"&supplier=" + supplier +"&city_id=" + city_id +"&address=" + address +"&date=" + dateTime +"&time=" + get_time +"&info=" + info +"&department=" + department,
                                    dataType: "json",
                                    success: function (res) {
                                        var workers = JSON.stringify(res);
                                        var obj = JSON.parse(workers);
                                        $.each(obj, function(iy, ely) {
                                            var address = ely['address'];
                                            var date = ely['date'];
                                            var time = ely['time'];
                                            var supplier_id = ely['supplier_id'];
                                            var supplier = ely['supplier'];
                                            var info = ely['info'];
                                            var department = ely['department'];
                                            console.log(department);
                                            $(".modal_delivery_date_address").html(address);
                                            $(".modal_delivery_date_time").html(time);
                                            $(".modal_delivery_date_date").html(date);
                                            $(".modal_delivery_date_supplier").html(supplier);
                                            $(".modal_delivery_date_contacts_of_supplier").html(info);
                                            $(".modal_delivery_date_department").html(department);
                                        });
                                    },
                                    error: function () {
                                        alert("Error");
                                    }
                                });

                            });
                        });
                    });
                    $('.close').click(function() {
                        $('#change_delivery_Modal_by_city')
                            .find("table tbody tr").remove();
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        var array = [];
        $.each($('.city_deliver'), function (i,el) {
            var attribute_city_id = $(this).attr('city_id');
            array.push(attribute_city_id);
        });
        $.each($(array), function (i,el) {
            $.ajax({
                type: "POST",
                url: "/admin/ByCityId",
                data: {city_id: array[i]},
                dataType: "json",
                success: function (response) {
                    $.each($(response), function (i,el) {
                        var hours = [];
                        var dates = [];
                        $.each($('.hour_delivery'), function (ii, ell) {
                            var city_id = $(this).attr('city_id');
                            var date = $(this).attr('date');
                            for(var iii in el['date']) {
                                for (var yyy in el['time']) {
                                    if((city_id == el['city_id'])&&(date== el['date'][iii]) ) {
                                        $(this).attr('time', el['time'][iii]);
                                        $(this).val(el['time'][iii]);
                                        var time = $(this).attr('time');
                                        var date = $(this).attr('date');
                                        if ((date == el['date'][iii]) && (city_id == el['city_id'])) {
                                            $(this).html(el['time'][iii]);
                                            $(this).css("background-color", "#8c2424");
                                            $(this).hover(
                                                function () {
                                                    $(this).css("background-color", "rosybrown");
                                                },
                                                function () {
                                                    $(this).css("background-color", "#8c2424");
                                                }
                                            );
                                            $(this).click(
                                                function () {
                                                    $(this).css("background-color", "rosybrown");
                                                    $(this).attr('data-toggle', 'modal');
                                                    $(this).attr("data-target", "#detail_by_time_Modal");
                                                    var city_id = $(this).attr('city_id');
                                                    var time_atr = $(this).attr('time');
                                                    var date_atr = $(this).attr('date');
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/admin/GetInfoAboutDelivery",
                                                        data: "time=" + time_atr + "&date=" + date_atr + "&city_id=" + city_id,
                                                        dataType: "json",
                                                        success: function (res) {
                                                            var workers = JSON.stringify(res);
                                                            var obj = JSON.parse(workers);
                                                            $.each(obj, function (iy, ely) {
                                                                var address = ely['address'];
                                                                var date = ely['date'];
                                                                var time = ely['time'];
                                                                var supplier_id = ely['supplier_id'];
                                                                var supplier = ely['supplier'];
                                                                var info = ely['info'];
                                                                var department = ely['department'];
                                                                $(".modal_delivery_date_address").html(address);
                                                                $(".modal_delivery_date_time").html(time);
                                                                $(".modal_delivery_date_date").html(date);
                                                                $(".modal_delivery_date_supplier").html(supplier);
                                                                $(".modal_delivery_date_contacts_of_supplier").html(info);
                                                                $(".modal_delivery_date_department").html(department);
                                                            });
                                                        },
                                                        error: function () {
                                                            alert("Error");
                                                        }
                                                    });
                                                }
                                            );
                                        }
                                    }
                                }
                            }
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        $('#datetimepicker4').datetimepicker({
            inline: true,
            sideBySide: true,
            calendarWeeks:true,
            format: 'dd-mm-yyyy hh:ii'
        });
        $('#form_datetimepicker4').click(function() {
            // alert($(this).val());
            var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
            var val = $('.bootstrap-datetimepicker-widget table td.day').text();
            var full_time = $('#datetimepicker4').data('DateTimePicker').date();
            var dateTime = new Date(full_time);
            dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
            get_time = moment(dateTime).format("HH:mm:ss");
            $("#add_new_delivery_Modal").modal("show");
            $("button#add_new_delivery").click(function() {
                var selected_address_modal = $('select#FormControlInputAddress option:selected').text();
                var selected_supplier_modal = $('select#FormControlInputSupplier option:selected').text();
                var selected_id_supplier_modal = $('select#FormControlInputSupplier option:selected').attr('supplier_id');
                var selected_id_city_modal = $('select#FormControlInputAddress option:selected').attr('city_id');
                alert(selected_id_city_modal);
                $.ajax({
                    type: "POST",
                    url: "/admin/GetInfoAboutSupplier",
                    data: "supplier_id=" + selected_id_supplier_modal,
                    dataType: "json",
                    success: function (response) {
                        var workers = JSON.stringify(response);
                        var obj = JSON.parse(workers);
                        $.each(obj, function(i, el) {
                            var supplier_id = el['supplier_id'];
                            var supplier = el['supplier'];
                            var info = el['info'];
                            var department = el['department'];
                            $("#address_alert_adding_delivery").html(selected_address_modal);
                            $("#date_alert_adding_delivery").html(dateTime);
                            $("#time_alert_adding_delivery").html(get_time);
                            $("#supplier_alert_adding_delivery").html(selected_supplier_modal);
                            $("#contacts_of_supplier_alert_adding_delivery").html(info);
                            $("#department_alert_adding_delivery").html(department);
                            $.ajax({
                                type: "POST",
                                url: "/admin/AddNewDelivery",
                                data: "address=" + selected_address_modal + "&date=" + dateTime+ "&time=" + get_time+ "&city_id=" + selected_id_city_modal + "&supplier_id=" + selected_id_supplier_modal,
                                success: function (response) {
                                    if(response == 1){
                                        $("#flash-msg-adding-delivery").show();
                                    }
                                },
                                error: function () {
                                    alert("Error");
                                }
                            });
                        });
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            });
        });
        $('#datetimepicker3').datetimepicker({
            // format: 'DD/MM/YYYY',
            defaultDate: new Date()
        }).on("dp.show", function () {
            $.ajax({
                type: "POST",
                url: "/admin/GetDelivery",
                dataType: "json",
                success: function (response) {
                    var workers = JSON.stringify(response);
                    var obj = JSON.parse(workers);
                    $.each(obj, function (i, el) {
                        var date = el['date'];
                        $('.bootstrap-datetimepicker-widget table td.day').each(function (index, element) {
                            var attribute = $(this).attr('data-day');
                            if(attribute == date){
                                $(this).addClass('activeClass');
                                $('.bootstrap-datetimepicker-widget table td.day').on('click', function() {
                                    var day = $(this).attr('data-day');
                                    var val = $(this).text();
                                    if(date == day) {
                                        var address=[];
                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/GetDeliveryByDate",
                                            data: "date=" + day,
                                            // dataType:"json",
                                            success: function (res) {
                                                // alert(res);
                                                // alert(el['address']);
                                                // for(var u in el['address']) {
                                                    // for(var uu in el['time']) {
                                                    //     for(var uuu in el['date']) {
                                                    var address = el['address'];
                                                    var time = el['time'];
                                                    var date = el['date'];
                                                // $.each(res, function (iu, elu) {
                                                    $(".modal_delivery_date_address").html(el['address']);
                                                // });
                                                    $(".modal_delivery_date_time").html(el['time']);
                                                    $(".modal_delivery_date_date").html(el['date']);
                                                    $("#detailModal").modal("show");

                                               // }}}
                                            },
                                            error: function () {
                                                alert("Error");
                                            }
                                        });
                                    }
                                });
                                $(this).hover(
                                    function () {
                                        $(this).css("background-color", "rosybrown");
                                    },
                                    function () {
                                        $(this).css("background-color", "red");
                                    }
                                );
                                $(".bootstrap-datetimepicker-widget table td.day").hover( function (e) {
                                    $(this).toggleClass('hover', e.type === 'mouseenter');
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/GetDeliveryByDate",
                                    data: "date=" + date,
                                    dataType: "json",
                                    success: function (response) {
                                        var workers = JSON.stringify(response);
                                        var obj = JSON.parse(workers);
                                        $.each(obj, function(i, el) {
                                            var address = el['address'];
                                            var $element = $(element);
                                            $element.attr("title", address);
                                            $element.data("container", "body");
                                            $element.tooltip();
                                        });
                                    },
                                    error: function () {
                                        // alert("Error");
                                    }
                                });
                            }
                            if ((attribute, date) > -1) {
                                (date).addClass('activeClass');
                            }
                            if (date <= attribute && date >= attribute ) {
                                return [true, 'activeClass', date];
                            }
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        }).on("dp.change", function (index, element) {
            $('.bootstrap-datetimepicker-widget table td.day').on('click', function(index,element) {
                var day = $(this).attr('data-day');
                var val = $(this).text();
            });
        });
        var attribute = $('#lastDay').attr('lastDay');
        var date = new Date(),
            yr = date.getFullYear(),
            month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
            day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
            newDate = day + '/' + month + '/' + yr;
        newDate = yr + '-' + month + '-' + day;
        $("#output4").html(
            "Start of Week: " + moment(newDate, "DD/MM/YYYY").day(1).format("DD/MM/YYYY")
        );
        $('.day_of_week_monday').attr('date', moment(newDate, "YYYY-MM-DD").day(1).format("YYYY-MM-DD"));
        $('.day_of_week_tuesday').attr('date', moment(newDate, "YYYY-MM-DD").day(2).format("YYYY-MM-DD"));
        $('.day_of_week_wednesday').attr('date', moment(newDate, "YYYY-MM-DD").day(3).format("YYYY-MM-DD"));
        $('.day_of_week_thursday').attr('date', moment(newDate, "YYYY-MM-DD").day(4).format("YYYY-MM-DD"));
        $('.day_of_week_friday').attr('date', moment(newDate, "YYYY-MM-DD").day(5).format("YYYY-MM-DD"));
        $('.day_of_week_saturday').attr('date', moment(newDate, "YYYY-MM-DD").day(6).format("YYYY-MM-DD"));
        $('.day_of_week_sunday').attr('date', moment(newDate, "YYYY-MM-DD").day(7).format("YYYY-MM-DD"));

         $('.days_of_week.day_of_week_monday').html( moment(newDate, "YYYY-MM-DD").day(1).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_tuesday').html( moment(newDate, "YYYY-MM-DD").day(2).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_wednesday ').html( moment(newDate, "YYYY-MM-DD").day(3).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_thursday ').html( moment(newDate, "YYYY-MM-DD").day(4).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_friday ').html( moment(newDate, "YYYY-MM-DD").day(5).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_saturday').html(moment(newDate, "YYYY-MM-DD").day(6).format("YYYY-MM-DD"));
        $('.days_of_week.day_of_week_sunday').html( moment(newDate, "YYYY-MM-DD").day(7).format("YYYY-MM-DD"));
    });
</script>
<style>
    /*.table-hover{*/
        /*width:95%;*/
    /*}*/
    .activeClass{
        background: red;
        color:darkgreen;
    }
    .hover{
        background: greenyellow;
        color:darkgreen;
    }
</style>;