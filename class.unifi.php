<?php

class Unifi {

    private static function get_api_url() {
        return 'http://weixin.ubnt.com.cn/index.php';
    }

    private function __construct() {}

    public static function get_url($from_user_name) {
        $fields = array(
            'name' => API_NAME,
            'token' => API_TOKEN,
            'event' => 'get_url',
            'fromUserName' => $from_user_name
        );
        return self::_do_get(self::get_api_url(), $fields);
    }

    public static function unsubscribe($from_user_name) {
        $fields = array(
            'name' => API_NAME,
            'token' => API_TOKEN,
            'event' => 'unsubscribe',
            'fromUserName' => $from_user_name
        );
        return self::_do_get(self::get_api_url(), $fields);
    }

    private static function _do_get($url, $fields) {
        $ch = curl_init();

        $query_string = array();
        if (is_array($fields) && count($fields)) {
            foreach ($fields as $key=>$value) {
                $query_string[] = $key . '=' . $value;
            }
        }
        $query_string = implode('&', $query_string);

        curl_setopt($ch, CURLOPT_URL, $url . '&' . $query_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, TRUE);
    }

    private static function _do_post($url, $fields) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "IDENTITY_CLIENT");
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, TRUE);
    }

}