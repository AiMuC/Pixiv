<?php
/* File Info 
 * Author:      AiMuC 
 * CreateTime:  2021/2/11 下午7:01:28 
 * LastEditor:  AiMuC 
 * ModifyTime:  2021/2/11 下午7:50:18 
 * Description: 
*/
include_once("system/init.php");
switch ($_GET['type']) {
    case "getimg":
        PrintImage($_GET['url']);
        break;
    case "getimgs":
        GetAllImage($_GET['id'], $_GET['page']);
        break;
    default:
        break;
}
