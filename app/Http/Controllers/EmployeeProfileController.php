<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ProfileView;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EmployeeProfileController extends Controller
{
    public function show($slug, Request $request)
    {
        $employee = Employee::where('slug', $slug)
            ->with('company')
            ->firstOrFail();

        if ($employee->status !== 'active' || !$employee->public_profile_enabled || !$employee->company->is_active) {
            return view('employee.inactive');
        }

        // Record profile view
        ProfileView::create([
            'employee_id' => $employee->id,
            'ip_hash' => hash('sha256', $request->ip()),
            'user_agent' => $request->userAgent(),
            'referrer' => $request->header('referer'),
            'viewed_at' => now(),
        ]);

        // Increment scan count and update last_scanned_at
        $employee->increment('scan_count');
        $employee->update(['last_scanned_at' => now()]);

        return view('employee.profile', compact('employee'));
    }

    public function vcard($slug)
    {
        $employee = Employee::where('slug', $slug)
            ->with('company')
            ->firstOrFail();

        if ($employee->status !== 'active' || !$employee->public_profile_enabled || !$employee->company->is_active) {
            abort(404);
        }

        $phone = $employee->show_phone && $employee->phone ? $employee->phone : null;
        $email = $employee->show_email && $employee->email ? $employee->email : null;
        $address = $employee->show_company_address && $employee->company->bangladesh_office_address
            ? $employee->company->bangladesh_office_address
            : null;

        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";
        $vcard .= "FN:" . $employee->full_name . "\r\n";
        $vcard .= "ORG:" . $employee->company->name . "\r\n";
        if ($employee->designation) {
            $vcard .= "TITLE:" . $employee->designation . "\r\n";
        }
        if ($phone) {
            $vcard .= "TEL;TYPE=WORK:" . $phone . "\r\n";
        }
        if ($email) {
            $vcard .= "EMAIL:" . $email . "\r\n";
        }
        $vcard .= "URL:" . route('employee.public.show', $employee->slug) . "\r\n";
        if ($address) {
            $vcard .= "ADR;TYPE=WORK:;;;" . str_replace("\n", " ", $address) . "\r\n";
        }
        $vcard .= "END:VCARD\r\n";

        return response($vcard)
            ->header('Content-Type', 'text/vcard')
            ->header('Content-Disposition', "attachment; filename=employee-{$employee->slug}.vcf");
    }

    public function qrDownload(Employee $employee)
    {
        $url = route('employee.public.show', $employee->slug);
        if (! extension_loaded('imagick')) {
            abort(500, 'PNG QR download requires the PHP imagick extension.');
        }

        $qr = QrCode::format('png')->size(400)->margin(2)->generate($url);

        return response($qr)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "attachment; filename=employee-{$employee->slug}-qr.png");
    }
}
