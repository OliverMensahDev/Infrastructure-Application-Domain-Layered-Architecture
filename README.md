## Code Problem

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

## Using Domain, Application and Infrastructure layered architecture

This idea behind this architecture is to separate core code which forms your business logic from infrastructure code that supports the core code. The code code is usually separated into domain and applications layers. The domain layer basically extracts codes from database interaction code into entities and repositories. The Application layer at its core extract services from controllers.

### Application Directory

This folder contains the codes for various use cases of the application. These are called services. It has a service for creating an ebook, creating ebook order, listing all available ebooks and showing a single ebook

### Domain Directory

This contains code that represent entities interacting with the database and their repositories

### Repositories Directory

Provides the implementation details of repositories of Domain entities

### Sample database structure used here

```sql
CREATE DATABASE iad_db;

USE iad_db;

CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `uuid` varchar(60) NOT NULL
);

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(30) NOT NULL,
  `amount` int(20) NOT NULL,
  `quantity` int(40) NOT NULL,
  `uuid` varchar(64) NOT NULL
);
```

### Sample Endpoints

POST: http://127.0.0.1:8000/api/ebooks/

POST: http://127.0.0.1:8000/api/ebooks/{REPLACE_WITH_EBOOK_UUID}/order

GET: http://127.0.0.1:8000/api/ebooks/{REPLACE_WITH_EBOOK_UUID}

GET: http://127.0.0.1:8000/api/ebooks/
