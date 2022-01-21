<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Invoices/Index',[
            'invoices' => Invoice::with(['customer'])->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Invoices/Create',[
            'customers' => Customer::all()

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['total_price'] = $request
            ->collect('items')
            ->map(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 0))
            ->sum();

//        dd($request->input());

        /** @var Invoice $invoice */
        $invoice = Invoice::create($validated);





        $request
            ->collect('items')
            ->each(function($item) use ($invoice) {
                $invoice->items()->create($item);
            });

        return redirect()->route('invoices.index')->with('message', ' Successfully Created!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('customer');
        return Inertia::render('Invoices/Show' , compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice , Customer $customer)
    {
        return Inertia::render('Invoices/Edit' , compact('invoice','customer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInvoiceRequest $request, Invoice $invoice)
    {
        $validated = $request->validated();

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('message', ' Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf(Invoice $invoice )
    {
        return $this->generateInvoice($invoice)->stream();
    }

    private function generateInvoice(Invoice $invoice)
    {
        /** @var Customer $invoiceCustomer */
        $invoiceCustomer = $invoice->customer;

        /** @var User $invoiceUser */
        $invoiceUser = $invoice->user;

        $invoiceItems = $invoice->items;



        $customer = new Buyer([
            'name'          => $invoiceCustomer->name,
            'phone'         => $invoiceCustomer->phone,
            'custom_fields' => [
                'email' => $invoiceCustomer->email,
                'lastname' => $invoiceCustomer->lastname,
                'country' => $invoiceCustomer->country,
                'street' => $invoiceCustomer->street,
                'city' => $invoiceCustomer->city,
                'region' => $invoiceCustomer->region,

            ],
        ]);

        $client = new Party([
            'name'          => $invoiceUser->name,
            'phone'         => $invoiceUser->phone,
            'custom_fields' => [
                'email' => $invoiceUser->email,
                'lastname' => $invoiceUser->lastname,
                'country'=> $invoiceUser->country,
                'street'=> $invoiceUser->street,
                'city'=> $invoiceUser->city,
                'region'=> $invoiceUser->region,
                'signature'=>$invoiceUser->signature_image
            ],
        ]);


        $items = [];

        /** @var \App\Models\InvoiceItem $item */
        $invoiceItems->each(function ($item, $key) use (&$items) {
            $items[] = (new InvoiceItem())
                ->title($item->title)
                ->pricePerUnit($item->price)
                ->quantity($item->quantity);
        });

        $invoice = \LaravelDaily\Invoices\Invoice::make()
            ->seller($client)
            ->buyer($customer)
            ->addItems($items)
            ->dateFormat('d/m/Y')
            ->currencySymbol('€')
            ->currencyCode('EUR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->filename($invoice->invoice_name )
            ->serialNumberFormat($invoice->id)
            ->currencyDecimalPoint(',')
            ->taxRate(21)
            ->payUntilDays($invoice->due_date)
//            ->save('public')
            ->logo($invoiceUser->logo ? Storage::path($invoiceUser->logo) : '');

//        dd($invoice->getLogo());

        return $invoice;
    }

    public function downloadpdf(Invoice $invoice)
    {
        return $this->generateInvoice($invoice)->download();
    }
}
