<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
$url = str_replace( basename(__FILE__) , '',str_replace($_SERVER["DOCUMENT_ROOT"],'',str_replace('\\','/',__FILE__ )  ));
$url = str_replace(' ','%20', 'http://localhost' . str_replace('App/Template/employees/','api/town/read.php', $url));
$request = file_get_contents($url); // gets the raw data
$params = json_decode($request,true);
?>
    <main>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>
        <form action="" method="get">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>
                    Населено място:
                </td>
                <td>
                    Офиси:
                </td>
                <td>
                    Автомобил:
                </td>
            </tr>
            <tr>
                <td>
                    <select id="selectTown" class='form-control' name='townName' >
                        <option  value="">Избери населено място</option>
                        <?php
                        if (is_array($params['records']) || is_object($params['records']))
                            foreach ($params['records'] as $town){
                                echo "<option  value='{$town['id']}'>{$town['name']}</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="selectOffice" class='form-control' name='officeName' >
                </td>
                <td>
                </td>
            </tr>
            </table>
        </form>
    </main>

<?php require_once dirname(__FILE__).'/../home/footer.php';?>

<script >

    jQuery(document).ready(function ($) {
        $('#selectTown').change(function () {
            var optionSelected = $(this).find("option:selected");
            var valueSelected = optionSelected.val();
            //var textSelected   = optionSelected.text();
             if (valueSelected != null) {
                 var $dropdown = $("#selectOffice");
                 $dropdown.children().remove();
                 $.ajax({
                     type: "GET",
                     dataType: "json",
                     url:   "./api/office/read.php?id=" + valueSelected, //Relative or absolute path to response.php file
                     data: {action: "load"},
                     success: function (response) {
                         $.each(response.recordsOffice, function(index, obj) {
                             $dropdown.append($("<option />").val(obj.id).text(obj.office_name));
                         });
                     }
                 });
             }
        });
    });
    </script>

