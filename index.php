<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajax</title>
</head>

<body>
    <div class="header">
        <h1>PHP AJAX</h1>
    </div>
    <div class="click-button">
        <input class="btn" type="button" id="load-button" value="Load Data">
    </div>
    <br>


    <table id="table-data" border="1" width="100%" cellspacing="0" cellpadding="10px">
        <tr>
            <th>Roll</th>
            <th>Name</th>
        </tr>
        <tr align="center">
            <td>18038</td>
            <td>Emon</td>
        </tr>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#load-button").on("click", function(e) {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                });
            });



        });
    </script>


</body>

</html>