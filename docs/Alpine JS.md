# Alpine JS

## Índice

- [Alpine Bind](#alpine-bind)

- [Alpine Data](#alpine-data)

- [Alpine Store](#alpine-store)

- [Anchor](#anchor)

- [Async](#async)

- [Bind](#bind)

- [Cloak](#cloak)

- [Collapse](#collapse)

- [Csp](#csp)

- [Data](#data)

- [Dispatch](#dispatch)

- [Effect](#effect)

- [El](#el)

- [Events](#events)

- [Extending](#extending)

- [Focus](#focus)

- [For](#for)

- [Html](#html)

- [Id](#id)

- [If](#if)

- [Ignore](#ignore)

- [Init](#init)

- [Installation](#installation)

- [Intersect](#intersect)

- [Lifecycle](#lifecycle)

- [Mask](#mask)

- [Model](#model)

- [Modelable](#modelable)

- [Morph](#morph)

- [NextTick](#nexttick)

- [On](#on)

- [Persist](#persist)

- [Reactivity](#reactivity)

- [Ref](#ref)

- [Refs](#refs)

- [Resize](#resize)

- [Root](#root)

- [Show](#show)

- [Sort](#sort)

- [Start Here](#start-here)

- [State](#state)

- [Store](#store)

- [Teleport](#teleport)

- [Templating](#templating)

- [Text](#text)

- [Transition](#transition)

- [Upgrade Guide](#upgrade-guide)

- [Watch](#watch)

## Alpine Bind

Alpine.bind
===========

`Alpine.bind(...)` provides a way to re-use [`x-bind`](/directives/bind#bind-directives) objects within your application.

Here's a simple example. Rather than binding attributes manually with Alpine:

    <button type="button" @click="doSomething()" :disabled="shouldDisable"></button>
    <button type="button" @click="doSomething()" :disabled="shouldDisable"></button>

You can bundle these attributes up into a reusable object and use `x-bind` to bind to that:

    <button x-bind="SomeButton"></button> <script>    document.addEventListener('alpine:init', () => {        Alpine.bind('SomeButton', () => ({            type: 'button',             '@click'() {                this.doSomething()            },             ':disabled'() {                return this.shouldDisable            },        }))    })</script>
    <button x-bind="SomeButton"></button>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.bind('SomeButton', () => ({
                type: 'button',
    
                '@click'() {
                    this.doSomething()
                },
    
                ':disabled'() {
                    return this.shouldDisable
                },
            }))
        })
    </script>

[← Alpine.store()](/globals/alpine-store)

[Mask →](/plugins/mask)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Alpine Data

Alpine.data
===========

`Alpine.data(...)` provides a way to re-use `x-data` contexts within your application.

Here's a contrived `dropdown` component for example:

    <div x-data="dropdown">    <button @click="toggle">...</button>     <div x-show="open">...</div></div> <script>    document.addEventListener('alpine:init', () => {        Alpine.data('dropdown', () => ({            open: false,             toggle() {                this.open = ! this.open            }        }))    })</script>
    <div x-data="dropdown">
        <button @click="toggle">...</button>
    
        <div x-show="open">...</div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
    
                toggle() {
                    this.open = ! this.open
                }
            }))
        })
    </script>

As you can see we've extracted the properties and methods we would usually define directly inside `x-data` into a separate Alpine component object.

[Registering from a bundle](#registering-from-a-bundle)
-------------------------------------------------------

If you've chosen to use a build step for your Alpine code, you should register your components in the following way:

    import Alpine from 'alpinejs'import dropdown from './dropdown.js' Alpine.data('dropdown', dropdown) Alpine.start()
    import Alpine from 'alpinejs'
    import dropdown from './dropdown.js'
    
    Alpine.data('dropdown', dropdown)
    
    Alpine.start()

This assumes you have a file called `dropdown.js` with the following contents:

    export default () => ({    open: false,     toggle() {        this.open = ! this.open    }})
    export default () => ({
        open: false,
    
        toggle() {
            this.open = ! this.open
        }
    })

[Initial parameters](#initial-parameters)
-----------------------------------------

In addition to referencing `Alpine.data` providers by their name plainly (like `x-data="dropdown"`), you can also reference them as functions (`x-data="dropdown()"`). By calling them as functions directly, you can pass in additional parameters to be used when creating the initial data object like so:

    <div x-data="dropdown(true)">
    <div x-data="dropdown(true)">

    Alpine.data('dropdown', (initialOpenState = false) => ({    open: initialOpenState}))
    Alpine.data('dropdown', (initialOpenState = false) => ({
        open: initialOpenState
    }))

Now, you can re-use the `dropdown` object, but provide it with different parameters as you need to.

[Init functions](#init-functions)
---------------------------------

If your component contains an `init()` method, Alpine will automatically execute it before it renders the component. For example:

    Alpine.data('dropdown', () => ({    init() {        // This code will be executed before Alpine        // initializes the rest of the component.    }}))
    Alpine.data('dropdown', () => ({
        init() {
            // This code will be executed before Alpine
            // initializes the rest of the component.
        }
    }))

[Destroy functions](#destroy-functions)
---------------------------------------

If your component contains a `destroy()` method, Alpine will automatically execute it before cleaning up the component.

A primary example for this is when registering an event handler with another library or a browser API that isn't available through Alpine. See the following example code on how to use the `destroy()` method to clean up such a handler.

    Alpine.data('timer', () => ({    timer: null,    counter: 0,    init() {      // Register an event handler that references the component instance      this.timer = setInterval(() => {        console.log('Increased counter to', ++this.counter);      }, 1000);    },    destroy() {        // Detach the handler, avoiding memory and side-effect leakage        clearInterval(this.timer);    },}))
    Alpine.data('timer', () => ({
        timer: null,
        counter: 0,
        init() {
          // Register an event handler that references the component instance
          this.timer = setInterval(() => {
            console.log('Increased counter to', ++this.counter);
          }, 1000);
        },
        destroy() {
            // Detach the handler, avoiding memory and side-effect leakage
            clearInterval(this.timer);
        },
    }))

An example where a component is destroyed is when using one inside an `x-if`:

    <span x-data="{ enabled: false }">    <button @click.prevent="enabled = !enabled">Toggle</button>     <template x-if="enabled">        <span x-data="timer" x-text="counter"></span>    </template></span>
    <span x-data="{ enabled: false }">
        <button @click.prevent="enabled = !enabled">Toggle</button>
    
        <template x-if="enabled">
            <span x-data="timer" x-text="counter"></span>
        </template>
    </span>

[Using magic properties](#using-magic-properties)
-------------------------------------------------

If you want to access magic methods or properties from a component object, you can do so using the `this` context:

    Alpine.data('dropdown', () => ({    open: false,     init() {        this.$watch('open', () => {...})    }}))
    Alpine.data('dropdown', () => ({
        open: false,
    
        init() {
            this.$watch('open', () => {...})
        }
    }))

[Encapsulating directives with `x-bind`](#encapsulating-directives-with-x-bind)
-------------------------------------------------------------------------------

If you wish to re-use more than just the data object of a component, you can encapsulate entire Alpine template directives using `x-bind`.

The following is an example of extracting the templating details of our previous dropdown component using `x-bind`:

    <div x-data="dropdown">    <button x-bind="trigger"></button>     <div x-bind="dialogue"></div></div>
    <div x-data="dropdown">
        <button x-bind="trigger"></button>
    
        <div x-bind="dialogue"></div>
    </div>

    Alpine.data('dropdown', () => ({    open: false,     trigger: {        ['@click']() {            this.open = ! this.open        },    },     dialogue: {        ['x-show']() {            return this.open        },    },}))
    Alpine.data('dropdown', () => ({
        open: false,
    
        trigger: {
            ['@click']() {
                this.open = ! this.open
            },
        },
    
        dialogue: {
            ['x-show']() {
                return this.open
            },
        },
    }))

[← $id](/magics/id)

[Alpine.store() →](/globals/alpine-store)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Alpine Store

Alpine.store
============

Alpine offers global state management through the `Alpine.store()` API.

[Registering A Store](#registering-a-store)
-------------------------------------------

You can either define an Alpine store inside of an `alpine:init` listener (in the case of including Alpine via a `<script>` tag), OR you can define it before manually calling `Alpine.start()` (in the case of importing Alpine into a build):

**From a script tag:**

    <script>    document.addEventListener('alpine:init', () => {        Alpine.store('darkMode', {            on: false,             toggle() {                this.on = ! this.on            }        })    })</script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                on: false,
    
                toggle() {
                    this.on = ! this.on
                }
            })
        })
    </script>

**From a bundle:**

    import Alpine from 'alpinejs' Alpine.store('darkMode', {    on: false,     toggle() {        this.on = ! this.on    }}) Alpine.start()
    import Alpine from 'alpinejs'
    
    Alpine.store('darkMode', {
        on: false,
    
        toggle() {
            this.on = ! this.on
        }
    })
    
    Alpine.start()

[Accessing stores](#accessing stores)
-------------------------------------

You can access data from any store within Alpine expressions using the `$store` magic property:

    <div x-data :class="$store.darkMode.on && 'bg-black'">...</div>
    <div x-data :class="$store.darkMode.on && 'bg-black'">...</div>

You can also modify properties within the store and everything that depends on those properties will automatically react. For example:

    <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>
    <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>

Additionally, you can access a store externally using `Alpine.store()` by omitting the second parameter like so:

    <script>    Alpine.store('darkMode').toggle()</script>
    <script>
        Alpine.store('darkMode').toggle()
    </script>

[Initializing stores](#initializing-stores)
-------------------------------------------

If you provide `init()` method in an Alpine store, it will be executed right after the store is registered. This is useful for initializing any state inside the store with sensible starting values.

    <script>    document.addEventListener('alpine:init', () => {        Alpine.store('darkMode', {            init() {                this.on = window.matchMedia('(prefers-color-scheme: dark)').matches            },             on: false,             toggle() {                this.on = ! this.on            }        })    })</script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                init() {
                    this.on = window.matchMedia('(prefers-color-scheme: dark)').matches
                },
    
                on: false,
    
                toggle() {
                    this.on = ! this.on
                }
            })
        })
    </script>

Notice the newly added `init()` method in the example above. With this addition, the `on` store variable will be set to the browser's color scheme preference before Alpine renders anything on the page.

[Single-value stores](#single-value-stores)
-------------------------------------------

If you don't need an entire object for a store, you can set and use any kind of data as a store.

Here's the example from above but using it more simply as a boolean value:

    <button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button> ... <div x-data :class="$store.darkMode && 'bg-black'">    ...</div>  <script>    document.addEventListener('alpine:init', () => {        Alpine.store('darkMode', false)    })</script>
    <button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button>
    
    ...
    
    <div x-data :class="$store.darkMode && 'bg-black'">
        ...
    </div>
    
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', false)
        })
    </script>

[← Alpine.data()](/globals/alpine-data)

[Alpine.bind() →](/globals/alpine-bind)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Anchor

Anchor Plugin
=============

Alpine's Anchor plugin allows you to easily anchor an element's positioning to another element on the page.

This functionality is useful when creating dropdown menus, popovers, dialogs, and tooltips with Alpine.

The "anchoring" functionality used in this plugin is provided by the [Floating UI](https://floating-ui.com/) project.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Anchor from NPM for use inside your bundle like so:

    npm install @alpinejs/anchor
    npm install @alpinejs/anchor

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import anchor from '@alpinejs/anchor' Alpine.plugin(anchor) ...
    import Alpine from 'alpinejs'
    import anchor from '@alpinejs/anchor'
    
    Alpine.plugin(anchor)
    
    ...

[x-anchor](#x-anchor)
---------------------

The primary API for using this plugin is the `x-anchor` directive.

To use this plugin, add the `x-anchor` directive to any element and pass it a reference to the element you want to anchor it's position to (often a button on the page).

By default, `x-anchor` will set the element's CSS to `position: absolute` and the appropriate `top` and `left` values. If the anchored element is normally displayed below the reference element but doesn't have room on the page, it's styling will be adjusted to render above the element.

For example, here's a simple dropdown anchored to the button that toggles it:

    <div x-data="{ open: false }">    <button x-ref="button" @click="open = ! open">Toggle</button>     <div x-show="open" x-anchor="$refs.button">        Dropdown content    </div></div>
    <div x-data="{ open: false }">
        <button x-ref="button" @click="open = ! open">Toggle</button>
    
        <div x-show="open" x-anchor="$refs.button">
            Dropdown content
        </div>
    </div>

Toggle

Dropdown content

[Positioning](#positioning)
---------------------------

`x-anchor` allows you to customize the positioning of the anchored element using the following modifiers:

*   Bottom: `.bottom`, `.bottom-start`, `.bottom-end`
*   Top: `.top`, `.top-start`, `.top-end`
*   Left: `.left`, `.left-start`, `.left-end`
*   Right: `.right`, `.right-start`, `.right-end`

Here is an example of using `.bottom-start` to position a dropdown below and to the right of the reference element:

    <div x-data="{ open: false }">    <button x-ref="button" @click="open = ! open">Toggle</button>     <div x-show="open" x-anchor.bottom-start="$refs.button">        Dropdown content    </div></div>
    <div x-data="{ open: false }">
        <button x-ref="button" @click="open = ! open">Toggle</button>
    
        <div x-show="open" x-anchor.bottom-start="$refs.button">
            Dropdown content
        </div>
    </div>

Toggle

Dropdown content

[Offset](#offset)
-----------------

You can add an offset to your anchored element using the `.offset.[px value]` modifier like so:

    <div x-data="{ open: false }">    <button x-ref="button" @click="open = ! open">Toggle</button>     <div x-show="open" x-anchor.offset.10="$refs.button">        Dropdown content    </div></div>
    <div x-data="{ open: false }">
        <button x-ref="button" @click="open = ! open">Toggle</button>
    
        <div x-show="open" x-anchor.offset.10="$refs.button">
            Dropdown content
        </div>
    </div>

Toggle

Dropdown content

[Manual styling](#manual-styling)
---------------------------------

By default, `x-anchor` applies the positioning styles to your element under the hood. If you'd prefer full control over styling, you can pass the `.no-style` modifer and use the `$anchor` magic to access the values inside another Alpine expression.

Below is an example of bypassing `x-anchor`'s internal styling and instead applying the styles yourself using `x-bind:style`:

    <div x-data="{ open: false }">    <button x-ref="button" @click="open = ! open">Toggle</button>     <div        x-show="open"        x-anchor.no-style="$refs.button"        x-bind:style="{ position: 'absolute', top: $anchor.y+'px', left: $anchor.x+'px' }"    >        Dropdown content    </div></div>
    <div x-data="{ open: false }">
        <button x-ref="button" @click="open = ! open">Toggle</button>
    
        <div
            x-show="open"
            x-anchor.no-style="$refs.button"
            x-bind:style="{ position: 'absolute', top: $anchor.y+'px', left: $anchor.x+'px' }"
        >
            Dropdown content
        </div>
    </div>

Toggle

Dropdown content

[Anchor to an ID](#from-id)
---------------------------

The examples thus far have all been anchoring to other elements using Alpine refs.

Because `x-anchor` accepts a reference to any DOM element, you can use utilities like `document.getElementById()` to anchor to an element by its `id` attribute:

    <div x-data="{ open: false }">    <button id="trigger" @click="open = ! open">Toggle</button>     <div x-show="open" x-anchor="document.getElementById('trigger')">        Dropdown content    </div></div>
    <div x-data="{ open: false }">
        <button id="trigger" @click="open = ! open">Toggle</button>
    
        <div x-show="open" x-anchor="document.getElementById('trigger')">
            Dropdown content
        </div>
    </div>

Toggle

Dropdown content

[← Collapse](/plugins/collapse)

[Morph →](/plugins/morph)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Async

Async
=====

Alpine is built to support asynchronous functions in most places it supports standard ones.

For example, let's say you have a simple function called `getLabel()` that you use as the input to an `x-text` directive:

    function getLabel() {    return 'Hello World!'}
    function getLabel() {
        return 'Hello World!'
    }

    <span x-text="getLabel()"></span>
    <span x-text="getLabel()"></span>

Because `getLabel` is synchronous, everything works as expected.

Now let's pretend that `getLabel` makes a network request to retrieve the label and can't return one instantaneously (asynchronous). By making `getLabel` an async function, you can call it from Alpine using JavaScript's `await` syntax.

    async function getLabel() {    let response = await fetch('/api/label')     return await response.text()}
    async function getLabel() {
        let response = await fetch('/api/label')
    
        return await response.text()
    }

    <span x-text="await getLabel()"></span>
    <span x-text="await getLabel()"></span>

Additionally, if you prefer calling methods in Alpine without the trailing parenthesis, you can leave them out and Alpine will detect that the provided function is async and handle it accordingly. For example:

    <span x-text="getLabel"></span>
    <span x-text="getLabel"></span>

[← Extending](/advanced/extending)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Bind

x-bind
======

`x-bind` allows you to set HTML attributes on elements based on the result of JavaScript expressions.

For example, here's a component where we will use `x-bind` to set the placeholder value of an input.

    <div x-data="{ placeholder: 'Type here...' }">    <input type="text" x-bind:placeholder="placeholder"></div>
    <div x-data="{ placeholder: 'Type here...' }">
        <input type="text" x-bind:placeholder="placeholder">
    </div>

[Shorthand syntax](#shorthand-syntax)
-------------------------------------

If `x-bind:` is too verbose for your liking, you can use the shorthand: `:`. For example, here is the same input element as above, but refactored to use the shorthand syntax.

    <input type="text" :placeholder="placeholder">
    <input type="text" :placeholder="placeholder">

> Despite not being included in the above snippet, `x-bind` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

[Binding classes](#binding-classes)
-----------------------------------

`x-bind` is most often useful for setting specific classes on an element based on your Alpine state.

Here's a simple example of a simple dropdown toggle, but instead of using `x-show`, we'll use a "hidden" class to toggle an element.

    <div x-data="{ open: false }">    <button x-on:click="open = ! open">Toggle Dropdown</button>     <div :class="open ? '' : 'hidden'">        Dropdown Contents...    </div></div>
    <div x-data="{ open: false }">
        <button x-on:click="open = ! open">Toggle Dropdown</button>
    
        <div :class="open ? '' : 'hidden'">
            Dropdown Contents...
        </div>
    </div>

Now, when `open` is `false`, the "hidden" class will be added to the dropdown.

### [Shorthand conditionals](#shorthand-conditionals)

In cases like these, if you prefer a less verbose syntax you can use JavaScript's short-circuit evaluation instead of standard conditionals:

    <div :class="show ? '' : 'hidden'"><!-- Is equivalent to: --><div :class="show || 'hidden'">
    <div :class="show ? '' : 'hidden'">
    <!-- Is equivalent to: -->
    <div :class="show || 'hidden'">

The inverse is also available to you. Suppose instead of `open`, we use a variable with the opposite value: `closed`.

    <div :class="closed ? 'hidden' : ''"><!-- Is equivalent to: --><div :class="closed && 'hidden'">
    <div :class="closed ? 'hidden' : ''">
    <!-- Is equivalent to: -->
    <div :class="closed && 'hidden'">

### [Class object syntax](#class-object-syntax)

Alpine offers an additional syntax for toggling classes if you prefer. By passing a JavaScript object where the classes are the keys and booleans are the values, Alpine will know which classes to apply and which to remove. For example:

    <div :class="{ 'hidden': ! show }">
    <div :class="{ 'hidden': ! show }">

This technique offers a unique advantage to other methods. When using object-syntax, Alpine will NOT preserve original classes applied to an element's `class` attribute.

For example, if you wanted to apply the "hidden" class to an element before Alpine loads, AND use Alpine to toggle its existence you can only achieve that behavior using object-syntax:

    <div class="hidden" :class="{ 'hidden': ! show }">
    <div class="hidden" :class="{ 'hidden': ! show }">

In case that confused you, let's dig deeper into how Alpine handles `x-bind:class` differently than other attributes.

### [Special behavior](#special-behavior)

`x-bind:class` behaves differently than other attributes under the hood.

Consider the following case.

    <div class="opacity-50" :class="hide && 'hidden'">
    <div class="opacity-50" :class="hide && 'hidden'">

If "class" were any other attribute, the `:class` binding would overwrite any existing class attribute, causing `opacity-50` to be overwritten by either `hidden` or `''`.

However, Alpine treats `class` bindings differently. It's smart enough to preserve existing classes on an element.

For example, if `hide` is true, the above example will result in the following DOM element:

    <div class="opacity-50 hidden">
    <div class="opacity-50 hidden">

If `hide` is false, the DOM element will look like:

    <div class="opacity-50">
    <div class="opacity-50">

This behavior should be invisible and intuitive to most users, but it is worth mentioning explicitly for the inquiring developer or any special cases that might crop up.

[Binding styles](#binding-styles)
---------------------------------

Similar to the special syntax for binding classes with JavaScript objects, Alpine also offers an object-based syntax for binding `style` attributes.

Just like the class objects, this syntax is entirely optional. Only use it if it affords you some advantage.

    <div :style="{ color: 'red', display: 'flex' }"> <!-- Will render: --><div style="color: red; display: flex;" ...>
    <div :style="{ color: 'red', display: 'flex' }">
    
    <!-- Will render: -->
    <div style="color: red; display: flex;" ...>

Conditional inline styling is possible using expressions just like with x-bind:class. Short circuit operators can be used here as well by using a styles object as the second operand.

    <div x-bind:style="true && { color: 'red' }"> <!-- Will render: --><div style="color: red;">
    <div x-bind:style="true && { color: 'red' }">
    
    <!-- Will render: -->
    <div style="color: red;">

One advantage of this approach is being able to mix it in with existing styles on an element:

    <div style="padding: 1rem;" :style="{ color: 'red', display: 'flex' }"> <!-- Will render: --><div style="padding: 1rem; color: red; display: flex;" ...>
    <div style="padding: 1rem;" :style="{ color: 'red', display: 'flex' }">
    
    <!-- Will render: -->
    <div style="padding: 1rem; color: red; display: flex;" ...>

And like most expressions in Alpine, you can always use the result of a JavaScript expression as the reference:

    <div x-data="{ styles: { color: 'red', display: 'flex' }}">    <div :style="styles"></div> <!-- Will render: --><div ...>    <div style="color: red; display: flex;" ...></div>
    <div x-data="{ styles: { color: 'red', display: 'flex' }}">
        <div :style="styles">
    </div>
    
    <!-- Will render: -->
    <div ...>
        <div style="color: red; display: flex;" ...>
    </div>

[Binding Alpine Directives Directly](#bind-directives)
------------------------------------------------------

`x-bind` allows you to bind an object of different directives and attributes to an element.

The object keys can be anything you would normally write as an attribute name in Alpine. This includes Alpine directives and modifiers, but also plain HTML attributes. The object values are either plain strings, or in the case of dynamic Alpine directives, callbacks to be evaluated by Alpine.

    <div x-data="dropdown">    <button x-bind="trigger">Open Dropdown</button>     <span x-bind="dialogue">Dropdown Contents</span></div> <script>    document.addEventListener('alpine:init', () => {        Alpine.data('dropdown', () => ({            open: false,             trigger: {                ['x-ref']: 'trigger',                ['@click']() {                    this.open = true                },            },             dialogue: {                ['x-show']() {                    return this.open                },                ['@click.outside']() {                    this.open = false                },            },        }))    })</script>
    <div x-data="dropdown">
        <button x-bind="trigger">Open Dropdown</button>
    
        <span x-bind="dialogue">Dropdown Contents</span>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
    
                trigger: {
                    ['x-ref']: 'trigger',
                    ['@click']() {
                        this.open = true
                    },
                },
    
                dialogue: {
                    ['x-show']() {
                        return this.open
                    },
                    ['@click.outside']() {
                        this.open = false
                    },
                },
            }))
        })
    </script>

There are a couple of caveats to this usage of `x-bind`:

> When the directive being "bound" or "applied" is `x-for`, you should return a normal expression string from the callback. For example: `['x-for']() { return 'item in items' }`

[← x-show](/directives/show)

[x-on →](/directives/on)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Cloak

x-cloak
=======

Sometimes, when you're using AlpineJS for a part of your template, there is a "blip" where you might see your uninitialized template after the page loads, but before Alpine loads.

`x-cloak` addresses this scenario by hiding the element it's attached to until Alpine is fully loaded on the page.

For `x-cloak` to work however, you must add the following CSS to the page.

    [x-cloak] { display: none !important; }
    [x-cloak] { display: none !important; }

The following example will hide the `<span>` tag until its `x-show` is specifically set to true, preventing any "blip" of the hidden element onto screen as Alpine loads.

    <span x-cloak x-show="false">This will not 'blip' onto screen at any point</span>
    <span x-cloak x-show="false">This will not 'blip' onto screen at any point</span>

`x-cloak` doesn't just work on elements hidden by `x-show` or `x-if`: it also ensures that elements containing data are hidden until the data is correctly set. The following example will hide the `<span>` tag until Alpine has set its text content to the `message` property.

    <span x-cloak x-text="message"></span>
    <span x-cloak x-text="message"></span>

When Alpine loads on the page, it removes all `x-cloak` property from the element, which also removes the `display: none;` applied by CSS, therefore showing the element.

Alternative to global syntax
----------------------------

If you'd like to achieve this same behavior, but avoid having to include a global style, you can use the following cool, but admittedly odd trick:

    <template x-if="true">    <span x-text="message"></span></template>
    <template x-if="true">
        <span x-text="message"></span>
    </template>

This will achieve the same goal as `x-cloak` by just leveraging the way `x-if` works.

Because `<template>` elements are "hidden" in browsers by default, you won't see the `<span>` until Alpine has had a chance to render the `x-if="true"` and show it.

Again, this solution is not for everyone, but it's worth mentioning for special cases.

[← x-ref](/directives/ref)

[x-teleport →](/directives/teleport)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Collapse

Collapse Plugin
===============

Alpine's Collapse plugin allows you to expand and collapse elements using smooth animations.

Because this behavior and implementation differs from Alpine's standard transition system, this functionality was made into a dedicated plugin.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Collapse from NPM for use inside your bundle like so:

    npm install @alpinejs/collapse
    npm install @alpinejs/collapse

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import collapse from '@alpinejs/collapse' Alpine.plugin(collapse) ...
    import Alpine from 'alpinejs'
    import collapse from '@alpinejs/collapse'
    
    Alpine.plugin(collapse)
    
    ...

[x-collapse](#x-collapse)
-------------------------

The primary API for using this plugin is the `x-collapse` directive.

`x-collapse` can only exist on an element that already has an `x-show` directive. When added to an `x-show` element, `x-collapse` will smoothly "collapse" and "expand" the element when it's visibility is toggled by animating its height property.

For example:

    <div x-data="{ expanded: false }">    <button @click="expanded = ! expanded">Toggle Content</button>     <p x-show="expanded" x-collapse>        ...    </p></div>
    <div x-data="{ expanded: false }">
        <button @click="expanded = ! expanded">Toggle Content</button>
    
        <p x-show="expanded" x-collapse>
            ...
        </p>
    </div>

Toggle Content

Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.

[Modifiers](#modifiers)
-----------------------

### [.duration](#dot-duration)

You can customize the duration of the collapse/expand transition by appending the `.duration` modifier like so:

    <div x-data="{ expanded: false }">    <button @click="expanded = ! expanded">Toggle Content</button>     <p x-show="expanded" x-collapse.duration.1000ms>        ...    </p></div>
    <div x-data="{ expanded: false }">
        <button @click="expanded = ! expanded">Toggle Content</button>
    
        <p x-show="expanded" x-collapse.duration.1000ms>
            ...
        </p>
    </div>

Toggle Content

Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.

### [.min](#dot-min)

By default, `x-collapse`'s "collapsed" state sets the height of the element to `0px` and also sets `display: none;`.

Sometimes, it's helpful to "cut-off" an element rather than fully hide it. By using the `.min` modifier, you can set a minimum height for `x-collapse`'s "collapsed" state. For example:

    <div x-data="{ expanded: false }">    <button @click="expanded = ! expanded">Toggle Content</button>     <p x-show="expanded" x-collapse.min.50px>        ...    </p></div>
    <div x-data="{ expanded: false }">
        <button @click="expanded = ! expanded">Toggle Content</button>
    
        <p x-show="expanded" x-collapse.min.50px>
            ...
        </p>
    </div>

Toggle Content

Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.

[← Focus](/plugins/focus)

[Anchor →](/plugins/anchor)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Csp

CSP (Content-Security Policy) Build
===================================

In order for Alpine to be able to execute plain strings from HTML attributes as JavaScript expressions, for example `x-on:click="console.log()"`, it needs to rely on utilities that violate the "unsafe-eval" [Content Security Policy](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP) that some applications may enforce for security purposes.

> Under the hood, Alpine doesn't actually use eval() itself because it's slow and problematic. Instead it uses Function declarations, which are much better, but still violate "unsafe-eval".

In order to accommodate environments where this CSP is necessary, Alpine offer's an alternate build that doesn't violate "unsafe-eval", but has a more restrictive syntax.

[Installation](#installation)
-----------------------------

You can use this build by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include this build's CDN as a `<script>` tag just like you would normally with standard Alpine build:

    <!-- Alpine's CSP-friendly Core --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine's CSP-friendly Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can alternatively install this build from NPM for use inside your bundle like so:

    npm install @alpinejs/csp
    npm install @alpinejs/csp

Then initialize it from your bundle:

    import Alpine from '@alpinejs/csp' window.Alpine = Alpine Alpine.start()
    import Alpine from '@alpinejs/csp'
    
    window.Alpine = Alpine
    
    Alpine.start()

[Basic Example](#basic-example)
-------------------------------

To provide a glimpse of how using the CSP build might feel, here is a copy-pastable HTML file with a working counter component using a common CSP setup:

    <html>    <head>        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'nonce-a23gbfz9e'">         <script defer nonce="a23gbfz9e" src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>    </head>     <body>        <div x-data="counter">            <button x-on:click="increment"></button>             <span x-text="count"></span>        </div>         <script nonce="a23gbfz9e">            document.addEventListener('alpine:init', () => {                Alpine.data('counter', () => {                    return {                        count: 1,                         increment() {                            this.count++;                        },                    }                })            })        </script>    </body></html>
    <html>
        <head>
            <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'nonce-a23gbfz9e'">
    
            <script defer nonce="a23gbfz9e" src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
        </head>
    
        <body>
            <div x-data="counter">
                <button x-on:click="increment"></button>
    
                <span x-text="count"></span>
            </div>
    
            <script nonce="a23gbfz9e">
                document.addEventListener('alpine:init', () => {
                    Alpine.data('counter', () => {
                        return {
                            count: 1,
    
                            increment() {
                                this.count++;
                            },
                        }
                    })
                })
            </script>
        </body>
    </html>

[API Restrictions](#api-restrictions)
-------------------------------------

Since Alpine can no longer interpret strings as plain JavaScript, it has to parse and construct JavaScript functions from them manually.

Due to this limitation, you must use `Alpine.data` to register your `x-data` objects, and must reference properties and methods from it by key only.

For example, an inline component like this will not work.

    <!-- Bad --><div x-data="{ count: 1 }">    <button @click="count++">Increment</button>     <span x-text="count"></span></div>
    <!-- Bad -->
    <div x-data="{ count: 1 }">
        <button @click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

However, breaking out the expressions into external APIs, the following is valid with the CSP build:

    <!-- Good --><div x-data="counter">    <button @click="increment">Increment</button>     <span x-text="count"></span></div>
    <!-- Good -->
    <div x-data="counter">
        <button @click="increment">Increment</button>
    
        <span x-text="count"></span>
    </div>

    Alpine.data('counter', () => ({    count: 1,     increment() {        this.count++    },}))
    Alpine.data('counter', () => ({
        count: 1,
    
        increment() {
            this.count++
        },
    }))

The CSP build supports accessing nested properties (property accessors) using the dot notation.

    <!-- This works too --><div x-data="counter">    <button @click="foo.increment">Increment</button>     <span x-text="foo.count"></span></div>
    <!-- This works too -->
    <div x-data="counter">
        <button @click="foo.increment">Increment</button>
    
        <span x-text="foo.count"></span>
    </div>

    Alpine.data('counter', () => ({    foo: {        count: 1,         increment() {            this.count++        },    },}))
    Alpine.data('counter', () => ({
        foo: {
            count: 1,
    
            increment() {
                this.count++
            },
        },
    }))

[← Sort](/plugins/sort)

[Reactivity →](/advanced/reactivity)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Data

$data
=====

`$data` is a magic property that gives you access to the current Alpine data scope (generally provided by `x-data`).

Most of the time, you can just access Alpine data within expressions directly. for example `x-data="{ message: 'Hello Caleb!' }"` will allow you to do things like `x-text="message"`.

However, sometimes it is helpful to have an actual object that encapsulates all scope that you can pass around to other functions:

    <div x-data="{ greeting: 'Hello' }">    <div x-data="{ name: 'Caleb' }">        <button @click="sayHello($data)">Say Hello</button>    </div></div> <script>    function sayHello({ greeting, name }) {        alert(greeting + ' ' + name + '!')    }</script>
    <div x-data="{ greeting: 'Hello' }">
        <div x-data="{ name: 'Caleb' }">
            <button @click="sayHello($data)">Say Hello</button>
        </div>
    </div>
    
    <script>
        function sayHello({ greeting, name }) {
            alert(greeting + ' ' + name + '!')
        }
    </script>

Say Hello

function sayHello({ greeting, name }) { alert(greeting + ' ' + name + '!') }

Now when the button is pressed, the browser will alert `Hello Caleb!` because it was passed a data object that contained all the Alpine scope of the expression that called it (`@click="..."`).

Most applications won't need this magic property, but it can be very helpful for deeper, more complicated Alpine utilities.

[← $root](/magics/root)

[$id →](/magics/id)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Dispatch

$dispatch
=========

`$dispatch` is a helpful shortcut for dispatching browser events.

    <div @notify="alert('Hello World!')">    <button @click="$dispatch('notify')">        Notify    </button></div>
    <div @notify="alert('Hello World!')">
        <button @click="$dispatch('notify')">
            Notify
        </button>
    </div>

Notify

You can also pass data along with the dispatched event if you wish. This data will be accessible as the `.detail` property of the event:

    <div @notify="alert($event.detail.message)">    <button @click="$dispatch('notify', { message: 'Hello World!' })">        Notify    </button></div>
    <div @notify="alert($event.detail.message)">
        <button @click="$dispatch('notify', { message: 'Hello World!' })">
            Notify
        </button>
    </div>

Notify

Under the hood, `$dispatch` is a wrapper for the more verbose API: `element.dispatchEvent(new CustomEvent(...))`

**Note on event propagation**

Notice that, because of [event bubbling](https://en.wikipedia.org/wiki/Event_bubbling), when you need to capture events dispatched from nodes that are under the same nesting hierarchy, you'll need to use the [`.window`](https://github.com/alpinejs/alpine#x-on) modifier:

**Example:**

    <!-- 🚫 Won't work --><div x-data>    <span @notify="..."></span>    <button @click="$dispatch('notify')">Notify</button></div> <!-- ✅ Will work (because of .window) --><div x-data>    <span @notify.window="..."></span>    <button @click="$dispatch('notify')">Notify</button></div>
    <!-- 🚫 Won't work -->
    <div x-data>
        <span @notify="..."></span>
        <button @click="$dispatch('notify')">Notify</button>
    </div>
    
    <!-- ✅ Will work (because of .window) -->
    <div x-data>
        <span @notify.window="..."></span>
        <button @click="$dispatch('notify')">Notify</button>
    </div>

> The first example won't work because when `notify` is dispatched, it'll propagate to its common ancestor, the `div`, not its sibling, the `<span>`. The second example will work because the sibling is listening for `notify` at the `window` level, which the custom event will eventually bubble up to.

[Dispatching to other components](#dispatching-to-components)
-------------------------------------------------------------

You can also take advantage of the previous technique to make your components talk to each other:

**Example:**

    <div    x-data="{ title: 'Hello' }"    @set-title.window="title = $event.detail">    <h1 x-text="title"></h1></div> <div x-data>    <button @click="$dispatch('set-title', 'Hello World!')">Click me</button></div><!-- When clicked, the content of the h1 will set to "Hello World!". -->
    <div
        x-data="{ title: 'Hello' }"
        @set-title.window="title = $event.detail"
    >
        <h1 x-text="title"></h1>
    </div>
    
    <div x-data>
        <button @click="$dispatch('set-title', 'Hello World!')">Click me</button>
    </div>
    <!-- When clicked, the content of the h1 will set to "Hello World!". -->

[Dispatching to x-model](#dispatching-to-x-model)
-------------------------------------------------

You can also use `$dispatch()` to trigger data updates for `x-model` data bindings. For example:

    <div x-data="{ title: 'Hello' }">    <span x-model="title">        <button @click="$dispatch('input', 'Hello World!')">Click me</button>        <!-- After the button is pressed, `x-model` will catch the bubbling "input" event, and update title. -->    </span></div>
    <div x-data="{ title: 'Hello' }">
        <span x-model="title">
            <button @click="$dispatch('input', 'Hello World!')">Click me</button>
            <!-- After the button is pressed, `x-model` will catch the bubbling "input" event, and update title. -->
        </span>
    </div>

This opens up the door for making custom input components whose value can be set via `x-model`.

[← $watch](/magics/watch)

[$nextTick →](/magics/nextTick)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Effect

x-effect
========

`x-effect` is a useful directive for re-evaluating an expression when one of its dependencies change. You can think of it as a watcher where you don't have to specify what property to watch, it will watch all properties used within it.

If this definition is confusing for you, that's ok. It's better explained through an example:

    <div x-data="{ label: 'Hello' }" x-effect="console.log(label)">    <button @click="label += ' World!'">Change Message</button></div>
    <div x-data="{ label: 'Hello' }" x-effect="console.log(label)">
        <button @click="label += ' World!'">Change Message</button>
    </div>

When this component is loaded, the `x-effect` expression will be run and "Hello" will be logged into the console.

Because Alpine knows about any property references contained within `x-effect`, when the button is clicked and `label` is changed, the effect will be re-triggered and "Hello World!" will be logged to the console.

[← x-transition](/directives/transition)

[x-ignore →](/directives/ignore)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## El

$el
===

`$el` is a magic property that can be used to retrieve the current DOM node.

    <button @click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>
    <button @click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>

Replace me with "Hello World!"

[← x-id](/directives/id)

[$refs →](/magics/refs)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Events

Events
======

Alpine makes it simple to listen for browser events and react to them.

[Listening for simple events](#listening-for-simple-events)
-----------------------------------------------------------

By using `x-on`, you can listen for browser events that are dispatched on or within an element.

Here's a basic example of listening for a click on a button:

    <button x-on:click="console.log('clicked')">...</button>
    <button x-on:click="console.log('clicked')">...</button>

As an alternative, you can use the event shorthand syntax if you prefer: `@`. Here's the same example as before, but using the shorthand syntax (which we'll be using from now on):

    <button @click="...">...</button>
    <button @click="...">...</button>

In addition to `click`, you can listen for any browser event by name. For example: `@mouseenter`, `@keyup`, etc... are all valid syntax.

[Listening for specific keys](#listening-for-specific-keys)
-----------------------------------------------------------

Let's say you wanted to listen for the `enter` key to be pressed inside an `<input>` element. Alpine makes this easy by adding the `.enter` like so:

    <input @keyup.enter="...">
    <input @keyup.enter="...">

You can even combine key modifiers to listen for key combinations like pressing `enter` while holding `shift`:

    <input @keyup.shift.enter="...">
    <input @keyup.shift.enter="...">

[Preventing default](#preventing-default)
-----------------------------------------

When reacting to browser events, it is often necessary to "prevent default" (prevent the default behavior of the browser event).

For example, if you want to listen for a form submission but prevent the browser from submitting a form request, you can use `.prevent`:

    <form @submit.prevent="...">...</form>
    <form @submit.prevent="...">...</form>

You can also apply `.stop` to achieve the equivalent of `event.stopPropagation()`.

[Accessing the event object](#accessing-the-event-object)
---------------------------------------------------------

Sometimes you may want to access the native browser event object inside your own code. To make this easy, Alpine automatically injects an `$event` magic variable:

    <button @click="$event.target.remove()">Remove Me</button>
    <button @click="$event.target.remove()">Remove Me</button>

[Dispatching custom events](#dispatching-custom-events)
-------------------------------------------------------

In addition to listening for browser events, you can dispatch them as well. This is extremely useful for communicating with other Alpine components or triggering events in tools outside of Alpine itself.

Alpine exposes a magic helper called `$dispatch` for this:

    <div @foo="console.log('foo was dispatched')">    <button @click="$dispatch('foo')"></button></div>
    <div @foo="console.log('foo was dispatched')">
        <button @click="$dispatch('foo')"></button>
    </div>

As you can see, when the button is clicked, Alpine will dispatch a browser event called "foo", and our `@foo` listener on the `<div>` will pick it up and react to it.

[Listening for events on window](#listening-for-events-on-window)
-----------------------------------------------------------------

Because of the nature of events in the browser, it is sometimes useful to listen to events on the top-level window object.

This allows you to communicate across components completely like the following example:

    <div x-data>    <button @click="$dispatch('foo')"></button></div> <div x-data @foo.window="console.log('foo was dispatched')">...</div>
    <div x-data>
        <button @click="$dispatch('foo')"></button>
    </div>
    
    <div x-data @foo.window="console.log('foo was dispatched')">...</div>

In the above example, if we click the button in the first component, Alpine will dispatch the "foo" event. Because of the way events work in the browser, they "bubble" up through parent elements all the way to the top-level "window".

Now, because in our second component we are listening for "foo" on the window (with `.window`), when the button is clicked, this listener will pick it up and log the "foo was dispatched" message.

[→ Read more about x-on](/directives/on)

[← Templating](/essentials/templating)

[Lifecycle →](/essentials/lifecycle)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Extending

Extending
=========

Alpine has a very open codebase that allows for extension in a number of ways. In fact, every available directive and magic in Alpine itself uses these exact APIs. In theory you could rebuild all of Alpine's functionality using them yourself.

[Lifecycle concerns](#lifecycle-concerns)
-----------------------------------------

Before we dive into each individual API, let's first talk about where in your codebase you should consume these APIs.

Because these APIs have an impact on how Alpine initializes the page, they must be registered AFTER Alpine is downloaded and available on the page, but BEFORE it has initialized the page itself.

There are two different techniques depending on if you are importing Alpine into a bundle, or including it directly via a `<script>` tag. Let's look at them both:

### [Via a script tag](#via-script-tag)

If you are including Alpine via a script tag, you will need to register any custom extension code inside an `alpine:init` event listener.

Here's an example:

    <html>    <script src="/js/alpine.js" defer></script>     <div x-data x-foo></div>     <script>        document.addEventListener('alpine:init', () => {            Alpine.directive('foo', ...)        })    </script></html>
    <html>
        <script src="/js/alpine.js" defer></script>
    
        <div x-data x-foo></div>
    
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.directive('foo', ...)
            })
        </script>
    </html>

If you want to extract your extension code into an external file, you will need to make sure that file's `<script>` tag is located BEFORE Alpine's like so:

    <html>    <script src="/js/foo.js" defer></script>    <script src="/js/alpine.js" defer></script>     <div x-data x-foo></div></html>
    <html>
        <script src="/js/foo.js" defer></script>
        <script src="/js/alpine.js" defer></script>
    
        <div x-data x-foo></div>
    </html>

### [Via an NPM module](#via-npm)

If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`. For example:

    import Alpine from 'alpinejs' Alpine.directive('foo', ...) window.Alpine = Alpinewindow.Alpine.start()
    import Alpine from 'alpinejs'
    
    Alpine.directive('foo', ...)
    
    window.Alpine = Alpine
    window.Alpine.start()

Now that we know where to use these extension APIs, let's look more closely at how to use each one:

[Custom directives](#custom-directives)
---------------------------------------

Alpine allows you to register your own custom directives using the `Alpine.directive()` API.

### [Method Signature](#method-signature)

    Alpine.directive('[name]', (el, { value, modifiers, expression }, { Alpine, effect, cleanup }) => {})
    Alpine.directive('[name]', (el, { value, modifiers, expression }, { Alpine, effect, cleanup }) => {})

 

 

name

The name of the directive. The name "foo" for example would be consumed as `x-foo`

el

The DOM element the directive is added to

value

If provided, the part of the directive after a colon. Ex: `'bar'` in `x-foo:bar`

modifiers

An array of dot-separated trailing additions to the directive. Ex: `['baz', 'lob']` from `x-foo.baz.lob`

expression

The attribute value portion of the directive. Ex: `law` from `x-foo="law"`

Alpine

The Alpine global object

effect

A function to create reactive effects that will auto-cleanup after this directive is removed from the DOM

cleanup

A function you can pass bespoke callbacks to that will run when this directive is removed from the DOM

### [Simple Example](#simple-example)

Here's an example of a simple directive we're going to create called: `x-uppercase`:

    Alpine.directive('uppercase', el => {    el.textContent = el.textContent.toUpperCase()})
    Alpine.directive('uppercase', el => {
        el.textContent = el.textContent.toUpperCase()
    })

    <div x-data>    <span x-uppercase>Hello World!</span></div>
    <div x-data>
        <span x-uppercase>Hello World!</span>
    </div>

### [Evaluating expressions](#evaluating-expressions)

When registering a custom directive, you may want to evaluate a user-supplied JavaScript expression:

For example, let's say you wanted to create a custom directive as a shortcut to `console.log()`. Something like:

    <div x-data="{ message: 'Hello World!' }">    <div x-log="message"></div></div>
    <div x-data="{ message: 'Hello World!' }">
        <div x-log="message"></div>
    </div>

You need to retrieve the actual value of `message` by evaluating it as a JavaScript expression with the `x-data` scope.

Fortunately, Alpine exposes its system for evaluating JavaScript expressions with an `evaluate()` API. Here's an example:

    Alpine.directive('log', (el, { expression }, { evaluate }) => {    // expression === 'message'     console.log(        evaluate(expression)    )})
    Alpine.directive('log', (el, { expression }, { evaluate }) => {
        // expression === 'message'
    
        console.log(
            evaluate(expression)
        )
    })

Now, when Alpine initializes the `<div x-log...>`, it will retrieve the expression passed into the directive ("message" in this case), and evaluate it in the context of the current element's Alpine component scope.

### [Introducing reactivity](#introducing-reactivity)

Building on the `x-log` example from before, let's say we wanted `x-log` to log the value of `message` and also log it if the value changes.

Given the following template:

    <div x-data="{ message: 'Hello World!' }">    <div x-log="message"></div>     <button @click="message = 'yolo'">Change</button></div>
    <div x-data="{ message: 'Hello World!' }">
        <div x-log="message"></div>
    
        <button @click="message = 'yolo'">Change</button>
    </div>

We want "Hello World!" to be logged initially, then we want "yolo" to be logged after pressing the `<button>`.

We can adjust the implementation of `x-log` and introduce two new APIs to achieve this: `evaluateLater()` and `effect()`:

    Alpine.directive('log', (el, { expression }, { evaluateLater, effect }) => {    let getThingToLog = evaluateLater(expression)     effect(() => {        getThingToLog(thingToLog => {            console.log(thingToLog)        })    })})
    Alpine.directive('log', (el, { expression }, { evaluateLater, effect }) => {
        let getThingToLog = evaluateLater(expression)
    
        effect(() => {
            getThingToLog(thingToLog => {
                console.log(thingToLog)
            })
        })
    })

Let's walk through the above code, line by line.

    let getThingToLog = evaluateLater(expression)
    let getThingToLog = evaluateLater(expression)

Here, instead of immediately evaluating `message` and retrieving the result, we will convert the string expression ("message") into an actual JavaScript function that we can run at any time. If you're going to evaluate a JavaScript expression more than once, it is highly recommended to first generate a JavaScript function and use that rather than calling `evaluate()` directly. The reason being that the process to interpret a plain string as a JavaScript function is expensive and should be avoided when unnecessary.

    effect(() => {    ...})
    effect(() => {
        ...
    })

By passing in a callback to `effect()`, we are telling Alpine to run the callback immediately, then track any dependencies it uses (`x-data` properties like `message` in our case). Now as soon as one of the dependencies changes, this callback will be re-run. This gives us our "reactivity".

You may recognize this functionality from `x-effect`. It is the same mechanism under the hood.

You may also notice that `Alpine.effect()` exists and wonder why we're not using it here. The reason is that the `effect` function provided via the method parameter has special functionality that cleans itself up when the directive is removed from the page for any reason.

For example, if for some reason the element with `x-log` on it got removed from the page, by using `effect()` instead of `Alpine.effect()` when the `message` property is changed, the value will no longer be logged to the console.

[→ Read more about reactivity in Alpine](/advanced/reactivity)

    getThingToLog(thingToLog => {    console.log(thingToLog)})
    getThingToLog(thingToLog => {
        console.log(thingToLog)
    })

Now we will call `getThingToLog`, which if you recall is the actual JavaScript function version of the string expression: "message".

You might expect `getThingToCall()` to return the result right away, but instead Alpine requires you to pass in a callback to receive the result.

The reason for this is to support async expressions like `await getMessage()`. By passing in a "receiver" callback instead of getting the result immediately, you are allowing your directive to work with async expressions as well.

[→ Read more about async in Alpine](/advanced/async)

### [Cleaning Up](#cleaning-up)

Let's say you needed to register an event listener from a custom directive. After that directive is removed from the page for any reason, you would want to remove the event listener as well.

Alpine makes this simple by providing you with a `cleanup` function when registering custom directives.

Here's an example:

    Alpine.directive('...', (el, {}, { cleanup }) => {    let handler = () => {}     window.addEventListener('click', handler)     cleanup(() => {        window.removeEventListener('click', handler)    }) })
    Alpine.directive('...', (el, {}, { cleanup }) => {
        let handler = () => {}
    
        window.addEventListener('click', handler)
    
        cleanup(() => {
            window.removeEventListener('click', handler)
        })
    
    })

Now if the directive is removed from this element or the element is removed itself, the event listener will be removed as well.

### [Custom order](#custom-order)

By default, any new directive will run after the majority of the standard ones (with the exception of `x-teleport`). This is usually acceptable but some times you might need to run your custom directive before another specific one. This can be achieved by chaining the `.before() function to` Alpine.directive()\` and specifying which directive needs to run after your custom one.

    Alpine.directive('foo', (el, { value, modifiers, expression }) => {    Alpine.addScopeToNode(el, {foo: 'bar'})}).before('bind')
    Alpine.directive('foo', (el, { value, modifiers, expression }) => {
        Alpine.addScopeToNode(el, {foo: 'bar'})
    }).before('bind')

    <div x-data>    <span x-foo x-bind:foo="foo"></span></div>
    <div x-data>
        <span x-foo x-bind:foo="foo"></span>
    </div>

> Note, the directive name must be written without the `x-` prefix (or any other custom prefix you may use).

[Custom magics](#custom-magics)
-------------------------------

Alpine allows you to register custom "magics" (properties or methods) using `Alpine.magic()`. Any magic you register will be available to all your application's Alpine code with the `$` prefix.

### [Method Signature](#method-signature)

    Alpine.magic('[name]', (el, { Alpine }) => {})
    Alpine.magic('[name]', (el, { Alpine }) => {})

 

 

name

The name of the magic. The name "foo" for example would be consumed as `$foo`

el

The DOM element the magic was triggered from

Alpine

The Alpine global object

### [Magic Properties](#magic-properties)

Here's a basic example of a "$now" magic helper to easily get the current time from anywhere in Alpine:

    Alpine.magic('now', () => {    return (new Date).toLocaleTimeString()})
    Alpine.magic('now', () => {
        return (new Date).toLocaleTimeString()
    })

    <span x-text="$now"></span>
    <span x-text="$now"></span>

Now the `<span>` tag will contain the current time, resembling something like "12:00:00 PM".

As you can see `$now` behaves like a static property, but under the hood is actually a getter that evaluates every time the property is accessed.

Because of this, you can implement magic "functions" by returning a function from the getter.

### [Magic Functions](#magic-functions)

For example, if we wanted to create a `$clipboard()` magic function that accepts a string to copy to clipboard, we could implement it like so:

    Alpine.magic('clipboard', () => {    return subject => navigator.clipboard.writeText(subject)})
    Alpine.magic('clipboard', () => {
        return subject => navigator.clipboard.writeText(subject)
    })

    <button @click="$clipboard('hello world')">Copy "Hello World"</button>
    <button @click="$clipboard('hello world')">Copy "Hello World"</button>

Now that accessing `$clipboard` returns a function itself, we can immediately call it and pass it an argument like we see in the template with `$clipboard('hello world')`.

You can use the more brief syntax (a double arrow function) for returning a function from a function if you'd prefer:

    Alpine.magic('clipboard', () => subject => {    navigator.clipboard.writeText(subject)})
    Alpine.magic('clipboard', () => subject => {
        navigator.clipboard.writeText(subject)
    })

[Writing and sharing plugins](#writing-and-sharing-plugins)
-----------------------------------------------------------

By now you should see how friendly and simple it is to register your own custom directives and magics in your application, but what about sharing that functionality with others via an NPM package or something?

You can get started quickly with Alpine's official "plugin-blueprint" package. It's as simple as cloning the repository and running `npm install && npm run build` to get a plugin authored.

For demonstration purposes, let's create a pretend Alpine plugin from scratch called `Foo` that includes both a directive (`x-foo`) and a magic (`$foo`).

We'll start producing this plugin for consumption as a simple `<script>` tag alongside Alpine, then we'll level it up to a module for importing into a bundle:

### [Script include](#script-include)

Let's start in reverse by looking at how our plugin will be included into a project:

    <html>    <script src="/js/foo.js" defer></script>    <script src="/js/alpine.js" defer></script>     <div x-data x-init="$foo()">        <span x-foo="'hello world'">    </div></html>
    <html>
        <script src="/js/foo.js" defer></script>
        <script src="/js/alpine.js" defer></script>
    
        <div x-data x-init="$foo()">
            <span x-foo="'hello world'">
        </div>
    </html>

Notice how our script is included BEFORE Alpine itself. This is important, otherwise, Alpine would have already been initialized by the time our plugin got loaded.

Now let's look inside of `/js/foo.js`'s contents:

    document.addEventListener('alpine:init', () => {    window.Alpine.directive('foo', ...)     window.Alpine.magic('foo', ...)})
    document.addEventListener('alpine:init', () => {
        window.Alpine.directive('foo', ...)
    
        window.Alpine.magic('foo', ...)
    })

That's it! Authoring a plugin for inclusion via a script tag is extremely simple with Alpine.

### [Bundle module](#bundle-module)

Now let's say you wanted to author a plugin that someone could install via NPM and include into their bundle.

Like the last example, we'll walk through this in reverse, starting with what it will look like to consume this plugin:

    import Alpine from 'alpinejs' import foo from 'foo'Alpine.plugin(foo) window.Alpine = Alpinewindow.Alpine.start()
    import Alpine from 'alpinejs'
    
    import foo from 'foo'
    Alpine.plugin(foo)
    
    window.Alpine = Alpine
    window.Alpine.start()

You'll notice a new API here: `Alpine.plugin()`. This is a convenience method Alpine exposes to prevent consumers of your plugin from having to register multiple different directives and magics themselves.

Now let's look at the source of the plugin and what gets exported from `foo`:

    export default function (Alpine) {    Alpine.directive('foo', ...)    Alpine.magic('foo', ...)}
    export default function (Alpine) {
        Alpine.directive('foo', ...)
        Alpine.magic('foo', ...)
    }

You'll see that `Alpine.plugin` is incredibly simple. It accepts a callback and immediately invokes it while providing the `Alpine` global as a parameter for use inside of it.

Then you can go about extending Alpine as you please.

[← Reactivity](/advanced/reactivity)

[Async →](/advanced/async)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Focus

> Notice: This Plugin was previously called "Trap". Trap's functionality has been absorbed into this plugin along with additional functionality. You can swap Trap for Focus without any breaking changes.

Focus Plugin
============

Alpine's Focus plugin allows you to manage focus on a page.

> This plugin internally makes heavy use of the open source tool: [Tabbable](https://github.com/focus-trap/tabbable). Big thanks to that team for providing a much needed solution to this problem.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Focus from NPM for use inside your bundle like so:

    npm install @alpinejs/focus
    npm install @alpinejs/focus

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import focus from '@alpinejs/focus' Alpine.plugin(focus) ...
    import Alpine from 'alpinejs'
    import focus from '@alpinejs/focus'
    
    Alpine.plugin(focus)
    
    ...

[x-trap](#x-trap)
-----------------

Focus offers a dedicated API for trapping focus within an element: the `x-trap` directive.

`x-trap` accepts a JS expression. If the result of that expression is true, then the focus will be trapped inside that element until the expression becomes false, then at that point, focus will be returned to where it was previously.

For example:

    <div x-data="{ open: false }">    <button @click="open = true">Open Dialog</button>     <span x-show="open" x-trap="open">        <p>...</p>         <input type="text" placeholder="Some input...">         <input type="text" placeholder="Some other input...">         <button @click="open = false">Close Dialog</button>    </span></div>
    <div x-data="{ open: false }">
        <button @click="open = true">Open Dialog</button>
    
        <span x-show="open" x-trap="open">
            <p>...</p>
    
            <input type="text" placeholder="Some input...">
    
            <input type="text" placeholder="Some other input...">
    
            <button @click="open = false">Close Dialog</button>
        </span>
    </div>

Open Dialog

**

Focus is now "trapped" inside this dialog, meaning you can only click/focus elements within this yellow dialog. If you press tab repeatedly, the focus will stay within this dialog.

**

Close Dialog

### [Nesting dialogs](#nesting)

Sometimes you may want to nest one dialog inside another. `x-trap` makes this trivial and handles it automatically.

`x-trap` keeps track of newly "trapped" elements and stores the last actively focused element. Once the element is "untrapped" then the focus will be returned to where it was originally.

This mechanism is recursive, so you can trap focus within an already trapped element infinite times, then "untrap" each element successively.

Here is nesting in action:

    <div x-data="{ open: false }">    <button @click="open = true">Open Dialog</button>     <span x-show="open" x-trap="open">         ...         <div x-data="{ open: false }">            <button @click="open = true">Open Nested Dialog</button>             <span x-show="open" x-trap="open">                 ...                 <button @click="open = false">Close Nested Dialog</button>            </span>        </div>         <button @click="open = false">Close Dialog</button>    </span></div>
    <div x-data="{ open: false }">
        <button @click="open = true">Open Dialog</button>
    
        <span x-show="open" x-trap="open">
    
            ...
    
            <div x-data="{ open: false }">
                <button @click="open = true">Open Nested Dialog</button>
    
                <span x-show="open" x-trap="open">
    
                    ...
    
                    <button @click="open = false">Close Nested Dialog</button>
                </span>
            </div>
    
            <button @click="open = false">Close Dialog</button>
        </span>
    </div>

Open Dialog

Open Nested Dialog

**

Focus is now "trapped" inside this nested dialog. You cannot focus anything inside the outer dialog while this is open. If you close this dialog, focus will be returned to the last known active element.

**

Close Nested Dialog

Close Dialog

### [Modifiers](#modifiers)

#### [.inert](#inert)

When building things like dialogs/modals, it's recommended to hide all the other elements on the page from screen readers when trapping focus.

By adding `.inert` to `x-trap`, when focus is trapped, all other elements on the page will receive `aria-hidden="true"` attributes, and when focus trapping is disabled, those attributes will also be removed.

    <!-- When `open` is `false`: --><body x-data="{ open: false }">    <div x-trap.inert="open" ...>        ...    </div>     <div>        ...    </div></body> <!-- When `open` is `true`: --><body x-data="{ open: true }">    <div x-trap.inert="open" ...>        ...    </div>     <div aria-hidden="true">        ...    </div></body>
    <!-- When `open` is `false`: -->
    <body x-data="{ open: false }">
        <div x-trap.inert="open" ...>
            ...
        </div>
    
        <div>
            ...
        </div>
    </body>
    
    <!-- When `open` is `true`: -->
    <body x-data="{ open: true }">
        <div x-trap.inert="open" ...>
            ...
        </div>
    
        <div aria-hidden="true">
            ...
        </div>
    </body>

#### [.noscroll](#noscroll)

When building dialogs/modals with Alpine, it's recommended that you disable scrolling for the surrounding content when the dialog is open.

`x-trap` allows you to do this automatically with the `.noscroll` modifiers.

By adding `.noscroll`, Alpine will remove the scrollbar from the page and block users from scrolling down the page while a dialog is open.

For example:

    <div x-data="{ open: false }">    <button>Open Dialog</button>     <div x-show="open" x-trap.noscroll="open">        Dialog Contents         <button @click="open = false">Close Dialog</button>    </div></div>
    <div x-data="{ open: false }">
        <button>Open Dialog</button>
    
        <div x-show="open" x-trap.noscroll="open">
            Dialog Contents
    
            <button @click="open = false">Close Dialog</button>
        </div>
    </div>

Open Dialog

Dialog Contents

Notice how you can no longer scroll on this page while this dialog is open.

Close Dialog

#### [.noreturn](#noreturn)

Sometimes you may not want focus to be returned to where it was previously. Consider a dropdown that's triggered upon focusing an input, returning focus to the input on close will just trigger the dropdown to open again.

`x-trap` allows you to disable this behavior with the `.noreturn` modifier.

By adding `.noreturn`, Alpine will not return focus upon x-trap evaluating to false.

For example:

    <div x-data="{ open: false }" x-trap.noreturn="open">    <input type="search" placeholder="search for something" />     <div x-show="open">        Search results         <button @click="open = false">Close</button>    </div></div>
    <div x-data="{ open: false }" x-trap.noreturn="open">
        <input type="search" placeholder="search for something" />
    
        <div x-show="open">
            Search results
    
            <button @click="open = false">Close</button>
        </div>
    </div>

Search results

Notice when closing this dropdown, focus is not returned to the input.

Close Dialog

#### [.noautofocus](#noautofocus)

By default, when `x-trap` traps focus within an element, it focuses the first focussable element within that element. This is a sensible default, however there are times where you may want to disable this behavior and not automatically focus any elements when `x-trap` engages.

By adding `.noautofocus`, Alpine will not automatically focus any elements when trapping focus.

[$focus](#focus-magic)
----------------------

This plugin offers many smaller utilities for managing focus within a page. These utilities are exposed via the `$focus` magic.

Property

Description

`focus(el)`

Focus the passed element (handling annoyances internally: using nextTick, etc.)

`focusable(el)`

Detect whether or not an element is focusable

`focusables()`

Get all "focusable" elements within the current element

`focused()`

Get the currently focused element on the page

`lastFocused()`

Get the last focused element on the page

`within(el)`

Specify an element to scope the `$focus` magic to (the current element by default)

`first()`

Focus the first focusable element

`last()`

Focus the last focusable element

`next()`

Focus the next focusable element

`previous()`

Focus the previous focusable element

`noscroll()`

Prevent scrolling to the element about to be focused

`wrap()`

When retrieving "next" or "previous" use "wrap around" (ex. returning the first element if getting the "next" element of the last element)

`getFirst()`

Retrieve the first focusable element

`getLast()`

Retrieve the last focusable element

`getNext()`

Retrieve the next focusable element

`getPrevious()`

Retrieve the previous focusable element

Let's walk through a few examples of these utilities in use. The example below allows the user to control focus within the group of buttons using the arrow keys. You can test this by clicking on a button, then using the arrow keys to move focus around:

    <div    @keydown.right="$focus.next()"    @keydown.left="$focus.previous()">    <button>First</button>    <button>Second</button>    <button>Third</button></div>
    <div
        @keydown.right="$focus.next()"
        @keydown.left="$focus.previous()"
    >
        <button>First</button>
        <button>Second</button>
        <button>Third</button>
    </div>

First Second Third

(Click a button, then use the arrow keys to move left and right)

Notice how if the last button is focused, pressing "right arrow" won't do anything. Let's add the `.wrap()` method so that focus "wraps around":

    <div    @keydown.right="$focus.wrap().next()"    @keydown.left="$focus.wrap().previous()">    <button>First</button>    <button>Second</button>    <button>Third</button></div>
    <div
        @keydown.right="$focus.wrap().next()"
        @keydown.left="$focus.wrap().previous()"
    >
        <button>First</button>
        <button>Second</button>
        <button>Third</button>
    </div>

First Second Third

(Click a button, then use the arrow keys to move left and right)

Now, let's add two buttons, one to focus the first element in the button group, and another focus the last element:

    <button @click="$focus.within($refs.buttons).first()">Focus "First"</button><button @click="$focus.within($refs.buttons).last()">Focus "Last"</button> <div    x-ref="buttons"    @keydown.right="$focus.wrap().next()"    @keydown.left="$focus.wrap().previous()">    <button>First</button>    <button>Second</button>    <button>Third</button></div>
    <button @click="$focus.within($refs.buttons).first()">Focus "First"</button>
    <button @click="$focus.within($refs.buttons).last()">Focus "Last"</button>
    
    <div
        x-ref="buttons"
        @keydown.right="$focus.wrap().next()"
        @keydown.left="$focus.wrap().previous()"
    >
        <button>First</button>
        <button>Second</button>
        <button>Third</button>
    </div>

Focus "First" Focus "Last"

* * *

First Second Third

Notice that we needed to add a `.within()` method for each button so that `$focus` knows to scope itself to a different element (the `div` wrapping the buttons).

[← Persist](/plugins/persist)

[Collapse →](/plugins/collapse)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## For

x-for
=====

Alpine's `x-for` directive allows you to create DOM elements by iterating through a list. Here's a simple example of using it to create a list of colors based on an array.

    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">    <template x-for="color in colors">        <li x-text="color"></li>    </template></ul>
    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
        <template x-for="color in colors">
            <li x-text="color"></li>
        </template>
    </ul>

You may also pass objects to `x-for`.

    <ul x-data="{ car: { make: 'Jeep', model: 'Grand Cherokee', color: 'Black' } }">    <template x-for="(value, index) in car">        <li>            <span x-text="index"></span>: <span x-text="value"></span>        </li>    </template></ul>
    <ul x-data="{ car: { make: 'Jeep', model: 'Grand Cherokee', color: 'Black' } }">
        <template x-for="(value, index) in car">
            <li>
                <span x-text="index"></span>: <span x-text="value"></span>
            </li>
        </template>
    </ul>

There are two rules worth noting about `x-for`:

> `x-for` MUST be declared on a `<template>` element. That `<template>` element MUST contain only one root element

[Keys](#keys)
-------------

It is important to specify unique keys for each `x-for` iteration if you are going to be re-ordering items. Without dynamic keys, Alpine may have a hard time keeping track of what re-orders and will cause odd side-effects.

    <ul x-data="{ colors: [    { id: 1, label: 'Red' },    { id: 2, label: 'Orange' },    { id: 3, label: 'Yellow' },]}">    <template x-for="color in colors" :key="color.id">        <li x-text="color.label"></li>    </template></ul>
    <ul x-data="{ colors: [
        { id: 1, label: 'Red' },
        { id: 2, label: 'Orange' },
        { id: 3, label: 'Yellow' },
    ]}">
        <template x-for="color in colors" :key="color.id">
            <li x-text="color.label"></li>
        </template>
    </ul>

Now if the colors are added, removed, re-ordered, or their "id"s change, Alpine will preserve or destroy the iterated `<li>`elements accordingly.

[Accessing indexes](#accessing-indexes)
---------------------------------------

If you need to access the index of each item in the iteration, you can do so using the `([item], [index]) in [items]` syntax like so:

    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">    <template x-for="(color, index) in colors">        <li>            <span x-text="index + ': '"></span>            <span x-text="color"></span>        </li>    </template></ul>
    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
        <template x-for="(color, index) in colors">
            <li>
                <span x-text="index + ': '"></span>
                <span x-text="color"></span>
            </li>
        </template>
    </ul>

You can also access the index inside a dynamic `:key` expression.

    <template x-for="(color, index) in colors" :key="index">
    <template x-for="(color, index) in colors" :key="index">

[Iterating over a range](#iterating-over-a-range)
-------------------------------------------------

If you need to simply loop `n` number of times, rather than iterate through an array, Alpine offers a short syntax.

    <ul>    <template x-for="i in 10">        <li x-text="i"></li>    </template></ul>
    <ul>
        <template x-for="i in 10">
            <li x-text="i"></li>
        </template>
    </ul>

`i` in this case can be named anything you like.

> Despite not being included in the above snippet, `x-for` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

[Contents of a `<template>`](#contents-of-a-template)
-----------------------------------------------------

As mentioned above, an `<template>` tag must contain only one root element.

For example, the following code will not work:

    <template x-for="color in colors">    <span>The next color is </span><span x-text="color"></template>
    <template x-for="color in colors">
        <span>The next color is </span><span x-text="color">
    </template>

but this code will work:

    <template x-for="color in colors">    <p>        <span>The next color is </span><span x-text="color">    </p></template>
    <template x-for="color in colors">
        <p>
            <span>The next color is </span><span x-text="color">
        </p>
    </template>

[← x-modelable](/directives/modelable)

[x-transition →](/directives/transition)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Html

x-html
======

`x-html` sets the "innerHTML" property of an element to the result of a given expression.

> ⚠️ Only use on trusted content and never on user-provided content. ⚠️ Dynamically rendering HTML from third parties can easily lead to XSS vulnerabilities.

Here's a basic example of using `x-html` to display a user's username.

    <div x-data="{ username: '<strong>calebporzio</strong>' }">    Username: <span x-html="username"></span></div>
    <div x-data="{ username: '<strong>calebporzio</strong>' }">
        Username: <span x-html="username"></span>
    </div>

Username:

Now the `<span>` tag's inner HTML will be set to "**calebporzio**".

[← x-text](/directives/text)

[x-model →](/directives/model)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Id

$id
===

`$id` is a magic property that can be used to generate an element's ID and ensure that it won't conflict with other IDs of the same name on the same page.

This utility is extremely helpful when building re-usable components (presumably in a back-end template) that might occur multiple times on a page, and make use of ID attributes.

Things like input components, modals, listboxes, etc. will all benefit from this utility.

[Basic usage](#basic-usage)
---------------------------

Suppose you have two input elements on a page, and you want them to have a unique ID from each other, you can do the following:

    <input type="text" :id="$id('text-input')"><!-- id="text-input-1" --> <input type="text" :id="$id('text-input')"><!-- id="text-input-2" -->
    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-1" -->
    
    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-2" -->

As you can see, `$id` takes in a string and spits out an appended suffix that is unique on the page.

[Grouping with x-id](#groups-with-x-id)
---------------------------------------

Now let's say you want to have those same two input elements, but this time you want `<label>` elements for each of them.

This presents a problem, you now need to be able to reference the same ID twice. One for the `<label>`'s `for` attribute, and the other for the `id` on the input.

Here is a way that you might think to accomplish this and is totally valid:

    <div x-data="{ id: $id('text-input') }">    <label :for="id"> <!-- "text-input-1" -->    <input type="text" :id="id"> <!-- "text-input-1" --></div> <div x-data="{ id: $id('text-input') }">    <label :for="id"> <!-- "text-input-2" -->    <input type="text" :id="id"> <!-- "text-input-2" --></div>
    <div x-data="{ id: $id('text-input') }">
        <label :for="id"> <!-- "text-input-1" -->
        <input type="text" :id="id"> <!-- "text-input-1" -->
    </div>
    
    <div x-data="{ id: $id('text-input') }">
        <label :for="id"> <!-- "text-input-2" -->
        <input type="text" :id="id"> <!-- "text-input-2" -->
    </div>

This approach is fine, however, having to name and store the ID in your component scope feels cumbersome.

To accomplish this same task in a more flexible way, you can use Alpine's `x-id` directive to declare an "id scope" for a set of IDs:

    <div x-id="['text-input']">    <label :for="$id('text-input')"> <!-- "text-input-1" -->    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" --></div> <div x-id="['text-input']">    <label :for="$id('text-input')"> <!-- "text-input-2" -->    <input type="text" :id="$id('text-input')"> <!-- "text-input-2" --></div>
    <div x-id="['text-input']">
        <label :for="$id('text-input')"> <!-- "text-input-1" -->
        <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->
    </div>
    
    <div x-id="['text-input']">
        <label :for="$id('text-input')"> <!-- "text-input-2" -->
        <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
    </div>

As you can see, `x-id` accepts an array of ID names. Now any usages of `$id()` within that scope, will all use the same ID. Think of them as "id groups".

[Nesting](#nesting)
-------------------

As you might have intuited, you can freely nest these `x-id` groups, like so:

    <div x-id="['text-input']">    <label :for="$id('text-input')"> <!-- "text-input-1" -->    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->     <div x-id="['text-input']">        <label :for="$id('text-input')"> <!-- "text-input-2" -->        <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->    </div></div>
    <div x-id="['text-input']">
        <label :for="$id('text-input')"> <!-- "text-input-1" -->
        <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->
    
        <div x-id="['text-input']">
            <label :for="$id('text-input')"> <!-- "text-input-2" -->
            <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
        </div>
    </div>

[Keyed IDs (For Looping)](#keyed-ids)
-------------------------------------

Sometimes, it is helpful to specify an additional suffix on the end of an ID for the purpose of identifying it within a loop.

For this, `$id()` accepts an optional second parameter that will be added as a suffix on the end of the generated ID.

A common example of this need is something like a listbox component that uses the `aria-activedescendant` attribute to tell assistive technologies which element is "active" in the list:

    <ul    x-id="['list-item']"    :aria-activedescendant="$id('list-item', activeItem.id)">    <template x-for="item in items" :key="item.id">        <li :id="$id('list-item', item.id)">...</li>    </template></ul>
    <ul
        x-id="['list-item']"
        :aria-activedescendant="$id('list-item', activeItem.id)"
    >
        <template x-for="item in items" :key="item.id">
            <li :id="$id('list-item', item.id)">...</li>
        </template>
    </ul>

This is an incomplete example of a listbox, but it should still be helpful to demonstrate a scenario where you might need each ID in a group to still be unique to the page, but also be keyed within a loop so that you can reference individual IDs within that group.

[← $data](/magics/data)

[Alpine.data() →](/globals/alpine-data)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## If

x-if
====

`x-if` is used for toggling elements on the page, similarly to `x-show`, however it completely adds and removes the element it's applied to rather than just changing its CSS display property to "none".

Because of this difference in behavior, `x-if` should not be applied directly to the element, but instead to a `<template>` tag that encloses the element. This way, Alpine can keep a record of the element once it's removed from the page.

    <template x-if="open">    <div>Contents...</div></template>
    <template x-if="open">
        <div>Contents...</div>
    </template>

> Despite not being included in the above snippet, `x-if` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

Caveats
-------

Unlike `x-show`, `x-if`, does NOT support transitioning toggles with `x-transition`.

`<template>` tags can only contain one root element.

[← x-teleport](/directives/teleport)

[x-id →](/directives/id)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Ignore

x-ignore
========

By default, Alpine will crawl and initialize the entire DOM tree of an element containing `x-init` or `x-data`.

If for some reason, you don't want Alpine to touch a specific section of your HTML, you can prevent it from doing so using `x-ignore`.

    <div x-data="{ label: 'From Alpine' }">    <div x-ignore>        <span x-text="label"></span>    </div></div>
    <div x-data="{ label: 'From Alpine' }">
        <div x-ignore>
            <span x-text="label"></span>
        </div>
    </div>

In the above example, the `<span>` tag will not contain "From Alpine" because we told Alpine to ignore the contents of the `div` completely.

[← x-effect](/directives/effect)

[x-ref →](/directives/ref)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Init

x-init
======

The `x-init` directive allows you to hook into the initialization phase of any element in Alpine.

    <div x-init="console.log('I\'m being initialized!')"></div>
    <div x-init="console.log('I\'m being initialized!')"></div>

In the above example, "I'm being initialized!" will be output in the console before it makes further DOM updates.

Consider another example where `x-init` is used to fetch some JSON and store it in `x-data` before the component is processed.

    <div    x-data="{ posts: [] }"    x-init="posts = await (await fetch('/posts')).json()">...</div>
    <div
        x-data="{ posts: [] }"
        x-init="posts = await (await fetch('/posts')).json()"
    >...</div>

[$nextTick](#next-tick)
-----------------------

Sometimes, you want to wait until after Alpine has completely finished rendering to execute some code.

This would be something like `useEffect(..., [])` in react, or `mount` in Vue.

By using Alpine's internal `$nextTick` magic, you can make this happen.

    <div x-init="$nextTick(() => { ... })"></div>
    <div x-init="$nextTick(() => { ... })"></div>

[Standalone `x-init`](#standalone-x-init)
-----------------------------------------

You can add `x-init` to any elements inside or outside an `x-data` HTML block. For example:

    <div x-data>    <span x-init="console.log('I can initialize')"></span></div> <span x-init="console.log('I can initialize too')"></span>
    <div x-data>
        <span x-init="console.log('I can initialize')"></span>
    </div>
    
    <span x-init="console.log('I can initialize too')"></span>

[Auto-evaluate init() method](#auto-evaluate-init-method)
---------------------------------------------------------

If the `x-data` object of a component contains an `init()` method, it will be called automatically. For example:

    <div x-data="{    init() {        console.log('I am called automatically')    }}">    ...</div>
    <div x-data="{
        init() {
            console.log('I am called automatically')
        }
    }">
        ...
    </div>

This is also the case for components that were registered using the `Alpine.data()` syntax.

    Alpine.data('dropdown', () => ({    init() {        console.log('I will get evaluated when initializing each "dropdown" component.')    },}))
    Alpine.data('dropdown', () => ({
        init() {
            console.log('I will get evaluated when initializing each "dropdown" component.')
        },
    }))

If you have both an `x-data` object containing an `init()` method and an `x-init` directive, the `x-data` method will be called before the directive.

    <div    x-data="{        init() {            console.log('I am called first')        }    }"    x-init="console.log('I am called second')"    >    ...</div>
    <div
        x-data="{
            init() {
                console.log('I am called first')
            }
        }"
        x-init="console.log('I am called second')"
        >
        ...
    </div>

[← x-data](/directives/data)

[x-show →](/directives/show)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Installation

Installation
============

There are 2 ways to include Alpine into your project:

*   Including it from a `<script>` tag
*   Importing it as a module

Either is perfectly valid. It all depends on the project's needs and the developer's taste.

[From a script tag](#from-a-script-tag)
---------------------------------------

This is by far the simplest way to get started with Alpine. Include the following `<script>` tag in the head of your HTML page.

    <html>    <head>        ...         <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>    </head>    ...</html>
    <html>
        <head>
            ...
    
            <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
        </head>
        ...
    </html>

> Don't forget the "defer" attribute in the `<script>` tag.

Notice the `@3.x.x` in the provided CDN link. This will pull the latest version of Alpine version 3. For stability in production, it's recommended that you hardcode the latest version in the CDN link.

    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

That's it! Alpine is now available for use inside your page.

Note that you will still need to define a component with `x-data` in order for any Alpine.js attributes to work. See [https://github.com/alpinejs/alpine/discussions/3805](https://github.com/alpinejs/alpine/discussions/3805) for more information.

[As a module](#as-a-module)
---------------------------

If you prefer the more robust approach, you can install Alpine via NPM and import it into a bundle.

Run the following command to install it.

    npm install alpinejs
    npm install alpinejs

Now import Alpine into your bundle and initialize it like so:

    import Alpine from 'alpinejs' window.Alpine = Alpine Alpine.start()
    import Alpine from 'alpinejs'
    
    window.Alpine = Alpine
    
    Alpine.start()

> The `window.Alpine = Alpine` bit is optional, but is nice to have for freedom and flexibility. Like when tinkering with Alpine from the devtools for example.

> If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`.

> Ensure that `Alpine.start()` is only called once per page. Calling it more than once will result in multiple "instances" of Alpine running at the same time.

[→ Read more about extending Alpine](/advanced/extending)

[← Upgrade From V2](/upgrade-guide)

[State →](/essentials/state)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Intersect

Intersect Plugin
================

Alpine's Intersect plugin is a convenience wrapper for [Intersection Observer](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) that allows you to easily react when an element enters the viewport.

This is useful for: lazy loading images and other content, triggering animations, infinite scrolling, logging "views" of content, etc.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Intersect from NPM for use inside your bundle like so:

    npm install @alpinejs/intersect
    npm install @alpinejs/intersect

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import intersect from '@alpinejs/intersect' Alpine.plugin(intersect) ...
    import Alpine from 'alpinejs'
    import intersect from '@alpinejs/intersect'
    
    Alpine.plugin(intersect)
    
    ...

[x-intersect](#x-intersect)
---------------------------

The primary API for using this plugin is `x-intersect`. You can add `x-intersect` to any element within an Alpine component, and when that component enters the viewport (is scrolled into view), the provided expression will execute.

For example, in the following snippet, `shown` will remain `false` until the element is scrolled into view. At that point, the expression will execute and `shown` will become `true`:

    <div x-data="{ shown: false }" x-intersect="shown = true">    <div x-show="shown" x-transition>        I'm in the viewport!    </div></div>
    <div x-data="{ shown: false }" x-intersect="shown = true">
        <div x-show="shown" x-transition>
            I'm in the viewport!
        </div>
    </div>

[Scroll Down 👇](#)

I'm in the viewport!

### [x-intersect:enter](#x-intersect-enter)

The `:enter` suffix is an alias of `x-intersect`, and works the same way:

    <div x-intersect:enter="shown = true">...</div>
    <div x-intersect:enter="shown = true">...</div>

You may choose to use this for clarity when also using the `:leave` suffix.

### [x-intersect:leave](#x-intersect-leave)

Appending `:leave` runs your expression when the element leaves the viewport.

    <div x-intersect:leave="shown = true">...</div>
    <div x-intersect:leave="shown = true">...</div>

> By default, this means the _whole element_ is not in the viewport. Use `x-intersect:leave.full` to run your expression when only _parts of the element_ are not in the viewport.

[→ Read more about the underlying `IntersectionObserver` API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API)

[Modifiers](#modifiers)
-----------------------

### [.once](#once)

Sometimes it's useful to evaluate an expression only the first time an element enters the viewport and not subsequent times. For example when triggering "enter" animations. In these cases, you can add the `.once` modifier to `x-intersect` to achieve this.

    <div x-intersect.once="shown = true">...</div>
    <div x-intersect.once="shown = true">...</div>

### [.half](#half)

Evaluates the expression once the intersection threshold exceeds `0.5`.

Useful for elements where it's important to show at least part of the element.

    <div x-intersect.half="shown = true">...</div> // when `0.5` of the element is in the viewport
    <div x-intersect.half="shown = true">...</div> // when `0.5` of the element is in the viewport

### [.full](#full)

Evaluates the expression once the intersection threshold exceeds `0.99`.

Useful for elements where it's important to show the whole element.

    <div x-intersect.full="shown = true">...</div> // when `0.99` of the element is in the viewport
    <div x-intersect.full="shown = true">...</div> // when `0.99` of the element is in the viewport

### [.threshold](#threshold)

Allows you to control the `threshold` property of the underlying `IntersectionObserver`:

This value should be in the range of "0-100". A value of "0" means: trigger an "intersection" if ANY part of the element enters the viewport (the default behavior). While a value of "100" means: don't trigger an "intersection" unless the entire element has entered the viewport.

Any value in between is a percentage of those two extremes.

For example if you want to trigger an intersection after half of the element has entered the page, you can use `.threshold.50`:

    <div x-intersect.threshold.50="shown = true">...</div> // when 50% of the element is in the viewport
    <div x-intersect.threshold.50="shown = true">...</div> // when 50% of the element is in the viewport

If you wanted to trigger only when 5% of the element has entered the viewport, you could use: `.threshold.05`, and so on and so forth.

### [.margin](#margin)

Allows you to control the `rootMargin` property of the underlying `IntersectionObserver`. This effectively tweaks the size of the viewport boundary. Positive values expand the boundary beyond the viewport, and negative values shrink it inward. The values work like CSS margin: one value for all sides; two values for top/bottom, left/right; or four values for top, right, bottom, left. You can use `px` and `%` values, or use a bare number to get a pixel value.

    <div x-intersect.margin.200px="loaded = true">...</div> // Load when the element is within 200px of the viewport
    <div x-intersect.margin.200px="loaded = true">...</div> // Load when the element is within 200px of the viewport

    <div x-intersect:leave.margin.10%.25px.25.25px="loaded = false">...</div> // Unload when the element gets within 10% of the top of the viewport, or within 25px of the other three edges
    <div x-intersect:leave.margin.10%.25px.25.25px="loaded = false">...</div> // Unload when the element gets within 10% of the top of the viewport, or within 25px of the other three edges

    <div x-intersect.margin.-100px="visible = true">...</div> // Mark as visible when element is more than 100 pixels into the viewport.
    <div x-intersect.margin.-100px="visible = true">...</div> // Mark as visible when element is more than 100 pixels into the viewport.

[← Mask](/plugins/mask)

[Resize →](/plugins/resize)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Lifecycle

Lifecycle
=========

Alpine has a handful of different techniques for hooking into different parts of its lifecycle. Let's go through the most useful ones to familiarize yourself with:

[Element initialization](#element-initialization)
-------------------------------------------------

Another extremely useful lifecycle hook in Alpine is the `x-init` directive.

`x-init` can be added to any element on a page and will execute any JavaScript you call inside it when Alpine begins initializing that element.

    <button x-init="console.log('Im initing')">
    <button x-init="console.log('Im initing')">

In addition to the directive, Alpine will automatically call any `init()` methods stored on a data object. For example:

    Alpine.data('dropdown', () => ({    init() {        // I get called before the element using this data initializes.    }}))
    Alpine.data('dropdown', () => ({
        init() {
            // I get called before the element using this data initializes.
        }
    }))

[After a state change](#after-a-state-change)
---------------------------------------------

Alpine allows you to execute code when a piece of data (state) changes. It offers two different APIs for such a task: `$watch` and `x-effect`.

### [`$watch`](#watch)

    <div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
    <div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">

As you can see above, `$watch` allows you to hook into data changes using a dot-notation key. When that piece of data changes, Alpine will call the passed callback and pass it the new value. along with the old value before the change.

[→ Read more about $watch](/magics/watch)

### [`x-effect`](#x-effect)

`x-effect` uses the same mechanism under the hood as `$watch` but has very different usage.

Instead of specifying which data key you wish to watch, `x-effect` will call the provided code and intelligently look for any Alpine data used within it. Now when one of those pieces of data changes, the `x-effect` expression will be re-run.

Here's the same bit of code from the `$watch` example rewritten using `x-effect`:

    <div x-data="{ open: false }" x-effect="console.log(open)">
    <div x-data="{ open: false }" x-effect="console.log(open)">

Now, this expression will be called right away, and re-called every time `open` is updated.

The two main behavioral differences with this approach are:

1.  The provided code will be run right away AND when data changes (`$watch` is "lazy" -- won't run until the first data change)
2.  No knowledge of the previous value. (The callback provided to `$watch` receives both the new value AND the old one)

[→ Read more about x-effect](/directives/effect)

[Alpine initialization](#alpine-initialization)
-----------------------------------------------

### [`alpine:init`](#alpine-initializing)

Ensuring a bit of code executes after Alpine is loaded, but BEFORE it initializes itself on the page is a necessary task.

This hook allows you to register custom data, directives, magics, etc. before Alpine does its thing on a page.

You can hook into this point in the lifecycle by listening for an event that Alpine dispatches called: `alpine:init`

    document.addEventListener('alpine:init', () => {    Alpine.data(...)})
    document.addEventListener('alpine:init', () => {
        Alpine.data(...)
    })

### [`alpine:initialized`](#alpine-initialized)

Alpine also offers a hook that you can use to execute code AFTER it's done initializing called `alpine:initialized`:

    document.addEventListener('alpine:initialized', () => {    //})
    document.addEventListener('alpine:initialized', () => {
        //
    })

[← Events](/essentials/events)

[x-data →](/directives/data)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Mask

Mask Plugin
===========

Alpine's Mask plugin allows you to automatically format a text input field as a user types.

This is useful for many different types of inputs: phone numbers, credit cards, dollar amounts, account numbers, dates, etc.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Mask from NPM for use inside your bundle like so:

    npm install @alpinejs/mask
    npm install @alpinejs/mask

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import mask from '@alpinejs/mask' Alpine.plugin(mask) ...
    import Alpine from 'alpinejs'
    import mask from '@alpinejs/mask'
    
    Alpine.plugin(mask)
    
    ...

Show ↓

[x-mask](#x-mask)
-----------------

The primary API for using this plugin is the `x-mask` directive.

Let's start by looking at the following simple example of a date field:

    <input x-mask="99/99/9999" placeholder="MM/DD/YYYY">
    <input x-mask="99/99/9999" placeholder="MM/DD/YYYY">

Notice how the text you type into the input field must adhere to the format provided by `x-mask`. In addition to enforcing numeric characters, the forward slashes `/` are also automatically added if a user doesn't type them first.

The following wildcard characters are supported in masks:

Wildcard

Description

`*`

Any character

`a`

Only alpha characters (a-z, A-Z)

`9`

Only numeric characters (0-9)

[Dynamic Masks](#mask-functions)
--------------------------------

Sometimes simple mask literals (i.e. `(999) 999-9999`) are not sufficient. In these cases, `x-mask:dynamic` allows you to dynamically generate masks on the fly based on user input.

Here's an example of a credit card input that needs to change it's mask based on if the number starts with the numbers "34" or "37" (which means it's an Amex card and therefore has a different format).

    <input x-mask:dynamic="    $input.startsWith('34') || $input.startsWith('37')        ? '9999 999999 99999' : '9999 9999 9999 9999'">
    <input x-mask:dynamic="
        $input.startsWith('34') || $input.startsWith('37')
            ? '9999 999999 99999' : '9999 9999 9999 9999'
    ">

As you can see in the above example, every time a user types in the input, that value is passed to the expression as `$input`. Based on the `$input`, a different mask is utilized in the field.

Try it for yourself by typing a number that starts with "34" and one that doesn't.

`x-mask:dynamic` also accepts a function as a result of the expression and will automatically pass it the `$input` as the first parameter. For example:

    <input x-mask:dynamic="creditCardMask"> <script>function creditCardMask(input) {    return input.startsWith('34') || input.startsWith('37')        ? '9999 999999 99999'        : '9999 9999 9999 9999'}</script>
    <input x-mask:dynamic="creditCardMask">
    
    <script>
    function creditCardMask(input) {
        return input.startsWith('34') || input.startsWith('37')
            ? '9999 999999 99999'
            : '9999 9999 9999 9999'
    }
    </script>

[Money Inputs](#money-inputs)
-----------------------------

Because writing your own dynamic mask expression for money inputs is fairly complex, Alpine offers a prebuilt one and makes it available as `$money()`.

Here is a fully functioning money input mask:

    <input x-mask:dynamic="$money($input)">
    <input x-mask:dynamic="$money($input)">

If you wish to swap the periods for commas and vice versa (as is required in certain currencies), you can do so using the second optional parameter:

    <input x-mask:dynamic="$money($input, ',')">
    <input x-mask:dynamic="$money($input, ',')">

You may also choose to override the thousands separator by supplying a third optional argument:

    <input x-mask:dynamic="$money($input, '.', ' ')">
    <input x-mask:dynamic="$money($input, '.', ' ')">

You can also override the default precision of 2 digits by using any desired number of digits as the fourth optional argument:

    <input x-mask:dynamic="$money($input, '.', ',', 4)">
    <input x-mask:dynamic="$money($input, '.', ',', 4)">

[← Alpine.bind()](/globals/alpine-bind)

[Intersect →](/plugins/intersect)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Model

x-model
=======

`x-model` allows you to bind the value of an input element to Alpine data.

Here's a simple example of using `x-model` to bind the value of a text field to a piece of data in Alpine.

    <div x-data="{ message: '' }">    <input type="text" x-model="message">     <span x-text="message"></span></div>
    <div x-data="{ message: '' }">
        <input type="text" x-model="message">
    
        <span x-text="message"></span>
    </div>

Now as the user types into the text field, the `message` will be reflected in the `<span>` tag.

`x-model` is two-way bound, meaning it both "sets" and "gets". In addition to changing data, if the data itself changes, the element will reflect the change.

We can use the same example as above but this time, we'll add a button to change the value of the `message` property.

    <div x-data="{ message: '' }">    <input type="text" x-model="message">     <button x-on:click="message = 'changed'">Change Message</button></div>
    <div x-data="{ message: '' }">
        <input type="text" x-model="message">
    
        <button x-on:click="message = 'changed'">Change Message</button>
    </div>

 Change Message

Now when the `<button>` is clicked, the input element's value will instantly be updated to "changed".

`x-model` works with the following input elements:

*   `<input type="text">`
*   `<textarea>`
*   `<input type="checkbox">`
*   `<input type="radio">`
*   `<select>`
*   `<input type="range">`

[Text inputs](#text-inputs)
---------------------------

    <input type="text" x-model="message"> <span x-text="message"></span>
    <input type="text" x-model="message">
    
    <span x-text="message"></span>

> Despite not being included in the above snippet, `x-model` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

[Textarea inputs](#textarea-inputs)
-----------------------------------

    <textarea x-model="message"></textarea> <span x-text="message"></span>
    <textarea x-model="message"></textarea>
    
    <span x-text="message"></span>

[Checkbox inputs](#checkbox-inputs)
-----------------------------------

### [Single checkbox with boolean](#single-checkbox-with-boolean)

    <input type="checkbox" id="checkbox" x-model="show"> <label for="checkbox" x-text="show"></label>
    <input type="checkbox" id="checkbox" x-model="show">
    
    <label for="checkbox" x-text="show"></label>

### [Multiple checkboxes bound to array](#multiple-checkboxes-bound-to-array)

    <input type="checkbox" value="red" x-model="colors"><input type="checkbox" value="orange" x-model="colors"><input type="checkbox" value="yellow" x-model="colors"> Colors: <span x-text="colors"></span>
    <input type="checkbox" value="red" x-model="colors">
    <input type="checkbox" value="orange" x-model="colors">
    <input type="checkbox" value="yellow" x-model="colors">
    
    Colors: <span x-text="colors"></span>

  

Colors:

[Radio inputs](#radio-inputs)
-----------------------------

    <input type="radio" value="yes" x-model="answer"><input type="radio" value="no" x-model="answer"> Answer: <span x-text="answer"></span>
    <input type="radio" value="yes" x-model="answer">
    <input type="radio" value="no" x-model="answer">
    
    Answer: <span x-text="answer"></span>

 

Answer:

[Select inputs](#select-inputs)
-------------------------------

### [Single select](#single-select)

    <select x-model="color">    <option>Red</option>    <option>Orange</option>    <option>Yellow</option></select> Color: <span x-text="color"></span>
    <select x-model="color">
        <option>Red</option>
        <option>Orange</option>
        <option>Yellow</option>
    </select>
    
    Color: <span x-text="color"></span>

Red Orange Yellow

Color:

### [Single select with placeholder](#single-select-with-placeholder)

    <select x-model="color">    <option value="" disabled>Select A Color</option>    <option>Red</option>    <option>Orange</option>    <option>Yellow</option></select> Color: <span x-text="color"></span>
    <select x-model="color">
        <option value="" disabled>Select A Color</option>
        <option>Red</option>
        <option>Orange</option>
        <option>Yellow</option>
    </select>
    
    Color: <span x-text="color"></span>

Select A Color Red Orange Yellow

Color:

### [Multiple select](#multiple-select)

    <select x-model="color" multiple>    <option>Red</option>    <option>Orange</option>    <option>Yellow</option></select> Colors: <span x-text="color"></span>
    <select x-model="color" multiple>
        <option>Red</option>
        <option>Orange</option>
        <option>Yellow</option>
    </select>
    
    Colors: <span x-text="color"></span>

Red Orange Yellow

Color:

### [Dynamically populated Select Options](#dynamically-populated-select-options)

    <select x-model="color">    <template x-for="color in ['Red', 'Orange', 'Yellow']">        <option x-text="color"></option>    </template></select> Color: <span x-text="color"></span>
    <select x-model="color">
        <template x-for="color in ['Red', 'Orange', 'Yellow']">
            <option x-text="color"></option>
        </template>
    </select>
    
    Color: <span x-text="color"></span>

Color:

[Range inputs](#range-inputs)
-----------------------------

    <input type="range" x-model="range" min="0" max="1" step="0.1"> <span x-text="range"></span>
    <input type="range" x-model="range" min="0" max="1" step="0.1">
    
    <span x-text="range"></span>

[Modifiers](#modifiers)
-----------------------

### [`.lazy`](#lazy)

On text inputs, by default, `x-model` updates the property on every keystroke. By adding the `.lazy` modifier, you can force an `x-model` input to only update the property when user focuses away from the input element.

This is handy for things like real-time form-validation where you might not want to show an input validation error until the user "tabs" away from a field.

    <input type="text" x-model.lazy="username"><span x-show="username.length > 20">The username is too long.</span>
    <input type="text" x-model.lazy="username">
    <span x-show="username.length > 20">The username is too long.</span>

### [`.number`](#number)

By default, any data stored in a property via `x-model` is stored as a string. To force Alpine to store the value as a JavaScript number, add the `.number` modifier.

    <input type="text" x-model.number="age"><span x-text="typeof age"></span>
    <input type="text" x-model.number="age">
    <span x-text="typeof age"></span>

### [`.boolean`](#boolean)

By default, any data stored in a property via `x-model` is stored as a string. To force Alpine to store the value as a JavaScript boolean, add the `.boolean` modifier. Both integers (1/0) and strings (true/false) are valid boolean values.

    <select x-model.boolean="isActive">    <option value="true">Yes</option>    <option value="false">No</option></select><span x-text="typeof isActive"></span>
    <select x-model.boolean="isActive">
        <option value="true">Yes</option>
        <option value="false">No</option>
    </select>
    <span x-text="typeof isActive"></span>

### [`.debounce`](#debounce)

By adding `.debounce` to `x-model`, you can easily debounce the updating of bound input.

This is useful for things like real-time search inputs that fetch new data from the server every time the search property changes.

    <input type="text" x-model.debounce="search">
    <input type="text" x-model.debounce="search">

The default debounce time is 250 milliseconds, you can easily customize this by adding a time modifier like so.

    <input type="text" x-model.debounce.500ms="search">
    <input type="text" x-model.debounce.500ms="search">

### [`.throttle`](#throttle)

Similar to `.debounce` you can limit the property update triggered by `x-model` to only updating on a specified interval.

The default throttle interval is 250 milliseconds, you can easily customize this by adding a time modifier like so.

    <input type="text" x-model.throttle.500ms="search">
    <input type="text" x-model.throttle.500ms="search">

### [`.fill`](#fill)

By default, if an input has a value attribute, it is ignored by Alpine and instead, the value of the input is set to the value of the property bound using `x-model`.

But if a bound property is empty, then you can use an input's value attribute to populate the property by adding the `.fill` modifier.

[Programmatic access](#programmatic access)
-------------------------------------------

Alpine exposes under-the-hood utilities for getting and setting properties bound with `x-model`. This is useful for complex Alpine utilities that may want to override the default x-model behavior, or instances where you want to allow `x-model` on a non-input element.

You can access these utilities through a property called `_x_model` on the `x-model`ed element. `_x_model` has two methods to get and set the bound property:

*   `el._x_model.get()` (returns the value of the bound property)
*   `el._x_model.set()` (sets the value of the bound property)

    <div x-data="{ username: 'calebporzio' }">    <div x-ref="div" x-model="username"></div>     <button @click="$refs.div._x_model.set('phantomatrix')">        Change username to: 'phantomatrix'    </button>     <span x-text="$refs.div._x_model.get()"></span></div>
    <div x-data="{ username: 'calebporzio' }">
        <div x-ref="div" x-model="username"></div>
    
        <button @click="$refs.div._x_model.set('phantomatrix')">
            Change username to: 'phantomatrix'
        </button>
    
        <span x-text="$refs.div._x_model.get()"></span>
    </div>

Change username to: 'phantomatrix'

[← x-html](/directives/html)

[x-modelable →](/directives/modelable)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Modelable

x-modelable
===========

`x-modelable` allows you to expose any Alpine property as the target of the `x-model` directive.

Here's a simple example of using `x-modelable` to expose a variable for binding with `x-model`.

    <div x-data="{ number: 5 }">    <div x-data="{ count: 0 }" x-modelable="count" x-model="number">        <button @click="count++">Increment</button>    </div>     Number: <span x-text="number"></span></div>
    <div x-data="{ number: 5 }">
        <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
            <button @click="count++">Increment</button>
        </div>
    
        Number: <span x-text="number"></span>
    </div>

Increment

Number:

As you can see the outer scope property "number" is now bound to the inner scope property "count".

Typically this feature would be used in conjunction with a backend templating framework like Laravel Blade. It's useful for abstracting away Alpine components into backend templates and exposing state to the outside through `x-model` as if it were a native input.

[← x-model](/directives/model)

[x-for →](/directives/for)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Morph

Morph Plugin
============

Alpine's Morph plugin allows you to "morph" an element on the page into the provided HTML template, all while preserving any browser or Alpine state within the "morphed" element.

This is useful for updating HTML from a server request without losing Alpine's on-page state. A utility like this is at the core of full-stack frameworks like [Laravel Livewire](https://laravel-livewire.com/) and [Phoenix LiveView](https://dockyard.com/blog/2018/12/12/phoenix-liveview-interactive-real-time-apps-no-need-to-write-javascript).

The best way to understand its purpose is with the following interactive visualization. Give it a try!

Previous

Next

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Morph from NPM for use inside your bundle like so:

    npm install @alpinejs/morph
    npm install @alpinejs/morph

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import morph from '@alpinejs/morph' window.Alpine = AlpineAlpine.plugin(morph) ...
    import Alpine from 'alpinejs'
    import morph from '@alpinejs/morph'
    
    window.Alpine = Alpine
    Alpine.plugin(morph)
    
    ...

[Alpine.morph()](#alpine-morph)
-------------------------------

The `Alpine.morph(el, newHtml)` allows you to imperatively morph a dom node based on passed in HTML. It accepts the following parameters:

Parameter

Description

`el`

A DOM element on the page.

`newHtml`

A string of HTML to use as the template to morph the dom element into.

`options` (optional)

An options object used mainly for [injecting lifecycle hooks](#lifecycle-hooks).

Here's an example of using `Alpine.morph()` to update an Alpine component with new HTML: (In real apps, this new HTML would likely be coming from the server)

    <div x-data="{ message: 'Change me, then press the button!' }">    <input type="text" x-model="message">    <span x-text="message"></span></div> <button>Run Morph</button> <script>    document.querySelector('button').addEventListener('click', () => {        let el = document.querySelector('div')         Alpine.morph(el, `            <div x-data="{ message: 'Change me, then press the button!' }">                <h2>See how new elements have been added</h2>                 <input type="text" x-model="message">                <span x-text="message"></span>                 <h2>but the state of this component hasn't changed? Magical.</h2>            </div>        `)    })</script>
    <div x-data="{ message: 'Change me, then press the button!' }">
        <input type="text" x-model="message">
        <span x-text="message"></span>
    </div>
    
    <button>Run Morph</button>
    
    <script>
        document.querySelector('button').addEventListener('click', () => {
            let el = document.querySelector('div')
    
            Alpine.morph(el, `
                <div x-data="{ message: 'Change me, then press the button!' }">
                    <h2>See how new elements have been added</h2>
    
                    <input type="text" x-model="message">
                    <span x-text="message"></span>
    
                    <h2>but the state of this component hasn't changed? Magical.</h2>
                </div>
            `)
        })
    </script>

Run Morph

document.querySelector('#morph-button-1').addEventListener('click', () => { let el = document.querySelector('#morph-demo-1') Alpine.morph(el, \` <div x-data="{ message: 'Change me, then press the button!' }" id="morph-demo-1" class="space-y-2"> <h4>See how new elements have been added</h4> <input type="text" x-model="message" class="w-full"> <span x-text="message"></span> <h4>but the state of this component hasn't changed? Magical.</h4> </div> \`) })

### [Lifecycle Hooks](#lifecycle-hooks)

The "Morph" plugin works by comparing two DOM trees, the live element, and the passed in HTML.

Morph walks both trees simultaneously and compares each node and its children. If it finds differences, it "patches" (changes) the current DOM tree to match the passed in HTML's tree.

While the default algorithm is very capable, there are cases where you may want to hook into its lifecycle and observe or change its behavior as it's happening.

Before we jump into the available Lifecycle hooks themselves, let's first list out all the potential parameters they receive and explain what each one is:

Parameter

Description

`el`

This is always the actual, current, DOM element on the page that will be "patched" (changed by Morph).

`toEl`

This is a "template element". It's a temporary element representing what the live `el` will be patched to. It will never actually live on the page and should only be used for reference purposes.

`childrenOnly()`

This is a function that can be called inside the hook to tell Morph to skip the current element and only "patch" its children.

`skip()`

A function that when called within the hook will "skip" comparing/patching itself and the children of the current element.

Here are the available lifecycle hooks (passed in as the third parameter to `Alpine.morph(..., options)`):

Option

Description

`updating(el, toEl, childrenOnly, skip)`

Called before patching the `el` with the comparison `toEl`.

`updated(el, toEl)`

Called after Morph has patched `el`.

`removing(el, skip)`

Called before Morph removes an element from the live DOM.

`removed(el)`

Called after Morph has removed an element from the live DOM.

`adding(el, skip)`

Called before adding a new element.

`added(el)`

Called after adding a new element to the live DOM tree.

`key(el)`

A re-usable function to determine how Morph "keys" elements in the tree before comparing/patching. [More on that here](#keys)

`lookahead`

A boolean value telling Morph to enable an extra feature in its algorithm that "looks ahead" to make sure a DOM element that's about to be removed should instead just be "moved" to a later sibling.

Here is code of all these lifecycle hooks for a more concrete reference:

    Alpine.morph(el, newHtml, {    updating(el, toEl, childrenOnly, skip) {        //    },     updated(el, toEl) {        //    },     removing(el, skip) {        //    },     removed(el) {        //    },     adding(el, skip) {        //    },     added(el) {        //    },     key(el) {        // By default Alpine uses the `key=""` HTML attribute.        return el.id    },     lookahead: true, // Default: false})
    Alpine.morph(el, newHtml, {
        updating(el, toEl, childrenOnly, skip) {
            //
        },
    
        updated(el, toEl) {
            //
        },
    
        removing(el, skip) {
            //
        },
    
        removed(el) {
            //
        },
    
        adding(el, skip) {
            //
        },
    
        added(el) {
            //
        },
    
        key(el) {
            // By default Alpine uses the `key=""` HTML attribute.
            return el.id
        },
    
        lookahead: true, // Default: false
    })

### [Keys](#keys)

Dom-diffing utilities like Morph try their best to accurately "morph" the original DOM into the new HTML. However, there are cases where it's impossible to determine if an element should be just changed, or replaced completely.

Because of this limitation, Morph has a "key" system that allows developers to "force" preserving certain elements rather than replacing them.

The most common use-case for them is a list of siblings within a loop. Below is an example of why keys are necessary sometimes:

    <!-- "Live" Dom on the page: --><ul>    <li>Mark</li>    <li>Tom</li>    <li>Travis</li></ul> <!-- New HTML to "morph to": --><ul>    <li>Travis</li>    <li>Mark</li>    <li>Tom</li></ul>
    <!-- "Live" Dom on the page: -->
    <ul>
        <li>Mark</li>
        <li>Tom</li>
        <li>Travis</li>
    </ul>
    
    <!-- New HTML to "morph to": -->
    <ul>
        <li>Travis</li>
        <li>Mark</li>
        <li>Tom</li>
    </ul>

Given the above situation, Morph has no way to know that the "Travis" node has been moved in the DOM tree. It just thinks that "Mark" has been changed to "Travis" and "Travis" changed to "Tom".

This is not what we actually want, we want Morph to preserve the original elements and instead of changing them, MOVE them within the `<ul>`.

By adding keys to each node, we can accomplish this like so:

    <!-- "Live" Dom on the page: --><ul>    <li key="1">Mark</li>    <li key="2">Tom</li>    <li key="3">Travis</li></ul> <!-- New HTML to "morph to": --><ul>    <li key="3">Travis</li>    <li key="1">Mark</li>    <li key="2">Tom</li></ul>
    <!-- "Live" Dom on the page: -->
    <ul>
        <li key="1">Mark</li>
        <li key="2">Tom</li>
        <li key="3">Travis</li>
    </ul>
    
    <!-- New HTML to "morph to": -->
    <ul>
        <li key="3">Travis</li>
        <li key="1">Mark</li>
        <li key="2">Tom</li>
    </ul>

Now that there are "keys" on the `<li>`s, Morph will match them in both trees and move them accordingly.

You can configure what Morph considers a "key" with the `key:` configuration option. [More on that here](#lifecycle-hooks)

[← Anchor](/plugins/anchor)

[Sort →](/plugins/sort)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## NextTick

$nextTick
=========

`$nextTick` is a magic property that allows you to only execute a given expression AFTER Alpine has made its reactive DOM updates. This is useful for times you want to interact with the DOM state AFTER it's reflected any data updates you've made.

    <div x-data="{ title: 'Hello' }">    <button        @click="            title = 'Hello World!';            $nextTick(() => { console.log($el.innerText) });        "        x-text="title"    ></button></div>
    <div x-data="{ title: 'Hello' }">
        <button
            @click="
                title = 'Hello World!';
                $nextTick(() => { console.log($el.innerText) });
            "
            x-text="title"
        ></button>
    </div>

In the above example, rather than logging "Hello" to the console, "Hello World!" will be logged because `$nextTick` was used to wait until Alpine was finished updating the DOM.

[Promises](#promises)
---------------------

`$nextTick` returns a promise, allowing the use of `$nextTick` to pause an async function until after pending dom updates. When used like this, `$nextTick` also does not require an argument to be passed.

    <div x-data="{ title: 'Hello' }">    <button        @click="            title = 'Hello World!';            await $nextTick();            console.log($el.innerText);        "        x-text="title"    ></button></div>
    <div x-data="{ title: 'Hello' }">
        <button
            @click="
                title = 'Hello World!';
                await $nextTick();
                console.log($el.innerText);
            "
            x-text="title"
        ></button>
    </div>

[← $dispatch](/magics/dispatch)

[$root →](/magics/root)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## On

x-on
====

`x-on` allows you to easily run code on dispatched DOM events.

Here's an example of simple button that shows an alert when clicked.

    <button x-on:click="alert('Hello World!')">Say Hi</button>
    <button x-on:click="alert('Hello World!')">Say Hi</button>

> `x-on` can only listen for events with lower case names, as HTML attributes are case-insensitive. Writing `x-on:CLICK` will listen for an event named `click`. If you need to listen for a custom event with a camelCase name, you can use the [`.camel` helper](#camel) to work around this limitation. Alternatively, you can use [`x-bind`](/directives/bind#bind-directives) to attach an `x-on` directive to an element in javascript code (where case will be preserved).

[Shorthand syntax](#shorthand-syntax)
-------------------------------------

If `x-on:` is too verbose for your tastes, you can use the shorthand syntax: `@`.

Here's the same component as above, but using the shorthand syntax instead:

    <button @click="alert('Hello World!')">Say Hi</button>
    <button @click="alert('Hello World!')">Say Hi</button>

> Despite not being included in the above snippet, `x-on` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

[The event object](#the-event-object)
-------------------------------------

If you wish to access the native JavaScript event object from your expression, you can use Alpine's magic `$event` property.

    <button @click="alert($event.target.getAttribute('message'))" message="Hello World">Say Hi</button>
    <button @click="alert($event.target.getAttribute('message'))" message="Hello World">Say Hi</button>

In addition, Alpine also passes the event object to any methods referenced without trailing parenthesis. For example:

    <button @click="handleClick">...</button> <script>    function handleClick(e) {        // Now you can access the event object (e) directly    }</script>
    <button @click="handleClick">...</button>
    
    <script>
        function handleClick(e) {
            // Now you can access the event object (e) directly
        }
    </script>

[Keyboard events](#keyboard-events)
-----------------------------------

Alpine makes it easy to listen for `keydown` and `keyup` events on specific keys.

Here's an example of listening for the `Enter` key inside an input element.

    <input type="text" @keyup.enter="alert('Submitted!')">
    <input type="text" @keyup.enter="alert('Submitted!')">

You can also chain these key modifiers to achieve more complex listeners.

Here's a listener that runs when the `Shift` key is held and `Enter` is pressed, but not when `Enter` is pressed alone.

    <input type="text" @keyup.shift.enter="alert('Submitted!')">
    <input type="text" @keyup.shift.enter="alert('Submitted!')">

You can directly use any valid key names exposed via [`KeyboardEvent.key`](https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values) as modifiers by converting them to kebab-case.

    <input type="text" @keyup.page-down="alert('Submitted!')">
    <input type="text" @keyup.page-down="alert('Submitted!')">

For easy reference, here is a list of common keys you may want to listen for.

Modifier

Keyboard Key

`.shift`

Shift

`.enter`

Enter

`.space`

Space

`.ctrl`

Ctrl

`.cmd`

Cmd

`.meta`

Cmd on Mac, Windows key on Windows

`.alt`

Alt

`.up` `.down` `.left` `.right`

Up/Down/Left/Right arrows

`.escape`

Escape

`.tab`

Tab

`.caps-lock`

Caps Lock

`.equal`

Equal, `=`

`.period`

Period, `.`

`.comma`

Comma, `,`

`.slash`

Forward Slash, `/`

[Mouse events](#mouse-events)
-----------------------------

Like the above Keyboard Events, Alpine allows the use of some key modifiers for handling `click` events.

Modifier

Event Key

`.shift`

shiftKey

`.ctrl`

ctrlKey

`.cmd`

metaKey

`.meta`

metaKey

`.alt`

altKey

These work on `click`, `auxclick`, `context` and `dblclick` events, and even `mouseover`, `mousemove`, `mouseenter`, `mouseleave`, `mouseout`, `mouseup` and `mousedown`.

Here's an example of a button that changes behaviour when the `Shift` key is held down.

    <button type="button"    @click="message = 'selected'"    @click.shift="message = 'added to selection'">    @mousemove.shift="message = 'add to selection'"    @mouseout="message = 'select'"    x-text="message"></button>
    <button type="button"
        @click="message = 'selected'"
        @click.shift="message = 'added to selection'">
        @mousemove.shift="message = 'add to selection'"
        @mouseout="message = 'select'"
        x-text="message"></button>

> Note: Normal click events with some modifiers (like `ctrl`) will automatically become `contextmenu` events in most browsers. Similarly, `right-click` events will trigger a `contextmenu` event, but will also trigger an `auxclick` event if the `contextmenu` event is prevented.

[Custom events](#custom-events)
-------------------------------

Alpine event listeners are a wrapper for native DOM event listeners. Therefore, they can listen for ANY DOM event, including custom events.

Here's an example of a component that dispatches a custom DOM event and listens for it as well.

    <div x-data @foo="alert('Button Was Clicked!')">    <button @click="$event.target.dispatchEvent(new CustomEvent('foo', { bubbles: true }))">...</button></div>
    <div x-data @foo="alert('Button Was Clicked!')">
        <button @click="$event.target.dispatchEvent(new CustomEvent('foo', { bubbles: true }))">...</button>
    </div>

When the button is clicked, the `@foo` listener will be called.

Because the `.dispatchEvent` API is verbose, Alpine offers a `$dispatch` helper to simplify things.

Here's the same component re-written with the `$dispatch` magic property.

    <div x-data @foo="alert('Button Was Clicked!')">    <button @click="$dispatch('foo')">...</button></div>
    <div x-data @foo="alert('Button Was Clicked!')">
        <button @click="$dispatch('foo')">...</button>
    </div>

[→ Read more about `$dispatch`](/magics/dispatch)

[Modifiers](#modifiers)
-----------------------

Alpine offers a number of directive modifiers to customize the behavior of your event listeners.

### [.prevent](#prevent)

`.prevent` is the equivalent of calling `.preventDefault()` inside a listener on the browser event object.

    <form @submit.prevent="console.log('submitted')" action="/foo">    <button>Submit</button></form>
    <form @submit.prevent="console.log('submitted')" action="/foo">
        <button>Submit</button>
    </form>

In the above example, with the `.prevent`, clicking the button will NOT submit the form to the `/foo` endpoint. Instead, Alpine's listener will handle it and "prevent" the event from being handled any further.

### [.stop](#stop)

Similar to `.prevent`, `.stop` is the equivalent of calling `.stopPropagation()` inside a listener on the browser event object.

    <div @click="console.log('I will not get logged')">    <button @click.stop>Click Me</button></div>
    <div @click="console.log('I will not get logged')">
        <button @click.stop>Click Me</button>
    </div>

In the above example, clicking the button WON'T log the message. This is because we are stopping the propagation of the event immediately and not allowing it to "bubble" up to the `<div>` with the `@click` listener on it.

### [.outside](#outside)

`.outside` is a convenience helper for listening for a click outside of the element it is attached to. Here's a simple dropdown component example to demonstrate:

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle</button>     <div x-show="open" @click.outside="open = false">        Contents...    </div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
    
        <div x-show="open" @click.outside="open = false">
            Contents...
        </div>
    </div>

In the above example, after showing the dropdown contents by clicking the "Toggle" button, you can close the dropdown by clicking anywhere on the page outside the content.

This is because `.outside` is listening for clicks that DON'T originate from the element it's registered on.

> It's worth noting that the `.outside` expression will only be evaluated when the element it's registered on is visible on the page. Otherwise, there would be nasty race conditions where clicking the "Toggle" button would also fire the `@click.outside` handler when it is not visible.

### [.window](#window)

When the `.window` modifier is present, Alpine will register the event listener on the root `window` object on the page instead of the element itself.

    <div @keyup.escape.window="...">...</div>
    <div @keyup.escape.window="...">...</div>

The above snippet will listen for the "escape" key to be pressed ANYWHERE on the page.

Adding `.window` to listeners is extremely useful for these sorts of cases where a small part of your markup is concerned with events that take place on the entire page.

### [.document](#document)

`.document` works similarly to `.window` only it registers listeners on the `document` global, instead of the `window` global.

### [.once](#once)

By adding `.once` to a listener, you are ensuring that the handler is only called ONCE.

    <button @click.once="console.log('I will only log once')">...</button>
    <button @click.once="console.log('I will only log once')">...</button>

### [.debounce](#debounce)

Sometimes it is useful to "debounce" an event handler so that it only is called after a certain period of inactivity (250 milliseconds by default).

For example if you have a search field that fires network requests as the user types into it, adding a debounce will prevent the network requests from firing on every single keystroke.

    <input @input.debounce="fetchResults">
    <input @input.debounce="fetchResults">

Now, instead of calling `fetchResults` after every keystroke, `fetchResults` will only be called after 250 milliseconds of no keystrokes.

If you wish to lengthen or shorten the debounce time, you can do so by trailing a duration after the `.debounce` modifier like so:

    <input @input.debounce.500ms="fetchResults">
    <input @input.debounce.500ms="fetchResults">

Now, `fetchResults` will only be called after 500 milliseconds of inactivity.

### [.throttle](#throttle)

`.throttle` is similar to `.debounce` except it will release a handler call every 250 milliseconds instead of deferring it indefinitely.

This is useful for cases where there may be repeated and prolonged event firing and using `.debounce` won't work because you want to still handle the event every so often.

For example:

    <div @scroll.window.throttle="handleScroll">...</div>
    <div @scroll.window.throttle="handleScroll">...</div>

The above example is a great use case of throttling. Without `.throttle`, the `handleScroll` method would be fired hundreds of times as the user scrolls down a page. This can really slow down a site. By adding `.throttle`, we are ensuring that `handleScroll` only gets called every 250 milliseconds.

> Fun Fact: This exact strategy is used on this very documentation site to update the currently highlighted section in the right sidebar.

Just like with `.debounce`, you can add a custom duration to your throttled event:

    <div @scroll.window.throttle.750ms="handleScroll">...</div>
    <div @scroll.window.throttle.750ms="handleScroll">...</div>

Now, `handleScroll` will only be called every 750 milliseconds.

### [.self](#self)

By adding `.self` to an event listener, you are ensuring that the event originated on the element it is declared on, and not from a child element.

    <button @click.self="handleClick">    Click Me     <img src="..."></button>
    <button @click.self="handleClick">
        Click Me
    
        <img src="...">
    </button>

In the above example, we have an `<img>` tag inside the `<button>` tag. Normally, any click originating within the `<button>` element (like on `<img>` for example), would be picked up by a `@click` listener on the button.

However, in this case, because we've added a `.self`, only clicking the button itself will call `handleClick`. Only clicks originating on the `<img>` element will not be handled.

### [.camel](#camel)

    <div @custom-event.camel="handleCustomEvent">    ...</div>
    <div @custom-event.camel="handleCustomEvent">
        ...
    </div>

Sometimes you may want to listen for camelCased events such as `customEvent` in our example. Because camelCasing inside HTML attributes is not supported, adding the `.camel` modifier is necessary for Alpine to camelCase the event name internally.

By adding `.camel` in the above example, Alpine is now listening for `customEvent` instead of `custom-event`.

### [.dot](#dot)

    <div @custom-event.dot="handleCustomEvent">    ...</div>
    <div @custom-event.dot="handleCustomEvent">
        ...
    </div>

Similar to the `.camelCase` modifier there may be situations where you want to listen for events that have dots in their name (like `custom.event`). Since dots within the event name are reserved by Alpine you need to write them with dashes and add the `.dot` modifier.

In the code example above `custom-event.dot` will correspond to the event name `custom.event`.

### [.passive](#passive)

Browsers optimize scrolling on pages to be fast and smooth even when JavaScript is being executed on the page. However, improperly implemented touch and wheel listeners can block this optimization and cause poor site performance.

If you are listening for touch events, it's important to add `.passive` to your listeners to not block scroll performance.

    <div @touchstart.passive="...">...</div>
    <div @touchstart.passive="...">...</div>

[→ Read more about passive listeners](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#improving_scrolling_performance_with_passive_listeners)

### .capture

Add this modifier if you want to execute this listener in the event's capturing phase, e.g. before the event bubbles from the target element up the DOM.

    <div @click.capture="console.log('I will log first')">    <button @click="console.log('I will log second')"></button></div>
    <div @click.capture="console.log('I will log first')">
        <button @click="console.log('I will log second')"></button>
    </div>

[→ Read more about the capturing and bubbling phase of events](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#usecapture)

[← x-bind](/directives/bind)

[x-text →](/directives/text)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Persist

Persist Plugin
==============

Alpine's Persist plugin allows you to persist Alpine state across page loads.

This is useful for persisting search filters, active tabs, and other features where users will be frustrated if their configuration is reset after refreshing or leaving and revisiting a page.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Persist from NPM for use inside your bundle like so:

    npm install @alpinejs/persist
    npm install @alpinejs/persist

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import persist from '@alpinejs/persist' Alpine.plugin(persist) ...
    import Alpine from 'alpinejs'
    import persist from '@alpinejs/persist'
    
    Alpine.plugin(persist)
    
    ...

[$persist](#magic-persist)
--------------------------

The primary API for using this plugin is the magic `$persist` method.

You can wrap any value inside `x-data` with `$persist` like below to persist its value across page loads:

    <div x-data="{ count: $persist(0) }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

Increment

In the above example, because we wrapped `0` in `$persist()`, Alpine will now intercept changes made to `count` and persist them across page loads.

You can try this for yourself by incrementing the "count" in the above example, then refreshing this page and observing that the "count" maintains its state and isn't reset to "0".

[How does it work?](#how-it-works)
----------------------------------

If a value is wrapped in `$persist`, on initialization Alpine will register its own watcher for that value. Now everytime that value changes for any reason, Alpine will store the new value in [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage).

Now when a page is reloaded, Alpine will check localStorage (using the name of the property as the key) for a value. If it finds one, it will set the property value from localStorage immediately.

You can observe this behavior by opening your browser devtool's localStorage viewer:

[![Chrome devtools showing the localStorage view with count set to 0](/img/persist_devtools.png)](https://developer.chrome.com/docs/devtools/storage/localstorage/)

You'll observe that by simply visiting this page, Alpine already set the value of "count" in localStorage. You'll also notice it prefixes the property name "count" with "_x_" as a way of namespacing these values so Alpine doesn't conflict with other tools using localStorage.

Now change the "count" in the following example and observe the changes made by Alpine to localStorage:

    <div x-data="{ count: $persist(0) }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

Increment

> `$persist` works with primitive values as well as with arrays and objects. However, it is worth noting that localStorage must be cleared when the type of the variable changes.  
> Given the previous example, if we change count to a value of `$persist({ value: 0 })`, then localStorage must be cleared or the variable 'count' renamed.

[Setting a custom key](#custom-key)
-----------------------------------

By default, Alpine uses the property key that `$persist(...)` is being assigned to ("count" in the above examples).

Consider the scenario where you have multiple Alpine components across pages or even on the same page that all use "count" as the property key.

Alpine will have no way of differentiating between these components.

In these cases, you can set your own custom key for any persisted value using the `.as` modifier like so:

    <div x-data="{ count: $persist(0).as('other-count') }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <div x-data="{ count: $persist(0).as('other-count') }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

Now Alpine will store and retrieve the above "count" value using the key "other-count".

Here's a view of Chrome Devtools to see for yourself:

![Chrome devtools showing the localStorage view with count set to 0](/img/persist_custom_key_devtools.png)

[Using a custom storage](#custom-storage)
-----------------------------------------

By default, data is saved to localStorage, it does not have an expiration time and it's kept even when the page is closed.

Consider the scenario where you want to clear the data once the user close the tab. In this case you can persist data to sessionStorage using the `.using` modifier like so:

    <div x-data="{ count: $persist(0).using(sessionStorage) }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <div x-data="{ count: $persist(0).using(sessionStorage) }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

You can also define your custom storage object exposing a getItem function and a setItem function. For example, you can decide to use a session cookie as storage doing so:

    <script>    window.cookieStorage = {        getItem(key) {            let cookies = document.cookie.split(";");            for (let i = 0; i < cookies.length; i++) {                let cookie = cookies[i].split("=");                if (key == cookie[0].trim()) {                    return decodeURIComponent(cookie[1]);                }            }            return null;        },        setItem(key, value) {            document.cookie = key+' = '+encodeURIComponent(value)        }    }</script> <div x-data="{ count: $persist(0).using(cookieStorage) }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <script>
        window.cookieStorage = {
            getItem(key) {
                let cookies = document.cookie.split(";");
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i].split("=");
                    if (key == cookie[0].trim()) {
                        return decodeURIComponent(cookie[1]);
                    }
                }
                return null;
            },
            setItem(key, value) {
                document.cookie = key+' = '+encodeURIComponent(value)
            }
        }
    </script>
    
    <div x-data="{ count: $persist(0).using(cookieStorage) }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

[Using $persist with Alpine.data](#using-persist-with-alpine-data)
------------------------------------------------------------------

If you want to use `$persist` with `Alpine.data`, you need to use a standard function instead of an arrow function so Alpine can bind a custom `this` context when it initially evaluates the component scope.

    Alpine.data('dropdown', function () {    return {        open: this.$persist(false)    }})
    Alpine.data('dropdown', function () {
        return {
            open: this.$persist(false)
        }
    })

[Using the Alpine.$persist global](#using-alpine-persist-global)
----------------------------------------------------------------

`Alpine.$persist` is exposed globally so it can be used outside of `x-data` contexts. This is useful to persist data from other sources such as `Alpine.store`.

    Alpine.store('darkMode', {    on: Alpine.$persist(true).as('darkMode_on')});
    Alpine.store('darkMode', {
        on: Alpine.$persist(true).as('darkMode_on')
    });

[← Resize](/plugins/resize)

[Focus →](/plugins/focus)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Reactivity

Reactivity
==========

Alpine is "reactive" in the sense that when you change a piece of data, everything that depends on that data "reacts" automatically to that change.

Every bit of reactivity that takes place in Alpine, happens because of two very important reactive functions in Alpine's core: `Alpine.reactive()`, and `Alpine.effect()`.

> Alpine uses VueJS's reactivity engine under the hood to provide these functions. [→ Read more about @vue/reactivity](https://github.com/vuejs/vue-next/tree/master/packages/reactivity)

Understanding these two functions will give you super powers as an Alpine developer, but also just as a web developer in general.

[Alpine.reactive()](#alpine-reactive)
-------------------------------------

Let's first look at `Alpine.reactive()`. This function accepts a JavaScript object as its parameter and returns a "reactive" version of that object. For example:

    let data = { count: 1 } let reactiveData = Alpine.reactive(data)
    let data = { count: 1 }
    
    let reactiveData = Alpine.reactive(data)

Under the hood, when `Alpine.reactive` receives `data`, it wraps it inside a custom JavaScript proxy.

A proxy is a special kind of object in JavaScript that can intercept "get" and "set" calls to a JavaScript object.

[→ Read more about JavaScript proxies](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy)

At face value, `reactiveData` should behave exactly like `data`. For example:

    console.log(data.count) // 1console.log(reactiveData.count) // 1 reactiveData.count = 2 console.log(data.count) // 2console.log(reactiveData.count) // 2
    console.log(data.count) // 1
    console.log(reactiveData.count) // 1
    
    reactiveData.count = 2
    
    console.log(data.count) // 2
    console.log(reactiveData.count) // 2

What you see here is that because `reactiveData` is a thin wrapper around `data`, any attempts to get or set a property will behave exactly as if you had interacted with `data` directly.

The main difference here is that any time you modify or retrieve (get or set) a value from `reactiveData`, Alpine is aware of it and can execute any other logic that depends on this data.

`Alpine.reactive` is only the first half of the story. `Alpine.effect` is the other half, let's dig in.

[Alpine.effect()](#alpine-effect)
---------------------------------

`Alpine.effect` accepts a single callback function. As soon as `Alpine.effect` is called, it will run the provided function, but actively look for any interactions with reactive data. If it detects an interaction (a get or set from the aforementioned reactive proxy) it will keep track of it and make sure to re-run the callback if any of reactive data changes in the future. For example:

    let data = Alpine.reactive({ count: 1 }) Alpine.effect(() => {    console.log(data.count)})
    let data = Alpine.reactive({ count: 1 })
    
    Alpine.effect(() => {
        console.log(data.count)
    })

When this code is first run, "1" will be logged to the console. Any time `data.count` changes, it's value will be logged to the console again.

This is the mechanism that unlocks all of the reactivity at the core of Alpine.

To connect the dots further, let's look at a simple "counter" component example without using Alpine syntax at all, only using `Alpine.reactive` and `Alpine.effect`:

    <button>Increment</button> Count: <span></span>
    <button>Increment</button>
    
    Count: <span></span>

    let button = document.querySelector('button')let span = document.querySelector('span') let data = Alpine.reactive({ count: 1 }) Alpine.effect(() => {    span.textContent = data.count}) button.addEventListener('click', () => {    data.count = data.count + 1})
    let button = document.querySelector('button')
    let span = document.querySelector('span')
    
    let data = Alpine.reactive({ count: 1 })
    
    Alpine.effect(() => {
        span.textContent = data.count
    })
    
    button.addEventListener('click', () => {
        data.count = data.count + 1
    })

Increment

Count:

As you can see, you can make any data reactive, and you can also wrap any functionality in `Alpine.effect`.

This combination unlocks an incredibly powerful programming paradigm for web development. Run wild and free.

[← CSP](/advanced/csp)

[Extending →](/advanced/extending)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Ref

x-ref
=====

`x-ref` in combination with `$refs` is a useful utility for easily accessing DOM elements directly. It's most useful as a replacement for APIs like `getElementById` and `querySelector`.

    <button @click="$refs.text.remove()">Remove Text</button> <span x-ref="text">Hello 👋</span>
    <button @click="$refs.text.remove()">Remove Text</button>
    
    <span x-ref="text">Hello 👋</span>

Remove Text

Hello 👋

> Despite not being included in the above snippet, `x-ref` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

[← x-ignore](/directives/ignore)

[x-cloak →](/directives/cloak)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Refs

$refs
=====

`$refs` is a magic property that can be used to retrieve DOM elements marked with `x-ref` inside the component. This is useful when you need to manually manipulate DOM elements. It's often used as a more succinct, scoped, alternative to `document.querySelector`.

    <button @click="$refs.text.remove()">Remove Text</button> <span x-ref="text">Hello 👋</span>
    <button @click="$refs.text.remove()">Remove Text</button>
    
    <span x-ref="text">Hello 👋</span>

Remove Text

Hello 👋

Now, when the `<button>` is pressed, the `<span>` will be removed.

### [Limitations](#limitations)

In V2 it was possible to bind `$refs` to elements dynamically, like seen below:

    <template x-for="item in items" :key="item.id" >    <div :x-ref="item.name">    some content ...    </div></template>
    <template x-for="item in items" :key="item.id" >
        <div :x-ref="item.name">
        some content ...
        </div>
    </template>

However, in V3, `$refs` can only be accessed for elements that are created statically. So for the example above: if you were expecting the value of `item.name` inside of `$refs` to be something like _Batteries_, you should be aware that `$refs` will actually contain the literal string `'item.name'` and not _Batteries_.

[← $el](/magics/el)

[$store →](/magics/store)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Resize

Resize Plugin
=============

Alpine's Resize plugin is a convenience wrapper for the [Resize Observer](https://developer.mozilla.org/en-US/docs/Web/API/Resize_Observer_API) that allows you to easily react when an element changes size.

This is useful for: custom size-based animations, intelligent sticky positioning, conditionally adding attributes based on the element's size, etc.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Resize from NPM for use inside your bundle like so:

    npm install @alpinejs/resize
    npm install @alpinejs/resize

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import resize from '@alpinejs/resize' Alpine.plugin(resize) ...
    import Alpine from 'alpinejs'
    import resize from '@alpinejs/resize'
    
    Alpine.plugin(resize)
    
    ...

[x-resize](#x-resize)
---------------------

The primary API for using this plugin is `x-resize`. You can add `x-resize` to any element within an Alpine component, and when that element is resized for any reason, the provided expression will execute with two magic properties: `$width` and `$height`.

For example, here's a simple example of using `x-resize` to display the width and height of an element as it changes size.

    <div    x-data="{ width: 0, height: 0 }"    x-resize="width = $width; height = $height">    <p x-text="'Width: ' + width + 'px'"></p>    <p x-text="'Height: ' + height + 'px'"></p></div>
    <div
        x-data="{ width: 0, height: 0 }"
        x-resize="width = $width; height = $height"
    >
        <p x-text="'Width: ' + width + 'px'"></p>
        <p x-text="'Height: ' + height + 'px'"></p>
    </div>

_Resize your browser window to see the width and height values change._  
  

[Modifiers](#modifiers)
-----------------------

### [.document](#document)

It's often useful to observe the entire document's size, rather than a specific element. To do this, you can add the `.document` modifier to `x-resize`:

    <div x-resize.document="...">
    <div x-resize.document="...">

_Resize your browser window to see the document width and height values change._  
  

[← Intersect](/plugins/intersect)

[Persist →](/plugins/persist)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Root

$root
=====

`$root` is a magic property that can be used to retrieve the root element of any Alpine component. In other words the closest element up the DOM tree that contains `x-data`.

    <div x-data data-message="Hello World!">    <button @click="alert($root.dataset.message)">Say Hi</button></div>
    <div x-data data-message="Hello World!">
        <button @click="alert($root.dataset.message)">Say Hi</button>
    </div>

Say Hi

[← $nextTick](/magics/nextTick)

[$data →](/magics/data)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Show

x-show
======

`x-show` is one of the most useful and powerful directives in Alpine. It provides an expressive way to show and hide DOM elements.

Here's an example of a simple dropdown component using `x-show`.

    <div x-data="{ open: false }">    <button x-on:click="open = ! open">Toggle Dropdown</button>     <div x-show="open">        Dropdown Contents...    </div></div>
    <div x-data="{ open: false }">
        <button x-on:click="open = ! open">Toggle Dropdown</button>
    
        <div x-show="open">
            Dropdown Contents...
        </div>
    </div>

When the "Toggle Dropdown" button is clicked, the dropdown will show and hide accordingly.

> If the "default" state of an `x-show` on page load is "false", you may want to use `x-cloak` on the page to avoid "page flicker" (The effect that happens when the browser renders your content before Alpine is finished initializing and hiding it.) You can learn more about `x-cloak` in its documentation.

[With transitions](#with-transitions)
-------------------------------------

If you want to apply smooth transitions to the `x-show` behavior, you can use it in conjunction with `x-transition`. You can learn more about that directive [here](/directives/transition), but here's a quick example of the same component as above, just with transitions applied.

    <div x-data="{ open: false }">    <button x-on:click="open = ! open">Toggle Dropdown</button>     <div x-show="open" x-transition>        Dropdown Contents...    </div></div>
    <div x-data="{ open: false }">
        <button x-on:click="open = ! open">Toggle Dropdown</button>
    
        <div x-show="open" x-transition>
            Dropdown Contents...
        </div>
    </div>

[Using the important modifier](#using-the-important-modifier)
-------------------------------------------------------------

Sometimes you need to apply a little more force to actually hide an element. In cases where a CSS selector applies the `display` property with the `!important` flag, it will take precedence over the inline style set by Alpine.

In these cases you may use the `.important` modifier to set the inline style to `display: none !important`.

    <div x-data="{ open: false }">    <button x-on:click="open = ! open">Toggle Dropdown</button>     <div x-show.important="open">        Dropdown Contents...    </div></div>
    <div x-data="{ open: false }">
        <button x-on:click="open = ! open">Toggle Dropdown</button>
    
        <div x-show.important="open">
            Dropdown Contents...
        </div>
    </div>

[← x-init](/directives/init)

[x-bind →](/directives/bind)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Sort

Sort Plugin
===========

Alpine's Sort plugin allows you to easily re-order elements by dragging them with your mouse.

This functionality is useful for things like Kanban boards, to-do lists, sortable table columns, etc.

The drag functionality used in this plugin is provided by the [SortableJS](https://github.com/SortableJS/Sortable) project.

[Installation](#installation)
-----------------------------

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### Via CDN

You can include the CDN build of this plugin as a `<script>` tag; just make sure to include it BEFORE Alpine's core JS file.

    <!-- Alpine Plugins --><script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> <!-- Alpine Core --><script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

### Via NPM

You can install Sort from NPM for use inside your bundle like so:

    npm install @alpinejs/sort
    npm install @alpinejs/sort

Then initialize it from your bundle:

    import Alpine from 'alpinejs'import sort from '@alpinejs/sort' Alpine.plugin(sort) ...
    import Alpine from 'alpinejs'
    import sort from '@alpinejs/sort'
    
    Alpine.plugin(sort)
    
    ...

[Basic usage](#basic-usage)
---------------------------

The primary API for using this plugin is the `x-sort` directive. By adding `x-sort` to an element, its children containing `x-sort:item` become sortable—meaning you can drag them around with your mouse, and they will change positions.

    <ul x-sort>    <li x-sort:item>foo</li>    <li x-sort:item>bar</li>    <li x-sort:item>baz</li></ul>
    <ul x-sort>
        <li x-sort:item>foo</li>
        <li x-sort:item>bar</li>
        <li x-sort:item>baz</li>
    </ul>

*   foo
*   bar
*   baz

[Sort handlers](#sort-handlers)
-------------------------------

You can react to sorting changes by passing a handler function to `x-sort` and adding keys to each item using `x-sort:item`. Here is an example of a simple handler function that shows an alert dialog with the changed item's key and its new position:

    <ul x-sort="alert($item + ' - ' + $position)">    <li x-sort:item="1">foo</li>    <li x-sort:item="2">bar</li>    <li x-sort:item="3">baz</li></ul>
    <ul x-sort="alert($item + ' - ' + $position)">
        <li x-sort:item="1">foo</li>
        <li x-sort:item="2">bar</li>
        <li x-sort:item="3">baz</li>
    </ul>

*   foo
*   bar
*   baz

The `x-sort` handler will be called every time the sort order of the items change. The `$item` magic will contain the key of the sorted element (derived from `x-sort:item`), and `$position` will contain the new position of the item (starting at index `0`).

You can also pass a handler function to `x-sort` and that function will receive the `item` and `position` as the first and second parameter:

    <div x-data="{ handle: (item, position) => { ... } }">    <ul x-sort="handle">        <li x-sort:item="1">foo</li>        <li x-sort:item="2">bar</li>        <li x-sort:item="3">baz</li>    </ul></div>
    <div x-data="{ handle: (item, position) => { ... } }">
        <ul x-sort="handle">
            <li x-sort:item="1">foo</li>
            <li x-sort:item="2">bar</li>
            <li x-sort:item="3">baz</li>
        </ul>
    </div>

Handler functions are often used to persist the new order of items in the database so that the sorting order of a list is preserved between page refreshes.

[Sorting groups](#sorting-groups)
---------------------------------

This plugin allows you to drag items from one `x-sort` sortable list into another one by adding a matching `x-sort:group` value to both lists:

    <div>    <ul x-sort x-sort:group="todos">        <li x-sort:item="1">foo</li>        <li x-sort:item="2">bar</li>        <li x-sort:item="3">baz</li>    </ul>     <ol x-sort x-sort:group="todos">        <li x-sort:item="4">foo</li>        <li x-sort:item="5">bar</li>        <li x-sort:item="6">baz</li>    </ol></div>
    <div>
        <ul x-sort x-sort:group="todos">
            <li x-sort:item="1">foo</li>
            <li x-sort:item="2">bar</li>
            <li x-sort:item="3">baz</li>
        </ul>
    
        <ol x-sort x-sort:group="todos">
            <li x-sort:item="4">foo</li>
            <li x-sort:item="5">bar</li>
            <li x-sort:item="6">baz</li>
        </ol>
    </div>

Because both sortable lists above use the same group name (`todos`), you can drag items from one list onto another.

> When using sort handlers like `x-sort="handle"` and dragging an item from one group to another, only the destination list's handler will be called with the key and new position.

[Drag handles](#drag-handles)
-----------------------------

By default, each `x-sort:item` element is draggable by clicking and dragging anywhere within it. However, you may want to designate a smaller, more specific element as the "drag handle" so that the rest of the element can be interacted with like normal, and only the handle will respond to mouse dragging:

    <ul x-sort>    <li x-sort:item>        <span x-sort:handle> - </span>foo    </li>     <li x-sort:item>        <span x-sort:handle> - </span>bar    </li>     <li x-sort:item>        <span x-sort:handle> - </span>baz    </li></ul>
    <ul x-sort>
        <li x-sort:item>
            <span x-sort:handle> - </span>foo
        </li>
    
        <li x-sort:item>
            <span x-sort:handle> - </span>bar
        </li>
    
        <li x-sort:item>
            <span x-sort:handle> - </span>baz
        </li>
    </ul>

*   \- foo
*   \- bar
*   \- baz

As you can see in the above example, the hyphen "-" is draggable, but the item text ("foo") is not.

[Ghost elements](#ghost-elements)
---------------------------------

When a user drags an item, the element will follow their mouse to appear as though they are physically dragging the element.

By default, a "hole" (empty space) will be left in the original element's place during the drag.

If you would like to show a "ghost" of the original element in its place instead of an empty space, you can add the `.ghost` modifier to `x-sort`:

    <ul x-sort.ghost>    <li x-sort:item>foo</li>    <li x-sort:item>bar</li>    <li x-sort:item>baz</li></ul>
    <ul x-sort.ghost>
        <li x-sort:item>foo</li>
        <li x-sort:item>bar</li>
        <li x-sort:item>baz</li>
    </ul>

*   foo
*   bar
*   baz

### [Styling the ghost element](#ghost-styling)

By default, the "ghost" element has a `.sortable-ghost` CSS class attached to it while the original element is being dragged.

This makes it easy to add any custom styling you would like:

    <style>.sortable-ghost {    opacity: .5 !important;}</style> <ul x-sort.ghost>    <li x-sort:item>foo</li>    <li x-sort:item>bar</li>    <li x-sort:item>baz</li></ul>
    <style>
    .sortable-ghost {
        opacity: .5 !important;
    }
    </style>
    
    <ul x-sort.ghost>
        <li x-sort:item>foo</li>
        <li x-sort:item>bar</li>
        <li x-sort:item>baz</li>
    </ul>

*   foo
*   bar
*   baz

[Sorting class on body](#sorting-class)
---------------------------------------

While an element is being dragged around, Alpine will automatically add a `.sorting` class to the `<body>` element of the page.

This is useful for styling any element on the page conditionally using only CSS.

For example you could have a warning that only displays while a user is sorting items:

    <div id="sort-warning">    Page functionality is limited while sorting</div>
    <div id="sort-warning">
        Page functionality is limited while sorting
    </div>

To show this only while sorting, you can use the `body.sorting` CSS selector:

    #sort-warning {    display: none;} body.sorting #sort-warning {    display: block;}
    #sort-warning {
        display: none;
    }
    
    body.sorting #sort-warning {
        display: block;
    }

[CSS hover bug](#css-hover-bug)
-------------------------------

Currently, there is a [bug in Chrome and Safari](https://issues.chromium.org/issues/41129937) (not Firefox) that causes issues with hover styles.

Consider HTML like the following, where each item in the list is styled differently based on a hover state (here we're using Tailwind's `.hover` class to conditionally add a border):

    <div x-sort>    <div x-sort:item class="hover:border">foo</div>    <div x-sort:item class="hover:border">bar</div>    <div x-sort:item class="hover:border">baz</div></div>
    <div x-sort>
        <div x-sort:item class="hover:border">foo</div>
        <div x-sort:item class="hover:border">bar</div>
        <div x-sort:item class="hover:border">baz</div>
    </div>

If you drag one of the elements in the list below you will see that the hover effect will be errantly applied to any element in the original element's place:

*   foo
*   bar
*   baz

To fix this, you can leverage the `.sorting` class applied to the body while sorting to limit the hover effect to only be applied while `.sorting` does NOT exist on `body`.

Here is how you can do this directly inline using Tailwind arbitrary variants:

    <div x-sort>    <div x-sort:item class="[body:not(.sorting)_&]:hover:border">foo</div>    <div x-sort:item class="[body:not(.sorting)_&]:hover:border">bar</div>    <div x-sort:item class="[body:not(.sorting)_&]:hover:border">baz</div></div>
    <div x-sort>
        <div x-sort:item class="[body:not(.sorting)_&]:hover:border">foo</div>
        <div x-sort:item class="[body:not(.sorting)_&]:hover:border">bar</div>
        <div x-sort:item class="[body:not(.sorting)_&]:hover:border">baz</div>
    </div>

Now you can see below that the hover effect is only applied to the dragging element and not the others in the list.

*   foo
*   bar
*   baz

[Custom configuration](#custom-configuration)
---------------------------------------------

Alpine chooses sensible defaults for configuring [SortableJS](https://github.com/SortableJS/Sortable?tab=readme-ov-file#options) under the hood. However, you can add or override any of these options yourself using `x-sort:config`:

    <ul x-sort x-sort:config="{ animation: 0 }">    <li x-sort:item>foo</li>    <li x-sort:item>bar</li>    <li x-sort:item>baz</li></ul>
    <ul x-sort x-sort:config="{ animation: 0 }">
        <li x-sort:item>foo</li>
        <li x-sort:item>bar</li>
        <li x-sort:item>baz</li>
    </ul>

*   foo
*   bar
*   baz

> Any config options passed will overwrite Alpine defaults. In this case of `animation`, this is fine, however be aware that overwriting `handle`, `group`, `filter`, `onSort`, `onStart`, or `onEnd` may break functionality.

[View the full list of SortableJS configuration options here →](https://github.com/SortableJS/Sortable?tab=readme-ov-file#options)

[← Morph](/plugins/morph)

[CSP →](/advanced/csp)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Start Here

Start Here
==========

Create a blank HTML file somewhere on your computer with a name like: `i-love-alpine.html`

Using a text editor, fill the file with these contents:

    <html><head>    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script></head><body>    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1></body></html>
    <html>
    <head>
        <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>
    </head>
    <body>
        <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
    </body>
    </html>

Open your file in a web browser, if you see `I ❤️ Alpine`, you're ready to rumble!

Now that you're all set up to play around, let's look at three practical examples as a foundation for teaching you the basics of Alpine. By the end of this exercise, you should be more than equipped to start building stuff on your own. Let's goooooo.

*   [Building a counter](#building-a-counter)
*   [Building a dropdown](#building-a-dropdown)
*   [Building a search Input](#building-a-search-input)

[Building a counter](#building-a-counter)
-----------------------------------------

Let's start with a simple "counter" component to demonstrate the basics of state and event listening in Alpine, two core features.

Insert the following into the `<body>` tag:

    <div x-data="{ count: 0 }">    <button x-on:click="count++">Increment</button>     <span x-text="count"></span></div>
    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
    
        <span x-text="count"></span>
    </div>

Increment

Now, you can see with 3 bits of Alpine sprinkled into this HTML, we've created an interactive "counter" component.

Let's walk through what's happening briefly:

### [Declaring data](#declaring-data)

    <div x-data="{ count: 0 }">
    <div x-data="{ count: 0 }">

Everything in Alpine starts with an `x-data` directive. Inside of `x-data`, in plain JavaScript, you declare an object of data that Alpine will track.

Every property inside this object will be made available to other directives inside this HTML element. In addition, when one of these properties changes, everything that relies on it will change as well.

> `x-data` is required on a parent element for most Alpine directives to work.

[→ Read more about `x-data`](/directives/data)

Let's look at `x-on` and see how it can access and modify the `count` property from above:

### [Listening for events](#listening-for-events)

    <button x-on:click="count++">Increment</button>
    <button x-on:click="count++">Increment</button>

`x-on` is a directive you can use to listen for any event on an element. We're listening for a `click` event in this case, so ours looks like `x-on:click`.

You can listen for other events as you'd imagine. For example, listening for a `mouseenter` event would look like this: `x-on:mouseenter`.

When a `click` event happens, Alpine will call the associated JavaScript expression, `count++` in our case. As you can see, we have direct access to data declared in the `x-data` expression.

> You will often see `@` instead of `x-on:`. This is a shorter, friendlier syntax that many prefer. From now on, this documentation will likely use `@` instead of `x-on:`.

[→ Read more about `x-on`](/directives/on)

### [Reacting to changes](#reacting-to-changes)

    <span x-text="count"></span>
    <span x-text="count"></span>

`x-text` is an Alpine directive you can use to set the text content of an element to the result of a JavaScript expression.

In this case, we're telling Alpine to always make sure that the contents of this `span` tag reflect the value of the `count` property.

In case it's not clear, `x-text`, like most directives accepts a plain JavaScript expression as an argument. So for example, you could instead set its contents to: `x-text="count * 2"` and the text content of the `span` will now always be 2 times the value of `count`.

[→ Read more about `x-text`](/directives/text)

[Building a dropdown](#building-a-dropdown)
-------------------------------------------

Now that we've seen some basic functionality, let's keep going and look at an important directive in Alpine: `x-show`, by building a contrived "dropdown" component.

Insert the following code into the `<body>` tag:

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle</button>     <div x-show="open" @click.outside="open = false">Contents...</div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
    
        <div x-show="open" @click.outside="open = false">Contents...</div>
    </div>

Toggle

Contents...

If you load this component, you should see that the "Contents..." are hidden by default. You can toggle showing them on the page by clicking the "Toggle" button.

The `x-data` and `x-on` directives should be familiar to you from the previous example, so we'll skip those explanations.

### [Toggling elements](#toggling-elements)

    <div x-show="open" ...>Contents...</div>
    <div x-show="open" ...>Contents...</div>

`x-show` is an extremely powerful directive in Alpine that can be used to show and hide a block of HTML on a page based on the result of a JavaScript expression, in our case: `open`.

[→ Read more about `x-show`](/directives/show)

### [Listening for a click outside](#listening-for-a-click-outside)

    <div ... @click.outside="open = false">Contents...</div>
    <div ... @click.outside="open = false">Contents...</div>

You'll notice something new in this example: `.outside`. Many directives in Alpine accept "modifiers" that are chained onto the end of the directive and are separated by periods.

In this case, `.outside` tells Alpine to instead of listening for a click INSIDE the `<div>`, to listen for the click only if it happens OUTSIDE the `<div>`.

This is a convenience helper built into Alpine because this is a common need and implementing it by hand is annoying and complex.

[→ Read more about `x-on` modifiers](/directives/on#modifiers)

[Building a search input](#building-a-search-input)
---------------------------------------------------

Let's now build a more complex component and introduce a handful of other directives and patterns.

Insert the following code into the `<body>` tag:

    <div    x-data="{        search: '',         items: ['foo', 'bar', 'baz'],         get filteredItems() {            return this.items.filter(                i => i.startsWith(this.search)            )        }    }">    <input x-model="search" placeholder="Search...">     <ul>        <template x-for="item in filteredItems" :key="item">            <li x-text="item"></li>        </template>    </ul></div>
    <div
        x-data="{
            search: '',
    
            items: ['foo', 'bar', 'baz'],
    
            get filteredItems() {
                return this.items.filter(
                    i => i.startsWith(this.search)
                )
            }
        }"
    >
        <input x-model="search" placeholder="Search...">
    
        <ul>
            <template x-for="item in filteredItems" :key="item">
                <li x-text="item"></li>
            </template>
        </ul>
    </div>

By default, all of the "items" (foo, bar, and baz) will be shown on the page, but you can filter them by typing into the text input. As you type, the list of items will change to reflect what you're searching for.

Now there's quite a bit happening here, so let's go through this snippet piece by piece.

### [Multi line formatting](#multi-line-formatting)

The first thing I'd like to point out is that `x-data` now has a lot more going on in it than before. To make it easier to write and read, we've split it up into multiple lines in our HTML. This is completely optional and we'll talk more in a bit about how to avoid this problem altogether, but for now, we'll keep all of this JavaScript directly in the HTML.

### [Binding to inputs](#binding-to-inputs)

    <input x-model="search" placeholder="Search...">
    <input x-model="search" placeholder="Search...">

You'll notice a new directive we haven't seen yet: `x-model`.

`x-model` is used to "bind" the value of an input element with a data property: "search" from `x-data="{ search: '', ... }"` in our case.

This means that anytime the value of the input changes, the value of "search" will change to reflect that.

`x-model` is capable of much more than this simple example.

[→ Read more about `x-model`](/directives/model)

### [Computed properties using getters](#computed-properties-using-getters)

The next bit I'd like to draw your attention to is the `items` and `filteredItems` properties from the `x-data` directive.

    {    ...    items: ['foo', 'bar', 'baz'],     get filteredItems() {        return this.items.filter(            i => i.startsWith(this.search)        )    }}
    {
        ...
        items: ['foo', 'bar', 'baz'],
    
        get filteredItems() {
            return this.items.filter(
                i => i.startsWith(this.search)
            )
        }
    }

The `items` property should be self-explanatory. Here we are setting the value of `items` to a JavaScript array of 3 different items (foo, bar, and baz).

The interesting part of this snippet is the `filteredItems` property.

Denoted by the `get` prefix for this property, `filteredItems` is a "getter" property in this object. This means we can access `filteredItems` as if it was a normal property in our data object, but when we do, JavaScript will evaluate the provided function under the hood and return the result.

It's completely acceptable to forgo the `get` and just make this a method that you can call from the template, but some prefer the nicer syntax of the getter.

[→ Read more about JavaScript getters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get)

Now let's look inside the `filteredItems` getter and make sure we understand what's going on there:

    return this.items.filter(    i => i.startsWith(this.search))
    return this.items.filter(
        i => i.startsWith(this.search)
    )

This is all plain JavaScript. We are first getting the array of items (foo, bar, and baz) and filtering them using the provided callback: `i => i.startsWith(this.search)`.

By passing in this callback to `filter`, we are telling JavaScript to only return the items that start with the string: `this.search`, which like we saw with `x-model` will always reflect the value of the input.

You may notice that up until now, we haven't had to use `this.` to reference properties. However, because we are working directly inside the `x-data` object, we must reference any properties using `this.[property]` instead of simply `[property]`.

Because Alpine is a "reactive" framework. Any time the value of `this.search` changes, parts of the template that use `filteredItems` will automatically be updated.

### [Looping elements](#looping-elements)

Now that we understand the data part of our component, let's understand what's happening in the template that allows us to loop through `filteredItems` on the page.

    <ul>    <template x-for="item in filteredItems">        <li x-text="item"></li>    </template></ul>
    <ul>
        <template x-for="item in filteredItems">
            <li x-text="item"></li>
        </template>
    </ul>

The first thing to notice here is the `x-for` directive. `x-for` expressions take the following form: `[item] in [items]` where \[items\] is any array of data, and \[item\] is the name of the variable that will be assigned to an iteration inside the loop.

Also notice that `x-for` is declared on a `<template>` element and not directly on the `<li>`. This is a requirement of using `x-for`. It allows Alpine to leverage the existing behavior of `<template>` tags in the browser to its advantage.

Now any element inside the `<template>` tag will be repeated for every item inside `filteredItems` and all expressions evaluated inside the loop will have direct access to the iteration variable (`item` in this case).

[→ Read more about `x-for`](/directives/for)

[Recap](#recap)
---------------

If you've made it this far, you've been exposed to the following directives in Alpine:

*   x-data
*   x-on
*   x-text
*   x-show
*   x-model
*   x-for

That's a great start, however, there are many more directives to sink your teeth into. The best way to absorb Alpine is to read through this documentation. No need to comb over every word, but if you at least glance through every page you will be MUCH more effective when using Alpine.

Happy Coding!

[Upgrade From V2 →](/upgrade-guide)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## State

State
=====

State (JavaScript data that Alpine watches for changes) is at the core of everything you do in Alpine. You can provide local data to a chunk of HTML, or make it globally available for use anywhere on a page using `x-data` or `Alpine.store()` respectively.

[Local state](#local-state-x-data)
----------------------------------

Alpine allows you to declare an HTML block's state in a single `x-data` attribute without ever leaving your markup.

Here's a basic example:

    <div x-data="{ open: false }">    ...</div>
    <div x-data="{ open: false }">
        ...
    </div>

Now any other Alpine syntax on or within this element will be able to access `open`. And like you'd guess, when `open` changes for any reason, everything that depends on it will react automatically.

[→ Read more about `x-data`](/directives/data)

### [Nesting data](#nesting-data)

Data is nestable in Alpine. For example, if you have two elements with Alpine data attached (one inside the other), you can access the parent's data from inside the child element.

    <div x-data="{ open: false }">    <div x-data="{ label: 'Content:' }">        <span x-text="label"></span>        <span x-show="open"></span>    </div></div>
    <div x-data="{ open: false }">
        <div x-data="{ label: 'Content:' }">
            <span x-text="label"></span>
            <span x-show="open"></span>
        </div>
    </div>

This is similar to scoping in JavaScript itself (code within a function can access variables declared outside that function.)

Like you may have guessed, if the child has a data property matching the name of a parent's property, the child property will take precedence.

### [Single-element data](#single-element-data)

Although this may seem obvious to some, it's worth mentioning that Alpine data can be used within the same element. For example:

    <button x-data="{ label: 'Click Here' }" x-text="label"></button>
    <button x-data="{ label: 'Click Here' }" x-text="label"></button>

### [Data-less Alpine](#data-less-alpine)

Sometimes you may want to use Alpine functionality, but don't need any reactive data. In these cases, you can opt out of passing an expression to `x-data` entirely. For example:

    <button x-data @click="alert('I\'ve been clicked!')">Click Me</button>
    <button x-data @click="alert('I\'ve been clicked!')">Click Me</button>

### [Re-usable data](#re-usable-data)

When using Alpine, you may find the need to re-use a chunk of data and/or its corresponding template.

If you are using a backend framework like Rails or Laravel, Alpine first recommends that you extract the entire block of HTML into a template partial or include.

If for some reason that isn't ideal for you or you're not in a back-end templating environment, Alpine allows you to globally register and re-use the data portion of a component using `Alpine.data(...)`.

    Alpine.data('dropdown', () => ({    open: false,     toggle() {        this.open = ! this.open    }}))
    Alpine.data('dropdown', () => ({
        open: false,
    
        toggle() {
            this.open = ! this.open
        }
    }))

Now that you've registered the "dropdown" data, you can use it inside your markup in as many places as you like:

    <div x-data="dropdown">    <button @click="toggle">Expand</button>     <span x-show="open">Content...</span></div> <div x-data="dropdown">    <button @click="toggle">Expand</button>     <span x-show="open">Some Other Content...</span></div>
    <div x-data="dropdown">
        <button @click="toggle">Expand</button>
    
        <span x-show="open">Content...</span>
    </div>
    
    <div x-data="dropdown">
        <button @click="toggle">Expand</button>
    
        <span x-show="open">Some Other Content...</span>
    </div>

[→ Read more about using `Alpine.data()`](/globals/alpine-data)

[Global state](#global-state)
-----------------------------

If you wish to make some data available to every component on the page, you can do so using Alpine's "global store" feature.

You can register a store using `Alpine.store(...)`, and reference one with the magic `$store()` method.

Let's look at a simple example. First we'll register the store globally:

    Alpine.store('tabs', {    current: 'first',     items: ['first', 'second', 'third'],})
    Alpine.store('tabs', {
        current: 'first',
    
        items: ['first', 'second', 'third'],
    })

Now we can access or modify its data from anywhere on our page:

    <div x-data>    <template x-for="tab in $store.tabs.items">        ...    </template></div> <div x-data>    <button @click="$store.tabs.current = 'first'">First Tab</button>    <button @click="$store.tabs.current = 'second'">Second Tab</button>    <button @click="$store.tabs.current = 'third'">Third Tab</button></div>
    <div x-data>
        <template x-for="tab in $store.tabs.items">
            ...
        </template>
    </div>
    
    <div x-data>
        <button @click="$store.tabs.current = 'first'">First Tab</button>
        <button @click="$store.tabs.current = 'second'">Second Tab</button>
        <button @click="$store.tabs.current = 'third'">Third Tab</button>
    </div>

[→ Read more about `Alpine.store()`](/globals/alpine-store)

[← Installation](/essentials/installation)

[Templating →](/essentials/templating)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Store

$store
======

You can use `$store` to conveniently access global Alpine stores registered using [`Alpine.store(...)`](/globals/alpine-store). For example:

    <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button> ... <div x-data :class="$store.darkMode.on && 'bg-black'">    ...</div>  <script>    document.addEventListener('alpine:init', () => {        Alpine.store('darkMode', {            on: false,             toggle() {                this.on = ! this.on            }        })    })</script>
    <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>
    
    ...
    
    <div x-data :class="$store.darkMode.on && 'bg-black'">
        ...
    </div>
    
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                on: false,
    
                toggle() {
                    this.on = ! this.on
                }
            })
        })
    </script>

Given that we've registered the `darkMode` store and set `on` to "false", when the `<button>` is pressed, `on` will be "true" and the background color of the page will change to black.

[Single-value stores](#single-value-stores)
-------------------------------------------

If you don't need an entire object for a store, you can set and use any kind of data as a store.

Here's the example from above but using it more simply as a boolean value:

    <button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button> ... <div x-data :class="$store.darkMode && 'bg-black'">    ...</div>  <script>    document.addEventListener('alpine:init', () => {        Alpine.store('darkMode', false)    })</script>
    <button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button>
    
    ...
    
    <div x-data :class="$store.darkMode && 'bg-black'">
        ...
    </div>
    
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', false)
        })
    </script>

[→ Read more about Alpine stores](/globals/alpine-store)

[← $refs](/magics/refs)

[$watch →](/magics/watch)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Teleport

x-teleport
==========

The `x-teleport` directive allows you to transport part of your Alpine template to another part of the DOM on the page entirely.

This is useful for things like modals (especially nesting them), where it's helpful to break out of the z-index of the current Alpine component.

[x-teleport](#x-teleport)
-------------------------

By attaching `x-teleport` to a `<template>` element, you are telling Alpine to "append" that element to the provided selector.

> The `x-teleport` selector can be any string you would normally pass into something like `document.querySelector`. It will find the first element that matches, be it a tag name (`body`), class name (`.my-class`), ID (`#my-id`), or any other valid CSS selector.

[→ Read more about `document.querySelector`](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector)

Here's a contrived modal example:

    <body>    <div x-data="{ open: false }">        <button @click="open = ! open">Toggle Modal</button>         <template x-teleport="body">            <div x-show="open">                Modal contents...            </div>        </template>    </div>     <div>Some other content placed AFTER the modal markup.</div>     ... </body>
    <body>
        <div x-data="{ open: false }">
            <button @click="open = ! open">Toggle Modal</button>
    
            <template x-teleport="body">
                <div x-show="open">
                    Modal contents...
                </div>
            </template>
        </div>
    
        <div>Some other content placed AFTER the modal markup.</div>
    
        ...
    
    </body>

Toggle Modal

Some other content placed AFTER the modal markup.

Notice how when toggling the modal, the actual modal contents show up AFTER the "Some other content..." element? This is because when Alpine is initializing, it sees `x-teleport="body"` and appends and initializes that element to the provided element selector.

[Forwarding events](#forwarding-events)
---------------------------------------

Alpine tries its best to make the experience of teleporting seamless. Anything you would normally do in a template, you should be able to do inside an `x-teleport` template. Teleported content can access the normal Alpine scope of the component as well as other features like `$refs`, `$root`, etc...

However, native DOM events have no concept of teleportation, so if, for example, you trigger a "click" event from inside a teleported element, that event will bubble up the DOM tree as it normally would.

To make this experience more seamless, you can "forward" events by simply registering event listeners on the `<template x-teleport...>` element itself like so:

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle Modal</button>     <template x-teleport="body" @click="open = false">        <div x-show="open">            Modal contents...            (click to close)        </div>    </template></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>
    
        <template x-teleport="body" @click="open = false">
            <div x-show="open">
                Modal contents...
                (click to close)
            </div>
        </template>
    </div>

Toggle Modal

Notice how we are now able to listen for events dispatched from within the teleported element from outside the `<template>` element itself?

Alpine does this by looking for event listeners registered on `<template x-teleport...>` and stops those events from propagating past the live, teleported, DOM element. Then, it creates a copy of that event and re-dispatches it from `<template x-teleport...>`.

[Nesting](#nesting)
-------------------

Teleporting is especially helpful if you are trying to nest one modal within another. Alpine makes it simple to do so:

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle Modal</button>     <template x-teleport="body">        <div x-show="open">            Modal contents...             <div x-data="{ open: false }">                <button @click="open = ! open">Toggle Nested Modal</button>                 <template x-teleport="body">                    <div x-show="open">                        Nested modal contents...                    </div>                </template>            </div>        </div>    </template></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>
    
        <template x-teleport="body">
            <div x-show="open">
                Modal contents...
    
                <div x-data="{ open: false }">
                    <button @click="open = ! open">Toggle Nested Modal</button>
    
                    <template x-teleport="body">
                        <div x-show="open">
                            Nested modal contents...
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

Toggle Modal

After toggling "on" both modals, they are authored as children, but will be rendered as sibling elements on the page, not within one another.

[← x-cloak](/directives/cloak)

[x-if →](/directives/if)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Templating

Templating
==========

Alpine offers a handful of useful directives for manipulating the DOM on a web page.

Let's cover a few of the basic templating directives here, but be sure to look through the available directives in the sidebar for an exhaustive list.

[Text content](#text-content)
-----------------------------

Alpine makes it easy to control the text content of an element with the `x-text` directive.

    <div x-data="{ title: 'Start Here' }">    <h1 x-text="title"></h1></div>
    <div x-data="{ title: 'Start Here' }">
        <h1 x-text="title"></h1>
    </div>

Now, Alpine will set the text content of the `<h1>` with the value of `title` ("Start Here"). When `title` changes, so will the contents of `<h1>`.

Like all directives in Alpine, you can use any JavaScript expression you like. For example:

    <span x-text="1 + 2"></span>
    <span x-text="1 + 2"></span>

The `<span>` will now contain the sum of "1" and "2".

[→ Read more about `x-text`](/directives/text)

[Toggling elements](#toggling-elements)
---------------------------------------

Toggling elements is a common need in web pages and applications. Dropdowns, modals, dialogues, "show-more"s, etc... are all good examples.

Alpine offers the `x-show` and `x-if` directives for toggling elements on a page.

### [`x-show`](#x-show)

Here's a simple toggle component using `x-show`.

    <div x-data="{ open: false }">    <button @click="open = ! open">Expand</button>     <div x-show="open">        Content...    </div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Expand</button>
    
        <div x-show="open">
            Content...
        </div>
    </div>

Expand

Content...

Now the entire `<div>` containing the contents will be shown and hidden based on the value of `open`.

Under the hood, Alpine adds the CSS property `display: none;` to the element when it should be hidden.

[→ Read more about `x-show`](/directives/show)

This works well for most cases, but sometimes you may want to completely add and remove the element from the DOM entirely. This is what `x-if` is for.

### [`x-if`](#x-if)

Here is the same toggle from before, but this time using `x-if` instead of `x-show`.

    <div x-data="{ open: false }">    <button @click="open = ! open">Expand</button>     <template x-if="open">        <div>            Content...        </div>    </template></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Expand</button>
    
        <template x-if="open">
            <div>
                Content...
            </div>
        </template>
    </div>

Expand

Notice that `x-if` must be declared on a `<template>` tag. This is so that Alpine can leverage the existing browser behavior of the `<template>` element and use it as the source of the target `<div>` to be added and removed from the page.

When `open` is true, Alpine will append the `<div>` to the `<template>` tag, and remove it when `open` is false.

[→ Read more about `x-if`](/directives/if)

[Toggling with transitions](#toggling-with-transitions)
-------------------------------------------------------

Alpine makes it simple to smoothly transition between "shown" and "hidden" states using the `x-transition` directive.

> `x-transition` only works with `x-show`, not with `x-if`.

Here is, again, the simple toggle example, but this time with transitions applied:

    <div x-data="{ open: false }">    <button @click="open = ! open">Expands</button>     <div x-show="open" x-transition>        Content...    </div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Expands</button>
    
        <div x-show="open" x-transition>
            Content...
        </div>
    </div>

Expands

Content...

Let's zoom in on the portion of the template dealing with transitions:

    <div x-show="open" x-transition>
    <div x-show="open" x-transition>

`x-transition` by itself will apply sensible default transitions (fade and scale) to the toggle.

There are two ways to customize these transitions:

*   Transition helpers
*   Transition CSS classes.

Let's take a look at each of these approaches:

### [Transition helpers](#transition-helpers)

Let's say you wanted to make the duration of the transition longer, you can manually specify that using the `.duration` modifier like so:

    <div x-show="open" x-transition.duration.500ms>
    <div x-show="open" x-transition.duration.500ms>

Expands

Content...

Now the transition will last 500 milliseconds.

If you want to specify different values for in and out transitions, you can use `x-transition:enter` and `x-transition:leave`:

    <div    x-show="open"    x-transition:enter.duration.500ms    x-transition:leave.duration.1000ms>
    <div
        x-show="open"
        x-transition:enter.duration.500ms
        x-transition:leave.duration.1000ms
    >

Expands

Content...

Additionally, you can add either `.opacity` or `.scale` to only transition that property. For example:

    <div x-show="open" x-transition.opacity>
    <div x-show="open" x-transition.opacity>

Expands

Content...

[→ Read more about transition helpers](/directives/transition#the-transition-helper)

### [Transition classes](#transition-classes)

If you need more fine-grained control over the transitions in your application, you can apply specific CSS classes at specific phases of the transition using the following syntax (this example uses [Tailwind CSS](https://tailwindcss.com/)):

    <div    x-show="open"    x-transition:enter="transition ease-out duration-300"    x-transition:enter-start="opacity-0 transform scale-90"    x-transition:enter-end="opacity-100 transform scale-100"    x-transition:leave="transition ease-in duration-300"    x-transition:leave-start="opacity-100 transform scale-100"    x-transition:leave-end="opacity-0 transform scale-90">...</div>
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
    >...</div>

Expands

Content...

[→ Read more about transition classes](/directives/transition#applying-css-classes)

[Binding attributes](#binding-attributes)
-----------------------------------------

You can add HTML attributes like `class`, `style`, `disabled`, etc... to elements in Alpine using the `x-bind` directive.

Here is an example of a dynamically bound `class` attribute:

    <button    x-data="{ red: false }"    x-bind:class="red ? 'bg-red' : ''"    @click="red = ! red">    Toggle Red</button>
    <button
        x-data="{ red: false }"
        x-bind:class="red ? 'bg-red' : ''"
        @click="red = ! red"
    >
        Toggle Red
    </button>

Toggle Red

As a shortcut, you can leave out the `x-bind` and use the shorthand `:` syntax directly:

    <button ... :class="red ? 'bg-red' : ''">
    <button ... :class="red ? 'bg-red' : ''">

Toggling classes on and off based on data inside Alpine is a common need. Here's an example of toggling a class using Alpine's `class` binding object syntax: (Note: this syntax is only available for `class` attributes)

    <div x-data="{ open: true }">    <span :class="{ 'hidden': ! open }">...</span></div>
    <div x-data="{ open: true }">
        <span :class="{ 'hidden': ! open }">...</span>
    </div>

Now the `hidden` class will be added to the element if `open` is false, and removed if `open` is true.

[Looping elements](#looping-elements)
-------------------------------------

Alpine allows for iterating parts of your template based on JavaScript data using the `x-for` directive. Here is a simple example:

    <div x-data="{ statuses: ['open', 'closed', 'archived'] }">    <template x-for="status in statuses">        <div x-text="status"></div>    </template></div>
    <div x-data="{ statuses: ['open', 'closed', 'archived'] }">
        <template x-for="status in statuses">
            <div x-text="status"></div>
        </template>
    </div>

Similar to `x-if`, `x-for` must be applied to a `<template>` tag. Internally, Alpine will append the contents of `<template>` tag for every iteration in the loop.

As you can see the new `status` variable is available in the scope of the iterated templates.

[→ Read more about `x-for`](/directives/for)

[Inner HTML](#inner-html)
-------------------------

Alpine makes it easy to control the HTML content of an element with the `x-html` directive.

    <div x-data="{ title: '<h1>Start Here</h1>' }">    <div x-html="title"></div></div>
    <div x-data="{ title: '<h1>Start Here</h1>' }">
        <div x-html="title"></div>
    </div>

Now, Alpine will set the text content of the `<div>` with the element `<h1>Start Here</h1>`. When `title` changes, so will the contents of `<h1>`.

> ⚠️ Only use on trusted content and never on user-provided content. ⚠️ Dynamically rendering HTML from third parties can easily lead to XSS vulnerabilities.

[→ Read more about `x-html`](/directives/html)

[← State](/essentials/state)

[Events →](/essentials/events)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Text

x-text
======

`x-text` sets the text content of an element to the result of a given expression.

Here's a basic example of using `x-text` to display a user's username.

    <div x-data="{ username: 'calebporzio' }">    Username: <strong x-text="username"></strong></div>
    <div x-data="{ username: 'calebporzio' }">
        Username: <strong x-text="username"></strong>
    </div>

Username:

Now the `<strong>` tag's inner text content will be set to "calebporzio".

[← x-on](/directives/on)

[x-html →](/directives/html)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Transition

x-transition
============

Alpine provides a robust transitions utility out of the box. With a few `x-transition` directives, you can create smooth transitions between when an element is shown or hidden.

There are two primary ways to handle transitions in Alpine:

*   [The Transition Helper](#the-transition-helper)
*   [Applying CSS Classes](#applying-css-classes)

[The transition helper](#the-transition-helper)
-----------------------------------------------

The simplest way to achieve a transition using Alpine is by adding `x-transition` to an element with `x-show` on it. For example:

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle</button>     <div x-show="open" x-transition>        Hello 👋    </div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
    
        <div x-show="open" x-transition>
            Hello 👋
        </div>
    </div>

Toggle

Hello 👋

As you can see, by default, `x-transition` applies pleasant transition defaults to fade and scale the revealing element.

You can override these defaults with modifiers attached to `x-transition`. Let's take a look at those.

### [Customizing duration](#customizing-duration)

Initially, the duration is set to be 150 milliseconds when entering, and 75 milliseconds when leaving.

You can configure the duration you want for a transition with the `.duration` modifier:

    <div ... x-transition.duration.500ms>
    <div ... x-transition.duration.500ms>

The above `<div>` will transition for 500 milliseconds when entering, and 500 milliseconds when leaving.

If you wish to customize the durations specifically for entering and leaving, you can do that like so:

    <div ...    x-transition:enter.duration.500ms    x-transition:leave.duration.400ms>
    <div ...
        x-transition:enter.duration.500ms
        x-transition:leave.duration.400ms
    >

> Despite not being included in the above snippet, `x-transition` cannot be used if no parent element has `x-data` defined. [→ Read more about `x-data`](/directives/data)

### [Customizing delay](#customizing-delay)

You can delay a transition using the `.delay` modifier like so:

    <div ... x-transition.delay.50ms>
    <div ... x-transition.delay.50ms>

The above example will delay the transition and in and out of the element by 50 milliseconds.

### [Customizing opacity](#customizing-opacity)

By default, Alpine's `x-transition` applies both a scale and opacity transition to achieve a "fade" effect.

If you wish to only apply the opacity transition (no scale), you can accomplish that like so:

    <div ... x-transition.opacity>
    <div ... x-transition.opacity>

### [Customizing scale](#customizing-scale)

Similar to the `.opacity` modifier, you can configure `x-transition` to ONLY scale (and not transition opacity as well) like so:

    <div ... x-transition.scale>
    <div ... x-transition.scale>

The `.scale` modifier also offers the ability to configure its scale values AND its origin values:

    <div ... x-transition.scale.80>
    <div ... x-transition.scale.80>

The above snippet will scale the element up and down by 80%.

Again, you may customize these values separately for enter and leaving transitions like so:

    <div ...    x-transition:enter.scale.80    x-transition:leave.scale.90>
    <div ...
        x-transition:enter.scale.80
        x-transition:leave.scale.90
    >

To customize the origin of the scale transition, you can use the `.origin` modifier:

    <div ... x-transition.scale.origin.top>
    <div ... x-transition.scale.origin.top>

Now the scale will be applied using the top of the element as the origin, instead of the center by default.

Like you may have guessed, the possible values for this customization are: `top`, `bottom`, `left`, and `right`.

If you wish, you can also combine two origin values. For example, if you want the origin of the scale to be "top right", you can use: `.origin.top.right` as the modifier.

[Applying CSS classes](#applying-css-classes)
---------------------------------------------

For direct control over exactly what goes into your transitions, you can apply CSS classes at different stages of the transition.

> The following examples use [TailwindCSS](https://tailwindcss.com/docs/transition-property) utility classes.

    <div x-data="{ open: false }">    <button @click="open = ! open">Toggle</button>     <div        x-show="open"        x-transition:enter="transition ease-out duration-300"        x-transition:enter-start="opacity-0 scale-90"        x-transition:enter-end="opacity-100 scale-100"        x-transition:leave="transition ease-in duration-300"        x-transition:leave-start="opacity-100 scale-100"        x-transition:leave-end="opacity-0 scale-90"    >Hello 👋</div></div>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
    
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
        >Hello 👋</div>
    </div>

Toggle

Hello 👋

Directive

Description

`:enter`

Applied during the entire entering phase.

`:enter-start`

Added before element is inserted, removed one frame after element is inserted.

`:enter-end`

Added one frame after element is inserted (at the same time `enter-start` is removed), removed when transition/animation finishes.

`:leave`

Applied during the entire leaving phase.

`:leave-start`

Added immediately when a leaving transition is triggered, removed after one frame.

`:leave-end`

Added one frame after a leaving transition is triggered (at the same time `leave-start` is removed), removed when the transition/animation finishes.

[← x-for](/directives/for)

[x-effect →](/directives/effect)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Upgrade Guide

Upgrade from V2
===============

Below is an exhaustive guide on the breaking changes in Alpine V3, but if you'd prefer something more lively, you can review all the changes as well as new features in V3 by watching the Alpine Day 2021 "Future of Alpine" keynote:

Upgrading from Alpine V2 to V3 should be fairly painless. In many cases, NOTHING has to be done to your codebase to use V3. Below is an exhaustive list of breaking changes and deprecations in descending order of how likely users are to be affected by them:

> Note if you use Laravel Livewire and Alpine together, to use V3 of Alpine, you will need to upgrade to Livewire v2.5.1 or greater.

[Breaking Changes](#breaking-changes)
-------------------------------------

*   [`$el` is now always the current element](#el-no-longer-root)
*   [Automatically evaluate `init()` functions defined on data object](#auto-init)
*   [Need to call `Alpine.start()` after import](#need-to-call-alpine-start)
*   [`x-show.transition` is now `x-transition`](#removed-show-dot-transition)
*   [`x-if` no longer supports `x-transition`](#x-if-no-transitions)
*   [`x-data` cascading scope](#x-data-scope)
*   [`x-init` no longer accepts a callback return](#x-init-no-callback)
*   [Returning `false` from event handlers no longer implicitly "preventDefault"s](#no-false-return-from-event-handlers)
*   [`x-spread` is now `x-bind`](#x-spread-now-x-bind)
*   [`x-ref` no longer supports binding](#x-ref-no-more-dynamic)
*   [Use global lifecycle events instead of `Alpine.deferLoadingAlpine()`](#use-global-events-now)
*   [IE11 no longer supported](#no-ie-11)

### [`$el` is now always the current element](#el-no-longer-root)

`$el` now always represents the element that an expression was executed on, not the root element of the component. This will replace most usages of `x-ref` and in the cases where you still want to access the root of a component, you can do so using `$root`. For example:

    <!-- 🚫 Before --><div x-data>    <button @click="console.log($el)"></button>    <!-- In V2, $el would have been the <div>, now it's the <button> --></div> <!-- ✅ After --><div x-data>    <button @click="console.log($root)"></button></div>
    <!-- 🚫 Before -->
    <div x-data>
        <button @click="console.log($el)"></button>
        <!-- In V2, $el would have been the <div>, now it's the <button> -->
    </div>
    
    <!-- ✅ After -->
    <div x-data>
        <button @click="console.log($root)"></button>
    </div>

For a smoother upgrade experience, you can replace all instances of `$el` with a custom magic called `$root`.

[→ Read more about $el in V3](/magics/el)  
[→ Read more about $root in V3](/magics/root)

### [Automatically evaluate `init()` functions defined on data object](#auto-init)

A common pattern in V2 was to manually call an `init()` (or similarly named method) on an `x-data` object.

In V3, Alpine will automatically call `init()` methods on data objects.

    <!-- 🚫 Before --><div x-data="foo()" x-init="init()"></div> <!-- ✅ After --><div x-data="foo()"></div> <script>    function foo() {        return {            init() {                //            }        }    }</script>
    <!-- 🚫 Before -->
    <div x-data="foo()" x-init="init()"></div>
    
    <!-- ✅ After -->
    <div x-data="foo()"></div>
    
    <script>
        function foo() {
            return {
                init() {
                    //
                }
            }
        }
    </script>

[→ Read more about auto-evaluating init functions](/globals/alpine-data#init-functions)

### [Need to call Alpine.start() after import](#need-to-call-alpine-start)

If you were importing Alpine V2 from NPM, you will now need to manually call `Alpine.start()` for V3. This doesn't affect you if you use Alpine's build file or CDN from a `<template>` tag.

    // 🚫 Beforeimport 'alpinejs' // ✅ Afterimport Alpine from 'alpinejs' window.Alpine = Alpine Alpine.start()
    // 🚫 Before
    import 'alpinejs'
    
    // ✅ After
    import Alpine from 'alpinejs'
    
    window.Alpine = Alpine
    
    Alpine.start()

[→ Read more about initializing Alpine V3](/essentials/installation#as-a-module)

### [`x-show.transition` is now `x-transition`](#removed-show-dot-transition)

All of the conveniences provided by `x-show.transition...` helpers are still available, but now from a more unified API: `x-transition`:

    <!-- 🚫 Before --><div x-show.transition="open"></div><!-- ✅ After --><div x-show="open" x-transition></div> <!-- 🚫 Before --><div x-show.transition.duration.500ms="open"></div><!-- ✅ After --><div x-show="open" x-transition.duration.500ms></div> <!-- 🚫 Before --><div x-show.transition.in.duration.500ms.out.duration.750ms="open"></div><!-- ✅ After --><div    x-show="open"    x-transition:enter.duration.500ms    x-transition:leave.duration.750ms></div>
    <!-- 🚫 Before -->
    <div x-show.transition="open"></div>
    <!-- ✅ After -->
    <div x-show="open" x-transition></div>
    
    <!-- 🚫 Before -->
    <div x-show.transition.duration.500ms="open"></div>
    <!-- ✅ After -->
    <div x-show="open" x-transition.duration.500ms></div>
    
    <!-- 🚫 Before -->
    <div x-show.transition.in.duration.500ms.out.duration.750ms="open"></div>
    <!-- ✅ After -->
    <div
        x-show="open"
        x-transition:enter.duration.500ms
        x-transition:leave.duration.750ms
    ></div>

[→ Read more about x-transition](/directives/transition)

### [`x-if` no longer supports `x-transition`](#x-if-no-transitions)

The ability to transition elements in and add before/after being removed from the DOM is no longer available in Alpine.

This was a feature very few people even knew existed let alone used.

Because the transition system is complex, it makes more sense from a maintenance perspective to only support transitioning elements with `x-show`.

    <!-- 🚫 Before --><template x-if.transition="open">    <div>...</div></template> <!-- ✅ After --><div x-show="open" x-transition>...</div>
    <!-- 🚫 Before -->
    <template x-if.transition="open">
        <div>...</div>
    </template>
    
    <!-- ✅ After -->
    <div x-show="open" x-transition>...</div>

[→ Read more about x-if](/directives/if)

### [`x-data` cascading scope](#x-data-scope)

Scope defined in `x-data` is now available to all children unless overwritten by a nested `x-data` expression.

    <!-- 🚫 Before --><div x-data="{ foo: 'bar' }">    <div x-data="{}">        <!-- foo is undefined -->    </div></div> <!-- ✅ After --><div x-data="{ foo: 'bar' }">    <div x-data="{}">        <!-- foo is 'bar' -->    </div></div>
    <!-- 🚫 Before -->
    <div x-data="{ foo: 'bar' }">
        <div x-data="{}">
            <!-- foo is undefined -->
        </div>
    </div>
    
    <!-- ✅ After -->
    <div x-data="{ foo: 'bar' }">
        <div x-data="{}">
            <!-- foo is 'bar' -->
        </div>
    </div>

[→ Read more about x-data scoping](/directives/data#scope)

### [`x-init` no longer accepts a callback return](#x-init-no-callback)

Before V3, if `x-init` received a return value that is `typeof` "function", it would execute the callback after Alpine finished initializing all other directives in the tree. Now, you must manually call `$nextTick()` to achieve that behavior. `x-init` is no longer "return value aware".

    <!-- 🚫 Before --><div x-data x-init="() => { ... }">...</div> <!-- ✅ After --><div x-data x-init="$nextTick(() => { ... })">...</div>
    <!-- 🚫 Before -->
    <div x-data x-init="() => { ... }">...</div>
    
    <!-- ✅ After -->
    <div x-data x-init="$nextTick(() => { ... })">...</div>

[→ Read more about $nextTick](/magics/next-tick)

### [Returning `false` from event handlers no longer implicitly "preventDefault"s](#no-false-return-from-event-handlers)

Alpine V2 observes a return value of `false` as a desire to run `preventDefault` on the event. This conforms to the standard behavior of native, inline listeners: `<... oninput="someFunctionThatReturnsFalse()">`. Alpine V3 no longer supports this API. Most people don't know it exists and therefore is surprising behavior.

    <!-- 🚫 Before --><div x-data="{ blockInput() { return false } }">    <input type="text" @input="blockInput()"></div> <!-- ✅ After --><div x-data="{ blockInput(e) { e.preventDefault() }">    <input type="text" @input="blockInput($event)"></div>
    <!-- 🚫 Before -->
    <div x-data="{ blockInput() { return false } }">
        <input type="text" @input="blockInput()">
    </div>
    
    <!-- ✅ After -->
    <div x-data="{ blockInput(e) { e.preventDefault() }">
        <input type="text" @input="blockInput($event)">
    </div>

[→ Read more about x-on](/directives/on)

### [`x-spread` is now `x-bind`](#x-spread-now-x-bind)

One of Alpine's stories for re-using functionality is abstracting Alpine directives into objects and applying them to elements with `x-spread`. This behavior is still the same, except now `x-bind` (with no specified attribute) is the API instead of `x-spread`.

    <!-- 🚫 Before --><div x-data="dropdown()">    <button x-spread="trigger">Toggle</button>     <div x-spread="dialogue">...</div></div> <!-- ✅ After --><div x-data="dropdown()">    <button x-bind="trigger">Toggle</button>     <div x-bind="dialogue">...</div></div>  <script>    function dropdown() {        return {            open: false,             trigger: {                'x-on:click'() { this.open = ! this.open },            },             dialogue: {                'x-show'() { return this.open },                'x-bind:class'() { return 'foo bar' },            },        }    }</script>
    <!-- 🚫 Before -->
    <div x-data="dropdown()">
        <button x-spread="trigger">Toggle</button>
    
        <div x-spread="dialogue">...</div>
    </div>
    
    <!-- ✅ After -->
    <div x-data="dropdown()">
        <button x-bind="trigger">Toggle</button>
    
        <div x-bind="dialogue">...</div>
    </div>
    
    
    <script>
        function dropdown() {
            return {
                open: false,
    
                trigger: {
                    'x-on:click'() { this.open = ! this.open },
                },
    
                dialogue: {
                    'x-show'() { return this.open },
                    'x-bind:class'() { return 'foo bar' },
                },
            }
        }
    </script>

[→ Read more about binding directives using x-bind](/directives/bind#bind-directives)

### [Use global lifecycle events instead of `Alpine.deferLoadingAlpine()`](#use-global-events-now)

    <!-- 🚫 Before --><script>    window.deferLoadingAlpine = startAlpine => {        // Will be executed before initializing Alpine.         startAlpine()         // Will be executed after initializing Alpine.    }</script> <!-- ✅ After --><script>    document.addEventListener('alpine:init', () => {        // Will be executed before initializing Alpine.    })     document.addEventListener('alpine:initialized', () => {        // Will be executed after initializing Alpine.    })</script>
    <!-- 🚫 Before -->
    <script>
        window.deferLoadingAlpine = startAlpine => {
            // Will be executed before initializing Alpine.
    
            startAlpine()
    
            // Will be executed after initializing Alpine.
        }
    </script>
    
    <!-- ✅ After -->
    <script>
        document.addEventListener('alpine:init', () => {
            // Will be executed before initializing Alpine.
        })
    
        document.addEventListener('alpine:initialized', () => {
            // Will be executed after initializing Alpine.
        })
    </script>

[→ Read more about Alpine lifecycle events](/essentials/lifecycle#alpine-initialization)

### [`x-ref` no longer supports binding](#x-ref-no-more-dynamic)

In Alpine V2 for below code

    <div x-data="{options: [{value: 1}, {value: 2}, {value: 3}] }">    <div x-ref="0">0</div>    <template x-for="option in options">        <div :x-ref="option.value" x-text="option.value"></div>    </template>     <button @click="console.log($refs[0], $refs[1], $refs[2], $refs[3]);">Display $refs</button></div>
    <div x-data="{options: [{value: 1}, {value: 2}, {value: 3}] }">
        <div x-ref="0">0</div>
        <template x-for="option in options">
            <div :x-ref="option.value" x-text="option.value"></div>
        </template>
    
        <button @click="console.log($refs[0], $refs[1], $refs[2], $refs[3]);">Display $refs</button>
    </div>

after clicking button all `$refs` were displayed. However, in Alpine V3 it's possible to access only `$refs` for elements created statically, so only first ref will be returned as expected.

### [IE11 no longer supported](#no-ie-11)

Alpine will no longer officially support Internet Explorer 11. If you need support for IE11, we recommend still using Alpine V2.

Deprecated APIs
---------------

The following 2 APIs will still work in V3, but are considered deprecated and are likely to be removed at some point in the future.

### [Event listener modifier `.away` should be replaced with `.outside`](#away-replace-with-outside)

    <!-- 🚫 Before --><div x-show="open" @click.away="open = false">    ...</div> <!-- ✅ After --><div x-show="open" @click.outside="open = false">    ...</div>
    <!-- 🚫 Before -->
    <div x-show="open" @click.away="open = false">
        ...
    </div>
    
    <!-- ✅ After -->
    <div x-show="open" @click.outside="open = false">
        ...
    </div>

### [Prefer `Alpine.data()` to global Alpine function data providers](#alpine-data-instead-of-global-functions)

    <!-- 🚫 Before --><div x-data="dropdown()">    ...</div> <script>    function dropdown() {        return {            ...        }    }</script> <!-- ✅ After --><div x-data="dropdown">    ...</div> <script>    document.addEventListener('alpine:init', () => {        Alpine.data('dropdown', () => ({            ...        }))    })</script>
    <!-- 🚫 Before -->
    <div x-data="dropdown()">
        ...
    </div>
    
    <script>
        function dropdown() {
            return {
                ...
            }
        }
    </script>
    
    <!-- ✅ After -->
    <div x-data="dropdown">
        ...
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                ...
            }))
        })
    </script>

> Note that you need to define `Alpine.data()` extensions BEFORE you call `Alpine.start()`. For more information, refer to the [Lifecycle Concerns](https://alpinejs.dev/advanced/extending#lifecycle-concerns) and [Installation as a Module](https://alpinejs.dev/essentials/installation#as-a-module) documentation pages.

[← Start Here](/start-here)

[Installation →](/essentials/installation)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---

## Watch

$watch
======

You can "watch" a component property using the `$watch` magic method. For example:

    <div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">    <button @click="open = ! open">Toggle Open</button></div>
    <div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
        <button @click="open = ! open">Toggle Open</button>
    </div>

In the above example, when the button is pressed and `open` is changed, the provided callback will fire and `console.log` the new value:

You can watch deeply nested properties using "dot" notation

    <div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo.bar', value => console.log(value))">    <button @click="foo.bar = 'bob'">Toggle Open</button></div>
    <div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo.bar', value => console.log(value))">
        <button @click="foo.bar = 'bob'">Toggle Open</button>
    </div>

When the `<button>` is pressed, `foo.bar` will be set to "bob", and "bob" will be logged to the console.

### [Getting the "old" value](#getting-the-old-value)

`$watch` keeps track of the previous value of the property being watched, You can access it using the optional second argument to the callback like so:

    <div x-data="{ open: false }" x-init="$watch('open', (value, oldValue) => console.log(value, oldValue))">    <button @click="open = ! open">Toggle Open</button></div>
    <div x-data="{ open: false }" x-init="$watch('open', (value, oldValue) => console.log(value, oldValue))">
        <button @click="open = ! open">Toggle Open</button>
    </div>

### [Deep watching](#deep-watching)

`$watch` automatically watches from changes at any level but you should keep in mind that, when a change is detected, the watcher will return the value of the observed property, not the value of the subproperty that has changed.

    <div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo', (value, oldValue) => console.log(value, oldValue))">    <button @click="foo.bar = 'bob'">Update</button></div>
    <div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo', (value, oldValue) => console.log(value, oldValue))">
        <button @click="foo.bar = 'bob'">Update</button>
    </div>

When the `<button>` is pressed, `foo.bar` will be set to "bob", and "{bar: 'bob'} {bar: 'baz'}" will be logged to the console (new and old value).

> ⚠️ Changing a property of a "watched" object as a side effect of the `$watch` callback will generate an infinite loop and eventually error.

    <!-- 🚫 Infinite loop --><div x-data="{ foo: { bar: 'baz', bob: 'lob' }}" x-init="$watch('foo', value => foo.bob = foo.bar)">    <button @click="foo.bar = 'bob'">Update</button></div>
    <!-- 🚫 Infinite loop -->
    <div x-data="{ foo: { bar: 'baz', bob: 'lob' }}" x-init="$watch('foo', value => foo.bob = foo.bar)">
        <button @click="foo.bar = 'bob'">Update</button>
    </div>

[← $store](/magics/store)

[$dispatch →](/magics/dispatch)

Code highlighting provided by [Torchlight](https://torchlight.dev)

---