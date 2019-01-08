<?php
$count_no_accepted_orders = new \Application\models\Orders();
$res_count_no_accepted_orders = $count_no_accepted_orders->count_no_accepted_orders();
foreach($res_count_no_accepted_orders as $res_count_no_accepted_order){
    $count_no_accepted_orders = $res_count_no_accepted_order['total'];
}
$count_no_accepted_reviews = new \Application\models\Review();
$res_count_no_accepted_reviews = $count_no_accepted_reviews->count_no_accepted_reviews();
foreach($res_count_no_accepted_reviews as $res_count_no_accepted_review){
    $count_no_accepted_reviews = $res_count_no_accepted_review['total'];
}
if ($count_no_accepted_orders  > 0) { $count_str1 = '<p>+'.$count_no_accepted_orders .'</p>'; } else { $count_str1 = ''; }
if ($count_no_accepted_reviews > 0) { $count_str2 = '<p>+'.$count_no_accepted_reviews.'</p>'; } else { $count_str2 = ''; }?>
<div id="block-header-admin" style="height:103px;">
    <div id="block-header1" >
        <h3>AllPan. Панель управления</h3>
        <p id="link-nav" ><?= $_SESSION['urlpage']; ?></p>
    </div>
    <div id="block-header2" >
        <p align="right" ><a href="/admin/Administrators" >Администраторы</a></p>
        <p align="right">Вы - <span><?= $_SESSION['admin_login']; ?></span></p>
    </div>
</div>
<div id="left-nav">
    <ul>
        <li><a href="/admin/Orders/?sort=">Заказы</a><?= $count_str1; ?></li>
        <li><a class="products_select_department" href="#">Товары</a></li>
        <li><a href="/admin/reviews/?sort=">Отзывы</a><?= $count_str2; ?></li>
        <li><a href="/admin/allDepartments">Категории</a></li>
        <li><a href="/admin/clients">Клиенты</a></li>
        <li><a href="/admin/worker">Работники</a></li>
        <li><a href="/admin/Delivery">Поставки</a></li>
        <li><a href="/admin/newsAdmin">Новости</a></li>
    </ul>
</div>
<!-- The Modal -->
<div class="modal" id="selectDepartmentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Выбор категории</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $departments = new \Application\models\Department();
                $res_departments = $departments->get_departments();?>
                <form method="post" class="feedback" >
                    <div class="form-group">
                        <label for="SelectDepartment" style="margin-top:18px; ">Выбрать отдел:</label>
                        <select class="form-group" id="SelectDepartment" name="myselect" >
                            <option selected value="-1">Все отделы</option>
                            <?php foreach ($res_departments as $res_department){?>
                                <option id="department_select_modal" name="department_select_modal" value="<?= $res_department['id']; ?>" department_id="<?= $res_department['id']; ?>"><?= $res_department['department'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" name="select_department" id="select_department" class="btn btn-info" data-dismiss="modal" >Выбрать</button>
            </div>
        </div>
    </div>
</div><!--END MODAl -->
<script src="/application/js/admin.js"></script>