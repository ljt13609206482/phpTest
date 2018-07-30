<?php
header("Content-Type: application/json;charset=utf-8");
require_once("./conn.php");
/**
 *获取客户端发送来的活动编号，以及名称
 *被访问时在数据库中查询当前活动编号（ActivityId）,如果活动编号已存在，计数增加1次，
 *如果不存在，向数据库中插入一条当前活动
 */
$activityId = $_POST['activityId'];
$activityName = $_POST['activityName'];
$url = $_POST['url'];
if ($activityId & $activityName & $url) {
    echo $activityId . "," . $activityName . "," . $url;
    $sql = "SELECT VisitCount FROM activityCount WHERE ActivityId=?";
    $params = array($activityId);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
//    对SQL语句执行后的结果进行抓取
    $rows = sqlsrv_has_rows($stmt);
    if ($rows) {//如果数据已存在，则再原来技术的基础上增加1
        echo json_encode(["ok" => 1, "msg" => "数据已存在"]);
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {
            $sql = "UPDATE activityCount SET VisitCount = ? WHERE ActivityId=?";
            $params = array($row[0] + 1, $activityId);
            $result1 = sqlsrv_query($conn, $sql, $params);
        };
    } else {//如果数据不存在，则向数据库中添加一条数据
        echo json_encode(["ok" => 0, "msg" => "数据不存在"]);;
        $sql = "INSERT INTO [dbo].[activityCount]([ActivityId],[ActivityName],[ActivityUrl],[VisitCount]) VALUES ('$activityId','$activityName','$url',1)";
//        对插入数据库的的数据进行转码
        $sql = iconv("utf-8", "gbk", $sql);
        $result2 = sqlsrv_query($conn, $sql);
    }

};

?>