<?php

namespace Tests\Feature\Http\Controller;

use App\Actions\ListArticles;
use App\Http\Controllers\HomeController;
use App\Models\Article;
use App\Models\User;
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

    #[Test]
    public function listArticlesActionIsCalled(): void
    {
        User::factory()
            ->count(2)
            ->has(Article::factory()->count(1))
            ->create();

        $articles = Article::paginate(10);

        $mockAction = $this->mock(ListArticles::class);
        $this->app->instance(ListArticles::class, $mockAction);

        $mockAction
            ->shouldReceive('handle')
            ->once()
            ->andReturn($articles);

        $this->get(route('home'))->assertStatus(200);
    }
}
