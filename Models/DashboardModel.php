<?php
namespace App\Models;

class DashboardModel
{
    public function Verify()
    {
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1337)
        {
        return "ADMIN";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 43)
        {
        return "MODERATEUR";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20)
        {
        return "BOUTIQUE";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10)
        {
        return "BOUTIQUE";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1)
        {
        return "USER";
        }
        if (!isset($_SESSION['user']['droit']))
        {
        return "DISCONNECTED";
        }

    }
}