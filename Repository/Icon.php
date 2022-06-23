<?php

namespace DC\ThreadIcon\Repository;

use \DC\ThreadIcon\XF\Entity\Thread;
use XF\Mvc\Entity\Repository;

class Icon extends Repository
{
    public function updateThreadIcon(Thread $thread, $icon, $position)
    {
        if (!$thread)
        {
            return;
        }

        if (!$thread->Icon)
        {
            $this->createThreadIcon($thread, $icon, $position);
            return;
        }

        if (!$this->validateIcon($icon))
        {
            if ($thread->Icon)
            {
                $thread->Icon->delete();
                return;
            }
        }

        $threadIcon = $thread->Icon;
        $threadIcon->icon = $this->prepareIconString($icon);
        $threadIcon->position = in_array($position, $this->getValidPositions()) ? $position : 'before';

        $threadIcon->save();
    }
    
    public function createThreadIcon(Thread $thread, $icon, $position)
    {
        if ($this->validateIcon($icon))
        {
            /** @var \DC\ThreadIcon\Entity\Icon $threadIcon */
            $threadIcon = $this->em->create('DC\ThreadIcon:Icon');

            $threadIcon->thread_id = $thread->thread_id;
            $threadIcon->icon = $this->prepareIconString($icon);
            $threadIcon->position = in_array($position, $this->getValidPositions()) ? $position : 'before';

            $threadIcon->save();
        }
    }

    public function encodeString($string)
    {
        return $this->app()->stringFormatter()->censorText($string);
    }

    public function prepareIconString($icon)
    {
        $icon = trim($icon);

        return $icon;
    }
    
    public function getValidPositions()
    {
        return [
            'before',
            'after'
        ];
    }
    
    public function validateIcon($icon)
    {
        $validIcons = $this->getListValidIcons();

        if (in_array($this->prepareIconString($icon), $validIcons))
        {
            return true;
        }

        return false;
    }
    
    public function getListValidIcons()
    {
        /** @var \DC\ThreadIcon\Repository\IconList $iconListRepo */
        $iconListRepo = $this->repository('DC\ThreadIcon:IconList');
        
        return $iconListRepo->getIconList();
    }
}