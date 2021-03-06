<?php

namespace App\Controllers;

use App\Models\DashboardModel;
class DashboardController extends Controller
{
    public function admin()
    {
        $dashboard = new DashboardModel;
        $state = $dashboard->Verify();
        if ($state == "ADMIN")
        {
            header("Location: index.php");
        }
    }
    public function moderation()
    {
        $dashboard = new DashboardModel;
        $state = $dashboard->Verify();
        if ($state == "MODERATION")
        {
            header("Location: index.php");
        }
    }
}