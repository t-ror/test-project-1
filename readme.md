# Test project

Test project including getting of product data from cache and saving of their view count.
- PHP 8.2
- Symfony 7.1

## Installation

First start docker container
```bash
make up
```

Enter docker container
```bash
make exec
```

Install packages with composer
```bash
composer install
```

## Commands
Start docker container
```bash
make up
```

Shutdown docker container
```bash
make down
```

Restart docker container
```bash
make restart
```

Enter to container
```bash
make exec
```

Clear cache
```bash
make rmcache
```

Run whole CI (code inspection) stack
```bash
make ci
```

CodeSniffer - checks codestyle and typehints
```bash
make cs
```

PhpStan - PHP Static Analysis
```bash
make phpstan
```