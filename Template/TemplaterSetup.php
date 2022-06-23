<?php

namespace DC\ThreadIcon\Template;

class TemplaterSetup
{
    public function fnThreadTitleIcon($templater, &$escape, \DC\ThreadIcon\XF\Entity\Thread $thread, $class = 'thread-title')
    {
        $escape = false;

        $icon = $thread->Icon;
        $iconTag = '';

        if ($icon)
        {
            $iconTag = "<i class=\"fa--xf {$icon->icon}\" aria-hidden=\"true\"></i>";
        }

        $title = "<span class=\"{$class}\" title=\"{$thread->title}\">{$thread->title}</span>";

        if ($thread->icon_position == 'before')
        {
            return $iconTag . ' ' . $title;
        }
        else
        {
            return $title . ' ' . $iconTag;
        }
    }
}