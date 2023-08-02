<?php
error_reporting(-1);
define('__ROOT_DIR__',dirname(dirname(dirname(__DIR__))));
date_default_timezone_set('Asia/Chongqing');
ss_session();
function ss_autoload($classname)
{
    if(!class_exists($classname))require __ROOT_DIR__.'/shipsay/class/'.$classname.'.php';
}
spl_autoload_register('ss_autoload');
require_once __ROOT_DIR__.'/shipsay/configs/config.ini.php';
if(!empty($authcode))$dbarr['host']=$authcode;
$is_acode=strpos($fake_info_url,'{acode}')!==false?true:false;
$dbarr=array_merge(['pre'=>$sys_ver<5?'jieqi_':'shipsay_','words'=>$sys_ver<2.4?'size':'words','sortarr'=>$sortarr,'is_multiple'=>$is_multiple],$dbarr);
$db=new Db($dbarr);
$articlecode_str=$sys_ver<2.4?'':'articlecode,backupname,ratenum,ratesum,';
$rico_sql='SELECT '.$articlecode_str.$dbarr['words'].',articleid,articlename,intro,author,sortid,fullflag,display,lastupdate,imgflag,allvisit,allvote,goodnum,keywords,lastchapter,lastchapterid FROM '.$dbarr['pre'].'article_article WHERE '.$dbarr['words'].' >= 0 ';
function ss_writefile($file_name,$data)
{
    if(!is_dir(dirname($file_name)))
    {
        mkdir(dirname($file_name),0777,true);
    }
    ;
    chmod($file_name,511);
    return file_put_contents($file_name,$data);
}
function ss_session()
{
    if(session_status()!==PHP_SESSION_ACTIVE)
    {
        session_start();
    }
}
?>