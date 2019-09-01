# muzirus

Source code of Czech-to-Russian and Russian-to-Czech dictionary.

[![Build Status Master](https://travis-ci.com/muzirus/muzirus.svg?branch=master)](https://travis-ci.com/muzirus/muzirus)

**Thanks to [Travis-ci.com](https://travis-ci.com/) and [Sentry.io](https://sentry.io/welcome/) for free open-source plans of their services!**

## Requirements

Just [Docker](https://www.docker.com/) (`docker` and `docker-compose`), everything else should be inside docker containers.

## Installation

Clone repository

```bash
git clone git@github.com:muzirus/muzirus.git muzirus
```

Go to project folder

```bash
cd muzirus
```

Build docker containers

```bash
docker-compose build
```

Run docker containers

```bash
docker-compose up -d
```

Run `bush` in `muzirus_php` docker container

```bash
docker exec -it muzirus_php bash
```

Install PHP dependencies with dev dependencies inside `muzirus_php` docker container

```bash
composer dev
```

Install JS dependencies from `package-lock.json` to build assets inside `muzirus_php` docker container
 
```bash
npm ci
```

Build modified assets inside `muzirus_php` docker container

```bash
npm run build
```

Stop docker containers

```bash
docker-compose stop
```
