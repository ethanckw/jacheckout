# jacheckout
Ad Checkout System. View the demo [here](https://seek.ethanbytes.com)


# Setup #
1. `composer install`
2. `npm install`
3. `npm run {dev|prod}`


# How it works #
This system is created based on Laravel/ReactJS framework.


# Backend #
## Table Structure ##
The table structures are in `database/migrations` folder, with the corresponding models in `app/Models` folder.

| Tables        | Purpose           |
| ------------- | ------------- |
| ad_types      | Store all ad types |
| customers     | Store all customers |
| discount_quantities | Store discount that is applied for per item when min quantity is met |
| discount_additional_items | Store discount that is applied for additional item when min quantity is met |
| orders | Container for an order |
| order_items | Individual purchases of ads in an order |

## Seeding ##
We utilize seeders to quickly initialize the database to have the data that we want to begin the application with. 
They are found in `database/seeds`.

## Routing ##
Route serves to map the request endpoint to the response in the simple form of a function, or via a controller.

The API routes are in routes/api.php.

The Web routes are in routes/web.php.

## Services ##
Controller will interact with services which does the bulk of the business logic. They are at `app/Services` folder.

## Tests ##
We use factory methods to create test/mock data for testing, we chose value to resemble the value we are to use,
otherwise will use Faker to generate random fake values. The tests can be found under `tests/unit`.

# Frontend #
We use laravel-mix to compile assets from sources `resources/{js|sass}` to the final asset in `public/{js|css}`

## Frontend Libraries ##
1. React
2. React-DOM 
3. React-Router-DOM (For routing)
4. React-Bootstrap (React Bootstrap Components)

## Folder structure ##
I used a flat structure as there's not much components to deal with at the moment.

| File | Purpose |
| --- | --- |
| app.jsx | Route path to components |
| main.jsx | Index page that shows the list of orders in the system with option to create new order |
| order.jsx | Interim page to begin new order, ensuring that a customer is selected before proceeding to purchasing |
| orderPurchase.jsx | Main purchasing page that handles ad purchasing for an order |

