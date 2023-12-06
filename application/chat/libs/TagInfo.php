<?php
namespace app\chat\libs;


class TagInfo
{

    public static function getTagInfo($uid)
    {
        $data['Friends'] = self::friendList($uid);
        $data['PrivateLetter'] = self::privateLetterList($uid);
        $data['Group'] = self::groupList($uid);

        return [
            'code' => 4,
            'msg' => 'success',
            'data' => [
                'mine' => 0,
                'listtags' => self::tagList(),
                'users' => $data
            ]
        ];
    }

    // 好友列表
    public static function friendList($uid)
    {
        $friendList = \app\chat\libs\ChatDbHelper::getFriendList($uid, 200);
        // {"code":4,"msg":"success","data":{"mine":0,"listtags":[{"listtagid":"1","listtagname":"我的好友"},{"listtagid":"2","listtagname":"我的群聊"}],"users":{"1":[{"fd":7,"name":"bookapi","avatar":"/uploads/c81e728d9d4c2f636f067f89cc14862c/avatar/20231121/dbdc4662fc214ba89ada1ab7088905b7_middle.jpeg","email":"3528@qq.com","time":"10:31","listtagid":"a"}],"2":[]}}}
        $data = [];
        foreach ($friendList as $userInfo) {
            $data[$userInfo['uid']]['nickname'] = $userInfo['nickname'];
            $data[$userInfo['uid']]['head_image'] = $userInfo['head_image'];
            $data[$userInfo['uid']]['message_count'] = $userInfo['message_count'];
            $data[$userInfo['uid']]['uid'] = $userInfo['uid'];
        }
        return $data;
    }

    public static function privateLetterList($uid)
    {
        $friendList = \app\chat\libs\ChatDbHelper::getPrivateLetterList($uid, 200);
        // {"code":4,"msg":"success","data":{"mine":0,"listtags":[{"listtagid":"1","listtagname":"我的好友"},{"listtagid":"2","listtagname":"我的群聊"}],"users":{"1":[{"fd":7,"name":"bookapi","avatar":"/uploads/c81e728d9d4c2f636f067f89cc14862c/avatar/20231121/dbdc4662fc214ba89ada1ab7088905b7_middle.jpeg","email":"3528@qq.com","time":"10:31","listtagid":"a"}],"2":[]}}}
        $data = [];
        foreach ($friendList as $userInfo) {
            $data[$userInfo['uid']]['nickname'] = $userInfo['nickname'];
            $data[$userInfo['uid']]['head_image'] = $userInfo['head_image'];
            $data[$userInfo['uid']]['message_count'] = $userInfo['message_count'];
            $data[$userInfo['uid']]['uid'] = $userInfo['uid'];
        }
        return $data;
    }

    public static function groupList($uid)
    {
        return [];
    }

    public static function tagList()
    {
        return [
            [
                'listtagid' => 'PrivateLetter',
                'listtagname' => '私信'
            ],
            [
                'listtagid' => 'Friends',
                'listtagname' => '好友'
            ],
            [
                'listtagid' => 'Group',
                'listtagname' => '群聊'
            ],
        ];
    }

}