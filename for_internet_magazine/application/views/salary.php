<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company info</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div id="default-tree"></div>
<div class="container">

    <h2>Salary</h2>
    <table class="table table-hover">
        <thead>
        <tr style="background: #ffcaca;">
            <th>№</th>
            <th>Initials</th>
            <th>Salary</th>
            <th>Worked days</th>
            <th>Bonus</th>
            <th>Final price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list_salaries = new \Application\models\Salary();
        $salaries = $list_salaries->get_salaries();
        foreach($salaries as $key => $salary) {
            $list_workers = new \Application\models\Workers();
            $workers = $list_workers->get_workers_by_id($salary['worker_id']);
            $workers->execute(array($salary['worker_id']));
            foreach ($workers as $worker) {
                $initial_lastname = utf8_encode($worker['lastname']);
                $initial_lastname = utf8_decode($initial_lastname);
                $initial_name = utf8_encode($worker['name']);
                $initial_name = mb_substr($initial_name, 0, 2);
                $initial_name = utf8_decode($initial_name);
                $initial_patronymic = utf8_encode($worker['patronymic']);
                $initial_patronymic = mb_substr($initial_patronymic, 0, 2);
                $initial_patronymic = utf8_decode($initial_patronymic);
                $initial = $initial_lastname . '. ' . $initial_name . '. ' . $initial_patronymic;
                $fix_salary = $worker['salary'];
                $worked_days = $salary['worked_days'];
                $bonus = $salary['bonus'];
                if($bonus == 1){
                    $final_price = $fix_salary +100;
                }else{
                    $final_price = $fix_salary ;
                }
                $post = new \Application\models\Post();
                $post_res = $post->get_post($worker['post_id']);
                $post_res->execute(array($worker['post_id']));
                foreach ($post_res as $res){
                }?>
                <tr>
                    <td><?= $key+1; ?></td>
                    <td><?= $initial;?></td>
                    <td><?= $fix_salary;?></td>
                    <td><?= $worked_days; ?></td>
                    <td><?php if($bonus == 1){
                            echo '100 $';
                        }else{
                            echo '0 $';
                        }?></td>
                    <td><?= $final_price;?></td>
                </tr>
            <?php } ?>
        <?php }?>
        </tbody>
    </table>
</div>

</body>
</html