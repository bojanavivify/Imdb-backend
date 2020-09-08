<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Movie;
use App\Genre;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;


class LikeFeatureTest extends TestCase
{
    use WithoutMiddleware;

    protected $headers;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('passport:install');
        $this->headers = [
            'Accept' =>'application/json',
        ];
        factory(User::class, 1)->create();
        factory(Genre::class, 5)->create();
        factory(Movie::class, 5)->create();
    }

    public function testRequiredFieldsForStoreVote()
    {
        $response = $this->post('api/votes',[], $this->headers);
        $response->assertStatus(422);
        $response->assertJson([
                "message" => "A vote is required".
                "The movies id field is required.".
                "The user id field is required.",
        ]);
    }

    public function testWrongUserIdFieldForStoreVote()
    {
        $data = [
            'movies_id'=> 1,
            'user_id' => 100,
            'vote' => 'like',
        ];
        $response = $this->post('api/votes', $data, $this->headers);
        $response->assertStatus(422);
        $response->assertJson(["message" => "User doesnt exist"]);
    }

    public function testWrongMovieIdFieldForStoreVote()
    {
        $data = [
            'movies_id'=> 100,
            'user_id' => 1,
            'vote' => 'like',
        ];
        $response = $this->post('api/votes', $data, $this->headers);
        $response->assertStatus(422);
        $response->assertJson(["message" => "Movie doesnt exist"]);
    }

    public function testWrongTypeVoteFieldForStoreVote()
    {
        $data = [
            'movies_id'=> 1,
            'user_id' => 1,
            'vote' => 'vdvdvd',
        ];
        $response = $this->post('api/votes', $data, $this->headers);
        $response->assertStatus(422);
        $response->assertJson(["message" => "That type of vote doesnt exist"]);
    }

    public function testSuccessfulStoreVote()
    {
        $data = [
            'movies_id'=> 1,
            'user_id' => 1,
            'vote' => 'like',
        ];
        $response = $this->post('api/votes', $data, $this->headers);
        $response->assertStatus(200);
        $response->assertExactJson(["Successfully vote created!"]);
    }

}
