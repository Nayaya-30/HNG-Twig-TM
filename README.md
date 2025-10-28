This folder contains a Twig/Symfony-compatible scaffold that mirrors the React `app/` UI
and Tailwind styling. It is a static scaffold and intentionally minimal so you can
finish the Symfony install locally.

What I added

-   `templates/` — Twig templates that replicate the React pages (home, login, signup, dashboard, tickets)
-   `assets/css/styles.css` — Tailwind entry with the app's global CSS
-   `tailwind.config.js`, `postcss.config.cjs`, `package.json` — build scripts for Tailwind

How to finish setup (run locally)

1. Install PHP and Composer, then create a Symfony skeleton (recommended):
   composer create-project symfony/skeleton .
2. Require web and twig packages:
   composer require symfony/webapp-pack twig
3. Place the `templates/` folder into your project and `public/` will serve `public/build/styles.css` after building assets.
4. Install Node.js, then run:
   npm install
   npm run build:css

Notes

-   The PHP controllers/routing are not created here — you'll want to add simple controllers that render the twig templates (I can add them if you want me to run Composer locally, but Composer must be run on your machine).
-   This scaffold focuses on pixel parity (Tailwind classes and markup). JS behaviors (dark mode toggle, toasts) are planned as small vanilla scripts under `public/` if you want them.

If you want, I can continue and add Symfony controllers and route config files as placeholders (they will require you to run Composer to enable and autoload). Let me know and I can generate those files next.
# HNG-Twig-TM
