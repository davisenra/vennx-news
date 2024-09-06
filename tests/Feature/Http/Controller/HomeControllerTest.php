<?php

namespace Tests\Feature\Http\Controller;

use App\Http\Controllers\HomeController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(HomeController::class)]
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[DataProvider('privateRoutesProvider')]
    public function requiresAuthentication(string $method, string $route): void
    {
        $this->call($method, $route)->assertStatus(302)->assertRedirect('/');
    }

    public static function privateRoutesProvider(): array
    {
        return [
            ['GET', '/articles'],
            ['GET', '/articles/write'],
            ['POST', '/articles'],
            ['GET', '/articles/1/edit'],
            ['POST', '/articles/1'],
        ];
    }

    #[Test]
    public function userCanManageHisArticles(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/articles')->assertStatus(200);
    }

    #[Test]
    public function userCanWriteArticles(): void
    {
        $this->actingAs(User::factory()->create());

        $image = file_get_contents(__DIR__.'/../../../Fixtures/image.png');

        $response = $this->post('/articles', [
            'title' => 'Article Title',
            'content' => 'Article Content',
            'image' => UploadedFile::fake()->createWithContent('image.jpg', $image),
        ]);

        $response->assertStatus(302)->assertRedirect('/articles/1');

        $this->assertDatabaseHas('articles', [
            'title' => 'Article Title',
            'content' => 'Article Content',
        ]);
    }

    #[Test]
    public function userCanEditAnArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()
            ->for($user, 'author')
            ->create();

        $this->get('/articles/'.$article->id)->assertStatus(200);
    }

    #[Test]
    public function userCanUpdateAnArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = new Article([
            'title' => 'Article Title',
            'content' => 'Article Content',
            'image' => 'fake.jpg',
            'published_at' => now(),
        ]);
        $article->author()->associate($user);
        $article->save();

        $response = $this->post('/articles/'.$article->id, [
            'title' => 'New Title 2',
            'content' => 'New Content 2',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/articles/1');

        $this->assertDatabaseHas('articles', [
            'title' => 'New Title 2',
            'content' => 'New Content 2',
        ]);
    }

    #[Test]
    public function userCannotEditAnotherUserArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $otherUser = User::factory()->create();
        $article = Article::factory()->for($otherUser, 'author')->create();

        $response = $this->get('/articles/'.$article->id.'/edit');
        $response->assertStatus(403);
    }

    #[Test]
    public function userCannotUpdateAnotherUserArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $otherUser = User::factory()->create();
        $article = Article::factory()->for($otherUser, 'author')->create();

        $response = $this->post('/articles/'.$article->id, [
            'title' => 'New Title 2',
            'content' => 'New Content 2',
        ]);

        $response->assertStatus(403);
    }

    #[Test]
    public function userCanUpdateAnArticleImage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $image = file_get_contents(__DIR__.'/../../../Fixtures/image.png');

        $article = new Article([
            'title' => 'Article Title',
            'content' => 'Article Content',
            'image' => 'fake.jpg',
            'published_at' => now(),
        ]);
        $article->author()->associate($user);
        $article->save();

        $response = $this->post('/articles/'.$article->id, [
            'title' => 'Article Title',
            'content' => 'Article Content',
            'new_image' => UploadedFile::fake()->createWithContent('image.jpg', $image),
        ]);

        $response->assertStatus(302);

        // should be missing because a different image was submitted
        $this->assertDatabaseMissing('articles', [
            'image' => 'fake.jpg',
        ]);
    }
}
