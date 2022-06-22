<?php

namespace DC\ThreadIcon\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int $thread_id
 * @property string $icon
 * @property string $position
 * 
 * RELATIONS
 * @property \XF\Entity\Thread $Thread
 */
class Icon extends Entity
{
    public function getPosition()
    {
        if ($this->app()->options()->dcThreadIcon_display_position == 'depends')
        {
            return $this->position;
        }

        return $this->app()->options()->dcThreadIcon_display_position;
    }
    
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_dcThreadIcon_icon';
        $structure->primaryKey = 'thread_id';
        $structure->shortName = 'DC\ThreadIcon:Icon';
        $structure->columns = [
            'thread_id' => ['type' => self::UINT, 'required' => true],
            'icon' => ['type' => self::STR, 'required' => true],
            'position' => ['type' => self::STR, 'allowedValues' => ['before', 'after'], 'default' => 'before']
        ];
        $structure->relations = [
            'Thread' => [
                'entity' => 'XF:Thread',
                'type' => self::TO_ONE,
                'conditions' => 'thread_id',
                'primary' => true
            ]
        ];

        return $structure;
    }
}