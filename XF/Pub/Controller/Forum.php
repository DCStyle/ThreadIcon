<?php

namespace DC\ThreadIcon\XF\Pub\Controller;

class Forum extends XFCP_Forum
{
    protected function setupThreadCreate(\XF\Entity\Forum $forum)
    {
        /** @var \DC\ThreadIcon\XF\Service\Thread\Creator $creator */
        $creator = parent::setupThreadCreate($forum);

        /** @var \DC\ThreadIcon\XF\Entity\User $visitor */
        $visitor = \XF::visitor();

        if ($visitor->canUseThreadIcon($forum->node_id))
        {
            /** @var \DC\ThreadIcon\Repository\Icon $iconRepo */
            $iconRepo = $this->repository('DC\ThreadIcon:Icon');
            
            $icon = $iconRepo->encodeString($this->filter('thread_icon', 'str'));
            $position = $iconRepo->encodeString($this->filter('thread_icon_position', 'str'));

            $creator->setThreadIcon($icon, $position);
        }

        return $creator;
    }
}