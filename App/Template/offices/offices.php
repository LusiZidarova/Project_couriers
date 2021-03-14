<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var \App\Data\FullOfficesDTO[] $data */
/** @var array $errors |null */
?>
    <div class="container">

        <div class="clearfix">
            <h2 class='float-left'>Офиси</h2>
            <a href='add_office.php' class='btn btn-success float-right'>
                <i class="fas fa-plus"></i>
                &nbsp; Добави офис
            </a>
        </div>
        <div class="row" style="margin: 0">
        <table class='table table-hover table-sm table-bordered'>
            <tr class="bg-info" style="color: white">
                <th>Ид</th>
                <th>Офис</th>
                <th>Управител</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Работно време </th>
                <th>Населено място</th>
                <th></th>
                <th></th>
            </tr>
     <?php  if($data){
                foreach ($data as $office){
     ?>
            <tr>
                <td><?= $office->getId(); ?></td>
                <td><?= $office->getOfficeName(); ?></td>
                <td><?= $office->getManager(); ?></td>
                <td><?= $office->getAddress(); ?></td>
                <td><?= $office->getPhone(); ?></td>
                <td><?= $office->getWorkingHours(); ?></td>
                <td>
                    <?= $office->getTownName(); ?>
                </td>
                <td>
                    <a href="edit_office.php?id=<?= $office->getId(); ?>" class="btn btn-info left-margin">
                        <span class='glyphicon glyphicon-edit'></span> Редакция
                    </a>
                </td>
                <td>
                    <button type="button" onclick="showOfficeHistory(<?= $office->getId(); ?>)" class="btn btn-info" data-toggle="modal" data-target="#modalOffice">
                        Инфо офис
                    </button>
                </td>
            </tr>

          <?php   //end foreach
                }
          ?>
         </table>
        </div>

        <?php  //end if
                }
        ?>

    </div>

    <!-- Office history modal -->
    <div class="modal fade" id="modalOffice">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info" style="color: white">
                    <h4 class="modal-title">Oбслужвани населени места, куриери и автомобили </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 0px">
                        <div class="col-sm-4" style="padding-left: 0; padding-right: 0">
                            <table id="tableOfficeTowns" class='table table-hover table-sm table-bordered'>
                                <tr class="bg-info" style="color: white">
                                    <th>Обслужвани населени места</th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-8" style="padding-right: 0">
                            <table id="tableOfficeEmployees" class='table table-hover table-sm table-bordered'>
                                <tr class="bg-info" style="color: white">
                                    <th>Куриери</th>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin: 0px">
                        <table id="tableOfficeVehicles" class='table table-hover table-sm table-bordered'>
                            <tr class="bg-info" style="color: white">
                                <th>Автомобили</th>
                                <th>Шофьор/куриер</th>
                            </tr>
                            </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Изход</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showOfficeHistory($office_id) {
            $('#tableOfficeTowns').find('tr:not(:first)').remove();
            $('#tableOfficeEmployees').find('tr:not(:first)').remove();
            $('#tableOfficeVehicles').find('tr:not(:first)').remove();

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "./api/customview/officehistory.php?office_id="+$office_id,
                data: {action: "load"},
                success: function (response) {
                    $officeTowns = response['towns'];
                    $.each($officeTowns, function (index, $obj) {
                        var row = $('<tr>');
                        row.append('<td>' + $obj.name + '</td>');
                        $('#tableOfficeTowns').append(row)
                    })

                    $officeEmployees = response['employees'];
                    $.each($officeEmployees, function (index, $obj) {
                        var row = $('<tr>');
                        row.append('<td>' + $obj.user_number + ', '+ $obj.full_name+'</td>');
                        $('#tableOfficeEmployees').append(row)
                    })

                    $officeVehicles = response['vehicles'];
                    $.each($officeVehicles, function (index, $obj) {
                        var row = $('<tr>');
                        row.append('<td>' + $obj.brand +' '+ $obj.model +', '+ $obj.reg_number +'</td>');
                        row.append('<td>' + $obj.user_number +  ', '+ $obj.employee_name +'</td>');
                        $('#tableOfficeVehicles').append(row)
                    })
                }
            });
        }
    </script>

<?php require_once dirname(__FILE__).'/../home/footer.php';