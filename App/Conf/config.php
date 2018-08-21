<?php
	return array(
		'SHOW_PAGE_TRACE'=>false,
		'URL_MODEL'=>0,
		'URL_CASE_INSENSITIVE' =>true,
		'TMPL_ACTION_ERROR' => 'Public:message', 
		'TMPL_ACTION_SUCCESS' => 'Public:message',
		'TMPL_EXCEPTION_FILE'=>'./App/Tpl/Public/exception.html',
		'DEFAULT_TIMEZONE' => 'PRC',
		'LOAD_EXT_CONFIG' => 'db,version,authorize.config,call',
		'LOG_RECORD' => true,
		'LOG_LEVEL'  =>'EMERG',
		'OUTPUT_ENCODE' => false,
	    'LANG_SWITCH_ON' => true,
	    'LANG_AUTO_DETECT' => true,
		'DEFAULT_LANG' => 'zh-cn', // 默认语言
	    'LANG_LIST' => 'en-us,zh-cn',
	    'VAR_LANGUAGE' => '1',
	    'COOKIE_PATH' => __ROOT__,
	    'SESSION_OPTIONS'=>array('cookie_path'=>__ROOT__),  
		'TOKEN_ON'=>false,  // 是否开启令牌验证
		'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
		'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
		'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true

		// 开启并添加路由 dragon 4-17
		'URL_ROUTER_ON'   => true, //开启路由
        'URL_ROUTE_RULES'=>array(
            'api/search_form_field'  	=> 'Api/searchFormField',
            'api/getinfo'            	=> 'Apply/getInfo',
            'api/edit_leads'      		=>  'Api/editLeads',
            'api/getpromote'      		=>  'Api/getPromote',
            'api/cooperate/getfields'   =>  'Cooperate/getfields',
            'api/cooperate/create/promote' =>  'Cooperate/createPromote',
            'api/cooperate/find/promote'   =>  'Cooperate/findPromote',
            'api/jigou/leads/create'   	   =>  'Api/createJigouLeads',
            'api/crontabnotice'           =>  'Api/crontabNoticeAdviser',
            'api/stuupload'          	   =>  'Api/stuupload',
            'api/koubei$'                       =>  'Api/koubeiApi',// 0807 新增口碑墙数据接口
            'api/koubei/upstar'               =>  'Api/koubeiUpstar',// 0807 新增口碑点赞接口



            # ----------
            'api/lead/create'      =>  'Form2CRM/create',
            'api/lead/fields'      =>  'Form2CRM/fields',
            'api/lead/verify'      =>  'Form2CRM/mobileVerify',
        ),


        'DB_CONFIG_EDU'=>array(
            'DB_TYPE'=>'mysql',
            'DB_HOST'=>'localhost',
            'DB_PORT'=>'3306',
            'DB_NAME'=>'education',
            'DB_USER'=>'root2',
            'DB_PWD'=>'laozhou',
            'DB_PREFIX'=>'',
        ),

        'TK_ROOM'=>array(
            'url'=>'http://global.talk-cloud.net/WebAPI/',
            'key'=>'PGxzTqaSNL0WEWTL',
        ),

	);
?>