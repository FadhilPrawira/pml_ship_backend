<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{


//Test Case: Test register success
    public function testRegisterSuccess()
    {

        $response = $this->post('/api/register',
            [
//            Request body
                'name' => 'Fadhil Prawira',
                'phone' => '085231806161',
                'email' => 'fadhilprawira87@gmail.com',
                'password' => 'password777',
                'company_name' => 'PT Adaro Energy Indonesia Tbk',
                'company_address' => 'Menara Karya lantai 23, JL. H. R. Rasuna Said Blok X-5, Kav. 1-2 Jakarta',
                'company_NPWP' => '02.399.244.9-091.000',
                'company_phone' => '021-25533000',
                'company_email' => 'marketing@adaro.com',
                'company_akta_url' => 'adaro_comany_akta.pdf'
            ]
        );
        $response->assertStatus(201)->assertJson(fn(AssertableJson $json) => $json->whereType('data.id', 'integer')->where('data.role', 'user')->where('data.name', 'Fadhil Prawira')->where('data.email', fn(string $email) => str($email)->is('fadhilprawira87@gmail.com')));
    }

//Test Case: Test register failed
    public function testRegisterFailed()
    {
        $this->post('/api/register',
            [
//            Request body
                'name' => '',
                'phone' => '',
                'email' => '',
                'password' => '',
                'company_name' => '',
                'company_address' => '',
                'company_NPWP' => '',
                'company_phone' => '',
                'company_email' => '',
                'company_akta_url' => ''
            ]
        )
            ->assertStatus(400)->assertJson(
                [
                    "errors" => [
                        "name" => [
                            "Name is required"
                        ],
                        "phone" => [
                            "Phone is required"
                        ],
                        "email" => [
                            "Email is required"
                        ],
                        "password" => [
                            "Password is required"
                        ],
                        "company_name" => [
                            "Company name is required"
                        ],
                        "company_address" => [
                            "Company address is required"
                        ],
                        "company_phone" => [
                            "Company phone is required"
                        ],
                        "company_email" => [
                            "Company email is required"
                        ],
                        "company_NPWP" => [
                            "Company NPWP is required"
                        ],
                        "company_akta_url" => [
                            "Company akta url is required"
                        ]
                    ]]
            );
    }

//Test Case: Test email already exist
    public function testRegisterEmailAlreadyExist()
    {
        $this->testRegisterSuccess();
        $response = $this->post('/api/register',
            [
//            Request body
                'name' => 'Fadhil Prawira',
                'phone' => '085231806161',
                'email' => 'fadhilprawira87@gmail.com',
                'password' => 'password777',
                'company_name' => 'PT Adaro Energy Indonesia Tbk',
                'company_address' => 'Menara Karya lantai 23, JL. H. R. Rasuna Said Blok X-5, Kav. 1-2 Jakarta',
                'company_NPWP' => '02.399.244.9-091.000',
                'company_phone' => '021-25533000',
                'company_email' => 'marketing@adaro.com',
                'company_akta_url' => 'adaro_comany_akta.pdf'
            ]
        );
//        $response->assertStatus(400)->assertJson(fn(AssertableJson $json) => $json->where('errors.email.0', 'Email already exists'));
        $response->assertJsonValidationErrorFor('email');
    }

//Test Case: Test login success
    public function testLoginSuccess()
    {
        $this->seed([
            UserSeeder::class
        ]);
        $response = $this->post('/api/login',
            [
//            Request body
                'email' => 'fadhilprawira87@gmail.com',
                'password' => 'password777',
            ]
        );
        $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->whereType('token', 'string')->where('data.role', 'admin')->where('data.name', 'Fadhil Prawira')->where('data.email', fn(string $email) => str($email)->is('fadhilprawira87@gmail.com')));
    }

//    Test case: Test login failed
    public function testLoginFailed()
    {
        $this->seed([
            UserSeeder::class
        ]);
        $response = $this->post('/api/login',
            [
//            Request body
                'email' => 'fadhilprawira@gmail.com',
                'password' => 'password888',
            ]
        );
        $response->assertStatus(401)->assertJson(
            [
                "errors" => [
                    "message" => [
                        "Email or password is incorrect."
                    ]
                ]
            ]
        );
    }

//    Test case: Test login failed empty email field
    public function testLoginFailedEmptyEmailField()
    {
        $this->seed([
            UserSeeder::class
        ]);
        $response = $this->post('/api/login',
            [
//            Request body
                'email' => '',
                'password' => 'password888',
            ]
        );
        $response->assertStatus(400)->assertJson(
            [
                "errors" => [
                    "email" => [
                        "Email is required"
                    ]
                ]
            ]
        );
    }

    //    Test case: Test login failed empty password field
    public function testLoginFailedEmptyPasswordField()
    {
        $this->seed([
            UserSeeder::class
        ]);
        $response = $this->post('/api/login',
            [
//            Request body
                'email' => 'fadhilprawira87@gmail.com',
                'password' => '',
            ]
        );
        $response->assertStatus(400)->assertJson(
            [
                "errors" => [
                    "password" => [
                        "Password is required"
                    ]
                ]
            ]
        );
    }

    //    Test case: Test login failed empty email and password field
    public function testLoginFailedEmptyEmailAndPasswordField()
    {
        $this->seed([
            UserSeeder::class
        ]);
        $response = $this->post('/api/login',
            [
//            Request body
                'email' => '',
                'password' => '',
            ]
        );
        $response->assertStatus(400)->assertJson(
            [
                "errors" => [
                    "email" => [
                        "Email is required"
                    ],
                    "password" => [
                        "Password is required"
                    ]
                ]
            ]
        );
    }
}


