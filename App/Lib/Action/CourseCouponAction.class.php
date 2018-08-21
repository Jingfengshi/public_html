<?php

class CourseCouponAction extends Action
{

    protected $db;

    public function __construct()
    {
        $this->db = D('CourseCoupon');
    }


    public function index()
    {
        if ($this->isAjax()) {
            $wheredata = $_REQUEST;
            $page = $wheredata['page'] ? $wheredata['page'] : 1;// 请求页码
            $limit = $wheredata['row'] ? $wheredata['row'] : 10;// 每页显示条数
            $condition=array();
            $condition['is_delete']=1;
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


    public function add()
    {
        if(IS_POST){
            if($aid=$this->db->addData()){
                $this->redirect(U('CourseCoupon/add'));
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $this->assign('category',$this->db->typeMap);
            $this->display();
        }
    }

    public function edit(){
        if(IS_POST){
            if($this->db->editData()){
                $this->redirect(U('CourseCoupon/index'));
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $id=I('get.id',0,'intval');
            $one_data=$this->db->getDataById($id);
            $this->assign('one_data',$one_data);
            $this->assign('category',$this->db->typeMap);
            $this->display();
        }
    }


    public function delete()
    {
        $input=$_REQUEST;
        $this->db->startTrans();
        try {
            foreach ($input['id'] as $id)
            {
                if(!$this->db->deleteData($id)){
                    throw new Exception($this->db->getError());
                }
            }
            $this->db->commit();
            $data=[
                'status'=>1,
            ];
        }catch(\Exception $e){
            $data=[
                'status'=>0,
                'info'=>$e->getMessage()
            ];
        }
        if($data['status']){
            $this->ajaxReturn([
                'status'=>1,
            ]);
        }else{
            $this->ajaxReturn([
                'status'=>0,
                'info'=>$this->db->getError()
            ]);
        }
    }

}