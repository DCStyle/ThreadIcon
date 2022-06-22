<?php

namespace DC\ThreadIcon\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * RELATIONS
 * @property \DC\ThreadIcon\Entity\Icon $Icon
 * 
 * GETTERS
 * @property string|void $icon_position
 */
class Thread extends XFCP_Thread
{
    public function getIconPosition()
    {
        if (!$this->Icon)
        {
            return;
        }

        return $this->Icon->position;
    }
    
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->relations += [
            'Icon' => [
                'entity' => 'DC\ThreadIcon:Icon',
                'type' => self::TO_ONE,
                'conditions' => 'thread_id'
            ]
        ];

        $structure->getters += [
            'icon_position' => true
        ];

        return $structure;
    }
}