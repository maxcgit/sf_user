<?php

namespace Maxc\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MaxcUserBundle extends Bundle
{
	public function getParent(){
		return "FOSUserBundle";
	}
}
