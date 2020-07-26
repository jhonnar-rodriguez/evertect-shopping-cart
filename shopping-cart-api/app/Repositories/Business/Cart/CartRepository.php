<?php namespace App\Repositories\Business\Cart;

use App\Models\Access\User\User;
use App\Models\Business\Cart\Cart;
use App\Models\Business\CartItem\CartItem;
use App\Models\Business\Product\Product;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var $loggedUser
     */
    private $loggedUser;

    /**
     * CartRepository constructor.
     *
     * @param Cart $cart
     */
    public function __construct( Cart $cart )
    {
        $this->cart = $cart;
    }

    /**
     * @inheritDoc
     **/
    public function addToCart( Request $request, Product $product )
    {
        try
        {
            $productQuantity = ( int ) $request->quantity > 0 ? ( int ) $request->quantity : 15;

            # Getting the cart and the items for the logged user
            $this->loggedUser = $request->user();
            $userCart   = $this->handleUserCart();
            $cartItems  = $userCart->items();
            $productID  = $product->id;

            $productInCart = $cartItems->where( 'product_id', $productID )->first();

            if ( empty( $productInCart ) == false )
            {
                $cartItems
                    ->where( 'product_id', $productID )
                    ->update([
                    'quantity' => $productQuantity,
                ]);
            }
            else
            {
                $cartItems->save(
                    new CartItem(
                        [
                            'cart_id'       => $userCart->id,
                            'product_id'    => $productID,
                            'quantity'      => $productQuantity,
                        ]
                    )
                );
            }

            return $this->response(
                [],
                'Item successfully added to the cart',
                config( 'business.http_responses.created.code' )
            );
        }
        catch ( \Exception $exception )
        {
            Log::error(
                "CartRepository.addToCart: Something went wrong adding the given product to the card. " .
                "Details: {$exception->getMessage()}"
            );

            return $this->response(
                [],
                'Something went wrong adding the given product to the card, please try again later.',
                config( 'business.http_responses.server_error.code' )
            );
        }
    }

    /**
     * Return the user cart based on the logged user.
     * If the user does not have a card it will create a new one
     * If already has a cart the we will return the same cart
     *
     * @return mixed|null
     */
    private function handleUserCart()
    {
        $loggedUser = $this->loggedUser;
        $userCart = isset( $loggedUser->cart ) ? $loggedUser->cart : null;

        if ( is_null( $userCart ) === false )
        {
            return $userCart;
        }
        else
        {
            if ( $this->createCartStub() === true )
            {
                # We need to get the relation value again
                $userCart = $this->loggedUser->cart()->first();
            }
            else
            {
                $userCart = null;
            }
        }

        return $userCart;
    }

    /**
     * Create a new cart to the logged user
     *
     * @return bool
     */
    private function createCartStub()
    {
        try
        {
            $this->loggedUser->cart()
                ->create(
                    [
                        'created_at' => Carbon::now()
                    ]
                );

            return true;
        }
        catch ( \Exception $exception )
        {
            Log::error(
                "CartRepository.createCartStub: Something went wrong adding a new cart to the user. Details: " .
                "{$exception->getMessage()}"
            );

            return false;
        }
    }
}