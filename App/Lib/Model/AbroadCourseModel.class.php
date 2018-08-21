<?php
class AbroadCourseModel extends BaseModel
{

    // 自动验证
    protected $_validate=array(
        array('title','require','课程名必须填写'),
        array('image','require','课程主图必须上传'),
        array('image','require','课程主图必须上传'),
        array('price','require','课程价格必须填写'),
    );

    /* 自动完成 */
    protected $_auto = array(
        array('updated_at', 'createTime', self::MODEL_BOTH, 'callback'),
        array('created_at', 'createTime', self::MODEL_INSERT, 'callback'),
        array('creator_id', 'getUserId', self::MODEL_INSERT, 'callback'),
        array('updater_id', 'getUserId', self::MODEL_BOTH, 'callback'),
    );

    /* 创建时间 */
    public function createTime() {
        return date('Y-m-d H:i:s',time());
    }

    public function getUserId()
    {
        return session('role_id');
    }


    //添加数据
    public function addData(){
        $data=I('post.');
        //上传图片

        $data['image']=$this->upload();
        $data['created_at']=date('Y-m-d H:i:s',time());

        if($this->create($data)){
            return $this->add();
        }
    }




    public function getAllData($field='all'){
        if($field=='all'){
            $data=$this->alias('course')
                ->field('course.*,cate.cname')
                ->join('JOIN mx_abroad_course_category cate ON cate.cid = course.cate_id')
                ->where('is_delete=1')
                ->select();
            return $data;
        }else{
            return $this->getField("cid,$field");
        }
    }


    public function editData()
    {
        $data=I('post.');
        if($this->create($data)){
            return $this->where(array('id'=>$data['id']))->save($data);
        }
    }

    public function getDataById($id,$field='all'){
        if($field=='all'){
            return $this->where(array('id'=>$id))->find();
        }else{
            return $this->where(array('id'=>$id))->getField($field);
        }

    }

    public function upload()
    {
        if (!empty($_FILES)) {
            // 如果有文件上传 上传附件
            import('@.ORG.UploadFile');
            //导入上传类
            $upload = new UploadFile();
            //设置上传文件大小
            $upload->maxSize = 20000000;
            //设置附件上传目录
            $dirName = UPLOAD_PATH . date('Ym', time()) . '/' . date('d', time()) . '/';
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->thumbRemoveOrigin = false;//是否删除原文件
            if (!is_dir($dirName) && !mkdir($dirName, 0777, true)) {
                die(L('ATTACHMENTS TO UPLOAD DIRECTORY CANNOT WRITE'));
            }
            $upload->savePath = $dirName;

            if (!$upload->upload()) {// 上传错误提示错误信息
                die($upload->getErrorMsg());
            } else {// 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
                if (is_array($info[0]) && !empty($info[0])) {
                    $upload = $dirName . $info[0]['savename'];
                } else {
                    die('文件上传失败，请重试！');
                }
                // 返回文件路径
                return $upload ?: '';
            }
        }
        return '';

    }

}