# Listee

> Classified/directory listing website

| | |
|---|---|
| **Project type** | Marketplace / listing site |
| **Client / owner** | Own / practice (public repo) |
| **Repository** | `rifat-h/listee-app` (public) |
| **Last activity** | 2026-05-03 |
| **Keywords** | listing, directory, classifieds, breeze |

## About

Listing-site platform: users post listings with images in categories and locations, bookmark, message and review them; plans, blog, newsletter and contact pages plus an admin area. Laravel 13 + Breeze + Tailwind.

## Main features

- Listings, images, categories, locations, plans
- Bookmarks, comments, reviews, user-to-user messages
- Blog, newsletter, contact messages, admin

## Data models

`BlogPost`, `Bookmark`, `Category`, `Comment`, `ContactMessage`, `Listing`, `ListingImage`, `Location`, `Message`, `NewsletterSubscriber`, `Plan`, `Review`

## Tech stack

- **Backend:** Laravel 13.0 (PHP 8.3)
- **Frontend:** Blade views + Bootstrap + Vite
- **Database:** sqlite

## Getting started

```bash
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
```

---
*This README is a project card: it helps you find and recognise the project quickly. Keep the table at the top up to date when the project changes.*
