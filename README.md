# CKO Theme Boilerplate

Modern WordPress theme boilerplate with MVC-inspired architecture and modular CSS.

## File Structure

```
cko-theme/
├── assets/
│   └── css/
│       ├── base.css
│       ├── layout.css
│       ├── components.css
│       └── pages.css
├── controllers/
│   ├── front-page-controller.php
│   ├── page-controller.php
│   └── blog-controller.php
├── models/
│   ├── theme-support.php
│   ├── theme-assets.php
│   └── theme-helpers.php
├── views/
│   └── page-templates/
│       ├── about-page.php
│       ├── default-page.php
│       ├── contact-page.php
│       ├── post-listing.php
│       └── underground-page.php
├── functions.php
├── front-page.php
├── home.php
├── index.php
├── page.php
├── single.php
├── archive.php
├── template-kontakt.php
├── template-underground.php
└── template-english.php
```

## Architecture

- **models/**: reusable data providers, setup, and querying logic.
- **controllers/**: route template behavior and decide which view to render.
- **views/**: presentation markup with minimal logic.

## Content Management Guide

### 1) Home / O nama sections
- Set page **O nama** as your static homepage in **Settings → Reading**.
- Edit the page content in **Pages → O nama**.
- Sections use anchors and are sourced by slug (e.g. `ko-smo-mi`, `nasa-misija`, etc.).
- Create pages with those slugs in **Pages → Add New** to manage each section independently.

### 2) Vesti (Blog)
- Create page **Vesti** and set it as posts page in **Settings → Reading**.
- Add posts from **Posts → Add New**.
- Categories are managed in **Posts → Categories**.

### 3) Underground
- Create page **Underground** and optionally assign template **Underground**.
- The section config is in `models/theme-helpers.php` (`cko_get_underground_sections`).
- Post sections auto-pull latest posts.
- Static section (`O nama`) content is read from page custom field: `underground-o-nama_content`.

### 4) Kontaktiraj nas
- Create page **Kontaktiraj nas** and assign template **Kontaktiraj nas**.
- Add content in the editor now; later attach form plugin shortcode/block.

### 5) English page
- Create page **English** and assign template **English Page**.
- Uses the same about-page view with EN section labels.

## Gutenberg vs ACF

- **Start with Gutenberg** for all normal page and post content.
- Use **custom fields (native)** only for simple structured values (like the Underground static section).
- Add **ACF** later when you need repeaters/flexible content or editor-friendly structured fields.


## Design System Updates

- Centralized color tokens in `assets/css/base.css`:
  - `--primary-color: #8a6edd`
  - `--secondary-color: #f3ebdd`
  - `--accent-color: #472e57`
- Mobile navigation now uses animated hamburger button + off-canvas drawer + overlay.
- Added scroll reveal and subtle hover/microinteraction transitions for modern UX.
