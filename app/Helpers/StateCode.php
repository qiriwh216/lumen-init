<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/14
 * Time: 上午11:14
 */

namespace App\Helpers;

class StateCode {

    /******* 状态 *******/
    const ORDER_INIT                = 0;
    const ORDER_CANCEL              = 500; // 已取消

    /******* OA用户 *******/
    const OA_USER_OK             = 0; // 正常
    const OA_USER_BAN            = 1; // 停用

    /***** 车位是否可见 ****/
    const PARKING_SPACE_VISIBLE = 1; //可见
    const PARKING_SPACE_NO_VISIBLE = 2; //不可见

    /***** 车位状态 *****/
    const PARKING_STATUS_INIT = 1; //可售
    const PARKING_STATUS_SALE = 2; //已售
    const PARKING_STATUS_NO_SALE = 3; //不可售
    const PARKING_STATUS_LOCK = 4; //4:已锁定
    const PARKING_STATUS_PAY = 5; //已付定金

    /****** 车位收购类型 ******/
    const  PARKING_PURCHASE_TYPE_BIAO = 1; // 标
    const  PARKING_PURCHASE_TYPE_YI = 2; // 议
    const  PARKING_PURCHASE_TYPE_WEI = 3; // 危

    /****** 车位产权类型 ******/
    const  PARKING_RIGHT_TYPE_UNKNOWN = 0; // 未知
    const  PARKING_RIGHT_TYPE_HAS = 1; // 产权
    const  PARKING_RIGHT_TYPE_NO = 2; // 人防
    const  PARKING_RIGHT_TYPE_NO_RF = 3; // 非产权非人防

    /****** 车位类型 ******/
    const  PARKING_TYPE_UNKNOWN = 0; // 未知，未设置
    const  PARKING_TYPE_BIAO = 1; // 标准
    const  PARKING_TYPE_CHEKU = 2; // 车库
    const  PARKING_TYPE_ZIMU = 3; // 字母
    const  PARKING_TYPE_KXING = 4; // 宽型
    const  PARKING_TYPE_CXING = 5; // 长型
    const  PARKING_TYPE_DORZHAI = 6; // 短或窄
    const  PARKING_TYPE_NOTING = 7; // 无法停
    const  PARKING_TYPE_WEIZIS = 8; // 微
    const  PARKING_TYPE_HAOHUAS = 9; // 豪华

    /***** 车位销控状态 *****/
    const  PARKING_MARKETY_CLOSE = 1; // 不启用
    const  PARKING_MARKETY_OPEN = 2; // 启用

    /***** 订单购买方式 ****/
    const ORDER_PURCHASE_METHOD_PREPAY = 1; // 定金+尾款
    const ORDER_PURCHASE_METHOD_PAY = 2; // 全款
    const ORDER_PURCHASE_METHOD_PREPAY_LOAN = 3; // 定金 + 贷款

    /***** 订单状态 ****/
    const ORDER_STATUS_INIT = 1; //1:未支付
    const ORDER_STATUS_SUCCESS = 2; //2:购买成功
    const ORDER_STATUS_DEPOSIT = 3; //已支付定金
    const ORDER_STATUS_CLOSE = 4; //订单关闭
    const ORDER_STATUS_HISTORY = 5; //历史订单
    const ORDER_STATUS_CANCEL = 6; //订单取消
    const ORDER_STATUS_DELETE = 7; //订单删除
    const ORDER_STATUS_REBACK = 8; //订单已回购
    const ORDER_STATUS_REFUND = 9; // 订单退款

    /**** 支付状态 ****/
    const PAY_STATUS_INIT = 1; //未支付
    const PAY_STATUS_SUCCESS = 2; //支付成功
    const PAY_STATUS_FAIL = 3; //支付失败
    const PAY_STATUS_REFUND = 4; //退款

    /**** 支付方式 *****/
    const PAY_TYPE_PREPAY = 1; //支付定金 + 支付尾款
    const PAY_TYPE_PAY = 2; //全款支付
    const PAY_TYPE_TAILPAY = 3; //支付尾款

