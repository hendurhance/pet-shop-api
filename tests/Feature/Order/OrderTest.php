<?php

namespace Tests\Feature\Order;

use App\Actions\Auth\AuthAction;
use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $brands;

    private $images;

    private $categories;

    private $products;

    private $payments;

    private $orderStatuses;

    private $orders;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->categories = Category::factory()->count(3)->create();
        $this->brands = Brand::factory()->count(3)->create();
        $this->images = File::factory()->count(3)->create();
        $this->products = Product::factory()->count(5)->create();
        $this->payments = Payment::factory()->count(3)->create();
        $this->orderStatuses = OrderStatus::factory()->count(3)->create();
        $this->orders = Order::factory()->count(5)->create();
    }

    /**
     * Test list all orders works.
     * @return void
     */
    public function test_list_all_orders_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.orders.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test list all shipped orders works.
     * @return void
     */
    public function test_list_all_shipped_orders_works()
    {
        OrderFactory::new()->shipped()->count(5)->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.orders.shipment-locator'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test list order dashboard works.
     * @return void
     */
    public function test_list_order_dashboard_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.orders.dashboard'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test create order works.
     * @return void
     */
    public function test_create_order_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.orders.store'), [
            'payment_uuid' => $this->payments->first()->uuid,
            'order_status_uuid' => $this->orderStatuses->first()->uuid,
            'address' => [
                'shipping' => 'Rua teste',
                'billing' => 'Rua teste',
            ],
            'products' => [
                [
                    'uuid' => $this->products->first()->uuid,
                    'quantity' => 1,
                ],
                [
                    'uuid' => $this->products->last()->uuid,
                    'quantity' => 1,
                ],
            ],
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('orders', [
            'payment_id' => $this->payments->first()->id,
            'order_status_id' => $this->orderStatuses->first()->id,
        ]);
    }

    /**
     * Test create order fails with invalid data.
     * @return void
     */
    public function test_create_order_fails_with_invalid_data()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.orders.store'), [
            'payment_uuid' => $this->payments->first()->uuid,
            'order_status_uuid' => $this->orderStatuses->first()->uuid,
            'address' => [
                'shipping' => 'Rua teste',
                'billing' => 'Rua teste',
            ],
            'products' => [],
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test show order works.
     * @return void
     */
    public function test_show_order_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.order.show', $this->orders->first()->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->orders->first()->uuid,
        ]);
    }

    /**
     * Test update order works.
     * @return void
     */
    public function test_update_order_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('PUT', route('api.v1.order.update', $this->orders->first()->uuid), [
            'payment_uuid' => $this->payments->first()->uuid,
            'order_status_uuid' => $this->orderStatuses->first()->uuid,
            'address' => [
                'shipping' => 'Rua teste',
                'billing' => 'Rua teste',
            ],
            'products' => [
                [
                    'uuid' => $this->products->first()->uuid,
                    'quantity' => 1,
                ],
                [
                    'uuid' => $this->products->last()->uuid,
                    'quantity' => 1,
                ],
            ],
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('orders', [
            'payment_id' => $this->payments->first()->id,
            'order_status_id' => $this->orderStatuses->first()->id,
        ]);
    }

    /**
     * Test delete order works.
     * @return void
     */
    public function test_delete_order_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('DELETE', route('api.v1.order.destroy', $this->orders->first()->uuid));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('orders', [
            'uuid' => $this->orders->first()->uuid,
        ]);
    }

    /**
     * Test download order invoice works.
     * @return void
     */
    public function test_download_order_invoice_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.order.download', $this->orders->first()->uuid));

        $response->assertHeader('content-type', 'application/json');
    }
}
