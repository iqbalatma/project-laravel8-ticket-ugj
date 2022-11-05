<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateTicketRequest;
use App\Services\TicketService;


class TicketController extends Controller
{
    private $ticketService;
    public function __construct()
    {
        $this->ticketService = new TicketService();
    }

    /**
     * Description : use to show page for generate new ticket
     * 
     * @param TicketService $service for get all data for create
     */
    public function create(TicketService $service)
    {
        return response()->view('ticket.generate', $service->getAllDataForCreate());
    }

    /**
     * Description : use to generate new ticket
     * 
     * 
     */
    public function store(GenerateTicketRequest $request, TicketService $service)
    {
        $validated = $request->validated();

        ini_set('max_execution_time', '300');

        if ($service->checkLimit($validated['phase_id'], $validated['quantity'])) {
            $service->reduceLimit()
                ->generateData()
                ->generatePDF();

            return redirect()
                ->back()
                ->with('success', "Ticket Generate Success !");
        } else {
            return redirect()
                ->back()
                ->with('failed', "Ticket generate failed ! Ticket quantity exceeds the limit");
        }
    }

}
