<?php

namespace DC\ThreadIcon\Template;

class TemplaterSetup
{
    public function fnThreadTitleIcon($templater, &$escape, \DC\ThreadIcon\XF\Entity\Thread $thread, $style = 'regular', $class = 'thread-title')
    {
        $escape = false;

        $icon = $thread->Icon;
        $iconTag = '';

        switch($style)
        {
            case 'light':
                $iconStyle = 'fal';
                break;
            case 'bold':
                $iconStyle = 'fas';
                break;
            default:
                $iconStyle = 'far';
                break;
        }

        if ($icon)
        {
            $iconTag = "<i class=\"fa--xf {$iconStyle} fa-{$icon->icon}\" aria-hidden=\"true\"></i>";
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