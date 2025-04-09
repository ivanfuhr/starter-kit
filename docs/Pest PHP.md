# Pest PHP

## Índice

- [Announcing Pest2](#announcing-pest2)

- [Announcing Stressless](#announcing-stressless)

- [Arch Testing](#arch-testing)

- [Cli Api Reference](#cli-api-reference)

- [Community Guide](#community-guide)

- [Configuring Tests](#configuring-tests)

- [Continuous Integration](#continuous-integration)

- [Creating Plugins](#creating-plugins)

- [Custom Expectations](#custom-expectations)

- [Custom Helpers](#custom-helpers)

- [Datasets](#datasets)

- [Editor Setup](#editor-setup)

- [Exceptions](#exceptions)

- [Expectations](#expectations)

- [Filtering Tests](#filtering-tests)

- [Global Hooks](#global-hooks)

- [Grouping Tests](#grouping-tests)

- [Higher Order Testing](#higher-order-testing)

- [Hooks](#hooks)

- [Installation](#installation)

- [Migrating From Phpunit Guide](#migrating-from-phpunit-guide)

- [Mocking](#mocking)

- [Mutation Testing](#mutation-testing)

- [Optimizing Tests](#optimizing-tests)

- [Pest Spicy Summer Release](#pest-spicy-summer-release)

- [Pest3 Now Available](#pest3-now-available)

- [Plugins](#plugins)

- [Skipping Tests](#skipping-tests)

- [Snapshot Testing](#snapshot-testing)

- [Stress Testing](#stress-testing)

- [Support Policy](#support-policy)

- [Team Management](#team-management)

- [Test Coverage](#test-coverage)

- [Test Dependencies](#test-dependencies)

- [Type Coverage](#type-coverage)

- [Upgrade Guide](#upgrade-guide)

- [Video Resources](#video-resources)

- [Why Pest](#why-pest)

- [Writing Tests](#writing-tests)

## Announcing Pest2

[Edit this page →](https://github.com/pestphp/docs/edit/master/announcing-pest2.md)

[#](#content-announcing-pest-20 "Permalink")Announcing Pest 2.0
===============================================================

The Pest team is thrilled to unveil the release of Pest 2.0 after a development period of 18 months and over 500 commits. This release introduces several exciting features that promise to improve the user's experience. Among the notable enhancements are robust new plugins, refined syntax, and advanced options that streamline testing, enhance usability, and boost productivity.

Today we’re finally making the long-awaited release of Pest 2.0! Our creator is eager to showcase the exciting new features this version has to offer. Tune in to the video below to learn more.

Pest 2.0 marks a major milestone in our development, packed with an array of powerful features such as:

*   **[Powerful Architecture Plugin](/docs/arch-testing)**, for testing the architectural rules of your application with ease
*   **[Up To 80% Speed Improvements on "--parallel" testing](/docs/optimizing-tests#parallel)**, with our fully rewritten parallel core, enjoy significantly faster test runs
*   **[\--profile option](/docs/optimizing-tests#content-profiling)**, to identify the slowest tests and optimize their execution
*   **[\--compact printer](/docs/optimizing-tests#content-compact-printer)**, a minimal printer that only outputs information about test failures
*   **[\--retry option](/docs/filtering-tests#retry)**, for saving time by running only previously unsuccessful tests
*   **[\--dirty option](/docs/filtering-tests#dirty)**, for only running tests with uncommitted changes
*   **[\--bail option](/docs/filtering-tests#bail)**, to immediately terminate the test suite upon encountering an error or failure.
*   **[todo()](/docs/skipping-tests#content-creating-todos)** method, for creating todos within your test suite
*   **[Expectation Interceptors and Pipes](/docs/custom-expectations#content-intercept-expectations)**, allowing you to tailor your expectations to fit your specific testing needs
*   **[Scoped Datasets](/docs/datasets#content-scoped-datasets)**, for creating datasets that pertain only to a specific feature or set of folders

In addition to the features detailed above, there's so much more to explore with Pest 2.0! **Our website has been completely revamped**, with fresh documentation and a more user-friendly interface. There's never been a better time to dive in and start exploring.

If you're ready to get started with Pest 2.0 right away, check out our [installation guide](/docs/installation) for step-by-step instructions. And if you're currently using Pest 1, we've got you covered with detailed upgrade instructions in our [upgrade guide](/docs/upgrade-guide).

* * *

Thank you for reading about Pest 2.0's new features! If you're considering a testing framework for your next project, here's why you should give Pest a try: [Why Pest →](/docs/why-pest)

---

## Announcing Stressless

[Edit this page →](https://github.com/pestphp/docs/edit/master/announcing-stressless.md)

[#](#content-announcing-stressless "Permalink")Announcing Stressless
====================================================================

We are thrilled to announce the release of a brand new plugin for Pest PHP: **[Stressless](/docs/stress-testing)**.

It's a fresh new addition to the Pest PHP family, and it brings the power of stress testing to the PHP ecosystem. It integrates seamlessly with Pest PHP, combining the power of stress testing with the simplicity and elegance of Pest's Expectation API.

Check out this YouTube video where we walk you through the installation and setup of the Stressless plugin:

As you can see, it's effortless to get started with Stressless — all you need to do is require the package using Composer, and you're ready to go!

There are two main ways to use Stressless. You may use it to quickly stress test your application from the command line:

    1./vendor/bin/pest stress example.com --concurrency=5 --duration=10

Or you can use it to write stress tests in your Pest PHP test files:

     1<?php 2  3test('black friday', function () { 4    $result = stress('example.com') 5        ->concurrently(5) 6        ->for(10)->seconds(); 7  8    $requests = $result->requests; 9 10    expect($requests->failed->count)11        ->toBe(0);12 13    expect($requests->duration->med)14        ->toBeLessThan(100.0); // 100ms15});

Check our documentation to get started with Stress Testing / Stressless: **[Stress Testing →](/docs/stress-testing)**. We hope you enjoy this new addition to the Pest PHP family!

* * *

If you're considering a testing framework for your next project, here's why you should give Pest a try: [Why Pest →](/docs/why-pest)

---

## Arch Testing

[Edit this page →](https://github.com/pestphp/docs/edit/master/arch-testing.md)

[#](#content-architecture-testing "Permalink")Architecture Testing
==================================================================

Architecture testing enables you to specify expectations that test whether your application adheres to a set of architectural rules, helping you maintain a clean and sustainable codebase. The expectations are determined by either relative namespaces, fully qualified namespaces, or function names.

Here is an example of how you can define an architectural rule:

     1arch() 2    ->expect('App') 3    ->toUseStrictTypes() 4    ->not->toUse(['die', 'dd', 'dump']); 5  6arch() 7    ->expect('App\Models') 8    ->toBeClasses() 9    ->toExtend('Illuminate\Database\Eloquent\Model')10    ->toOnlyBeUsedIn('App\Repositories')11    ->ignoring('App\Models\User');12 13arch()14    ->expect('App\Http')15    ->toOnlyBeUsedIn('App\Http');16 17arch()18    ->expect('App\*\Traits')19    ->toBeTraits();20 21arch()->preset()->php();22arch()->preset()->security()->ignoring('md5');

Now, let's dive into the various methods and modifiers available for architectural testing. In this section, you will learn:

*   [Expectations](#expectations): Allows to specify granular architectural rules.
*   [Presets](#presets): Allows to use predefined sets of granular architectural rules.
*   [Modifiers](#modifiers): To exclude or ignore certain types of files, classes, functions or lines of code.

[#](#content-expectations "Permalink")Expectations
--------------------------------------------------

Granular expectations allow you to define specific architectural rules for your application. Here are the available expectations:

*   [`toBeAbstract()`](#expect-toBeAbstract)
*   [`toBeClasses()`](#expect-toBeClasses)
*   [`toBeEnums()`](#expect-toBeEnums)
*   [`toBeIntBackedEnums()`](#expect-toBeIntBackedEnums)
*   [`toBeInterfaces()`](#expect-toBeInterfaces)
*   [`toBeInvokable()`](#expect-toBeInvokable)
*   [`toBeFinal()`](#expect-toBeFinal)
*   [`toBeReadonly()`](#expect-toBeReadonly)
*   [`toBeStringBackedEnums()`](#expect-toBeStringBackedEnums)
*   [`toBeTraits()`](#expect-toBeTraits)
*   [`toBeUsed()`](#expect-toBeUsed)
*   [`toBeUsedIn()`](#expect-toBeUsedIn)
*   [`toExtend()`](#expect-toExtend)
*   [`toExtendNothing()`](#expect-toExtendNothing)
*   [`toImplement()`](#expect-toImplement)
*   [`toImplementNothing()`](#expect-toImplementNothing)
*   [`toHaveMethodsDocumented()`](#expect-toHaveMethodsDocumented)
*   [`toHavePropertiesDocumented()`](#expect-toHavePropertiesDocumented)
*   [`toHaveAttribute()`](#expect-toHaveAttribute)
*   [`toHaveFileSystemPermissions()`](#expect-toHaveFileSystemPermissions)
*   [`toHaveLineCountLessThan()`](#expect-toHaveLineCountLessThan)
*   [`toHaveMethod()`](#expect-toHaveMethod)
*   [`toHaveMethods()`](#expect-toHaveMethod)
*   [`toHavePrivateMethodsBesides()`](#expect-toHavePrivateMethodsBesides)
*   [`toHavePrivateMethods()`](#expect-toHavePrivateMethods)
*   [`toHaveProtectedMethodsBesides()`](#expect-toHaveProtectedMethodsBesides)
*   [`toHaveProtectedMethods()`](#expect-toHaveProtectedMethods)
*   [`toHavePublicMethodsBesides()`](#expect-toHavePublicMethodsBesides)
*   [`toHavePublicMethods()`](#expect-toHavePublicMethods)
*   [`toHavePrefix()`](#expect-toHavePrefix)
*   [`toHaveSuffix()`](#expect-toHaveSuffix)
*   [`toHaveConstructor()`](#expect-toHaveConstructor)
*   [`toHaveDestructor()`](#expect-toHaveDestructor)
*   [`toOnlyImplement()`](#expect-toOnlyImplement)
*   [`toOnlyUse()`](#expect-toOnlyUse)
*   [`toOnlyBeUsedIn()`](#expect-toOnlyBeUsedIn)
*   [`toUse()`](#expect-toUse)
*   [`toUseStrictEquality()`](#expect-toUseStrictEquality)
*   [`toUseTrait()`](#expect-toUseTrait)
*   [`toUseTraits()`](#expect-toUseTraits)
*   [`toUseNothing()`](#expect-toUseNothing)
*   [`toUseStrictTypes()`](#expect-toUseStrictTypes)

### [#](#content-tobeabstract "Permalink")`toBeAbstract()`

The `toBeAbstract()` method may be used to ensure that all classes within a given namespace are abstract.

    1arch('app')2    ->expect('App\Models')3    ->toBeAbstract();

### [#](#content-tobeclasses "Permalink")`toBeClasses()`

The `toBeClasses()` method may be used to ensure that all files within a given namespace are classes.

    1arch('app')2    ->expect('App\Models')3    ->toBeClasses();

### [#](#content-tobeenums "Permalink")`toBeEnums()`

The `toBeEnums()` method may be used to ensure that all files within a given namespace are enums.

    1arch('app')2    ->expect('App\Enums')3    ->toBeEnums();

### [#](#content-tobeintbackedenums "Permalink")`toBeIntBackedEnums()`

The `toBeIntBackedEnums()` method may be used to ensure that all enums within a specified namespace are int-backed.

    1arch('app')2    ->expect('App\Enums')3    ->toBeIntBackedEnums();

### [#](#content-tobeinterfaces "Permalink")`toBeInterfaces()`

The `toBeInterfaces()` method may be used to ensure that all files within a given namespace are interfaces.

    1arch('app')2    ->expect('App\Contracts')3    ->toBeInterfaces();

### [#](#content-tobeinvokable "Permalink")`toBeInvokable()`

The `toBeInvokable()` method may be used to ensure that all files within a given namespace are invokable.

    1arch('app')2    ->expect('App\Actions')3    ->toBeInvokable();

### [#](#content-tobetraits "Permalink")`toBeTraits()`

The `toBeTraits()` method may be used to ensure that all files within a given namespace are traits.

    1arch('app')2    ->expect('App\Concerns')3    ->toBeTraits();

### [#](#content-tobefinal "Permalink")`toBeFinal()`

The `toBeFinal()` method may be used to ensure that all classes within a given namespace are final.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toBeFinal();

Note that, typically this expectation is used in combination with the `classes()` modifier to ensure that all classes within a given namespace are final.

    1arch('app')2    ->expect('App')3    ->classes()4    ->toBeFinal();

### [#](#content-tobereadonly "Permalink")`toBeReadonly()`

The `toBeReadonly()` method may be used to ensure that certain classes are immutable and cannot be modified at runtime.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toBeReadonly();

Note that, typically this expectation is used in combination with the `classes()` modifier to ensure that all classes within a given namespace are readonly.

    1arch('app')2    ->expect('App')3    ->classes()4    ->toBeReadonly();

### [#](#content-tobestringbackedenums "Permalink")`toBeStringBackedEnums()`

The `toBeStringBackedEnums()` method may be used to ensure that all enums within a specified namespace are string-backed.

    1arch('app')2    ->expect('App\Enums')3    ->toBeStringBackedEnums();

### [#](#content-tobeused "Permalink")`toBeUsed()`

The `not` modifier, when combined with the `toBeUsed()` method, enables you to verify that certain classes or functions are not being utilized by your application.

    1arch('globals')2    ->expect(['dd', 'dump'])3    ->not->toBeUsed();4 5arch('facades')6    ->expect('Illuminate\Support\Facades')7    ->not->toBeUsed();

### [#](#content-tobeusedin "Permalink")`toBeUsedIn()`

By combining the `not` modifier with the `toBeUsedIn()` method, you can restrict specific classes and functions from being used within a given namespace.

    1arch('globals')2    ->expect('request')3    ->not->toBeUsedIn('App\Domain');4 5arch('globals')6    ->expect('Illuminate\Http')7    ->not->toBeUsedIn('App\Domain');

### [#](#content-toextend "Permalink")`toExtend()`

The `toExtend()` method may be used to ensure that all classes within a given namespace extend a specific class.

    1arch('app')2    ->expect('App\Models')3    ->toExtend('Illuminate\Database\Eloquent\Model');

### [#](#content-toextendnothing "Permalink")`toExtendNothing()`

The `toExtendNothing()` method may be used to ensure that all classes within a given namespace do not extend any class.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toExtendNothing();

### [#](#content-toimplement "Permalink")`toImplement()`

The `toImplement()` method may be used to ensure that all classes within a given namespace implement a specific interface.

    1arch('app')2    ->expect('App\Jobs')3    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');

### [#](#content-toimplementnothing "Permalink")`toImplementNothing()`

The `toImplementNothing()` method may be used to ensure that all classes within a given namespace do not implement any interface.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toImplementNothing();

### [#](#content-tohavemethodsdocumented "Permalink")`toHaveMethodsDocumented()`

The `toHaveMethodsDocumented()` method may be used to ensure that all methods within a given namespace are documented.

    1arch('app')2    ->expect('App')3    ->toHaveMethodsDocumented();

### [#](#content-tohavepropertiesdocumented "Permalink")`toHavePropertiesDocumented()`

The `toHavePropertiesDocumented()` method may be used to ensure that all properties within a given namespace are documented.

    1arch('app')2    ->expect('App')3    ->toHavePropertiesDocumented();

### [#](#content-tohaveattribute "Permalink")`toHaveAttribute()`

The `toHaveAttribute()` method may be used to ensure that a certain class has a specific attribute.

    1arch('app')2    ->expect('App\Console\Commands')3    ->toHaveAttribute('Symfony\Component\Console\Attribute\AsCommand');

### [#](#content-tohavefilesystempermissions "Permalink")`toHaveFileSystemPermissions()`

The `toHaveFileSystemPermissions()` method may be used to ensure that all files within a given namespace have specific file system permissions.

    1arch('app')2    ->expect('App')3    ->not->toHaveFileSystemPermissions('0777');

### [#](#content-tohavelinecountlessthan "Permalink")`toHaveLineCountLessThan()`

The `toHaveLineCountLessThan()` method may be used to ensure that all files within a given namespace have a line count less than a specified value.

    1arch('app')2    ->expect('App\Models')3    ->toHaveLineCountLessThan(100);

### [#](#content-tohavemethod "Permalink")`toHaveMethod()`

The `toHaveMethod()` method may be used to ensure that a certain class has a specific method.

    1arch('app')2    ->expect('App\Http\Controllers\HomeController')3    ->toHaveMethod('index');

### [#](#content-tohavemethods "Permalink")`toHaveMethods()`

The `toHaveMethods()` method may be used to ensure that a certain class has specific methods.

    1arch('app')2    ->expect('App\Http\Controllers\HomeController')3    ->toHaveMethods(['index', 'show']);

### [#](#content-tohaveprivatemethodsbesides "Permalink")`toHavePrivateMethodsBesides()`

The `toHavePrivateMethodsBesides()` method may be used to ensure that a certain class does not have any private methods besides the specified ones.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHavePrivateMethodsBesides(['doPayment']);

### [#](#content-tohaveprivatemethods "Permalink")`toHavePrivateMethods()`

The `toHavePrivateMethods()` method may be used to ensure that a certain class does not have any private methods.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHavePrivateMethods();

### [#](#content-tohaveprotectedmethodsbesides "Permalink")`toHaveProtectedMethodsBesides()`

The `toHaveProtectedMethodsBesides()` method may be used to ensure that a certain class does not have any protected methods besides the specified ones.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHaveProtectedMethodsBesides(['doPayment']);

### [#](#content-tohaveprotectedmethods "Permalink")`toHaveProtectedMethods()`

The `toHaveProtectedMethods()` method may be used to ensure that a certain class does not have any protected methods.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHaveProtectedMethods();

### [#](#content-tohavepublicmethodsbesides "Permalink")`toHavePublicMethodsBesides()`

The `toHavePublicMethodsBesides()` method may be used to ensure that a certain class does not have any public methods besides the specified ones.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHavePublicMethodsBesides(['charge', 'refund']);

### [#](#content-tohavepublicmethods "Permalink")`toHavePublicMethods()`

The `toHavePublicMethods()` method may be used to ensure that a certain class does not have any public methods.

    1arch('app')2    ->expect('App\Services\PaymentService')3    ->not->toHavePublicMethods();

### [#](#content-tohaveprefix "Permalink")`toHavePrefix()`

The `toHavePrefix()` method may be used to ensure that all files within a given namespace have a specific prefix.

    1arch('app')2    ->expect('App\Helpers')3    ->not->toHavePrefix('Helper');

### [#](#content-tohavesuffix "Permalink")`toHaveSuffix()`

The `toHaveSuffix()` method may be used to ensure that all files within a given namespace have a specific suffix.

    1arch('app')2    ->expect('App\Http\Controllers')3    ->toHaveSuffix('Controller');

### [#](#content-tohaveconstructor "Permalink")`toHaveConstructor()`

This `toHaveConstructor()` method may be used to ensure that all files within a given namespace have a `__construct` method.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toHaveConstructor();

### [#](#content-tohavedestructor "Permalink")`toHaveDestructor()`

This `toHaveDestructor()` method may be used to ensure that all files within a given namespace have a `__destruct` method.

    1arch('app')2    ->expect('App\ValueObjects')3    ->toHaveDestructor();

### [#](#content-toonlyimplement "Permalink")`toOnlyImplement()`

The `toOnlyImplement()` method may be used to ensure that certain classes are restricted to implementing specific interfaces.

    1arch('app')2    ->expect('App\Responses')3    ->toOnlyImplement('Illuminate\Contracts\Support\Responsable');

### [#](#content-toonlyuse "Permalink")`toOnlyUse()`

The `toOnlyUse()` method may be used to guarantee that certain classes are restricted to utilizing specific functions or classes. For example, you may ensure your models are streamlined and solely dependent on the `Illuminate\Database` namespace, and not, for instance, dispatching queued jobs or events.

    1arch('models')2    ->expect('App\Models')3    ->toOnlyUse('Illuminate\Database');

### [#](#content-toonlybeusedin "Permalink")`toOnlyBeUsedIn()`

The `toOnlyBeUsedIn()` method enables you to limit the usage of a specific class or set of classes to only particular parts of your application. For instance, you can use this method to confirm that your models are only used by your repositories and not by controllers or service providers.

    1arch('models')2    ->expect('App\Models')3    ->toOnlyBeUsedIn('App\Repositories');

### [#](#content-touse "Permalink")`toUse()`

By combining the `not` modifier with the `toUse()` method, you can indicate that files within a given namespace should not use specific functions or classes.

    1arch('globals')2    ->expect('App\Domain')3    ->not->toUse('request');4 5arch('globals')6    ->expect('App\Domain')7    ->not->toUse('Illuminate\Http');

### [#](#content-tousestrictequality "Permalink")`toUseStrictEquality()`

The `toUseStrictEquality()` method may be used to ensure that all files within a given namespace use strict equality. In other words, the `===` operator is used instead of the `==` operator.

    1arch('models')2    ->expect('App')3    ->toUseStrictEquality();

Or, if you rather want to ensure that all files within a given namespace do not use strict equality, you may use the `not` modifier.

    1arch('models')2    ->expect('App')3    ->not->toUseStrictEquality();

### [#](#content-tousetrait "Permalink")`toUseTrait()`

The `toUseTrait()` method may be used to ensure that all files within a given namespace use a specific trait.

    1arch('models')2    ->expect('App\Models')3    ->toUseTrait('Illuminate\Database\Eloquent\SoftDeletes');

### [#](#content-tousetraits "Permalink")`toUseTraits()`

The `toUseTraits()` method may be used to ensure that all files within a given namespace use specific traits.

    1arch('models')2    ->expect('App\Models')3    ->toUseTraits(['Illuminate\Database\Eloquent\SoftDeletes', 'App\Concerns\CustomTrait']);

### [#](#content-tousenothing "Permalink")`toUseNothing()`

If you want to indicate that particular namespaces or classes should not have any dependencies, you can utilize the `toUseNothing()` method.

    1arch('value objects')2    ->expect('App\ValueObjects')3    ->toUseNothing();

### [#](#content-tousestricttypes "Permalink")`toUseStrictTypes()`

The `toUseStrictTypes()` method may be used to ensure that all files within a given namespace utilize strict types.

    1arch('app')2    ->expect('App')3    ->toUseStrictTypes();

[#](#content-presets "Permalink")Presets
----------------------------------------

Sometimes, writing arch expectations from scratch can be time-consuming, specifically when working on a new project, and you just want to ensure that the basic architectural rules are met.

Presets are predefined sets of granular expectations that you can use to test your application's architecture.

*   [`php`](#preset-php)
*   [`security`](#preset-security)
*   [`laravel`](#preset-laravel)
*   [`strict`](#preset-strict)
*   [`custom`](#preset-custom)

### [#](#content-php "Permalink")`php`

The `php` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It avoids the usage of `die`, `var_dump`, and similar functions, and ensures you are not using deprecated PHP functions.

    1arch()->preset()->php();

You may find all the expectations included in the `php` preset below in our [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Php.php).

### [#](#content-security "Permalink")`security`

The `security` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It ensures you are not using code that could lead to security vulnerabilities, such as `eval`, `md5`, and similar functions.

    1arch()->preset()->security();

You may find all the expectations included in the `security` preset below in our [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Security.php).

### [#](#content-laravel "Permalink")`laravel`

The `laravel` preset is a predefined set of expectations that can be used on [Laravel](https://laravel.com) projects.

It ensures you project's structure is following the well-known Laravel conventions, such as controllers only have `index`, `show`, `create`, `store`, `edit`, `update`, `destroy` as public methods and are always suffixed with `Controller` and so on.

    1arch()->preset()->laravel();

You may find all the expectations included in the `laravel` preset below in our [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Laravel.php).

### [#](#content-strict "Permalink")`strict`

The `strict` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It ensures you are using strict types in all your files, that all your classes are final, and more.

    1arch()->preset()->strict();

You may find all the expectations included in the `strict` preset below in our [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Strict.php).

### [#](#content-relaxed "Permalink")`relaxed`

The `relaxed` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It is the opposite of the `strict` preset, ensuring you are not using strict types in all your files, that all your classes are not final, and more.

    1arch()->preset()->relaxed();

You may find all the expectations included in the `relaxed` preset below in our [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Relaxed.php).

### [#](#content-custom "Permalink")`custom`

Typically, you don't need to create a `custom` preset, as you can use the `arch()` method to write your granular expectations. However, if you want to create your own preset, you can use the `custom` method to define the preset.

This may be useful if you have a set of expectations that you use frequently across multiple projects, or if you are a plugin author and want to provide a set of expectations for your users.

    1pest()->presets()->custom('ddd', function () {2    return [3        expect('Infrastructure')->toOnlyBeUsedIn('Application'),4        expect('Domain')->toOnlyBeUsedIn('Application'),5    ];6});

Within the `custom` method, you may have access to the application PSR-4 namespaces on the first argument of your closure's callback.

    1pest()->presets()->custom('silex', function (array $userNamespaces) {2    var_dump($userNamespaces); // array(1) { [0]=> string(3) "App" }3    return [4        expect($userNamespaces)->toBeArray(),5    ];6});

You can then use the `custom` preset by chaining the `preset()` method with the name of the custom preset.

    1arch()->preset()->silex();

[#](#content-modifiers "Permalink")Modifiers
--------------------------------------------

Sometimes, you may want to apply the given expectation but excluding certain types of files, or ignoring certain classes, functions, or specific lines of code. For that, you may use the following methods:

*   [`ignoring()`](#modifier-ignoring)
*   [`classes()`](#modifier-classes)
*   [`enums()`](#modifier-enums)
*   [`interfaces()`](#modifier-interfaces)
*   [`traits()`](#modifier-traits)
*   [`extending()`](#modifier-extending)
*   [`implementing()`](#modifier-implementing)
*   [`using()`](#modifier-using)

### [#](#content-ignoring "Permalink")`ignoring()`

When defining your architecture rules, you can use the `ignoring()` method to exclude certain namespaces or classes that would otherwise be included in the rule definition.

    1arch()2    ->preset()3    ->php()4    ->ignoring('die');5 6arch()7    ->expect('Illuminate\Support\Facades')8    ->not->toBeUsed()9    ->ignoring('App\Providers');

In some cases, certain components may not be regarded as "dependencies" as they are part of the native PHP library. To customize the definition of "native" code and exclude it during testing, Pest allows you to specify what to ignore.

For example, if you do not want to consider Laravel a "dependency", you can use the `arch()` method inside the `beforeEach()` function to disregard any code within the "Illuminate" namespace. This approach allows you to focus only on the actual dependencies of your application.

    1// tests/Pest.php2pest()->beforeEach(function () {3    $this->arch()->ignore([4        'Illuminate',5    ])->ignoreGlobalFunctions();6});

### [#](#content-classes "Permalink")`classes()`

The `classes()` modifier allows you to restrict the expectation to only classes.

    1arch('app')2    ->expect('App')3    ->classes()4    ->toBeFinal();

### [#](#content-enums "Permalink")`enums()`

The `enums()` modifier allows you to restrict the expectation to only enums.

    1arch('app')2    ->expect('App\Models')3    ->enums()4    ->toOnlyBeUsedIn('App\Models');

### [#](#content-interfaces "Permalink")`interfaces()`

The `interfaces()` modifier allows you to restrict the expectation to only interfaces.

    1arch('app')2    ->expect('App')3    ->interfaces()4    ->toExtend('App\Contracts\Contract');

### [#](#content-traits "Permalink")`traits()`

The `traits()` modifier allows you to restrict the expectation to only traits.

    1arch('app')2    ->expect('App')3    ->traits()4    ->toExtend('App\Traits\Trait');

### [#](#content-extending "Permalink")`extending()`

The `extending()` modifier allows you to restrict the expectation to only classes or interfaces that extend the given class.

    1arch('app')2    ->expect('App')3    ->extending(Model::class)4    ->toUseTrait(HasFactory::class);

### [#](#content-implementing "Permalink")`implementing()`

The `implementing()` modifier allows you to restrict the expectation to only classes that implement the given interface.

    1arch('app')2    ->expect('App')3    ->implementing(ShouldQueue::class)4    ->toUseTrait(Dispatchable::class);

### [#](#content-using "Permalink")`using()`

The `using()` modifier allows you to restrict the expectation to only classes that use the given trait.

    1arch('app')2    ->expect('App')3    ->using(HasFactory::class)4    ->toExtend(Model::class);

* * *

In this section, you have learned how to perform architectural testing, ensuring that your application or library's architecture meets a specified set of architectural requirements. Next, have you ever wondered how to test the performance of your code? Let's explore [Stress Testing](/docs/stress-testing).

---

## Cli Api Reference

[Edit this page →](https://github.com/pestphp/docs/edit/master/cli-api-reference.md)

[#](#content-cli-api-reference "Permalink")CLI API Reference
============================================================

In the preceding chapters of the Pest documentation, we have covered numerous CLI options that are available in Pest. Nevertheless, Pest provides many other options that could prove beneficial. The complete CLI API Reference is provided below for your convenience.

[#](#content-configuration "Permalink")Configuration
----------------------------------------------------

*   `--init`: Initialize a standard Pest configuration.
*   `--bootstrap <file>` A PHP script that is included before the tests run.
*   `-c|--configuration <file>`: Read configuration from XML file.
*   `--no-configuration`: Ignore default configuration file (phpunit.xml).
*   `--extension <class>`: Register test runner extension with bootstrap .
*   `--no-extensions`: Do not load PHPUnit extensions.
*   `--include-path <path(s)>`: Prepend PHP's include\_path with given path(s).
*   `-d <key[=value]>`: Set a php.ini value.
*   `--cache-directory <dir>`: Specify cache directory.
*   `--generate-configuration`: Generate configuration file with suggested settings.
*   `--migrate-configuration`: Migrate configuration file to current format.
*   `--generate-baseline <file>`: Generate baseline for issues.
*   `--use-baseline <file>`: Use baseline to ignore issues.
*   `--ignore-baseline`: Do not use baseline to ignore issues.
*   `--test-directory`: Specify test directory containing Pest.php, TestCase.php, helpers and your tests. Default: tests

[#](#content-selection "Permalink")Selection
--------------------------------------------

*   `--bail`: Stop execution upon first not-passed test.
*   `--todos`: Output to standard output the list of todos.
*   `--notes`: Output to standard output tests with notes.
*   `--issue`: Output to standard output tests with the given issue number.
*   `--pr`: Output to standard output tests with the given pull request number.
*   `--pull-request`: Output to standard output tests with the given pull request number (alias for `--pr`).
*   `--retry`: Run non-passing tests first and stop execution upon first error or failure.
*   `--list-suites` List available test suites.
*   `--testsuite <name>`: Only run tests from the specified test suite(s).
*   `--exclude-testsuite <name>`: Exclude tests from the specified test suite(s).
*   `--list-groups`: List available test groups.
*   `--group <name>`: Only run tests from the specified group(s).
*   `--exclude-group <name>`: Exclude tests from the specified group(s).
*   `--covers <name>`: Only run tests that intend to cover `<name>`.
*   `--uses <name>`: Only run tests that intend to use `<name>`.
*   `--requires-php-extension <name>`: Only run tests that require PHP extension .
*   `--list-test-files`: List available test files.
*   `--list-tests`: List available tests.
*   `--list-tests-xml <file>`: List available tests in XML format.
*   `--filter <pattern>`: Filter which tests to run
*   `--exclude-filter <pattern>`: Exclude tests for the specified filter pattern.
*   `--test-suffix <suffixes>`: Only search for test in files with specified suffix(es). Default: Test.php,.phpt

[#](#content-execution "Permalink")Execution
--------------------------------------------

*   `--parallel` Run tests in parallel.
*   `--update-snapshots`: Update snapshots for tests using the "toMatchSnapshot" expectation.
*   `--globals-backup`: Backup and restore $GLOBALS for each test.
*   `--static-backup`: Backup and restore static properties for each test.
*   `--strict-coverage`: Be strict about code coverage metadata.
*   `--strict-global-state`: Be strict about changes to global state.
*   `--disallow-test-output`: Be strict about output during tests.
*   `--enforce-time-limit`: Enforce time limit based on test size.
*   `--default-time-limit <sec>`: Timeout in seconds for tests that have no declared size.
*   `--dont-report-useless-tests`: Do not report tests that do not test anything.
*   `--stop-on-defect`: Stop execution upon first not-passed test.
*   `--stop-on-error`: Stop execution upon first error.
*   `--stop-on-failure`: Stop execution upon first error or failure.
*   `--stop-on-warning`: Stop execution upon first warning.
*   `--stop-on-risky`: Stop execution upon first risky test.
*   `--stop-on-deprecation`: Stop after first test that triggered a deprecation.
*   `--stop-on-notice`: Stop after first test that triggered a notice.
*   `--stop-on-skipped`: Stop execution upon first skipped test.
*   `--stop-on-incomplete`: Stop execution upon first incomplete test.
*   `--fail-on-empty-test-suite`: Signal failure using shell exit code when no tests were run.
*   `--fail-on-warning`: Treat tests with warnings as failures.
*   `--fail-on-risky`: Treat risky tests as failures.
*   `--fail-on-deprecation`: Signal failure using shell exit code when a deprecation was triggered.
*   `--fail-on-phpunit-deprecation`: Signal failure using shell exit code when a PHPUnit deprecation was triggered.
*   `--fail-on-notice`: Signal failure using shell exit code when a notice was triggered.
*   `--fail-on-skipped`: Treat skipped tests as failures.
*   `--fail-on-incomplete`: Signal failure using shell exit code when a test was marked incomplete.
*   `--cache-result`: Write test results to cache file.
*   `--do-not-cache-result`: Do not write test results to cache file
*   `--order-by <order>`: Run tests in order: default|defects|depends|duration|no-depends|random|reverse|size.
*   `--random-order-seed <N>`: Use the specified random seed when running tests in random order

[#](#content-reporting "Permalink")Reporting
--------------------------------------------

*   `--colors <flag>`: Use colors in output ("never", "auto" or "always").
*   `--columns <n>`: Number of columns to use for progress output.
*   `--columns max`: Use maximum number of columns for progress output.
*   `--stderr`: Write to STDERR instead of STDOUT.
*   `--no-progress`: Disable output of test execution progress.
*   `--no-results`: Disable output of test results.
*   `--no-output`: Disable all output.
*   `--display-incomplete`: Display details for incomplete tests.
*   `--display-skipped`: Display details for skipped tests.
*   `--display-deprecations`: Display details for deprecations triggered by tests.
*   `--display-phpunit-deprecations`: Display details for PHPUnit deprecations.
*   `--display-errors`: Display details for errors triggered by tests.
*   `--display-notices`: Display details for notices triggered by tests.
*   `--display-warnings`: Display details for warnings triggered by tests.
*   `--reverse-list`: Print defects in reverse order.
*   `--teamcity`: Replace default progress and result output with TeamCity format.
*   `--testdox`: Replace default result output with TestDox format
*   `--testdox-summary`: Repeat TestDox output for tests with errors, failures, or issues.
*   `--debug`: Replace default progress and result output with debugging information.
*   `--compact`: Replace default result output with Compact format

[#](#content-logging "Permalink")Logging
----------------------------------------

*   `--log-junit <file>`: Write test results in JUnit XML format to file.
*   `--log-teamcity <file>`: Write test results in TeamCity format to file.
*   `--testdox-html <file>`: Write test results in TestDox format (HTML) to file.
*   `--testdox-text <file>`: Write test results in TestDox format (plain text) to file.
*   `--log-events-text <file>`: Stream events as plain text to file.
*   `--log-events-verbose-text <file>`: Stream events as plain text (with telemetry information) to file.
*   `--no-logging`: Ignore logging configured in the XML configuration file

[#](#content-code-coverage "Permalink")Code Coverage
----------------------------------------------------

*   `--coverage`: Generate code coverage report and output to standard output.
*   `--coverage --min=<value>`: Set the minimum required coverage percentage, and fail if not met.
*   `--coverage-clover <file>`: Write code coverage report in Clover XML format to file.
*   `--coverage-cobertura <file>`: Write code coverage report in Cobertura XML format to file.
*   `--coverage-crap4j <file>`: Write code coverage report in Crap4J XML format to file.
*   `--coverage-html <dir>`: Write code coverage report in HTML format to directory.
*   `--coverage-php <file>`: Write serialized code coverage data to file.
*   `--coverage-text=<file>`: Write code coverage report in text format to file \[default: standard output\].
*   `--only-summary-for-coverage-text`: Option for code coverage report in text format: only show summary.
*   `--show-uncovered-for-coverage-text`: Option for code coverage report in text format: show uncovered files.
*   `--coverage-xml <dir>`: Write code coverage report in XML format to directory.
*   `--warm-coverage-cache`: Warm static analysis cache.
*   `--coverage-filter <dir>`: Include `<dir>`: in code coverage reporting.
*   `--path-coverage`: Report path coverage in addition to line coverage.
*   `--disable-coverage-ignore`: Disable metadata for ignoring code coverage.
*   `--no-coverage`: Ignore code coverage reporting configured in the XML configuration file

[#](#content-mutation-testing "Permalink")Mutation Testing
----------------------------------------------------------

*   `--mutate`: Runs mutation testing, to understand the quality of your tests.
*   `--mutate --parallel`: Runs mutation testing in parallel.
*   `--mutate --min`: Set the minimum required mutation score, and fail if not met.
*   `--mutate --id`: Run only the mutation with the given ID. But E.g. --id=ecb35ab30ffd3491. Note, you need to provide the same options as the original run.
*   `--mutate --covered-only`: Only generate mutations for classes that are covered by tests.
*   `--mutate --bail`: Stop mutation testing execution upon first untested or uncovered mutation.
*   `--mutate --class`: Generate mutations for the given class(es). E.g. --class=App\\Models.
*   `--mutate --ignore`: Ignore the given class(es) when generating mutations. E.g. --ignore=App\\Http\\Requests.
*   `--mutate --clear-cache`: Clear the mutation cache.
*   `--mutate --no-cache`: Clear the mutation cache.
*   `--mutate --ignore-min-score-on-zero-mutations`: Ignore the minimum score requirement when there are no mutations.
*   `--mutate --covered-only`: Only generate mutations for classes that are covered by tests.
*   `--mutate --everything`: Generate mutations for all classes, even if they are not covered by tests.
*   `--mutate --profile`: Output to standard output the top ten slowest mutations.
*   `--mutate --retry`: Run untested or uncovered mutations first and stop execution upon first error or failure.
*   `--mutate --stop-on-uncovered`: Stop mutation testing execution upon first untested mutation.
*   `--mutate --stop-on-untested`: Stop mutation testing execution upon first untested mutation.

[#](#content-profiling "Permalink")Profiling
--------------------------------------------

*   `--profile`: Output to standard output the top ten slowest tests

* * *

In this chapter, you found a complete list of CLI options provided by Pest. In the subsequent documentation, we will explore the topic of test dependencies: [Test Dependencies](/docs/test-dependencies)

---

## Community Guide

[Edit this page →](https://github.com/pestphp/docs/edit/master/community-guide.md)

[#](#content-community-guide "Permalink")Community Guide
========================================================

Our project aims to develop the world's finest testing framework that not only establishes itself as the standard choice in the PHP ecosystem, but also serves as a catalyst for change and inspiration in other ecosystems.

Your contribution is crucial to achieving our ambitious goal. We strongly believe that the PHP ecosystem has the talent and work ethic necessary to accomplish this goal. In the following section, we will outline the various areas where you can lend your assistance and become an integral part of our mission.

**Develop Educational Resources:** There is a popular saying that the best way to learn is to teach. If you have something interesting to share about your experience with Pest, you can reinforce your knowledge by creating a blog post, conducting a workshop, creating a video, or even publishing a gist.

**Help Fellow Users:** It's important to remember that contributing to the Pest's growth goes beyond just writing code. Providing assistance to other Pest users is a valuable form of contribution as well. At this time, we are present on Discord and Telegram. However, you are free to create other community channels.

> Discord: **[discord.gg/kaHY6p54JH](https://discord.gg/kaHY6p54JH)**

> Telegram: **[t.me/+kYH5G4d5MV83ODk0](https://t.me/+kYH5G4d5MV83ODk0)**

**Improve Our Documentation:** If you have strong writing skills, you can assist us in enhancing Pest's documentation and coding examples. Simply navigate to a documentation page and click on the "Edit this page →" option located on the top right to get started.

> Pest Documentation Repository: **[github.com/pestphp/docs](https://github.com/pestphp/docs)**

**Speak At Meetups / Conferences:** Delivering a talk or workshop can be a great way to contribute to the growth of Pest. You need not necessarily prepare something entirely from scratch, as there are already several conference talks on Pest available on YouTube that you can use as inspiration for your own talk.

**Become a Community Leader:** By becoming a testing (or Pest) advocate, you can increase its reach and impact. Start by sharing testing tips on social media platforms like Twitter and LinkedIn, and you may be surprised by the significant impact it can have on Pest's growth.

> Twitter: **[@pestphp](https://twitter.com/pestphp)**

**Become a Code Contributor:** If you have ideas for improvements or new features that can be introduced in Pest, you're welcome to share them on the Pest repository's [GitHub issues board](https://github.com/pestphp/pest/issues) or [GitHub discussion board](https://github.com/pestphp/pest/discussions). If you propose a new feature, please consider contributing some of the code needed to implement it. Please keep in mind that discussions regarding Pest development, including bugs, new features, and related topics, take place on GitHub, not through email or Twitter DMs.

> Pest GitHub Repository: **[github.com/pestphp/pest](https://github.com/pestphp/pest)**

---

## Configuring Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/configuring-tests.md)

[#](#content-configuring-tests "Permalink")Configuring Tests
============================================================

The `Pest.php` file is a configuration file that is used to define your test suite setup. This file is located in the `tests` directory of your project and is automatically loaded by Pest when you run your tests. Although you can define [Global Hooks](/docs/global-hooks) or [Custom Expectations](/docs/custom-expectations) within this file, its primary purpose is to specify the base test class utilized in your test suite.

When using Pest, the `$this` variable available within closures provided to test functions is bound to a specific test case class, which is typically `PHPUnit\Framework\TestCase`. This guarantees that the test cases written in Pest's functional style can access the underlying assertion API of PHPUnit, simplifying collaboration with other developers who are more familiar with the PHPUnit testing framework.

    1it('has home', function () {2    echo get_class($this); // \PHPUnit\Framework\TestCase3 4    $this->assertTrue(true);5});

However, you may associate a specific folder or even your entire test suite with another base test case class, thus changing the value of `$this` within tests. To accomplish this, you can utilize the `pest()` function and the `in()` method within your `Pest.php` configuration file.

    1// tests/Pest.php2pest()->extend(Tests\TestCase::class)->in('Feature');3 4// tests/Feature/ExampleTest.php5it('has home', function () {6    echo get_class($this); // \Tests\TestCase7});

Additionally, Pest supports [glob patterns](https://www.php.net/manual/en/function.glob.php) in the in() method. This allows you to specify multiple directories or files with a single pattern. Glob patterns are string representations that can match various file paths, like wildcards. If you are unfamiliar with glob patterns, refer to the PHP manual [here](https://www.php.net/manual/en/function.glob.php).

    1// tests/Pest.php2pest()->extend(Tests\TestCase::class)->in('Feature/*Job*.php');3 4// This will apply the Tests\TestCase to all test files in the "Feature" directory that contains "Job" in their filename.

Another more complex example would be using a pattern to match multiple directories in different modules while applying multiple test case classes and traits:

    1// tests/Pest.php2pest()3    ->extend(DuskTestCase::class)4    ->use(DatabaseMigrations::class)5    ->in('../Modules/*/Tests/Browser');6 7// This will apply the DuskTestCase class and the DatabaseMigrations trait to all test files within any module's "Browser" directory.

Any method that is defined as `public` or `protected` in your base test case class can be accessed within the test closure.

     1use PHPUnit\Framework\TestCase as BaseTestCase; 2  3// tests/TestCase.php 4class TestCase extends BaseTestCase 5{ 6    public function performThis(): void 7    { 8        // 9    }10}11 12// tests/Pest.php13pest()->extend(TestCase::class)->in('Feature');14 15// tests/Feature/ExampleTest.php16it('has home', function () {17    $this->performThis();18});

A trait can be linked to a test or folder, much like classes. For instance, in Laravel, you can employ the `RefreshDatabase` trait to reset the database prior to each test. To include the trait in your test, pass the trait's name to the `pest()->use()` method.

    1<?php2 3use Tests\TestCase;4use Illuminate\Foundation\Testing\RefreshDatabase;5 6pest()->extend(TestCase::class)->use(RefreshDatabase::class)->in('Feature');

To associate a particular test with a specific test case class or trait, you can utilize the `pest()->extend()` and `pest()->use()` methods **within that specific test file**, omitting the use of the `in()` method.

    1pest()->extend(Tests\MySpecificTestCase::class);2 3it('has home', function () {4    echo get_class($this); // \Tests\MySpecificTestCase5});

* * *

Next, one of the features available to you when configuring your test suite is the ability to group folders. When utilized, this feature allows you to filter your executed tests using the `--group` option: [Grouping Tests](/docs/grouping-tests)

---

## Continuous Integration

[Edit this page →](https://github.com/pestphp/docs/edit/master/continuous-integration.md)

[#](#content-continuous-integration "Permalink")Continuous Integration
======================================================================

Up until now, we have only discussed running tests from the command line on your local machine. But, you can also run your tests from a CI platform of your choice. As `pestphp/pest` is included in your Composer development dependencies, you can easily execute the `vendor/bin/pest --ci` command within your CI platform's deployment pipeline.

[#](#content-example-with-github-actions "Permalink")Example With GitHub Actions
--------------------------------------------------------------------------------

If your application uses [GitHub Actions](https://github.com/features/actions) as its CI platform, the following guidelines will assist you in configuring Pest so that your application is automatically tested when someone pushes a commit to your GitHub repository.

To get started, create a `tests.yml` file within the `your-project/.github/workflows` directory. The file should have the following contents:

     1name: Tests 2  3on: ['push', 'pull_request'] 4  5jobs: 6  ci: 7    runs-on: ubuntu-latest 8  9    steps:10      - name: Checkout11        uses: actions/checkout@v312 13      - name: Setup PHP14        uses: shivammathur/setup-php@v215        with:16          php-version: 8.217          tools: composer:v218          coverage: xdebug19 20      - name: Install Dependencies21        run: composer install --no-interaction --prefer-dist --optimize-autoloader22 23      - name: Tests24        run: ./vendor/bin/pest --ci

Naturally, you may customize the script above according to your requirements. For example, you may need to set up a database if your tests require one.

Once you have created your `tests.yml` file, commit and push the `tests.yml` file so GitHub Actions can run your tests. Keep in mind that once you make this commit, your test suite will execute on all new pull requests and commits.

[#](#content-example-with-gitlab-cicd-pipelines "Permalink")Example With GitLab CI/CD Pipelines
-----------------------------------------------------------------------------------------------

If your application uses [GitLab CI/CD Pipelines](https://docs.gitlab.com/ee/ci/pipelines/) as its CI platform, the following guidelines will assist you in configuring Pest so that your application is automatically tested when someone pushes a commit to your GitLab repository.

To get started, add the following configuration to your `.gitlab-ci.yml` file. The file should have the following contents:

     1stages: 2  - build 3  - test 4  5build:vendors: 6  stage: build 7  only: 8    refs: 9      - merge_requests10      - push11  cache:12    key:13      files:14        - composer.lock15    policy: pull-push16  image: composer:217  script:18    - composer install --no-interaction --prefer-dist --optimize-autoloader19 20tests:21  stage: test22  only:23    refs:24      - merge_requests25      - push26  cache:27    key:28      files:29        - composer.lock30    policy: pull31  image: php:8.232  script:33    - ./vendor/bin/pest --ci

Naturally, you may customize the script above according to your requirements. For example, you may need to set up a database if your tests require one.

Once you have created your `.gitlab-ci.yml` file, commit and push the `.gitlab-ci.yml` file so Gitlab CI/CD Pipelines can run your tests. Keep in mind that once you make this commit, your test suite will execute on all new merge requests and commits.

[#](#content-example-with-bitbucket-pipelines "Permalink")Example with Bitbucket Pipelines
------------------------------------------------------------------------------------------

If your application uses [Bitbucket CI/CD Pipelines](https://bitbucket.org/product/features/pipelines) as its CI platform, the following guidelines will assist you in configuring Pest so that your application is automatically tested when someone pushes a commit to your Bitbucket repository.

To get started, add the following configuration to your `bitbucket-pipelines.yml` file. The file should have the following contents:

     1image: composer:2 2  3pipelines: 4  default: 5  - parallel: 6      - step: 7          name: Test 8          script: 9            - composer install --no-interaction --prefer-dist --optimize-autoloader10            - ./vendor/bin/pest11          caches:12            - composer

Naturally, you may customize the script above according to your requirements. For example, you may need to set up a database if your tests require one.

Once you have created your `bitbucket-pipelines.yml` file, commit and push the `bitbucket-pipelines.yml` file so Bitbucket Pipelines can run your tests. Keep in mind that once you make this commit, your test suite will execute on all new pull requests and commits.

[#](#content-example-with-chipper-ci "Permalink")Example with Chipper CI
------------------------------------------------------------------------

If your application uses [Chipper CI](https://chipperci.com) as its CI platform, the following guidelines will assist you in configuring Pest so that your application is automatically tested when someone pushes a commit to your git repository.

To get started, add the following configuration to your `.chipperci.yml` file. The file should have the following contents:

     1version: 1 2  3environment: 4  php: 8.2 5  node: 16 6  7# Optional services 8services: 9#  - mysql: 810#  - redis:11 12# Build all commits13on:14   push:15      branches: .*16 17pipeline:18  - name: Setup19    cmd: |20      cp -v .env.example .env21      composer install --no-interaction --prefer-dist --optimize-autoloader22      php artisan key:generate23 24  - name: Compile Assets25    cmd: |26      npm ci --no-audit27      npm run build28 29  - name: Test30    cmd: pest

In addition to handling Composer and NPM caches, Chipper CI automatically adds `vendor/bin` to your PATH, so simply running the `pest --ci` command will work when running tests.

Naturally, you may customize the scripts above according to your requirements. For example, you may need to define a [database service](https://chipperci.com/docs/builds/databases/) if your tests require one.

Once you have created your `.chipperci.yml` file, commit and push the `.chipperci.yml` file so Chipper CI can run your tests. Keep in mind that once you make this commit, your test suite will execute on all new commits.

* * *

Great job setting up Continuous Integration for your project to ensure codebase stability! Now, let's take a deeper dive into Pest's concepts by exploring it's test configuration capabilities: [Configuring Pest →](/docs/configuring-tests)

---

## Creating Plugins

[Edit this page →](https://github.com/pestphp/docs/edit/master/creating-plugins.md)

[#](#content-creating-plugins "Permalink")Creating Plugins
==========================================================

Community plugins are essential for offering additional features to the Pest community, while the Pest team prioritizes keeping the framework's core small and fast. In this chapter, we'll discuss how to create your own plugins and share them with the community.

The simplest way to develop your own plugin is to begin with the [pest-plugin-template](https://github.com/pestphp/pest-plugin-template). To generate a new repository from the template repository, click on GitHub's "Use this template" button and name your new repository "pest-plugin-".

After cloning the repository, make sure to modify the "name" and "description" fields in the `composer.json` file to suit your plugin.

Pest plugins are capable of exposing custom test methods via the `$this` variable, adding namespaced functions, defining custom expectations, and offering custom CLI options.

[#](#content-adding-methods "Permalink")Adding Methods
------------------------------------------------------

Let's start building our plugin by making new test methods available via the `$this` variable. To accomplish this, define a PHP trait in your plugin.

    1namespace YourGitHubUsername\PestPluginName;2 3trait MyPluginTrait4{5    public function myPluginMethod()6    {7        //8    }9}

In order to make this trait method invokable via Pest, we must inform Pest that it should make it available. This can be accomplished creating an `Autoload.php` file within your plugin with the following content.

    1use YourGitHubUsername\PestPluginName\MyPluginTrait;2 3Pest\Plugin::uses(MyPluginTrait::class);

Lastly, we need to update our plugin's `composer.json` file to load our `Autoload.php` file as well as our plugin source code.

    1"autoload": {2    "psr-4": {3        "YourGitHubUsername\\PestPluginName\\": "src/"4    },5    "files": ["src/Autoload.php"]6},

After you publish your plugin to [Packagist](https://packagist.org), users will be able to install your plugin via Composer. Once installed, they will be able to access your plugin's functions within their test closures.

    1test('plugin example', function () {2    $this->myPluginMethod();3 4    //5})

[#](#content-adding-functions "Permalink")Adding Functions
----------------------------------------------------------

A plugin can also define additional namespaced functions, which are typically declared within the plugin's `Autoload.php` file.

    1namespace YourGitHubUsername\PestPluginName;2 3function myPluginFunction(): void4{5    //6}

Within your plugins functions, you can access the current `$this` variable that would typically be available to test closures by invoking the `test()` function with no arguments.

    1namespace YourGitHubUsername\PestPluginName;2 3use PHPUnit\Framework\TestCase;4 5function myPluginFunction(): TestCase6{7    return test(); // Same as `return $this;`8}

Once you modify your plugin's `composer.json` file to autoload the `Autoload.php` file, users can easily access your function within their tests.

    1use function YourGitHubUsername\PestPluginName\{myPluginFunction};2 3test('plugin example', function () {4    myPluginFunction();5 6    // ...7}

[#](#content-adding-custom-expectations "Permalink")Adding Custom Expectations
------------------------------------------------------------------------------

Custom expectations can be incorporated into your plugin's `Autoload.php` file. For information on how to build custom expectations, please refer to the comprehensive documentation on [Custom Expectations](/docs/custom-expectations).

[#](#content-adding-arch-presets "Permalink")Adding Arch Presets
----------------------------------------------------------------

If your plugin provides a custom Arch preset, you can define it within the `Autoload.php` file.

    1pest()->preset('ddd', function () {2    return [3        expect('Infrastructure')->toOnlyBeUsedIn('Application'),4        expect('Domain')->toOnlyBeUsedIn('Application'),5    ];6});

Optionally, may have access to the application PSR-4 namespaces on the first argument of your closure's callback.

    1pest()->preset('silex', function (array $userNamespaces) {2    dump($userNamespaces); // ['App\\']3});

* * *

As you can see, crafting plugins on Pest can serve as a fantastic starting point for your open-source endeavors! In the next chapter, we will explore the concept of "Higher Order Testing": [Higher Order Testing](/docs/higher-order-testing)

---

## Custom Expectations

[Edit this page →](https://github.com/pestphp/docs/edit/master/custom-expectations.md)

[#](#content-custom-expectations "Permalink")Custom Expectations
================================================================

Pest's expectation API is powerful by default, but there may be times when you need to write the same expectations repeatedly between tests. In such cases, creating custom expectations that meet your specific requirements can be incredibly useful.

Custom expectations are usually defined in the `tests/Pest.php` file, but you can also organize them in a separate `tests/Expectations.php` file for better maintainability. To create a custom expectation in Pest, chain the `extend()` method onto the `expect()` function without providing any expectation value.

For example, suppose you are testing a number utility library and you need to frequently assert that numbers fall within a given range. In this case, you might create a custom expectation called `toBeWithinRange()`:

     1// Pest.php or Expectations.php... 2expect()->extend('toBeWithinRange', function (int $min, int $max) { 3    return $this->toBeGreaterThanOrEqual($min) 4                ->toBeLessThanOrEqual($max); 5}); 6  7// Tests/Unit/ExampleTest.php 8test('numeric ranges', function () { 9    expect(100)->toBeWithinRange(90, 110);10});

While users typically utilize Pest's built-in expectations within their custom expectations as demonstrated in the `toBeWithinRange()` example, there may be times when you need to access the expectation value directly to perform your own custom expectation logic. In such cases, you can access the expectation value that was passed to `expect($value)` via the `$this->value` property.

    1expect()->extend('toBeWithinRange', function (int $min, int $max) {2    echo $this->value; // 1003});

Of course, you probably want users to have the ability to "chain" expectations together with your custom expectation. To achieve this, ensure your custom expectation includes a `return $this` statement.

     1// Pest.php or Expectations.php... 2expect()->extend('toBeWithinRange', function (int $min, int $max) { 3    // Assertions based on `$this->value` and the given arguments... 4  5    return $this; // Return this, so another expectations can chain this one... 6}); 7  8// Tests/Unit/ExampleTest.php 9test('numeric ranges', function () {10    expect(100)11        ->toBeInt()12        ->toBeWithinRange(90, 110)13        ->to...14});

[#](#content-intercept-expectations "Permalink")Intercept Expectations
----------------------------------------------------------------------

Although it is considered an advanced practice, you can override existing expectations with your own implementation via the `intercept()` method. When using this method, the existing expectation will be fully substituted if the expectation value is of the specified type. For example, you can replace the `toBe()` expectation to check if two objects of the `Illuminate\Database\Eloquent\Model` type have the same `id`.

     1use Illuminate\Database\Eloquent\Model; 2use App\Models\User; 3  4// tests/Pest.php or tests/Expectations.php 5expect()->intercept('toBe', Model::class, function(Model $expected) { 6    expect($this->value->id)->toBe($expected->id); 7}); 8  9// tests/Feature/ExampleTest.php10test('models', function () {11    $userA = User::find(1);12    $userB = User::find(1);13 14    expect($userA)->toBe($userB);15});

Instead of passing a string type as the second argument to the `intercept()` method, you may also pass a closure, which will be invoked to determine whether or not to override the core expectation.

    1expect()->intercept('toBe', fn (mixed $value) => is_string($value), function (string $expected, bool $ignoreCase = false) {2    if ($ignoreCase) {3        assertEqualsIgnoringCase($expected, $this->value);4    } else {5        assertSame($expected, $this->value);6    }7});

[#](#content-pipe-expectations "Permalink")Pipe Expectations
------------------------------------------------------------

There may be instances where you want to run one of Pest's built-in expectations, but include customized expectation logic under certain conditions. In these cases, you can use the `pipe()` method. For example, we may want to customize the behavior of the `toBe()` expectation if the given value is an Eloquent model.

     1use Illuminate\Database\Eloquent\Model; 2use App\Models\User; 3  4expect()->pipe('toBe', function (Closure $next, mixed $expected) { 5    if ($this->value instanceof Model) { 6        return expect($this->value->id)->toBe($expected->id); 7    } 8  9    return $next(); // Run to the original, built-in expectation...10});

* * *

As demonstrated, creating custom expectations can significantly simplify your code by eliminating the need to duplicate the logic to verify that your tests are behaving as anticipated. In the following chapter, we will explore additional CLI options that Pest provides: [CLI API Reference](/docs/cli-api-reference)

---

## Custom Helpers

[Edit this page →](https://github.com/pestphp/docs/edit/master/custom-helpers.md)

[#](#content-custom-helpers "Permalink")Custom Helpers
======================================================

If you're transitioning to a functional approach for writing tests, you may wonder where to put your helpers that used to be protected or private methods in your test classes. When using Pest, these helper methods should be converted to simple functions.

For example, if your helper is specific to a certain test file, you may create the helper in the test file directly. Within your helper, you may invoke the `test()` function to access the test class instance that would normally be available via `$this`.

     1use App\Models\User; 2use Tests\TestCase; 3  4function asAdmin(): TestCase 5{ 6    $user = User::factory()->create([ 7        'admin' => true, 8    ]); 9 10    return test()->actingAs($user);11}12 13it('can manage users', function () {14    asAdmin()->get('/users')->assertOk();15})

> **Note:** If your helper creates a custom expectation, you should write a dedicated [custom expectation](/docs/custom-expectations) instead.

If your test helpers are utilized throughout your test suite, you may define them within the `tests/Pest.php` or `tests/Helpers.php` files. Alternatively, you can create a `tests/Helpers` directory to house your own helper files. All of these options will be automatically loaded by Pest.

     1use App\Clients\PaymentClient; 2use Mockery; 3  4// tests/Pest.php or tests/Helpers.php 5function mockPayments(): object 6{ 7    $client = Mockery::mock(PaymentClient::class); 8  9    //10 11    return $client;12}13 14// tests/Feature/PaymentsTest.php15it('may buy a book', function () {16    $client = mockPayments();17 18    //19})

As an alternative to defining helper methods as functions, you may define protected methods in your base test class and subsequently access them in your test cases using the `$this` variable.

     1use App\Clients\PaymentClient; 2use PHPUnit\Framework\TestCase as BaseTestCase; 3use Mockery; 4  5// tests/TestCase.php 6class TestCase extends BaseTestCase 7{ 8    protected function mockPayments(): void 9    {10        $client = Mockery::mock(PaymentClient::class);11 12        //13 14        return $client;15    }16}17 18// tests/Pest.php19pest()->extend(TestCase::class)->in('Feature');20 21// tests/Feature/PaymentsTest.php22it('may buy a book', function () {23    $client = $this->mockPayments();24 25    //26})

* * *

In this section, we explored creating custom helpers. Digging deeper, you may even want to generate a custom expectation. Let's jump into that topic in the next chapter: [Custom Expectations](/docs/custom-expectations)

---

## Datasets

[Edit this page →](https://github.com/pestphp/docs/edit/master/datasets.md)

[#](#content-datasets "Permalink")Datasets
==========================================

With datasets, you can define an array of test data and Pest will run the same test for each set automatically. This saves time and effort by eliminating the need to repeat the same test manually with different data.

    1it('has emails', function (string $email) {2    expect($email)->not->toBeEmpty();3})->with(['[email protected]', '[email protected]']);

When running your tests, Pest will automatically add informative test descriptions to tests that use datasets, outlining the parameters used in each test, aiding in understanding the data and identifying issues if a test fails.

![](/assets/img/datasets-emails.webp?1)

Naturally, it is possible to supply multiple arguments by providing an array containing arrays of arguments.

    1it('has emails', function (string $name, string $email) {2    expect($email)->not->toBeEmpty();3})->with([4    ['Nuno', '[email protected]'],5    ['Other', '[email protected]']6]);

To manually add your own description to a dataset value, you may simply assign it a key.

    1it('has emails', function (string $email) {2    expect($email)->not->toBeEmpty();3})->with([4    'james' => '[email protected]',5    'taylor' => '[email protected]',6]);

If a key is added, Pest will use the key when generating the description for the test.

![](/assets/img/datasets-named.webp?1)

If the test name includes `:dataset`, the description will be interpolated into the test name at that location.

    1✓ it validates the "first_name" field2✓ it validates the "email" field

It is important to notice that when using `closures` in your dataset, you must declare the arguments type in the closure passed to the test function.

    1it('can sum', function (int $a, int $b, int $result) {2    expect(sum($a, $b))->toBe($result);3})->with([4    'positive numbers' => [1, 2, 3],5    'negative numbers' => [-1, -2, -3],6    'using closure' => [fn () => 1, 2, 3],7]);

[#](#content-bound-datasets "Permalink")Bound Datasets
------------------------------------------------------

Pest's bound datasets can be used to obtain a dataset that is resolved after the `beforeEach()` method of your tests. This is particularly useful in Laravel applications (or any other Pest integration) where you may need a dataset of `App\Models\User` models that are created after your database schema is prepared by the `beforeEach()` method.

    1it('can generate the full name of a user', function (User $user) {2    expect($user->full_name)->toBe("{$user->first_name} {$user->last_name}");3})->with([4    fn() => User::factory()->create(['first_name' => 'Nuno', 'last_name' => 'Maduro']),5    fn() => User::factory()->create(['first_name' => 'Luke', 'last_name' => 'Downing']),6    fn() => User::factory()->create(['first_name' => 'Freek', 'last_name' => 'Van Der Herten']),7]);

If you want, you can bind a single argument to the test case. However, Pest requires that it must be fully typed in the `it|test` function arguments.

    1-it('can generate the full name of a user', function ($user, $fullName) {2+it('can generate the full name of a user', function (User $user, $fullName) {3    expect($user->full_name)->toBe($fullName);4})->with([5    [fn() => User::factory()->create(['first_name' => 'Nuno', 'last_name' => 'Maduro']), 'Nuno Maduro'],6    [fn() => User::factory()->create(['first_name' => 'Luke', 'last_name' => 'Downing']), 'Luke Downing'],7    [fn() => User::factory()->create(['first_name' => 'Freek', 'last_name' => 'Van Der Herten']), 'Freek Van Der Herten'],8]);

[#](#content-sharing-datasets "Permalink")Sharing Datasets
----------------------------------------------------------

By storing your datasets separately in the `tests/Datasets` folder, you can easily distinguish them from your test code and ensure that they do not clutter your main test files.

     1// tests/Unit/ExampleTest.php... 2it('has emails', function (string $email) { 3    expect($email)->not->toBeEmpty(); 4-})->with(['[email protected]', '[email protected]']); 5+})->with('emails'); 6  7// tests/Datasets/Emails.php... 8+dataset('emails', [ 9+    '[email protected]',10+    '[email protected]'11+]);

Bound datasets, description keys, and other rules that are applicable to inline datasets can also be applied to shared datasets.

### [#](#content-scoped-datasets "Permalink")Scoped Datasets

Occasionally, datasets may pertain only to a specific feature or set of folders. In such cases, rather than distributing the dataset globally within the `Datasets` folder, you can generate a `Datasets.php` file within the relevant folder requiring the dataset and restrict the dataset's scope to that folder alone.

     1// tests/Feature/Products/ExampleTest.php... 2it('has products', function (string $product) { 3    expect($product)->not->toBeEmpty(); 4})->with('products'); 5  6// tests/Feature/Products/Datasets.php... 7dataset('products', [ 8    'egg', 9    'milk'10]);

[#](#content-combining-datasets "Permalink")Combining Datasets
--------------------------------------------------------------

You can easily obtain complex datasets by combining both **inline** and **shared** datasets. When doing so, the datasets will be combined using a [cartesian product](https://en.wikipedia.org/wiki/Cartesian_product) approach.

In the following example, we verify that all of the specified businesses are closed on each of the provided weekdays.

     1dataset('days_of_the_week', [ 2    'Saturday', 3    'Sunday', 4]); 5  6test('business is closed on day', function(string $business, string $day) { 7    expect(new $business)->isClosed($day)->toBeTrue(); 8})->with([ 9    Office::class,10    Bank::class,11    School::class12])->with('days_of_the_week');

When running the example above, Pest's output will contain a description of each of the validated combinations.

![](/assets/img/datasets-businesshours.webp?1)

[#](#content-repeating-tests "Permalink")Repeating Tests
--------------------------------------------------------

In some cases, you may need to repeat a test multiple times for debugging purposes or to ensure that the test is stable. On these occasions, you may use the `repeat()` method to repeat a test a given number of times.

    1it('can repeat a test', function () {2    $result = /** Some code that may be unstable */;3 4    expect($result)->toBeTrue();5})->repeat(100); // Repeat the test 100 times

* * *

After becoming skilled at utilizing datasets for testing, the next crucial step is to gain an understanding of how to test for exceptions. This involves verifying that your code behaves correctly and throws appropriate exceptions when it encounters unexpected or erroneous input: [Exceptions →](/docs/exceptions)

---

## Editor Setup

[Edit this page →](https://github.com/pestphp/pestphp.com/edit/next/resources/views/ide.blade.php)

Editor Setup
============

An editor plugin can significantly enhance the developer experience when working with Pest PHP. Although most editors have built-in support for Pest PHP, plugins can offer additional functionalities that can streamline and simplify the development process.

Currently, the PhpStorm team at JetBrains is maintaining the Pest Plugin for PhpStorm. It is installed by default since PhpStorm 2023.3.

![PhpStorm logo](https://upload.wikimedia.org/wikipedia/commons/c/c9/PhpStorm_Icon.svg)

[PhpStorm](https://plugins.jetbrains.com/plugin/14636-pest) https://github.com/pestphp/pest-intellij

93,341 downloads

In case you do not utilize PHPStorm, you may consider experimenting with the community-maintained plugin. Nevertheless, it's worth noting that this alternative may not offer the same level of user experience as the official PHPStorm plugin.

![VSCode logo](https://upload.wikimedia.org/wikipedia/commons/9/9a/Visual_Studio_Code_1.35_icon.svg)

[VSCode](https://marketplace.visualstudio.com/items?itemName=m1guelpf.better-pest) https://github.com/m1guelpf/better-pest

43,787 downloads

![VSCode Snippets logo](https://raw.githubusercontent.com/dansysanalyst/pest-snippets/main/images/icon.png)

[VSCode Snippets](https://marketplace.visualstudio.com/items?itemName=dansysanalyst.pest-snippets) https://github.com/dansysanalyst/pest-snippets

30,729 downloads

![Neovim (via Neotest) logo](https://upload.wikimedia.org/wikipedia/commons/3/3a/Neovim-mark.svg)

[Neovim (via Neotest)](https://github.com/V13Axel/neotest-pest) https://github.com/V13Axel/neotest-pest

* * *

Once the installation process is complete, and your editor is ready, you can learn more about how to write tests visiting the next section of the documentation: [Writing Tests →](/docs/writing-tests)

---

## Exceptions

[Edit this page →](https://github.com/pestphp/docs/edit/master/exceptions.md)

[#](#content-exceptions "Permalink")Exceptions
==============================================

When testing behavior in PHP, you might need to check if an exception or error has been thrown. To create a test that expects an exception to be thrown, you can use the `throws()` method.

    1it('throws exception', function () {2    throw new Exception('Something happened.');3})->throws(Exception::class);

If you also want to make an assertion against the exception message, you may provide a second argument to the `throws()` method.

    1it('throws exception', function () {2    throw new Exception('Something happened.');3})->throws(Exception::class, 'Something happened.');

If the exception type is not relevant, and you're only concerned with the message, you can simply pass the message without specifying the exception's type.

    1it('throws exception', function () {2    throw new Exception('Something happened.');3})->throws('Something happened.');

You can use the `throwsIf()` method to conditionally verify an exception if a given boolean expression evaluates to true.

    1it('throws exception', function () {2    //3})->throwsIf(fn() => DB::getDriverName() === 'mysql', Exception::class, 'MySQL is not supported.');

Just like `throwsIf()` method, you can use the `throwsUnless()` method to conditionally verify an exception if a given boolean expression evaluates to false.

    1it('throws exception', function () {2    //3})->throwsUnless(fn() => DB::getDriverName() === 'mysql', Exception::class, 'Only MySQL is supported.');

You can also verify that a given closure throws one or more exceptions using the [toThrow()](/docs/expectations#expect-toThrow) method of the expectation API.

    1it('throws exception', function () {2    expect(fn() => throw new Exception('Something happened.'))->toThrow(Exception::class);3});

If you expect no exceptions to be thrown, you can use the `throwsNoExceptions()` method.

    1it('throws no exceptions', function () {2    $result = 1 + 1;3})->throwsNoExceptions();

Sometimes, you may want to simply mark a test as failed. You can use the `fail()` method to do so.

    1it('fail', function () {2    $this->fail();3});

You may also provide a message to the `fail()` method.

    1it('fail', function () {2    $this->fail('Something went wrong.');3});

In addition, you can also use the `fails()` method to verify the test fails.

    1it('fails', function () {2    throw new Exception('Something happened.');3})->fails();

Just like the `fail()` method, you may also provide a message to the `fails()` method.

    1it('fails', function () {2    throw new Exception('Something happened.');3})->fails('Something went wrong.');

* * *

After learning how to write tests that assert exceptions, the next step is to explore "Test Filtering". This feature allows you to efficiently run specific tests based on criteria like test name, dirty files, and more: [Filtering Tests →](/docs/filtering-tests)

---

## Expectations

[Edit this page →](https://github.com/pestphp/docs/edit/master/expectations.md)

[#](#content-expectations "Permalink")Expectations
==================================================

By setting expectations for your tests using the Pest expectation API, you can easily identify bugs and other issues in your code. This is because the API allows you to specify the expected outcome of a test, making it easy to detect any deviations from the expected behavior.

You can start the expectation by passing your value to the `expect($value)` function. The `expect()` function is used every time you want to test a value. You will rarely call `expect()` by itself. Instead, you will use `expect()` along with an "expectation" method to assert something about the value.

    1test('sum', function () {2    $value = sum(1, 2);3 4    expect($value)->toBe(3); // Assert that the value is 3...5});

As demonstrated, the expect function in Pest allows you to chain multiple expectations together for a given `$value`. This means that you can perform as many checks as necessary in a single test by simply continuing to chain additional expectations.

    1expect($value)2    ->toBeInt()3    ->toBe(3);

At any time, you may test the opposite of an expectation by prepending the `not` modifier to the expectation.

    1expect($value)2    ->toBeInt()3    ->toBe(3)4    ->not->toBeString() // Not to be string...5    ->not->toBe(4); // Not to be 4...

With the Pest expectation API, you have access to an extensive collection of individual expectations that are designed to test various aspects of your code. Below is a comprehensive list of the available expectations.

*   [`toBe()`](#expect-toBe)
*   [`toBeArray()`](#expect-toBeArray)
*   [`toBeBetween()`](#expect-toBeBetween)
*   [`toBeEmpty()`](#expect-toBeEmpty)
*   [`toBeTrue()`](#expect-toBeTrue)
*   [`toBeTruthy()`](#expect-toBeTruthy)
*   [`toBeFalse()`](#expect-toBeFalse)
*   [`toBeFalsy()`](#expect-toBeFalsy)
*   [`toBeGreaterThan()`](#expect-toBeGreaterThan)
*   [`toBeGreaterThanOrEqual()`](#expect-toBeGreaterThanOrEqual)
*   [`toBeLessThan()`](#expect-toBeLessThan)
*   [`toBeLessThanOrEqual()`](#expect-toBeLessThanOrEqual)
*   [`toContain()`](#expect-toContain)
*   [`toContainEqual()`](#expect-toContainEqual)
*   [`toContainOnlyInstancesOf()`](#expect-toContainOnlyInstancesOf)
*   [`toHaveCount()`](#expect-toHaveCount)
*   [`toHaveProperty()`](#expect-toHaveProperty)
*   [`toHaveProperties()`](#expect-toHaveProperties)
*   [`toMatchArray()`](#expect-toMatchArray)
*   [`toMatchObject()`](#expect-toMatchObject)
*   [`toEqual()`](#expect-toEqual)
*   [`toEqualCanonicalizing()`](#expect-toEqualCanonicalizing)
*   [`toEqualWithDelta()`](#expect-toEqualWithDelta)
*   [`toBeIn()`](#expect-toBeIn)
*   [`toBeInfinite()`](#expect-toBeInfinite)
*   [`toBeInstanceOf()`](#expect-toBeInstanceOf)
*   [`toBeBool()`](#expect-toBeBool)
*   [`toBeCallable()`](#expect-toBeCallable)
*   [`toBeFile()`](#expect-toBeFile)
*   [`toBeFloat()`](#expect-toBeFloat)
*   [`toBeInt()`](#expect-toBeInt)
*   [`toBeIterable()`](#expect-toBeIterable)
*   [`toBeNumeric()`](#expect-toBeNumeric)
*   [`toBeDigits()`](#expect-toBeDigits)
*   [`toBeObject()`](#expect-toBeObject)
*   [`toBeResource()`](#expect-toBeResource)
*   [`toBeScalar()`](#expect-toBeScalar)
*   [`toBeString()`](#expect-toBeString)
*   [`toBeJson()`](#expect-toBeJson)
*   [`toBeNan()`](#expect-toBeNan)
*   [`toBeNull()`](#expect-toBeNull)
*   [`toHaveKey()`](#expect-toHaveKey)
*   [`toHaveKeys()`](#expect-toHaveKeys)
*   [`toHaveLength()`](#expect-toHaveLength)
*   [`toBeReadableDirectory()`](#expect-toBeReadableDirectory)
*   [`toBeReadableFile()`](#expect-toBeReadableFile)
*   [`toBeWritableDirectory()`](#expect-toBeWritableDirectory)
*   [`toBeWritableFile()`](#expect-toBeWritableFile)
*   [`toStartWith()`](#expect-toStartWith)
*   [`toThrow()`](#expect-toThrow)
*   [`toEndWith()`](#expect-toEndWith)
*   [`toMatch()`](#expect-toMatch)
*   [`toMatchConstraint()`](#expect-toMatchConstraint)
*   [`toBeUppercase()`](#expect-toBeUppercase)
*   [`toBeLowercase()`](#expect-toBeLowercase)
*   [`toBeAlpha()`](#expect-toBeAlpha)
*   [`toBeAlphaNumeric()`](#expect-toBeAlphaNumeric)
*   [`toBeSnakeCase()`](#expect-toBeSnakeCase)
*   [`toBeKebabCase()`](#expect-toBeKebabCase)
*   [`toBeCamelCase()`](#expect-toBeCamelCase)
*   [`toBeStudlyCase()`](#expect-toBeStudlyCase)
*   [`toHaveSnakeCaseKeys()`](#expect-toHaveSnakeCaseKeys)
*   [`toHaveKebabCaseKeys()`](#expect-toHaveKebabCaseKeys)
*   [`toHaveCamelCaseKeys()`](#expect-toHaveCamelCaseKeys)
*   [`toHaveStudlyCaseKeys()`](#expect-toHaveStudlyCaseKeys)
*   [`toHaveSameSize()`](#expect-toHaveSameSize)
*   [`toBeUrl()`](#expect-toBeUrl)
*   [`toBeUuid()`](#expect-toBeUuid)

In addition to the individual expectations available in Pest, the expectation API also provides several modifiers that allow you to further customize your tests. These modifiers can be used to create more complex expectations and to test multiple values at once. Here are some examples of the modifiers available in Pest:

*   [`and()`](#expect-and)
*   [`dd()`](#expect-dd)
*   [`ddWhen()`](#expect-ddWhen)
*   [`ddUnless()`](#expect-ddUnless)
*   [`each()`](#expect-each)
*   [`json()`](#expect-json)
*   [`match()`](#match)
*   [`not`](#expect-not)
*   [`ray()`](#expect-ray)
*   [`sequence()`](#expect-sequence)
*   [`unless()`](#unless)
*   [`when()`](#when)

* * *

### [#](#content-tobe "Permalink")`toBe()`

This expectation ensures that both `$value` and `$expected` share the same type and value.

If used with objects, it ensures that both variables refer to the exact same object.

    1expect(1)->toBe(1);2expect('1')->not->toBe(1);3expect(new StdClass())->not->toBe(new StdClass());

### [#](#content-tobebetween "Permalink")`toBeBetween()`

This expectation ensures that `$value` is between 2 values. It works with `int`, `float` and `DateTime`.

    1expect(2)->toBeBetween(1, 3);2expect(1.5)->toBeBetween(1, 2);3 4$expectationDate = new DateTime('2023-09-22');5$oldestDate = new DateTime('2023-09-21');6$latestDate = new DateTime('2023-09-23');7 8expect($expectationDate)->toBeBetween($oldestDate, $latestDate);

### [#](#content-tobeempty "Permalink")`toBeEmpty()`

This expectation ensures that `$value` is empty.

    1expect('')->toBeEmpty();2expect([])->toBeEmpty();3expect(null)->toBeEmpty();

### [#](#content-tobetrue "Permalink")`toBeTrue()`

This expectation ensures that `$value` is true.

    1expect($isPublished)->toBeTrue();

### [#](#content-tobetruthy "Permalink")`toBeTruthy()`

This expectation ensures that `$value` is truthy.

    1expect(1)->toBeTruthy();2expect('1')->toBeTruthy();

### [#](#content-tobefalse "Permalink")`toBeFalse()`

This expectation ensures that `$value` is false.

    1expect($isPublished)->toBeFalse();

### [#](#content-tobefalsy "Permalink")`toBeFalsy()`

This expectation ensures that `$value` is falsy.

    1expect(0)->toBeFalsy();2expect('')->toBeFalsy();

### [#](#content-tobegreaterthanexpected "Permalink")`toBeGreaterThan($expected)`

This expectation ensures that `$value` is greater than `$expected`.

    1expect($count)->toBeGreaterThan(20);

### [#](#content-tobegreaterthanorequalexpected "Permalink")`toBeGreaterThanOrEqual($expected)`

This expectation ensures that `$value` is greater than or equal to `$expected`.

    1expect($count)->toBeGreaterThanOrEqual(21);

### [#](#content-tobelessthanexpected "Permalink")`toBeLessThan($expected)`

This expectation ensures that `$value` is lesser than `$expected`.

    1expect($count)->toBeLessThan(3);

### [#](#content-tobelessthanorequalexpected "Permalink")`toBeLessThanOrEqual($expected)`

This expectation ensures that `$value` is lesser than or equal to `$expected`.

    1expect($count)->toBeLessThanOrEqual(2);

### [#](#content-tocontainneedles "Permalink")`toContain($needles)`

This expectation ensures that all the given needles are elements of the `$value`.

    1expect('Hello World')->toContain('Hello');2expect('Pest: an elegant PHP Testing Framework')->toContain('Pest', 'PHP', 'Framework');3expect([1, 2, 3, 4])->toContain(2, 4);

### [#](#content-tocontainequalneedles "Permalink")`toContainEqual($needles)`

This expectation ensures that all the given needles are elements (in terms of equality) of the `$value`.

    1expect([1, 2, 3])->toContainEqual('1');2expect([1, 2, 3])->toContainEqual('1', '2');

### [#](#content-tocontainonlyinstancesofclass "Permalink")`toContainOnlyInstancesOf($class)`

This expectation ensures that `$value` contains only instances of `$class`.

    1$dates = [new DateTime(), new DateTime()];2 3expect($dates)->toContainOnlyInstancesOf(DateTime::class);

### [#](#content-tohavecountint-count "Permalink")`toHaveCount(int $count)`

This expectation ensures that the `$count` provided matches the number of elements in an iterable `$value`.

    1expect(['Nuno', 'Luke', 'Alex', 'Dan'])->toHaveCount(4);

### [#](#content-tohavepropertystring-name-value--null "Permalink")`toHaveProperty(string $name, $value = null)`

This expectation ensures that `$value` has a property named `$name`.

In addition, you can verify the actual value of a property by providing a second argument.

    1expect($user)->toHaveProperty('name');2expect($user)->toHaveProperty('name', 'Nuno');3expect($user)->toHaveProperty('is_active', 'true');

### [#](#content-tohavepropertiesiterable-name "Permalink")`toHaveProperties(iterable $name)`

This expectation ensures that `$value` has property names matching all the names contained in `$names`.

    1expect($user)->toHaveProperties(['name', 'email']);

In addition, you can verify the name and value of multiple properties using an associative array.

    1expect($user)->toHaveProperties([2    'name' => 'Nuno',3    'email' => '[email protected]'4]);

### [#](#content-tomatcharrayarray "Permalink")`toMatchArray($array)`

This expectation ensures that the `$value` array matches the given `$array` subset.

     1$user = [ 2    'id'    => 1, 3    'name'  => 'Nuno', 4    'email' => '[email protected]', 5    'is_active' => true, 6]; 7  8expect($user)->toMatchArray([ 9    'email' => '[email protected]',10    'name' => 'Nuno'11]);

### [#](#content-tomatchobjectobject "Permalink")`toMatchObject($object)`

This expectation ensures that the `$value` object matches a subset of the properties of a given `$object`.

    1$user = new stdClass();2$user->id = 1;3$user->email = '[email protected]';4$user->name = 'Nuno';5 6expect($user)->toMatchObject([7    'email' => '[email protected]',8    'name' => 'Nuno'9]);

### [#](#content-toequalexpected "Permalink")`toEqual($expected)`

This expectation ensures that `$value` and `$expected` have the same value.

    1expect($title)->toEqual('Hello World');2expect('1')->toEqual(1);3expect(new StdClass())->toEqual(new StdClass());

### [#](#content-toequalcanonicalizingexpected "Permalink")`toEqualCanonicalizing($expected)`

This expectation ensures that `$value` and `$expected` have the same values, no matter what order the elements are given in.

    1$usersAsc = ['Dan', 'Fabio', 'Nuno'];2$usersDesc = ['Nuno', 'Fabio', 'Dan'];3 4expect($usersAsc)->toEqualCanonicalizing($usersDesc);5expect($usersAsc)->not->toEqual($usersDesc);

### [#](#content-toequalwithdeltaexpected-float-delta "Permalink")`toEqualWithDelta($expected, float $delta)`

This expectation ensures that the absolute difference between `$value` and `$expected` is lower than `$delta`.

    1expect($durationInMinutes)->toEqualWithDelta(10, 5); //duration of 10 minutes with 5 minutes tolerance2 3expect(14)->toEqualWithDelta(10, 5);    // Pass4expect(14)->toEqualWithDelta(10, 0.1); // Fail

### [#](#content-tobein "Permalink")`toBeIn()`

This expectation ensures that `$value` is one of the given values.

    1expect($newUser->status)->toBeIn(['pending', 'new', 'active']);

### [#](#content-tobeinfinite "Permalink")`toBeInfinite()`

This expectation ensures that `$value` is infinite.

    1expect(log(0))->toBeInfinite();

### [#](#content-tobeinstanceofclass "Permalink")`toBeInstanceOf($class)`

This expectation ensures that `$value` is an instance of `$class`.

    1expect($user)->toBeInstanceOf(User::class);

### [#](#content-tobearray "Permalink")`toBeArray()`

This expectation ensures that `$value` is an array.

    1expect(['Pest','PHP','Laravel'])->toBeArray();

### [#](#content-tobebool "Permalink")`toBeBool()`

This expectation ensures that `$value` is of type bool.

    1expect($isActive)->toBeBool();

### [#](#content-tobecallable "Permalink")`toBeCallable()`

This expectation ensures that `$value` is of type callable.

    1$myFunction = function () {};2 3expect($myFunction)->toBeCallable();

### [#](#content-tobefile "Permalink")`toBeFile()`

This expectation ensures that the string `$value` is an existing file.

    1expect('/tmp/some-file.tmp')->toBeFile();

### [#](#content-tobefloat "Permalink")`toBeFloat()`

This expectation ensures that `$value` is of type float.

    1expect($height)->toBeFloat();

### [#](#content-tobeint "Permalink")`toBeInt()`

This expectation ensures that `$value` is of type integer.

    1expect($count)->toBeInt();

### [#](#content-tobeiterable "Permalink")`toBeIterable()`

This expectation ensures that `$value` is of type iterable.

    1expect($array)->toBeIterable();

### [#](#content-tobenumeric "Permalink")`toBeNumeric()`

This expectation ensures that `$value` is of type numeric.

    1expect($age)->toBeNumeric();2expect(10)->toBeNumeric();3expect('10')->toBeNumeric();

### [#](#content-tobedigits "Permalink")`toBeDigits()`

This expectation ensures that `$value` contains only digits.

    1expect($year)->toBeDigits();2expect(15)->toBeDigits();3expect('15')->toBeDigits();4expect(0.123)->not->toBeDigits();5expect('0.123')->not->toBeDigits();

### [#](#content-tobeobject "Permalink")`toBeObject()`

This expectation ensures that `$value` is of type object.

    1$object = new stdClass();2 3expect($object)->toBeObject();

### [#](#content-toberesource "Permalink")`toBeResource()`

This expectation ensures that `$value` is of type resource.

    1$handle = fopen('php://memory', 'r+');2 3expect($handle)->toBeResource();

### [#](#content-tobescalar "Permalink")`toBeScalar()`

This expectation ensures that `$value` is of type scalar.

    1expect('1')->toBeScalar();2expect(1)->toBeScalar();3expect(1.0)->toBeScalar();4expect(true)->toBeScalar();5expect([1, '1'])->not->toBeScalar();

### [#](#content-tobestring "Permalink")`toBeString()`

This expectation ensures that `$value` is of type string.

    1expect($string)->toBeString();

### [#](#content-tobejson "Permalink")`toBeJson()`

This expectation ensures that `$value` is a JSON string.

    1expect('{"hello":"world"}')->toBeJson();

### [#](#content-tobenan "Permalink")`toBeNan()`

This expectation ensures that `$value` is not a number (NaN).

    1expect(sqrt(-1))->toBeNan();

### [#](#content-tobenull "Permalink")`toBeNull()`

This expectation ensures that `$value` is null.

    1expect(null)->toBeNull();

### [#](#content-tohavekeystring-key "Permalink")`toHaveKey(string $key)`

This expectation ensures that `$value` contains the provided `$key`.

    1expect(['name' => 'Nuno', 'surname' => 'Maduro'])->toHaveKey('name');2expect(['name' => 'Nuno', 'surname' => 'Maduro'])->toHaveKey('name', 'Nuno');3expect(['user' => ['name' => 'Nuno', 'surname' => 'Maduro']])->toHaveKey('user.name');4expect(['user' => ['name' => 'Nuno', 'surname' => 'Maduro']])->toHaveKey('user.name', 'Nuno');

### [#](#content-tohavekeysarray-keys "Permalink")`toHaveKeys(array $keys)`

This expectation ensures that `$value` contains the provided `$keys`.

    1expect(['id' => 1, 'name' => 'Nuno'])->toHaveKeys(['id', 'name']);2expect(['message' => ['from' => 'Nuno', 'to' => 'Luke'] ])->toHaveKeys(['message.from', 'message.to']);

### [#](#content-tohavelengthint-number "Permalink")`toHaveLength(int $number)`

This expectation ensures that the provided `$number` matches the length of a string `$value` or the number of elements in an iterable `$value`.

    1expect('Pest')->toHaveLength(4);2expect(['Nuno', 'Maduro'])->toHaveLength(2);

### [#](#content-tobedirectory "Permalink")`toBeDirectory()`

This expectation ensures that the string `$value` is a directory.

    1expect('/tmp')->toBeDirectory();

### [#](#content-tobereadabledirectory "Permalink")`toBeReadableDirectory()`

This expectation ensures that the string `$value` is a directory and that it is readable.

    1expect('/tmp')->toBeReadableDirectory();

### [#](#content-tobereadablefile "Permalink")`toBeReadableFile()`

This expectation ensures that the string `$value` is a file and that it is readable.

    1expect('/tmp/some-file.tmp')->toBeReadableFile();

### [#](#content-tobewritabledirectory "Permalink")`toBeWritableDirectory()`

This expectation ensures that the string `$value` is a directory and that it is writable.

    1expect('/tmp')->toBeWritableDirectory();

### [#](#content-tobewritablefile "Permalink")`toBeWritableFile()`

This expectation ensures that the string `$value` is a file and that it is writable.

    1expect('/tmp/some-file.tmp')->toBeWritableFile();

### [#](#content-tostartwithstring-expected "Permalink")`toStartWith(string $expected)`

This expectation ensures that `$value` starts with the provided string.

    1expect('Hello World')->toStartWith('Hello');

### [#](#content-tothrow "Permalink")`toThrow()`

This expectation ensures that a closure throws a specific exception class, exception message, or both.

    1expect(fn() => throw new Exception('Something happened.'))->toThrow(Exception::class);2expect(fn() => throw new Exception('Something happened.'))->toThrow('Something happened.');3expect(fn() => throw new Exception('Something happened.'))->toThrow(Exception::class, 'Something happened.');4expect(fn() => throw new Exception('Something happened.'))->toThrow(new Exception('Something happened.'));

### [#](#content-tomatchstring-expression "Permalink")`toMatch(string $expression)`

This expectation ensures that `$value` matches a regular expression.

    1expect('Hello World')->toMatch('/^hello wo.*$/i');

### [#](#content-toendwithstring-expected "Permalink")`toEndWith(string $expected)`

This expectation ensures that `$value` ends with the provided string.

    1expect('Hello World')->toEndWith('World');

### [#](#content-tomatchconstraintconstraint-constraint "Permalink")`toMatchConstraint(Constraint $constraint)`

This expectation ensures that `$value` matches a specified PHPUnit constraint.

    1use PHPUnit\Framework\Constraint\IsTrue;2 3expect(true)->toMatchConstraint(new IsTrue());

### [#](#content-tobeuppercasestring-expected "Permalink")`toBeUppercase(string $expected)`

This expectation ensures that `$value` is uppercase.

    1expect('PESTPHP')->toBeUppercase();

### [#](#content-tobelowercasestring-expected "Permalink")`toBeLowercase(string $expected)`

This expectation ensures that `$value` is lowercase.

    1expect('pestphp')->toBeLowercase();

### [#](#content-tobealphastring-expected "Permalink")`toBeAlpha(string $expected)`

This expectation ensures that `$value` only contains alpha characters.

    1expect('pestphp')->toBeAlpha();

### [#](#content-tobealphanumericstring-expected "Permalink")`toBeAlphaNumeric(string $expected)`

This expectation ensures that `$value` only contains alphanumeric characters.

    1expect('pestPHP123')->toBeAlphaNumeric();

### [#](#content-tobesnakecase "Permalink")`toBeSnakeCase()`

This expectation ensures that `$value` only contains string in snake\_case format.

    1expect('snake_case')->toBeSnakeCase();

### [#](#content-tobekebabcase "Permalink")`toBeKebabCase()`

This expectation ensures that `$value` only contains string in kebab-case format.

    1expect('kebab-case')->toBeKebabCase();

### [#](#content-tobecamelcase "Permalink")`toBeCamelCase()`

This expectation ensures that `$value` only contains string in camelCase format.

    1expect('camelCase')->toBeCamelCase();

### [#](#content-tobestudlycase "Permalink")`toBeStudlyCase()`

This expectation ensures that `$value` only contains string in StudlyCase format.

    1expect('StudlyCase')->toBeStudlyCase();

### [#](#content-tohavesnakecasekeys "Permalink")`toHaveSnakeCaseKeys()`

This expectation ensures that `$value` only contains an array with keys in snake\_case format.

    1expect(['snake_case' => 'abc123'])->toHaveSnakeCaseKeys();

### [#](#content-tohavekebabcasekeys "Permalink")`toHaveKebabCaseKeys()`

This expectation ensures that `$value` only contains an array with keys in kebab-case format.

    1expect(['kebab-case' => 'abc123'])->toHaveKebabCaseKeys();

### [#](#content-tohavecamelcasekeys "Permalink")`toHaveCamelCaseKeys()`

This expectation ensures that `$value` only contains an array with keys in camelCase format.

    1expect(['camelCase' => 'abc123'])->toHaveCamelCaseKeys();

### [#](#content-tohavestudlycasekeys "Permalink")`toHaveStudlyCaseKeys()`

This expectation ensures that `$value` only contains an array with keys in StudlyCase format.

    1expect(['StudlyCase' => 'abc123'])->toHaveStudlyCaseKeys();

### [#](#content-tohavesamesize "Permalink")`toHaveSameSize()`

This expectation ensures that the size of `$value` and the provided iterable are the same.

    1expect(['foo', 'bar'])->toHaveSameSize(['baz', 'bazz']);

### [#](#content-tobeurl "Permalink")`toBeUrl()`

This expectation ensures that `$value` is a URL.

    1expect('https://pestphp.com/')->toBeUrl();

### [#](#content-tobeuuid "Permalink")`toBeUuid()`

This expectation ensures that `$value` is an UUID.

    1expect('ca0a8228-cdf6-41db-b34b-c2f31485796c')->toBeUuid();

* * *

### [#](#content-andvalue "Permalink")`and($value)`

The `and()` modifier allows you to pass a new `$value`, enabling you to chain multiple expectations in a single test.

    1expect($id)->toBe(14)2    ->and($name)->toBe('Nuno');

### [#](#content-dd "Permalink")`dd()`

The `dd()` modifier

Use the `dd()` modifier allows you to dump the current expectation `$value` and stop the code execution. This can be useful for debugging by allowing you to inspect the current state of the $value at a particular point in your test.

    1expect(14)->dd(); // 142expect([1, 2])->sequence(3    fn ($number) => $number->toBe(1),4    fn ($number) => $number->dd(), // 25);

### [#](#content-ddwhencondition "Permalink")`ddWhen($condition)`

Use the `ddWhen()` modifier allows you to dump the current expectation `$value` and stop the code execution when the given `$condition` is truthy.

    1expect([1, 2])->each(2    fn ($number) => $number->ddWhen(fn (int $number) => $number === 2) // 23);

### [#](#content-ddunlesscondition "Permalink")`ddUnless($condition)`

Use the `ddUnless()` modifier allows you to dump the current expectation `$value` and stop the code execution when the given `$condition` is falsy.

    1expect([1, 2])->each(2    fn ($number) => $number->ddUnless(fn (int $number) => $number === 1) // 23);

### [#](#content-each "Permalink")`each()`

The `each()` modifier allows you to create an expectation on each item of the given iterable. It works by iterating over the iterable and applying the expectation to each item.

    1expect([1, 2, 3])->each->toBeInt();2expect([1, 2, 3])->each->not->toBeString();3expect([1, 2, 3])->each(fn ($number) => $number->toBeLessThan(4));

### [#](#content-json "Permalink")`json()`

The `json()` modifier decodes the current expectation `$value` from JSON to an array.

    1expect('{"name":"Nuno","credit":1000.00}')2    ->json()3    ->toHaveCount(2)4    ->name->toBe('Nuno')5    ->credit->toBeFloat();6 7expect('not-a-json')->json(); //Fails

### [#](#content-match "Permalink")`match()`

The `match()` modifier executes the closure associated with the first array key that matches the value of the first argument given to the method.

    1expect($user->miles)2    ->match($user->status, [3        'new'  => fn ($userMiles) => $userMiles->ToBe(0),4        'gold'  => fn ($userMiles) => $userMiles->toBeGreaterThan(500),5        'platinum' => fn ($userMiles) => $userMiles->toBeGreaterThan(1000),6    ]);

To check if the expected value is equal to the value associated with the matching key, you can directly pass the expected value as the array value instead of using a closure.

    1expect($user->default_language)2    ->match($user->country, [3        'PT' => 'Português',4        'US' => 'English',5        'TR' => 'Türkçe',6    ]);

### [#](#content-not "Permalink")`not`

The `not` modifier allows to invert the subsequent expectation.

    1expect(10)->not->toBeGreaterThan(100);2expect(true)->not->toBeFalse();

### [#](#content-ray "Permalink")`ray()`

The `ray()` modifier allows you to debug the current `$value` with **[myray.app](https://myray.app/)**.

    1expect(14)->ray(); // 142expect([1, 2])->sequence(3    fn ($number) => $number->toBe(1),4    fn ($number) => $number->ray(), // 25);

### [#](#content-sequence "Permalink")`sequence()`

The `sequence()` modifier allows you to specify a sequential set of expectations for a single iterable.

    1expect([1, 2, 3])->sequence(2    fn ($number) => $number->toBe(1),3    fn ($number) => $number->toBe(2),4    fn ($number) => $number->toBe(3),5);

The `sequence()` modifier can also be used with associative iterables. Each closure in the sequence will receive two arguments: the first argument being the expectation for the value and the second argument being the expectation for the key.

    1expect(['hello' => 'world', 'foo' => 'bar', 'john' => 'doe'])->sequence(2    fn ($value, $key) => $value->toEqual('world'),3    fn ($value, $key) => $key->toEqual('foo'),4    fn ($value, $key) => $value->toBeString(),5);

The `sequence()` modifier can also be used to check if each value in the iterable matches a set of expected values. In this case, you can pass the expected values directly to the sequence() method instead of using closures.

    1expect(['foo', 'bar', 'baz'])->sequence('foo', 'bar', 'baz');

### [#](#content-when "Permalink")`when()`

The `when()` modifier runs the provided callback when the first argument passed to the method evaluates to true.

    1expect($user)2    ->when($user->is_verified === true, fn ($user) => $user->daily_limit->toBeGreaterThan(10))3    ->email->not->toBeEmpty();

### [#](#content-unless "Permalink")`unless()`

The `unless()` modifier runs the provided callback when the first argument passed to the method evaluates to false.

    1expect($user)2    ->unless($user->is_verified === true, fn ($user) => $user->daily_limit->toBe(10))3    ->email->not->toBeEmpty();

* * *

After learning how to write expectations, the next section in the documentation, "Hooks" covers useful functions like "beforeEach" and "afterEach" that can be used to set up preconditions and cleanup actions for your tests: [Hooks →](/docs/hooks)

---

## Filtering Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/filtering-tests.md)

[#](#content-test-filtering "Permalink")Test Filtering
======================================================

When you run `./vendor/bin/pest`, Pest executes the complete test suite by default. As you might expect, running individual tests is accomplished by passing the test name as the first argument.

    1./vendor/bin/pest tests/Unit/TestExample.php

This chapter will cover even more ways to filter which tests are executed by Pest. For the complete CLI API Reference, please refer to our [CLI API Reference](/docs/cli-api-reference).

*   [`--bail`](#bail)
*   [`--dirty`](#dirty)
*   [`--filter`](#filter)
*   [`--group`](#group)
*   [`--exclude-group`](#exclude-group)
*   [`--retry`](#retry)
*   [`only()`](#only)

### [#](#content---bail "Permalink")`--bail`

The `--bail` option instructs Pest to stop executing your test suite upon encountering the first failure or error.

    1./vendor/bin/pest --bail

### [#](#content---dirty "Permalink")`--dirty`

The `--dirty` option instructs Pest to only run tests that have uncommitted changes according to Git. This is often useful when you're developing a set of tests for a new feature and don't want to run the entire test suite each time Pest is invoked.

    1./vendor/bin/pest --dirty

> Note that, due to a limitation in Pest, test cases written using the PHPUnit syntax will always be considered dirty.

### [#](#content---filter "Permalink")`--filter`

Using the `--filter` option, it is possible to run tests that match a specified regular expression pattern. The `--filter` option allows you to filter tests based on any information that would typically appear in the test's output description, such as the filename, test description, dataset parameters, and more.

    1./vendor/bin/pest --filter "test description"

### [#](#content---group "Permalink")`--group`

You can utilize the `--group` option to selectively run tests belonging to a particular group. To learn about assigning a tests or folders to groups, please refer to the [Grouping Tests](/docs/grouping-tests) documentation.

    1./vendor/bin/pest --group=integration,browser

### [#](#content---exclude-group "Permalink")`--exclude-group`

The `--exclude-group` option may be used to exclude specific test groups from being executed.

    1./vendor/bin/pest --exclude-group=integration,browser

### [#](#content---retry "Permalink")`--retry`

If a test previously failed, you typically want to sort the failed tests by arranging the test suite to run them first. In such cases, you can use the `--retry` option.

The `--retry` flag reorders your test suites by prioritizing the previously failed tests. If there were no past failures, the suite runs as usual. But if there were previous failures, those tests are run first.

> Note: Keep in mind that if your `phpunit.xml` file has two test suites (usually Unit and Feature), this option will sort each suite by running the failed tests first. This means that sometimes, you may see the entire Unit test suite run before Pest runs the Feature test suite, where previously failed tests take priority.

    1./vendor/bin/pest --retry

### [#](#content-only "Permalink")`only()`

If you want to run a specific test in your test suite, you can use the `only()` method.

    1test('sum', function () {2  $result = sum(1, 2);3 4  expect($result)->toBe(3);5})->only();

* * *

As your codebase grows, manually running your tests with filtering can become tedious. That's where skipping tests comes in. Skipping tests is a useful feature that allows developers to exclude specific tests from the test suite temporarily without deleting them entirely: [Skipping Tests →](/docs/skipping-tests)

---

## Global Hooks

[Edit this page →](https://github.com/pestphp/docs/edit/master/global-hooks.md)

[#](#content-global-hooks "Permalink")Global Hooks
==================================================

As previously discussed, hooks allow you to simplify your testing process and automate repetitive tasks that you may perform before or after a test. However, if the hooks are the same across multiple test files, you may wish to define "global" hooks to avoid code duplication. Global hooks are defined in your `Pest.php` configuration file.

For instance, if you need to perform some database operations before each test within the `Feature` folder, you may use the `beforeEach()` hook within your `Pest.php` configuration file.

    1pest()->extend(TestCase::class)->beforeEach(function () {2    // Interact with your database...3})->group('integration')->in('Feature');

In addition, you can define global hooks that will run before or after your entire test suite, regardless of the folder or group.

    1pest()->beforeEach(function () {2    // Interact with your database...3});

In fact, any of the hooks mentioned in the [hooks](/docs/hooks) documentation can also be used in your `Pest.php` configuration file.

    1pest()->extend(TestCase::class)->beforeAll(function () {2    // Runs before each file...3})->beforeEach(function () {4    // Runs before each test...5})->afterEach(function () {6    // Runs after each test...7})->afterAll(function () {8    // Runs after each file...9})->group('integration')->in('Feature');

Any `before*` hooks defined in the `Pest.php` configuration file will be executed prior to hooks defined in individual test files. Similarly, any `after*` hooks specified in the `Pest.php` configuration file will be executed after any hooks defined in individual test files.

* * *

When setting up a test suite, it may be necessary to mock certain functionality or objects in order to isolate the code being tested and to simulate certain conditions or behaviors. This can be done through the use of mocking libraries or frameworks, such as Mockery: [Mocking](/docs/mocking)

---

## Grouping Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/grouping-tests.md)

[#](#content-grouping-tests "Permalink")Grouping Tests
======================================================

You can assign tests folders to various groups using Pest's `group()` method. Assigning a group to a set of relatively slow tests could be beneficial since it allows you to selectively execute them separately from the rest of your test suite. Typically, the process of assigning a set of tests to a group is done within your `Pest.php` configuration file.

For instance, consider the scenario where we assign the tests located in the `tests/Feature` folder to a group named "feature".

    1pest()->extend(TestCase::class)2    ->group('feature')3    ->in('Feature');

As previously stated in the [Filtering Tests](/docs/filtering-tests) documentation, you can use the `--group` option to execute tests belonging to a specific group.

    1./vendor/bin/pest --group=feature

You also have the option to assign a particular test to a group by chaining the `group()` method onto the test function.

    1it('has home', function () {2    //3})->group('feature');

You may also assign a test to multiple groups.

    1it('has home', function () {2    //3})->group('feature', 'browser');

If you want to assign a group to a describe block, you can do so by chaining the `group()` method onto the describe function.

    1describe('home', function () {2    test('main page', function () {3        //4    });5})->group('feature');

In some cases, you may want to assign a whole file to a group. To do so, you may use the `pest()->group()` method within the file.

    1pest()->group('feature');2 3it('has home', function () {4    //5});

* * *

When you are setting up a test suite, it may be necessary to share common hooks between different folders and groups. In such cases, Global Hooks can prove to be helpful: [Global Hooks](/docs/global-hooks)

---

## Higher Order Testing

[Edit this page →](https://github.com/pestphp/docs/edit/master/higher-order-testing.md)

[#](#content-higher-order-testing "Permalink")Higher Order Testing
==================================================================

Although "High Order Testing" may appear to be a complex term, it is actually a technique that simplifies your tests and it is entirely optional. One of the core philosophies of Pest is to encourage users to care about the beauty and simplicity of their test suite, just as they do about their source code. Therefore, you might find this technique intriguing and choose to adopt it in certain parts of your code.

Let's consider an example that demonstrates how to migrate an existing test to high order testing. To illustrate, we will use a simple test.

    1it('works', function () {2    $this->get('/')3        ->assertStatus(200);4});

Based on this example, you can see that the entire content of the test is chained calls made on the `$this` variable. In such cases, it is possible to eliminate the test closure entirely and chain the required methods together directly to the `it()` function.

    1it('works')2    ->get('/')3    ->assertStatus(200);

The technique of removing the closure function and directly chaining the methods of the test body to the `test()` or `it()` functions is commonly referred to as "High Order Testing". This approach can significantly simplify the code of your test suite.

This technique can also be combined with the [expectation API](/docs/expectations). Let's look at a test where the expectation API is used to verify that a user was created with the correct name.

    1it('has a name', function () {2    $user = User::create([3        'name' => 'Nuno Maduro',4    ]);5 6    expect($user->name)->toBe('Nuno Maduro');7});

If your test contains only one expectation, we can simplify it using high-order testing.

    1it('has a name')2    ->expect(fn () => User::create(['name' => 'Nuno Maduro'])->name)3    ->toBe('Nuno Maduro');

It is crucial to use lazy evaluation for the expectation value by passing a closure to the `expect()` method. This ensures that the expected value is created only when the test runs and not before.

If you need to make assertions on an object that requires lazy evaluation at runtime, you can use the `defer()` method.

    1it('creates admins')2    ->defer(fn () => $this->artisan('user:create --admin'))3    ->assertDatabaseHas('users', ['id' => 1]);

In the example above, the `assertDatabaseHas()` assertion method will be called on the result of the closure passed to the `defer()` method.

The principles of high-order testing can also be applied to hooks. This means that if the body of your hook consists of a sequence of methods chained to the `$this` variable, you can simply chain those methods to the hook method and omit the closure entirely.

    1beforeEach(function () {2    $this->withoutMiddleware();3});4 5// Can be rewritten as...6beforeEach()->withoutMiddleware();

When using higher order testing, dataset values are passed to the `expect()` and `defer()` closures for convenience.

    1it('validates emails')2    ->with(['[email protected]', '[email protected]'])3    ->expect(fn (string $email) => Validator::isValid($email))4    ->toBeTrue();

[#](#content-higher-order-expectations "Permalink")Higher Order Expectations
----------------------------------------------------------------------------

With Higher Order Expectations, you can perform expectations directly on the `properties` or `methods` of the expectation `$value`.

For example, imagine you're testing that a user was created successfully and a variety of attributes have been stored in the database. Your test might look something like this:

    1expect($user->name)->toBe('Nuno');2expect($user->surname)->toBe('Maduro');3expect($user->addTitle('Mr.'))->toBe('Mr. Nuno Maduro');

To utilize Higher Order Expectations, you can simply chain the properties and methods directly to the `expect()` function, and Pest will take care of retrieving the property value or calling the method on the `$value` under test.

Now, let's see the same test refactored to Higher Order Expectations.

    1expect($user)2    ->name->toBe('Nuno')3    ->surname->toBe('Maduro')4    ->addTitle('Mr.')->toBe('Mr. Nuno Maduro');

When working with arrays, you may also access the `$value` array keys and perform expectations on them.

    1expect(['name' => 'Nuno', 'projects' => ['Pest', 'OpenAI', 'Laravel Zero']])2    ->name->toBe('Nuno')3    ->projects->toHaveCount(3)4    ->each->toBeString();5 6expect(['Dan', 'Luke', 'Nuno'])7    ->{0}->toBe('Dan');

Higher Order Expectations can be used with all [Expectations](/docs/expectations), and you may even create further Higher Order Expectations within closures.

    1expect(['name' => 'Nuno', 'projects' => ['Pest', 'OpenAI', 'Laravel Zero']])2    ->name->toBe('Nuno')3    ->projects->toHaveCount(3)4    ->sequence(5        fn ($project) => $project->toBe('Pest'),6        fn ($project) => $project->toBe('OpenAI'),7        fn ($project) => $project->toBe('Laravel Zero'),8    );

[#](#content-scoped-higher-order-expectations "Permalink")Scoped Higher Order Expectations
------------------------------------------------------------------------------------------

With Scoped Higher Order Expectations, you may use the method `scoped()` and a closure to gain access and lock an expectation in to a certain level in the chain.

This is very useful for Laravel Eloquent models, where you want to check properties of a child relation.

    1expect($user)2->name->toBe('Nuno')3->email->toBe('[email protected]')4->address()->scoped(fn ($address) => $address5    ->line1->toBe('1 Pest Street')6    ->city->toBe('Lisbon')7    ->country->toBe('Portugal')8);

* * *

Although higher order testing may appear complicated, it is a technique that can significantly simplify your test suite's code. In the next section, we will discuss Pest's community video resources: [Video Resources](/docs/video-resources)

---

## Hooks

[Edit this page →](https://github.com/pestphp/docs/edit/master/hooks.md)

[#](#content-hooks "Permalink")Hooks
====================================

Pest hooks are similar to the steps that you might take when preparing a meal - first, you gather and prepare the ingredients, then you cook the meal, and finally, you clean up after yourself. In the same way, hooks allow you to perform specific actions before and after each test or file, such as setting up test data, initializing the test environment, or cleaning up resources after the tests are complete.

By using hooks in Pest, you can streamline your testing process, automate repetitive tasks. Whether you're writing unit tests for a small project or building a complex test suite for a large application, hooks can help you save time and improve the quality of your tests.

In addition, if you wish to run a hook only for a specific group of tests, you may include the hook within a `describe()` function.

     1beforeEach(function () { 2    // 3}); 4  5describe('something', function () { 6    beforeEach(function () { 7        // 8    }); 9 10    //11 12    describe('something else', function () {13        beforeEach(function () {14            //15        });16 17        //18    });19});20 21test('something', function () {22    //23});

Here's a list of the hooks that are available in Pest:

*   [`beforeEach()`](#beforeeach)
*   [`afterEach()`](#aftereach)
*   [`beforeAll()`](#beforeall)
*   [`afterAll()`](#afterall)

[#](#content-beforeeach "Permalink")`beforeEach()`
--------------------------------------------------

Executes the provided closure before every test within the current file, ensuring that any necessary setup or configuration is completed before each test.

    1beforeEach(function () {2    // Prepare something before each test run...3});

When using the `beforeEach()` hook, it's possible to initialize properties that will be shared across all tests within the current file. For example, you could use `beforeEach()` to initialize the `$repository` property before each test is run, ensuring that it's available for subsequent tests in the file.

    1beforeEach(function () {2    $this->userRepository = new UserRepository();3});4 5it('may be created', function () {6    $user = $this->userRepository->create();7 8    expect($user)->toBeInstanceOf(User::class);9});

[#](#content-aftereach "Permalink")`afterEach()`
------------------------------------------------

Executes the provided closure after every test within the current file, allowing you to clean up any resources or state that may have been modified during testing.

    1afterEach(function () {2    // Clear testing data after each test run...3});

So, using the example above, if the `beforeEach()` hook is used to initialize the `$userRepository` property, the `afterEach()` hook may be used to "clean" it after each test if necessary. This ensures that any resources the object may be using are released or reset between tests, preventing any interference or unwanted behavior.

    1afterEach(function () {2    $this->userRepository->reset();3});

Optionally, you can use the `after()` method to perform clean-up tasks after a specific test. This is useful when you need to clean up resources that are specific to a single test, rather than shared across all tests in the file.

    1it('may be created', function () {2    $this->userRepository->create();3 4    expect($user)->toBeInstanceOf(User::class);5})->after(function () {6    $this->userRepository->reset();7});

[#](#content-beforeall "Permalink")`beforeAll()`
------------------------------------------------

Executes the provided closure once before any tests are run within the current file, allowing you to perform any necessary setup or initialization that applies to all tests.

    1beforeAll(function () {2    // Prepare something once before any of this file's tests run...3});

It's important to note that unlike the `beforeEach()` hook, the `$this` variable is not available in the `beforeAll()` hook. This is because the hook runs before any tests are executed, so there is no instance of the test class or object to which the variable could refer.

[#](#content-afterall "Permalink")`afterAll()`
----------------------------------------------

Executes the provided closure once after all tests have completed within the current file, allowing you to perform any necessary clean-up or tear-down tasks.

    1afterAll(function () {2    // Clean testing data after all tests run...3});

Just like the `beforeAll()` method, the `$this` variable is not available in the `afterAll()` hook. This is because the `afterAll()` hook typically runs after all tests in the file have completed, so there is no longer a test instance or object to which the variable could refer.

* * *

Once you've mastered using hooks to set up preconditions and clean-up actions for your tests, we're ready to discuss "Datasets", which allow you to run the same test with different inputs or parameters. Datasets can be used to thoroughly test your code under a variety of conditions and edge cases, letting you identify and fix bugs that may not be immediately obvious: [Datasets →](/docs/datasets)

---

## Installation

[Edit this page →](https://github.com/pestphp/docs/edit/master/installation.md)

[#](#content-installation "Permalink")Installation
==================================================

> **Requirements:** [PHP 8.2+](https://php.net/releases/)

Installing Pest PHP Testing Framework is a simple process that can be completed in just a few steps. Before you begin, make sure you have PHP `8.2+` or higher installed on your system.

**The first step** is to require Pest as a "dev" dependency in your project by running the following commands on your command line.

    1composer remove phpunit/phpunit2composer require pestphp/pest --dev --with-all-dependencies

**Secondly**, you'll need to initialize Pest in your current PHP project. This step will create a configuration file named `Pest.php` at the root level of your test suite, which will enable you to fine-tune your test suite later.

    1./vendor/bin/pest --init

**Finally**, you can run your tests by executing the `pest` command.

    1./vendor/bin/pest

Here is an example of the output displayed when running Pest in a new, fresh project.

![](/assets/img/pestinstall.webp?1)

**Optionally**, if you are migrating from PHPUnit, you can use the `pest-plugin-drift` package to automatically convert your PHPUnit tests to Pest. For more information, check out the [Migrating from PHPUnit](/docs/migrating-from-phpunit-guide) guide.

* * *

After the installation process is finished, you can enhance your developer experience while working with Pest by configuring your editor: [Editor Setup →](/docs/editor-setup). If you're migrating from PHPUnit, check out the [Migration Guide →](/docs/migrating-from-phpunit-guide).

---

## Migrating From Phpunit Guide

[Edit this page →](https://github.com/pestphp/docs/edit/master/migrating-from-phpunit-guide.md)

[#](#content-migrating-from-phpunit "Permalink")Migrating from PHPUnit
======================================================================

Pest is built on top of PHPUnit, so migrating from PHPUnit to Pest is a simple process that can be completed in just a few steps. Once you have Pest installed, you should require the `pestphp/pest-plugin-drift` package as a "dev" dependency in your project.

    1composer require pestphp/pest-plugin-drift --dev

Drift is a simple yet powerful plugin that will automatically convert your PHPUnit tests to Pest, simply by running the `--drift` option.

    1./vendor/bin/pest --drift

So, typically, a PHPUnit test looks like this:

     1<?php 2  3namespace Tests\Unit; 4  5use PHPUnit\Framework\TestCase; 6  7class ExampleTest extends TestCase 8{ 9    public function test_that_true_is_true(): void10    {11        $this->assertTrue(true);12    }13}

Should look like this after running `--drift`:

    1test('true is true', function () {2    expect(true)->toBeTrue();3});

* * *

[#](#content-convert-phpunit-tests-only-for-certain-folder "Permalink")Convert Phpunit tests only for certain folder
--------------------------------------------------------------------------------------------------------------------

If you want to convert Phpunit tests only for certain folder, you can pass _path_ as first argument when calling `--drift`:

Example call, if you want to run the conversion for folder `/tests/Helpers`:

    1/vendor/bin/pest --drift tests/Helpers

Output:

    1/vendor/bin/pest --drift tests/Helpers23✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔45INFO  The [tests/Helpers] directory has been migrated to PEST with XY files changed.

* * *

The output will contain a summary of the conversion process, as well as a list of the files that were converted.

While most of your tests should be converted automatically, and you should be able to run them without any issues, there are some cases where you may need to manually convert some of your tests.

* * *

Of course, this particular chapter is only for those who are migrating from PHPUnit. Next, let's learn how you can contribute to the growth of Pest: [Community Guide](/docs/community-guide)

---

## Mocking

[Edit this page →](https://github.com/pestphp/docs/edit/master/mocking.md)

[#](#content-mocking "Permalink")Mocking
========================================

> **Requirements:** [Mockery 1.0+](https://github.com/mockery/mockery/)

When testing your applications, you may want to "mock" specific classes to prevent them from actually being invoked during a particular test. For instance, if your application interacts with an API that initiates a payment, you likely want to "mock" the API client locally to prevent the actual payment from being made.

Before getting started, you will need to install a mocking library. We recommend [Mockery](https://github.com/mockery/mockery/), but you are free to choose any other library that suits your needs.

To begin using Mockery, require it using the Composer package manager.

    1composer require mockery/mockery --dev

While comprehensive documentation for Mockery can be found on the [Mockery website](https://docs.mockery.io), this section will discuss the most common use cases for mocking.

[#](#content-method-expectations "Permalink")Method Expectations
----------------------------------------------------------------

Mock objects are essential for isolating the code being tested and simulating specific behaviors or conditions from other pieces of the application. After creating a mock using the `Mockery::mock()` method, we can indicate that we expect a certain method to be invoked by calling the `shouldReceive()` method.

     1use App\Repositories\BookRepository; 2use Mockery; 3  4it('may buy a book', function () { 5    $client = Mockery::mock(PaymentClient::class); 6    $client->shouldReceive('post'); 7  8    $books = new BookRepository($client); 9    $books->buy(); // The API is not actually invoked since `$client->post()` has been mocked...10});

It is possible to mock multiple method calls using the same syntax shown above.

    1$client->shouldReceive('post');2$client->shouldReceive('delete');

[#](#content-argument-expectations "Permalink")Argument Expectations
--------------------------------------------------------------------

In order to make our expectations for a method more specific, we can use constraints to limit the expected argument list for a method call. This can be done by utilizing the `with()` method, as demonstrated in the following example.

    1$client->shouldReceive('post')2    ->with($firstArgument, $secondArgument);

In order to increase the flexibility of argument matching, Mockery provides built-in matcher classes that can be used in place of specific values. For example, instead of using specific values, we can use `Mockery::any()` to match any argument.

    1$client->shouldReceive('post')2    ->with($firstArgument, Mockery::any());

It is important to note that expectations defined using `shouldReceive()` and `with()` only apply when the method is invoked with the exact arguments that you expected. Otherwise, Mockery will throw an exception.

    1$client->shouldReceive('post')->with(1);2 3$client->post(2); // fails, throws a `NoMatchingExpectationException`

In certain cases, it may be more appropriate to use a closure to match all passed arguments simultaneously, rather than relying on built-in matchers for each individual argument. The `withArgs()` method accepts a closure that receives all of the arguments passed to the expected method call. As a result, this expectation will only be applied to method calls in which the passed arguments cause the closure to evaluate to true.

    1$client->shouldReceive('post')->withArgs(function ($arg) {2    return $arg === 1;3});4 5$client->post(1); // passes, matches the expectation6$client->post(2); // fails, throws a `NoMatchingExpectationException`

[#](#content-return-values "Permalink")Return Values
----------------------------------------------------

When working with mock objects, we can use the `andReturn()` method to tell Mockery what to return from the mocked methods.

    1$client->shouldReceive('post')->andReturn('post response');

We can define a sequence of return values by passing multiple return values to the `andReturn()` method.

    1$client->shouldReceive('post')->andReturn(1, 2);2 3$client->post(); // int(1)4$client->post(); // int(2)

Sometimes, we may need to calculate the return results of method calls based on the arguments passed to the method. This can be accomplished using the `andReturnUsing()` method, which accepts one or more closures.

    1$mock->shouldReceive('post')2    ->andReturnUsing(3        fn () => 1,4        fn () => 2,5    );

In addition, we can instruct mocked methods to throw exceptions.

    1$client->shouldReceive('post')->andThrow(new Exception);

[#](#content-method-call-count-expectations "Permalink")Method Call "Count" Expectations
----------------------------------------------------------------------------------------

Along with specifying expected arguments and return values for method calls, we can also set expectations for how many times a particular method should be invoked.

    1$mock->shouldReceive('post')->once();2$mock->shouldReceive('put')->twice();3$mock->shouldReceive('delete')->times(3);4// ...

To specify a minimum number of times a method should be called, we may use the `atLeast()` method.

    1$mock->shouldReceive('delete')->atLeast()->times(3);

Mockery's `atMost()` method allows us to specify the maximum number of times a method can be called.

    1$mock->shouldReceive('delete')->atMost()->times(3);

* * *

The primary objective of this section is to provide you with an introduction to Mockery, the mocking library we prefer. However, for a more comprehensive understanding of Mockery, we suggest checking out its [official documentation](https://docs.mockery.io). Next, let's explore Pest's plugins and discover how they can enhance your Pest experience: [Plugins](/docs/plugins)

---

## Mutation Testing

[Edit this page →](https://github.com/pestphp/docs/edit/master/mutation-testing.md)

[#](#content-mutation-testing "Permalink")Mutation Testing
==========================================================

*   **[Get Started](#get-started)**
*   **[Tested Vs Untested Mutations](#tested-vs-untested-mutations)**
*   **[Minimum Threshold Enforcement](#minimum-threshold-enforcement)**
*   **[Options & Modifiers](#options-and-modifiers)**

[#](#content-get-started "Permalink")Get Started
------------------------------------------------

**Requires [XDebug 3.0+](https://xdebug.org/docs/install/)** or [PCOV](https://github.com/krakjoe/pcov).

Mutation Testing is an innovative new technique that introduces small changes (mutations) to your code to see if your tests catch them. This ensures you’re testing your application thoroughly, beyond just achieving code coverage and more about the actual quality of the tests. It’s a great way to identify weaknesses in your test suite and improve quality.

To get started with mutation testing, head over to your test file, and be specific about which part of your code your test covers using the `covers()` function or the `mutates` function.

    1covers(TodoController::class); // or mutates(TodoController::class);2 3it('list todos', function () {4    $this->getJson('/todos')->assertStatus(200);5});

Both the `covers` and `mutates` functions are identical when it comes to mutation testing. However, `covers` also affects the code coverage report. If provided, it filters the code coverage report to include only the executed code from the referenced code parts.

Then, run Pest PHP with the `--mutate` option to start mutation testing. Ideally, using the `--parallel` option to speed up the process.

    1./vendor/bin/pest --mutate2# or in parallel...3./vendor/bin/pest --mutate --parallel

Pest will then re-run your tests against "mutated" code and see if the tests are still passing. If a test is still passing against a mutation, it means that the test is not covering that specific part of the code. As, as result, Pest will output the mutation and the diff of the code.

     1UNTESTED  app/Http/TodoController.php  > Line 44: ReturnValue - ID: 76d17ad63bb7c307 2  3class TodoController { 4    public function index(): array 5    { 6         // pest detected that this code is untested because 7         // the test is not covering the return value 8-        return Todo::all()->toArray(); 9+        return [];10    }11}12 13  Mutations: 1 untested14  Score:     33.44%

Once you have identified the untested code, you can write additional tests to cover it.

    1covers(TodoController::class);2 3it('list todos', function () {4+    Todo::factory()->create(['name' => 'Buy milk']);5 6-    $this->getJson('/todos')->assertStatus(200);7+    $this->getJson('/todos')->assertStatus(200)->assertJson([['name' => 'Buy milk']]);8});

Then, you can re-run Pest with the `--mutate` option to see if the mutation is now "tested" and covered.

    1Mutations: 1 tested2Score:     100.00%

The higher the mutation score, the better your test suite is. A mutation score of 100% means that all mutations were "tested", which is the goal of mutation testing.

Now, if you see "untested" or "uncovered" mutations, or are a mutation score below 100%, typically means that you have **missing tests** or that **your tests are not covering all the edge cases**.

Our plugin is deeply integrated into Pest PHP. So, each time a mutation is introduced, Pest PHP will:

*   **Only run the tests covering the mutated code** to speed up the process.
*   **Cache as much as possible** to speed up the process on subsequent runs.
*   If enabled, use **parallel execution to run multiple tests** in parallel to speed up the process.

[#](#content-tested-vs-untested-mutations "Permalink")Tested Vs Untested Mutations
----------------------------------------------------------------------------------

When running mutation testing, you will "mainly" see two types of mutations: **tested** and **untested** mutations.

*   **Tested Mutations**: These are mutations that were detected by your test suite. They are considered "tested" because your tests were able to catch the changes introduced by the mutation.

As example, the following mutation is considered "tested" because the test suite was able to detect the change.

     1class TodoController 2{ 3    public function index(): array 4    { 5-        return Todo::all()->toArray(); 6+        return []; 7    } 8} 9 10it('list todos', function () {11    Todo::factory()->create(['name' => 'Buy milk']);12 13    // this fails because the mutation changed the return value, proving that the test is working and testing the return value...14    $this->getJson('/todos')->assertStatus(200)->assertJsonContains([15        ['name' => 'Buy milk'],16    ]);17});

*   **Untested Mutations**: These are mutations that were not detected by your test suite. They are considered "untested" because your tests were not able to catch the changes introduced by the mutation.

As example, the following mutation is considered "untested" because the test suite was not able to detect the change.

     1class TodoController 2{ 3    public function index(): array 4    { 5-        return Todo::all()->toArray(); 6+        return []; 7    } 8} 9 10it('list todos', function () {11    Todo::factory()->create(['name' => 'Buy milk']);12 13    // this test still passes even though the return value was changed by the mutation...14    $this->getJson('/todos')->assertStatus(200);15});

Changing the return value is only one of many possible mutations. Typically, a mutation can be a change in the return value, a change in the method call, a change in the method arguments, and so on.

[#](#content-minimum-threshold-enforcement "Permalink")Minimum Threshold Enforcement
------------------------------------------------------------------------------------

To ensure comprehensive testing and maintain testing quality, it is crucial to set minimum threshold values for mutation testing results. In Pest, you can use the `--mutation` and `--min` options to define the minimum threshold values for mutation testing score results. If the specified thresholds are not met, Pest will report a failure.

    1./vendor/bin/pest --mutate --min=40

![](/assets/mutation-testing-min.png)

[#](#content-options--modifiers "Permalink")Options & Modifiers
---------------------------------------------------------------

The following options and modifiers are available when running mutation testing.

*   [`@pest-mutate-ignore`](#pest-mutate-ignore)
*   [`--id`](#id)
*   [`--everything`](#everything)
*   [`--covered-only`](#covered-only)
*   [`--bail`](#bail)
*   [`--class`](#class)
*   [`--ignore`](#ignore)
*   [`--clear-cache`](#clear-cache)
*   [`--no-cache`](#no-cache)
*   [`--ignore-min-score-on-zero-mutations`](#ignore-min-score-on-zero-mutations)
*   [`--profile`](#profile)
*   [`--retry`](#retry)
*   [`--stop-on-uncovered`](#stop-on-uncovered)
*   [`--stop-on-untested`](#stop-on-untested)

### [#](#content-pest-mutate-ignore "Permalink")`@pest-mutate-ignore`

Ignore the given line of code when generating mutations.

    1public function rules(): array2{3    return [4        'name' => 'required',5        'email' => 'required|email', // @pest-mutate-ignore6    ];7}

### [#](#content---id "Permalink")`--id`

Run only the mutation with the given ID. Note, you need to provide the same options as the original run.

    1./vendor/bin/pest --mutate --id=ecb35ab30ffd3491

### [#](#content---everything "Permalink")`--everything`

Generate mutations for all your project's classes, bypassing the `covers()` method. This option is very resource-intensive and should be used combined with the `--covered-only` option.

    1./vendor/bin/pest --mutate --everything --parallel --covered-only

Ideally, you would also combine the `--parallel` option to speed up the process.

### [#](#content---covered-only "Permalink")`--covered-only`

Only generate mutations in the lines of code that are covered by tests.

    1./vendor/bin/pest --mutate --covered-only

### [#](#content---bail "Permalink")`--bail`

Stop mutation testing execution upon the first untested or uncovered mutation.

    1./vendor/bin/pest --mutate --bail

### [#](#content---class "Permalink")`--class`

Generate mutations for the given class(es). E.g. `--class=App\Models`.

    1 2./vendor/bin/pest --mutate --class=App\Models

### [#](#content---ignore "Permalink")`--ignore`

Ignore the given class(es) when generating mutations. E.g. `--ignore=App\Http\Requests`.

    1./vendor/bin/pest --mutate --ignore=App\Http\Requests

### [#](#content---clear-cache "Permalink")`--clear-cache`

Clears the mutation cache and runs mutation testing from scratch.

    1./vendor/bin/pest --mutate --clear-cache

### [#](#content---no-cache "Permalink")`--no-cache`

Runs mutation testing without using cached mutations.

    1./vendor/bin/pest --mutate --no-cache

### [#](#content---ignore-min-score-on-zero-mutations "Permalink")`--ignore-min-score-on-zero-mutations`

Ignore the minimum score requirement when there are no mutations.

    1./vendor/bin/pest --mutate --min=80 --ignore-min-score-on-zero-mutations

### [#](#content---profile "Permalink")`--profile`

Output to standard output the top ten slowest mutations.

    1./vendor/bin/pest --mutate --profile

### [#](#content---retry "Permalink")`--retry`

Run untested or uncovered mutations first and stop execution upon the first error or failure.

    1./vendor/bin/pest --mutate --retry

### [#](#content---stop-on-uncovered "Permalink")`--stop-on-uncovered`

Stop mutation testing execution upon the first untested mutation.

    1./vendor/bin/pest --mutate --stop-on-uncovered

### [#](#content---stop-on-untested "Permalink")`--stop-on-untested`

Stop mutation testing execution upon the first untested mutation.

    1./vendor/bin/pest --mutate --stop-on-untested

* * *

As you can see Pest PHP's mutation testing feature is a powerful tool to improve the quality of your test suite. In the following chapter, we explain how can you use Snapshots to test your code: [Snapshot Testing](/docs/snapshot-testing)

---

## Optimizing Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/optimizing-tests.md)

[#](#content-optimizing-tests "Permalink")Optimizing Tests
==========================================================

Pest offers several optimization techniques to help developers write efficient and high-performing tests. One of the most important is parallel testing, which allows multiple tests to run simultaneously across multiple processes using the `--parallel` option. This can greatly reduce the time it takes to run tests and improve the overall performance of your test suite.

Additionally, Pest provides the `--profile` flag to quickly identify slow-running tests, allowing you to optimize their execution.

Finally, it's often useful to focus solely on your test suite's failures. To do this, you can utilize the `--compact` printer when running Pest. This instructs Pest to only display information regarding your test suite's failing tests.

[#](#content-parallel-testing "Permalink")Parallel Testing
----------------------------------------------------------

> In Pest 2, Parallel testing achieved a significant milestone, running up to 80% faster than before. This remarkable improvement was the result of a complete rebuild of the parallel test core system, which introduced advanced techniques for process reuse between test case runs. While Pest 3 bring further innovations, this upgrade in Pest 2 marked a turning point for parallel testing performance.

By default, Pest executes your tests sequentially within a single process. However, you can significantly decrease the time needed to run your tests by utilizing the `--parallel` option to run tests concurrently across multiple processes.

    1./vendor/bin/pest --parallel

When running tests in parallel, Pest will create a process for each available CPU core on your machine. However, you can manually modify the number of processes using the `--processes` option.

    1./vendor/bin/pest --parallel --processes=10

Here are some important points to consider when writing tests that will be executed in parallel:

1.  **Database resources may not be shared between tests**: Each test should be isolated and independent from other tests.
2.  **Test order may not be guaranteed**: Tests should not rely on any specific order of execution.
3.  **Tests may be affected by race conditions**: Race conditions can occur when multiple processes or threads are accessing shared resources. Make sure to design your tests to handle potential race conditions and avoid them whenever possible.

[#](#content-profiling "Permalink")Profiling
--------------------------------------------

Imagine you have a large test suite that takes several minutes to run. You've noticed that some tests take significantly longer than others, but you're not sure which tests are the slowest or what's causing the slowdown.

To identify the slowest tests and optimize their execution, you can use Pest's `--profile` option. When you run your test suite with this flag enabled, Pest will collect the duration of each test and provide a report that highlights the slowest tests.

    1./vendor/bin/pest --profile

For example, imagine you run your test suite and see the following output:

![](/assets/img/profile.webp?1)

You can see that the `UserTest > create user` and `OrderTest > create order` tests are taking significantly longer than the other tests. By analyzing this test, you may discover that it's executing several inefficient database queries or performing other expensive operations that could be optimized to reduce its execution time.

[#](#content-compact-printer "Permalink")Compact Printer
--------------------------------------------------------

If you're working with a large number of tests, it can be beneficial to concentrate solely on the failing tests. You can use the `--compact` printer to instruct Pest to only display test failures, making it easier to pinpoint and resolve any problems without the noise of all of your successful tests.

![](/assets/img/compact.webp?1)

Furthermore, since the `--compact` printer produces simpler output, test speed can be improved by a few milliseconds since there is less input / output required for each test.

You may even configure Pest to always use the compact printer so you don't have to specify the `--compact` option every time you run your test suite.

    1// tests/Pest.php2pest()->printer()->compact();3 4//

* * *

Now that you have learned how to speed up your test suite, let's move on to discussing Continuous Integration: [Continuous Integration](/docs/continuous-integration)

---

## Pest Spicy Summer Release

[Edit this page →](https://github.com/pestphp/docs/edit/master/pest-spicy-summer-release.md)

[#](#content-pests-spicy-summer-release "Permalink")Pest's Spicy Summer Release
===============================================================================

> "Spicy Summer" is the codename assigned to Pest 2.9.

On March 20, 2023, [we proudly introduced Pest 2.0](/docs/announcing-pest2), marking it as our most significant release to date, with **more than 7 million downloads** at the time of writing. This version showcased a remarkable architectural plugin, an 80% speed improvement in parallel testing, profiling options, and numerous other features.

As we approach summer, we are thrilled to announce our upcoming release: the highly anticipated "Spicy Summer" release. This release brings an array of exciting features that will make it feel like a major version without actually being one - it's Pest v2.9.0 - so **it's just a "composer update" away from you**. Without further delay, let's dive into what we have in store for you this summer:

*   **Built-in Snapshot Testing**, for testing the long-output of your code with ease
*   **Describe Blocks**, for grouping tests and sharing setup and teardown logic
*   **Architectural Testing++**, even more powerful architectural testing
*   **Type Coverage Plugin**, for measuring the percentage of code that is covered by type declarations
*   **Drift Plugin**, to automatically convert your PHPUnit tests to Pest

[#](#content-built-in-snapshot-testing "Permalink")Built-in Snapshot Testing
----------------------------------------------------------------------------

> Read the full documentation at: [pestphp.com/docs/snapshot-testing](/docs/snapshot-testing)

Snapshot testing is a testing technique that allows you to assert that the output of a function or method has not changed. It's a great way to test your codebase and ensure that your code is not changing unexpectedly.

And now, we are proud to announce that Pest will have built-in snapshot testing support. As an example, let's say your "contacts" endpoint outputs a certain HTML every time it runs. You would probably write a test like this:

    1it('has a contact page', function () {2    $response = $this->get('/contact');3 4    expect($response)->toMatchSnapshot();5});

The first time you run this test, it will create a snapshot file - at `tests/.pest/snapshots` - with the response content. The next time you run the test, it will compare the response with the snapshot file. If the response is different, the test will fail. If the response is the same, the test will pass.

In addition, the given expectation value doesn't have to be a response; it can be anything. For example, you can snapshot an array:

    1$array = /** Fetch array somewhere */;2 3expect($array)->toMatchSnapshot();

And of course, you can "rebuild" the snapshots at any time by using the `--update-snapshots` option:

    1./vendor/bin/pest --update-snapshots

[#](#content-describe-blocks "Permalink")Describe Blocks
--------------------------------------------------------

Since we released Pest, describe blocks has been one of the most requested features. These are fundamental to any "functional" testing framework, as they allow you to group tests and share setup and teardown logic.

     1beforeEach(fn () => $this->user = User::factory()->create()); 2  3describe('auth', function () { 4    beforeEach(fn () => $this->actingAs($this->user)); 5  6    test('cannot login when already logged in', function () { 7        // ... 8    }); 9 10    test('can logout', function () {11        // ...12    });13})->skip(/* Skip the entire describe block */);14 15describe('guest', function () {16    test('can login', function () {17        // ...18    });19 20    // ...21});

[#](#content-architectural-testing "Permalink")Architectural Testing++
----------------------------------------------------------------------

> Read the full documentation at: [pestphp.com/docs/arch-testing](/docs/arch-testing)

Pest has always been about making testing more enjoyable. Last release, we introduced architectural expectations, which allow you to test your codebase's architecture. This release, we are proud to announce that Pest improves architectural expectations by adding new ones.

    1test('controllers')2    ->expect('App\Http\Controllers')3    ->toUseStrictTypes()4    ->toHaveSuffix('Controller') // or toHavePreffix, ...5    ->toBeReadonly()6    ->toBeClasses() // or toBeInterfaces, toBeTraits, ...7    ->classes->not->toBeFinal() // 🌶8    ->classes->toExtendNothing() // or toExtend(Controller::class),9    ->classes->toImplementNothing() // or toImplement(ShouldQueue::class),

[#](#content-type-coverage-plugin "Permalink")Type Coverage Plugin
------------------------------------------------------------------

> Read the full documentation at: [pestphp.com/docs/type-coverage](/docs/type-coverage)

![](/assets/img/type-coverage.png)

As you may know, Pest offers a `--coverage` flag that allows you to generate a gorgeous coverage report on the terminal. This report shows you which lines of code are covered by your tests. This is a great way to ensure that your tests are covering all of your code.

To add to this, we are proud to announce that Pest will now have built-in type coverage support. This means that you can now see if your source code is using "types" in every possible place. For example, let's say you have a repository that has the following method:

    1public function find($id)2{3    return User::find($id);4}

This method is missing a parameter type and a return type. So, if you run pest --type-coverage, you will see the following output and know that you need to add types to this method:

    1...2app/Models\User.php .......................................... 100%3app/Repositories/UserRepository.php .................. pa8, rt8 33%4───────────────────────────────────────────────────────────────────5Total: 91.6 %

In addition, just like regular coverage, you may enforce `--min` type coverage percentage. For example, if you run `--type-coverage --min=100`, you will see the following output:

    1...2app/Models\User.php .......................................................... 100%3app/Repositories/UserRepository.php .................................. pa8, rt8 33%4───────────────────────────────────────────────────────────────────────────────────5                                                                      Total: 91.6 %6 ERROR  Type coverage below expected: 91.6%. Minimum: 100.0%

[#](#content-drift-plugin "Permalink")Drift Plugin
--------------------------------------------------

> Read the full documentation at: [pestphp.com/docs/migrating-from-phpunit-guide](/docs/migrating-from-phpunit-guide)

Yes, you read that right. We are proud to announce that Pest will now have a Laravel shift-like tool called Drift. Drift will allow you to upgrade your PHPUnit tests to Pest tests in a matter of seconds.

So, if you have a test like this:

     1<?php 2  3namespace Tests\Unit; 4  5use PHPUnit\Framework\TestCase; 6  7class ExampleTest extends TestCase 8{ 9    public function test_that_true_is_true(): void10    {11        $this->assertTrue(true);12    }13}

You can run `./vendor/bin/pest --drift` and Pest will automatically convert your PHPUnit test to a Pest test:

    1test('true is true', function () {2    expect(true)->toBeTrue();3});

* * *

Thank you for reading about Pest 2.9's new features! If you're considering a testing framework for your next project, here's why you should give Pest a try: [Why Pest →](/docs/why-pest)

---

## Pest3 Now Available

[Edit this page →](https://github.com/pestphp/docs/edit/master/pest3-now-available.md)

[#](#content-pest-v3-now-available "Permalink")Pest v3 Now Available
====================================================================

Today, we're thrilled to announce the release of **Pest 3**. As we announced at Laracon US, Pest 3 introduces Mutation Testing, Arch Presets, Team Management, New Configuration API, multiple improvements to Architectural Testing & more.

Check out Pest's creator, Nuno Maduro, live demonstrating what's new in Pest 3:

Below, we'll cover all the juicy details about this release. And as usual, you can find the [upgrade guide](/docs/upgrade-guide) in our website.

*   **[Mutation Testing](#mutation-testing)**: An innovative new technique that introduces small changes to your code to see if your tests catch them.
*   **[Arch Presets](#arch-presets)**: A set of predefined rules that you can use to test your application's architecture.
*   **[Team Management](#team-management)**: A new feature that allows you to manage tasks and todos with your team directly from the console.
*   **[Nested Describes](#nested-describes)**: You can now nest describe blocks within other describe blocks.
*   **[New Configuration API](#new-configuration-api)**: A new configuration API that is more intuitive and easier to use.
*   **[More Architectural Testing Improvements](#more-architectural-testing-improvements)**: `toUseStrictEquality`, `toHaveMethodsDocumented`, `->not->toHaveProtectedMethods`, and more.
*   **[And Much More...](#miscellaneous-improvements)**: Constants in Type Coverage, static analysis improvements, and more.

[#](#content-mutation-testing "Permalink")Mutation Testing
----------------------------------------------------------

Mutation Testing is an innovative new technique that introduces small changes (mutations) to your code to see if your tests catch them. This ensures you’re testing your application thoroughly, beyond just achieving code coverage and more about the actual quality of the tests. It’s a great way to identify weaknesses in your test suite and improve quality.

![Mutation Testing](/assets/mutation-testing-1.jpg)

To get started with mutation testing, head over to your test file, and be specific about which part of your code your test covers using the `covers()` function.

    1covers(TodoController::class);2 3it('list todos', function () {4    $this->getJson('/todos')->assertStatus(200);5});

Then, run Pest PHP with the `--mutate` option to start mutation testing.

    1./vendor/bin/pest --mutate2# or in parallel...3./vendor/bin/pest --mutate --parallel

Pest will then re-run your tests against "mutated" code and see if the tests are still passing. If a test is still passing against a mutation, it means that the test is not covering that specific part of the code. As, as result, Pest will output the mutation and the diff of the code.

     1UNTESTED  app/Http/TodoController.php  > Line 44: ReturnValue - ID: 76d17ad63bb7c307 2  3class TodoController { 4    public function index(): array 5    { 6         // pest detected that this code is untested because 7         // the test is not covering the return value 8-        return Todo::all()->toArray(); 9+        return [];10    }11}12 13  Mutations: 1 untested14  Score:     33.44%

Once you have identified the untested code, you can write additional tests to cover it.

    1covers(TodoController::class);2 3it('list todos', function () {4+    Todo::factory()->create(['name' => 'Buy milk']);5 6-    $this->getJson('/todos')->assertStatus(200);7+    $this->getJson('/todos')->assertStatus(200)->assertJson([['name' => 'Buy milk']]);8});

Then, you can re-run Pest with the `--mutate` option to see if the mutation is now "tested" and covered.

    1Mutations: 1 tested2Score:     100.00%

The higher the mutation score, the better your test suite is. A mutation score of 100% means that all mutations were "tested", which is the goal of mutation testing.

Now, if you see "untested" or "uncovered" mutations, or are a mutation score below 100%, typically means that you have **missing tests** or that **your tests are not covering all the edge cases**.

Our plugin is deeply integrated into Pest PHP. So, each time a mutation is introduced, Pest PHP will:

*   **Only run the tests covering the mutated code** to speed up the process.
*   **Cache as much as possible** to speed up the process on subsequent runs.
*   If enabled, use **parallel execution to run multiple tests** in parallel to speed up the process.

There is so much more to explore with Mutation Testing, like `@pest-mutate-ignore` or `--mutate --everything`. You can learn more about it in our [Mutation Testing](/docs/mutation-testing) section.

[#](#content-arch-presets "Permalink")Arch Presets
--------------------------------------------------

As you may know, [Architecture testing](/docs/arch-testing) enables you to specify expectations that test whether your application adheres to a set of architectural rules, helping you maintain a clean and sustainable codebase.

It's one of the most popular features of Pest, and with Pest 3, we're introducing **Arch Presets**. Arch Presets are a set of predefined architectural rules that you can use to test your application's architecture. These presets are designed to help you get started with architecture testing quickly and easily.

![Arch Presets](/assets/presets-3.jpg)

Here are the available Arch Presets in Pest 3:

*   [`php`](#preset-php)
*   [`security`](#preset-security)
*   [`laravel`](#preset-laravel)
*   [`strict`](#preset-strict)
*   [`relaxed`](#preset-relaxed)

### [#](#content-php "Permalink")`php`

The `php` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It avoids the usage of `die`, `var_dump`, and similar functions, and ensures you are not using deprecated PHP functions. [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Php.php)

    1arch()->preset()->php();

### [#](#content-security "Permalink")`security`

The `security` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It ensures you are not using code that could lead to security vulnerabilities, such as `eval`, `md5`, and similar functions. [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Security.php)

    1arch()->preset()->security();

### [#](#content-laravel "Permalink")`laravel`

The `laravel` preset is a predefined set of expectations that can be used on [Laravel](https://laravel.com) projects.

It ensures you project's structure is following the well-known Laravel conventions, such as controllers only have `index`, `show`, `create`, `store`, `edit`, `update`, `destroy` as public methods and are always suffixed with `Controller` and so on. [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Laravel.php)

    1arch()->preset()->laravel();

### [#](#content-strict "Permalink")`strict`

The `strict` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It ensures you are using strict types in all your files, that all your classes are final, and more. [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Strict.php)

    1arch()->preset()->strict();

### [#](#content-relaxed "Permalink")`relaxed`

The `relaxed` preset is a predefined set of expectations that can be used on any php project. It's not coupled with any framework or library.

It is the opposite of the `strict` preset, ensuring you are not using strict types in all your files, that all your classes are not final, and more. [source code](https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Relaxed.php)

    1arch()->preset()->relaxed();

Just like regular architecture tests, you may ignore specific expectation targets using the `ignoring()` method.

    1arch()->preset()->security()->ignoring('md5');2 3arch()->preset()->laravel()->ignoring(User::class);

To get started with Arch Presets, please refer to our [Architecture Testing](/docs/arch-testing#arch-presets) section.

[#](#content-team-management "Permalink")Team Management
--------------------------------------------------------

Pest 3 also introduces **Team Management**, a new feature that allows you to manage tasks and todos with your team directly from the console. With Team Management, you can create, assign, and track tasks, as well as view the status of each task.

![Team Management](/assets/teams-2.jpg)

To get started with team management in Pest, you need to specify the project's URL in your `Pest.php` configuration file. This URL will be used to link todos to the corresponding project management system.

    1pest()->project()->github('my-organization/my-repository');

If you are using a different version control system, you can use the `gitlab`, `bitbucket`, `jira`, or `custom` methods instead.

Finally, you can create todos by using the `todo()` method. Also, you may use the `assignee`, `issue`, arguments to assign todos to specific team members or link them to issues in your project management system.

    1it('has a contact page', function () {2    //3})->todo(assignee: '[email protected]', issue: 123);

Also, it is often helpful to provide additional context for a todo. Pest allows you to write notes for a todo by providing a string to the `note` argument of the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo(note: <<<NOTE4    Given I am a user5    When I visit the contact page6    Then I should see a contact form7NOTE);

Once a todo is completed, you can mark it as work in progress by using the `wip()` method or mark it as done by using the `done()` method.

    1it('has a contact page', function () {2    //3})->wip(assignee: '[email protected]', issue: 123); // or ->done()

Finally, you can view todos separately from the rest of your test suite by including the `--todos` option when running Pest. You can also filter todos by assignee by providing their name to the `--assignee` option, or filter todos by issue by providing the issue number to the `--issue` option.

    1./vendor/bin/pest --todos --assignee=taylor # or --issue=123

There is so much more to explore with Team Management, you can learn more about it in our [Team Management](/docs/team-management) section.

[#](#content-nested-describes "Permalink")Nested Describes
----------------------------------------------------------

In Pest 3, you can now nest describe blocks within other describe blocks. This allows you to group tests more effectively and keep your test suite organized.

     1describe('home', function () { 2    beforeEach(function () { 3        // 4    }); 5  6    it('can be visited', function () { 7        // 8    }); 9 10    describe('footer', function () {11        it('contains a link to the contact page', function () {12            //13        });14    });15});

[#](#content-new-configuration-api "Permalink")New Configuration API
--------------------------------------------------------------------

Pest 1 / Pest 2's configuration API was a little bit confusing, the `uses()` function that was originally made only for having the `$this` variable within closure bound to the test case instance, ended up being used for pretty much everything.

In Pest 3, we've introduced a new configuration API that is more intuitive and easier to use. The new configuration API is based on the `pest()` function, which allows you to configure Pest using a fluent and expressive API.

> Note: the `uses()` function is still available in Pest 3, and we don't have plans to remove it. However, we recommend using the new configuration API for new projects.

    1-uses(TestCase::class)->in(__DIR__);2+pest()->extends(TestCase::class);3 4-uses(TestCase::class, RefreshDatabase::class)->in('Features');5+pest()->extends(TestCase::class)->use(RefreshDatabase::class)->in('Features');6 7-uses()->compact();8+pest()->printer()->compact();

And of course, any method that was available on the `uses()` API, like `->beforeEach()` or `->group()` is still available on the new `pest()` configuration API; we've just made it more intuitive and easier to use.

[#](#content-more-architectural-testing-improvements "Permalink")More Architectural Testing Improvements
--------------------------------------------------------------------------------------------------------

### [#](#content-new-expectations "Permalink")New Expectations

Again, Pest comes with a bunch of new architectural expectations and improvements. Some of them are already being used in the new Arch Presets, but you can use them individually as well.

*   [`toUseStrictEquality()`](/docs/arch-testing#expect-toUseStrictEquality) - Asserts that a target uses strict equality. `===` instead of `==`.
*   [`toHaveMethodsDocumented()`](/docs/arch-testing#expect-toHaveMethodsDocumented) - Asserts that a class has all its methods documented.
*   [`toHavePropertiesDocumented()`](/docs/arch-testing#expect-toHavePropertiesDocumented) - Asserts that a class has all its properties documented.
*   [`toHaveFileSystemPermissions()`](/docs/arch-testing#expect-toHaveFileSystemPermissions) - Asserts that a file has the expected file system permissions.
*   [`toHaveLineCountLessThan`](/docs/arch-testing#expect-toHaveLineCountLessThan) - Asserts that a file has less than a given number of lines.
*   [`toHaveMethods()`](/docs/arch-testing#expect-toHaveMethod) - Asserts that a class has the expected methods.
*   [`not->toHavePrivateMethodsBesides()`](/docs/arch-testing#expect-toHavePrivateMethodsBesides) - Asserts a class only "allows" the given private methods.
*   [`not->toHavePrivateMethods()`](/docs/arch-testing#expect-toHavePrivateMethods) - Asserts that a class does not have private methods.
*   [`not->toHaveProtectedMethodsBesides()`](/docs/arch-testing#expect-toHaveProtectedMethodsBesides) - Asserts a class only "allows" the given protected methods.
*   [`not->toHaveProtectedMethods()`](/docs/arch-testing#expect-toHaveProtectedMethods) - Asserts that a class does not have protected methods.
*   [`not->toHavePublicMethodsBesides()`](/docs/arch-testing#expect-toHavePublicMethodsBesides) - Asserts a class only "allows" the given public methods.
*   [`not->toHavePublicMethods()`](/docs/arch-testing#expect-toHavePublicMethods) - Asserts that a class does not have public methods.
*   [`toUseTrait()`](/docs/arch-testing#expect-toUseTrait) - Asserts that a class uses the given trait.
*   [`toUseTraits()`](/docs/arch-testing#expect-toUseTraits) - Asserts that a class uses the given traits.

You may check all existing architectural expectations in our [Architecture Testing](/docs/arch-testing) section.

### [#](#content-tear-down-improvements "Permalink")Tear Down Improvements

As you may know, Pest allows you to run a specific "teardown" callback after each test using the `afterEach()` method. This is useful for cleaning up resources or resetting state between tests.

    1afterEach(function () {2    // This will run after each test...3});

In Pest 3, we've introduced a new `after()` method that allows you to run a specific "teardown" callback after a specific test or group of tests using describe.

    1it('may list todos', function () {2    //3})->after(function () {4    // This will run after this test only...5});

To read more about hooks, please refer to our [Hooks](/docs/hooks) section.

[#](#content-miscellaneous-improvements "Permalink")Miscellaneous Improvements
------------------------------------------------------------------------------

Because Pest 3 is based on PHPUnit 11, you can now use any PHPUnit 11 feature within Pest. Also, Pest 3 also comes with a bunch minor bug-fixes and improvements, below are some of the them:

*   FEAT: Type Coverage now checks for missing types on constants.
*   FEAT: Better error messages when static closures are used on tests + wrong arguments on datasets.
*   FEAT: Adds basic support for static analysis tools within test closures.
*   FEAT: Overall static analysis improvements on expectations and the entire API surface.
*   FEAT: Possibility of deleting the `phpunit.xml` file and having Pest working out of the box.
*   FIX: Exit code being computed incorrectly when using `--fail-on-xxx` CLI options.
*   FIX: Describe blocks now support more than one method call when chaining methods.
*   FIX: Runtime exceptions before the first test are now caught and displayed.
*   FIX: Having coverage report failing with `--min=100` option when result less than 100 but bigger than 99.5.
*   And much more...

* * *

There's never been a better time to dive in into testing and start using Pest. If you're ready to get started with Pest 3 right away, check out our [installation guide](/docs/installation) for step-by-step instructions. And if you're currently using Pest 2, we've got you covered with detailed upgrade instructions in our [upgrade guide](/docs/upgrade-guide).

Thank you for your continued support and feedback. We can't wait to see what you build with Pest 3!

* * *

Thank you for reading about Pest 3.0's new features! If you're considering a testing framework for your next project, here's why you should give Pest a try: [Why Pest →](/docs/why-pest)

---

## Plugins

[Edit this page →](https://github.com/pestphp/docs/edit/master/plugins.md)

[#](#content-plugins "Permalink")Plugins
========================================

In this section, we will discuss the official and community developed plugins that we endorse. Plugins primarily offer namespaced functions, console commands, custom expectations, and additional command-line options to augment the default Pest experience.

If you are a plugin developer, please consult our [documentation on creating plugins](/docs/creating-plugins) for more information on how to create Pest plugins.

The following plugins are maintained by the Pest team:

*   [Faker](#faker)
*   [Laravel](#laravel)
*   [Livewire](#livewire)
*   [Watch](#watch)

* * *

[#](#content-faker "Permalink")Faker
------------------------------------

**Source code**: [github.com/pestphp/pest-plugin-faker](https://github.com/pestphp/pest-plugin-faker)

To start using Pest's Faker plugin, you need to require the plugin via Composer.

    composer require pestphp/pest-plugin-faker --dev

After installing the plugin, you may utilize the namespaced `fake` function to generate fake data for your tests.

    use function Pest\Faker\fake;it('generates a name', function () {    $name = fake()->name; // random name...    //});

You can also designate the "locale" that should be utilized by the `fake()` function by providing the locale to the function.

    use function Pest\Faker\fake;it('generates a portuguese name', function () {    $name = fake('pt_PT')->name; // Nuno Maduro    //});

To learn more about Faker, including comprehensive details about the API it provides, please consult [its official documentation](https://fakerphp.github.io/).

* * *

[#](#content-laravel "Permalink")Laravel
----------------------------------------

**Source code**: [github.com/pestphp/pest-plugin-laravel](https://github.com/pestphp/pest-plugin-laravel)

To start using Pest's Laravel plugin, you need to require this plugin via Composer.

    composer require pestphp/pest-plugin-laravel --dev

This plugin adds additional Artisan commands and functions to the default Pest installation. For example, to generate a new test in the `tests/Feature` directory, you can now utilize the `pest:test` Artisan command.

    php artisan pest:test UsersTest

You may provide the `--unit` option when creating a test to place the test in the `tests/Unit` directory.

    php artisan pest:test UsersTest --unit

Executing the `pest:dataset` Artisan command will create a fresh dataset in the `tests/Datasets` directory.

    php artisan pest:dataset Emails

As you may know, Laravel provides a variety of assertions you can take advantage of in your feature tests. When using Pest's Laravel plugin, you may access all of those assertions as you typically would.

    it('has a welcome page', function () {    $this->get('/')->assertStatus(200);});

In addition, with the assistance of this plugin, it is possible for you to bypass the `$this` variable while using namespaced functions such as `actingAs`, `get`, `post` and `delete`.

    use function Pest\Laravel\{get};it('has a welcome page', function () {    get('/')->assertStatus(200);    // same as $this->get('/')...});

To illustrate this convenient feature using another example, we can write a test acting as an authenticated user accessing the restricted dashboard page.

    use App\Models\User;use function Pest\Laravel\{actingAs};test('authenticated user can access the dashboard', function () {    $user = User::factory()->create();    actingAs($user)->get('/dashboard')        ->assertStatus(200);});

As you may expect, all of the assertions that were previously accessible via `$this->` are available as namespace functions.

    use function Pest\Laravel\{actingAs, get, post, delete, ...};

You can find the full testing documentation on the Laravel website: [laravel.com/docs/11.x/testing](https://laravel.com/docs/11.x/testing).

* * *

[#](#content-livewire "Permalink")Livewire
------------------------------------------

**Source code**: [github.com/pestphp/pest-plugin-livewire](https://github.com/pestphp/pest-plugin-livewire)

To install Pest's Livewire plugin, you need to require the plugin via Composer.

    composer require pestphp/pest-plugin-livewire --dev

After installing the plugin, you may use the `livewire` namespaced function to access your Livewire components.

    use function Pest\Livewire\livewire;it('can be incremented', function () {    livewire(Counter::class)        ->call('increment')        ->assertSee(1);});it('can be decremented', function () {    livewire(Counter::class)        ->call('decrement')        ->assertSee(-1);});

* * *

[#](#content-watch "Permalink")Watch
------------------------------------

**Source code**: [github.com/pestphp/pest-plugin-watch](https://github.com/pestphp/pest-plugin-watch)

To install Pest's "watch" plugin, you need to require the plugin via Composer.

    composer require pestphp/pest-plugin-watch --dev

Make sure you also install [`fswatch`](https://github.com/emcrisostomo/fswatch#getting-fswatch) so Pest can monitor when a file changes.

Once both the plugin and `fswatch` are installed, you will be able to use the `--watch` option when running Pest. This option instructs Pest to monitor your application and automatically re-run your tests when you change files within a list of specified directories.

    pest --watch

By default, the plugin monitors the following directories.

    tests/app/src/

To customize the watched directories, supply a comma-separated list of directories (relative to your application root) to the `--watch` flag.

    pest --watch=app,routes,tests

* * *

In this section, we have seen how plugins can enhance your Pest experience. Now, let's see how you can manage your team's tasks and responsibilities using Pest: [Team Management](/docs/team-management)

---

## Skipping Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/skipping-tests.md)

[#](#content-skipping-tests "Permalink")Skipping Tests
======================================================

During the development process, there may be times when you need to temporarily disable a test. Rather than commenting out the code, we recommended using the `skip()` method.

    1it('has home', function () {2    //3})->skip();

When running your tests, Pest will inform you about any tests that were skipped.

![](/assets/img/skip.webp?1)

You may also provide the reason for skipping the test, which Pest will display when running your tests.

    1it('has home', function () {2    //3})->skip('temporarily unavailable');

In addition, there may be times when you want to skip a test based on a given condition. In these cases, you may provide a boolean value as the first argument to the `skip()` method. This test will only be skipped if the boolean value evaluates to `true`.

    1it('has home', function () {2    //3})->skip($condition == true, 'temporarily unavailable');

You may pass a closure as the first argument to the `skip()` method to defer the evaluation of the condition until the `beforeEach()` hook of your test case has been executed.

    1it('has home', function () {2    //3})->skip(fn () => DB::getDriverName() !== 'mysql', 'db driver not supported');

To skip a test on a particular operating system, you can make use of the `skipOnWindows()`, `skipOnMac()`, or `skipOnLinux()`.

    1it('has home', function () {2    //3})->skipOnWindows(); // or skipOnMac() or skipOnLinux() ...

Alternatively, you can skip a test on all operating systems except one by using `onlyOnWindows()`, `onlyOnMac()`, or `onlyOnLinux()`.

    1it('has home', function() {2    //3})->onlyOnWindows(); // or onlyOnMac() or onlyOnLinux() ...

Sometimes, you may want to skip a test on a specific PHP version. In these cases, you may use the `skipOnPhp()` method.

    1it('has home', function () {2    //3})->skipOnPhp('>=8.0.0');

The valid operators for the `skipOnPhp()` method are `>`, `>=`, `<`, and `<=`.

Finally, you may even invoke the `skip()` method within your `beforeEach()` hook to conveniently skip an entire test file.

    1beforeEach(function () {2    //3})->skip();

* * *

As your codebase expands, it's advisable to consider enhancing the speed of your test suite. To assist you with that, we offer comprehensive documentation on optimizing your test suite: [Optimizing Tests](/docs/optimizing-tests)

---

## Snapshot Testing

[Edit this page →](https://github.com/pestphp/docs/edit/master/snapshot-testing.md)

[#](#content-snapshot-testing "Permalink")Snapshot Testing
==========================================================

Snapshot Testing is a great way to test your code by comparing by the given expectation value to a previously stored snapshot of the same value. This is useful when you want to ensure that your code is not changing its output unexpectedly.

As example, let's say you have a string response coming from an API. You can use snapshot testing to ensure that the response is not changing unexpectedly.

    1it('has a contact page', function () {2    $response = $this->get('/contact');3 4    expect($response)->toMatchSnapshot();5});

The first time you run this test, it will create a snapshot file - at `tests/.pest/snapshots` - with the response content. The next time you run the test, it will compare the response with the snapshot file. If the response is different, the test will fail. If the response is the same, the test will pass.

In addition, the given expectation value doesn't have to be a response; it can be anything. For example, you can snapshot an array:

    1$array = /** Fetch array somewhere */;2 3expect($array)->toMatchSnapshot();

And of course, you can "rebuild" the snapshots at any time by using the `--update-snapshots` option:

    1./vendor/bin/pest --update-snapshots

[#](#content-handling-dynamic-data "Permalink")Handling Dynamic Data
--------------------------------------------------------------------

Sometimes, the expected value may contain dynamic data that you cannot control, such as CSRF tokens in a form. In those cases, you can use [Expectation Pipes](/docs/custom-expectations#content-pipe-expectations) to replace that data. Here is an example:

     1expect()->pipe('toMatchSnapshot', function (Closure $next) { 2    if (is_string($this->value)) { 3        $this->value = preg_replace( 4            '/name="_token" value=".*"/', 5            'name="_token" value="my_test"', 6            $this->value 7        ); 8    } 9 10    return $next();11});

* * *

In this chapter, we've seen how powerful snapshot testing is. In the following chapter, we will dive into Pest's custom helpers: [Custom Helpers](/docs/custom-helpers)

---

## Stress Testing

[Edit this page →](https://github.com/pestphp/docs/edit/master/stress-testing.md)

[#](#content-stress-testing "Permalink")Stress Testing
======================================================

Stress Testing is a type of testing that inspects the stability and reliability of your application under realistic or extreme conditions — depending on the scenario you setup. For example, you can use stress testing to verify that your application can handle a large number of requests or that it can handle a large amount of data.

In Pest, you can combine the power of Stress Testing with the Expectation API ensuring no stability and reliability regressions over time. This can be useful to verify that your application is stable and reliable after a new release, or after a new deployment.

Behind the scenes, this project utilizes [k6](https://k6.io/), a powerful open-source load testing tool for evaluating the performance of APIs, microservices, and websites. k6 is licensed under the **[AGPL-3.0 License](https://www.gnu.org/licenses/agpl-3.0.en.html)**, and the k6 binary is downloaded when the plugin is used for the first time.

To start using Pest's Stress Testing plugin (mostly known as Stressless), you need to require the stressless plugin via Composer.

    1composer require pestphp/pest-plugin-stressless --dev

After requiring the plugin, you may start using it in two different ways:

*   Using [the `stress` command](#the-stress-command): It's useful when you want to quickly stress test a URL, without setting expectations on the result.
*   Using [the `stress()` function](#the-stress-function): It's useful when you want to stress test a URL and set expectations on the result.

**Testing external domain or local IP Address?** When load testing a domain from an external network, you get a realistic picture of how your application performs under typical user loads. This includes factors like network latency and real-world internet traffic. However, when testing a local IP address within your network, the focus is on understanding the performance of your internal infrastructure in a controlled environment, without external variables like internet or DNS resolution times. It's particularly useful for identifying potential bottlenecks within your own network or server and for performance tuning of internal applications or servers. This includes tasks such as configuring PHP FPM more effectively, etc.

[#](#content-the-stress-command "Permalink")The Stress Command
--------------------------------------------------------------

The `stress` command is useful when you want to quickly stress test a URL, analyze the result, and all without setting expectations on the result. It's the quickest way to launch a stress test, and it happens directly on the terminal.

To get started, you may use the `stress` command and provide the URL you wish to stress test:

    1./vendor/bin/pest stress example.com

By default, the stress test duration will be `5` seconds. However, you may customize this value using the `--duration` option:

    1./vendor/bin/pest stress example.com --duration=5

In addition, the number of concurrent requests will be `1`. However, you may also customize this value using the `--concurrency` option:

    1./vendor/bin/pest stress example.com --concurrency=5

The concurrency value represents the number of concurrent requests that will be made to the given URL. For example, if you set the concurrency to `5`, Pest will **constantly make 5 concurrent requests** to the given URL until the stress test duration is reached.

You may want to be mindful of the number of concurrent requests you configure. If you configure too many concurrent requests, you may overwhelm your application, server or hit rate limits / firewalls.

If you want to specify the http method used for the stress test, you can use one of the provided `delete`, `get`, `head`, `options`, `patch`, `put` or `post` options. Using `options`, `patch` and `put` options, you can specify an optional payload argument to be used in the requests. Using `post` option, you are required to provide the payload argument.

     1./vendor/bin/pest stress example.com/articles 2# or 3./vendor/bin/pest stress example.com/articles --get 4# or 5./vendor/bin/pest stress example.com/articles --head 6# or 7./vendor/bin/pest stress example.com/articles --options 8# or 9./vendor/bin/pest stress example.com/articles --options='{"name": "Nuno"}'10# or11./vendor/bin/pest stress example.com/articles/1 --patch12# or13./vendor/bin/pest stress example.com/articles/1 --patch='{"name": "Nuno"}'14# or15./vendor/bin/pest stress example.com/articles --put16# or17./vendor/bin/pest stress example.com/articles --put='{"name": "Nuno"}'18# or19./vendor/bin/pest stress example.com/articles --post='{"name": "Nuno"}'20# or21./vendor/bin/pest stress example.com/articles/1 --delete

Once the stress test is completed, Pest will display a summary of the stress test result.

[#](#content-the-stress-function "Permalink")The Stress function
----------------------------------------------------------------

Once you start understanding how stress testing works, you may want to start setting expectations on the stress test result. For example, you may want to verify that the average response time is _always_ less than 100ms, and this is where the `stress()` function comes in.

To get started, simply create a regular test and use the `stress()` function to stress test a given URL:

    1<?php2 3use function Pest\Stressless\stress;4 5it('has a fast response time', function () {6    $result = stress('example.com');7 8    expect($result->requests()->duration()->med())->toBeLessThan(100); // < 100.00ms9});

By default, the stress test duration will be 10 seconds. However, you may customize this value using the `for()->seconds()` method:

    1$result = stress('example.com')->for(5)->seconds();

In addition, the number of concurrent requests will be 1. However, you may also customize this value using the `concurrently` method:

    1$result = stress('example.com')->concurrently(requests: 2)->for(5)->seconds();

At any time, you may `dd` the stress test result to see its details like if you were using the `stress` command):

    1$result = stress('example.com')->dd();2                             //->dump();3                             //->verbosely();

If you want to specify the http method used for the stress test, you can use one of the provided `delete`, `get`, `head`, `options`, `patch`, `put` or `post` methods. Using `options`, `patch` and `put` methods, you can specify an optional payload argument to be used in the requests. Using `post` method, you are required to provide the payload argument.

     1$result = stress('example.com/articles/1')->delete(); 2// or 3$result = stress('example.com/articles')->get(); 4// or 5$result = stress('example.com/articles')->head(); 6// or 7$result = stress('example.com/articles')->options(); 8// or 9$result = stress('example.com/articles')->options(["name" => "Nuno"]);10// or11$result = stress('example.com/articles/1')->patch();12// or13$result = stress('example.com/articles/1')->patch(["name" => "Nuno"]);14// or15$result = stress('example.com/articles')->put();16// or17$result = stress('example.com/articles')->put(["name" => "Nuno"]);18// or19$result = stress('example.com/articles')->post(["name" => "Nuno"]);

If you want to specify request headers, you can use the provided `headers` method.

    1$result = stress('example.com/articles')->headers([2    'Authorization' => 'Bearer SecretToken',3])->get();

The `stress()` function return the stress test result, which you can use to set expectations. Here is the list of available methods:

### [#](#content-request-duration "Permalink")Request Duration

Returns the overall request duration in milliseconds.

    1$result->requests()->duration()->med();2                            // ->min();3                            // ->max();4                            // ->p90();5                            // ->p95();

### [#](#content-requests-count "Permalink")Requests Count

Returns the number of requests made.

    1$result->requests()->count();

### [#](#content-requests-rate "Permalink")Requests Rate

Returns the number of requests made per second.

    1$result->requests()->rate();

### [#](#content-requests-failed-count "Permalink")Requests Failed Count

Returns the number of requests that failed.

    1$result->requests()->failed()->count();

### [#](#content-requests-failed-rate "Permalink")Requests Failed Rate

Returns the number of requests that failed per second.

    1$result->requests()->failed()->rate();

### [#](#content-requests-time-to-first-byte-duration--ttfb "Permalink")Requests Time To First Byte Duration / TTFB

Returns the request time to first byte duration in milliseconds.

    1$result->requests()->ttfb()->duration()->med();2                                    // ->min();3                                    // ->max();4                                    // ->p90();5                                    // ->p95();

### [#](#content-requests-dns-lookup-duration "Permalink")Requests DNS Lookup Duration

> This metric is affected by the network latency between the client and the DNS server.

Returns the request DNS lookup duration in milliseconds.

    1$result->requests()->dnsLookup()->duration()->med();2                                         // ->min();3                                         // ->max();4                                         // ->p90();5                                         // ->p95();

### [#](#content-requests-tls-handshaking-duration "Permalink")Requests TLS Handshaking Duration

> This metric is affected by the network latency between the client and the server.

Returns the request TLS handshaking duration in milliseconds.

    1$result->requests()->tlsHandshaking()->duration()->med();2                                              // ->min();3                                              // ->max();4                                              // ->p90();5                                              // ->p95();

### [#](#content-requests-download-duration "Permalink")Requests Download Duration

> This metric is affected by the network latency between the client and the server.

Returns the request download duration in milliseconds.

    1$result->requests()->download()->duration()->med();2                                        // ->min();3                                        // ->max();4                                        // ->p90();5                                        // ->p95();

#### [#](#content-requests-download-data-count "Permalink")Requests Download Data Count

Returns the request download data count in bytes.

    1$result->requests()->download()->data()->count();

### [#](#content-requests-download-data-rate "Permalink")Requests Download Data Rate

Returns the request download data rate in bytes per second.

    1$result->requests()->download()->data()->rate();

### [#](#content-requests-upload-duration "Permalink")Requests Upload Duration

> This metric is affected by the network latency between the client and the server.

Returns the request upload duration in milliseconds.

    1$result->requests()->upload()->duration()->med();2                                      // ->min();3                                      // ->max();4                                      // ->p90();5                                      // ->p95();

### [#](#content-requests-upload-data-count "Permalink")Requests Upload Data Count

Returns the request upload data count in bytes.

    1$result->requests()->upload()->data()->count();

### [#](#content-requests-upload-data-rate "Permalink")Requests Upload Data Rate

Returns the request upload data rate in bytes per second.

    1$result->requests()->upload()->data()->rate();

### [#](#content-test-run-concurrency "Permalink")Test Run Concurrency

Returns the number of concurrent requests made during the stress test, which is the value you set using the `--concurrency` option or the `concurrently` method.

    1$result->testRun()->concurrency();

### [#](#content-test-run-duration "Permalink")Test Run Duration

Returns the duration of the stress test, which is the value you set using the `--duration` option or the `for()->seconds()` method.

    1$result->testRun()->duration();

* * *

Here, we've seen how to use Pest's Stress Testing plugin (aka stressless) to stress test a given URL and set expectations on the result. Moving on, let's explore how to test the coverage of your testing code: [Test Coverage](/docs/test-coverage)

---

## Support Policy

[Edit this page →](https://github.com/pestphp/docs/edit/master/support-policy.md)

[#](#content-support-policy "Permalink")Support Policy
======================================================

We strive to resolve all reported bugs or issues to the best of our abilities as an open-source project. Nevertheless, we cannot ensure a fixed resolution time or guarantee the availability of a fix for every problem.

Bug fixes will be available for outdated versions for a duration of two years following the latest version's release. The previous version will be regarded as outdated once a new version of Pest is released.

Major Version

PHP Compatibility

Initial Release

Bug Fixes Until

Pest 3

\>= PHP 8.2

September 9, 2024

To be determined

Pest 2

\>= PHP 8.1

March 20, 2023

September 9, 2026

Pest 1

\>= PHP 7.3

January 7, 2021

March 20, 2025

Pest adheres to semantic versioning principles, where the version number `x.y.z` conveys the following information:

*   When issuing bug fixes, the `z` number is incremented (e.g., 3.10.2 to 3.10.3).
*   When adding new non-breaking features or improvements, the `y` number is incremented (e.g., 3.10.2 to 3.12.0).
*   When introducing breaking changes, the `x` number is incremented (e.g., 3.10.2 to 4.0.0).

As maintainers of testing frameworks, we take breaking changes very seriously. Our goal is to deliver robust, cutting-edge features without disrupting the community's test suites. This commitment is why upgrading from Pest 1 to Pest 2 was as simple as updating your composer.json file. Similarly, the transition to Pest 3 has been designed to be just as seamless, ensuring an effortless upgrade experience for our users.

* * *

In the next chapter, we will explore the process of upgrading between major versions via our upgrade guide: [Upgrade Guide](/docs/upgrade-guide)

---

## Team Management

[Edit this page →](https://github.com/pestphp/docs/edit/master/team-management.md)

[#](#content-team-management "Permalink")Team Management
========================================================

With Pest, you can manage tasks and todos with your team directly from the console. You can create, assign, and track tasks, as well as view the status of each task.

[#](#content-setting-up-project "Permalink")Setting Up Project
--------------------------------------------------------------

To get started with team management in Pest, you need to specify the project's URL in your `Pest.php` configuration file. This URL will be used to link todos to the corresponding project management system.

    1pest()->project()->github('my-organization/my-repository');

If you are using a different version control system, you can use the `gitlab`, `bitbucket`, `jira`, or `custom` methods instead.

[#](#content-creating-todos "Permalink")Creating Todos
------------------------------------------------------

Typically, todos are linked to one or more tests that need to be passing. As such, tests can be used to track the progress of your todos / tasks. Pest provides a simple way to create todos by using the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo();

When running your tests, Pest will inform you about any tests that are todos so you don't forget and see them in the test results.

![](/assets/img/todo.webp?1)

If you have one or more todos, you may want to view them separately from the rest of your test suite. You can do this by including the `--todos` option when running Pest.

    1./vendor/bin/pest --todos

[#](#content-assigning-todos "Permalink")Assigning Todos
--------------------------------------------------------

In some cases, you may want to assign a todo to a specific team member. Pest allows you to assign a todo to a specific team member by providing their name to the `assignee` argument of the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo(assignee: 'nunomaduro');

You may assign multiple assignees by providing an array of names to the `assignee` argument. Also, you may filter todos by assignee by providing their name to the `--assignee` option when running Pest.

    1./vendor/bin/pest --todos --assignee=nunomaduro

[#](#content-set-corresponding-issues "Permalink")Set Corresponding Issues
--------------------------------------------------------------------------

Sometimes, todos are linked to issues in your project management system. Pest allows you to set the corresponding issue to a todo by providing the issue number to the `issue` argument of the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo(issue: 123);

Just like with assignees, you may set multiple issues by providing an array of issue numbers to the `issue` argument. Also, you may filter todos by issue by providing the issue number to the `--issue` option when running Pest.

    1./vendor/bin/pest --todos --issue=123

[#](#content-set-corresponding-prs "Permalink")Set Corresponding PRs
--------------------------------------------------------------------

Sometimes, todos are linked to pull requests in your version control system. Pest allows you to set the corresponding pull request to a todo by providing the pull request number to the `pr` argument of the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo(pr: 123);

Just like with assignees, you may set multiple pull requests by providing an array of pull request numbers to the `pr` argument. Also, you may filter todos by pull request by providing the pull request number to the `--pr` option when running Pest.

    1./vendor/bin/pest --todos --pr=123

[#](#content-writing-notes-for-todos "Permalink")Writing Notes for Todos
------------------------------------------------------------------------

It is often helpful to provide additional context for a todo. Pest allows you to write notes for a todo by providing a string to the `note` argument of the `todo()` method.

    1it('has a contact page', function () {2    //3})->todo(note: <<<NOTE4    Given I am a user5    When I visit the contact page6    Then I should see a contact form7NOTE);

The notes will be displayed below the todo in the test results.

[#](#content-marking-todos-as-work-in-progress "Permalink")Marking Todos as Work in Progress
--------------------------------------------------------------------------------------------

Once a todo is completed, you can mark it as work in progress by using the `wip()` method. This method will remove the todo status from the test and mark it as a regular test while keeping all the context like assignees, issues, etc.

    1it('has a contact page', function () {2    //3})->wip(assignee: 'nunomaduro', issue: 123);

[#](#content-marking-todos-as-done "Permalink")Marking Todos as Done
--------------------------------------------------------------------

Once a todo is completed, you can mark it as done by using the `done()` method. This method will remove the todo status from the test and mark it as a regular test while keeping all the context like assignees, issues, etc.

    1it('has a contact page', function () {2    //3})->done(assignee: 'nunomaduro', issue: 123);

[#](#content-combining-todos-with-assignees-issues-and-prs "Permalink")Combining Todos with Assignees, Issues, and PRs
----------------------------------------------------------------------------------------------------------------------

You can combine todos with assignees, issues, and PRs to provide additional context and track the progress of your todos. This can be done using the `describe` group, and the `todo`, `assignee`, `issue`, and `pr` methods.

    1describe('contacts', function () {2    it('has a contact page', function () {3        //4    }))->issue(123); // or ->pr(123) etc5 6    it('has a contact form', function () {7        //8    })->done(pr: 567);9})->wip(assignee: 'nunomaduro');

* * *

Now, let's dive into architectural testing and how it can benefit your development process. By performing architectural testing, you can evaluate the overall design of your application and identify potential flaws before they become significant issues: [Arch Testing](/docs/arch-testing)

---

## Test Coverage

[Edit this page →](https://github.com/pestphp/docs/edit/master/test-coverage.md)

[#](#content-test-coverage "Permalink")Test Coverage
====================================================

**Requires [XDebug 3.0+](https://xdebug.org/docs/install/)** or [PCOV](https://github.com/krakjoe/pcov).

Test coverage (or code coverage) is a metric used to measure the percentage of code that is executed during testing. This can help developers identify parts of their code that may not be tested or that have low coverage, indicating a potential risk for bugs and other issues.

Typically, the essential configuration for gathering code coverage is already present in the `phpunit.xml` file provided by frameworks, or is generated by executing the `./vendor/bin/pest --init` command. If code coverage configuration is not present in your `phpunit.xml` file, you can add your own configuration to specify the paths in your project that should receive code coverage reporting.

    1...2<source>3    <include>4        <directory suffix=".php">./app</directory>5    </include>6</source>7...

In addition to configuring your `phpunit.xml` file, you will also need to install [XDebug 3.0+](https://xdebug.org/docs/install/) or [PCOV](https://github.com/krakjoe/pcov) to generate a code coverage report. When utilizing XDebug, the `XDEBUG_MODE` environment variable must be configured as `coverage`.

Once you have configured your code coverage settings and installed a coverage driver, generating a code coverage report becomes effortless with the use of the `--coverage` option.

    1./vendor/bin/pest --coverage

By utilizing the `--coverage` option, the test suite runs normally, but with the additional feature of displaying a list of project files and their corresponding coverage results.

![](/assets/img/coverage.webp?1)

If there are any uncovered lines in your current test suite, they will be highlighted in red and displayed using their respective line numbers. Multiple uncovered lines will be displayed with two dots (`..`) between them. For instance, if there is missing coverage between lines 52 and 60, you will see `52..60` instead of just `52` in red.

[#](#content-minimum-threshold-enforcement "Permalink")Minimum Threshold Enforcement
------------------------------------------------------------------------------------

To ensure comprehensive testing and maintain code quality, it is crucial to set minimum threshold values for coverage results. In Pest, you can use the `--coverage` and `--min` or `--exactly` options to define the minimum threshold values for coverage results. If the specified thresholds are not met, Pest will report a failure.

    1./vendor/bin/pest --coverage --min=90

![](/assets/img/coverage-min.webp?1)

Or, you can use the `--exactly` option to enforce that the coverage results match the specified value exactly.

    1./vendor/bin/pest --coverage --exactly=99.3

[#](#content-ignoring-code "Permalink")Ignoring Code
----------------------------------------------------

If there are certain sections of your application that cannot be tested and should be excluded from code coverage analysis, you can use `@codeCoverageIgnoreStart` and `@codeCoverageIgnoreEnd` comments in your source code to achieve this.

    1// @codeCoverageIgnoreStart2function getUsers() {3    //4}5// @codeCoverageIgnoreEnd

[#](#content-different-formats "Permalink")Different Formats
------------------------------------------------------------

Pest supports various code coverage report formats:

*   `--coverage-clover <file>`: Save the code coverage report in Clover XML format to a specified file.
*   `--coverage-cobertura <file>`: Save the code coverage report in Cobertura XML format to a specified file.
*   `--coverage-crap4j <file>`: Save the code coverage report in Crap4J XML format to a specified file.
*   `--coverage-html <dir>`: Save the code coverage report in HTML format to a specified directory.
*   `--coverage-php <file>`: Serialize the code coverage data and save it to a specified file.
*   `--coverage-text <file>`: Save the code coverage report in text format to a specified file. (Default: php://stdout)
*   `--coverage-xml <dir>`: Save the code coverage report in XML format to a specified directory.

* * *

In this chapter, we discussed test coverage and its ability to aid in determining the percentage of your application that is actually tested. In the following chapter, we will dive into Pest's Type Coverage Plugin: [Type Coverage](/docs/type-coverage)

---

## Test Dependencies

[Edit this page →](https://github.com/pestphp/docs/edit/master/test-dependencies.md)

[#](#content-test-dependency "Permalink")Test Dependency
========================================================

Sometimes, tests require certain preconditions or events to occur prior to their execution or else they will not succeed. For example, you may only be able to verify that users are able to modify their accounts if you have first verified that an account can be established.

To address this issue, Pest offers the `depends()` method, which allows a "Child" test to specify that it depends on one or more "Parent" tests.

    1test('parent', function () {2    expect(true)->toBeTrue();3});4 5test('child', function () {6    expect(false)->toBeFalse();7})->depends('parent');

In this example, the `child` test will be triggered once the `parent` test has successfully completed.

![](/assets/img/depends.webp?1)

If the `parent` test fails, the `child` test will be bypassed and an informative message will be displayed in your test results.

    1test('parent', function () {2    expect(true)->toBeFalse();3});4 5test('child', function () {6    expect(false)->toBeFalse();7})->depends('parent');

The example above results in the following output:

![](/assets/img/depends-fail.webp?1)

It is important to remember that the `it()` function prefixes the test with "it" by default. Thus, when referencing the test name via the `depends()` method, you should include the "it " prefix.

    1it('is the parent', function () {2    expect(true)->toBeTrue();3});4 5test('child', function () {6    expect(false)->toBeFalse();7})->depends('it is the parent');

Results is:

![](/assets/img/depends-pass.webp?1)

Parent tests can even provide return values that can be accessed as arguments in the `child` test.

     1test('parent', function () { 2    expect(true)->toBeTrue(); 3  4    return 'from parent'; 5}); 6  7test('child', function ($parentValue) { 8    var_dump($parentValue); // from parent 9 10    expect($parentValue)->toBe('from parent');11})->depends('parent');

It is also possible to add multiple dependencies to a test. However, all parent tests must pass, and the values returned by each test will be available as function parameters in the same order as the specified dependencies.

     1test('a', function () { 2    expect(true)->toBeTrue(); 3  4    return 'a'; 5}); 6  7test('b', function () { 8    expect(true)->toBeTrue(); 9 10    return 'b';11});12 13test('c', function () {14    expect(true)->toBeTrue();15 16    return 'c';17});18 19test('d', function ($testA, $testC, $testB) {20    var_dump($testA); // a21    var_dump($testB); // b22    var_dump($testC); // c23})->depends('a', 'b', 'c');

* * *

While test dependencies are uncommon, they can be useful for optimizing your tests and minimizing the need to recreate resources repeatedly. In the next chapter, we will explore how you can create plugins: [Creating Plugins](/docs/creating-plugins)

---

## Type Coverage

[Edit this page →](https://github.com/pestphp/docs/edit/master/type-coverage.md)

[#](#content-type-coverage "Permalink")Type Coverage
====================================================

**Source code**: [github.com/pestphp/pest-plugin-type-coverage](https://github.com/pestphp/pest-plugin-type-coverage)

Type Coverage is a metric used to measure the percentage of code that is covered by type declarations. This can help developers identify parts of their code that may not be fully typed, indicating a potential risk for bugs and other issues.

To start using Pest's Type Coverage plugin, you need to require the plugin via Composer.

    1composer require pestphp/pest-plugin-type-coverage --dev

After requiring the plugin, you may utilize the `--type-coverage` option to generate a report of your type coverage.

    1./vendor/bin/pest --type-coverage

Unlike code coverage, type coverage does not require you to write any tests. Instead, it analyzes your codebase and generates a report of your type coverage. This report will display a list of files and their corresponding type coverage results.

![](/assets/img/type-coverage.png)

If any of your files are missing type declarations, they will be highlighted in yellow and displayed using their respective line numbers, and type of declaration that is missing.

As example, `rt31` means that the return type of the function on line 31 is missing. On the other hand, `pa31` means that the parameter type of the function on line 31 is missing.

[#](#content-ignoring-errors "Permalink")Ignoring Errors
--------------------------------------------------------

Sometimes, you may want to ignore a specific error or line of code. To do so, you may use the `@pest-ignore-type` annotation:

    1    protected $except = [ // @pest-ignore-type2        // ...3    ];4}

[#](#content-compact-output "Permalink")Compact Output
------------------------------------------------------

Often, when checking type coverage, you only want to see files that do not currently have 100% type coverage. To do this, you can use the `--compact` option:

    1./vendor/bin/pest --type-coverage --compact

[#](#content-minimum-threshold-enforcement "Permalink")Minimum Threshold Enforcement
------------------------------------------------------------------------------------

Just like code coverage, type coverage can also be enforced. To ensure any code that is added to your application is fully typed, you can use the `--type-coverage` and `--min` options to define the minimum threshold values for type coverage results. If the specified thresholds are not met, Pest will report a failure.

    1./vendor/bin/pest --type-coverage --min=100

[#](#content-different-formats "Permalink")Different Formats
------------------------------------------------------------

In addition, Pest supports reporting the type coverage to a specific file:

    1./vendor/bin/pest --type-coverage --min=100 --type-coverage-json=my-report.json

* * *

In this chapter, we have discussed Pest's Type Coverage plugin and how it can be used to measure the percentage of code that is covered by type declarations. In the following chapter, we explain how can you mutation testing to improve the quality of your tests: [Mutation Testing →](/docs/mutation-testing)

---

## Upgrade Guide

[Edit this page →](https://github.com/pestphp/docs/edit/master/upgrade-guide.md)

[#](#content-upgrading-to-3x-from-2x "Permalink")Upgrading To 3.x From 2.x
--------------------------------------------------------------------------

> **Estimated Upgrade Time**: 2 minutes

We make an effort to document every potential breaking change, but some of these changes may exist in less frequently used sections of the framework. As a result, only a subset of these changes may impact your application.

### [#](#content-updating-dependencies "Permalink")Updating Dependencies

> Likelihood Of Impact: High

Pest 3 now requires PHP 8.2.0 or greater. To start migrating from Pest 2 to Pest 3, update the `pestphp/pest` dependency to `^3.0` in your application's `composer.json` file.

    1-    "pestphp/pest": "^2.0",2+    "pestphp/pest": "^3.0",

In addition, if you are using Laravel, please upgrade Collision to version 8. Note that, Laravel 11 is required.

    1-    "nunomaduro/collision": "^7.0",2+    "nunomaduro/collision": "^8.0",

All other Pest maintained plugins should be updated to version `^3.0` in your application's `composer.json` file.

    1-    "pestphp/pest-plugin-laravel": "^2.0",2+    "pestphp/pest-plugin-laravel": "^3.0",

### [#](#content-phpunit-11-changes "Permalink")PHPUnit 11 Changes

> Likelihood Of Impact: Medium

Pest 3 is built on top of PHPUnit 11. This means that any notable changes made to PHPUnit 11 might have an impact on your test suite. To examine all the changes introduced in PHPUnit 11, please consult the [PHPUnit 11 changelog](https://github.com/sebastianbergmann/phpunit/blob/11.0.0/ChangeLog-11.0.md).

### [#](#content-tohavemethod-and-tohavemethods-expectations "Permalink")`toHaveMethod` and `toHaveMethods` Expectations

> Likelihood Of Impact: Low

The `toHaveMethod` and `toHaveMethods` expectations were replaced by the `toHaveMethod` and `toHaveMethods` architectural expectations. If you were using these expectations, you can no longer provide a object as architectural expectations expect an namespace or a class name.

    1-expect($object)->toHaveMethod('method');2+expect($object::class)->toHaveMethod('method');

### [#](#content-pest "Permalink")`pest()`

### [#](#content-pest-2-deprecations "Permalink")Pest 2 Deprecations

During Pest 2 release, some features were deprecated and are now removed in Pest 3. Here are the changes you should be aware of:

#### [#](#content-tap-method "Permalink")`tap()` Method

> Likelihood Of Impact: Low

When performing high order testing, you might have utilized the `tap()` method to invoke assertions on an object that needs lazy evaluation during runtime. With Pest 2, the `tap()` method is deprecated, and on Pest 3 it was removed. Instead, you should use the `defer()` method.

    1it('creates admins')2-    ->tap(fn () => $this->artisan('user:create --admin'))3+    ->defer(fn () => $this->artisan('user:create --admin'))4     ->assertDatabaseHas('users', ['id' => 1]);

* * *

[#](#content-upgrading-to-2x-from-1x "Permalink")Upgrading To 2.x From 1.x
--------------------------------------------------------------------------

> **Estimated Upgrade Time**: 2 minutes

We make an effort to document every potential breaking change, but some of these changes may exist in less frequently used sections of the framework. As a result, only a subset of these changes may impact your application.

### [#](#content-updating-dependencies-1 "Permalink")Updating Dependencies

> Likelihood Of Impact: High

Pest 2 requires PHP 8.1.0 or greater. To start migrating from Pest 1 to Pest 2, update the `pestphp/pest` dependency to `^2.0` in your application's `composer.json` file.

    1-    "pestphp/pest": "^1.22",2+    "pestphp/pest": "^2.0",

Next, you can remove PHPUnit from your list of dependencies if it is included.

    1-    "phpunit/phpunit": "^9.5.10",

In addition, if you are using Laravel, please upgrade Collision to version 7. Note that, Laravel 10 is required.

    1-    "nunomaduro/collision": "^6.0",2+    "nunomaduro/collision": "^7.0",

If you are using the Parallel Plugin (or Paratest), you may remove it from your dependencies since it is now included with Pest by default.

    1-    "brianium/paratest": "^6.8.1",2-    "pestphp/pest-plugin-parallel": "^1.2.1",

The Global Assertions Plugin is archived and should be removed from your dependencies.

    1-    "pestphp/pest-plugin-global-assertions": "^1.0.0",

If you relied on the Global Assertions Plugin, you may access the same underlying assertions using the `$this` variable. Alternatively, you may migrate to the [Expectation API](/docs/expectations).

    1test('sum', function () {2    $result = sum(1, 2);3 4-   assertSame(3, $result);5+   $this->assertSame(3, $result); // or expect($result)->toBe(3)6});

All other Pest maintained plugins should be updated to version `^2.0` in your application's `composer.json` file.

    1-    "pestphp/pest-plugin-laravel": "^1.4",2+    "pestphp/pest-plugin-laravel": "^2.0",

If you are using the Faker Plugin, the `faker()` function has been renamed to `fake()`. You will need to update all uses.

    1- use function Pest\Faker\faker;2+ use function Pest\Faker\fake;3 4test('faker', function () {5-   expect(faker()->name())->toBeString();6+   expect(fake()->name())->toBeString();7});

### [#](#content-phpunit-10-changes "Permalink")PHPUnit 10 Changes

> Likelihood Of Impact: Medium

If you were previously using PHPUnit instead of Pest, it's possible that your `phpunit.xml` file needs to be updated. When this is the case, you may encounter the following message when running Pest 2 for the first time.

    1WARN  Your XML configuration validates against a deprecated schema. Migrate your XML configuration using "--migrate-configuration"!

To address this issue, simply re-run Pest with the `--migrate-configuration` option.

    1./vendor/bin/pest --migrate-configuration

Pest 2 is built on top of PHPUnit 10. This means that any notable changes made to PHPUnit 10 might have an impact on your test suite. To examine all the changes introduced in PHPUnit 10, please consult the [PHPUnit 10 changelog](https://github.com/sebastianbergmann/phpunit/blob/10.0.0/ChangeLog-10.0.md#1000---2023-02-03).

### [#](#content-high-order-testing "Permalink")High Order Testing

> Likelihood Of Impact: Low

When performing high order testing, you might have utilized the `tap()` method to invoke assertions on an object that needs lazy evaluation during runtime. With Pest 2, the `tap()` method is deprecated. Instead, you should use the `defer()` method.

    1it('creates admins')2-    ->tap(fn () => $this->artisan('user:create --admin'))3+    ->defer(fn () => $this->artisan('user:create --admin'))4     ->assertDatabaseHas('users', ['id' => 1]);

### [#](#content-datasets "Permalink")Datasets

#### [#](#content-bound-datasets "Permalink")Bound Datasets

> Likelihood Of Impact: Very low

If you are utilizing "bound" datasets and binding a single dataset argument, you must now type the corresponding test parameter.

    1-it('can generate the full name of a user', function ($user, $fullName) {2+it('can generate the full name of a user', function (User $user, $fullName) {3    expect($user->full_name)->toBe($fullName);4})->with([5    [fn() => User::factory()->create(['first_name' => 'Nuno', 'last_name' => 'Maduro']), 'Nuno Maduro'],6    [fn() => User::factory()->create(['first_name' => 'Luke', 'last_name' => 'Downing']), 'Luke Downing'],7    [fn() => User::factory()->create(['first_name' => 'Freek', 'last_name' => 'Van Der Herten']), 'Freek Van Der Herten'],8]);

#### [#](#content-scoped-datasets "Permalink")Scoped Datasets

> Likelihood Of Impact: Very low

Although we previously documented in Pest 1 that datasets should only be declared using the `dataset` function in the `tests/Pest.php` or `tests/Datasets.php` files, you could actually declare datasets in any test file within your test suite. However, in Pest 2, with the introduction of [scoped datasets](/docs/datasets#content-scoped-datasets), datasets declared in a test file can only be utilized within that same test file. Therefore, if you have a dataset that needs to be accessible globally, please ensure that it is placed in either the `tests/Pest.php` or `tests/Datasets.php` files.

* * *

This concludes the Pest 2 upgrade guide. On the next chapter, we'll cover how can you easily migrate your tests from PHPUnit to Pest: [Migrating From PHPUnit](/docs/migrating-from-phpunit-guide)

---

## Video Resources

[Edit this page →](https://github.com/pestphp/docs/edit/master/video-resources.md)

[#](#content-video-resources "Permalink")Video Resources
========================================================

In this section, you will find a list of some of the video resources available online. These videos cover everything from the fundamentals of Pest to advanced testing concepts.

### [#](#content-conference-talks "Permalink")Conference Talks

We have gathered here some inspiring and exciting conference talks about Pest PHP.

*   [Laracon US 2024: Pest 3](https://www.youtube.com/watch?v=BNhbgcNJyAk) by Nuno Maduro
*   [Laracon AU 2023: What's new in Pest](https://www.youtube.com/watch?v=595zXXZkoNc) by Nuno Maduro
*   [Laracon US 2023: What's new in Pest](https://www.youtube.com/watch?v=vb02YE2xx44) by Nuno Maduro
*   [Laracon IN 2023: Future Of Pest](https://www.youtube.com/watch?v=9EGPo_enEc8) by Nuno Maduro
*   [Laracon EU 2022: Living your Pest file](https://www.youtube.com/watch?v=b3ybZlxrZZY) by Luke Downing
*   [PHPDay 2022: Introducing Pest](https://www.youtube.com/watch?v=MqiGA34ZrQU) by Nuno Maduro
*   [Laracon EU Online 2020: Introducing Pest](https://www.youtube.com/watch?v=lEvau6CgqPE) by Nuno Maduro
*   [PHP Community Summit 2020: Introducing Pest](https://www.youtube.com/watch?v=HZ4bfV24OpE) by Nuno Maduro

### [#](#content-courses "Permalink")Courses

The courses listed here are endorsed by Pest and were carefully created to bring high-quality content about PHP testing.

*   [Pest From Scratch](http://pestfromscratch.com) presented by Luke Downing at [Laracasts](https://laracasts.com/series/pest-from-scratch)
*   [Up And Running with Pest](https://codecourse.com/courses/up-and-running-with-pest) by Codecourse
*   [Testing Laravel](https://testing-laravel.com/) by Spatie

### [#](#content-pest-meetups "Permalink")Pest Meetups

Here you will find all past episodes of our Pest Meetups YouTube live streams.

*   [Pest Meetup #1](https://www.youtube.com/watch?v=q_8kRlAIyms) - "Testing Livewire with Pest" by Tio Jobs & "Testing REST API with Pest & Bypass" by @DanSysAnalyst
*   [Pest Meetup #2](https://www.youtube.com/watch?v=dyMxI1x7rRc) - "Diving Into The Expectation API" by Luke Downing & "Using Snapshots In Pest" by Freek Van der Herten
*   [Pest Meetup #3 Talk 1](https://www.youtube.com/watch?v=55jsO7Kb8hI) - "Simple, expressive tests with Pest" by Mateus Guimarães
*   [Pest Meetup #3 Talk 2](https://www.youtube.com/watch?v=-eB6vdxk8bw) - "Parallel tests by Luke Downing" by Luke Downing

### [#](#content-pest-community-videos "Permalink")Pest Community Videos

Ever since the introduction of Pest to the world, the community has been inundating social media with online video courses on the subject. This has left us feeling deeply appreciative, as some individuals enjoy continuing learning about Pest and testing through video material.

Below you find videos created by the Pest community. All the content listed in this subsection is publicly available and free of charge to access.

#### [#](#content-english "Permalink")English

*   [Pest - An Elegant PHP Testing Framework](https://www.youtube.com/watch?v=vp0jP5rMvR4) by Andre Madarang
*   [Reviews Pest for the First Time](https://www.youtube.com/watch?v=LVYIMoOKTzg) by Laracasts
*   [Laravel Testing 21/24: What is Pest and How It Works](https://www.youtube.com/watch?v=4ubp_IF6kqY) by Laravel Daily
*   [Converting a PHPUnit testsuite to Pest](https://www.youtube.com/watch?v=81-r9THrJhI) by Spatie
*   [Pest in Practice](https://www.youtube.com/watch?v=UW9c6Q782l8) by Luke Downing
*   [Pest v2 Release and how to intercept the expectation API](https://www.youtube.com/watch?v=Zu1U4oWJKn4) by Ruslan Steiger

#### [#](#content-brazilian-portuguese "Permalink")Brazilian Portuguese

*   [Pest PHP na prática - Live coding](https://www.youtube.com/watch?v=lttvqLXBL6k) by Beer and Code
*   [Pest: Uma nova forma de escrever testes em PHP](https://www.youtube.com/watch?v=c7s4MW1OGoY) by Dias de Dev
*   [Pest 2.0 e suas novas funcionalidades](https://www.youtube.com/watch?v=Scu-pTDWTF4) by Pinguim do Laravel

#### [#](#content-french "Permalink")French

*   [Tester son application avec Pest](https://www.youtube.com/watch?v=WYC_H9lR7Rw) by Laravel Jutsu

#### [#](#content-german "Permalink")German

*   [Laravel DACH Meetup Oktober 2022: Testing mit Laravel Pest](https://www.youtube.com/watch?v=k6SRTwhb6cY) by byte5 GmbH

#### [#](#content-spanish "Permalink")Spanish

*   [Testing con Pest en Laravel 9 desde Zero](https://www.youtube.com/watch?v=X9o0ixXrdQI&t=16s) by CursosDesarrolloWeb

[#](#content-independent-creators-non-free "Permalink")Independent Creators (non-free)
--------------------------------------------------------------------------------------

Here you can find links to Pest courses created by individual producers and made accessible on various paid platforms.

*   [Laravel Testing 101](https://www.linkedin.com/learning/laravel-testing-101) by Ana Lisboa
*   [Pest Driven Laravel](https://laracasts.com/series/pest-driven-laravel) by Christoph Rumpel on Laracasts

* * *

Understanding the significance of video resources in the learning process, we trust that you have found this chapter enjoyable. In the upcoming chapter, you will find comprehensive details regarding Pest's support policy: [Support Policy](/docs/support-policy)

---

## Why Pest

[Edit this page →](https://github.com/pestphp/docs/edit/master/why-pest.md)

[#](#content-why-pest "Permalink")Why Pest
==========================================

When testing PHP code, you have access to a range of frameworks. Nevertheless, we believe that Pest is the most elegant and sophisticated testing framework in the world. It's designed to make the testing process enjoyable, and our goal is to make tests easy to read and understand, with a code syntax that closely resembles natural human language.

    1function sum($a, $b) {2    return $a + $b;3}4 5test('sum', function () {6  $result = sum(1, 2);7 8  expect($result)->toBe(3);9});

You can expect a smooth and efficient coding experience thanks to Pest's easy-to-use API inspired by Ruby's Rspec and Jest. In addition, the test reporting is well-organized, practical, and informative, with clear and concise error and stack trace displays for quick debugging. With Pest, you can obtain test reporting that is unmatched in its beauty, directly from the console!

![](/assets/img/failure.webp?1)

In addition to its exceptional test reporting, Pest also offers a range of other valuable features, including:

*   Built-in [parallel](/docs/optimizing-tests#parallel) features for faster test runs
*   Beautiful [documentation](/docs/installation) that's easy to navigate
*   Native [profiling tools](/docs/optimizing-tests#profiling) to optimize slow-running tests
*   Out-of-the-box [Architectural Testing](/docs/arch-testing) to test application rules
*   [Coverage](/docs/test-coverage) report directly on the terminal to track code coverage
*   [Mutation Testing](#mutation-testing) to evaluate the quality of your test suite
*   [Team Management](/docs/team-management) to manage tasks / todos with your team
*   Dozens of [optional plugins](/docs/plugins), such as Watch Mode and [Snapshot testing](https://github.com/spatie/pest-plugin-snapshots), to customize Pest to fit your needs.

Whether you're engaged in a small personal project or a large-scale enterprise application, Pest has got you covered. So if you want to make the testing process enjoyable and efficient, give Pest a try. We're confident that you'll love it as much as we do.

* * *

You can learn about how to install Pest by visiting the next section of the documentation: [Installation →](/docs/installation)

---

## Writing Tests

[Edit this page →](https://github.com/pestphp/docs/edit/master/writing-tests.md)

[#](#content-writing-tests "Permalink")Writing Tests
====================================================

In this section, we will provide a brief overview of how to write tests using Pest. After successfully [installing Pest](/docs/installation), you will find the following files and folders in your project:

    1├── 📂 tests2│   ├── 📂 Unit3│   │   └── ExampleTest.php4│   └── 📂 Feature5│   │   └── ExampleTest.php6│   └── TestCase.php7│   └── Pest.php8├── phpunit.xml

The `tests` folder serves as the main directory where all your test files will reside. Within this folder, you will find two sub-folders, `Unit` and `Feature`, which house your unit and feature tests, respectively. The `TestCase.php` file is where you can define common functionality or setup that you want to use across all your tests. Lastly, the `Pest.php` file is where you can [configure your test suite](/docs/configuring-tests).

Additionally, a `phpunit.xml` file can be found in the root of your project, and is used to configure PHPUnit's various options when running tests. It's important to note that Pest is built on top of PHPUnit, which means that all the options offered by PHPUnit can also be used in Pest. Therefore, any customization or configuration that you do with the `phpunit.xml` file will also apply to Pest tests.

As you begin writing tests for your project, it's important to consider how to create and organize your test files effectively. Typically, test files are suffixed with `Test.php`, such as `ExampleTest.php`.

[#](#content-your-first-test "Permalink")Your First Test
--------------------------------------------------------

For our first test, let's write something simple. Imagine that your project features a global function called `sum` that adds two numbers together. To test this function, you would create a `Tests\Unit\SumTest.php` file with the following code.

    1test('sum', function () {2   $result = sum(1, 2);3 4   expect($result)->toBe(3);5});

After writing your test code, it's time to run your tests using Pest. When you execute the `./vendor/bin/pest` command, Pest will display a message indicating whether your tests passed or failed.

![](/assets/img/sum.webp?1)

As an alternative to the `test()` function, Pest provides the convenient `it()` function that simply prefixes the test description with the word "it", making your tests more readable.

    1it('performs sums', function () {2   $result = sum(1, 2);3 4   expect($result)->toBe(3);5});

In this case, when you run the `./vendor/bin/pest` command, the output will include the description "it performs sums", along with the result of the test.

![](/assets/img/itsum.webp?1)

Finally, you can also use the `describe()` function to group related tests together. For instance, you can use the `describe()` function to group all your tests related to the `sum()` function.

     1describe('sum', function () { 2   it('may sum integers', function () { 3       $result = sum(1, 2); 4  5       expect($result)->toBe(3); 6    }); 7  8    it('may sum floats', function () { 9       $result = sum(1.5, 2.5);10 11       expect($result)->toBe(4.0);12    });13});

When you run the `./vendor/bin/pest` command, the output will include the description "sum performs sums", along with the result of the test.

[#](#content-expectation-api "Permalink")Expectation API
--------------------------------------------------------

As you may have noticed in our previous examples, we made use of Pest's expectation API to perform assertions in our test code. The `expect()` function is a core part of the expectation API and is used to assert that certain conditions are met.

For instance, in our previous example, we used `expect($result)->toBe(3)` to ensure that the value of `$result` is equal to `3`. Pest's expectation API provides a variety of other assertion functions that you can use to test the behavior of your code, such as `toBeTrue()`, `toBeFalse()`, and `toContain()`.

By using the expectation API, you can write concise and readable assertions that make it clear what your code is doing and how it should behave. In the [next section](/docs/expectations), we will cover some of the most commonly used assertion functions in Pest's expectation API.

[#](#content-assertion-api "Permalink")Assertion API
----------------------------------------------------

While Pest's expectation API provides a convenient way to perform assertions, it's not the only option available. You can also use PHPUnit's assertion API, which can be useful if you're already familiar with PHPUnit's assertion API or if you need to perform more complex assertions that aren't available in Pest's expectation API.

    1test('sum', function () {2   $result = sum(1, 2);3 4   $this->assertSame(3, $result); // Same as expect($result)->toBe(3)5});

You can find the full documentation for PHPUnit's assertion API on the PHPUnit website: [docs.phpunit.de/en/11.4/assertions.html](https://docs.phpunit.de/en/11.4/assertions.html)

* * *

Continue to our next section, for more information on how to use the Expectation API: [Expectations →](/docs/expectations)

---