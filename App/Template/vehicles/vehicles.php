<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var \App\Data\VehicleDTO[] $data */
/** @var array $errors |null */

?>
    <div class="container">
        <div class="clearfix">
            <h2 class='float-left'>Автомобили</h2>
            <a href='add_vehicle.php' class='btn btn-success float-right'>
                <i class="fas fa-plus"></i>
                &nbsp; Добави автомобил
            </a>
        </div>

        <div class="row" style="margin: 0">
        <table class='table table-hover table-sm table-bordered'>
            <tr class="bg-info" style="color: white">
                <th>Ид</th>
                <th>Марка</th>
                <th>Модел</th>
                <th>Регистрационен номер</th>
                <th>Разход на гориво</th>
                <th>Офис </th>
                <th>куриер</th>
                <th></th>
            </tr>
            <?php  if($data) {
                foreach ($data as $vehicle) {
            ?>
             <tr>
                 <td><?= $vehicle->getId(); ?></td>
                 <td><?= $vehicle->getBrand(); ?></td>
                 <td><?= $vehicle->getModel(); ?></td>
                 <td><?= $vehicle->getRegNumber(); ?></td>
                 <td><?= $vehicle->getFuelConsumption(); ?></td>
                 <td><?= $vehicle->getOfficeName(); ?></td>
                 <td><?= $vehicle->getEmployeeName(); ?> </td>
                 <td>
                     <a href="edit_vehicle.php?id=<?= $vehicle->getId(); ?>" class="btn btn-info left-margin">
                         <span class='glyphicon glyphicon-edit'></span> Редакция
                     </a>
                     <button type="button" onclick="showHistory(<?= $vehicle->getId(); ?>)" class="btn btn-info"
                             data-toggle="modal" data-target="#modalHistory">
                         История
                     </button>
                 </td>
             </tr>
                    <?php
                }}
            ?>
         </table>
        </div>

        <!-- Vehicle history modal -->
        <div class="modal fade" id="modalHistory">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info" style="color: white">
                        <h4 class="modal-title">История на автомобила</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table id="tableHistory" class='table table-hover table-sm table-bordered'>
                            <tr>
                                <th>Начална дата/час</th>
                                <th>Крайна дата/час</th>
                                <th>Номер на служител</th>
                                <th>Име на служител</th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Изход</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

<script>
    function showHistory($vehicle_id) {
        $('#tableHistory').find('tr:not(:first)').remove();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "./api/customview/vehiclehistory.php?vehicle_id="+$vehicle_id,
            data: {action: "load"},
            success: function (response) {
                $.each(response, function (index, obj) {
                    var row = $('<tr>');
                    row.append('<td>' + obj.datetimestart + '</td>');
                    row.append('<td>' + obj.datetimeend + '</td>');
                    row.append('<td>' + obj.employeenumber + '</td>');
                    row.append('<td>' + obj.employeename + '</td>');
                    $('#tableHistory').append(row)
                })
            }
        });
    }
</script>

<?php require_once dirname(__FILE__).'/../home/footer.php';