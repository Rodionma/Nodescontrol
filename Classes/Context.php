<?php


class Context//class that working with dialog windows
{


    public static function DeleteCommit($id)//Delete Dialog Window
    {?>
        <div class='dialogwindow'>
            <form method='get'  class='deletefrm frm'>
                <label  class='form-label'>Are you sure that you want to delete?</label>
                <input type='hidden' name="parrent" id='parrent' value='<?echo $id?>'>
                <hr>
                <input type='button' value='Cancel' class='cancel btn btn-success'>
                <input type='submit' value='Delete' class='btn btn-danger'>
            </form>
            <div class="timer">20</div>
        </div>
        <?php
    }
    public static function AddCommit($id){//Add Dialog Window

        ?>  <div class='dialogwindow'><form method='get'  class='addfrm frm'>
                <label for='text' class='form-label'>Enter new node text</label>
                <input type='text' class='form-control' id='textadd' name="textadd">
                <input type='hidden' name="parrent" id='parrent' value='<?echo $id?>'>
                <hr>
                <input type='submit' value='Add' class='btn btn-success'>
            </form></div>
        <?php


    }
}