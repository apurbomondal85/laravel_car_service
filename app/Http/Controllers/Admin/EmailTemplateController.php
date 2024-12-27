<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailTemplates\UpdateRequest;
use App\Models\EmailTemplate;
use App\Library\Enum;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class EmailTemplateController extends Controller
{
    public function emailTemplate(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailTemplate::select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $user_role = User::getAuthUserRole();

                        return $user_role->hasPermission('setting_email_update') ? '<a class="btn btn2-secondary btn-sm" href="' . route('admin.config.email.update', $row->id) . '"> <i class="far fa-edit"></i> Edit</a>' : '';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.pages.config.email_setting.index');
    }

    public function updateEmailTemplateForm(EmailTemplate $email_setting)
    {
        $shortcodes = explode(',', $email_setting->shortcodes);
        $systemShortCodes = Enum::systemShortcodesWithValues();

        return view('admin.pages.config.email_setting.update', [
            'data'             => $email_setting,
            'shortcodes'       => $shortcodes,
            'systemShortCodes' => $systemShortCodes,
        ]);
    }

    public function updateEmailTemplate(EmailTemplate $email_setting, UpdateRequest $request)
    {
        $data = $request->validated();
        $email_setting->update([
            'subject' => $data['subject'],
            'message' => $data['message']
        ]);

        return back()->with('success', __('Successfully Updated'));
    }
}
