<?php
class Db
{
    protected $tableName;
    protected $wheres = [];

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getSelect()
    {
        $sql = "SELECT * FROM '{$this->tableName}'";
        if (!empty($this->wheres_sql)) {
            $sql .= $this->wheres_sql;
        }
        return $sql;
    }

    public function getDelete()
    {
        $sql = "DELETE FROM '{$this->tableName}'";
        if (!empty($this->wheres_sql)) {
            $sql .= $this->wheres_sql;
        }
        return $sql;
    }


    public function Where($arr, $logic = null)
    {
        $this->wheres_sql = " WHERE ";
        if($logic == null){
            $logic = "=";
        }
        foreach ($arr as $key => $value) {
            
            foreach ($value as $keyi => $valuei) {
                $key_last = array_key_last($value);
                $this->wheres_sql .=" '" . $valuei . "' " ;
                if ($value[$keyi] != $value[$key_last]) {
                    $this->wheres_sql .= " ".$logic." ";
                } else if (count($arr)-1 != $key){
                    $this->wheres_sql .= " AND ";
                } else {
                    $this->wheres_sql .= " ";
                }
            }
        }
        return $this;
    }
}

$db = new Db();
echo $db->table('goods')->getSelect();
echo '<br>';
print_r($db->table('user')->Where([['name', 'admin']], '>')->getSelect());
echo '<br>';
print_r($db->table('user')->Where([['id', '5']], '=')->getSelect());
echo '<br>';
print_r($db->table('user')->Where([['name', 'admin']])->getDelete());
// echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->get();