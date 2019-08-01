<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/4/24
 * Time: 上午12:19
 */
namespace App\Helpers;


class ErrorCode {

    /*
    |10502
    |--------------------------------------------------------------------------|
    | 1                       | 05              | 02                           |
    |--------------------------------------------------------------------------|
    | 业务级错误[2为系统级错误]  | 服务模块代码     | 具体错误代码                   |
    |--------------------------------------------------------------------------|
    */

    const SUCCESS = 0; // 请求成功

    // 业务级错误
    const SYSTEM_ERROR              = 10000;    // 系统错误
    const UNAUTHORIZED_REQUEST      = 10001;    // 未经授权的请求
    const UNAUTHORIZED_MOBILE_EMPTY      = 10011;    // 手机号为空

    const REQUEST_PARAM_ERROR       = 10002;    // 请求参数错误
    const REQUEST_PARAM_EMPTY       = 10003;    // 请求参数获取数据为空
    const UNAUTHORIZED_PERMISSION   = 10005;    // 无权限的请求
    const BINDING_RELATIONSHIP_DOES_NOT_EXIS   = 10006;    // 绑定关系不存在


    // 系统级错误
    const DB_ERROR                  = 20000;    // 数据库错误
    const DB_ERROR_INSERT           = 20001;    // 数据库写入错误
    const DB_ERROR_UPDATE           = 20002;    // 数据库更新错误
    const DB_ERROR_SELECT           = 20003;    // 数据库更新错误

    const UPLOAD_FILE_ERROR         = 20101;    // 文件上传错误
    const UPLOAD_FILE_EXISTS_NO     = 20102;    // 上传文件不存在

    const INTERFACE_ERROR_OAUTH     = 20201;    // 授权接口错误
    const INTERFACE_ERROR_ADDRESS   = 20202;    // 地址接口错误
    const INTERFACE_ERROR_FP        = 20203;    // fp接口错误
    const INTERFACE_ERROR_SMS       = 20204;    // 短信接口错误
    const INTERFACE_ERROR_COLOUR    = 20205;    //彩之云接口错误

}