    /**** 授权方式 *****/
    const OAUTH_SOURCE_CZY = 1; // 彩之云
    const OAUTH_SOURCE_GZH = 2; // 微信公众号
    const OAUTH_SOURCE_XCX = 3; // 小程序
    const OAUTH_SOURCE_CZZ_XCX = 4; // 彩住宅小程序

    /****** 支付类型 ******/
    const PAYMENT_TYPE_DJ = 1; //定金
    const PAYMENT_TYPE_WK = 2; //尾款
    const PAYMENT_TYPE_AJ = 3; //按揭
    const PAYMENT_TYPE_QK = 4; //全款

    /****** 项目状态 ******/
    const PROJECT_STATE_INIT = 0; // 可见
    const PROJECT_STATE_DELETE = 1; // 删除

    /****** 项目业务类型 ******/
    const PROJECT_TPYE_SELF = 1; // 包销
    const PROJECT_TYPE_AGENT = 2; // 代销

    /****** 奖励分配记录 ******/
    const USER_PROFIT_INIT = 0; // 待审核
    const USER_PROFIT_PASS = 1; // 审核通过(待发放)
    const USER_PROFIT_FAIL = 2; // 审核不通过
    const USER_PROFIT_SENT = 3; // 已发放

    /****** 奖励分配详情 ******/
    const USER_PROFIT_DETAIL_INIT = 0; // 初始状态
    const USER_PROFIT_DETAIL_ING = 1; // 待发放
    const USER_PROFIT_DETAIL_DEAL = 4; // 发放中
    const USER_PROFIT_DETAIL_SUCCESS = 2; // 已发放
    const USER_PROFIT_DETAIL_FAIL = 3; // 发放失败

    /****** 实名认证状态 ******/
    const IDENTITY_UNCERTIFIED = 1; // 未认证
    const IDENTITY_THREE_SUCCESS  = 2; // 三要素已认证成功
    const IDENTITY_FACE_CERTIFICATION  = 3; // 人脸认证中
    const IDENTITY_FACE_FAILED  = 4; // 人脸认证失败
    const IDENTITY_FACE_SUCCESS  = 5; // 人脸认证成功

    /****** 合同签约状态 ******/
    const CONTRACT_NOT_SIGNED = 1;  // 未签订
    const CONTRACT_SIGNING = 2;     // 签订中
    const CONTRACT_SIGNED = 3;      // 已签订

    /****** 后台权限状态 ******/
    const PERMISSION_STATE_INIT = 0;  // 正常
    const PERMISSION_STATE_BAN = 1;  // 禁用
    const ROLE_STATE_INIT = 0;  // 正常
    const ROLE_STATE_BAN = 1; // 禁用

    /****** 楼盘首页展示 ******/
    const BUILDING_HOME_DISPLAY_NO = 2;  // 不显示
    const BUILDING_HOME_DISPLAY_OK = 1; // 显示

    /****** 楼盘类型 ******/
    const BUILDING_TYPE_NORMAL = 1;  // 普通楼盘
    const BUILDING_TYPE_TEST = 2; // 体验楼盘

    /****** 楼盘建筑类型 ******/
    const BUILDING_USE_TYPE_HOUSE = 1;  // 住宅
    const BUILDING_USE_TYPE_PARKING = 2; // 车位
    const BUILDING_USE_TYPE_FLAT = 3;  // 公寓
    const BUILDING_USE_TYPE_STORE = 4; // 商铺

    /****** 楼盘价格单位 ******/
    const BUILDING_PRICE_TYPE_METER = 1;  // 元/㎡
    const BUILDING_PRICE_TYPE_UNIT = 2; // 元/个

    /****** 楼盘状态 ******/
    const BUILDING_STATUS_NO = 1;  // 未开盘
    const BUILDING_STATUS_OK = 2; // 已开盘
    const BUILDING_STATUS_FINISH = 3;  // 已售罄

    /****** 楼盘禁用或启用 ******/
    const BUILDING_ENABLED_NO = 0; // 禁用
    const BUILDING_ENABLED_OK = 1;  // 启用

