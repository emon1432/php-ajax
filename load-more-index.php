<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP & AJAX</title>
</head>

<body>
    <div id="main">

        <div id="header">
            <h1>PHP & AJAX CRUD</h1>
            <br>
        </div>

        <table border="1" width="" align="center" cellspacing="0" cellpadding="10px">
            <tr id="header" style="background:green;">
                <th>Roll</th>
                <th>Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tbody id="table-data">
            </tbody>
        </table>

    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jQuery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadTable(page) {
                $.ajax({
                    url: "load-more-ajax.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        if (data) {
                            $("#load-more-pagination").remove();
                            $("#table-data").append(data);
                        } else {
                            $("#ajaxbtn").html("Finished");
                            $("#ajaxbtn").prop("disabled", true);
                        }
                    }
                });
            }
            loadTable();

            $(document).on("click", "#ajaxbtn", function() {
                $("#ajaxbtn").html("Loading...");
                var pid = $(this).data("id");
                loadTable(pid);
            });

        });
    </script>
</body>

</html>