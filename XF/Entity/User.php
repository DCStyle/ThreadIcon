<?php

namespace DC\ThreadIcon\XF\Entity;

class User extends XFCP_User 
{
    public function canUseThreadIcon($nodeId = 0)
    {
        if ($nodeId)
        {
            if (!in_array($nodeId, $this->app()->options()->dcThreadIcon_forums))
            {
                return false;
            }
        }

        return $this->hasPermission('forum', 'canUseThreadIcon');
    }

    public function canChangeThreadIconPosition($nodeId = 0)
    {
        if ($this->app()->options()->dcThreadIcon_display_position != 'depends')
        {
            return false;
        }

        return $this->canUseThreadIcon($nodeId);
    }
}