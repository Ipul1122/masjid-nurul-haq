<?php

namespace Tests\Feature;

// 1. Tambahkan baris ini
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // 2. Tambahkan baris ini di dalam class
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Kode ini sekarang akan berjalan setelah migrasi dijalankan
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}