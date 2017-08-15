<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\HelpdeskRepository;
use ActivismeBE\Traits\Conditions\Helpdesk as HelpdeskCondtions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class HelpdeskController
 *
 * @package ActivismeBE\Http\Controllers
 */
class HelpdeskController extends Controller
{
    use HelpdeskCondtions; // Used to place the conditions in the if/else operators.

    /**
     * Eloquent database layer.
     *
     * @var HelpdeskRepository
     */
    private $helpdeskRepository;

    /**
     * HelpdeskController constructor.
     *
     * @param HelpdeskRepository $helpdeskRepository
     */
    public function __construct(HelpdeskRepository $helpdeskRepository)
    {
        $this->helpdeskRepository = $helpdeskRepository;
    }

    public function index()
    {
        if ($this->userHasAdminRights()) { // The user has the admin rights.
            $tickets = $this->helpdeskRepository; // Return repository instance. functions called in view.
            return view('helpdesk.admin', compact('tickets'));
        }

        $all    = $this->helpdeskRepository->countQuestions();
        $open   = $this->helpdeskRepository->countQuestions('open', 'Y');
        $closed = $this->helpdeskRepository->countQuestions('open', 'N');

        return view('helpdesk.index', compact('all', 'open', 'closed'));
    }

    public function show($ticketId)
    {
        try { // To find the ticket in the database.
            $ticket = $this->helpdeskRepository->findTicket($ticketId);

            if ($this->userCanViewTicket($ticket)) { // The user is permitted to view the ticket.
                return view('helpdesk.show', compact('ticket'));
            }

            return redirect()->route('helpdesk.index'); // Redirect the user. Because not permitted.
        } catch (ModelNotFoundException $modelNotFoundException) { // Ticket => NOT FOUND
            flash("Wij konden geen ticket vinden met de id #{$ticketId}")->danger();
            return redirect()->route('helpdesk.route');
        }
    }

    /**
     * Open/Close a support ticket in the system.
     *
     * @param  string  $open      The new status for the ticket.
     * @param  integer $ticketId  The id for the ticket in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($open, $ticketId)
    {
        try { // To find the the support ticket in the database.
            $ticket = $this->helpdeskRepository->findTicket($ticketId);

            if ($this->helpdeskRepository->updateTicket(['status' => $open])) {
                // Ticket has been updated.
                switch ($open) { // Determinate the status and set message based on status.
                    case 'Y': $message = "Wij hebben ticket #{$ticket->id} terug geopend."; break;
                    case 'N': $message = "Wij hebben ticket #{$ticket->id} gesloten.";      break;
                }

                flash($message)->success();
            }
        } catch (ModelNotFoundException $modelNotFoundException) { // Ticket => NOT FOUND
            flash("Wij konden geen ticket vinden met de id #{$ticketId}")->danger();
            return redirect()->route('helpdesk.route');
        }
    }
}
