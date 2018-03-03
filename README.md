# Dictionary

## Requirements

- [PHP 7.1+](https://launchpad.net/~ondrej/+archive/ubuntu/php)
- [Composer](https://getcomposer.org/download/)
- [Node](https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions)
- [Yarn](https://yarnpkg.com/en/docs/install#linux-tab)
- [Git](https://git-scm.com/download/linux)

## Installation

### Clone repository

```bash
git clone git@github.com:petrofcikmatus/dictionary.git dictionary
```

### Go to project folder

```bash
cd dictionary
```

### Install PHP dependencies

```bash
composer install
```

### Install JS dependencies

```bash
yarn install
```

## Dev server

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
