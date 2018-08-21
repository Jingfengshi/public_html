<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 线索创建接口（表单提交地址）、获取验证码接口
    |--------------------------------------------------------------------------
    */
    // 线索创建接口
    '_api'              =>  'http://crm.xiaoying.net/api/lead/create',
    // 获取验证码接口
    '_verify'           =>  'http://crm.xiaoying.net/api/lead/verify',

    /*
    |--------------------------------------------------------------------------
    | 线索生成后 邮件通知地址
    |--------------------------------------------------------------------------
    */
    '_mailto'           =>  [
        'lei.xingting@everelite.com',
        'li.jinglong@xiaoying.net',
    ],

    '_mailtpl'          =>  '来自于评估页面，为精准用户，科学分配给对应的顾问，尽快电话对应。以上内容已录入CRM系统，请顾问随时在CRM反馈跟进进度。谢谢',

    /*
    |--------------------------------------------------------------------------
    | 开发者  （异常通知）
    |--------------------------------------------------------------------------
    |
    */
    '_developer'        =>  'jia.longfei@xiaoying.net',


    /*
    |--------------------------------------------------------------------------
    | 线索生成后 非陪规则
    |--------------------------------------------------------------------------
    |   1 ： person (负责人)
    |   2 :  random (随机)
    |   默认分配给机器人
    |
    */
    '_regular'          =>  1,

    /*
    |--------------------------------------------------------------------------
    | 机器人ID
    |--------------------------------------------------------------------------
    */
    '_robot'            =>  62,

    /*
    |--------------------------------------------------------------------------
    | 允许请求的域名列表(主域)
    |--------------------------------------------------------------------------
    | 严格按照 xiaoying.net 格式 ， 禁止加 域名前缀
    |
    */
    '_allow_domains'    =>  [
        'xiaoying.net',
        'eggelite.com',
        'xiao-ying.net',
        'newtokio.cn',
        'newi.local',// kz测试用
    ],

    /*
    |--------------------------------------------------------------------------
    | 线索等级
    |--------------------------------------------------------------------------
    |
    */
    '_block'            =>[
        // 上海校区
        1       =>  ['上海','浙江','辽宁','黑龙江','吉林','北京','广东','安徽','上海','香港','澳门','海外',],
        // 苏州
        4       =>  ['江苏','山西','河北','天津','内蒙','河南','山东','江西','福建','湖南'],
        // 成都
        3       =>  ['四川','成都','云南','贵州','湖北','广西','甘肃','陕西','宁夏','海南'],
        // 东京
        2       =>  [],
    ],

    /*
    |--------------------------------------------------------------------------
    | 线索字段信息
    |--------------------------------------------------------------------------
    | 字段类型、验证规则（前后端一致）
    |
    */
    '_fields'           =>  [
        // 必选字段
        'XY_a01'        =>  [
            'field'=>'contacts_name',
            'name'=>'线索名称',
            'type'=>1,
            'value'=>[],
            'must'=>true,
            'main'=>true,
            '_v'=>'required|max:30'
        ],
        'XY_a02'        =>  [
            'field'=>'mobile',
            'name'=>'电话',
            'type'=>1,
            'value'=>[],
            'must'=>true,
            'main'=>true,
            '_v'=>'required|phone'
        ],
        'XY_a03'        =>  [
            'field'=>'cluecate',
            'name'=>'线索所属分类',
            'type'=>2,
            'value'=>'',
            'must'=>false,
            'main'=>true,
            '_v'=>'in:@LIST'
        ],

        // 可选字段
        'XY_b01'        =>  [
            'field'=>'name',
            'name'=>'真实姓名',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'min:1|max:30'
        ],
        'XY_b02'        =>  [
            'field'=>'email',
            'name'=>'邮件',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'email'
        ],
        'XY_b03'        =>  [
            'field'=>'now_university',
            'name'=>'所在学校',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'min:1|max:100'
        ],
        'XY_b04'        =>  [
            'field'=>'now_major',
            'name'=>'所在专业',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'min:1|max:100'
        ],
        'XY_b05'        =>  [
            'field'=>'saltname',
            'name'=>'昵称',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b06'        =>  [
            'field'=>'source',
            'name'=>'来源',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b07'        =>  [
            'field'=>'expect_university',
            'name'=>'期望学校',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'min:1|max:300'
        ],
        'XY_b08'        =>  [
            'field'=>'recommend_name',
            'name'=>'推荐机构或推荐人',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:100'
        ],
        'XY_b09'        =>  [
            'field'=>'crm_when',
            'name'=>'出国时间',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b10'        =>  [
            'field'=>'expect_major',
            'name'=>'期望专业',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b11'        =>  [
            'field'=>'crm_qq',
            'name'=>'QQ/微信',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:20'],
        'XY_b12'        =>  [
            'field'=>'level_jp',
            'name'=>'日语水平',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b13'        =>  [
            'field'=>'crm_city',
            'name'=>'所在城市',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b14'        =>  [
            'field'=>'level_en',
            'name'=>'英语水平',
            'type'=>4,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:1000'
        ],
        'XY_b15'        =>  [
            'field'=>'xingge',
            'name'=>'性格类型',
            'type'=>9,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b16'        =>  [
            'field'=>'decision_marker',
            'name'=>'留学决策人',
            'type'=>3,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:20'
        ],
        'XY_b17'        =>  [
            'field'=>'decision_marker_contact',
            'name'=>'决策人联系方式',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'phone'
        ],
        'XY_b18'        =>  [
            'field'=>'seat_id',
            'name'=>'讲座报道序号',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'number'
        ],
        'XY_b19'        =>  [
            'field'=>'grade',
            'name'=>'所在年级',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:30'
        ],
        'XY_b20'        =>  [
            'field'=>'apply_country',
            'name'=>'申请国家',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:100'
        ],
        'XY_b21'        =>  [
            'field'=>'description',
            'name'=>'备注',
            'type'=>4,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'max:1000'
        ],
        'XY_b22'        =>  [
            'field'=>'liuxuejigou',
            'name'=>'咨询过的留学机构',
            'type'=>4,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'max:1000'
        ],
        'XY_b23'        =>  [
            'field'=>'zhongchengdu',
            'name'=>'对日留学意向，是否考虑其他国家',
            'type'=>4,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'max:1000'
        ],
        'XY_b24'        =>  [
            'field'=>'crm_level',
            'name'=>'客户等级',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b25'        =>  [
            'field' =>  'how_do_you_know',
            'name'=>'从哪里知道我们',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b26'        =>  [
            'field' =>  'want_zl',
            'name'=>'感兴趣的资料',
            'type'=>4,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b27'        =>  [
            'field' =>  'why_want_jn',
            'name'=>'学习日语的原因',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b28'        =>  [
            'field' =>  'crm_url',
            'name'=>'表单提交地址',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'required'
        ],
        'XY_b29'        =>  [
            'field' =>  'zh_city',
            'name'=>'展会参展城市',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:30'
        ],
        'XY_b30'        =>  [
            'field' =>  'zh_time',
            'name'=>'展会参展时间',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'max:30'
        ],
        'XY_b31'        =>  [
            'field' =>  'jp_know',
            'name'=>'对日本的了解程度',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b32'        =>  [
            'field' =>  'crm_srmkfd',
            'name'=>'出国准备阶段预算',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b33'        =>  [
            'field' =>  'want_plan',
            'name'=>'感兴趣的方案',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b34'        =>  [
            'field' =>  'crm_apwocj',
            'name'=>'想要获取什么资料',
            'type'=>2,
            'value'=>[],
            'must'=>false,
            'main'=>true,
            '_v'=>'@TYPE:@LIST'
        ],
        'XY_b35'        =>  [
            'field' =>  'pre',
            'name'=>'国际区号',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'min:2|max:6'
        ],

        'XY_c01'        =>  [
            'field' =>  'goto',
            'name'=>'线索分类标识',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'min:1|max:20'
        ],

        'XY_c02'        =>  [
            'field' =>  'sms',
            'name'=>'短信验证码',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'required|max:10'
        ],

        'XY_c03'        =>  [
            'field' =>  'password',
            'name'=>'注册密码',
            'type'=>1,
            'value'=>[],
            'must'=>false,
            'main'=>false,
            '_v'=>'required|min:6|max:10'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | token 标识
    |--------------------------------------------------------------------------
    | ！ 禁止随意更改
    |
    */
    '_token_sign'       =>  'C-token'.'-'.md5( date('d') ),

    /*
    |--------------------------------------------------------------------------
    | 手机验证码 标识
    |--------------------------------------------------------------------------
    | ！ 禁止随意更改
    |
    */
    // 验证码服务端session标识
    '_mobile_verify_sign'       =>  'CRM_verify_code',

    // 验证码有效期（秒）
    '_mobile_verify_expr'       =>  1200,
];
