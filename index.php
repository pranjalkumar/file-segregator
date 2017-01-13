<?php
error_reporting(0);
if(isset($_POST['addr'])&& !empty($_POST['addr']))
{
    $url=$_POST['addr'];
    if(is_dir($url))
    {
        $handle=opendir($url);
    $arr=array();
    $i=0;
    while($file=readdir($handle))
    {   if($file!='.'|| $file!='..') {
        $arr[$i] = $file;
//        echo $arr[$i];
        $i++;
    }
    $count=0;
    }
    for($j=0;$j<$i;$j++)
    {   if($arr[$j]!='.'||$arr[$j]!='..'||$arr[$j]!='documents'&&$arr[$j]!='compressed'&&$arr[$j]!='images'&&$arr[$j]!='music'&&$arr[$j]!='video') {
        $temp=strrev($arr[$j]);
//        echo $temp;
        $pos = stripos($temp, '.');
        $ext = strrev(strtolower(substr($temp, 0,$pos)));

        $source=$url.'\\'.$arr[$j];
//        echo $ext;
        if($ext=='rar' ||$ext=='zip'||$ext=='iso'||$ext=='tar')
        {   $target=$url.'\\compressed\\'.$arr[$j];
            rename($source,$target);
            $count++;
        }
        if($ext=='doc' ||$ext=='pdf'||$ext=='docx'||$ext=='txt'||$ext=='ppt'||$ext=='pptx'||$ext=='rtf'||$ext=='odt'||$ext=='pptx'||$ext=='xls'||$ext=='epub'||$ext=='xlsx')
        {   $target=$url.'\\documents\\'.$arr[$j];
            rename($source,$target);
            $count++;
        }
        if($ext=='jpeg' ||$ext=='jpg'||$ext=='png'||$ext=='exif'||$ext=='tif'||$ext=='ttif'||$ext=='gif'||$ext=='bmp')
        {   $target=$url.'\\images\\'.$arr[$j];
            echo $source."<br>";
            echo $target.'<br>';
            rename($source,$target);
            $count++;
        }
        if($ext=='mp3' ||$ext=='aac'||$ext=='mp4p'||$ext=='wav'|| $ext=='wma'|| $ext=='webm')
        {   $target=$url.'\\music\\'.$arr[$j];
            rename($source,$target);
            $count++;
        }
        if($ext=='mp4' ||$ext=='flv'||$ext=='mkv'||$ext=='3gp'||$ext=='wmv'||$ext=='avi'||$ext=='mov'||$ext=='m4v')
        {   $target=$url.'\\video\\'.$arr[$j];
            rename($source,$target);
            $count++;
        }


    } }

    closedir($handle);
}}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>File segregator</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="form">
    <form action="index.php" method="post">
        <input type="text" name="addr" id="addr">
        <button type="submit">Segregate Now</button>
    </form>
</div>
</body>
</html>
