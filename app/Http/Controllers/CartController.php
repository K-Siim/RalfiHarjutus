<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $cartItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return Inertia::render('Shop/Cart', [
            'cartItems' => $cartItems,
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cart = $request->session()->get('cart', []);
        $productId = $validated['product_id'];

        if (isset($cart[$productId])) {
            $cart[$productId] += $validated['quantity'];
        } else {
            $cart[$productId] = $validated['quantity'];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cart = $request->session()->get('cart', []);
        $cart[$validated['product_id']] = $validated['quantity'];
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = $request->session()->get('cart', []);
        unset($cart[$validated['product_id']]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return Inertia::render('Shop/Checkout', [
            'cartItems' => $cartItems,
            'total' => round($total, 2),
        ]);
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'payment_method' => 'required|in:stripe,paypal',
        ]);

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = 0;
        $items = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        // Simulate payment processing
        $paymentSuccess = $this->simulatePayment($validated['payment_method'], $total);

        if ($paymentSuccess) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'total' => round($total, 2),
                'status' => 'paid',
                'payment_method' => $validated['payment_method'],
                'payment_id' => 'PAY-' . Str::upper(Str::random(16)),
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                ]);
            }

            $request->session()->forget('cart');

            return Inertia::render('Shop/Success', [
                'order' => $order->load('items.product'),
            ]);
        }

        return redirect()->route('cart.checkout')->withErrors([
            'payment' => 'Makse ebaõnnestus. Palun proovi uuesti.',
        ]);
    }

    private function simulatePayment(string $method, float $total): bool
    {
        // Simulate payment gateway - in production, integrate real Stripe/PayPal API
        // Payment fails if total > 10000 (simulated limit)
        return $total > 0 && $total <= 10000;
    }
}
