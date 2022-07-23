<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;
    
    public function test_Basic()
    {

        $response = $this->get('/employee');

        $response->assertStatus(200);
    }

    public function test_create_project()
    {
        $data = [
            'name'=> $this->faker->sentence,
            'office_id'=> $this->faker->numerify('2##'),
            'designation'=> $this->faker->jobTitle,
            'email'=> $this->faker->email,
            'mobile'=> $this->faker->numerify('017########'),
        ];
        $response = $this->post('employee',$data);

        $this->assertDatabaseHas('employees',$data);

    }
}
