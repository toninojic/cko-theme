# CKO Theme Boilerplate

Modern WordPress theme boilerplate sa čistom podelom Page/Blog logike, modularnim CSS/JS i SR/EN osnovom.

## Ključne funkcionalnosti

- **Custom logo support** (WordPress standard).
- **Page sadržaj iz editora** za O nama / Underground / Kontakt.
- **Blog listing** samo kroz `home.php` / `archive.php`.
- **Shortcode** `[cko_latest_news]` sa 6 latest post kartica + **Load More (AJAX)**.
- **Automatska anchor navigacija** na stranicama `o-nama` i `underground` (na osnovu `h2` naslova u sadržaju).
- **SR/EN toggle** sa logikom povezivanja stranica.

## Template hijerarhija

- `front-page.php` => prikazuje sadržaj statične početne stranice (`the_content`).
- `page.php` => obične statične stranice (`the_content`).
- `home.php` + `archive.php` => blog/latest posts listing.
- `single.php` => pojedinačna vest/post.

## Kako koristiti logo

1. Idi u **Appearance → Customize → Site Identity**.
2. Uploadaj ili promeni logo u polju **Logo**.
3. Header automatski prikazuje custom logo, a ako nije setovan prikazuje ime sajta.

## Kako koristiti shortcode za najnovije vesti

U editoru stranice (npr. Vesti) ubaci:

```text
[cko_latest_news]
```

Opcioni parametar:

```text
[cko_latest_news posts_per_page="6"]
```

Shortcode prikazuje:
- featured image
- naslov
- excerpt
- link na ceo post
- Load More dugme (AJAX, bez reload-a cele stranice)

## Anchor navigacija (O nama / Underground)

- U sadržaju stranice koristi `h2` naslove za sekcije (npr. „Ko smo mi?“, „Naša misija“...).
- Tema automatski pravi internu navigaciju na vrhu sadržaja i linkuje ka tim sekcijama.
- Radi na slugovima: `o-nama`, `underground` (i EN varijantama sa `-en`).

## SR/EN povezivanje stranica

Preporučeni način:

1. Napravi SR i EN verziju stranice (npr. `o-nama` i `o-nama-en`).
2. U svakoj stranici dodaj custom field: `cko_alt_lang_page_id`.
3. Vrednost je ID odgovarajuće stranice na drugom jeziku.

Fallback logika:
- Ako custom field nije setovan, tema pokušava preko slug konvencije (`-en`).
- Ako ni to ne postoji, koristi `/english/` ili `/`.

## Gde se šta menja u administraciji

- **Pages**: O nama, Underground, Kontakt, English sadržaj.
- **Posts**: Vesti/blog postovi.
- **Settings → Reading**:
  - Homepage (front page)
  - Posts page (Vesti/blog)
- **Appearance → Menus**: glavni meni.
- **Appearance → Customize → Site Identity**: logo.
