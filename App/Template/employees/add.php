<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
?>
    <main>
        <h1>Добавяне на куриер</h1>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>


        <form action="add_employee.php?id=" method="post">
            <table class='table table-hover table-responsive table-bordered'>

                <tr>
                    <td>Номер </td>
                    <td><input type='text' name='user_number' class='form-control' value=''/></td>
                </tr>

                <tr>
                    <td>Потребителско име </td>
                    <td><input type='text' name='username' class='form-control' value=''/></td>
                </tr>


                <tr>
                    <td>Парола</td>
                    <td><input type='text' name='password' class='form-control' value=''/></td>
                </tr>
                <tr>
                    <td>Повтори паролата</td>
                    <td><input type='password' name="confirm_password"  class='form-control' value=''/></td>
                </tr>
                <tr>
                    <td>Три имена</td>
                    <td><input type='text' name='full_name' class='form-control' value='' /></td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td><input type='text' name='phone' class='form-control' value='' /></td>
                </tr>
                <tr>
                    <td><label for="officeId">Офис</label></td>
                    <td>
                        <select class="form-control" id="officeId" name="office_id" required="required" >
                            <option  value=''>Избери офис..</option>
                            <?php// foreach ($data->getOffices() as $office): ?>

                                <option ></option>
                            <?php// endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="edit" class="btn btn-primary">Обнови</button>
                    </td>
                </tr>

            </table>
        </form>


    </main>
    <script>
        $(document).ready(function() {

            $offices = response["recordsOffice"];

            $.each($offices, function (index, obj) {
                var row = $('<select>');
                row.append('<option value="' + obj.id + '">' + obj.value + '</option>');
                $('#officeId').append(row)
            })
        });
        /*
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
            });*/

    </script>
<?php require_once dirname(__FILE__).'/../home/footer.php';
