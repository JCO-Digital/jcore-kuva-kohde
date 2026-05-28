.PHONY: all
all: install build

.PHONY: ci
ci: ci-install build

.PHONY: ci-install
ci-install: scripts-install
	composer install --no-dev

.PHONY: install
install: composer-install scripts-install

.PHONY: build
build: scripts-build

.PHONY: dev
dev: scripts-dev

.PHONY: composer-install
composer-install:
	composer install

.PHONY: scripts-install
scripts-install:
	corepack enable
	cd scripts && pnpm install

.PHONY: scripts-build
scripts-build:
	corepack enable
	cd scripts && pnpm run build

.PHONY: scripts-dev
scripts-dev:
	corepack enable
	cd scripts && pnpm run start

.PHONY: make-pot
make-pot:
	wp i18n make-pot . languages/jcore-kuva-kohde.pot

.PHONY: release
release:
	mkdir -p release
	zip release/jcore-kuva-kohde.zip -r * -x@.zipexclude
