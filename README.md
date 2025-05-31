# WooCommerce Gift Message Plugin

## Overview

Adds a gift message (max 150 characters) field to WooCommerce product pages. It flows through cart, checkout, order, admin, and email views.

## Features

- Field on single product page (150 characters)
- Stored in cart and order item meta
- Displayed in:
  - Cart
  - Checkout
  - Thank You page
  - My Account → Orders
  - WooCommerce Admin → Orders
  - Order confirmation emails
- Admin list column
- Nonce validation for form security

## Folder Structure

- `includes/class-gift-message-handler.php`
- `assets/css/style.css`
- `assets/js/script.js`
- `wc-gift-message.php`

## To Do

- Add Message field to WooCommerce Admin → Orders
- Add filter for per-order messages
- Replace inline CSS with external
