<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AnalyticsSection extends Component
{
    public $totalUsers;
    public $totalDestinations;

    public function __construct($totalUsers = 0, $totalDestinations = 0)
    {
        $this->totalUsers = $totalUsers;
        $this->totalDestinations = $totalDestinations;
    }

    public function render()
    {
        return view('components.admin.analytics-section');
    }
}
