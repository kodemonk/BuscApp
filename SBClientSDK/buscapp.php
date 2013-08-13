<?
require_once('./SBClientSDK/SBPersistentApp.php');
class BilyApp extends SBPersistentApp
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
		$this->replyOrFalse("ola");
	}
}
?>