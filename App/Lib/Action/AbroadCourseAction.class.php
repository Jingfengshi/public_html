<?php
class AbroadCourseAction extends Action
{

    protected $_permissionRes;

    protected $db;

    protected $courseData;

    public function _initialize(){
//        $action = array(
//            'permission'=>array(),
//            'allow'=>array('index','select_data')
//        );
//        B('Authenticate', $action);
//        $this->_permissionRes = getPerByAction(MODULE_NAME,ACTION_NAME);

        $this->db=D('AbroadCourse');
        //获取abroad_course数据并赋值给$courseData
        $this->courseData=$this->db->getAllData();
    }


    public function index()
    {
        if ($this->isAjax()) {
            $wheredata = $_REQUEST;
            $page = $wheredata['page'] ? $wheredata['page'] : 1;// 请求页码
            $limit = $wheredata['row'] ? $wheredata['row'] : 10;// 每页显示条数
            $count = count($this->courseData);

            $this->ajaxReturn([
                'result' => true,
                'lists' => array_values($this->courseData),
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
            if($this->db->addData()){
                $this->success('商城课程添加成功');
            }else{
                $this->error($this->db->getError());
            }
        }else{
            $category=D('AbroadCourseCategory')->getAllData();
            $this->assign('category',$category);
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
            $id=I('get.id',0,'intval');
            $oneData=$this->db->getDataById($id);
            $category=D('AbroadCourseCategory')->getAllData();
            $this->assign('category',$category);
            $this->assign('onedata',$oneData);
            $this->display();
        }
    }


    public function changeOnSale()
    {

        if($this->db->editData()){
            $data=[
                'status'=>1,
            ];
        }else{
            $data=[
                'status'=>0,
                'info'=>$this->db->getError()
            ];
        }
        $this->ajaxReturn($data);
    }

}