# JCORE Kuva Kohde

A WordPress plugin that adds a focal point picker to the featured image of any post, and applies that focal point wherever the image is cropped: in core blocks and in Twig templates.

- **Requires WordPress:** 6.7
- **Tested up to:** 7.0
- **Requires PHP:** 8.2
- **License:** GPL-2.0-or-later

## What it does

### In the block editor

- A focal point picker for the featured image is shown in the post Summary panel for every post type that supports one.
- The **Post Featured Image** block and the **Cover** block get a "Use focal point" toggle, enabled by default.
- The **Image** block gets its own focal point picker when the cover style is selected.

### On the front end

The plugin filters `render_block` for three core blocks:

| Block | Behaviour |
| --- | --- |
| `core/post-featured-image` | Adds `object-fit: cover; object-position: X% Y%` to the image and the `has-focal-point` class to the figure. |
| `core/cover` | Uses the post focal point when the block shows the featured image and has no focal point of its own. |
| `core/image` | Applies the block's own focal point as `object-position`. |

### In Twig

The plugin registers a `kuva_kohde_focal_styles` function in Timber:

```twig
<img src="{{ post.thumbnail.src }}" style="{{ kuva_kohde_focal_styles(post) }}">
<div style="background-image: url({{ post.thumbnail.src }}); {{ kuva_kohde_focal_styles(post, { x: 0.5, y: 0.5 }, 'background') }}"></div>
```

| Argument | Default | Description |
| --- | --- | --- |
| `post` | | A post object or post ID. |
| `default` | `{ x: 0.5, y: 0.5 }` | Point used when the post has no focal point. |
| `type` | `'object-position'` | `object-position` (or `object`) and `background-position` (or `background`). |

It returns a single CSS declaration, for example `object-position: 30% 60%`.

### Data

The focal point is stored in the `jcore_focal_point` post meta as an object with `x` and `y` values between 0 and 1. The meta is registered for all post types and exposed through the REST API.

## Installation

```bash
composer require jcodigital/jcore-kuva-kohde
```

Or upload the release zip on the Plugins screen. Updates are delivered through the JCORE update service.

## Development

Editor scripts live in `scripts/` and are built with `@wordpress/scripts`:

```bash
cd scripts
pnpm install
pnpm build   # or pnpm start for a watcher
```

PHP coding standards:

```bash
composer install
vendor/bin/phpcs
```

## Releases

Releases are made with [foonver](https://github.com/foonly/foonver) from conventional commits. The version is synced to `jcore-kuva-kohde.php` and `readme.txt`, and the changelog is written to the `== Changelog ==` section of `readme.txt`. Do not edit that section by hand.

The full changelog is in [readme.txt](readme.txt).
