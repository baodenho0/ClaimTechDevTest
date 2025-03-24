# ClaimTech Developer Test

## Installation Guide

### Requirements

-   PHP: ^8.2
-   Laravel Framework: ^12.0

### Setup

```bash
   git clone https://github.com/baodenho0/ClaimTechDevTest.git
   cd ClaimTechDevTest
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan serve
```

### API

-   post: /api/login
-   post: /api/register
-   post: /api/users/upload
-   post: /api/claims
-   get: /api/claims

## Backend Completion

I have fully built 5 API endpoints for the backend.

### Challenges Faced

I’m a backend developer specializing in PHP Laravel, so working with Vue 3 + Zod without AI assistance was quite challenging. Because of that, the frontend is not included in this source.

I’ve attached ClaimTech.postman_collection.json so you can easily import it into Postman and test the APIs. Hope you understand!
