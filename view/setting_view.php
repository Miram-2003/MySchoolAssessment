<?php
$lable ="";
if (isset($_POST['action'])) {
    $lable = $_POST['action'];

    $form = "<div class='container bg-light'>";
    $form .= " <form action='../action/edit action.php' method='post' class='addForm'>
        <div class='form-group'>     
        <label for=''>$lable</label></b>
        <input type='text' class='form-control' id='name' name='name' value=''>
        <input type='hidden' class='form-control' name='action' value='$lable'>
        <button type='submit' name='nameSubmit' class='register btn btn-primary'>Add $lable</button>
        <button type='button'onclick='history.back()' class='register btn btn-secondary' >Cancel</button><br>
        <br><br>
        </div>
        </form></div>";
        echo $form;

}else{
    exit();
}
?>