    /****** 楼盘审核状态 ******/
    const BUILDING_AUDIT_STATUS_INIT = 0; // 未审核
    const BUILDING_AUDIT_STATUS_OK   = 1; // 审核通过
    const BUILDING_AUDIT_STATUS_NO   = 2; // 审核拒绝

    /****** 支付计划状态 ******/
    const PAY_PLAN_STATUS_OK = 0; // 生效
    const PAY_PLAN_STATUS_NO = 1; // 失效

    /***** 饭票返还计划状态 *****/
    const FP_PLAN_STATE_INIT = 0; // 待审核
    const FP_PLAN_STATE_PASS = 1; // 发送成功
    const FP_PLAN_STATE_REFUSE = 2; // 审核不通过
    const FP_PLAN_STATE_USE = 3; //  审核通过 发放中

    /******* 饭票详情发送状态 *********/
    const FP_PLAN_SEND_INIT = 0; // 待发送
    const FP_PLAN_SEND_PASS = 1; // 发送成功
    const FP_PLAN_SEND_FAIL = 2; // 发送失败

    /******* 饭票详情到账状态 *********/
    const FP_PLAN_DZ_INIT = 0; // 待到账
    const FP_PLAN_DZ_PASS = 1; // 已到账

    /********* 券码状态 ************/
    const CODE_STATE_INIT = 0; // 未使用
    const CODE_STATE_USE = 1; // 已使用

    /********* 预约看房签到状态 ************/
    const APPOINT_STATUS_INIT = 0; // 待签到
    const APPOINT_STATUS_CANCEL = 1; // 已取消
    const APPOINT_STATUS_SIGNED = 2; // 已签到
    const APPOINT_STATUS_EXPIRE = 3; // 已完结

    /********* 推荐看房签到状态 ************/
    const RECOMMEND_STATUS_INIT = 0; // 已提交
    const RECOMMEND_STATUS_REFUSE = 1; // 已拒绝
    const RECOMMEND_STATUS_APPOINTED = 2; // 已预约

    /********* 推荐看房签到状态 ************/
    const SIGN_NO = 0; // 不签到流程
    const SIGN_YES = 1; // 签到流程

    /********* 楼盘饭票宝显示 ************/
    const TICKET_DISPLAY_NONE = 0; // 不显示
    const TICKET_DISPLAY_BLOCK = 1; // 楼盘显示

    /******** 员工购 车位购买发放 ********/
    const YGG_BUY_TYPE_INIT = 0; // 现金购买
    const YGG_BUY_TYPE_LOAN = 1; // 贷款购买

    /***** 车位锁定 ****/
    const LOCK_STATE_INIT = 0; // 未锁定
    const LOCK_STATE_DONE = 1; // 已锁定

    /***** 饭票宝订单状态 ****/
    const TICKET_ORDER_INIT = 1; // 待支付
    const TICKET_ORDER_DONE = 2; // 已支付
    const TICKET_ORDER_RETURNED = 3; //已退回

    /****** 车位位置 ********/
    const PARKING_WZ_UNKNOWN = 0; //未知
    const PARKING_WZ_ONE = 1; // 紧挨入户口车位
    const PARKING_WZ_TWO = 2; // 入户口1-2排的车位（约20米内）
    const PARKING_WZ_THREE = 3; // 入户口2排以上车位（约20-40米范围）
    const PARKING_WZ_FOUR = 4; // 与电梯相离较远车位，看不到入户口（约40米以上）

    /****** 提现状态 ********/
    const WITHDRAW_STATE_INIT = 0; // 待入账
    const WITHDRAW_STATE_PASS = 1; // 已入账
    const WITHDRAW_STATE_REFUSE = 2; // 入账失败

    /****** 分期代扣状态 *******/
    const DK_STATE_INIT = 0; // 扣款中
    const DK_STATE_SUCCESS = 1; // 扣款成功
    const DK_STATE_FAIL = 2; // 扣款失败

    /***** 分期记录状态 **********/
    const FQ_STATE_INIT = 1; // 分期中
    const FQ_STATE_SUCCESS = 2; // 已完成
    const FQ_STATE_FAIL = 3; // 已断供

}