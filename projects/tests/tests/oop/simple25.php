<?php
class SomeClass
{
    public function method1()
    {
        $query = "update linked_docs set deleted=1 where id='" . $_POST['signed_id'] . "'";
        $this->db->query($query);
    }

    public function method2()
    {
        global $focus;
        $focusId = $_REQUEST['record'];
        // $focusId = empty($focus->id) ? $_REQUEST['record'] : $focus->id;
        $where = "notes.parent_id='{$focusId}' AND notes.filename IS NOT NULL";
        $focus->get_full_list($where);
    }
}

$a = new SomeClass;
$a->method1();
