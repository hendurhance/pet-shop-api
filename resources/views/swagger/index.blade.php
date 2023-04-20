
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Swagger UI</title>
  <link rel="stylesheet" type="text/css" href="/css/swagger-ui.css" >
  <style>
    html
    {
      box-sizing: border-box;
      overflow: -moz-scrollbars-vertical;
      overflow-y: scroll;
    }
    *,
    *:before,
    *:after
    {
      box-sizing: inherit;
    }
    body {
      margin:0;
      background: #fafafa;
    }
  </style>
</head>
<body>
<div id="swagger-ui"></div>
<script src="/js/swagger-ui-bundle.js"> </script>
<script src="/js/swagger-ui-standalone-preset.js"> </script>
<script>
  window.onload = function() {
    var spec = {"openapi": "3.0.0", "info": {"title": "Pet Shop API - Swagger Documentation", "version": "1.0.0"}, "servers": [], "paths": {"/api/v1/brand/create": {"post": {"tags": ["Brands"], "summary": "Create a new brand", "operationId": "brands-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Brand title"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/brand/{uuid}": {"put": {"tags": ["Brands"], "summary": "Update an existing brand", "operationId": "brands-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Brand title"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Brands"], "summary": "delete an existing brand", "operationId": "brands-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "get": {"tags": ["Brands"], "summary": "Fetch a brand", "operationId": "brands-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/brands": {"get": {"tags": ["Brands"], "summary": "List all brands", "operationId": "brands-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/category/create": {"post": {"tags": ["Categories"], "summary": "Create a new category", "operationId": "categories-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Category title"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/category/{uuid}": {"put": {"tags": ["Categories"], "summary": "Update an existing category", "operationId": "categories-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Category title"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Categories"], "summary": "delete an existing category", "operationId": "categories-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "get": {"tags": ["Categories"], "summary": "Fetch a category", "operationId": "categories-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/categories": {"get": {"tags": ["Categories"], "summary": "List all categories", "operationId": "categories-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/orders": {"get": {"tags": ["Orders"], "summary": "List all orders", "operationId": "orders-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/orders/shipment-locator": {"get": {"tags": ["Orders"], "summary": "List all shipped orders", "operationId": "orders-shipping-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}, {"name": "orderUuid", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "customerUuid", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "dateRange", "required": false, "style": "deepObject", "explode": true, "in": "query", "schema": {"type": "object", "properties": {"from": {"type": "string"}, "to": {"type": "string"}}}}, {"name": "fixRange", "required": false, "in": "query", "schema": {"type": "string", "enum": ["today", "monthly", "yearly"]}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/orders/dashboard": {"get": {"tags": ["Orders"], "summary": "List all orders to populate the dashboard", "operationId": "orders-dashboard-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}, {"name": "dateRange", "required": false, "style": "deepObject", "explode": true, "in": "query", "schema": {"type": "object", "properties": {"from": {"type": "string"}, "to": {"type": "string"}}}}, {"name": "fixRange", "required": false, "in": "query", "schema": {"type": "string", "enum": ["today", "monthly", "yearly"]}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/order/create": {"post": {"tags": ["Orders"], "summary": "Create a new order", "operationId": "orders-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["order_status_uuid", "payment_uuid", "products", "address"], "properties": {"order_status_uuid": {"type": "string", "description": "Order status UUID"}, "payment_uuid": {"type": "string", "description": "Payment UUID"}, "products": {"type": "array", "items": {"type": "object", "properties": {"uuid": {"type": "string", "description": "Product UUID"}, "quantity": {"type": "integer", "description": "Product quantity"}}}, "description": "Array of objects with product uuid and quantity"}, "address": {"type": "object", "properties": {"billing": {"type": "string"}, "shipping": {"type": "string"}}, "description": "Billing and Shipping address"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/order/{uuid}": {"get": {"tags": ["Orders"], "summary": "Fetch a order", "operationId": "orders-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "put": {"tags": ["Orders"], "summary": "Update an existing order", "operationId": "orders-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["order_status_uuid", "payment_uuid", "products", "address"], "properties": {"order_status_uuid": {"type": "string", "description": "Order status UUID"}, "payment_uuid": {"type": "string", "description": "Payment UUID"}, "products": {"type": "array", "items": {"type": "object", "properties": {"uuid": {"type": "string", "description": "Product UUID"}, "quantity": {"type": "integer", "description": "Product quantity"}}}, "description": "Array of objects with product uuid and quantity"}, "address": {"type": "object", "properties": {"billing": {"type": "string"}, "shipping": {"type": "string"}}, "description": "Billing and Shipping address"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Orders"], "summary": "delete an existing order", "operationId": "orders-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/order/{uuid}/download": {"get": {"tags": ["Orders"], "summary": "Download a order", "operationId": "orders-download", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/order-status/create": {"post": {"tags": ["Order Statuses"], "summary": "Create a new category", "operationId": "order-statuses-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Order status title"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/order-status/{uuid}": {"put": {"tags": ["Order Statuses"], "summary": "Update an existing category", "operationId": "order-statuses-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["title"], "properties": {"title": {"type": "string", "description": "Order status title"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Order Statuses"], "summary": "delete an existing category", "operationId": "order-statuses-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "get": {"tags": ["Order Statuses"], "summary": "Fetch a category", "operationId": "order-statuses-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/order-statuses": {"get": {"tags": ["Order Statuses"], "summary": "List all order statuses", "operationId": "order-statuses-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/payments": {"get": {"tags": ["Payments"], "summary": "List all payments", "operationId": "payments-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/payment/create": {"post": {"tags": ["Payments"], "summary": "Create a new payment", "operationId": "payments-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["type", "details"], "properties": {"type": {"type": "string", "enum": ["credit_card", "cash_on_delivery", "bank_transfer"], "description": "Payment type"}, "details": {"type": "object", "description": "Review documentation for the payment type JSON format"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/payment/{uuid}": {"get": {"tags": ["Payments"], "summary": "Fetch a payment", "operationId": "payments-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "put": {"tags": ["Payments"], "summary": "Update an existing payment", "operationId": "payments-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["type", "details"], "properties": {"type": {"type": "string", "enum": ["credit_card", "cash_on_delivery", "bank_transfer"], "description": "Payment type"}, "details": {"type": "object", "description": "Review documentation for the payment type JSON format"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Payments"], "summary": "delete an existing payment", "operationId": "payments-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/product/create": {"post": {"tags": ["Products"], "summary": "Create a new product", "operationId": "products-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["category_uuid", "title", "price", "description", "metadata"], "properties": {"category_uuid": {"type": "string", "description": "Category UUID"}, "title": {"type": "string", "description": "Product title"}, "price": {"type": "number", "description": "Product price"}, "description": {"type": "string", "description": "Product description"}, "metadata": {"type": "object", "properties": {"image": {"type": "string"}, "brand": {"type": "string"}}, "description": "Product metadata"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/product/{uuid}": {"put": {"tags": ["Products"], "summary": "Update an existing product", "operationId": "products-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["category_uuid", "title", "price", "description", "metadata"], "properties": {"category_uuid": {"type": "string", "description": "Category UUID"}, "title": {"type": "string", "description": "Product title"}, "price": {"type": "number", "description": "Product price"}, "description": {"type": "string", "description": "Product description"}, "metadata": {"type": "object", "properties": {"image": {"type": "string"}, "brand": {"type": "string"}}, "description": "Product metadata"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["Products"], "summary": "delete an existing product", "operationId": "products-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "get": {"tags": ["Products"], "summary": "Fetch a product", "operationId": "products-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/products": {"get": {"tags": ["Products"], "summary": "List all products", "operationId": "products-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}, {"name": "category", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "price", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "brand", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "title", "required": false, "in": "query", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/user": {"get": {"tags": ["User"], "summary": "View a User account", "operationId": "user-read", "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}, "delete": {"tags": ["User"], "summary": "Delete a User account", "operationId": "user-delete", "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/user/orders": {"get": {"tags": ["User"], "summary": "List all orders for the user", "operationId": "user-orders-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/user/edit": {"put": {"tags": ["User"], "summary": "Update a User account", "operationId": "user-update", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["first_name", "last_name", "email", "password", "password_confirmation", "address", "phone_number"], "properties": {"first_name": {"type": "string", "description": "User firstname"}, "last_name": {"type": "string", "description": "User lastname"}, "email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}, "password_confirmation": {"type": "string", "description": "User password"}, "avatar": {"type": "string", "description": "Avatar image UUID"}, "address": {"type": "string", "description": "User main address"}, "phone_number": {"type": "string", "description": "User main phone number"}, "is_marketing": {"type": "string", "description": "User marketing preferences"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/file/upload": {"post": {"tags": ["File"], "summary": "Upload a file", "operationId": "file-upload", "requestBody": {"required": true, "content": {"multipart/form-data": {"schema": {"required": ["file"], "properties": {"file": {"type": "string", "format": "binary", "description": "file to upload"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/file/{uuid}": {"get": {"tags": ["File"], "summary": "Read a file", "operationId": "file-read", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/admin/login": {"post": {"tags": ["Admin"], "summary": "Login an Admin account", "operationId": "admin-login", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["email", "password"], "properties": {"email": {"type": "string", "description": "Admin email"}, "password": {"type": "string", "description": "Admin password"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/admin/logout": {"get": {"tags": ["Admin"], "summary": "Logout an Admin account", "operationId": "admin-logout", "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/admin/create": {"post": {"tags": ["Admin"], "summary": "Create an Admin account", "operationId": "admin-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["first_name", "last_name", "email", "password", "password_confirmation", "avatar", "address", "phone_number"], "properties": {"first_name": {"type": "string", "description": "User firstname"}, "last_name": {"type": "string", "description": "User lastname"}, "email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}, "password_confirmation": {"type": "string", "description": "User password"}, "avatar": {"type": "string", "description": "Avatar image UUID"}, "address": {"type": "string", "description": "User main address"}, "phone_number": {"type": "string", "description": "User main phone number"}, "marketing": {"type": "string", "description": "User marketing preferences"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/admin/user-listing": {"get": {"tags": ["Admin"], "summary": "List all users", "operationId": "admin-user-listing", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}, {"name": "first_name", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "email", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "phone", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "address", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "created_at", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "marketing", "required": false, "in": "query", "schema": {"type": "string", "enum": ["0", "1"]}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/admin/user-edit/{uuid}": {"put": {"tags": ["Admin"], "summary": "Edit a User account", "operationId": "admin-user-edit", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["first_name", "last_name", "email", "password", "password_confirmation", "address", "phone_number"], "properties": {"first_name": {"type": "string", "description": "User firstname"}, "last_name": {"type": "string", "description": "User lastname"}, "email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}, "password_confirmation": {"type": "string", "description": "User password"}, "avatar": {"type": "string", "description": "Avatar image UUID"}, "address": {"type": "string", "description": "User main address"}, "phone_number": {"type": "string", "description": "User main phone number"}, "is_marketing": {"type": "string", "description": "User marketing preferences"}}, "type": "object"}}}}, "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/admin/user-delete/{uuid}": {"delete": {"tags": ["Admin"], "summary": "Delete a User account", "operationId": "admin-user-delete", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}}}, "/api/v1/user/login": {"post": {"tags": ["User"], "summary": "Login an User account", "operationId": "user-login", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["email", "password"], "properties": {"email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/user/logout": {"get": {"tags": ["User"], "summary": "Logout an User account", "operationId": "user-logout", "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/user/create": {"post": {"tags": ["User"], "summary": "Create a User account", "operationId": "user-create", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["first_name", "last_name", "email", "password", "password_confirmation", "address", "phone_number"], "properties": {"first_name": {"type": "string", "description": "User firstname"}, "last_name": {"type": "string", "description": "User lastname"}, "email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}, "password_confirmation": {"type": "string", "description": "User password"}, "avatar": {"type": "string", "description": "Avatar image UUID"}, "address": {"type": "string", "description": "User main address"}, "phone_number": {"type": "string", "description": "User main phone number"}, "is_marketing": {"type": "string", "description": "User marketing preferences"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/user/forgot-password": {"post": {"tags": ["User"], "summary": "Creates a token to reset a user password", "operationId": "user-forgot-pass", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["email"], "properties": {"email": {"type": "string", "description": "User email"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/user/reset-password-token": {"post": {"tags": ["User"], "summary": "Reset a user password with the a token", "operationId": "user-reset-pass-token", "requestBody": {"required": true, "content": {"application/x-www-form-urlencoded": {"schema": {"required": ["token", "email", "password", "password_confirmation"], "properties": {"token": {"type": "string", "description": "User reset token"}, "email": {"type": "string", "description": "User email"}, "password": {"type": "string", "description": "User password"}, "password_confirmation": {"type": "string", "description": "User password"}}, "type": "object"}}}}, "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/main/promotions": {"get": {"tags": ["MainPage"], "summary": "List all promotions", "operationId": "mainpage-promotions", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}, {"name": "valid", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/main/blog": {"get": {"tags": ["MainPage"], "summary": "List all posts", "operationId": "mainpage-posts", "parameters": [{"name": "page", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "limit", "required": false, "in": "query", "schema": {"type": "integer"}}, {"name": "sortBy", "required": false, "in": "query", "schema": {"type": "string"}}, {"name": "desc", "required": false, "in": "query", "schema": {"type": "boolean"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}, "/api/v1/main/blog/{uuid}": {"get": {"tags": ["MainPage"], "summary": "Fetch a post", "operationId": "mainpage-post", "parameters": [{"name": "uuid", "required": true, "in": "path", "schema": {"type": "string"}}], "responses": {"200": {"description": "OK"}, "401": {"description": "Unauthorized"}, "404": {"description": "Page not found"}, "422": {"description": "Unprocessable Entity"}, "500": {"description": "Internal server error"}}, "security": []}}}, "components": {"securitySchemes": {"bearerAuth": {"type": "http", "scheme": "bearer"}}}, "tags": [{"name": "Admin", "description": "Admin API endpoint"}, {"name": "User", "description": "User API endpoint"}, {"name": "MainPage", "description": "MainPage API endpoint"}, {"name": "Categories", "description": "Categories API endpoint"}, {"name": "Brands", "description": "Brands API endpoint"}, {"name": "Orders", "description": "Orders API endpoint"}, {"name": "Order Statuses", "description": "Order statuses API endpoint"}, {"name": "Payments", "description": "Payments API endpoint"}, {"name": "Products", "description": "Products API endpoint"}, {"name": "File", "description": "File API endpoint"}], "security": [{"bearerAuth": []}]};
    // Build a system
    const ui = SwaggerUIBundle({
      spec: spec,
      dom_id: '#swagger-ui',
      deepLinking: true,
      presets: [
        SwaggerUIBundle.presets.apis,
        SwaggerUIStandalonePreset
      ],
      plugins: [
        SwaggerUIBundle.plugins.DownloadUrl
      ],
      layout: "StandaloneLayout"
    })
    window.ui = ui
  }
  </script>
</body>
</html>
