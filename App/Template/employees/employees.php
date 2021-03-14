<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var \App\Data\EmployeeDTO[] $data */
/** @var array $errors |null */
?>

    <div class="container">

    <div class="clearfix">
        <h2>Куриери</h2>
        <a href='add_employee.php' class='btn btn-success float-right'>
            <i class="fas fa-plus"></i>
            &nbsp; Добави куриер
        </a>
    </div>


        <div class="row" style="margin: 0">
        <table class='table table-hover table-sm table-bordered'>
            <tr class="bg-info" style="color: white">
                <th>Номер</th>
                <th>Три имена</th>
                <th>Телефон</th>
                <th>Офис </th>
                <th></th>
            </tr>
            <?php  if($data) {
                foreach ($data as $employee) {

            ?>
             <tr>
                 <td><?= $employee->getUserNumber(); ?></td>
                 <td><?= $employee->getFullName(); ?></td>
                 <td><?= $employee->getPhone(); ?></td>
                 <td><?= $employee->getOfficeName(); ?></td>
                 <td>
                     <a href="edit_employee.php?id=<?= $employee->getId(); ?>" class="btn btn-info left-margin">
                         <span class='glyphicon glyphicon-edit'></span> Редакция
                     </a>
                 </td>
             </tr>
                    <?php
                }}
            ?>
         </table>
        </div>

<?php require_once dirname(__FILE__).'/../home/footer.php';