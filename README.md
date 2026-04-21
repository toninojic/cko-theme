# CKO Theme Boilerplate

Modern NGO/nonprofit-ready WordPress boilerplate sa modularnom arhitekturom, modernim UI/UX i fleksibilnim sadržajem.

## Šta je unapređeno

- **Modernizovan mobilni hamburger meni** (animacija u X, overlay panel, lock scroll, jasno close dugme).
- **Front page NGO struktura**: hero, impact blok, sadržaj sekcije, recent news, CTA band.
- **`[cko_latest_news]` shortcode**: 6 latest postova, profesionalne kartice, responsive grid (3/2/1), AJAX Load More.
- **Footer widget oblasti** (3 kolone) za tekst, linkove, kontakt i društvene mreže.
- **SR/EN toggle** sa mapiranjem preko `cko_alt_lang_page_id` + slug fallback.

## Front page struktura i sadržaj

`front-page.php` koristi `views/page-templates/front-page-ngo.php` i čita sledeće custom fields sa front page-a:

- `cko_hero_title`
- `cko_hero_text`
- `cko_hero_cta_text`
- `cko_hero_cta_url`
- `cko_impact_title`
- `cko_impact_items` (format po liniji: `broj|opis`, npr. `120+|Podržanih zajednica`)

Hero slika se uzima iz **Featured Image** front page-a.

## Kako koristiti shortcode za vesti

U editor ubaci:

```text
[cko_latest_news]
```

ili

```text
[cko_latest_news posts_per_page="6"]
```

Shortcode prikazuje kartice sa:
- featured image
- naslov
- excerpt
- link na ceo tekst
- Load More (AJAX)

## Anchor navigacija na O nama i Underground

Tema automatski generiše anchor navigaciju iz `h2` naslova unetih kroz editor stranice, za slugove:
- `o-nama`
- `underground`
- `o-nama-en`
- `underground-en`

## Footer widget zone (tekst, linkovi, social)

Idi na **Appearance → Widgets** i popuni:
- `Footer Column 1` (misija/opis)
- `Footer Column 2` (linkovi/meni)
- `Footer Column 3` (kontakt + društvene mreže)

Tu možeš dodati tekst, custom HTML, Navigation Menu widget, social linkove itd.

## SR / EN povezivanje stranica

Preporuka:
1. Napravi SR i EN varijante stranica.
2. U svakoj dodaj custom field `cko_alt_lang_page_id` sa ID-jem suprotne verzije.

Ako nije postavljeno ručno, tema pokušava slug fallback (`-en`).

## Gde kasnije menjaš sadržaj

- **Pages**: hero tekst, sekcije, O nama, Underground, Kontakt, English.
- **Posts**: vesti/blog.
- **Appearance → Menus**: glavni meni (desktop + mobile koriste isti WP meni).
- **Appearance → Widgets**: footer sadržaj (misija, linkovi, social).
- **Appearance → Customize → Site Identity**: logo.
- **Settings → Reading**: front page i posts page.
