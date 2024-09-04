<?php

namespace Tests\Feature\Http\Controller;

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(HomeController::class)]
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function renderThePage(): void
    {
        $this->get(route('home'))->assertStatus(200);
    }
}
