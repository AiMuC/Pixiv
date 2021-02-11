<?php
/* File Info 
 * Author:      AiMuC 
 * CreateTime:  2021/2/11 下午3:17:13 
 * LastEditor:  AiMuC 
 * ModifyTime:  2021/2/11 下午7:50:41 
 * Description: 
*/

/* 
 * @Description: 获取请求头
 * @return: string
*/
function GetWebHeader()
{
    include("config.php");
    $header = "user-agent:" . $config['useragent'] . "\r\n" . "referer:" . $config['referer'] . "\r\n" . "cookie:" . $config['cookie'] . "\r\n";
    return $header;
}

/* 
 * @Description: 传入图片ID获取当前图片的所有内容
 * @param: $id
 * @param: $page
 * @return: image
*/
function GetAllImage($id, $page = 0)
{
    if ($page == null) $page = 0;
    $url = "https://www.pixiv.net/ajax/illust/{$id}/pages";
    $response = SendRequest($url);
    $response = json_decode($response, true);
    $response = $response['body'];
    PrintImage($response[$page]['urls']['original']);
}

/* 
 * @Description: 发送请求
 * @param: $url
 * @return: WebData
*/
function SendRequest($url)
{
    $header = GetWebHeader();
    $options = array(
        'http' => array(
            'method' => 'GET',
            "header" => $header,
            'timeout' => 15 * 60, // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

/* 
 * @Description: 输出图片
 * @param: $url
 * @return: image
*/
function PrintImage($url)
{
    $ImageData = SendRequest($url);
    header('content-type: image/jpeg');
    print_r($ImageData);
}
