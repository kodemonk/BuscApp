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
		$this->replyOrFalse($msg_->_response);
	}
}
$buscapp=new BuscApp("LNU1S95","4fde8e99501000e58d06c7c9e7583d5b588f07b94a2c8d91e9f785b55da511fe");
$buscapp->serveRequest($_GET["params"]);
?>