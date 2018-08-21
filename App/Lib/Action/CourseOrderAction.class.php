<?php

class CourseOrderAction extends Action
{
    public function __construct()
    {
        $this->db=D('CourseOrder');
    }


    public function index()
    {
        if ($this->isAjax()) {
            $wheredata = $_REQUEST;
            $page = $wheredata['page'] ? $wheredata['page'] : 1;// 请求页码
            $limit = $wheredata['row'] ? $wheredata['row'] : 10;// 每页显示条数
            $condition=array();
            $data=$this->db->getDataBy('all',$condition);
            $count = count($data);
            $this->ajaxReturn([
                'result' => true,
                'lists' => array_values($data),
                'count'=>$count,
                'total'=>ceil($count / $limit),
                '_sql' => $this->db->getLastSql()
            ]);
        }
        $this->display();
    }





}