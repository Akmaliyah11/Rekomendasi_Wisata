<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class RecentActivity extends Component
{
    public $activities;

    public function __construct($activities = [])
    {
        $this->activities = $activities;
    }

    public function render()
    {
        return view('components.admin.recent-activity');
    }
}
