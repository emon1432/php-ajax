<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Insert</title>
</head>

<body>
    <table id="main" border="0" cellspacing="0">
        <tr>
            <td id="header">
                <h1>Insert & Remove Data by Ajax</h1>
            </td>
        </tr>
        <tr>
            <td id="table-form">
                <form id="addForm">
                    Roll : <input type="text" id="roll">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Name : <input type="text" id="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" id="save-button" value="Save">
                </form>
            </td>
        </tr>
        <tr>
            <td id="table-data">
            </td>
        </tr>
    </table>


    <div id="error-message"></div>
    <div id="success-message"></div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jQuery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                });
            }
            loadTable();
            $("#save-button").on("click", function(e) {
                e.preventDefault();
                var roll = $("#roll").val();
                var name = $("#name").val();
                if (roll == "" || name == "") {
                    $("#error-message").html("Please Fill the Form").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {
                            Roll: roll,
                            Name: name
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                                $("#addForm").trigger("reset");
                                $("#success-message").html("Data Inserted Successfully").slideDown();
                                $("#error-message").slideUp();
                            } else {
                                $("#error-message").html("Can't Save Record").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }

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