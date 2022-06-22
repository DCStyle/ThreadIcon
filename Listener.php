<?php

namespace DC\ThreadIcon;

class Listener
{
    public static function templaterSetup(\XF\Container $container, \XF\Template\Templater &$templater)
	{
		/** @var \DC\ThreadIcon\Template\TemplaterSetup $templaterSetup */
		$class = \XF::extendClass('DC\ThreadIcon\Template\TemplaterSetup');
		$templaterSetup = new $class();

		$templater->addFunction('thread_title_icon', [$templaterSetup, 'fnThreadTitleIcon']);
	}
}