<?php


class Context
{
        public $text;

        public function deletecommit(){

        }
        public function addcommit(){?>
            <form>
                <label for="text" class="form-label">Enter new node text</label>
                <input type="text" class="form-control" id="text">
                <input type="submit" value="Добавить" class="btn btn-success">>
            </form>
        <?php }
}