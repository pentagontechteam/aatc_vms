<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StaffStatCard extends Component
{
    public $title;
    public $value;
    public $percentage;
    public $icon;
    public $bgColor;
    public $textColor;
    public $iconColor;
    public $percentageType;

    /**
     * Create a new component instance.
     *
     * @param  string  $title
     * @param  string|int  $value
     * @param  string  $percentage
     * @param  string  $icon
     * @param  string  $bgColor
     * @param  string  $textColor
     * @param  string  $iconColor
     * @param  string  $percentageType - 'normal', 'inverse', or 'neutral'
     * @return void
     */
    public function __construct($title, $value, $percentage, $icon, $bgColor = 'bg-white', $textColor = 'text-gray-900', $iconColor = 'text-gray-600', $percentageType = 'normal')
    {
        $this->title = $title;
        $this->value = $value;
        $this->percentage = $percentage;
        $this->icon = $icon;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
        $this->iconColor = $iconColor;
        $this->percentageType = $percentageType;
    }

    /**
     * Get the percentage color class based on the value and type
     *
     * @return string
     */
    public function getPercentageColorClass()
    {
        $hasPlus = strpos($this->percentage, '+') !== false;
        $hasMinus = strpos($this->percentage, '-') !== false;

        switch ($this->percentageType) {
            case 'inverse':
                // For cases like "Cancelled/Denied" where decrease is good
                if ($hasMinus) {
                    return 'text-green-600';
                } elseif ($hasPlus) {
                    return 'text-red-500';
                } else {
                    return 'text-gray-500';
                }
                break;

            case 'neutral':
                // Always gray regardless of value
                return 'text-gray-500';
                break;

            case 'normal':
            default:
                // Normal case where increase is good
                if ($hasPlus) {
                    return 'text-green-600';
                } elseif ($hasMinus) {
                    return 'text-red-600';
                } else {
                    return 'text-gray-500';
                }
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.staff-stat-card');
    }
}
