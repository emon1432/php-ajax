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


    <table id="table-data" border="1" width="50%" align="center" cellspacing="0" cellpadding="10px">

    </table>

    <div id="error-message"></div>
    <div id="success-message"></div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jQuery.js"></script>
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
        
            $(document).on("click", "#delete-btn", function() {
                if (confirm("Do you want to delete this record?")) {
                    var studentRoll = $(this).data("id");
                    var element = this;
                    // alert(studentRoll);
                    $.ajax({
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {
                            roll: studentRoll
                        },
                        success: function(data) {
                            if (data == 1) {
                                $(element).closest("tr").fadeOut();
                            } else {
                                $("#error-message").html("Can't Delete Record").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }
            });



        });
    </script>


</body>

</html>