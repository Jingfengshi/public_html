<?php

class CourseOrderModel extends Model
{
    protected $DB_Name='education';

    protected $dbName ='mxcrm';

    protected $tableName='abroad_order';

    public function getDataBy($field='all',$condition=array()){
        if($field=='all'){
            $data=$this->alias('o')
                ->field('o.*,u.realname name')
                ->join("JOIN {$this->DB_Name}.students u ON u.id = o.member_id")
                ->where($condition)
                ->select();
            return $data;
        }else{
            return $this->getField("cid,$field");
        }
    }
}