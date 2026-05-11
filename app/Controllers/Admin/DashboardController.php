<?php

namespace App\Controllers\Admin;

use App\Core\AbstractModel;
use App\Core\Auth;
use App\Core\Controller;
use App\Core\Permission;
use App\Models\Department\Department;
use App\Models\Role\Role;
use App\Models\Ticket\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct("App");

        Auth::requirePermission(Permission::VIEW_MANAGER_DASHBOARD);
    }

    public function index(): void
    {
        $totalUsers = User::totalUsers();
        $totalRoles = Role::totalRoles();
        $totalDepartments = Department::totalDepartments();
        $totalOpenTickets = Ticket::totalOpenTickets();
        $recentUsers = User::recentUsers();
        $roles = Role::all();



        echo $this->view->render("admin/dashboard", [
            "totalUsers" => $totalUsers,
            "totalRoles" => $totalRoles,
            "totalDepartments" => $totalDepartments,
            "totalOpenTickets" => $totalOpenTickets,
            "recentUsers" => $recentUsers,
            "roles" => $roles

        ]);
    }
}