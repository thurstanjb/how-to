<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleNavigationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function _anyone_can_view_the_list_of_articles()
    {
        $art = create(Article::class);
        $art2 = create(Article::class);

        $this->get(route('articles.index'))
            ->assertSee($art->title)
            ->assertSee($art2->book->title);
    }

    /** @test */
    public function _anyone_can_view_an_article()
    {
        $art = create(Article::class, ['title' => 'My new Book']);
//        dd($art->path());
        $this->get($art->path())
            ->assertSee($art->title)
            ->assertSee($art->author);
    }

    /** @test */
    public function _only_authorised_users_can_visit_the_create_form()
    {
        $this->get(route('admin.articles.create'))
            ->assertRedirect('/login');

        $this->signIn();
        $this->get(route('admin.articles.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function _only_the_author_can_visit_the_update_form()
    {
        $user = create(User::class);
        $userArticle = create(Article::class, ['user_id' => $user->id]);
        $route = route('admin.articles.edit', ['article' => $userArticle]);
        $this->get($route)
            ->assertRedirect('/login');

        $this->signIn();
        $this->get($route)
            ->assertStatus(403);
        $this->signOut();

        $this->signInAdmin();
        $this->get($route)
            ->assertStatus(403);
        $this->signOut();

        $this->signIn($user);
        $this->get($route)
            ->assertStatus(200);
    }
}
