<?php

namespace Tests\Feature\Order;

use App\Actions\Auth\AuthAction;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderStatusTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $orderStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->orderStatus = OrderStatus::factory()->count(5)->create();
    }

    /**
     * Test create order status works
     * @return void
     */
    public function test_create_order_status_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.order.status.store'), [
            'title' => 'Test Order Status',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'title' => 'Test Order Status',
            ]
        ]);

        $this->assertDatabaseHas('order_statuses', [
            'title' => 'Test Order Status',
        ]);
    }

    /**
     * Test create order status fails when title is missing
     * @return void
     */
    public function test_create_order_status_fails_when_title_is_missing()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.order.status.store'), [
            'title' => '',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJson([
            'errors' => [
                'title' => [
                    'The title field is required.'
                ]
            ]
        ]);
    }

    /**
     * Test list all order statuses works.
     * @return void
     */
    public function test_list_all_order_statuses_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.order.status.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => $this->orderStatus[0]->title,
        ]);
    }

    /**
     * Test show order status works.
     * @return void
     */
    public function test_show_order_status_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.order-status.show', $this->orderStatus[0]->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => $this->orderStatus[0]->title,
        ]);
    }

    /**
     * Test update order status works.
     * @return void
     */
    public function test_update_order_status_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('PUT', route('api.v1.order-status.update', $this->orderStatus[0]->uuid), [
            'title' => 'Updated Order Status',
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => 'Updated Order Status',
        ]);

        $this->assertDatabaseHas('order_statuses', [
            'title' => 'Updated Order Status',
        ]);
    }

    /**
     * Test delete order status works.
     * @return void
     */
    public function test_delete_order_status_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('DELETE', route('api.v1.order-status.destroy', $this->orderStatus[0]->uuid));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }


}
