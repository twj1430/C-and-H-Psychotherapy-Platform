{
"id": "5O190127TN364715T",
"status": "COMPLETED",
"payer": {
"name": {
"given_name": "John",
"surname": "Doe"
},
"email_address": "customer@example.com",
"payer_id": "QYR5Z8XDVJNXQ"
},
"purchase_units": [
{
"reference_id": "d9f80740-38f0-11e8-b467-0ed5f89f718b",
"shipping": {
"address": {
"address_line_1": "2211 N First Street",
"address_line_2": "Building 17",
"admin_area_2": "John",
"admin_area_1": "CA",
"postal_code": "95131",
"country_code": "US"
}
},
"payments": {
"authorizations": [
{
"id": "0AW2184448108334S",
"status": "CREATED",
"amount": {
"currency_code": "USD",
"value": "100.00"
},
"seller_protection": {
"status": "ELIGIBLE",
"dispute_categories": [
"ITEM_NOT_RECEIVED",
"UNAUTHORIZED_TRANSACTION"
]
},
"expiration_time": "2018-05-01T21:20:49Z",
"create_time": "2018-04-01T21:20:49Z",
"update_time": "2018-04-01T21:20:49Z",
"links": [
{
"href": "https://api.paypal.com/v2/payments/authorizations/0AW2184448108334S",
"rel": "self",
"method": "GET"
},
{
"href": "https://api.paypal.com/v2/payments/authorizations/0AW2184448108334S/capture",
"rel": "capture",
"method": "POST"
},
{
"href": "https://api.paypal.com/v2/payments/authorizations/0AW2184448108334S/void",
"rel": "void",
"method": "POST"
},
{
"href": "https://api.paypal.com/v2/payments/authorizations/0AW2184448108334S/reauthorize",
"rel": "reauthorize",
"method": "POST"
}
]
}
]
}
}
],
"links": [
{
"href": "https://api.paypal.com/v2/checkout/orders/5O190127TN364715T",
"rel": "self",
"method": "GET"
}
]
}