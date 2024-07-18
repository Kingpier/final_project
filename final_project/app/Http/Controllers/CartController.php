<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Models\InvoiceHeader;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $toy = Toy::findOrFail($id);

        $cart = Session::get('cart', []);

        // Check if toy is already in cart
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $toy->name,
                "quantity" => 1,
                "price" => $toy->price,
                "image" => $toy->image
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Toy added to cart!');
    }

    public function remove(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Toy removed from cart!');
    }

    public function buy(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Retrieve authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to purchase items.');
        }

        // Create Invoice Header
        $invoiceHeader = InvoiceHeader::create([
            'user_id' => $user->id, // Adjust to your user_id column name in users table
            'total_price' => $this->getCartTotal(),
        ]);

        // Create Invoice Details
        foreach ($cart as $id => $item) {
            InvoiceDetail::create([
                'invoice_header_id' => $invoiceHeader->id,
                'toy_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);
        }

        // Clear the cart after purchase
        Session::forget('cart');

        return redirect()->route('cart.confirmation')->with('success', 'Purchase successful! You will receive a confirmation shortly.');
    }

    
    protected function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $id => $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return $total;
    }
}
