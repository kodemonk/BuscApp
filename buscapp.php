<?
require_once('./SBClientSDK/SBPersistentApp.php');
class BuscApp extends SBPersistentApp
{
	protected function onError($errorType_)
	{
		error_log($errorType_);
	}
	
	protected function onNewVote(SBUser $user_,$newVote_,$oldRating_,$newRating_)
	{
	}
	protected function onNewContactSubscription(SBUser $user_)
	{
	}
	protected function onNewContactUnSubscription(SBUser $user_)
	{
	}
	protected function onNewMessage(SBMessage $msg_)
	{
		$allAData=$msg_->getAttachmentsFullDataOrFalse();
		if(count($allAData))
		{
			//Es una indexacion
			foreach ($allAData as $aRef=>$aData)
			{
				if(isset($aData["attachmentMetadata"]) && ($aMData=json_decode($aData["attachmentMetadata"]))!=null)
				{
					if($aMData->orig_name!="file")
					{
						$this->setOrFalse(strtolower($aMData->orig_name)."_".$aRef,$aRef);
						$this->_SBAttachments->addAttachmentRef($aRef);
					}
				}
			}
			$this->replyOrFalse("Gracias! Los siguientes ficheros quedan Indexados en el buscador");
		}
		else
		{
			//Es una busqueda
			$query=strtolower($msg_->getSBMessageTextOrFalse());
			if(($results=$this->keysOrFalse($query))!=false)
			{
				shuffle($results);
				foreach ($results as $result)
				{
					if(strlen($result)>32)
					{
						//$this->replyOrFalse("Añado ".substr($result, -32));
						$this->_SBAttachments->addAttachmentRef(substr($result, -32));
					}
				}
				$this->replyOrFalse("Resultados para <<".$msg_->getSBMessageTextOrFalse().">>");				
			}
		}		
	}
}
$buscapp=new BuscApp("LNU1S95","4fde8e99501000e58d06c7c9e7583d5b588f07b94a2c8d91e9f785b55da511fe");
$buscapp->serveRequest($_GET["params"]);
?>