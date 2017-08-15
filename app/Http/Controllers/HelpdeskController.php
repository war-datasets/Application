<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\HelpdeskRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class HelpdeskController
 *
 * @package ActivismeBE\Http\Controllers
 */
class HelpdeskController extends Controller
{
    private $helpdeskRepository;

    /**
     * HelpdeskController constructor.
     *
     * @param HelpdeskRepository $helpdeskRepository
     */
    public function __construct(HelpdeskRepository $helpdeskRepository)
    {
        $this->middleware('auth')->only(['indexAdmin', 'status', 'show']);

        $this->helpdeskRepository = $helpdeskRepository;
    }

    public function indexUser()
    {
        $all    = $this->helpdeskRepository->countQuestions();
        $open   = $this->helpdeskRepository->countQuestions('open', 'Y');
        $closed = $this->helpdeskRepository->countQuestions('open', 'N');

        return view('helpdesk.index', compact('all', 'open', 'closed'));
    }

    public function indexAdmin()
    {

    }

    public function show($ticketId)
    {
        try { // To find the ticket in the database.
            $ticket = $this->helpdeskRepository->findTicket($ticketId);

            return view('helpdesk.show', compact('ticket'));
        } catch (ModelNotFoundException $modelNotFoundException) { // Ticket => NOT FOUND
            flash("Wij konden geen ticket vinden met de id #{$ticketId}")->danger();
            return redirect()->route('helpdesk.route');
        }
    }

    /**
     * Open/Close a support ticket in the system.
     *
     * @param  string  $status      The new status for the ticket.
     * @param  integer $ticketId    The id for the ticket in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status, $ticketId)
    {
        try { // To find the the support ticket in the database.
            $ticket = $this->helpdeskRepository->findTicket($ticketId);

            if ($this->helpdeskRepository->updateTicket(['status' => $status])) {
                // Ticket has been updated.
                switch ($status) { // Determinate the status and set message based on status.
                    case 'open':    $message = "Wij hebben ticket #{$ticket->id} terug geopend."; break;
                    case 'sluiten': $message = "Wij hebben ticket #{$ticket->id} gesloten.";      break;
                }

                flash($message)->success();
            }
        } catch (ModelNotFoundException $modelNotFoundException) { // Ticket => NOT FOUND
            flash("Wij konden geen ticket vinden met de id #{$ticketId}")->danger();
            return redirect()->route('helpdesk.route');
        }
    }
}
