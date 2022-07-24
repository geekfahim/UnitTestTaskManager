<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use withFaker, RefreshDatabase;

    public function test_Basic()
    {

        $response = $this->get('/employee');

        $response->assertStatus(200);
    }

    public function test_create_employee()
    {
        $this->withoutExceptionHandling();

        $attributes = Employee::factory()->make()->toArray();

        $this->post('employee', $attributes);

        $this->assertDatabaseHas('employees', $attributes);

    }

    public function test_validation_name()
    {
        $attributes = Employee::factory()->raw(['name' => '']);
        $this->post('/employee')->assertSessionHasErrors('name');
    }

    public function test_validation_office_id()
    {
        $attributes = Employee::factory()->raw(['office_id' => '']);
        $this->post('/employee')->assertSessionHasErrors('office_id');
    }

}
