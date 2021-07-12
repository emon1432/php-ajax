<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="serialize-form-style.css">
    <title>Serialize</title>
</head>

<body>
    <div id="main">
        <div id="header">
            <h1>PHP & Ajax Serialize Form</h1>
        </div>

        <div id="table-data">
            <form id="submit-form">
                <table width="100%" cellpadding="10px">
                    <tr>
                        <td width="150px"><label>Name</label></td>
                        <td><input type="text" name="fullname" id="fullname" /></td>
                    </tr>
                    <tr>
                        <td><label>Age</label></td>
                        <td><input type="number" name="age" id="age" /></td>
                    </tr>
                    <tr>
                        <td><label>Gender</label></td>
                        <td>
                            <input type="radio" name="gender" value="male" />Male
                            <input type="radio" name="gender" value="female" />Female
                        </td>
                    </tr>
                    <tr>
                        <td><label>Country</label></td>
                        <td>
                            <select name="country">
                                <option value="bd">Bangladesh</option>
                                <option value="ind">India</option>
                                <option value="pk">Pakisthan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" name="submit" id="submit" class="btn btn-info" value="submit"></td>
                    </tr>
                </table>
            </form>
            <div id="response"></div>
        </div>
    </div>
    <script type="text/javascript" src="js/jQuery.js"></script>
    <script>
        $(document).ready(function() {
            $("#submit").click(function() {
                var name = $("#fullname").val();
                var age = $("#age").val();
                if (name == "" || age == "" || !$('input:radio[name=gender]').is(':checked')) {
                    $("#response").fadeIn();
                    $("#response").removeClass('success-msg').addClass('error-msg').html('All Fields are required!!!');
                    setTimeout(function() {
                        $('#response').fadeOut("slow");
                    }, 4000);
                } else {
                    // $('#response').html($('#submit-form').serialize());
                    $.ajax({
                        url: "serialize-load.php",
                        type: "POST",
                        data: $('#submit-form').serialize(),
                        beforeSend: function() {
                            $("#response").fadeIn();
                            $("#response").removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
                        },
                        success: function(data) {
                            $('#submit-form').trigger("reset");
                            $("#response").fadeIn();
                            $("#response").removeClass('error-msg').addClass('success-msg').html(data);
                            setTimeout(function() {
                                $('#response').fadeOut("slow");
                            }, 4000);
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>