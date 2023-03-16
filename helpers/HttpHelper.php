<?php

namespace app\helpers;

/**
 * A helper class for sending HTTP requests using PHP's cURL extension.
 * @author Defri Indra Mahardika
 * @version 1.0
 */
class HttpHelper
{
    /**
     * get the content of the given url
     * @param string $url the url to get
     * @param array $fields the fields data
     * @param array $headers the headers data
     * @return mixed the content of the url
     */
    public static function get($uri, $fields = null, $headers = [])
    {
        return static::request($uri, $fields, $headers, "GET");
    }

    /**
     * get the content of the given url
     * with post method
     * @param string $url the url to get
     * @param array $fields the fields data
     * @param array $headers the headers data
     * @return mixed the content of the url
     */
    public static function post($uri, $fields = null, $headers = [])
    {
        return static::request($uri, $fields, $headers, "POST");
    }

    /**
     * get the content of the given url
     * @param string $url the url to get
     * @param array $fields the fields data
     * @param array $headers the headers data
     * @return mixed the content of the url as json
     */
    public static function getApi($uri, $fields = null, $headers = [])
    {
        return json_decode(static::request($uri, $fields, $headers, "GET"));
    }


    /**
     * get the content of the given url
     * with post method
     * @param string $url the url to get
     * @param array $fields the fields data
     * @param array $headers the headers data
     * @return mixed the content of the url as json
     */
    public static function postApi($uri, $fields = [], $headers = [])
    {
        return json_decode(static::request($uri, $fields, $headers, "POST"));
    }

    /**
     * get the content of the given url
     * @param $uri
     * @param $data
     * @param $method
     * @param $headers
     * @return mixed
     */
    private static function request($uri, $fields, $headers = [], $method = "GET")
    {
        // parse headers
        $valid_header = static::parseHeaders($headers);

        // curl
        $ch = static::curlInit($uri, $method, $valid_header);
        $ch = static::curlSetBody($ch, $fields, $headers);
        $output = static::curlRequest($ch, 1);

        return $output;
    }

    /**
     * Parse headers
     */
    public static function parseHeaders($headers)
    {
        $valid_header = [];
        $total_headers = count($headers);
        $key_headers = array_keys($headers);

        for ($index_header = 0; $index_header < $total_headers; $index_header++) {
            $valid_header[] = "{$key_headers[$index_header]}: {$headers[$index_header]}";
        }

        return $valid_header;
    }

    /**
     * Init curl
     */
    private static function curlInit($uri, $method, $valid_header)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $valid_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($method == "POST") :
            curl_setopt($ch, CURLOPT_POST, true);
        endif;

        return $ch;
    }

    /**
     * Set body
     */
    private static function curlSetBody($ch, $fields, $headers)
    {
        if (empty($fields) == false) :
            curl_setopt($ch, CURLOPT_POST, true);
            if (isset($headers['Content-Type']) == false || strtolower($headers['Content-Type']) == "application/json") :
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            else :
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
            endif;
        endif;

        return $ch;
    }

    /**
     * Request
     */
    private static function curlRequest($ch, $return_file_transfer = 0)
    {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $return_file_transfer);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
