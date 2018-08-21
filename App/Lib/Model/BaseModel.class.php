<?php
class BaseModel extends Model
{
    /* 创建时间 */
    public function createTime() {
        return date('Y-m-d H:i:s',time());
    }

    public function getUserId()
    {
        return session('role_id');
    }
}