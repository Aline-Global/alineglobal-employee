<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->company = Company::create([
            'name' => 'Test Company',
            'website' => 'https://example.com',
            'is_active' => true,
        ]);
    }

    public function test_active_employee_profile_returns_200(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'John Doe',
            'slug' => 'john-doe',
            'designation' => 'Manager',
            'email' => 'john@example.com',
            'status' => 'active',
            'public_profile_enabled' => true,
        ]);

        $response = $this->get(route('employee.public.show', $employee->slug));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
    }

    public function test_inactive_employee_returns_404_or_unavailable(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'Jane Doe',
            'slug' => 'jane-doe',
            'status' => 'inactive',
            'public_profile_enabled' => true,
        ]);

        $response = $this->get(route('employee.public.show', $employee->slug));

        $response->assertSee('Profile Not Found');
    }

    public function test_disabled_public_profile_returns_unavailable(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'Bob Smith',
            'slug' => 'bob-smith',
            'status' => 'active',
            'public_profile_enabled' => false,
        ]);

        $response = $this->get(route('employee.public.show', $employee->slug));

        $response->assertSee('Profile Not Found');
    }

    public function test_vcard_route_returns_vcf(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'Alice Johnson',
            'slug' => 'alice-johnson',
            'email' => 'alice@example.com',
            'phone' => '+1234567890',
            'status' => 'active',
            'public_profile_enabled' => true,
            'show_email' => true,
            'show_phone' => true,
        ]);

        $response = $this->get(route('employee.vcard', $employee->slug));

        $response->assertSee('BEGIN:VCARD');
        $response->assertSee('Alice Johnson');
        $response->assertSee('VERSION:3.0');
    }

    public function test_scan_count_increments_on_profile_view(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'Charlie Brown',
            'slug' => 'charlie-brown',
            'status' => 'active',
            'public_profile_enabled' => true,
            'scan_count' => 0,
        ]);

        $this->assertEquals(0, $employee->fresh()->scan_count);

        $this->get(route('employee.public.show', $employee->slug));

        $this->assertEquals(1, $employee->fresh()->scan_count);
        $this->assertNotNull($employee->fresh()->last_scanned_at);

        $this->get(route('employee.public.show', $employee->slug));

        $this->assertEquals(2, $employee->fresh()->scan_count);
    }

    public function test_hidden_phone_not_on_public_page(): void
    {
        $employee = Employee::create([
            'company_id' => $this->company->id,
            'full_name' => 'David Lee',
            'slug' => 'david-lee',
            'phone' => '+9876543210',
            'status' => 'active',
            'public_profile_enabled' => true,
            'show_phone' => false,
        ]);

        $response = $this->get(route('employee.public.show', $employee->slug));

        $response->assertDontSee('+9876543210');
        $response->assertStatus(200);
    }
}
