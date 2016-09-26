# TtskchRayDiBundle

[![Build Status](https://travis-ci.org/ttskch/TtskchRayDiBundle.svg?branch=master)](https://travis-ci.org/ttskch/TtskchRayDiBundle)
[![Latest Stable Version](https://poser.pugx.org/ttskch/ray-di-bundle/version)](https://packagist.org/packages/ttskch/ray-di-bundle)
[![Total Downloads](https://poser.pugx.org/ttskch/ray-di-bundle/downloads)](https://packagist.org/packages/ttskch/ray-di-bundle)

Integration of [Ray.Di](https://github.com/ray-di/Ray.Di) into Symfony.

## Getting started

#### 1. Composer-require

```bash
$ composer require ttskch/ray-di-bundle
```

#### 2. Register with AppKernel

```php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Ttskch\RayDiBundle\TtskchRayDiBundle(),
        ];
        // ...
    }
    // ...
}
```

#### 3. Configure via config.yml

```yml
# app/config/config.yml

tch_ray_di:
    module_class: 'Foo\BarModule'   # FQCN of your main Ray.Di `module`
```

## Usage

When you configure your `module`...

```php
class AppModule extends AbstractModule
{
    public function configure()
    {
        $this->bind(SomeServiceInterface::class)->to(SomeServiceConcrete::class);
    }
}
```

Then you can get `injector` from Symfony container like as below:

```php
class SomeController extends Controller
{
    public function indexAction()
    {
        /** @var \Ray\Di\Injector $injector */
        $injector = $this->get('tch_ray_di.injector');

        $someService = $injector->getInstance(SomeServiceInterface::class);

        return new Response($someService->someMethod());
    }
}
```
