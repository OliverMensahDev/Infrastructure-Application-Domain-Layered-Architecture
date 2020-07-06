# Code Problem

```php
$ebookPrice = DB::table('ebooks')->where('id',  $request->ebook_id)->value('price');
$orderAmount = (int) $request->quantity * (int) $ebookPrice;
$record = [
  'email' => $request->email_address,
  'quantity' => (int) $request->quantity,
  'amount' => $orderAmount,
];
$lastInsertedId = DB::table('orders')->insertGetId($record);
session(['currentOrderId' => $lastInsertedId]);
return  new Response($lastInsertedId);
```

The code above would be the basis for refactoring to achieve code that is completely independent of any infrastructure using the Domain, Application and Infrastructure layered architecture
