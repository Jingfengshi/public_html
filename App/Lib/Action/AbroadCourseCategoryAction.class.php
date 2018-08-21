<?php
class AbroadCourseCategoryAction extends Action
{

    protected $_permissionRes;

    protected $db;

    protected $categoryData;

    public function _initialize(){
        $action = array(
            'permission'=>array(),
            'allow'=>array('index','select_data')
        );
        B('Authenticate', $action);
        $this->_permissionRes = getPerByAction(MODULE_NAME,ACTION_NAME);

        //初始化时实例化category model
        $this->db=D('AbroadCourseCategory');
        //获取category数据并赋值给$categoryData
        $this->categoryData=$this->db->getAllData();

    }

    public function index()
    {
        if ($this->isAjax()) {
            $wheredata = $_REQUEST;
            $page = $wheredata['page'] ? $wheredata['page'] : 1;// 请求页码
            $limit = $wheredata['row'] ? $wheredata['row'] : 10;// 每页显示条数
            $count = count($this->categoryData);

            $this->ajaxReturn([
                'result' => true,
                'lists' => array_values($this->categoryData),
                'count'=>$count,
                'total'=>ceil($count / $limit),
                '_sql' => $this->db->getLastSql()
            ]);
        }
        $this->display();

    }

    public function  add()
    {
        if(IS_POST){
            if($this->db->addData()){
                $this->success('分类添加成功');
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $cid=I('get.cid',0,'intval');
            if($cid){
                $this->assign('cid',$cid);
            }
            $this->assign('data',$this->categoryData);
            $this->display();
        }
    }

    public function edit()
    {
        if(IS_POST){
            if($this->db->editData()){
                $this->success('修改成功');
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $cid=I('get.cid',0,'intval');
            $onedata=$this->db->getDataByCid($cid);
            $data=$this->categoryData;
            $childs=$this->db->getChildData($cid);
            foreach ($data as $k => $v) {
                if(in_array($v['cid'], $childs)){
                    $data[$k]['_html']=" disabled='disabled' style='background:#F0F0F0'";
                }else{
                    $data[$k]['_html']=" ";
                }
            }
            $this->assign('data',$data);
            $this->assign('onedata',$onedata);
            $this->display();
        }
    }

    public function delete()
    {
        $input=$_REQUEST;
        $this->db->startTrans();
        try {
            foreach ($input['id'] as $cid)
            {
                if(!$this->db->deleteData($cid)){
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
        p($data);
        die;
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