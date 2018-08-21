<?php
class CourseCouponModel extends BaseModel
{
    protected $tableName='coupon_codes';
    // 自动验证
    protected $_validate=array(
        array('title','require','优惠券名称必须填写'),
        array('type','require','优惠券类型必须选择'),
        array('value','require','优惠值必须填写'),
        array('total','require','总量必须填写'),
        array('min_amount','require','最低金额必须填写'),
    );

    protected $_auto=array(
        array('updated_at', 'createTime', self::MODEL_BOTH, 'callback'),
        array('created_at', 'createTime', self::MODEL_INSERT, 'callback'),
        array('creator_id', 'getUserId', self::MODEL_INSERT, 'callback'),
        array('updater_id', 'getUserId', self::MODEL_BOTH, 'callback'),
    );


    // 用常量的方式定义支持的优惠券类型
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    public  $typeMap = [
        self::TYPE_FIXED   => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];


    public function getDataBy($field='all',$condition=array()){
        if($field=='all'){
            $data=$this->alias('cc')
                ->field('cc.*,u.name')
                ->join('JOIN mx_user u ON u.user_id = cc.creator_id')
                ->where($condition)
                ->order('id desc')
                ->select();
            foreach ($data as $key=>$val){
                if($val['type']==self::TYPE_FIXED){
                    $data[$key]['_value']='满'.str_replace('.00', '',$val['min_amount']).'减'.str_replace('.00', '',$val['value']);
                }
                if($val['type']==self::TYPE_PERCENT){
                    $data[$key]['_value']='满'.str_replace('.00', '',$val['min_amount']).'优惠'.str_replace('.00', '',$val['value']).'%';
                }
                $data[$key]['_total']=$val['used'].'/'.$val['total'];
                $data[$key]['_type']=$this->typeMap[$val['type']];
            }
            return $data;
        }else{
            return $this->getField("cid,$field");
        }
    }


    public function addData(){
        $data=I('post.');
        if($data=$this->create($data)){
            if(isset($data['code']) && $data['code']!=''){
                if($this->where(array('code'=>$data['code']))->find()){
                    $this->error='该优惠码已经存在';
                    return false;
                }
            }else{
                $data['code']=$this->findAvailableCode(16);
            }
            if(!is_numeric($data['value'])){
                $this->error='折扣值必须为数字';
                return false;
            }
            if(!is_numeric($data['min_amount'])){
                $this->error='最低金额必须为数字';
                return false;
            }
            if(!is_numeric($data['total'])){
                $this->error='总量必须为数字';
                return false;
            }
            if($data['type']==self::TYPE_FIXED && $data['value']<0.01){
                $this->error='固定金额时,折扣值必须大于0.01';
                return false;
            }
            if($data['type']==self::TYPE_PERCENT && ($data['value']<1 || $data['value']>99)){
                $this->error='比例时,折扣值必须为1~99';
                return false;
            }
            return $this->add($data);
        }
    }


    public  function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(getRandChar($length));
            // 如果生成的码已存在就继续循环
        } while ($this->where(array('code'=>$code))->find());

        return $code;
    }


    public function getDataById($id,$field='all'){
        if($field=='all'){
            return $this->where(array('id'=>$id))->find();
        }else{
            return $this->where(array('id'=>$id))->getField($field);
        }

    }

    public function editData(){
        $data=I('post.');
        if($data=$this->create($data)){
            if(isset($data['code']) && $data['code']!=''){
                if($this->where(array('code'=>$data['code'],'id'=>'!='.$data['id']))->find()){
                    $this->error='该优惠码已经存在';
                    return false;
                }
            }else{
                $data['code']=$this->findAvailableCode(16);
            }
            if(!is_numeric($data['value'])){
                $this->error='折扣值必须为数字';
                return false;
            }
            if(!is_numeric($data['min_amount'])){
                $this->error='最低金额必须为数字';
                return false;
            }
            if(!is_numeric($data['total'])){
                $this->error='总量必须为数字';
                return false;
            }
            if($data['type']==self::TYPE_FIXED && $data['value']<0.01){
                $this->error='固定金额时,折扣值必须大于0.01';
                return false;
            }
            if($data['type']==self::TYPE_PERCENT && ($data['value']<1 || $data['value']>99)){
                $this->error='比例时,折扣值必须为1~99';
                return false;
            }
            return $this->where(array('id'=>$data['id']))->save($data);
        }
    }


    public function deleteData($id){
        if($this->where(array('id'=>$id))->save(array('is_delete'=>0))){
            return true;
        }else{
            return false;
        }
    }






}