<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var \App\Data\FullTownsDTO[] $data */
/** @var array $errors |null */
?>
    <div class="container">

        <div class="clearfix">
            <h2 class='float-left'>Населени места</h2>
            <a href='add_town.php' class='btn btn-success float-right'>
                <i class="fas fa-plus"></i>
                &nbsp; Добави населено място
            </a>
        </div>

    <div class="row" style="margin: 0">
        <table class='table table-hover table-sm table-bordered'>
            <tr class="bg-info" style="color: white">
                <th>Ид</th>
                <th>Населено място</th>
                <th>Област</th>
                <th>Община</th>
                <th>ПК</th>
                <th></th>
            </tr>
     <?php  if($data){
                foreach ($data as $town){
     ?>
            <tr>
               <td><?php  echo $town->getId(); ?></td>
               <td><?php  echo $town->getName(); ?></td>
               <td><?php  echo $town->getProvince(); ?></td>
               <td><?php  echo $town->getMunicipality();?></td>
               <td><?php  echo $town->getPostcode(); ?></td>
               <td>
                   <a href="edit_town.php?id=<?= $town->getId(); ?>" class="btn btn-info left-margin">
                        <span class='glyphicon glyphicon-edit'></span> Редакция
                   </a>
                   <button type="button" onclick="showTownHistory(<?= $town->getId(); ?>)" class="btn btn-info" data-toggle="modal" data-target="#modalTown">
                       Обслужващи офиси
                   </button>
               </td>

            </tr>

          <?php  //endforeach
                } ?>
         </table>
    </div>
        <?php  //end if
                } ?>


    </div>
    <!-- Town history modal -->
    <div class="modal fade" id="modalTown">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info" style="color: white">
                    <h4 class="modal-title">Обслубващи офиси </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table id="tableTownHistory" class='table table-hover table-sm table-bordered'>
                        <tr>
                            <th>Офис</th>
                            <th>Адрес</th>
                            <th>Работно време</th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Изход</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTownHistory($town_id) {
            $('#tableTownHistory').find('tr:not(:first)').remove();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "./api/customview/townhistory.php?town_id="+$town_id,
                data: {action: "load"},
                success: function (response) {
                    $.each(response, function (index, obj) {
                        var row = $('<tr>');
                        row.append('<td>' + obj.office_name + '</td>');
                        row.append('<td>' + obj.address + '</td>');
                        row.append('<td>' + obj.working_hours + '</td>');
                        $('#tableTownHistory').append(row)
                    })
                }
            });
        }
    </script>
<?php require_once dirname(__FILE__).'/../home/footer.php';