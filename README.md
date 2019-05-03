# Muzirus

Source code of dictionary Muzirus.cz

[![Build Status Master](https://travis-ci.com/muzirus/muzirus.svg?branch=master)](https://travis-ci.com/muzirus/muzirus)

## Requirements

- [PHP 7.2+](https://launchpad.net/~ondrej/+archive/ubuntu/php)
- [Composer](https://getcomposer.org/download/)
- [Node](https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions)
- [Git](https://git-scm.com/download/linux)

## Installation

### Clone repository

```bash
git clone git@github.com:muzirus/muzirus.git muzirus
```

### Go to project folder

```bash
cd muzirus
```

### Install PHP dependencies

```bash
composer prod
```

## Dev server

Install PHP dependencies with dev dependencies

```bash
composer dev
```

Install JS dependencies from `package-lock.json` and build assets
 
```bash
npm ci
```

Build modified assets

```bash
npm run build
```

Start server

```bash
bin/console server:start
```

Restart server

```bash
bin/console server:restart
```

Stop server

```bash
bin/console server:stop
```

Get status of server

```bash
bin/console server:status
```
