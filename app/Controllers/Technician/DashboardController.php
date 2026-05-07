<?php

namespace App\Controllers\Technician;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Permission;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct("App");

        Auth::requirePermission(Permission::VIEW_TECHNICIAN_DASHBOARD);
    }

    public function index(): void
    {
        $ticketModel = new Ticket();
        $tickets = (new  Ticket())->ticketsOrderedByStatusPriorityAndOpeningDate();

        $quantityTicketsByMonth = $ticketModel->countTicketsByMonth();

        $quantityTicketsByCategory = $ticketModel->countTicketsByCategory();

        $quantityTicketsByStatus = $ticketModel->countTicketsByStatus();

        $avgResolutionDays = $ticketModel->avgResolutionDaysByMonthCurrentYear();
        $ticketsByPriorityAndStatus = $ticketModel->countByPriorityAndStatusCurrentYear();


        echo $this->view->render("technician/dashboard",[
            "tickets" => $tickets,
            "quantityTicketsByMonth" => $quantityTicketsByMonth,
            "quantityTicketsByCategory" => $quantityTicketsByCategory,
            "quantityTicketsByStatus" => $quantityTicketsByStatus,

            "avgResolutionDays" => $avgResolutionDays,
            "ticketsByPriorityAndStatus" => $ticketsByPriorityAndStatus
        ]);
    }


}