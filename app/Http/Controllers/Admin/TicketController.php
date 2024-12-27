<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Library\Enum;
use App\Models\Config;
use App\Models\Ticket;
use App\Library\Response;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Events\Ticket\CreatedEvent;
use App\Events\Ticket\RepliedEvent;
use Illuminate\Support\Facades\Log;
use App\Events\Ticket\AssignedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\ReplyRequest;
use App\Http\Requests\Admin\Ticket\CreateRequest;
use App\Http\Requests\Admin\Ticket\UpdateAssignToRequest;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Ticket::filterTable($request->status))
                ->addColumn('priority', function ($row) {
                    return Enum::getTicketPriority($row->priority);
                })
                ->addColumn('last-reply', function ($row) {
                    $lr = $row->updated_at->diffForHumans();

                    return $lr;
                })
                ->addColumn('status', function ($row) {
                    return $this->getStatusHtml($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['action',  'status'])
                ->make(true);
        }
        $count_total = Ticket::countTicket();

        return view('admin.pages.ticket.index', compact('count_total'));
    }

    private function getActionHtml($row)
    {
        $user_role = User::getAuthUserRole();

        if($row->status != Enum::TICKET_STATUS_CLOSED && $user_role->hasPermission('ticket_reply')) {
            $btn = '<a href="' . route('admin.ticket.show', $row->id) . '" class="btn btn-sm btn2-secondary"> <i class="fas fa-reply"></i> Reply </a>';
        } elseif($row->status == Enum::TICKET_STATUS_CLOSED && User::getAuthUser()->roles->first()->slug == Enum::ROLE_ADMIN_SLUG && $user_role->hasPermission('ticket_reopen')) {
            $btn = '<a href="' . route('admin.ticket.reopen', $row->id) . '" class="edit btn btn-sm btn-info pr-2"> <i class="fas fa fa-envelope-open"></i> Reopen </a>';
        } else {
            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn2-secondary disabled"> <i class="fas fa-reply"></i> Reply </a>';
        }

        return $btn;
    }

    private function getStatusHtml($row)
    {
        if($row->status == Enum::TICKET_STATUS_OPEN) {
            $class = 'badge-success';
        } elseif($row->status == Enum::TICKET_STATUS_HOLD) {
            $class = 'badge-warning';
        } elseif($row->status == Enum::TICKET_STATUS_CLOSED) {
            $class = 'badge-danger';
        } else {
            $class = 'badge-secondary';
        }

        return '<div class="badge ' . $class . '">' . Enum::getTicketStatus($row->status) . '</div>';
    }

    public function showCreateForm()
    {
        return view('admin.pages.ticket.create', [
            'members'     => User::getByMember(Enum::USER_TYPE_MEMBER),
            'departments' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_TICKET_DEPARTMENT)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $ticket = Ticket::insert($request->validated());

        event(new CreatedEvent($ticket));

        return redirect()->route('admin.ticket.index')->with('success', __('Successfully created'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.pages.ticket.show', [
            'replies'    => $ticket->replies('desc')->get(),
            'committees' => User::getByCommittee(Enum::USER_TYPE_COMMITTEE),
            'ticket'     => $ticket
        ]);
    }

    public function reply(Ticket $ticket, ReplyRequest $request)
    {
        $reply = TicketReply::insert($ticket, $request->validated());
        event(new RepliedEvent($reply));

        return redirect()->route('admin.ticket.show', $ticket->id)->with('success', __('Successfully Replied'));
    }

    public function changeAssignee(Ticket $ticket, UpdateAssignToRequest $request)
    {
        try {
            $ticket->changeAssignee($ticket, $request->validated());
            event(new AssignedEvent($ticket));

            return redirect()->route('admin.ticket.show', $ticket->id)->with('success', __('Successfully Assigned'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to create'), [], 500);
        }
    }

    public function changeStatus(Ticket $ticket, Request $request)
    {
        try {
            $ticket->update([
                'status' => $request->status,
            ]);

            return redirect()->route('admin.ticket.show', $ticket->id)->with('success', __('Successfully Change Status'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to Change'), [], 500);
        }
    }

    public function reOpen(Ticket $ticket)
    {
        $ticket->update([
            'status' => Enum::TICKET_STATUS_OPEN
        ]);

        return redirect()->route('admin.ticket.show', $ticket->id)->with('success', __('Successfully Opened'));
    }

}
