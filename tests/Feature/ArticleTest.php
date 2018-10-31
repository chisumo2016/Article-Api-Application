<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testsArticleCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $playload = [
            'title'         => 'Lorem',
            'description'   => 'Ipsum',
        ];

        $this->json('POST', '/api/articles', $playload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id'            =>  1,
                'title'         => 'Lorem',
                'description'   => 'Ipsum',
            ]);

    }


    /**
     * A basic test example.
     *
     * @return void
     */

    public function testsArticleAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $article = factory(Article::class)->create([
            'title'         => 'First Article',
            'description'   => 'First Description',
        ]);

        $playload = [
            'title'         => 'Lorem',
            'description'   => 'Ipsum',
        ];

        $response = $this->json('PUT', 'api/articles' .$article->id, $playload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id'            =>  1,
                'title'         => 'Lorem',
                'description'   => 'Ipsum',
            ]);

    }

    /**
     * A Articles test example.
     *
     * @return void
     */

    public  function testsArticlesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $article = factory(Article::class)->create([
            'title'         => 'First Article',
            'description'   => 'First Description',
        ]);

        $this->json('DELETE', '/api/articles' .$article->id, [], $headers)
            ->assertStatus(204);

    }

    /**
     * A basic test example.
     *
     * @return void
     */


    public  function testArticlesAreListedCorrectly()
    {
        factory(Article::class)->create([
            'title'         => 'First Article',
            'description'   => 'First Description',
        ]);

        factory(Article::class)->create([
            'title'         => 'Second Article',
            'description'   => 'Second Description',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];


        $response = $this->json('GET', 'api/articles' ,[],  $headers)
            ->assertStatus(200)
            ->assertJson([
                ['title'         => 'First Article' , 'description'  => 'First Description'],
                ['title'         => 'Second Article' , 'description' => 'Second Description'],
            ])

            ->assertJsonStructure([
                '*' => ['id' , 'description' , 'title', 'created_at', 'updated_at'],
            ]);



    }
}
