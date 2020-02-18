<?php
//ini_set("display_errors", 1);
//error_reporting(0);
include './Database.php';
$obj=new Database();
if ($_REQUEST['mode'] == 'add') {
        $obj->Add($_REQUEST);
    }
$view = $obj->ViewCategories();
$rs =$obj->Categories();

?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head> 
    <body>

        <form id="formname" name="formname" method="post" action="submitform.asp" >
            <table width="50%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td width="41%" align="right" valign="middle">Category :</td>
                    <td width="59%" align="left" valign="middle">

                        <select name="category" id="category" onchange="">
                            <option value="0">Select Category</option>
                            <?php
                            foreach ($rs as $key => $value) {
                                ?>
                                <option value="<?= $key; ?>"><?= $value ?></option>
                            <?php } ?>

                        </select></td>
                </tr>
                <tr>
                    <td align="right" valign="middle">Sub Category :</td>
                    <td align="left" valign="middle">
                        <input type="text" name="subcategory" id='subcategory'/>
                    <!--<select name="subcategory" id="subcategory" >
                    <option value="0">Select Sub-Category</option>
                    <option value="2">Select Sub-Category</option>
                    <option value="3">Select Sub-Category</option>
                    <option value="4">Select Sub-Category</option>
                    </select>-->
                    </td>
                    <td><input type="button" name="btn" value="Add" onclick="add()"/></td>
                </tr>

            </table>

        </form> 

        <table width="50%" border="0" cellspacing="0" cellpadding="5" style="border: 1px solid">
            <tr>
                <th>Parent</th>
                <th>Child</th>
            </tr>
            <?php
            foreach ($view as $key => $value) {
                $child = implode(",", $value);
                ?>
                <tr>
                    <th><?= $key ?></th>
                    <th><?= $child ?></th>
                </tr>            
            <?php } ?>

        </table>
</html>

<script>
    function add() {
        cat = $('#category').val();
        subcat = $('#subcategory').val();

        d = "cat=" + cat + "&subCat=" + subcat + "&mode=add";
        $.ajax({
            type: "POST",
            url: "index.php",
            data: d,
            success: function (res) {
                alert(res);
                location.reload();
            }

        });
    }
</script>