=== JCORE Kuva Kohde ===
Contributors: jcodigital
Tags: focal point, images, featured image, cover, block editor
Requires at least: 6.7
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 1.2.13
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Pick a focal point for the featured image of any post, and have core blocks and Twig templates crop around it.

== Description ==

JCORE Kuva Kohde adds a focal point picker to the featured image panel in the block editor. The chosen point is stored as post meta and used wherever the featured image is cropped, so the important part of the image stays visible at every aspect ratio.

**In the editor**

* A focal point picker for the featured image appears in the post Summary panel for every post type.
* The Post Featured Image block and the Cover block get a "Use focal point" toggle, enabled by default.
* The Image block gets a focal point picker when it uses the cover style.

**On the front end**

* The Post Featured Image block is rendered with `object-fit: cover` and an `object-position` matching the focal point, and its figure gets the `has-focal-point` class.
* The Cover block uses the focal point when it shows the featured image and has no focal point of its own.
* The Image block applies its own focal point as `object-position` when one has been picked.

**In Twig**

The plugin registers the `kuva_kohde_focal_styles` function in Timber:

`<img src="{{ post.thumbnail.src }}" style="{{ kuva_kohde_focal_styles(post) }}">`

It takes the post or a post ID, an optional default point (`{ x: 0.5, y: 0.5 }`), and an optional type of `object-position` (default) or `background-position`. It returns a CSS declaration such as `object-position: 30% 60%`.

**Meta**

The focal point is stored in the `jcore_focal_point` post meta as an object with `x` and `y` values between 0 and 1, and is exposed through the REST API.

== Installation ==

1. Install the plugin through Composer with `composer require jcodigital/jcore-kuva-kohde`, or upload the release zip on the Plugins screen.
2. Activate the plugin.
3. Open a post, set a featured image and pick the focal point in the Summary panel of the post sidebar.

Updates are delivered through the JCORE update service.

== Frequently Asked Questions ==

= Which post types get the focal point picker? =

All post types that support a featured image.

= Can I turn the focal point off for a single block? =

Yes. The Post Featured Image block and the Cover block have a "Use focal point" toggle in their block settings.

= Why does the Cover block ignore the focal point? =

The Cover block only uses the post focal point when it is set to use the featured image and has no focal point of its own. If you picked a focal point in the block, that one wins.

== Changelog ==

= 1.2.13 (2026-09-29) =

* Fix: ci - Fix for unscoped dist

= v1.2.12 (2026-09-29) =

* CI: Update workflow configuration and version sync

= v1.2.11 (2026-09-29) =

* Documentation: readme - rewrite readme.txt, add README.md and foonver changelog config
* Build: deps - update jcore-update to 1.7.0
* CI: github - Update foonver action configuration

= v1.2.10 (2026-06-01) =

* Maintenance: ignore version.json in distribution builds

= v1.2.9 (2026-06-01) =

* CI: github - upgrade foonver to v0.13.3
* Maintenance: ignore vendor directory in distribution builds

= v1.2.8 (2026-06-01) =

* Maintenance: scripts - remove build artifacts and update ignores

= v1.2.7 (2026-06-01) =

* Refactor: namespace - rename namespace from Jcore\FocalPoint to Jcore\KuvaKohde

= v1.2.6 (2026-06-01) =

* CI: github - remove unused build input from publish workflow

= v1.2.5 (2026-06-01) =

* Maintenance: deps - remove ydin dependency and update build ignore rules
* Maintenance: repo - update configuration and CI workflow

= v1.2.4 (2026-05-28) =

* Maintenance: metadata - update plugin requirements and compatibility versions

= v1.2.3 (2026-05-28) =

* Refactor: namespace - rename plugin namespace from FocalPoint to KuvaKohde

= v1.2.2 (2026-05-28) =

* Build: deps - remove automattic/jetpack-autoloader

= v1.2.1 (2026-05-28) =

* Build: deps - update jcore-update and integrate plugin update hooks

= v1.2.0 (2026-05-28) =

* Feature: ci - implement release automation and publishing pipeline
* CI: github - update foonver version and add protected branch push step
* CI: github - update version sync target in workflow
* CI: github - add php environment to build workflow

= v1.1.0 (2025-11-19) =

* Feature: twig - add post_focal_styles function to retrieve focal styles for posts

= v1.0.1 (2025-11-17) =

* Fix: dependencies - update jcore/ydin version constraint in composer.json and update related packages in composer.lock

= v1.0.0 (2025-11-17) =

* Feature: focal-point - add focal point functionality to core image block if cover style is selected
* Feature: update to use latest ydin version and latest conventional-commit-action version (BREAKING CHANGE)

= v0.3.1 (2025-06-11) =

* Fix: focal-point - hooks cannot be run after conditions 🐛

= v0.3.0 (2025-06-04) =

* Feature: focal-point - focal point is now shown for all post types. ✨

= v0.2.1 (2025-05-27) =

* Fix: repo - update composer as well
* Fix: update package name from jcore/kohde-kuva to jcore/kuva-kohde

= v0.2.0 (2025-05-27) =

* Feature: focal-point - Focal point works and adds the focal point styles :sparkles:
* Maintenance: initial commit
