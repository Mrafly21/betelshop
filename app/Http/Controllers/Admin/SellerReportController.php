<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ReportSeller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerReportController extends Controller
{
    public function index()
    {
        $reports = ReportSeller::with(['user', 'seller'])->get();
        return view('admin.seller-report.index', compact('reports'));
    }

    public function handleReport(Request $request, $id, $action)
    {
        $report = ReportSeller::findOrFail($id);
        $user = $report->user;
        $seller = $report->seller;

        if ($action == 'ignore') {
            $report->status = 'request-ignored';
            Notification::create([
                'user_id' => $user->id,
                'message' => 'Your report is reviewed, we hope the seller will be better.',
                'type' => 'report_review',
                'status' => 'unread',
            ]);
        } elseif ($action == 'warn') {
            $report->status = 'seller-got-warning';
            Notification::create([
                'user_id' => $user->id,
                'message' => 'Your report is reviewed, we hope the seller will be better.',
                'type' => 'report_review',
                'status' => 'unread',
            ]);

            Notification::create([
                'user_id' => $seller->id,
                'message' => 'You got a warning. Someone reported your store, please improve.',
                'type' => 'report_warning',
                'status' => 'unread',
            ]);
        } elseif ($action == 'ban') {
            $report->status = 'seller-banned';
            $seller->update(['status' => 'banned', 'role_as' => 0]);

            Notification::create([
                'user_id' => $user->id,
                'message' => 'Your report is reviewed, the seller is banned.',
                'type' => 'report_review',
                'status' => 'unread',
            ]);

            Notification::create([
                'user_id' => $seller->id,
                'message' => 'You are banned because of multiple reports. Contact admin for inquiries.',
                'type' => 'report_ban',
                'status' => 'unread',
            ]);
        }

        $report->save();
        return redirect()->back()->with('message', 'Action performed successfully.');
    }
}
