# Changelog

All notable changes to Magelan_CategoryFaq.

## 1.0.2 - 2026-10-15
- Release notes for the module page.

## 1.0.1 - 2026-10-02

- Hyvä support in the module itself: `hyva/category_faq.phtml` with native `<details>` elements (no JavaScript, keyboard accessible, one answer open at a time where the browser supports it) and the same FAQPage markup. On Hyvä the answers used to stay closed because the Luma script needs RequireJS. Luma is unchanged.
- The module registers itself for the Hyvä Tailwind build (`hyva_config_generate_before`; `view/frontend/tailwind/module.css` for Tailwind 4, `tailwind.config.js` for Tailwind 3). No Hyvä package is required.
- WYSIWYG editor for the answers in the category form (data patch), Slovenian translation, `en_US.csv`, LICENSE.

## 1.0.0

- First release.
