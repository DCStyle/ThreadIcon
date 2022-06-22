<?php

namespace DC\ThreadIcon\XF\Pub\Controller;

use XF\Entity\Thread as EntityThread;

class Thread extends XFCP_Thread
{
    protected function setupThreadEdit(EntityThread $thread)
    {
        /** @var \DC\ThreadIcon\XF\Service\Thread\Editor $editor */
        $editor = parent::setupThreadEdit($thread);

        /** @var \DC\ThreadIcon\XF\Entity\User $visitor */
        $visitor = \XF::visitor();

        if ($visitor->canUseThreadIcon($thread->node_id))
        {
            /** @var \DC\ThreadIcon\Repository\Icon $iconRepo */
            $iconRepo = $this->repository('DC\ThreadIcon:Icon');
            
            $icon = $iconRepo->encodeString($this->filter('thread_icon', 'str'));
            $position = $iconRepo->encodeString($this->filter('thread_icon_position', 'str'));

            $editor->setThreadIcon($icon, $position);
        }

        return $editor;
    }
}