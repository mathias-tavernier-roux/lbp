<?php

namespace App\Controllers;

use App\Models\DashboardModel;
class DashboardController extends Controller
{
    public function admin()
    {
        $dashboard = new DashboardModel;
        $_SESSION['state'] = $dashboard->Verify();
        if ($_SESSION['state'] == "ADMIN")
        {
            header("Location: index.php");
        }
        else
        {
            header("Location: ../../");
        }
    }
    public function moderation()
    {
        $dashboard = new DashboardModel;
        $state = $dashboard->Verify();
        if ($_SESSION['state'] == "MODERATEUR")
        {
            header("Location: index.php");
        }
        else
        {
            header("Location: ../../");
        }
    }
}