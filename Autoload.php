<?php
include_once ('interfaces/IBind.php');
include_once ('interfaces/IBlackBox.php');
include_once ('interfaces/IResultObject.php');
include_once ('interfaces/IRepository.php');
include_once ('interfaces/IValidation.php');
include_once ('lib/adodb5/adodb.inc.php');
include_once ('lib/adodb5/adodb-active-record.inc.php');
include_once ('Validation.php');
include_once ('ResultObject.php');
include_once ('Repository.php');
include_once ('CONSTANT.php');
include_once ('Bind.php');

$db = NewADOConnection(CONSTANT::DRIVER . '://' . CONSTANT::ACCOUNT . ':' . CONSTANT::PASSWORD . '@' . CONSTANT::HOST . '/' . CONSTANT::DATABASE);
$db->Execute("set names '" . CONSTANT::ENCODE . "';");
ADOdb_Active_Record::SetDatabaseAdapter($db);
