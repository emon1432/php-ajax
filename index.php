<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP & AJAX</title>
</head>

<body>
    <table id="main" border="0" cellspacing="0">
        <tr>
            <td id="header">
                <h1>PHP & AJAX CRUD</h1>
                <div id="search-bar">
                    <label>Search : </label>
                    <input type="text" id="search" autocomplete="off">
                </div>
                <br>
            </td>
        </tr>
        <tr>
            <td id="table-form">
                <form id="addForm">
                    Roll : <input type="text" id="roll">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name : <input type="text" id="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    <div id="modal">
        <div id="modal-form">
            <h2>Edit From</h2>
            <table cellpadding="10" width="100%">
            </table>
            <div id="close-btn">X</div>
        </div>
    </div>

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
            //save data
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
            //delete data
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
            //edit button
            $(document).on("click", ".edit-btn", function() {
                $('#modal').show();
                var studentRoll = $(this).data("eid");
                // alert(studentRoll);
                $.ajax({
                    url: "load-update.php",
                    type: "POST",
                    data: {
                        id: studentRoll
                    },
                    success: function(data) {
                        $("#modal-form table").html(data);
                    }
                });
            });
            $("#close-btn").on("click", function() {
                $('#modal').hide();

            });
            //save update
            $(document).on("click", "#edit-submit", function() {
                var stuId = $("#edit-id").val();
                var stuName = $("#edit-name").val();
                // alert(stuId);
                $.ajax({
                    url: "ajax-update.php",
                    type: "POST",
                    data: {
                        id: stuId,
                        name: stuName
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#modal').hide();
                            loadTable();
                        }

                    }
                });

            });
            //live search
            $("#search").on("keyup", function() {
                var search_term = $(this).val();
                $.ajax({
                    url: "ajax-live-search.php",
                    type: "POST",
                    data: {
                        search: search_term
                    },
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                });
            });

        });
    </script>
</body>

</html>