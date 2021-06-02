<?
	if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
	
	\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
	/**
		* Bitrix vars
		*
		* @var array $arParams
		* @var array $arResult
		* @var CBitrixComponentTemplate $this
		* @global CMain $APPLICATION
		* @global CUser $USER
	*/
?>
<?
	CJSCore::Init(array("jquery"));
?>
<script type="text/javascript" src="<?=$templateFolder?>/jquery.maskedinput.js"></script>



<!-- Модальное окно -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	Заказать звонок
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- форма обратной связи  -->
				<div class="mb-12">
					<?if(!empty($arResult["ERROR_MESSAGE"]))
						{
							foreach($arResult["ERROR_MESSAGE"] as $v)
							ShowError($v);
						}
						if($arResult["OK_MESSAGE"] <> '')
						{
							?><div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div><?
						}
					?>
					  <div class="result_form_success green-text d-none"><?=$arParams[OK_TEXT];?></div> 
					  <div class="result_form_error red-text d-none"><?=GetMessage("MF_ERROR")?></div> 

					<form id="ajax_form" method="POST" action="">
						<?=bitrix_sessid_post()?>
						<div class="form-group">
							<label for="mainFeedback_name"><?=GetMessage("MFT_NAME");?></label>
							<input
							type="text"
							id="mainFeedback_name"
							name="user_name"
							class="form-control"
							value="<?=$arResult["AUTHOR_NAME"]?>"		
							/>
						</div>
						
						<div class="form-group">
							<label for="mainFeedback_telephone"><?=GetMessage("MFT_TELEPHONE")?><?
							if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TELEPHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-control-required">*</span><?endif?></label>
							<input
							type="text"
							name="user_telephone"
							id="mainFeedback_telephone"
							class="form-control phone"
							value="<?=$arResult["AUTHOR_TELEPHONE"]?>"
							<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TELEPHONE", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>
							/>
						</div>							
						<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
						<input id="btn-form-feedback" type="button" name="submit-button"  value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-primary" disabled>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>