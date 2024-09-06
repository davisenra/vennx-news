<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ArticlesTable;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(ArticlesTable::class)]
class ArticlesTableTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function userCanDeleteAnArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()
            ->for($user, 'author')
            ->create();

        Livewire::test(ArticlesTable::class)
            ->call('deleteArticle', $article->id);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    #[Test]
    public function userCannotDeleteAnotherUserArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $otherUser = User::factory()->create();
        $article = Article::factory()
            ->for($otherUser, 'author')
            ->create();

        Livewire::test(ArticlesTable::class)
            ->call('deleteArticle', $article->id)
            ->assertStatus(403);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
        ]);
    }
}
