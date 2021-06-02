<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php"); 	
	if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();	
?>

<?	
	use Bitrix\Main\Loader;		
	Loader::includeModule("highloadblock"); 
	
	//https://mattweb.ru/moj-blog/bitriks/item/185-sozdanie-hl-bloka-s-pomoshchyu-api-bitrix
	
	$highloadName="Hfeedback";
	$tableName="feedback";	
	
	$data = array(
	'NAME' => trim($highloadName),
	'TABLE_NAME' => trim($tableName),
	);		
	$result = \Bitrix\Highloadblock\HighloadBlockTable::add($data);
	
	if ($result->isSuccess())
	{
		$arLangs = Array(
		'ru' => 'Форма обратной связи Tetrika',
		'en' => 'Feedback form Tetrika'
		);
	
		$ID = $result->getId();
		
			//Языковые параметры
		foreach($arLangs as $lang_key => $lang_val)
		{
			Bitrix\Highloadblock\HighloadBlockLangTable::add(array(
            'ID' => $ID,
            'LID' => $lang_key,
            'NAME' => $lang_val
			));
		}		
		
		$oUserTypeEntity    = new CUserTypeEntity();
		
		$arCartFields    = array(
		'UF_CART_ID'=>Array(
		'ENTITY_ID' => 'HLBLOCK_'.$ID,
		'FIELD_NAME' => 'UF_NAME',
		'USER_TYPE_ID' => 'string',
		"EDIT_FORM_LABEL" => Array('ru'=>'Имя', 'en'=>'Name'), 
		"LIST_COLUMN_LABEL" => Array('ru'=>'Имя', 'en'=>'Name'),
		"LIST_FILTER_LABEL" => Array('ru'=>'Имя', 'en'=>'Name'), 
		),
		'UF_ADDED'=>Array(
		'ENTITY_ID' => 'HLBLOCK_'.$ID,
		'FIELD_NAME' => 'UF_TELEPHONE',
		'USER_TYPE_ID' => 'string',
		"EDIT_FORM_LABEL" => Array('ru'=>'Номер телефона', 'en'=>'Phone number'), 
		"LIST_COLUMN_LABEL" => Array('ru'=>'Номер телефона', 'en'=>'Phone number'),
		"LIST_FILTER_LABEL" => Array('ru'=>'Номер телефона', 'en'=>'Phone number'), 
		),  
		);			
		
		$arSavedFieldsRes = Array();
		
		foreach($arCartFields as $arCartField){
			$obUserField  = new CUserTypeEntity;
			$ID = $obUserField->Add($arCartField);
			$arSavedFieldsRes[] = $ID;
		}	
		
		
		
	}
	else{
		// $errors = $result->getErrorMessages();
		// print_r($errors);
	}

	$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList([
	'filter' => ['=NAME' => $highloadName]
	])->fetch();
	if(!$hlblock){
		throw new \Exception('[04072017.1331.1]');
	}
	//класс созданного блока
	$hlClassName = ( \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock))->getDataClass();
	// добавить элемент в highload блок
	$hlClassName::add(array(
	'UF_NAME'         => $_POST["user_name"],
	'UF_TELEPHONE'         => $_POST["user_telephone"]
	));			
	
?>	