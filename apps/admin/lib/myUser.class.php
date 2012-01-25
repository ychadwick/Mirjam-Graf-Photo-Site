<?php

class myUser extends sfGuardSecurityUser
{
	public function isFirstRequest($boolean = null)
	{
		if (is_null($boolean))
		{
			return $this->getAttribute('first_request', true);
		}
		else
		{
			$this->setAttribute('first_request', $boolean);
		}
	}
}
