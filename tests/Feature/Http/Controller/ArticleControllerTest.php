<?php

namespace Tests\Feature\Http\Controller;

use App\Http\Controllers\ArticleController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ArticleController::class)]
class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function renderThePage(): void
    {
        $this->get('/search?search=lorem')->assertStatus(200);
    }
}
