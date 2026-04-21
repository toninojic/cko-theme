# CKO Theme Boilerplate

Modern WordPress theme boilerplate with MVC-inspired architecture and modular CSS/JS.

## File Structure

```
cko-theme/
├── assets/
│   ├── css/
│   │   ├── base.css
│   │   ├── layout.css
│   │   ├── components.css
│   │   └── pages.css
│   └── js/
│       └── theme.js
├── controllers/
├── models/
├── views/
│   └── page-templates/
├── functions.php
├── front-page.php
├── page.php
├── home.php
├── archive.php
└── single.php
```

## Template Logic (Page vs Blog)

- `front-page.php` renders **page content** (`the_content`) for your static homepage (e.g. **O nama**).
- `page.php` renders **page content** for normal static pages (Underground, Kontakt, etc.).
- `home.php` and `archive.php` render blog post listings (latest posts loop).
- `single.php` renders single blog posts.

This keeps static pages separate from blog logic.

## Language Toggle (SR / EN)

- Header includes an SR/EN toggle.
- Toggle supports manual mapping via page custom field:
  - `cko_alt_lang_page_id` = ID of translated counterpart page.
- If mapping is not set, fallback is:
  - SR page -> `/english/`
  - EN page -> `/`

## Content Management Guide

### O nama (front page)
1. Create/edit **O nama** in **Pages → All Pages**.
2. Add content with Gutenberg in page editor.
3. Set as homepage in **Settings → Reading → Your homepage displays → A static page**.

### Underground
1. Edit **Underground** in **Pages → All Pages**.
2. Content is taken from page editor (`the_content`).
3. No automatic latest-posts output on this page by default.

### Kontakt
1. Edit **Kontakt** in **Pages → All Pages**.
2. Content is taken from page editor (`the_content`).
3. No blog loop logic on this page.

### Blog / Vesti
1. Create/edit posts in **Posts → Add New**.
2. Set **Vesti** page as posts page in **Settings → Reading**.
3. Latest posts show only in blog templates (`home.php`, archives).

### English pages
1. Create English counterpart page in **Pages → Add New** (example: `english`, `about-en`, etc.).
2. In each SR/EN page, set custom field `cko_alt_lang_page_id` to the other page’s ID.
3. Header toggle will switch between mapped pages.

