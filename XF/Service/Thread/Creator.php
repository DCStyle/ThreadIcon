<?php

namespace DC\ThreadIcon\XF\Service\Thread;

class Creator extends XFCP_Creator
{
    protected $threadIcon;
    protected $threadIconPosition;

    public function setThreadIcon($icon, $position = null)
    {
        $this->threadIcon = $icon;
        $this->threadIconPosition = $position;
    }

    protected function _save()
    {
        $thread = parent::_save();

        if ($this->threadIcon)
        {
            /** @var \DC\ThreadIcon\Repository\Icon $iconRepo */
            $iconRepo = $this->repository('DC\ThreadIcon:Icon');

            $iconRepo->createThreadIcon($thread, $this->threadIcon, $this->threadIconPosition);
        }

        return $thread;
    }
}