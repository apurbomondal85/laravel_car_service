<?php

namespace App\Http\Controllers\Admin;

use App\Library\Enum;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Library\Services\Admin\ClientPartnerService;
use App\Http\Requests\Admin\ClientPartner\CreateRequest;
use App\Http\Requests\Admin\ClientPartner\UpdateRequest;

class ClientPartnerController extends Controller
{
    use ApiResponse;

    private $client_service;

    public function __construct(ClientPartnerService $client_service)
    {
        $this->client_service = $client_service;
    }

    public function index(Request $request)
    {
        $client_type = $request->type;

        if ($request->ajax()) {
            $filter_request = $request->only(['status']);

            return $this->client_service->dataTable($filter_request, $client_type);
        }

        return view('admin.pages.client_partner.index', [
            'type' => $client_type,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.pages.client_partner.create', [
            'type' => $request->type,
        ]);
    }

    public function store(CreateRequest $request)
    {
        $result = $this->client_service->store($request->validated());

        $client_type = 'partner';

        if ($request->client_type == Enum::CLIENT_TYPE_CLIENT) {
            $client_type = 'client';
        }

        if ($result) {
            return redirect()->route('admin.' . $client_type . '.index', ['type' => $request->client_type])->with('success', $this->client_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->client_service->message);
    }

    public function show(Client $client)
    {
        abort_unless($client, 404);

        return view('admin.pages.client_partner.show', [
            'client' => $client,
        ]);
    }

    public function edit(Client $client)
    {
        abort_unless($client, 404);

        return view('admin.pages.client_partner.update', [
            'client' => $client,
            'type'   => $client->client_type,
        ]);
    }

    public function update(UpdateRequest $request, Client $client): RedirectResponse
    {
        abort_unless($client, 404);
        $result = $this->client_service->update($client, $request->validated());

        $client_type = 'partner';

        if ($client->client_type == Enum::CLIENT_TYPE_CLIENT) {
            $client_type = 'client';
        }

        if ($result) {
            return redirect()->route('admin.' . $client_type . '.index', [$client->id, 'type' => $client_type])->with('success', $this->client_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->client_service->message);
    }

    public function destroy(Client $client): RedirectResponse
    {
        abort_unless($client, 404);

        $client_type = 'partner';

        if ($client->client_type == Enum::CLIENT_TYPE_CLIENT) {
            $client_type = 'client';
        }

        $result = $this->client_service->delete($client);

        if ($result) {
            return redirect()->route('admin.' . $client_type . '.index', ['type' => $client_type])->with('success', $this->client_service->message);
        }

        return back()->with('error', 'Unable to delete now');
    }

    public function changeStatusApi(Client $client, $type)
    {
        abort_unless($client, 404);
        $result = $this->client_service->changeStatus($client, $type);

        $client_type = 'partner';

        if ($client->client_type == Enum::CLIENT_TYPE_CLIENT) {
            $client_type = 'client';
        }

        if ($result) {
            return redirect()->route('admin.' . $client_type . '.show', $client->id)->with('success', $this->client_service->message);
        }

        return back()->with('error', $this->client_service->message);
    }
}
