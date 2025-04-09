# Livewire

## Índice

- [Actions](#actions)

- [Alpine](#alpine)

- [Bundling](#bundling)

- [Components](#components)

- [Computed Properties](#computed-properties)

- [Contribution Guide](#contribution-guide)

- [Downloads](#downloads)

- [Events](#events)

- [Forms](#forms)

- [Hydration](#hydration)

- [Installation](#installation)

- [Javascript](#javascript)

- [Lazy](#lazy)

- [Lifecycle Hooks](#lifecycle-hooks)

- [Locked](#locked)

- [Morphing](#morphing)

- [Navigate](#navigate)

- [Nesting](#nesting)

- [Offline](#offline)

- [Pagination](#pagination)

- [Properties](#properties)

- [Quickstart](#quickstart)

- [Redirecting](#redirecting)

- [Security](#security)

- [Session Properties](#session-properties)

- [Synthesizers](#synthesizers)

- [Teleport](#teleport)

- [Testing](#testing)

- [Troubleshooting](#troubleshooting)

- [Understanding Nesting](#understanding-nesting)

- [Upgrading](#upgrading)

- [Uploads](#uploads)

- [Url](#url)

- [Validation](#validation)

- [Volt](#volt)

- [Wire Click](#wire-click)

- [Wire Cloak](#wire-cloak)

- [Wire Confirm](#wire-confirm)

- [Wire Current](#wire-current)

- [Wire Dirty](#wire-dirty)

- [Wire Ignore](#wire-ignore)

- [Wire Init](#wire-init)

- [Wire Loading](#wire-loading)

- [Wire Model](#wire-model)

- [Wire Navigate](#wire-navigate)

- [Wire Offline](#wire-offline)

- [Wire Poll](#wire-poll)

- [Wire Replace](#wire-replace)

- [Wire Show](#wire-show)

- [Wire Stream](#wire-stream)

- [Wire Submit](#wire-submit)

- [Wire Text](#wire-text)

- [Wire Transition](#wire-transition)

## Actions

Actions
=======

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire actions are methods on your component that can be triggered by frontend interactions like clicking a button or submitting a form. They provide the developer experience of being able to call a PHP method directly from the browser, allowing you to focus on the logic of your application without getting bogged down writing boilerplate code connecting your application's frontend and backend.

Let's explore a basic example of calling a `save` action on a `CreatePost` component:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);         return redirect()->to('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit="save">     <input type="text" wire:model="title">     <textarea wire:model="content"></textarea>     <button type="submit">Save</button></form>

In the above example, when a user submits the form by clicking "Save", `wire:submit` intercepts the `submit` event and calls the `save()` action on the server.

In essence, actions are a way to easily map user interactions to server-side functionality without the hassle of submitting and handling AJAX requests manually.

[#](#refreshing-a-component "Permalink")Refreshing a component
--------------------------------------------------------------

Sometimes you may want to trigger a simple "refresh" of your component. For example, if you have a component checking the status of something in the database, you may want to show a button to your users allowing them to refresh the displayed results.

You can do this using Livewire's simple `$refresh` action anywhere you would normally reference your own component method:

    <button type="button" wire:click="$refresh">...</button>

When the `$refresh` action is triggered, Livewire will make a server-roundtrip and re-render your component without calling any methods.

It's important to note that any pending data updates in your component (for example `wire:model` bindings) will be applied on the server when the component is refreshed.

Internally, Livewire uses the name "commit" to refer to any time a Livewire component is updated on the server. If you prefer this terminology, you can use the `$commit` helper instead of `$refresh`. The two are identical.

    <button type="button" wire:click="$commit">...</button>

You can also trigger a component refresh using AlpineJS in your Livewire component:

    <button type="button" x-on:click="$wire.$refresh()">...</button>

Learn more by reading the [documentation for using Alpine inside Livewire](/docs/alpine).

[#](#confirming-an-action "Permalink")Confirming an action
----------------------------------------------------------

When allowing users to perform dangerous actions—such as deleting a post from the database—you may want to show them a confirmation alert to verify that they wish to perform that action.

Livewire makes this easy by providing a simple directive called `wire:confirm`:

    <button    type="button"    wire:click="delete"    wire:confirm="Are you sure you want to delete this post?">    Delete post </button>

When `wire:confirm` is added to an element containing a Livewire action, when a user tries to trigger that action, they will be presented with a confirmation dialog containing the provided message. They can either press "OK" to confirm the action, or press "Cancel" or hit the escape key.

For more information, visit the [`wire:confirm` documentation page](/docs/wire-confirm).

[#](#event-listeners "Permalink")Event listeners
------------------------------------------------

Livewire supports a variety of event listeners, allowing you to respond to various types of user interactions:

Listener

Description

`wire:click`

Triggered when an element is clicked

`wire:submit`

Triggered when a form is submitted

`wire:keydown`

Triggered when a key is pressed down

`wire:keyup`

Triggered when a key is released

`wire:mouseenter`

Triggered when the mouse enters an element

`wire:*`

Whatever text follows `wire:` will be used as the event name of the listener

Because the event name after `wire:` can be anything, Livewire supports any browser event you might need to listen for. For example, to listen for `transitionend`, you can use `wire:transitionend`.

### [#](#listening-for-specific-keys "Permalink")Listening for specific keys

You can use one of Livewire's convenient aliases to narrow down key press event listeners to a specific key or combination of keys.

For example, to perform a search when a user hits `Enter` after typing into a search box, you can use `wire:keydown.enter`:

    <input wire:model="query" wire:keydown.enter="searchPosts">

You can chain more key aliases after the first to listen for combinations of keys. For example, if you would like to listen for the `Enter` key only while the `Shift` key is pressed, you may write the following:

    <input wire:keydown.shift.enter="...">

Below is a list of all the available key modifiers:

Modifier

Key

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

`.up`

Up arrow

`.down`

Down arrow

`.left`

Left arrow

`.right`

Right arrow

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

`.slash`

Forward Slash, `/`

### [#](#event-handler-modifiers "Permalink")Event handler modifiers

Livewire also includes helpful modifiers to make common event-handling tasks trivial.

For example, if you need to call `event.preventDefault()` from inside an event listener, you can suffix the event name with `.prevent`:

    <input wire:keydown.prevent="...">

Here is a full list of all the available event listener modifiers and their functions:

Modifier

Key

`.prevent`

Equivalent of calling `.preventDefault()`

`.stop`

Equivalent of calling `.stopPropagation()`

`.window`

Listens for event on the `window` object

`.outside`

Only listens for clicks "outside" the element

`.document`

Listens for events on the `document` object

`.once`

Ensures the listener is only called once

`.debounce`

Debounce the handler by 250ms as a default

`.debounce.100ms`

Debounce the handler for a specific amount of time

`.throttle`

Throttle the handler to being called every 250ms at minimum

`.throttle.100ms`

Throttle the handler at a custom duration

`.self`

Only call listener if event originated on this element, not children

`.camel`

Converts event name to camel case (`wire:custom-event` -> "customEvent")

`.dot`

Converts event name to dot notation (`wire:custom-event` -> "custom.event")

`.passive`

`wire:touchstart.passive` won't block scroll performance

`.capture`

Listen for event in the "capturing" phase

Because `wire:` uses [Alpine's](https://alpinejs.dev) `x-on` directive under the hood, these modifiers are made available to you by Alpine. For more context on when you should use these modifiers, consult the [Alpine Events documentation](https://alpinejs.dev/essentials/events).

### [#](#handling-third-party-events "Permalink")Handling third-party events

Livewire also supports listening for custom events fired by third-party libraries.

For example, let's imagine you're using the [Trix](https://trix-editor.org/) rich text editor in your project and you want to listen for the `trix-change` event to capture the editor's content. You can accomplish this using the `wire:trix-change` directive:

    <form wire:submit="save">    <!-- ... -->     <trix-editor        wire:trix-change="setPostContent($event.target.value)"    ></trix-editor>     <!-- ... --></form>

In this example, the `setPostContent` action is called whenever the `trix-change` event is triggered, updating the `content` property in the Livewire component with the current value of the Trix editor.

You can access the event object using`$event`

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Within Livewire event handlers, you can access the event object via `$event`. This is useful for referencing information on the event. For example, you can access the element that triggered the event via `$event.target`.

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

The Trix demo code above is incomplete and only useful as a demonstration of event listeners. If used verbatim, a network request would be fired on every single keystroke. A more performant implementation would be:

    <trix-editor   x-on:trix-change="$wire.content = $event.target.value"></trix-editor>

### [#](#listening-for-dispatched-custom-events "Permalink")Listening for dispatched custom events

If your application dispatches custom events from Alpine, you can also listen for those using Livewire:

    <div wire:custom-event="...">     <!-- Deeply nested within this component: -->    <button x-on:click="$dispatch('custom-event')">...</button> </div>

When the button is clicked in the above example, the `custom-event` event is dispatched and bubbles up to the root of the Livewire component where `wire:custom-event` catches it and invokes a given action.

If you want to listen for an event dispatched somewhere else in your application, you will need to wait instead for the event to bubble up to the `window` object and listen for it there. Fortunately, Livewire makes this easy by allowing you to add a simple `.window` modifier to any event listener:

    <div wire:custom-event.window="...">    <!-- ... --></div> <!-- Dispatched somewhere on the page outside the component: --><button x-on:click="$dispatch('custom-event')">...</button>

### [#](#disabling-inputs-while-a-form-is-being-submitted "Permalink")Disabling inputs while a form is being submitted

Consider the `CreatePost` example we previously discussed:

    <form wire:submit="save">    <input wire:model="title">     <textarea wire:model="content"></textarea>     <button type="submit">Save</button></form>

When a user clicks "Save", a network request is sent to the server to call the `save()` action on the Livewire component.

But, let's imagine that a user is filling out this form on a slow internet connection. The user clicks "Save" and nothing happens initially because the network request takes longer than usual. They might wonder if the submission failed and attempt to click the "Save" button again while the first request is still being handled.

In this case, there would be two requests for the same action being processed at the same time.

To prevent this scenario, Livewire automatically disables the submit button and all form inputs inside the `<form>` element while a `wire:submit` action is being processed. This ensures that a form isn't accidentally submitted twice.

To further lessen the confusion for users on slower connections, it is often helpful to show some loading indicator such as a subtle background color change or SVG animation.

Livewire provides a `wire:loading` directive that makes it trivial to show and hide loading indicators anywhere on a page. Here's a short example of using `wire:loading` to show a loading message below the "Save" button:

    <form wire:submit="save">    <textarea wire:model="content"></textarea>     <button type="submit">Save</button>     <span wire:loading>Saving...</span> </form>

`wire:loading` is a powerful feature with a variety of more powerful features. [Check out the full loading documentation for more information](/docs/wire-loading).

[#](#passing-parameters "Permalink")Passing parameters
------------------------------------------------------

Livewire allows you to pass parameters from your Blade template to the actions in your component, giving you the opportunity to provide an action additional data or state from the frontend when the action is called.

For example, let's imagine you have a `ShowPosts` component that allows users to delete a post. You can pass the post's ID as a parameter to the `delete()` action in your Livewire component. Then, the action can fetch the relevant post and delete it from the database:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    public function delete($id)    {        $post = Post::findOrFail($id);         $this->authorize('delete', $post);         $post->delete();    }     public function render()    {        return view('livewire.show-posts', [            'posts' => Auth::user()->posts,        ]);    }}

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>             <button wire:click="delete({{ $post->id }})">Delete</button>         </div>    @endforeach</div>

For a post with an ID of 2, the "Delete" button in the Blade template above will render in the browser as:

    <button wire:click="delete(2)">Delete</button>

When this button is clicked, the `delete()` method will be called and `$id` will be passed in with a value of "2".

Don't trust action parameters

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Action parameters should be treated just like HTTP request input, meaning action parameter values should not be trusted. You should always authorize ownership of an entity before updating it in the database.

For more information, consult our documentation regarding [security concerns and best practices](/docs/actions#security-concerns).

As an added convenience, you may automatically resolve Eloquent models by a corresponding model ID that is provided to an action as a parameter. This is very similar to [route model binding](/docs/components#using-route-model-binding). To get started, type-hint an action parameter with a model class and the appropriate model will automatically be retrieved from the database and passed to the action instead of the ID:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    public function delete(Post $post)     {        $this->authorize('delete', $post);         $post->delete();    }     public function render()    {        return view('livewire.show-posts', [            'posts' => Auth::user()->posts,        ]);    }}

[#](#dependency-injection "Permalink")Dependency injection
----------------------------------------------------------

You can take advantage of [Laravel's dependency injection](https://laravel.com/docs/controllers#dependency-injection-and-controllers) system by type-hinting parameters in your action's signature. Livewire and Laravel will automatically resolve the action's dependencies from the container:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Repositories\PostRepository; class ShowPosts extends Component{    public function delete(PostRepository $posts, $postId)     {        $posts->deletePost($postId);    }     public function render()    {        return view('livewire.show-posts', [            'posts' => Auth::user()->posts,        ]);    }}

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>             <button wire:click="delete({{ $post->id }})">Delete</button>         </div>    @endforeach</div>

In this example, the `delete()` method receives an instance of `PostRepository` resolved via [Laravel's service container](https://laravel.com/docs/container#main-content) before receiving the provided `$postId` parameter.

[#](#calling-actions-from-alpine "Permalink")Calling actions from Alpine
------------------------------------------------------------------------

Livewire integrates seamlessly with [Alpine](https://alpinejs.dev/). In fact, under the hood, every Livewire component is also an Alpine component. This means you can take full advantage of Alpine within your components to add JavaScript powered client-side interactivity.

To make this pairing even more powerful, Livewire exposes a magic `$wire` object to Alpine that can be treated as a JavaScript representation of your PHP component. In addition to [accessing and mutating public properties via `$wire`](/docs/properties#accessing-properties-from-javascript), you can call actions. When an action is invoked on the `$wire` object, the corresponding PHP method will be invoked on your backend Livewire component:

    <button x-on:click="$wire.save()">Save Post</button>

Or, to illustrate a more complex example, you might use Alpine's [`x-intersect`](https://alpinejs.dev/plugins/intersect) utility to trigger a `incrementViewCount()` Livewire action when a given element is visible on the page:

    <div x-intersect="$wire.incrementViewCount()">...</div>

### [#](#passing-parameters-1 "Permalink")Passing parameters

Any parameters you pass to the `$wire` method will also be passed to the PHP class method. For example, consider the following Livewire action:

    public function addTodo($todo){    $this->todos[] = $todo;}

Within your component's Blade template, you can invoke this action via Alpine, providing the parameter that should be given to the action:

    <div x-data="{ todo: '' }">    <input type="text" x-model="todo">     <button x-on:click="$wire.addTodo(todo)">Add Todo</button></div>

If a user had typed in "Take out the trash" into the text input and the pressed the "Add Todo" button, the `addTodo()` method will be triggered with the `$todo` parameter value being "Take out the trash".

### [#](#receiving-return-values "Permalink")Receiving return values

For even more power, invoked `$wire` actions return a promise while the network request is processing. When the server response is received, the promise resolves with the value returned by the backend action.

For example, consider a Livewire component that has the following action:

    use App\Models\Post; public function getPostCount(){    return Post::count();}

Using `$wire`, the action may be invoked and its returned value resolved:

    <span x-init="$el.innerHTML = await $wire.getPostCount()"></span>

In this example, if the `getPostCount()` method returns "10", the `<span>` tag will also contain "10".

Alpine knowledge is not required when using Livewire; however, it's an extremely powerful tool and knowing Alpine will augment your Livewire experience and productivity.

[#](#javascript-actions "Permalink")JavaScript actions
------------------------------------------------------

Livewire allows you to define JavaScript actions that run entirely on the client-side without making a server request. This is useful in two scenarios:

1.  When you want to perform simple UI updates that don't require server communication
2.  When you want to optimistically update the UI with JavaScript before making a server request

To define a JavaScript action, you can use the `$js()` function inside a `<script>` tag in your component.

Here's an example of bookmarking a post that uses a JavaScript action to optimistically update the UI before making a server request. The JavaScript action immediately shows the filled bookmark icon, then makes a request to persist the bookmark in the database:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;     public $bookmarked = false;     public function mount()    {        $this->bookmarked = $this->post->bookmarkedBy(auth()->user());    }     public function bookmarkPost()    {        $this->post->bookmark(auth()->user());         $this->bookmarked = $this->post->bookmarkedBy(auth()->user());    }     public function render()    {        return view('livewire.show-post');    }}

    <div>    <button wire:click="$js.bookmark" class="flex items-center gap-1">        {{-- Outlined bookmark icon... --}}        <svg wire:show="!bookmarked" wire:cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />        </svg>         {{-- Solid bookmark icon... --}}        <svg wire:show="bookmarked" wire:cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">            <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />        </svg>    </button></div> @script<script>    $js('bookmark', () => {        $wire.bookmarked = !$wire.bookmarked         $wire.bookmarkPost()    })</script>@endscript

When a user clicks the heart button, the following sequence occurs:

1.  The "bookmark" JavaScript action is triggered
2.  The heart icon immediately updates by toggling `$wire.bookmarked` on the client-side
3.  The `bookmarkPost()` method is called to save the change to the database

This provides instant visual feedback while ensuring the bookmark state is properly persisted.

### [#](#calling-from-alpine "Permalink")Calling from Alpine

You can call JavaScript actions directly from Alpine using the `$wire` object. For example, you may use the `$wire` object to invoke the `bookmark` JavaScript action:

    <button x-on:click="$wire.$js.bookmark()">Bookmark</button>

### [#](#calling-from-php "Permalink")Calling from PHP

JavaScript actions can also be called using the `js()` method from PHP:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public $title = '';     public function save()    {        // ...         $this->js('onPostSaved');     }}

    <div>    <!-- ... -->     <button wire:click="save">Save</button></div> @script<script>    $js('onPostSaved', () => {        alert('Your post has been saved successfully!')    })</script>@endscript

In this example, when the `save()` action is finished, the `postSaved` JavaScript action will be run, triggering the alert dialog.

[#](#magic-actions "Permalink")Magic actions
--------------------------------------------

Livewire provides a set of "magic" actions that allow you to perform common tasks in your components without defining custom methods. These magic actions can be used within event listeners defined in your Blade templates.

### [#](#parent "Permalink")`$parent`

The `$parent` magic variable allows you to access parent component properties and call parent component actions from a child component:

    <button wire:click="$parent.removePost({{ $post->id }})">Remove</button>

In the above example, if a parent component has a `removePost()` action, a child can call it directly from its Blade template using `$parent.removePost()`.

### [#](#set "Permalink")`$set`

The `$set` magic action allows you to update a property in your Livewire component directly from the Blade template. To use `$set`, provide the property you want to update and the new value as arguments:

    <button wire:click="$set('query', '')">Reset Search</button>

In this example, when the button is clicked, a network request is dispatched that sets the `$query` property in the component to `''`.

### [#](#refresh "Permalink")`$refresh`

The `$refresh` action triggers a re-render of your Livewire component. This can be useful when updating the component's view without changing any property values:

    <button wire:click="$refresh">Refresh</button>

When the button is clicked, the component will re-render, allowing you to see the latest changes in the view.

### [#](#toggle "Permalink")`$toggle`

The `$toggle` action is used to toggle the value of a boolean property in your Livewire component:

    <button wire:click="$toggle('sortAsc')">    Sort {{ $sortAsc ? 'Descending' : 'Ascending' }}</button>

In this example, when the button is clicked, the `$sortAsc` property in the component will toggle between `true` and `false`.

### [#](#dispatch "Permalink")`$dispatch`

The `$dispatch` action allows you to dispatch a Livewire event directly in the browser. Below is an example of a button that, when clicked, will dispatch the `post-deleted` event:

    <button type="submit" wire:click="$dispatch('post-deleted')">Delete Post</button>

### [#](#event "Permalink")`$event`

The `$event` action may be used within event listeners like `wire:click`. This action gives you access to the actual JavaScript event that was triggered, allowing you to reference the triggering element and other relevant information:

    <input type="text" wire:keydown.enter="search($event.target.value)">

When the enter key is pressed while a user is typing in the input above, the contents of the input will be passed as a parameter to the `search()` action.

### [#](#using-magic-actions-from-alpine "Permalink")Using magic actions from Alpine

You can also call magic actions from Alpine using the `$wire` object. For example, you may use the `$wire` object to invoke the `$refresh` magic action:

    <button x-on:click="$wire.$refresh()">Refresh</button>

[#](#skipping-re-renders "Permalink")Skipping re-renders
--------------------------------------------------------

Sometimes there might be an action in your component with no side effects that would change the rendered Blade template when the action is invoked. If so, you can skip the `render` portion of Livewire's lifecycle by adding the `#[Renderless]` attribute above the action method.

To demonstrate, in the `ShowPost` component below, the "view count" is logged when the user has scrolled to the bottom of the post:

    <?php namespace App\Livewire; use Livewire\Attributes\Renderless;use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;     public function mount(Post $post)    {        $this->post = $post;    }     #[Renderless]     public function incrementViewCount()    {        $this->post->incrementViewCount();    }     public function render()    {        return view('livewire.show-post');    }}

    <div>    <h1>{{ $post->title }}</h1>    <p>{{ $post->content }}</p>     <div x-intersect="$wire.incrementViewCount()"></div></div>

The example above uses [`x-intersect`](https://alpinejs.dev/plugins/intersect), an Alpine utility that calls the expression when the element enters the viewport (typically used to detect when a user scrolls to an element further down the page).

As you can see, when a user scrolls to the bottom of the post, `incrementViewCount()` is invoked. Since `#[Renderless]` was added to the action, the view is logged, but the template doesn't re-render and no part of the page is affected.

If you prefer to not utilize method attributes or need to conditionally skip rendering, you may invoke the `skipRender()` method in your component action:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;     public function mount(Post $post)    {        $this->post = $post;    }     public function incrementViewCount()    {        $this->post->incrementViewCount();         $this->skipRender();     }     public function render()    {        return view('livewire.show-post');    }}

[#](#security-concerns "Permalink")Security concerns
----------------------------------------------------

Remember that any public method in your Livewire component can be called from the client-side, even without an associated `wire:click` handler that invokes it. In these scenarios, users can still trigger the action from the browser's DevTools.

Below are three examples of easy-to-miss vulnerabilities in Livewire components. Each will show the vulnerable component first and the secure component after. As an exercise, try spotting the vulnerabilities in the first example before viewing the solution.

If you are having difficulty spotting the vulnerabilities and that makes you concerned about your ability to keep your own applications secure, remember all these vulnerabilities apply to standard web applications that use requests and controllers. If you use a component method as a proxy for a controller method, and its parameters as a proxy for request input, you should be able to apply your existing application security knowledge to your Livewire code.

### [#](#always-authorize-action-parameters "Permalink")Always authorize action parameters

Just like controller request input, it's imperative to authorize action parameters since they are arbitrary user input.

Below is a `ShowPosts` component where users can view all their posts on one page. They can delete any post they like using one of the post's "Delete" buttons.

Here is a vulnerable version of the component:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    public function delete($id)    {        $post = Post::find($id);         $post->delete();    }     public function render()    {        return view('livewire.show-posts', [            'posts' => Auth::user()->posts,        ]);    }}

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>             <button wire:click="delete({{ $post->id }})">Delete</button>        </div>    @endforeach</div>

Remember that a malicious user can call `delete()` directly from a JavaScript console, passing any parameters they would like to the action. This means that a user viewing one of their posts can delete another user's post by passing the un-owned post ID to `delete()`.

To protect against this, we need to authorize that the user owns the post about to be deleted:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    public function delete($id)    {        $post = Post::find($id);         $this->authorize('delete', $post);          $post->delete();    }     public function render()    {        return view('livewire.show-posts', [            'posts' => Auth::user()->posts,        ]);    }}

### [#](#always-authorize-server-side "Permalink")Always authorize server-side

Like standard Laravel controllers, Livewire actions can be called by any user, even if there isn't an affordance for invoking the action in the UI.

Consider the following `BrowsePosts` component where any user can view all the posts in the application, but only administrators can delete a post:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class BrowsePosts extends Component{    public function deletePost($id)    {        $post = Post::find($id);         $post->delete();    }     public function render()    {        return view('livewire.browse-posts', [            'posts' => Post::all(),        ]);    }}

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>             @if (Auth::user()->isAdmin())                <button wire:click="deletePost({{ $post->id }})">Delete</button>            @endif        </div>    @endforeach</div>

As you can see, only administrators can see the "Delete" button; however, any user can call `deletePost()` on the component from the browser's DevTools.

To patch this vulnerability, we need to authorize the action on the server like so:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class BrowsePosts extends Component{    public function deletePost($id)    {        if (! Auth::user()->isAdmin) {             abort(403);        }         $post = Post::find($id);         $post->delete();    }     public function render()    {        return view('livewire.browse-posts', [            'posts' => Post::all(),        ]);    }}

With this change, only administrators can delete a post from this component.

### [#](#keep-dangerous-methods-protected-or-private "Permalink")Keep dangerous methods protected or private

Every public method inside your Livewire component is callable from the client. Even methods you haven't referenced inside a `wire:click` handler. To prevent a user from calling a method that isn't intended to be callable client-side, you should mark them as `protected` or `private`. By doing so, you restrict the visibility of that sensitive method to the component's class and its subclasses, ensuring they cannot be called from the client-side.

Consider the `BrowsePosts` example that we previously discussed, where users can view all posts in your application, but only administrators can delete posts. In the [Always authorize server-side](/docs/actions#always-authorize-server-side) section, we made the action secure by adding server-side authorization. Now imagine we refactor the actual deletion of the post into a dedicated method like you might do in order to simplify your code:

    // Warning: This snippet demonstrates what NOT to do...<?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class BrowsePosts extends Component{    public function deletePost($id)    {        if (! Auth::user()->isAdmin) {            abort(403);        }         $this->delete($id);     }     public function delete($postId)      {        $post = Post::find($postId);         $post->delete();    }     public function render()    {        return view('livewire.browse-posts', [            'posts' => Post::all(),        ]);    }}

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>             <button wire:click="deletePost({{ $post->id }})">Delete</button>        </div>    @endforeach</div>

As you can see, we refactored the post deletion logic into a dedicated method named `delete()`. Even though this method isn't referenced anywhere in our template, if a user gained knowledge of its existence, they would be able to call it from the browser's DevTools because it is `public`.

To remedy this, we can mark the method as `protected` or `private`. Once the method is marked as `protected` or `private`, an error will be thrown if a user tries to invoke it:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class BrowsePosts extends Component{    public function deletePost($id)    {        if (! Auth::user()->isAdmin) {            abort(403);        }         $this->delete($id);    }     protected function delete($postId)     {        $post = Post::find($postId);         $post->delete();    }     public function render()    {        return view('livewire.browse-posts', [            'posts' => Post::all(),        ]);    }}

---

## Alpine

Alpine
======

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

[AlpineJS](https://alpinejs.dev/) is a lightweight JavaScript library that makes it easy to add client-side interactivity to your web pages. It was originally built to complement tools like Livewire where a more JavaScript-centric utility is helpful for sprinkling interactivity around your app.

Livewire ships with Alpine out of the box so there is no need to install it into your project separately.

The best place to learn about using AlpineJS is [the Alpine documentation](https://alpinejs.dev).

[#](#a-basic-alpine-component "Permalink")A Basic Alpine component
------------------------------------------------------------------

To lay a foundation for the rest of this documentation, here is one of the most simple and informative examples of an Alpine component. A small "counter" that shows a number on the page and allows the user to increment that number by clicking a button:

    <!-- Declare a JavaScript object of data... --><div x-data="{ count: 0 }">    <!-- Render the current "count" value inside an element... -->    <h2 x-text="count"></h2>     <!-- Increment the "count" value by "1" when a click event is dispatched... -->    <button x-on:click="count++">+</button></div>

The Alpine component above can be used inside any Livewire component in your application without a hitch. Livewire takes care of maintaining Alpine's state across Livewire component updates. In essence, you should feel free to use Alpine components inside Livewire as if you were using Alpine in any other non-Livewire context.

[#](#using-alpine-inside-livewire "Permalink")Using Alpine inside Livewire
--------------------------------------------------------------------------

Let's explore a more real-life example of using an Alpine component inside a Livewire component.

Below is a simple Livewire component showing the details of a post model from the database. By default, only the title of the post is shown:

    <div>    <h1>{{ $post->title }}</h1>     <div x-data="{ expanded: false }">        <button type="button" x-on:click="expanded = ! expanded">            <span x-show="! expanded">Show post content...</span>            <span x-show="expanded">Hide post content...</span>        </button>         <div x-show="expanded">            {{ $post->content }}        </div>    </div></div>

By using Alpine, we can hide the content of the post until the user presses the "Show post content..." button. At that point, Alpine's `expanded` property will be set to `true` and the content will be shown on the page because `x-show="expanded"` is used to give Alpine control over the visibility of the post's content.

This is an example of where Alpine shines: adding interactivity into your application without triggering Livewire server-roundtrips.

[#](#controlling-livewire-from-alpine-using-wire "Permalink")Controlling Livewire from Alpine using `$wire`
-----------------------------------------------------------------------------------------------------------

One of the most powerful features available to you as a Livewire developer is `$wire`. The `$wire` object is a magic object available to all your Alpine components that are used inside of Livewire.

You can think of `$wire` as a gateway from JavaScript into PHP. It allows you to access and modify Livewire component properties, call Livewire component methods, and do much more; all from inside AlpineJS.

### [#](#accessing-livewire-properties "Permalink")Accessing Livewire properties

Here is an example of a simple "character count" utility in a form for creating a post. This will instantly show a user how many characters are contained inside their post's content as they type:

    <form wire:submit="save">    <!-- ... -->     <input wire:model="content" type="text">     <small>        Character count: <span x-text="$wire.content.length"></span>     </small>     <button type="submit">Save</button></form>

As you can see `x-text` in the above example is being used to allow Alpine to control the text content of the `<span>` element. `x-text` accepts any JavaScript expression inside of it and automatically reacts when any dependencies are updated. Because we are using `$wire.content` to access the value of `$content`, Alpine will automatically update the text content every time `$wire.content` is updated from Livewire; in this case by `wire:model="content"`.

### [#](#mutating-livewire-properties "Permalink")Mutating Livewire properties

Here is an example of using `$wire` inside Alpine to clear the "title" field of a form for creating a post.

    <form wire:submit="save">    <input wire:model="title" type="text">     <button type="button" x-on:click="$wire.title = ''">Clear</button>      <!-- ... -->     <button type="submit">Save</button></form>

As a user is filling out the above Livewire form, they can press "Clear" and the title field will be cleared without sending a network request from Livewire. The interaction will be "instant".

Here's a brief explanation of what's going on to make that happen:

*   `x-on:click` tells Alpine to listen for a click on the button element
*   When clicked, Alpine runs the provided JS expression: `$wire.title = ''`
*   Because `$wire` is a magic object representing the Livewire component, all properties from your component can be accessed or mutated straight from JavaScript
*   `$wire.title = ''` sets the value of `$title` in your Livewire component to an empty string
*   Any Livewire utilities like `wire:model` will instantly react to this change, all without sending a server-roundtrip
*   On the next Livewire network request, the `$title` property will be updated to an empty string on the backend

### [#](#calling-livewire-methods "Permalink")Calling Livewire methods

Alpine can also easily call any Livewire methods/actions by simply calling them directly on `$wire`.

Here is an example of using Alpine to listen for a "blur" event on an input and triggering a form save. The "blur" event is dispatched by the browser when a user presses "tab" to remove focus from the current element and focus on the next one on the page:

    <form wire:submit="save">    <input wire:model="title" type="text" x-on:blur="$wire.save()">       <!-- ... -->     <button type="submit">Save</button></form>

Typically, you would just use `wire:model.blur="title"` in this situation, however, it's helpful for demonstration purposes how you can achieve this using Alpine.

#### [#](#passing-parameters "Permalink")Passing parameters

You can also pass parameters to Livewire methods by simply passing them to the `$wire` method call.

Consider a component with a `deletePost()` method like so:

    public function deletePost($postId){    $post = Post::find($postId);     // Authorize user can delete...    auth()->user()->can('update', $post);     $post->delete();}

Now, you can pass a `$postId` parameter to the `deletePost()` method from Alpine like so:

    <button type="button" x-on:click="$wire.deletePost(1)">

In general, something like a `$postId` would be generated in Blade. Here's an example of using Blade to determine which `$postId` Alpine passes into `deletePost()`:

    @foreach ($posts as $post)    <button type="button" x-on:click="$wire.deletePost({{ $post->id }})">        Delete "{{ $post->title }}"    </button>@endforeach

If there are three posts on the page, the above Blade template will render to something like the following in the browser:

    <button type="button" x-on:click="$wire.deletePost(1)">    Delete "The power of walking"</button> <button type="button" x-on:click="$wire.deletePost(2)">    Delete "How to record a song"</button> <button type="button" x-on:click="$wire.deletePost(3)">    Delete "Teach what you learn"</button>

As you can see, we've used Blade to render different post IDs into the Alpine `x-on:click` expressions.

#### [#](#blade-parameter-gotchas "Permalink")Blade parameter "gotchas"

This is an extremely powerful technique, but can be confusing when reading your Blade templates. It can be hard to know which parts are Blade and which parts are Alpine at first glance. Therefore, it's helpful to inspect the HTML rendered on the page to make sure what you are expecting to be rendered is accurate.

Here's an example that commonly confuses people:

Let's say, instead of an ID, your Post model uses UUIDs for indexes (IDs are integers, and UUIDs are long strings of characters).

If we render the following just like we did with an ID there will be an issue:

    <!-- Warning: this is an example of problematic code... --><button    type="button"    x-on:click="$wire.deletePost({{ $post->uuid }})">

The above Blade template will render the following in your HTML:

    <!-- Warning: this is an example of problematic code... --><button    type="button"    x-on:click="$wire.deletePost(93c7b04c-c9a4-4524-aa7d-39196011b81a)">

Notice the lack of quotes around the UUID string? When Alpine goes to evaluate this expression, JavaScript will throw an error: "Uncaught SyntaxError: Invalid or unexpected token".

To fix this, we need to add quotations around the Blade expression like so:

    <button    type="button"    x-on:click="$wire.deletePost('{{ $post->uuid }}')">

Now the above template will render properly and everything will work as expected:

    <button    type="button"    x-on:click="$wire.deletePost('93c7b04c-c9a4-4524-aa7d-39196011b81a')">

### [#](#refreshing-a-component "Permalink")Refreshing a component

You can easily refresh a Livewire component (trigger network roundtrip to re-render a component's Blade view) using `$wire.$refresh()`:

    <button type="button" x-on:click="$wire.$refresh()">

[#](#sharing-state-using-wireentangle "Permalink")Sharing state using `$wire.entangle`
--------------------------------------------------------------------------------------

In most cases, `$wire` is all you need for interacting with Livewire state from Alpine. However, Livewire provides an additional `$wire.entangle()` utility that can be used to keep values from Livewire in-sync with values in Alpine.

To demonstrate, consider this dropdown example with its `showDropdown` property entangled between Livewire and Alpine using `$wire.entangle()`. By using entanglement, we are now able to control the state of the dropdown from both Alpine and Livewire:

    use Livewire\Component; class PostDropdown extends Component{    public $showDropdown = false;     public function archive()    {        // ...         $this->showDropdown = false;    }     public function delete()    {        // ...         $this->showDropdown = false;    }}

    <div x-data="{ open: $wire.entangle('showDropdown') }">    <button x-on:click="open = true">Show More...</button>     <ul x-show="open" x-on:click.outside="open = false">        <li><button wire:click="archive">Archive</button></li>         <li><button wire:click="delete">Delete</button></li>    </ul></div>

A user can now toggle the dropdown immediately with Alpine, but when they click a Livewire action like "Archive", the dropdown will be told to close from Livewire. Both Alpine and Livewire are welcome to manipulate their respective properties, and the other will automatically update.

By default, updating the state is deferred (changes on the client, but not immediately on the server) until the next Livewire request. If you need to update the state server-side as soon as the user clicks, chain the `.live` modifier like so:

    <div x-data="{ open: $wire.entangle('showDropdown').live }">    ...</div>

You might not need`$wire.entangle`

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

In most cases, you can achieve what you want by using `$wire` to directly access Livewire properties from Alpine rather than entangling them. Entangling two properties rather than relying on one can cause predictability and performance issues when using deeply nested objects that change frequently. For this reason, `$wire.entangle` has been de-emphasized in Livewire's documentation starting with version 3.

Refrain from using the @entangle directive

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

In Livewire version 2, it was recommended to use Blade's `@entangle` directive. That is no longer the case in v3. `$wire.entangle()` is preferred as it is a more robust utility and avoids certain [issues when removing DOM elements](https://github.com/livewire/livewire/pull/6833#issuecomment-1902260844).

[#](#manually-bundling-alpine-in-your-javascript-build "Permalink")Manually bundling Alpine in your JavaScript build
--------------------------------------------------------------------------------------------------------------------

By default, Livewire and Alpine's JavaScript is injected onto each Livewire page automatically.

This is ideal for simpler setups, however, you may want to include your own Alpine components, stores, and plugins into your project.

To include Livewire and Alpine via your own JavaScript bundle on a page is straightforward.

First, you must include the `@livewireScriptConfig` directive in your layout file like so:

    <html><head>    <!-- ... -->    @livewireStyles    @vite(['resources/js/app.js'])</head><body>    {{ $slot }}     @livewireScriptConfig </body></html>

This allows Livewire to provide your bundle with certain configuration it needs for your app to run properly.

Now you can import Livewire and Alpine in your `resources/js/app.js` file like so:

    import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'; // Register any Alpine directives, components, or plugins here... Livewire.start()

Here is an example of registering a custom Alpine directive called "x-clipboard" in your application:

    import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'; Alpine.directive('clipboard', (el) => {    let text = el.textContent     el.addEventListener('click', () => {        navigator.clipboard.writeText(text)    })}) Livewire.start()

Now the `x-clipboard` directive will be available to all your Alpine components in your Livewire application.

---

## Bundling

Request Bundling
================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Every component update in Livewire triggers a network request. By default, when multiple components trigger updates at the same time, they are bundled into a single request.

This results in fewer network connections to the server and can drastically reduce server load.

In addition to the performance gains, this also unlocks features internally that require collaboration between multiple components ([Reactive Properties](/docs/nesting#reactive-props), [Modelable Properties](/docs/nesting#binding-to-child-data-using-wiremodel), etc.)

However, there are times when disabling this bundling is desired for performance reasons. The following page outlines various ways to customize this behavior in Livewire.

[#](#isolating-component-requests "Permalink")Isolating component requests
--------------------------------------------------------------------------

By using Livewire's `#[Isolate]` class attribute, you can mark a component as "isolated". This means that whenever that component makes a server roundtrip, it will attempt to isolate itself from other component requests.

This is useful if the update is expensive and you'd rather execute this component's update in parallel with others. For example, if multiple components are using `wire:poll` or listening for an event on the page, you may want to isolate specific component whose updates are expensive and would otherwise hold up the entire request.

    use Livewire\Attributes\Isolate;use Livewire\Component; #[Isolate] class ShowPost extends Component{    // ...}

By adding the `#[Isolate]` attribute, this component's requests will no longer be bundled with other component updates.

[#](#lazy-components-are-isolated-by-default "Permalink")Lazy components are isolated by default
------------------------------------------------------------------------------------------------

When many components on a single page are "lazy" loaded (using the `#[Lazy]` attribute), it is often desired that their requests are isolated and sent in parallel. Therefore, Livewire isolates lazy updates by default.

If you wish to disable this behavior, you can pass an `isolate: false` parameter into the `#[Lazy]` attribute like so:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Lazy; #[Lazy(isolate: false)] class Revenue extends Component{    // ...}

Now, if there are multiple `Revenue` components on the same page, all ten updates will be bundled and sent the server as single, lazy-load, network request.

---

## Components

Components
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Components are the building blocks of your Livewire application. They combine state and behavior to create reusable pieces of UI for your front end. Here, we'll cover the basics of creating and rendering components.

[#](#creating-components "Permalink")Creating components
--------------------------------------------------------

A Livewire component is simply a PHP class that extends `Livewire\Component`. You can create component files by hand or use the following Artisan command:

    php artisan make:livewire CreatePost

If you prefer kebab-cased names, you can use them as well:

    php artisan make:livewire create-post

After running this command, Livewire will create two new files in your application. The first will be the component's class: `app/Livewire/CreatePost.php`

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public function render()    {        return view('livewire.create-post');    }}

The second will be the component's Blade view: `resources/views/livewire/create-post.blade.php`

    <div>    {{-- ... --}}</div>

You may use namespace syntax or dot-notation to create your components in sub-directories. For example, the following commands will create a `CreatePost` component in the `Posts` sub-directory:

    php artisan make:livewire Posts\\CreatePostphp artisan make:livewire posts.create-post

### [#](#inline-components "Permalink")Inline components

If your component is fairly small, you may want to create an _inline_ component. Inline components are single-file Livewire components whose view template is contained directly in the `render()` method rather than a separate file:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public function render()    {        return <<<'HTML'         <div>            {{-- Your Blade template goes here... --}}        </div>        HTML;    }}

You can create inline components by adding the `--inline` flag to the `make:livewire` command:

    php artisan make:livewire CreatePost --inline

### [#](#omitting-the-render-method "Permalink")Omitting the render method

To reduce boilerplate in your components, you can omit the `render()` method entirely and Livewire will use its own underlying `render()` method, which returns a view with the conventional name corresponding to your component:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    //}

If the component above is rendered on a page, Livewire will automatically determine it should be rendered using the `livewire.create-post` template.

### [#](#customizing-component-stubs "Permalink")Customizing component stubs

You can customize the files (or _stubs_) Livewire uses to generate new components by running the following command:

    php artisan livewire:stubs

This will create four new files in your application:

*   `stubs/livewire.stub` — used for generating new components
*   `stubs/livewire.inline.stub` — used for generating _inline_ components
*   `stubs/livewire.test.stub` — used for generating test files
*   `stubs/livewire.view.stub` — used for generating component views

Even though these files live in your application, you can still use the `make:livewire` Artisan command and Livewire will automatically use your custom stubs when generating files.

[#](#setting-properties "Permalink")Setting properties
------------------------------------------------------

Livewire components have properties that store data and can be easily accessed within the component's class and Blade view. This section discusses the basics of adding a property to a component and using it in your application.

To add a property to a Livewire component, declare a public property in your component class. For example, let's create a `$title` property in the `CreatePost` component:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public $title = 'Post title...';     public function render()    {        return view('livewire.create-post');    }}

### [#](#accessing-properties-in-the-view "Permalink")Accessing properties in the view

Component properties are automatically made available to the component's Blade view. You can reference it using standard Blade syntax. Here we'll display the value of the `$title` property:

    <div>    <h1>Title: "{{ $title }}"</h1></div>

The rendered output of this component would be:

    <div>    <h1>Title: "Post title..."</h1></div>

### [#](#sharing-additional-data-with-the-view "Permalink")Sharing additional data with the view

In addition to accessing properties from the view, you can explicitly pass data to the view from the `render()` method, like you might typically do from a controller. This can be useful when you want to pass additional data without first storing it as a property—because properties have [specific performance and security implications](/docs/properties#security-concerns).

To pass data to the view in the `render()` method, you can use the `with()` method on the view instance. For example, let's say you want to pass the post author's name to the view. In this case, the post's author is the currently authenticated user:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class CreatePost extends Component{    public $title;     public function render()    {        return view('livewire.create-post')->with([            'author' => Auth::user()->name,        ]);    }}

Now you may access the `$author` property from the component's Blade view:

    <div>    <h1>Title: {{ $title }}</h1>     <span>Author: {{ $author }}</span></div>

### [#](#adding-wirekey-to-foreach-loops "Permalink")Adding `wire:key` to `@foreach` loops

When looping through data in a Livewire template using `@foreach`, you must add a unique `wire:key` attribute to the root element rendered by the loop.

Without a `wire:key` attribute present within a Blade loop, Livewire won't be able to properly match old elements to their new positions when the loop changes. This can cause many hard to diagnose issues in your application.

For example, if you are looping through an array of posts, you may set the `wire:key` attribute to the post's ID:

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">             <!-- ... -->        </div>    @endforeach</div>

If you are looping through an array that is rendering Livewire components you may set the key as a component attribute `:key` or pass the key as a third argument when using the `@livewire` directive.

    <div>    @foreach ($posts as $post)        <livewire:post-item :$post :key="$post->id">         @livewire(PostItem::class, ['post' => $post], key($post->id))    @endforeach</div>

### [#](#binding-inputs-to-properties "Permalink")Binding inputs to properties

One of Livewire's most powerful features is "data binding": the ability to automatically keep properties in-sync with form inputs on the page.

Let's bind the `$title` property from the `CreatePost` component to a text input using the `wire:model` directive:

    <form>    <label for="title">Title:</label>     <input type="text" id="title" wire:model="title"> </form>

Any changes made to the text input will be automatically synchronized with the `$title` property in your Livewire component.

"Why isn't my component live updating as I type?"

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you tried this in your browser and are confused why the title isn't automatically updating, it's because Livewire only updates a component when an "action" is submitted—like pressing a submit button—not when a user types into a field. This cuts down on network requests and improves performance. To enable "live" updating as a user types, you can use `wire:model.live` instead. [Learn more about data binding](/docs/properties#data-binding).

Livewire properties are extremely powerful and are an important concept to understand. For more information, check out the [Livewire properties documentation](/docs/properties).

[#](#calling-actions "Permalink")Calling actions
------------------------------------------------

Actions are methods within your Livewire component that handle user interactions or perform specific tasks. They're often useful for responding to button clicks or form submissions on a page.

To learn more about actions, let's add a `save` action to the `CreatePost` component:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title;     public function save()     {        $post = Post::create([            'title' => $this->title        ]);         return redirect()->to('/posts')             ->with('status', 'Post created!');    }     public function render()    {        return view('livewire.create-post');    }}

Next, let's call the `save` action from the component's Blade view by adding the `wire:submit` directive to the `<form>` element:

    <form wire:submit="save">     <label for="title">Title:</label>     <input type="text" id="title" wire:model="title">     <button type="submit">Save</button></form>

When the "Save" button is clicked, the `save()` method in your Livewire component will be executed and your component will re-render.

To keep learning about Livewire actions, visit the [actions documentation](/docs/actions).

[#](#rendering-components "Permalink")Rendering components
----------------------------------------------------------

There are two ways to render a Livewire component on a page:

1.  Include it within an existing Blade view
2.  Assign it directly to a route as a full-page component

Let's cover the first way to render your component, as it's simpler than the second.

You can include a Livewire component in your Blade templates using the `<livewire:component-name />` syntax:

    <livewire:create-post />

If the component class is nested deeper within the `app/Livewire/` directory, you may use the `.` character to indicate directory nesting. For example, if we assume a component is located at `app/Livewire/EditorPosts/CreatePost.php`, we may render it like so:

    <livewire:editor-posts.create-post />

You must use kebab-case

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

As you can see in the snippets above, you must use the _kebab-cased_ version of the component name. Using the _StudlyCase_ version of the name (`<livewire:CreatePost />`) is invalid and won't be recognized by Livewire.

### [#](#passing-data-into-components "Permalink")Passing data into components

To pass outside data into a Livewire component, you can use attributes on the component tag. This is useful when you want to initialize a component with specific data.

To pass an initial value to the `$title` property of the `CreatePost` component, you can use the following syntax:

    <livewire:create-post title="Initial Title" />

If you need to pass dynamic values or variables to a component, you can write PHP expressions in component attributes by prefixing the attribute with a colon:

    <livewire:create-post :title="$initialTitle" />

Data passed into components is received through the `mount()` lifecycle hook as method parameters. In this case, to assign the `$title` parameter to a property, you would write a `mount()` method like the following:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public $title;     public function mount($title = null)    {        $this->title = $title;    }     // ...}

In this example, the `$title` property will be initialized with the value "Initial Title".

You can think of the `mount()` method as a class constructor. It runs on the initial load of the component, but not on subsequent requests within a page. You can learn more about `mount()` and other helpful lifecycle hooks within the [lifecycle documentation](/docs/lifecycle-hooks).

To reduce boilerplate code in your components, you can alternatively omit the `mount()` method and Livewire will automatically set any properties on your component with names matching the passed in values:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public $title;      // ...}

This is effectively the same as assigning `$title` inside a `mount()` method.

These properties are not reactive by default

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

The `$title` property will not update automatically if the outer `:title="$initialValue"` changes after the initial page load. This is a common point of confusion when using Livewire, especially for developers who have used JavaScript frameworks like Vue or React and assume these "parameters" behave like "reactive props" in those frameworks. But, don't worry, Livewire allows you to opt-in to [making your props reactive](/docs/nesting#reactive-props).

[#](#full-page-components "Permalink")Full-page components
----------------------------------------------------------

Livewire allows you to assign components directly to a route in your Laravel application. These are called "full-page components". You can use them to build standalone pages with logic and views, fully encapsulated within a Livewire component.

To create a full-page component, define a route in your `routes/web.php` file and use the `Route::get()` method to map the component directly to a specific URL. For example, let's imagine you want to render the `CreatePost` component at the dedicated route: `/posts/create`.

You can accomplish this by adding the following line to your `routes/web.php` file:

    use App\Livewire\CreatePost; Route::get('/posts/create', CreatePost::class);

Now, when you visit the `/posts/create` path in your browser, the `CreatePost` component will be rendered as a full-page component.

### [#](#layout-files "Permalink")Layout files

Remember that full-page components will use your application's layout, typically defined in the `resources/views/components/layouts/app.blade.php` file.

You may create this file if it doesn't already exist by running the following command:

    php artisan livewire:layout

This command will generate a file called `resources/views/components/layouts/app.blade.php`.

Ensure you have created a Blade file at this location and included a `{{ $slot }}` placeholder:

    <!-- resources/views/components/layouts/app.blade.php --> <!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">         <title>{{ $title ?? 'Page Title' }}</title>    </head>    <body>        {{ $slot }}    </body></html>

#### [#](#global-layout-configuration "Permalink")Global layout configuration

To use a custom layout across all your components, you can set the `layout` key in `config/livewire.php` to the path of your custom layout, relative to `resources/views`. For example:

    'layout' => 'layouts.app',

With the above configuration, Livewire will render full-page components inside the layout file: `resources/views/layouts/app.blade.php`.

#### [#](#per-component-layout-configuration "Permalink")Per-component layout configuration

To use a different layout for a specific component, you can place Livewire's `#[Layout]` attribute above the component's `render()` method, passing it the relative view path of your custom layout:

    <?php namespace App\Livewire; use Livewire\Attributes\Layout;use Livewire\Component; class CreatePost extends Component{    // ...     #[Layout('layouts.app')]     public function render()    {        return view('livewire.create-post');    }}

Or if you prefer, you can use this attribute above the class declaration:

    <?php namespace App\Livewire; use Livewire\Attributes\Layout;use Livewire\Component; #[Layout('layouts.app')] class CreatePost extends Component{    // ...}

PHP attributes only support literal values. If you need to pass a dynamic value, or prefer this alternative syntax, you can use the fluent `->layout()` method in the component's `render()` method:

    public function render(){    return view('livewire.create-post')         ->layout('layouts.app'); }

Alternatively, Livewire supports using traditional Blade layout files with `@extends`.

Given the following layout file:

    <body>    @yield('content')</body>

You can configure Livewire to reference it using `->extends()` instead of `->layout()`:

    public function render(){    return view('livewire.show-posts')        ->extends('layouts.app'); }

If you need to configure the `@section` for the component to use, you can configure that as well with the `->section()` method:

    public function render(){    return view('livewire.show-posts')        ->extends('layouts.app')        ->section('body'); }

### [#](#setting-the-page-title "Permalink")Setting the page title

Assigning unique page titles to each page in your application is helpful for both users and search engines.

To set a custom page title for a full-page component, first, make sure your layout file includes a dynamic title:

    <head>    <title>{{ $title ?? 'Page Title' }}</title></head>

Next, above your Livewire component's `render()` method, add the `#[Title]` attribute and pass it your page title:

    <?php namespace App\Livewire; use Livewire\Attributes\Title;use Livewire\Component; class CreatePost extends Component{    // ...     #[Title('Create Post')]     public function render()    {        return view('livewire.create-post');    }}

This will set the page title for the `CreatePost` Livewire component. In this example, the page title will be "Create Post" when the component is rendered.

If you prefer, you can use this attribute above the class declaration:

    <?php namespace App\Livewire; use Livewire\Attributes\Title;use Livewire\Component; #[Title('Create Post')] class CreatePost extends Component{    // ...}

If you need to pass a dynamic title, such as a title that uses a component property, you can use the `->title()` fluent method in the component's `render()` method:

    public function render(){    return view('livewire.create-post')         ->title('Create Post'); }

### [#](#setting-additional-layout-file-slots "Permalink")Setting additional layout file slots

If your [layout file](#layout-files) has any named slots in addition to `$slot`, you can set their content in your Blade view by defining `<x-slot>`s outside your root element. For example, if you want to be able to set the page language for each component individually, you can add a dynamic `$lang` slot into the opening HTML tag in your layout file:

    <!-- resources/views/components/layouts/app.blade.php --> <!DOCTYPE html><html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">     <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">         <title>{{ $title ?? 'Page Title' }}</title>    </head>    <body>        {{ $slot }}    </body></html>

Then, in your component view, define an `<x-slot>` element outside the root element:

    <x-slot:lang>fr</x-slot> // This component is in French  <div>    // French content goes here...</div>

### [#](#accessing-route-parameters "Permalink")Accessing route parameters

When working with full-page components, you may need to access route parameters within your Livewire component.

To demonstrate, first, define a route with a parameter in your `routes/web.php` file:

    use App\Livewire\ShowPost; Route::get('/posts/{id}', ShowPost::class);

Here, we've defined a route with an `id` parameter which represents a post's ID.

Next, update your Livewire component to accept the route parameter in the `mount()` method:

    <?php namespace App\Livewire; use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    public Post $post;     public function mount($id)     {        $this->post = Post::findOrFail($id);    }     public function render()    {        return view('livewire.show-post');    }}

In this example, because the parameter name `$id` matches the route parameter `{id}`, if the `/posts/1` URL is visited, Livewire will pass the value of "1" as `$id`.

### [#](#using-route-model-binding "Permalink")Using route model binding

Laravel's route model binding allows you to automatically resolve Eloquent models from route parameters.

After defining a route with a model parameter in your `routes/web.php` file:

    use App\Livewire\ShowPost; Route::get('/posts/{post}', ShowPost::class);

You can now accept the route model parameter through the `mount()` method of your component:

    <?php namespace App\Livewire; use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    public Post $post;     public function mount(Post $post)     {        $this->post = $post;    }     public function render()    {        return view('livewire.show-post');    }}

Livewire knows to use "route model binding" because the `Post` type-hint is prepended to the `$post` parameter in `mount()`.

Like before, you can reduce boilerplate by omitting the `mount()` method:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;      public function render()    {        return view('livewire.show-post');    }}

The `$post` property will automatically be assigned to the model bound via the route's `{post}` parameter.

### [#](#modifying-the-response "Permalink")Modifying the response

In some scenarios, you might want to modify the response and set a custom response header. You can hook into the response object by calling the `response()` method on the view and use a closure to modify the response object:

    <?php namespace App\Livewire; use Livewire\Component;use Illuminate\Http\Response; class ShowPost extends Component{    public function render()    {        return view('livewire.show-post')            ->response(function(Response $response) {                $response->header('X-Custom-Header', true);            });    }}

[#](#using-javascript "Permalink")Using JavaScript
--------------------------------------------------

There are many instances where the built-in Livewire and Alpine utilities aren't enough to accomplish your goals inside your Livewire components.

Fortunately, Livewire provides many useful extension points and utilities to interact with bespoke JavaScript. You can learn from the exhaustive reference on [the JavaScript documentation page](/docs/javascript). But for now, here are a few useful ways to use your own JavaScript inside your Livewire components.

### [#](#executing-scripts "Permalink")Executing scripts

Livewire provides a helpful `@script` directive that, when wrapping a `<script>` element, will execute the given JavaScript when your component is initialized on the page.

Here is an example of a simple `@script` that uses JavaScript's `setInterval()` to refresh your component every two seconds:

    @script<script>    setInterval(() => {        $wire.$refresh()    }, 2000)</script>@endscript

You'll notice we are using an object called `$wire` inside the `<script>` to control the component. Livewire automatically makes this object available inside any `@script`s. If you're unfamiliar with `$wire`, you can learn more about `$wire` in the following documentation:

*   [Accessing properties from JavaScript](/docs/properties#accessing-properties-from-javascript)
*   [Calling Livewire actions from JS/Alpine](/docs/actions#calling-actions-from-alpine)
*   [The `$wire` object reference](/docs/javascript#the-wire-object)

### [#](#loading-assets "Permalink")Loading assets

In addition to one-off `@script`s, Livewire provides a helpful `@assets` utility to easily load any script/style dependencies on the page.

It also ensures that the provided assets are loaded only once per browser page, unlike `@script`, which executes every time a new instance of that Livewire component is initialized.

Here is an example of using `@assets` to load a date picker library called [Pikaday](https://github.com/Pikaday/Pikaday) and initialize it inside your component using `@script`:

    <div>    <input type="text" data-picker></div> @assets<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script><link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">@endassets @script<script>    new Pikaday({ field: $wire.$el.querySelector('[data-picker]') });</script>@endscript

Using`@script` and `@assets` inside Blade components

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you are using [Blade components](https://laravel.com/docs/blade#components) to extract parts of your markup, you can use `@script` and `@assets` inside them as well; even if there are multiple Blade components inside the same Livewire component. However, `@script` and `@assets` are currently only supported in the context of a Livewire component, meaning if you use the given Blade component outside of Livewire entirely, those scripts and assets won't be loaded on the page.

---

## Computed Properties

Computed Properties
===================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Computed properties are a way to create "derived" properties in Livewire. Like accessors on an Eloquent model, computed properties allow you to access values and cache them for future access during the request.

Computed properties are particularly useful in combination with component's public properties.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

To create a computed property, you can add the `#[Computed]` attribute above any method in your Livewire component. Once the attribute has been added to the method, you can access it like any other property.

Make sure you import attribute classes

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Make sure you import any attribute classes. For example, the below `#[Computed]` attribute requires the following import `use Livewire\Attributes\Computed;`.

For example, here's a `ShowUser` component that uses a computed property named `user()` to access a `User` Eloquent model based on a property named `$userId`:

    <?php use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\User; class ShowUser extends Component{    public $userId;     #[Computed]    public function user()    {        return User::find($this->userId);    }     public function follow()    {        Auth::user()->follow($this->user);    }     public function render()    {        return view('livewire.show-user');    }}

    <div>    <h1>{{ $this->user->name }}</h1>     <span>{{ $this->user->email }}</span>     <button wire:click="follow">Follow</button></div>

Because the `#[Computed]` attribute has been added to the `user()` method, the value is accessible in other methods in the component and within the Blade template.

Must use`$this` in your template

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Unlike normal properties, computed properties aren't directly available inside your component's template. Instead, you must access them on the `$this` object. For example, a computed property named `posts()` must be accessed via `$this->posts` inside your template.

Computed properties are not supported on`Livewire\Form` objects.

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Trying to use a Computed property within a [Form](https://livewire.laravel.com/docs/forms) will result in an error when you attempt to access the property in blade using $form->property syntax.

[#](#performance-advantage "Permalink")Performance advantage
------------------------------------------------------------

You may be asking yourself: why use computed properties at all? Why not just call the method directly?

Accessing a method as a computed property offers a performance advantage over calling a method. Internally, when a computed property is executed for the first time, Livewire caches the returned value. This way, any subsequent accesses in the request will return the cached value instead of executing multiple times.

This allows you to freely access a derived value and not worry about the performance implications.

Computed properties are only cached for a single request

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

It's a common misconception that Livewire caches computed properties for the entire lifespan of your Livewire component on a page. However, this isn't the case. Instead, Livewire only caches the result for the duration of a single component request. This means that if your computed property method contains an expensive database query, it will be executed every time your Livewire component performs an update.

### [#](#busting-the-cache "Permalink")Busting the cache

Consider the following problematic scenario:

1.  You access a computed property that depends on a certain property or database state
2.  The underlying property or database state changes
3.  The cached value for the property becomes stale and needs to be re-computed

To clear, or "bust", the stored cache, you can use PHP's `unset()` function.

Below is an example of an action called `createPost()` that, by creating a new post in the application, makes the `posts()` computed stale — meaning the computed property `posts()` needs to be re-computed to include the newly added post:

    <?php use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component; class ShowPosts extends Component{    public function createPost()    {        if ($this->posts->count() > 10) {            throw new \Exception('Maximum post count exceeded');        }         Auth::user()->posts()->create(...);         unset($this->posts);     }     #[Computed]    public function posts()    {        return Auth::user()->posts;    }     // ...}

In the above component, the computed property is cached before a new post is created because the `createPost()` method accesses `$this->posts` before the new post is created. To ensure that `$this->posts` contains the most up-to-date contents when accessed inside the view, the cache is invalidated using `unset($this->posts)`.

### [#](#caching-between-requests "Permalink")Caching between requests

Sometimes you would like to cache the value of a computed property for the lifespan of a Livewire component, rather than it being cleared after every request. In these cases, you can use [Laravel's caching utilities](https://laravel.com/docs/cache#retrieve-store).

Below is an example of a computed property named `user()`, where instead of executing the Eloquent query directly, we wrap the query in `Cache::remember()` to ensure that any future requests retrieve it from Laravel's cache instead of re-executing the query:

    <?php use Illuminate\Support\Facades\Cache;use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\User; class ShowUser extends Component{    public $userId;     #[Computed]    public function user()    {        $key = 'user'.$this->getId();        $seconds = 3600; // 1 hour...         return Cache::remember($key, $seconds, function () {            return User::find($this->userId);        });    }     // ...}

Because each unique instance of a Livewire component has a unique ID, we can use `$this->getId()` to generate a unique cache key that will only be applied to future requests for this same component instance.

But, as you may have noticed, most of this code is predictable and can easily be abstracted. Because of this, Livewire's `#[Computed]` attribute provides a helpful `persist` parameter. By applying `#[Computed(persist: true)]` to a method, you can achieve the same result without any extra code:

    use Livewire\Attributes\Computed;use App\Models\User; #[Computed(persist: true)]public function user(){    return User::find($this->userId);}

In the example above, when `$this->user` is accessed from your component, it will continue to be cached for the duration of the Livewire component on the page. This means the actual Eloquent query will only be executed once.

Livewire caches persisted values for 3600 seconds (one hour). You can override this default by passing an additional `seconds` parameter to the `#[Computed]` attribute:

    #[Computed(persist: true, seconds: 7200)]

Calling`unset()` will bust this cache

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

As previously discussed, you can clear a computed property's cache using PHP's `unset()` method. This also applies to computed properties using the `persist: true` parameter. When calling `unset()` on a cached computed property, Livewire will clear not only the computed property cache, but also the underlying cached value in Laravel's cache.

[#](#caching-across-all-components "Permalink")Caching across all components
----------------------------------------------------------------------------

Instead of caching the value of a computed property for the duration of a single component's lifecycle, you can cache the value of a computed across all components in your application using the `cache: true` parameter provided by the `#[Computed]` attribute:

    use Livewire\Attributes\Computed;use App\Models\Post; #[Computed(cache: true)]public function posts(){    return Post::all();}

In the above example, until the cache expires or is busted, every instance of this component in your application will share the same cached value for `$this->posts`.

If you need to manually clear the cache for a computed property, you may set a custom cache key using the `key` parameter:

    use Livewire\Attributes\Computed;use App\Models\Post; #[Computed(cache: true, key: 'homepage-posts')]public function posts(){    return Post::all();}

[#](#when-to-use-computed-properties "Permalink")When to use computed properties?
---------------------------------------------------------------------------------

In addition to offering performance advantages, there are a few other scenarios where computed properties are helpful.

Specifically, when passing data into your component's Blade template, there are a few occasions where a computed property is a better alternative. Below is an example of a simple component's `render()` method passing a collection of `posts` to a Blade template:

    public function render(){    return view('livewire.show-posts', [        'posts' => Post::all(),    ]);}

    <div>    @foreach ($posts as $post)        <!-- ... -->    @endforeach</div>

Although this is sufficient for many use cases, here are three scenarios where a computed property would be a better alternative:

### [#](#conditionally-accessing-values "Permalink")Conditionally accessing values

If you are conditionally accessing a value that is computationally expensive to retrieve in your Blade template, you can reduce performance overhead using a computed property.

Consider the following template without a computed property:

    <div>    @if (Auth::user()->can_see_posts)        @foreach ($posts as $post)            <!-- ... -->        @endforeach    @endif</div>

If a user is restricted from viewing posts, the database query to retrieve the posts has already been made, yet the posts are never used in the template.

Here's a version of the above scenario using a computed property instead:

    use Livewire\Attributes\Computed;use App\Models\Post; #[Computed]public function posts(){    return Post::all();} public function render(){    return view('livewire.show-posts');}

    <div>    @if (Auth::user()->can_see_posts)        @foreach ($this->posts as $post)            <!-- ... -->        @endforeach    @endif</div>

Now, because we are providing the posts to the template using a computed property, we only execute the database query when the data is needed.

### [#](#using-inline-templates "Permalink")Using inline templates

Another scenario when computed properties are helpful is using [inline templates](/docs/components#inline-components) in your component.

Below is an example of an inline component where, because we are returning a template string directly inside `render()`, we never have an opportunity to pass data into the view:

    <?php use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    #[Computed]    public function posts()    {        return Post::all();    }     public function render()    {        return <<<HTML        <div>            @foreach ($this->posts as $post)                <!-- ... -->            @endforeach        </div>        HTML;    }}

In the above example, without a computed property, we would have no way to explicitly pass data into the Blade template.

### [#](#omitting-the-render-method "Permalink")Omitting the render method

In Livewire, another way to cut down on boilerplate in your components is by omitting the `render()` method entirely. When omitted, Livewire will use its own `render()` method returning the corresponding Blade view by convention.

In these case, you obviously don't have a `render()` method from which you can pass data into a Blade view.

Rather than re-introducing the `render()` method into your component, you can instead provide that data to the view via computed properties:

    <?php use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    #[Computed]    public function posts()    {        return Post::all();    }}

    <div>    @foreach ($this->posts as $post)        <!-- ... -->    @endforeach</div>

---

## Contribution Guide

Contribution Guide
==================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Hi there and welcome to the Livewire contribution guide. In this guide, we are going to take a look at how you can contribute to Livewire by submitting new features, fixing failing tests, or resolving bugs.

[#](#setting-up-livewire-and-alpine-locally "Permalink")Setting up Livewire and Alpine locally
----------------------------------------------------------------------------------------------

To contribute, the easiest way is to ensure that the Livewire and Alpine repositories are set up on your local machine. This will allow you to make changes and run the test suite with ease.

### [#](#forking-and-cloning-the-repositories "Permalink")Forking and cloning the repositories

To get started, the first step is to fork and clone the repositories. The easiest way to do this is by using the [GitHub CLI](https://cli.github.com/), but you can also perform these steps manually by clicking the "Fork" button on the GitHub [repository page](https://github.com/livewire/livewire).

    # Fork and clone Livewiregh repo fork livewire/livewire --default-branch-only --clone=true --remote=false -- livewire # Switch the working directory to livewirecd livewire # Install all composer dependenciescomposer install # Ensure Dusk is correctly configuredvendor/bin/dusk-updater detect --no-interaction

To set up Alpine, make sure you have [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) installed, and then run the following commands. If you prefer to fork manually, you can visit the [repository page](https://github.com/alpinejs/alpine).

    # Fork and clone Alpinegh repo fork alpinejs/alpine --default-branch-only --clone=true --remote=false -- alpine # Switch the working directory to alpinecd alpine # Install all npm dependenciesnpm install # Build all Alpine packagesnpm run build # Link all Alpine packages locallycd packages/alpinejs && npm link && cd ../../cd packages/anchor && npm link && cd ../../cd packages/collapse && npm link && cd ../../cd packages/csp && npm link && cd ../../cd packages/docs && npm link && cd ../../cd packages/focus && npm link && cd ../../cd packages/history && npm link && cd ../../cd packages/intersect && npm link && cd ../../cd packages/mask && npm link && cd ../../cd packages/morph && npm link && cd ../../cd packages/navigate && npm link && cd ../../cd packages/persist && npm link && cd ../../cd packages/sort && npm link && cd ../../cd packages/ui && npm link && cd ../../ # Switch the working directory back to livewirecd ../livewire # Link all packagesnpm link alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/csp @alpinejs/docs @alpinejs/focus @alpinejs/history @alpinejs/intersect @alpinejs/mask @alpinejs/morph @alpinejs/navigate @alpinejs/persist @alpinejs/sort @alpinejs/ui # Build Livewirenpm run build

[#](#contributing-a-failing-test "Permalink")Contributing a Failing Test
------------------------------------------------------------------------

If you're encountering a bug and are unsure about how to solve it, especially given the complexity of the Livewire core, you might be wondering where to start. In such cases, the easiest approach is to contribute a failing test. This way, someone with more experience can assist in identifying and fixing the bug. Nonetheless, we do recommend that you also explore the core to gain a better understanding of how Livewire operates.

Let's take a step-by-step approach.

#### [#](#1-determine-where-to-add-your-test "Permalink")1\. Determine where to add your test

The Livewire core is divided into different folders, each corresponding to specific Livewire features. For example:

    src/Features/SupportAccessingParentsrc/Features/SupportAttributessrc/Features/SupportAutoInjectedAssetssrc/Features/SupportBladeAttributessrc/Features/SupportChecksumErrorDebuggingsrc/Features/SupportComputedsrc/Features/SupportConsoleCommandssrc/Features/SupportDataBinding//...

Try to locate a feature that is related to the bug you are experiencing. If you can't find an appropriate folder or if you're unsure about which one to select, you can simply choose one and mention in your pull request that you require assistance with placing the test in the correct feature set.

#### [#](#2-determine-the-type-of-test "Permalink")2\. Determine the type of test

The Livewire test suite consists of two types of tests:

1.  **Unit tests**: These tests focus on the PHP implementation of Livewire.
2.  **Browser tests**: These tests run a series of steps inside a real browser and assert the correct outcome. They mainly focus on the Javascript implementation of Livewire.

If you're unsure about which type of test to choose or if you're unfamiliar with writing tests for Livewire, you can start with a browser test. Implement the steps you perform in your application and browser to reproduce the bug.

Unit tests should be added to the `UnitTest.php` file, and browser tests should be added to `BrowserTest.php`. If one or both of these files do not exist, you can create them yourself.

**Unit test**

    use Tests\TestCase; class UnitTest extends TestCase{    /** @test */    public function livewire_can_run_action(): void    {       // ...    }}

**Browser test**

    use Tests\BrowserTestCase; class BrowserTest extends BrowserTestCase{    /** @test */    public function livewire_can_run_action()    {        // ...    }}

Not sure how to write tests?

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

You can learn a lot by explore existing Unit and Browser tests to learn how tests are written. Even copying and pasting an existing test is a great starting point for writing your own test.

#### [#](#3-preparing-your-pull-request-branch "Permalink")3\. Preparing your pull request branch

Once you have completed your feature or failing test, it's time to submit your Pull Request (PR) to the Livewire repository. First, ensure that you commit your changes to a separate branch (avoid using `main`). To create a new branch, you can use the `git` command:

    git checkout -b my-feature

You can name your branch anything you want, but for future reference, it's helpful to use a descriptive name that reflects your feature or failing test.

Next, commit your changes to your branch. You can use `git add .` to stage all changes and then `git commit -m "Add my feature"` to commit all changes with a descriptive commit message.

However, your branch is currently only available on your local machine. To create a Pull Request, you need to push your branch to your forked Livewire repository using `git push`.

    git push origin my-feature Enumerating objects: 13, done.Counting objects: 100% (13/13), done.Delta compression using up to 8 threadsCompressing objects: 100% (6/6), done. To github.com:Username/livewire.git * [new branch]        my-feature -> my-feature

#### [#](#4-submitting-your-pull-request "Permalink")4\. Submitting your pull request

We're almost there! Open your web browser and navigate to your forked Livewire repository (`https://github.com/<your-username>/livewire`). In the center of your screen, you will see a new notification: "**my-feature had recent pushes 1 minute ago**" along with a button that says "**Compare & pull request**." Click the button to open the pull request form.

In the form, provide a title that describes your pull request and then proceed to the description section. The text area already contains a predefined template. Try to answer every question:

    Review the contribution guide first at: https://livewire.laravel.com/docs/contribution-guide 1️⃣ Is this something that is wanted/needed? Did you create a discussion about it first?Yes, you can find the discussion here: https://github.com/livewire/livewire/discussions/999999 2️⃣ Did you create a branch for your fix/feature? (Main branch PR's will be closed)Yes, the branch is named `my-feature` 3️⃣ Does it contain multiple, unrelated changes? Please separate the PRs out.No, the changes are only related to my feature. 4️⃣ Does it include tests? (Required)Yes 5️⃣ Please include a thorough description (including small code snippets if possible) of the improvement and reasons why it's useful. These changes will improve memory usage. You can see the benchmark results here: // ...

All set? Click on **Create pull request** 🚀 Congratulations! You've successfully created your first contribution 🎉

The maintainers will review your PR and may provide feedback or request changes. Please make an effort to address any feedback as soon as possible.

Thank you for contributing to Livewire!

---

## Downloads

File Downloads
==============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

File downloads in Livewire work much the same as in Laravel itself. Typically, you can use any Laravel download utility inside a Livewire component, and it should work as expected.

However, behind the scenes, file downloads are handled differently than in a standard Laravel application. When using Livewire, the file's contents are Base64 encoded, sent to the frontend, and decoded back into binary to be downloaded directly from the client.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Triggering a file download in Livewire is as simple as returning a standard Laravel download response.

Below is an example of a `ShowInvoice` component that contains a "Download" button to download the invoice PDF:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Invoice; class ShowInvoice extends Component{    public Invoice $invoice;     public function mount(Invoice $invoice)    {        $this->invoice = $invoice;    }     public function download()    {        return response()->download(             $this->invoice->file_path, 'invoice.pdf'        );    }     public function render()    {        return view('livewire.show-invoice');    }}

    <div>    <h1>{{ $invoice->title }}</h1>     <span>{{ $invoice->date }}</span>    <span>{{ $invoice->amount }}</span>     <button type="button" wire:click="download">Download</button> </div>

Just like in a Laravel controller, you can also use the `Storage` facade to initiate downloads:

    public function download(){    return Storage::disk('invoices')->download('invoice.csv');}

[#](#streaming-downloads "Permalink")Streaming downloads
--------------------------------------------------------

Livewire can also stream downloads; however, they aren't truly streamed. The download isn't triggered until the file's contents are collected and delivered to the browser:

    public function download(){    return response()->streamDownload(function () {        echo '...'; // Echo download contents directly...    }, 'invoice.pdf');}

[#](#testing-file-downloads "Permalink")Testing file downloads
--------------------------------------------------------------

Livewire also provides a `->assertFileDownloaded()` method to easily test that a file was downloaded with a given name:

    use App\Models\Invoice; /** @test */public function can_download_invoice(){    $invoice = Invoice::factory();     Livewire::test(ShowInvoice::class)        ->call('download')        ->assertFileDownloaded('invoice.pdf');}

You can also test to ensure a file was not downloaded using the `->assertNoFileDownloaded()` method:

    use App\Models\Invoice; /** @test */public function does_not_download_invoice_if_unauthorised(){    $invoice = Invoice::factory();     Livewire::test(ShowInvoice::class)        ->call('download')        ->assertNoFileDownloaded();}

---

## Events

Events
======

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire offers a robust event system that you can use to communicate between different components on the page. Because it uses browser events under the hood, you can also use Livewire's event system to communicate with Alpine components or even plain, vanilla JavaScript.

To trigger an event, you may use the `dispatch()` method from anywhere inside your component and listen for that event from any other component on the page.

[#](#dispatching-events "Permalink")Dispatching events
------------------------------------------------------

To dispatch an event from a Livewire component, you can call the `dispatch()` method, passing it the event name and any additional data you want to send along with the event.

Below is an example of dispatching a `post-created` event from a `CreatePost` component:

    use Livewire\Component; class CreatePost extends Component{    public function save()    {        // ...         $this->dispatch('post-created');     }}

In this example, when the `dispatch()` method is called, the `post-created` event will be dispatched, and every other component on the page that is listening for this event will be notified.

You can pass additional data with the event by passing the data as the second parameter to the `dispatch()` method:

    $this->dispatch('post-created', title: $post->title);

[#](#listening-for-events "Permalink")Listening for events
----------------------------------------------------------

To listen for an event in a Livewire component, add the `#[On]` attribute above the method you want to be called when a given event is dispatched:

Make sure you import attribute classes

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Make sure you import any attribute classes. For example, the below `#[On()]` attributes requires the following import `use Livewire\Attributes\On;`.

    use Livewire\Component;use Livewire\Attributes\On;  class Dashboard extends Component{    #[On('post-created')]     public function updatePostList($title)    {        // ...    }}

Now, when the `post-created` event is dispatched from `CreatePost`, a network request will be triggered and the `updatePostList()` action will be invoked.

As you can see, additional data sent with the event will be provided to the action as its first argument.

### [#](#listening-for-dynamic-event-names "Permalink")Listening for dynamic event names

Occasionally, you may want to dynamically generate event listener names at run-time using data from your component.

For example, if you wanted to scope an event listener to a specific Eloquent model, you could append the model's ID to the event name when dispatching like so:

    use Livewire\Component; class UpdatePost extends Component{    public function update()    {        // ...         $this->dispatch("post-updated.{$post->id}");     }}

And then listen for that specific model:

    use Livewire\Component;use App\Models\Post;use Livewire\Attributes\On;  class ShowPost extends Component{    public Post $post;     #[On('post-updated.{post.id}')]     public function refreshPost()    {        // ...    }}

If the above `$post` model had an ID of `3`, the `refreshPost()` method would only be triggered by an event named: `post-updated.3`.

### [#](#listening-for-events-from-specific-child-components "Permalink")Listening for events from specific child components

Livewire allows you to listen for events directly on individual child components in your Blade template like so:

    <div>    <livewire:edit-post @saved="$refresh">     <!-- ... --></div>

In the above scenario, if the `edit-post` child component dispatches a `saved` event, the parent's `$refresh` will be called and the parent will be refreshed.

Instead of passing `$refresh`, you can pass any method you normally would to something like `wire:click`. Here's an example of calling a `close()` method that might do something like close a modal dialog:

    <livewire:edit-post @saved="close">

If the child dispatched parameters along with the request, for example `$this->dispatch('saved', postId: 1)`, you can forward those values to the parent method using the following syntax:

    <livewire:edit-post @saved="close($event.detail.postId)">

[#](#using-javascript-to-interact-with-events "Permalink")Using JavaScript to interact with events
--------------------------------------------------------------------------------------------------

Livewire's event system becomes much more powerful when you interact with it from JavaScript inside your application. This unlocks the ability for any other JavaScript in your app to communicate with Livewire components on the page.

### [#](#listening-for-events-inside-component-scripts "Permalink")Listening for events inside component scripts

You can easily listen for the `post-created` event inside your component's template from a `@script` directive like so:

    @script<script>    $wire.on('post-created', () => {        //    });</script>@endscript

The above snippet would listen for the `post-created` from the component it's registered within. If the component is no longer on the page, the event listener will no longer be triggered.

[Read more about using JavaScript inside your Livewire components →](/docs/javascript#using-javascript-in-livewire-components)

### [#](#dispatching-events-from-component-scripts "Permalink")Dispatching events from component scripts

Additionally, you can dispatch events from within a component's `@script` like so:

    @script<script>    $wire.dispatch('post-created');</script>@endscript

When the above `@script` is run, the `post-created` event will be dispatched to the component it's defined within.

To dispatch the event only to the component where the script resides and not other components on the page (preventing the event from "bubbling" up), you can use `dispatchSelf()`:

    $wire.dispatchSelf('post-created');

You can pass any additional parameters to the event by passing an object as a second argument to `dispatch()`:

    @script<script>    $wire.dispatch('post-created', { refreshPosts: true });</script>@endscript

You can now access those event parameters from both your Livewire class and also other JavaScript event listeners.

Here's an example of receiving the `refreshPosts` parameter within a Livewire class:

    use Livewire\Attributes\On; // ... #[On('post-created')]public function handleNewPost($refreshPosts = false){    //}

You can also access the `refreshPosts` parameter from a JavaScript event listener from the event's `detail` property:

    @script<script>    $wire.on('post-created', (event) => {        let refreshPosts = event.detail.refreshPosts         // ...    });</script>@endscript

[Read more about using JavaScript inside your Livewire components →](/docs/javascript#using-javascript-in-livewire-components)

### [#](#listening-for-livewire-events-from-global-javascript "Permalink")Listening for Livewire events from global JavaScript

Alternatively, you can listen for Livewire events globally using `Livewire.on` from any script in your application:

    <script>    document.addEventListener('livewire:init', () => {       Livewire.on('post-created', (event) => {           //       });    });</script>

The above snippet would listen for the `post-created` event dispatched from any component on the page.

If you wish to remove this event listener for any reason, you can do so using the returned `cleanup` function:

    <script>    document.addEventListener('livewire:init', () => {        let cleanup = Livewire.on('post-created', (event) => {            //        });         // Calling "cleanup()" will un-register the above event listener...        cleanup();    });</script>

[#](#events-in-alpine "Permalink")Events in Alpine
--------------------------------------------------

Because Livewire events are plain browser events under the hood, you can use Alpine to listen for them or even dispatch them.

### [#](#listening-for-livewire-events-in-alpine "Permalink")Listening for Livewire events in Alpine

For example, we may easily listen for the `post-created` event using Alpine:

    <div x-on:post-created="..."></div>

The above snippet would listen for the `post-created` event from any Livewire components that are children of the HTML element that the `x-on` directive is assigned to.

To listen for the event from any Livewire component on the page, you can add `.window` to the listener:

    <div x-on:post-created.window="..."></div>

If you want to access additional data that was sent with the event, you can do so using `$event.detail`:

    <div x-on:post-created="notify('New post: ' + $event.detail.title)"></div>

The Alpine documentation provides further information on [listening for events](https://alpinejs.dev/directives/on).

### [#](#dispatching-livewire-events-from-alpine "Permalink")Dispatching Livewire events from Alpine

Any event dispatched from Alpine is capable of being intercepted by a Livewire component.

For example, we may easily dispatch the `post-created` event from Alpine:

    <button @click="$dispatch('post-created')">...</button>

Like Livewire's `dispatch()` method, you can pass additional data along with the event by passing the data as the second parameter to the method:

    <button @click="$dispatch('post-created', { title: 'Post Title' })">...</button>

To learn more about dispatching events using Alpine, consult the [Alpine documentation](https://alpinejs.dev/magics/dispatch).

You might not need events

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you are using events to call behavior on a parent from a child, you can instead call the action directly from the child using `$parent` in your Blade template. For example:

    <button wire:click="$parent.showCreatePostForm()">Create Post</button>

[Learn more about $parent](/docs/nesting#directly-accessing-the-parent-from-the-child).

[#](#dispatching-directly-to-another-component "Permalink")Dispatching directly to another component
----------------------------------------------------------------------------------------------------

If you want to use events for communicating directly between two components on the page, you can use the `dispatch()->to()` modifier.

Below is an example of the `CreatePost` component dispatching the `post-created` event directly to the `Dashboard` component, skipping any other components listening for that specific event:

    use Livewire\Component; class CreatePost extends Component{    public function save()    {        // ...         $this->dispatch('post-created')->to(Dashboard::class);    }}

[#](#dispatching-a-component-event-to-itself "Permalink")Dispatching a component event to itself
------------------------------------------------------------------------------------------------

Using the `dispatch()->self()` modifier, you can restrict an event to only being intercepted by the component it was triggered from:

    use Livewire\Component; class CreatePost extends Component{    public function save()    {        // ...         $this->dispatch('post-created')->self();    }}

[#](#dispatching-events-from-blade-templates "Permalink")Dispatching events from Blade templates
------------------------------------------------------------------------------------------------

You can dispatch events directly from your Blade templates using the `$dispatch` JavaScript function. This is useful when you want to trigger an event from a user interaction, such as a button click:

    <button wire:click="$dispatch('show-post-modal', { id: {{ $post->id }} })">    EditPost</button>

In this example, when the button is clicked, the `show-post-modal` event will be dispatched with the specified data.

If you want to dispatch an event directly to another component you can use the `$dispatchTo()` JavaScript function:

    <button wire:click="$dispatchTo('posts', 'show-post-modal', { id: {{ $post->id }} })">    EditPost</button>

In this example, when the button is clicked, the `show-post-modal` event will be dispatched directly to the `Posts` component.

[#](#testing-dispatched-events "Permalink")Testing dispatched events
--------------------------------------------------------------------

To test events dispatched by your component, use the `assertDispatched()` method in your Livewire test. This method checks that a specific event has been dispatched during the component's lifecycle:

    <?php namespace Tests\Feature; use Illuminate\Foundation\Testing\RefreshDatabase;use App\Livewire\CreatePost;use Livewire\Livewire; class CreatePostTest extends TestCase{    use RefreshDatabase;     /** @test */    public function it_dispatches_post_created_event()    {        Livewire::test(CreatePost::class)            ->call('save')            ->assertDispatched('post-created');    }}

In this example, the test ensures that the `post-created` event is dispatched with the specified data when the `save()` method is called on the `CreatePost` component.

### [#](#testing-event-listeners "Permalink")Testing Event Listeners

To test event listeners, you can dispatch events from the test environment and assert that the expected actions are performed in response to the event:

    <?php namespace Tests\Feature; use Illuminate\Foundation\Testing\RefreshDatabase;use App\Livewire\Dashboard;use Livewire\Livewire; class DashboardTest extends TestCase{    use RefreshDatabase;     /** @test */    public function it_updates_post_count_when_a_post_is_created()    {        Livewire::test(Dashboard::class)            ->assertSee('Posts created: 0')            ->dispatch('post-created')            ->assertSee('Posts created: 1');    }}

In this example, the test dispatches the `post-created` event, then checks that the `Dashboard` component properly handles the event and displays the updated count.

[#](#real-time-events-using-laravel-echo "Permalink")Real-time events using Laravel Echo
----------------------------------------------------------------------------------------

Livewire pairs nicely with [Laravel Echo](https://laravel.com/docs/broadcasting#client-side-installation) to provide real-time functionality on your web-pages using WebSockets.

Installing Laravel Echo is a prerequisite

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

This feature assumes you have installed Laravel Echo and the `window.Echo` object is globally available in your application. For more information on installing echo, check out the [Laravel Echo documentation](https://laravel.com/docs/broadcasting#client-side-installation).

### [#](#listening-for-echo-events "Permalink")Listening for Echo events

Imagine you have an event in your Laravel application named `OrderShipped`:

    <?php namespace App\Events; use App\Models\Order;use Illuminate\Broadcasting\Channel;use Illuminate\Broadcasting\InteractsWithSockets;use Illuminate\Contracts\Broadcasting\ShouldBroadcast;use Illuminate\Foundation\Events\Dispatchable;use Illuminate\Queue\SerializesModels; class OrderShipped implements ShouldBroadcast{    use Dispatchable, InteractsWithSockets, SerializesModels;     public Order $order;     public function broadcastOn()    {        return new Channel('orders');    }}

You might dispatch this event from another part of your application like so:

    use App\Events\OrderShipped; OrderShipped::dispatch();

If you were to listen for this event in JavaScript using only Laravel Echo, it would look something like this:

    Echo.channel('orders')    .listen('OrderShipped', e => {        console.log(e.order)    })

Assuming you have Laravel Echo installed and configured, you can listen for this event from inside a Livewire component.

Below is an example of an `OrderTracker` component that is listening for the `OrderShipped` event in order to show users a visual indication of a new order:

    <?php namespace App\Livewire; use Livewire\Attributes\On; use Livewire\Component; class OrderTracker extends Component{    public $showNewOrderNotification = false;     #[On('echo:orders,OrderShipped')]    public function notifyNewOrder()    {        $this->showNewOrderNotification = true;    }     // ...}

If you have Echo channels with variables embedded in them (such as an Order ID), you can define listeners via the `getListeners()` method instead of the `#[On]` attribute:

    <?php namespace App\Livewire; use Livewire\Attributes\On; use Livewire\Component;use App\Models\Order; class OrderTracker extends Component{    public Order $order;     public $showOrderShippedNotification = false;     public function getListeners()    {        return [            "echo:orders.{$this->order->id},OrderShipped" => 'notifyShipped',        ];    }     public function notifyShipped()    {        $this->showOrderShippedNotification = true;    }     // ...}

Or, if you prefer, you can use the dynamic event name syntax:

    #[On('echo:orders.{order.id},OrderShipped')]public function notifyNewOrder(){    $this->showNewOrderNotification = true;}

If you need to access the event payload, you can do so via the passed in `$event` parameter:

    #[On('echo:orders.{order.id},OrderShipped')]public function notifyNewOrder($event){    $order = Order::find($event['orderId']);     //}

### [#](#private--presence-channels "Permalink")Private & presence channels

You may also listen to events broadcast to private and presence channels:

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before proceeding, ensure you have defined [Authentication Callbacks](https://laravel.com/docs/master/broadcasting#defining-authorization-callbacks) for your broadcast channels.

    <?php namespace App\Livewire; use Livewire\Component; class OrderTracker extends Component{    public $showNewOrderNotification = false;     public function getListeners()    {        return [            // Public Channel            "echo:orders,OrderShipped" => 'notifyNewOrder',             // Private Channel            "echo-private:orders,OrderShipped" => 'notifyNewOrder',             // Presence Channel            "echo-presence:orders,OrderShipped" => 'notifyNewOrder',            "echo-presence:orders,here" => 'notifyNewOrder',            "echo-presence:orders,joining" => 'notifyNewOrder',            "echo-presence:orders,leaving" => 'notifyNewOrder',        ];    }     public function notifyNewOrder()    {        $this->showNewOrderNotification = true;    }}

---

## Forms

Forms
=====

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Because forms are the backbone of most web applications, Livewire provides loads of helpful utilities for building them. From handling simple input elements to complex things like real-time validation or file uploading, Livewire has simple, well-documented tools to make your life easier and delight your users.

Let's dive in.

[#](#submitting-a-form "Permalink")Submitting a form
----------------------------------------------------

Let's start by looking at a very simple form in a `CreatePost` component. This form will have two simple text inputs and a submit button, as well as some code on the backend to manage the form's state and submission:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        Post::create(            $this->only(['title', 'content'])        );         session()->flash('status', 'Post successfully updated.');         return $this->redirect('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit="save">    <input type="text" wire:model="title">     <input type="text" wire:model="content">     <button type="submit">Save</button></form>

As you can see, we are "binding" the public `$title` and `$content` properties in the form above using `wire:model`. This is one of the most commonly used and powerful features of Livewire.

In addition to binding `$title` and `$content`, we are using `wire:submit` to capture the `submit` event when the "Save" button is clicked and invoking the `save()` action. This action will persist the form input to the database.

After the new post is created in the database, we redirect the user to the `ShowPosts` component page and show them a "flash" message that the new post was created.

### [#](#adding-validation "Permalink")Adding validation

To avoid storing incomplete or dangerous user input, most forms need some sort of input validation.

Livewire makes validating your forms as simple as adding `#[Validate]` attributes above the properties you want to be validated.

Once a property has a `#[Validate]` attribute attached to it, the validation rule will be applied to the property's value any time it's updated server-side.

Let's add some basic validation rules to the `$title` and `$content` properties in our `CreatePost` component:

    <?php namespace App\Livewire; use Livewire\Attributes\Validate; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    #[Validate('required')]     public $title = '';     #[Validate('required')]     public $content = '';     public function save()    {        $this->validate();          Post::create(            $this->only(['title', 'content'])        );         return $this->redirect('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

We'll also modify our Blade template to show any validation errors on the page.

    <form wire:submit="save">    <input type="text" wire:model="title">    <div>        @error('title') <span class="error">{{ $message }}</span> @enderror     </div>     <input type="text" wire:model="content">    <div>        @error('content') <span class="error">{{ $message }}</span> @enderror     </div>     <button type="submit">Save</button></form>

Now, if the user tries to submit the form without filling in any of the fields, they will see validation messages telling them which fields are required before saving the post.

Livewire has a lot more validation features to offer. For more information, visit our [dedicated documentation page on Validation](/docs/validation).

### [#](#extracting-a-form-object "Permalink")Extracting a form object

If you are working with a large form and prefer to extract all of its properties, validation logic, etc., into a separate class, Livewire offers form objects.

Form objects allow you to re-use form logic across components and provide a nice way to keep your component class cleaner by grouping all form-related code into a separate class.

You can either create a form class by hand or use the convenient artisan command:

    php artisan livewire:form PostForm

The above command will create a file called `app/Livewire/Forms/PostForm.php`.

Let's rewrite the `CreatePost` component to use a `PostForm` class:

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use Livewire\Form; class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';     #[Validate('required|min:5')]    public $content = '';}

    <?php namespace App\Livewire; use App\Livewire\Forms\PostForm;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public PostForm $form;      public function save()    {        $this->validate();         Post::create(            $this->form->all()         );         return $this->redirect('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit="save">    <input type="text" wire:model="form.title">    <div>        @error('form.title') <span class="error">{{ $message }}</span> @enderror    </div>     <input type="text" wire:model="form.content">    <div>        @error('form.content') <span class="error">{{ $message }}</span> @enderror    </div>     <button type="submit">Save</button></form>

If you'd like, you can also extract the post creation logic into the form object like so:

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use App\Models\Post;use Livewire\Form; class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';     #[Validate('required|min:5')]    public $content = '';     public function store()     {        $this->validate();         Post::create($this->all());    }}

Now you can call `$this->form->store()` from the component:

    class CreatePost extends Component{    public PostForm $form;     public function save()    {        $this->form->store();          return $this->redirect('/posts');    }     // ...}

If you want to use this form object for both a create and update form, you can easily adapt it to handle both use cases.

Here's what it would look like to use this same form object for an `UpdatePost` component and fill it with initial data:

    <?php namespace App\Livewire; use App\Livewire\Forms\PostForm;use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public PostForm $form;     public function mount(Post $post)    {        $this->form->setPost($post);    }     public function save()    {        $this->form->update();         return $this->redirect('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use Livewire\Form;use App\Models\Post; class PostForm extends Form{    public ?Post $post;     #[Validate('required|min:5')]    public $title = '';     #[Validate('required|min:5')]    public $content = '';     public function setPost(Post $post)    {        $this->post = $post;         $this->title = $post->title;         $this->content = $post->content;    }     public function store()    {        $this->validate();         Post::create($this->only(['title', 'content']));    }     public function update()    {        $this->validate();         $this->post->update(            $this->all()        );    }}

As you can see, we've added a `setPost()` method to the `PostForm` object to optionally allow for filling the form with existing data as well as storing the post on the form object for later use. We've also added an `update()` method for updating the existing post.

Form objects are not required when working with Livewire, but they do offer a nice abstraction for keeping your components free of repetitive boilerplate.

### [#](#resetting-form-fields "Permalink")Resetting form fields

If you are using a form object, you may want to reset the form after it has been submitted. This can be done by calling the `reset()` method:

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use App\Models\Post;use Livewire\Form; class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';     #[Validate('required|min:5')]    public $content = '';     // ...     public function store()    {        $this->validate();         Post::create($this->all());         $this->reset();     }}

You can also reset specific properties by passing the property names into the `reset()` method:

    $this->reset('title'); // Or multiple at once... $this->reset(['title', 'content']);

### [#](#pulling-form-fields "Permalink")Pulling form fields

Alternatively, you can use the `pull()` method to both retrieve a form's properties and reset them in one operation.

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use App\Models\Post;use Livewire\Form; class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';     #[Validate('required|min:5')]    public $content = '';     // ...     public function store()    {        $this->validate();         Post::create(            $this->pull()         );    }}

You can also pull specific properties by passing the property names into the `pull()` method:

    // Return a value before resetting...$this->pull('title');  // Return a key-value array of properties before resetting...$this->pull(['title', 'content']);

### [#](#using-rule-objects "Permalink")Using Rule objects

If you have more sophisticated validation scenarios where Laravel's `Rule` objects are necessary, you can alternatively define a `rules()` method to declare your validation rules like so:

    <?php namespace App\Livewire\Forms; use Illuminate\Validation\Rule;use App\Models\Post;use Livewire\Form; class PostForm extends Form{    public ?Post $post;     public $title = '';     public $content = '';     protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),             ],            'content' => 'required|min:5',        ];    }     // ...     public function update()    {        $this->validate();         $this->post->update($this->all());         $this->reset();    }}

When using a `rules()` method instead of `#[Validate]`, Livewire will only run the validation rules when you call `$this->validate()`, rather than every time a property is updated.

If you are using real-time validation or any other scenario where you'd like Livewire to validate specific fields after every request, you can use `#[Validate]` without any provided rules like so:

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use Illuminate\Validation\Rule;use App\Models\Post;use Livewire\Form; class PostForm extends Form{    public ?Post $post;     #[Validate]     public $title = '';     public $content = '';     protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),            ],            'content' => 'required|min:5',        ];    }     // ...     public function update()    {        $this->validate();         $this->post->update($this->all());         $this->reset();    }}

Now if the `$title` property is updated before the form is submitted—like when using [`wire:model.blur`](/docs/wire-model#updating-on-blur-event)—the validation for `$title` will be run.

### [#](#showing-a-loading-indicator "Permalink")Showing a loading indicator

By default, Livewire will automatically disable submit buttons and mark inputs as `readonly` while a form is being submitted, preventing the user from submitting the form again while the first submission is being handled.

However, it can be difficult for users to detect this "loading" state without extra affordances in your application's UI.

Here's an example of adding a small loading spinner to the "Save" button via `wire:loading` so that a user understands that the form is being submitted:

    <button type="submit">    Save     <div wire:loading>        <svg>...</svg> <!-- SVG loading spinner -->    </div></button>

Now, when a user presses "Save", a small, inline spinner will show up.

Livewire's `wire:loading` feature has a lot more to offer. Visit the [Loading documentation to learn more.](/docs/wire-loading)

[#](#live-updating-fields "Permalink")Live-updating fields
----------------------------------------------------------

By default, Livewire only sends a network request when the form is submitted (or any other [action](/docs/actions) is called), not while the form is being filled out.

Take the `CreatePost` component, for example. If you want to make sure the "title" input field is synchronized with the `$title` property on the backend as the user types, you may add the `.live` modifier to `wire:model` like so:

    <input type="text" wire:model.live="title">

Now, as a user types into this field, network requests will be sent to the server to update `$title`. This is useful for things like a real-time search, where a dataset is filtered as a user types into a search box.

[#](#only-updating-fields-on-blur "Permalink")Only updating fields on _blur_
----------------------------------------------------------------------------

For most cases, `wire:model.live` is fine for real-time form field updating; however, it can be overly network resource-intensive on text inputs.

If instead of sending network requests as a user types, you want to instead only send the request when a user "tabs" out of the text input (also referred to as "blurring" an input), you can use the `.blur` modifier instead:

    <input type="text" wire:model.blur="title" >

Now the component class on the server won't be updated until the user presses tab or clicks away from the text input.

[#](#real-time-validation "Permalink")Real-time validation
----------------------------------------------------------

Sometimes, you may want to show validation errors as the user fills out the form. This way, they are alerted early that something is wrong instead of having to wait until the entire form is filled out.

Livewire handles this sort of thing automatically. By using `.live` or `.blur` on `wire:model`, Livewire will send network requests as the user fills out the form. Each of those network requests will run the appropriate validation rules before updating each property. If validation fails, the property won't be updated on the server and a validation message will be shown to the user:

    <input type="text" wire:model.blur="title"> <div>    @error('title') <span class="error">{{ $message }}</span> @enderror</div>

    #[Validate('required|min:5')]public $title = '';

Now, if the user only types three characters into the "title" input, then clicks on the next input in the form, a validation message will be shown to them indicating there is a five character minimum for that field.

For more information, check out the [validation documentation page](/docs/validation).

[#](#real-time-form-saving "Permalink")Real-time form saving
------------------------------------------------------------

If you want to automatically save a form as the user fills it out rather than wait until the user clicks "submit", you can do so using Livewire's `updated()` hook:

    <?php namespace App\Livewire; use Livewire\Attributes\Validate;use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public Post $post;     #[Validate('required')]    public $title = '';     #[Validate('required')]    public $content = '';     public function mount(Post $post)    {        $this->post = $post;        $this->title = $post->title;        $this->content = $post->content;    }     public function updated($name, $value)     {        $this->post->update([            $name => $value,        ]);    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit>    <input type="text" wire:model.blur="title">    <div>        @error('title') <span class="error">{{ $message }}</span> @enderror    </div>     <input type="text" wire:model.blur="content">    <div>        @error('content') <span class="error">{{ $message }}</span> @enderror    </div></form>

In the above example, when a user completes a field (by clicking or tabbing to the next field), a network request is sent to update that property on the component. Immediately after the property is updated on the class, the `updated()` hook is called for that specific property name and its new value.

We can use this hook to update only that specific field in the database.

Additionally, because we have the `#[Validate]` attributes attached to those properties, the validation rules will be run before the property is updated and the `updated()` hook is called.

To learn more about the "updated" lifecycle hook and other hooks, [visit the lifecycle hooks documentation](/docs/lifecycle-hooks).

[#](#showing-dirty-indicators "Permalink")Showing dirty indicators
------------------------------------------------------------------

In the real-time saving scenario discussed above, it may be helpful to indicate to users when a field hasn't been persisted to the database yet.

For example, if a user visits an `UpdatePost` page and starts modifying the title of the post in a text input, it may be unclear to them when the title is actually being updated in the database, especially if there is no "Save" button at the bottom of the form.

Livewire provides the `wire:dirty` directive to allow you to toggle elements or modify classes when an input's value diverges from the server-side component:

    <input type="text" wire:model.blur="title" wire:dirty.class="border-yellow">

In the above example, when a user types into the input field, a yellow border will appear around the field. When the user tabs away, the network request is sent and the border will disappear; signaling to them that the input has been persisted and is no longer "dirty".

If you want to toggle an entire element's visibility, you can do so by using `wire:dirty` in conjunction with `wire:target`. `wire:target` is used to specify which piece of data you want to watch for "dirtiness". In this case, the "title" field:

    <input type="text" wire:model="title"> <div wire:dirty wire:target="title">Unsaved...</div>

[#](#debouncing-input "Permalink")Debouncing input
--------------------------------------------------

When using `.live` on a text input, you may want more fine-grained control over how often a network request is sent. By default, a debounce of "250ms" is applied to the input; however, you can customize this using the `.debounce` modifier:

    <input type="text" wire:model.live.debounce.150ms="title" >

Now that `.debounce.150ms` has been added to the field, a shorter debounce of "150ms" will be used when handling input updates for this field. In other words, as a user types, a network request will only be sent if the user stops typing for at least 150 milliseconds.

[#](#throttling-input "Permalink")Throttling input
--------------------------------------------------

As stated previously, when an input debounce is applied to a field, a network request will not be sent until the user has stopped typing for a certain amount of time. This means if the user continues typing a long message, a network request won't be sent until the user is finished.

Sometimes this isn't the desired behavior, and you would rather send a request as the user types, not when they've finished or taken a break.

In these cases, you can instead use `.throttle` to signify a time interval to send network requests:

    <input type="text" wire:model.live.throttle.150ms="title" >

In the above example, as a user is typing continuously in the "title" field, a network request will be sent every 150 milliseconds until the user is finished.

[#](#extracting-input-fields-to-blade-components "Permalink")Extracting input fields to Blade components
--------------------------------------------------------------------------------------------------------

Even in a small component such as the `CreatePost` example we've been discussing, we end up duplicating lots of form field boilerplate like validation messages and labels.

It can be helpful to extract repetitive UI elements such as these into dedicated [Blade components](https://laravel.com/docs/blade#components) to be shared across your application.

For example, below is the original Blade template from the `CreatePost` component. We will be extracting the following two text inputs into dedicated Blade components:

    <form wire:submit="save">    <input type="text" wire:model="title">     <div>        @error('title') <span class="error">{{ $message }}</span> @enderror    </div>     <input type="text" wire:model="content">     <div>        @error('content') <span class="error">{{ $message }}</span> @enderror    </div>     <button type="submit">Save</button></form>

Here's what the template will look like after extracting a re-usable Blade component called `<x-input-text>`:

    <form wire:submit="save">    <x-input-text name="title" wire:model="title" />      <x-input-text name="content" wire:model="content" />      <button type="submit">Save</button></form>

Next, here's the source for the `x-input-text` component:

    <!-- resources/views/components/input-text.blade.php --> @props(['name']) <input type="text" name="{{ $name }}" {{ $attributes }}> <div>    @error($name) <span class="error">{{ $message }}</span> @enderror</div>

As you can see, we took the repetitive HTML and placed it inside a dedicated Blade component.

For the most part, the Blade component contains only the extracted HTML from the original component. However, we have added two things:

*   The `@props` directive
*   The `{{ $attributes }}` statement on the input

Let's discuss each of these additions:

By specifying `name` as a "prop" using `@props(['name'])` we are telling Blade: if an attribute called "name" is set on this component, take its value and make it available inside this component as `$name`.

For other attributes that don't have an explicit purpose, we used the `{{ $attributes }}` statement. This is used for "attribute forwarding", or in other words, taking any HTML attributes written on the Blade component and forwarding them onto an element within the component.

This ensures `wire:model="title"` and any other extra attributes such as `disabled`, `class="..."`, or `required` still get forwarded to the actual `<input>` element.

### [#](#custom-form-controls "Permalink")Custom form controls

In the previous example, we "wrapped" an input element into a re-usable Blade component we can use as if it was a native HTML input element.

This pattern is very useful; however, there might be some cases where you want to create an entire input component from scratch (without an underlying native input element), but still be able to bind its value to Livewire properties using `wire:model`.

For example, let's imagine you wanted to create an `<x-input-counter />` component that was a simple "counter" input written in Alpine.

Before we create a Blade component, let's first look at a simple, pure-Alpine, "counter" component for reference:

    <div x-data="{ count: 0 }">    <button x-on:click="count--">-</button>     <span x-text="count"></span>     <button x-on:click="count++">+</button></div>

As you can see, the component above shows a number alongside two buttons to increment and decrement that number.

Now, let's imagine we want to extract this component into a Blade component called `<x-input-counter />` that we would use within a component like so:

    <x-input-counter wire:model="quantity" />

Creating this component is mostly simple. We take the HTML of the counter and place it inside a Blade component template like `resources/views/components/input-counter.blade.php`.

However, making it work with `wire:model="quantity"` so that you can easily bind data from your Livewire component to the "count" inside this Alpine component needs one extra step.

Here's the source for the component:

    <!-- resources/view/components/input-counter.blade.php --> <div x-data="{ count: 0 }" x-modelable="count" {{ $attributes}}>    <button x-on:click="count--">-</button>     <span x-text="count"></span>     <button x-on:click="count++">+</button></div>

As you can see, the only different bit about this HTML is the `x-modelable="count"` and `{{ $attributes }}`.

`x-modelable` is a utility in Alpine that tells Alpine to make a certain piece of data available for binding from outside. [The Alpine documentation has more information on this directive.](https://alpinejs.dev/directives/modelable)

`{{ $attributes }}`, as we explored earlier, forwards any attributes passed into the Blade component from outside. In this case, the `wire:model` directive will be forwarded.

Because of `{{ $attributes }}`, when the HTML is rendered in the browser, `wire:model="quantity"` will be rendered alongside `x-modelable="count"` on the root `<div>` of the Alpine component like so:

    <div x-data="{ count: 0 }" x-modelable="count" wire:model="quantity">

`x-modelable="count"` tells Alpine to look for any `x-model` or `wire:model` statements and use "count" as the data to bind them to.

Because `x-modelable` works for both `wire:model` and `x-model`, you can also use this Blade component interchangeably with Livewire and Alpine. For example, here's an example of using this Blade component in a purely Alpine context:

    <x-input-counter x-model="quantity" />

Creating custom input elements in your application is extremely powerful but requires a deeper understanding of the utilities Livewire and Alpine provide and how they interact with each other.

---

## Hydration

Hydration
=========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Using Livewire feels like attaching a server-side PHP class directly to a web browser. Things like calling server-side functions directly from button presses support this illusion. But in reality, it is just that: an illusion.

In the background, Livewire actually behaves much more like a standard web application. It renders static HTML to the browser, listens for browser events, then makes AJAX requests to invoke server-side code.

Because each AJAX request Livewire makes to the server is "stateless" (meaning there isn't a long running backend process keeping the state of a component alive), Livewire must re-create the last-known state of a component before making any updates.

It does this by taking "snapshots" of the PHP component after each server-side update so that the component can be re-created or _resumed_ on the next request.

Throughout this documentation, we will refer to the process of taking the snapshot as "dehydration" and the process of re-creating a component from a snapshot as "hydration".

[#](#dehydrating "Permalink")Dehydrating
----------------------------------------

When Livewire _dehydrates_ a server-side component, it does two things:

*   Renders the component's template to HTML
*   Creates a JSON snapshot of the component

### [#](#rendering-html "Permalink")Rendering HTML

After a component is mounted or an update has been made, Livewire calls a component's `render()` method to convert the Blade template to raw HTML.

Take the following `Counter` component for example:

    class Counter extends Component{    public $count = 1;     public function increment()    {        $this->count++;    }     public function render()    {        return <<<'HTML'        <div>            Count: {{ $count }}             <button wire:click="increment">+</button>        </div>        HTML;    }}

After each mount or update, Livewire would render the above `Counter` component to the following HTML:

    <div>    Count: 1     <button wire:click="increment">+</button></div>

### [#](#the-snapshot "Permalink")The snapshot

In order to re-create the `Counter` component on the server during the next request, a JSON snapshot is created, attempting to capture as much of the state of the component as possible:

    {    state: {        count: 1,    },     memo: {        name: 'counter',         id: '1526456',    },}

Notice two different portions of the snapshot: `memo`, and `state`.

The `memo` portion is used to store the information needed to identify and re-create the component, while the `state` portion stores the values of all the component's public properties.

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

The above snapshot is a condensed version of an actual snapshot in Livewire. In live applications, the snapshot contains much more information, such as validation errors, a list of child components, locales, and much more. For a more detailed look at a snapshot object you may reference the [snapshot schema documentation](/docs/javascript#the-snapshot-object).

### [#](#embedding-the-snapshot-in-the-html "Permalink")Embedding the snapshot in the HTML

When a component is first rendered, Livewire stores the snapshot as JSON inside an HTML attribute called `wire:snapshot`. This way, Livewire's JavaScript core can extract the JSON and turn it into a run-time object:

    <div wire:id="..." wire:snapshot="{ state: {...}, memo: {...} }">    Count: 1     <button wire:click="increment">+</button></div>

[#](#hydrating "Permalink")Hydrating
------------------------------------

When a component update is triggered, for example, the "+" button is pressed in the `Counter` component, a payload like the following is sent to the server:

    {    calls: [        { method: 'increment', params: [] },    ],     snapshot: {        state: {            count: 1,        },         memo: {            name: 'counter',             id: '1526456',        },    }}

Before Livewire can call the `increment` method, it must first create a new `Counter` instance and seed it with the snapshot's state.

Here is some PHP pseudo-code that achieves this result:

    $state = request('snapshot.state');$memo = request('snapshot.memo'); $instance = Livewire::new($memo['name'], $memo['id']); foreach ($state as $property => $value) {    $instance[$property] = $value;}

If you follow the above script, you will see that after creating a `Counter` object, its public properties are set based on the state provided from the snapshot.

[#](#advanced-hydration "Permalink")Advanced hydration
------------------------------------------------------

The above `Counter` example works well to demonstrate the concept of hydration; however, it only demonstrates how Livewire handles hydrating simple values like integers (`1`).

As you may know, Livewire supports many more sophisticated property types beyond integers.

Let's take a look at a slightly more complex example - a `Todos` component:

    class Todos extends Component{    public $todos;     public function mount() {        $this->todos = collect([            'first',            'second',            'third',        ]);    }}

As you can see, we are setting the `$todos` property to a [Laravel collection](https://laravel.com/docs/collections#main-content) with three strings as its content.

JSON alone has no way of representing Laravel collections, so instead, Livewire has created its own pattern of associating metadata with pure data inside a snapshot.

Here is the snapshot's state object for this `Todos` component:

    state: {    todos: [        [ 'first', 'second', 'third' ],        { s: 'clctn', class: 'Illuminate\\Support\\Collection' },    ],},

This may be confusing to you if you were expecting something more straightforward like:

    state: {    todos: [ 'first', 'second', 'third' ],},

However, if Livewire were hydrating a component based on this data, it would have no way of knowing it's a collection and not a plain array.

Therefore, Livewire supports an alternate state syntax in the form of a tuple (an array of two items):

    todos: [    [ 'first', 'second', 'third' ],    { s: 'clctn', class: 'Illuminate\\Support\\Collection' },],

When Livewire encounters a tuple when hydrating a component's state, it uses information stored in the second element of the tuple to more intelligently hydrate the state stored in the first.

To demonstrate more clearly, here is simplified code showing how Livewire might re-create a collection property based on the above snapshot:

    [ $state, $metadata ] = request('snapshot.state.todos'); $collection = new $metadata['class']($state);

As you can see, Livewire uses the metadata associated with the state to derive the full collection class.

### [#](#deeply-nested-tuples "Permalink")Deeply nested tuples

One distinct advantage of this approach is the ability to dehydrate and hydrate deeply nested properties.

For example, consider the above `Todos` example, except now with a [Laravel Stringable](https://laravel.com/docs/helpers#method-str) instead of a plain string as the third item in the collection:

    class Todos extends Component{    public $todos;     public function mount() {        $this->todos = collect([            'first',            'second',            str('third'),        ]);    }}

The dehydrated snapshot for this component's state would now look like this:

    todos: [    [        'first',        'second',        [ 'third', { s: 'str' } ],    ],    { s: 'clctn', class: 'Illuminate\\Support\\Collection' },],

As you can see, the third item in the collection has been dehydrated into a metadata tuple. The first element in the tuple being the plain string value, and the second being a flag denoting to Livewire that this string is a _stringable_.

### [#](#supporting-custom-property-types "Permalink")Supporting custom property types

Internally, Livewire has hydration support for the most common PHP and Laravel types. However, if you wish to support un-supported types, you can do so using [Synthesizers](/docs/synthesizers) — Livewire's internal mechanism for hydrating/dehydrating non-primitive property types.

---

## Installation

Installation
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire is a Laravel package, so you will need to have a Laravel application up and running before you can install and use Livewire. If you need help setting up a new Laravel application, please see the [official Laravel documentation](https://laravel.com/docs/installation).

To install Livewire, open your terminal and navigate to your Laravel application directory, then run the following command:

    composer require livewire/livewire

That's it — really. If you want more customization options, keep reading. Otherwise, you can jump right into using Livewire.

`/livewire/livewire.js` returning a 404 status code

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

By default, Livewire exposes a route in your application to serve its JavaScript assets from: `/livewire/livewire.js`. This is fine for most applications, however, if you are using Nginx with a custom configuration, you may receive a 404 from this endpoint. To fix this issue, you can either [compile Livewire's JavaScript assets yourself](#manually-bundling-livewire-and-alpine), or [configure Nginx to allow for this](https://benjamincrozat.com/livewire-js-404-not-found).

[#](#publishing-the-configuration-file "Permalink")Publishing the configuration file
------------------------------------------------------------------------------------

Livewire is "zero-config", meaning you can use it by following conventions, without any additional configuration. However, if needed, you can publish and customize Livewire's configuration file by running the following Artisan command:

    php artisan livewire:publish --config

This will create a new `livewire.php` file in your Laravel application's `config` directory.

[#](#manually-including-livewires-frontend-assets "Permalink")Manually including Livewire's frontend assets
-----------------------------------------------------------------------------------------------------------

By default, Livewire injects the JavaScript and CSS assets it needs into each page that includes a Livewire component.

If you want more control over this behavior, you can manually include the assets on a page using the following Blade directives:

    <html><head>    ...    @livewireStyles</head><body>    ...    @livewireScripts</body></html>

By including these assets manually on a page, Livewire knows not to inject the assets automatically.

AlpineJS is bundled with Livewire

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Because Alpine is bundled with Livewire's JavaScript assets, you must include `@livewireScripts` on every page you wish to use Alpine. Even if you're not using Livewire on that page.

Though rarely required, you may disable Livewire's auto-injecting asset behavior by updating the `inject_assets` [configuration option](#publishing-the-configuration-file) in your application's `config/livewire.php` file:

    'inject_assets' => false,

If you'd rather force Livewire to inject its assets on a single page or multiple pages, you can call the following global method from the current route or from a service provider.

    \Livewire\Livewire::forceAssetInjection();

[#](#configuring-livewires-update-endpoint "Permalink")Configuring Livewire's update endpoint
---------------------------------------------------------------------------------------------

Every update in a Livewire component sends a network request to the server at the following endpoint: `https://example.com/livewire/update`

This can be a problem for some applications that use localization or multi-tenancy.

In those cases, you can register your own endpoint however you like, and as long as you do it inside `Livewire::setUpdateRoute()`, Livewire will know to use this endpoint for all component updates:

    Livewire::setUpdateRoute(function ($handle) {    return Route::post('/custom/livewire/update', $handle);});

Now, instead of using `/livewire/update`, Livewire will send component updates to `/custom/livewire/update`.

Because Livewire allows you to register your own update route, you can declare any additional middleware you want Livewire to use directly inside `setUpdateRoute()`:

    Livewire::setUpdateRoute(function ($handle) {    return Route::post('/custom/livewire/update', $handle)        ->middleware([...]); });

[#](#customizing-the-asset-url "Permalink")Customizing the asset URL
--------------------------------------------------------------------

By default, Livewire will serve its JavaScript assets from the following URL: `https://example.com/livewire/livewire.js`. Additionally, Livewire will reference this asset from a script tag like so:

    <script src="/livewire/livewire.js" ...

If your application has global route prefixes due to localization or multi-tenancy, you can register your own endpoint that Livewire should use internally when fetching its JavaScript.

To use a custom JavaScript asset endpoint, you can register your own route inside `Livewire::setScriptRoute()`:

    Livewire::setScriptRoute(function ($handle) {    return Route::get('/custom/livewire/livewire.js', $handle);});

Now, Livewire will load its JavaScript like so:

    <script src="/custom/livewire/livewire.js" ...

[#](#manually-bundling-livewire-and-alpine "Permalink")Manually bundling Livewire and Alpine
--------------------------------------------------------------------------------------------

By default, Alpine and Livewire are loaded using the `<script src="livewire.js">` tag, which means you have no control over the order in which these libraries are loaded. Consequently, importing and registering Alpine plugins, as shown in the example below, will no longer function:

    // Warning: This snippet demonstrates what NOT to do... import Alpine from 'alpinejs'import Clipboard from '@ryangjchandler/alpine-clipboard' Alpine.plugin(Clipboard)Alpine.start()

To address this issue, we need to inform Livewire that we want to use the ESM (ECMAScript module) version ourselves and prevent the injection of the `livewire.js` script tag. To achieve this, we must add the `@livewireScriptConfig` directive to our layout file (`resources/views/components/layouts/app.blade.php`):

    <html><head>    <!-- ... -->    @livewireStyles    @vite(['resources/js/app.js'])</head><body>    {{ $slot }}     @livewireScriptConfig </body></html>

When Livewire detects the `@livewireScriptConfig` directive, it will refrain from injecting the Livewire and Alpine scripts. If you are using the `@livewireScripts` directive to manually load Livewire, be sure to remove it. Make sure to add the `@livewireStyles` directive if it is not already present.

The final step is importing Alpine and Livewire in our `app.js` file, allowing us to register any custom resources, and ultimately starting Livewire and Alpine:

    import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';import Clipboard from '@ryangjchandler/alpine-clipboard' Alpine.plugin(Clipboard) Livewire.start()

Rebuild your assets after composer update

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Make sure that if you are manually bundling Livewire and Alpine, that you rebuild your assets whenever you run `composer update`.

Not compatible with Laravel Mix

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Laravel Mix will not work if you are manually bundling Livewire and AlpineJS. Instead, we recommend that you [switch to Vite](https://laravel.com/docs/vite).

[#](#publishing-livewires-frontend-assets "Permalink")Publishing Livewire's frontend assets
-------------------------------------------------------------------------------------------

Publishing assets isn't necessary

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Publishing Livewire's assets isn't necessary for Livewire to run. Only do this if you have a specific need for it.

If you prefer the JavaScript assets to be served by your web server not through Laravel, use the `livewire:publish` command:

    php artisan livewire:publish --assets

To keep assets up-to-date and avoid issues in future updates, we strongly recommend that you add the following command to your composer.json file:

    {    "scripts": {        "post-update-cmd": [            // Other scripts            "@php artisan vendor:publish --tag=livewire:assets --ansi --force"        ]    }}

---

## Javascript

JavaScript
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

[#](#using-javascript-in-livewire-components "Permalink")Using JavaScript in Livewire components
------------------------------------------------------------------------------------------------

Livewire and Alpine provide plenty of utilities for building dynamic components directly in your HTML, however, there are times when it's helpful to break out of the HTML and execute plain JavaScript for your component. Livewire's `@script` and `@assets` directive allow you to do this in a predictable, maintainable way.

### [#](#executing-scripts "Permalink")Executing scripts

To execute bespoke JavaScript in your Livewire component, simply wrap a `<script>` element with `@script` and `@endscript`. This will tell Livewire to handle the execution of this JavaScript.

Because scripts inside `@script` are handled by Livewire, they are executed at the perfect time after the page has loaded, but before the Livewire component has rendered. This means you no longer need to wrap your scripts in `document.addEventListener('...')` to load them properly.

This also means that lazily or conditionally loaded Livewire components are still able to execute JavaScript after the page has initialized.

    <div>    ...</div> @script<script>    // This Javascript will get executed every time this component is loaded onto the page...</script>@endscript

Here's a more full example where you can do something like register a JavaScript action that is used in your Livewire component.

    <div>    <button wire:click="$js.increment">+</button></div> @script<script>    $js('increment', () => {        console.log('increment')    })</script>@endscript

To learn more about JavaScript actions, [visit the actions documentation](/docs/actions#javascript-actions).

### [#](#using-wire-from-scripts "Permalink")Using `$wire` from scripts

Another helpful feature of using `@script` for your JavaScript is that you automatically have access to your Livewire component's `$wire` object.

Here's an example of using a simple `setInterval` to refresh the component every 2 seconds (You could easily do this with [`wire:poll`](/docs/wire-poll), but it's a simple way to demonstrate the point):

You can learn more about `$wire` on the [`$wire` documentation](#the-wire-object).

    @script<script>    setInterval(() => {        $wire.$refresh()    }, 2000)</script>@endscript

### [#](#evaluating-one-off-javascript-expressions "Permalink")Evaluating one-off JavaScript expressions

In addition to designating entire methods to be evaluated in JavaScript, you can use the `js()` method to evaluate smaller, individual expressions on the backend.

This is generally useful for performing some kind of client-side follow-up after a server-side action is performed.

For example, here is an example of a `CreatePost` component that triggers a client-side alert dialog after the post is saved to the database:

    <?php namespace App\Livewire; use Livewire\Component; class CreatePost extends Component{    public $title = '';     public function save()    {        // ...         $this->js("alert('Post saved!')");     }}

The JavaScript expression `alert('Post saved!')` will now be executed on the client after the post has been saved to the database on the server.

You can access the current component's `$wire` object inside the expression.

### [#](#loading-assets "Permalink")Loading assets

The `@script` directive is useful for executing a bit of JavaScript every time a Livewire component loads, however, there are times you might want to load entire script and style assets on the page along with the component.

Here is an example of using `@assets` to load a date picker library called [Pikaday](https://github.com/Pikaday/Pikaday) and initialize it inside your component using `@script`:

    <div>    <input type="text" data-picker></div> @assets<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script><link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">@endassets @script<script>    new Pikaday({ field: $wire.$el.querySelector('[data-picker]') });</script>@endscript

When this component loads, Livewire will make sure any `@assets` are loaded on that page before evaluating `@script`s. In addition, it will ensure the provided `@assets` are only loaded once per page no matter how many instances of this component there are, unlike `@script`, which will evaluate for every component instance on the page.

[#](#global-livewire-events "Permalink")Global Livewire events
--------------------------------------------------------------

Livewire dispatches two helpful browser events for you to register any custom extension points from outside scripts:

    <script>    document.addEventListener('livewire:init', () => {        // Runs after Livewire is loaded but before it's initialized        // on the page...    })     document.addEventListener('livewire:initialized', () => {        // Runs immediately after Livewire has finished initializing        // on the page...    })</script>

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

It is often beneficial to register any [custom directives](#registering-custom-directives) or [lifecycle hooks](#javascript-hooks) inside of `livewire:init` so that they are available before Livewire begins initializing on the page.

[#](#the-livewire-global-object "Permalink")The `Livewire` global object
------------------------------------------------------------------------

Livewire's global object is the best starting point for interacting with Livewire from external scripts.

You can access the global `Livewire` JavaScript object on `window` from anywhere inside your client-side code.

It is often helpful to use `window.Livewire` inside a `livewire:init` event listener

### [#](#accessing-components "Permalink")Accessing components

You can use the following methods to access specific Livewire components loaded on the current page:

    // Retrieve the $wire object for the first component on the page...let component = Livewire.first() // Retrieve a given component's `$wire` object by its ID...let component = Livewire.find(id) // Retrieve an array of component `$wire` objects by name...let components = Livewire.getByName(name) // Retrieve $wire objects for every component on the page...let components = Livewire.all()

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Each of these methods returns a `$wire` object representing the component's state in Livewire.  
  
You can learn more about these objects in [the `$wire` documentation](#the-wire-object).

### [#](#interacting-with-events "Permalink")Interacting with events

In addition to dispatching and listening for events from individual components in PHP, the global `Livewire` object allows you to interact with [Livewire's event system](/docs/events) from anywhere in your application:

    // Dispatch an event to any Livewire components listening...Livewire.dispatch('post-created', { postId: 2 }) // Dispatch an event to a given Livewire component by name...Livewire.dispatchTo('dashboard', 'post-created', { postId: 2 }) // Listen for events dispatched from Livewire components...Livewire.on('post-created', ({ postId }) => {    // ...})

In certain scenarios, you might need to unregister global Livewire events. For instance, when working with Alpine components and `wire:navigate`, multiple listeners may be registered as `init` is called when navigating between pages. To address this, utilize the `destroy` function, automatically invoked by Alpine. Loop through all your listeners within this function to unregister them and prevent any unwanted accumulation.

    Alpine.data('MyComponent', () => ({    listeners: [],    init() {        this.listeners.push(            Livewire.on('post-created', (options) => {                // Do something...            })        );    },    destroy() {        this.listeners.forEach((listener) => {            listener();        });    }}));

### [#](#using-lifecycle-hooks "Permalink")Using lifecycle hooks

Livewire allows you to hook into various parts of its global lifecycle using `Livewire.hook()`:

    // Register a callback to execute on a given internal Livewire hook...Livewire.hook('component.init', ({ component, cleanup }) => {    // ...})

More information about Livewire's JavaScript hooks can be [found below](#javascript-hooks).

### [#](#registering-custom-directives "Permalink")Registering custom directives

Livewire allows you to register custom directives using `Livewire.directive()`.

Below is an example of a custom `wire:confirm` directive that uses JavaScript's `confirm()` dialog to confirm or cancel an action before it is sent to the server:

    <button wire:confirm="Are you sure?" wire:click="delete">Delete post</button>

Here is the implementation of `wire:confirm` using `Livewire.directive()`:

    Livewire.directive('confirm', ({ el, directive, component, cleanup }) => {    let content =  directive.expression     // The "directive" object gives you access to the parsed directive.    // For example, here are its values for: wire:click.prevent="deletePost(1)"    //    // directive.raw = wire:click.prevent    // directive.value = "click"    // directive.modifiers = ['prevent']    // directive.expression = "deletePost(1)"     let onClick = e => {        if (! confirm(content)) {            e.preventDefault()            e.stopImmediatePropagation()        }    }     el.addEventListener('click', onClick, { capture: true })     // Register any cleanup code inside `cleanup()` in the case    // where a Livewire component is removed from the DOM while    // the page is still active.    cleanup(() => {        el.removeEventListener('click', onClick)    })})

[#](#object-schemas "Permalink")Object schemas
----------------------------------------------

When extending Livewire's JavaScript system, it's important to understand the different objects you might encounter.

Here is an exhaustive reference of each of Livewire's relevant internal properties.

As a reminder, the average Livewire user may never interact with these. Most of these objects are available for Livewire's internal system or advanced users.

### [#](#the-wire-object "Permalink")The `$wire` object

Given the following generic `Counter` component:

    <?php namespace App\Livewire; use Livewire\Component; class Counter extends Component{    public $count = 1;     public function increment()    {        $this->count++;    }     public function render()    {        return view('livewire.counter');    }}

Livewire exposes a JavaScript representation of the server-side component in the form of an object that is commonly referred to as `$wire`:

    let $wire = {    // All component public properties are directly accessible on $wire...    count: 0,     // All public methods are exposed and callable on $wire...    increment() { ... },     // Access the `$wire` object of the parent component if one exists...    $parent,     // Access the root DOM element of the Livewire component...    $el,     // Access the ID of the current Livewire component...    $id,     // Get the value of a property by name...    // Usage: $wire.$get('count')    $get(name) { ... },     // Set a property on the component by name...    // Usage: $wire.$set('count', 5)    $set(name, value, live = true) { ... },     // Toggle the value of a boolean property...    $toggle(name, live = true) { ... },     // Call the method...    // Usage: $wire.$call('increment')    $call(method, ...params) { ... },     // Define a JavaScript action...    // Usage: $wire.$js('increment', () => { ... })    $js(name, callback) { ... },     // Entangle the value of a Livewire property with a different,    // arbitrary, Alpine property...    // Usage: <div x-data="{ count: $wire.$entangle('count') }">    $entangle(name, live = false) { ... },     // Watch the value of a property for changes...    // Usage: Alpine.$watch('count', (value, old) => { ... })    $watch(name, callback) { ... },     // Refresh a component by sending a commit to the server    // to re-render the HTML and swap it into the page...    $refresh() { ... },     // Identical to the above `$refresh`. Just a more technical name...    $commit() { ... },     // Listen for a an event dispatched from this component or its children...    // Usage: $wire.$on('post-created', () => { ... })    $on(event, callback) { ... },     // Listen for a lifecycle hook triggered from this component or the request...    // Usage: $wire.$hook('commit', () => { ... })    $hook(name, callback) { ... },     // Dispatch an event from this component...    // Usage: $wire.$dispatch('post-created', { postId: 2 })    $dispatch(event, params = {}) { ... },     // Dispatch an event onto another component...    // Usage: $wire.$dispatchTo('dashboard', 'post-created', { postId: 2 })    $dispatchTo(otherComponentName, event, params = {}) { ... },     // Dispatch an event onto this component and no others...    $dispatchSelf(event, params = {}) { ... },     // A JS API to upload a file directly to component    // rather than through `wire:model`...    $upload(        name, // The property name        file, // The File JavaScript object        finish = () => { ... }, // Runs when the upload is finished...        error = () => { ... }, // Runs if an error is triggered mid-upload...        progress = (event) => { // Runs as the upload progresses...            event.detail.progress // An integer from 1-100...        },    ) { ... },     // API to upload multiple files at the same time...    $uploadMultiple(name, files, finish, error, progress) { },     // Remove an upload after it's been temporarily uploaded but not saved...    $removeUpload(name, tmpFilename, finish, error) { ... },     // Retrieve the underlying "component" object...    __instance() { ... },}

You can learn more about `$wire` in [Livewire's documentation on accessing properties in JavaScript](/docs/properties#accessing-properties-from-javascript).

### [#](#the-snapshot-object "Permalink")The `snapshot` object

Between each network request, Livewire serializes the PHP component into an object that can be consumed in JavaScript. This snapshot is used to unserialize the component back into a PHP object and therefore has mechanisms built in to prevent tampering:

    let snapshot = {    // The serialized state of the component (public properties)...    data: { count: 0 },     // Long-standing information about the component...    memo: {        // The component's unique ID...        id: '0qCY3ri9pzSSMIXPGg8F',         // The component's name. Ex. <livewire:[name] />        name: 'counter',         // The URI, method, and locale of the web page that the        // component was originally loaded on. This is used        // to re-apply any middleware from the original request        // to subsequent component update requests (commits)...        path: '/',        method: 'GET',        locale: 'en',         // A list of any nested "child" components. Keyed by        // internal template ID with the component ID as the values...        children: [],         // Weather or not this component was "lazy loaded"...        lazyLoaded: false,         // A list of any validation errors thrown during the        // last request...        errors: [],    },     // A securely encrypted hash of this snapshot. This way,    // if a malicious user tampers with the snapshot with    // the goal of accessing un-owned resources on the server,    // the checksum validation will fail and an error will    // be thrown...    checksum: '1bc274eea17a434e33d26bcaba4a247a4a7768bd286456a83ea6e9be2d18c1e7',}

### [#](#the-component-object "Permalink")The `component` object

Every component on a page has a corresponding component object behind the scenes keeping track of its state and exposing its underlying functionality. This is one layer deeper than `$wire`. It is only meant for advanced usage.

Here's an actual component object for the above `Counter` component with descriptions of relevant properties in JS comments:

    let component = {    // The root HTML element of the component...    el: HTMLElement,     // The unique ID of the component...    id: '0qCY3ri9pzSSMIXPGg8F',     // The component's "name" (<livewire:[name] />)...    name: 'counter',     // The latest "effects" object. Effects are "side-effects" from server    // round-trips. These include redirects, file downloads, etc...    effects: {},     // The component's last-known server-side state...    canonical: { count: 0 },     // The component's mutable data object representing its    // live client-side state...    ephemeral: { count: 0 },     // A reactive version of `this.ephemeral`. Changes to    // this object will be picked up by AlpineJS expressions...    reactive: Proxy,     // A Proxy object that is typically used inside Alpine    // expressions as `$wire`. This is meant to provide a    // friendly JS object interface for Livewire components...    $wire: Proxy,     // A list of any nested "child" components. Keyed by    // internal template ID with the component ID as the values...    children: [],     // The last-known "snapshot" representation of this component.    // Snapshots are taken from the server-side component and used    // to re-create the PHP object on the backend...    snapshot: {...},     // The un-parsed version of the above snapshot. This is used to send back to the    // server on the next roundtrip because JS parsing messes with PHP encoding    // which often results in checksum mis-matches.    snapshotEncoded: '{"data":{"count":0},"memo":{"id":"0qCY3ri9pzSSMIXPGg8F","name":"counter","path":"\/","method":"GET","children":[],"lazyLoaded":true,"errors":[],"locale":"en"},"checksum":"1bc274eea17a434e33d26bcaba4a247a4a7768bd286456a83ea6e9be2d18c1e7"}',}

### [#](#the-commit-payload "Permalink")The `commit` payload

When an action is performed on a Livewire component in the browser, a network request is triggered. That network request contains one or many components and various instructions for the server. Internally, these component network payloads are called "commits".

The term "commit" was chosen as a helpful way to think about Livewire's relationship between frontend and backend. A component is rendered and manipulated on the frontend until an action is performed that requires it to "commit" its state and updates to the backend.

You will recognize this schema from the payload in the network tab of your browser's DevTools, or [Livewire's JavaScript hooks](#javascript-hooks):

    let commit = {    // Snapshot object...    snapshot: { ... },     // A key-value pair list of properties    // to update on the server...    updates: {},     // An array of methods (with parameters) to call server-side...    calls: [        { method: 'increment', params: [] },    ],}

[#](#javascript-hooks "Permalink")JavaScript hooks
--------------------------------------------------

For advanced users, Livewire exposes its internal client-side "hook" system. You can use the following hooks to extend Livewire's functionality or gain more information about your Livewire application.

### [#](#component-initialization "Permalink")Component initialization

Every time a new component is discovered by Livewire — whether on the initial page load or later on — the `component.init` event is triggered. You can hook into `component.init` to intercept or initialize anything related to the new component:

    Livewire.hook('component.init', ({ component, cleanup }) => {    //})

For more information, please consult the [documentation on the component object](#the-component-object).

### [#](#dom-element-initialization "Permalink")DOM element initialization

In addition to triggering an event when new components are initialized, Livewire triggers an event for each DOM element within a given Livewire component.

This can be used to provide custom Livewire HTML attributes within your application:

    Livewire.hook('element.init', ({ component, el }) => {    //})

### [#](#dom-morph-hooks "Permalink")DOM Morph hooks

During the DOM morphing phase—which occurs after Livewire completes a network roundtrip—Livewire triggers a series of events for every element that is mutated.

    Livewire.hook('morph.updating',  ({ el, component, toEl, skip, childrenOnly }) => {    //}) Livewire.hook('morph.updated', ({ el, component }) => {    //}) Livewire.hook('morph.removing', ({ el, component, skip }) => {    //}) Livewire.hook('morph.removed', ({ el, component }) => {    //}) Livewire.hook('morph.adding',  ({ el, component }) => {    //}) Livewire.hook('morph.added',  ({ el }) => {    //})

In addition to the events fired per element, a `morph` and `morphed` event is fired for each Livewire component:

    Livewire.hook('morph',  ({ el, component }) => {    // Runs just before the child elements in `component` are morphed}) Livewire.hook('morphed',  ({ el, component }) => {    // Runs after all child elements in `component` are morphed})

### [#](#commit-hooks "Permalink")Commit hooks

Because Livewire requests contain multiple components, _request_ is too broad of a term to refer to an individual component's request and response payload. Instead, internally, Livewire refers to component updates as _commits_ — in reference to _committing_ component state to the server.

These hooks expose `commit` objects. You can learn more about their schema by reading [the commit object documentation](#the-commit-payload).

#### [#](#preparing-commits "Permalink")Preparing commits

The `commit.prepare` hook will be triggered immediately before a request is sent to the server. This gives you a chance to add any last minute updates or actions to the outgoing request:

    Livewire.hook('commit.prepare', ({ component }) => {    // Runs before commit payloads are collected and sent to the server...})

#### [#](#intercepting-commits "Permalink")Intercepting commits

Every time a Livewire component is sent to the server, a _commit_ is made. To hook into the lifecycle and contents of an individual commit, Livewire exposes a `commit` hook.

This hook is extremely powerful as it provides methods for hooking into both the request and response of a Livewire commit:

    Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {    // Runs immediately before a commit's payload is sent to the server...     respond(() => {        // Runs after a response is received but before it's processed...    })     succeed(({ snapshot, effect }) => {        // Runs after a successful response is received and processed        // with a new snapshot and list of effects...    })     fail(() => {        // Runs if some part of the request failed...    })})

[#](#request-hooks "Permalink")Request hooks
--------------------------------------------

If you would like to instead hook into the entire HTTP request going and returning from the server, you can do so using the `request` hook:

    Livewire.hook('request', ({ url, options, payload, respond, succeed, fail }) => {    // Runs after commit payloads are compiled, but before a network request is sent...     respond(({ status, response }) => {        // Runs when the response is received...        // "response" is the raw HTTP response object        // before await response.text() is run...    })     succeed(({ status, json }) => {        // Runs when the response is received...        // "json" is the JSON response object...    })     fail(({ status, content, preventDefault }) => {        // Runs when the response has an error status code...        // "preventDefault" allows you to disable Livewire's        // default error handling...        // "content" is the raw response content...    })})

### [#](#customizing-page-expiration-behavior "Permalink")Customizing page expiration behavior

If the default page expired dialog isn't suitable for your application, you can implement a custom solution using the `request` hook:

    <script>    document.addEventListener('livewire:init', () => {        Livewire.hook('request', ({ fail }) => {            fail(({ status, preventDefault }) => {                if (status === 419) {                    confirm('Your custom page expiration behavior...')                     preventDefault()                }            })        })    })</script>

With the above code in your application, users will receive a custom dialog when their session has expired.

---

## Lazy

Lazy Loading
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire allows you to lazy load components that would otherwise slow down the initial page load.

For example, imagine you have a `Revenue` component which contains a slow database query in `mount()`:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Transaction; class Revenue extends Component{    public $amount;     public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }     public function render()    {        return view('livewire.revenue');    }}

    <div>    Revenue this month: {{ $amount }}</div>

Without lazy loading, this component would delay the loading of the entire page and make your entire application feel slow.

To enable lazy loading, you can pass the `lazy` parameter into the component:

    <livewire:revenue lazy />

Now, instead of loading the component right away, Livewire will skip this component, loading the page without it. Then, when the component is visible in the viewport, Livewire will make a network request to fully load this component on the page.

Lazy requests are isolated by default

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Unlike other network requests in Livewire, lazy loading updates are isolated from each other when sent to the server. This keeps lazy loading fast, by loading each component in parallel when a page loads. [Read more on disabling this behavior here →](#disabling-request-isolation)

[#](#rendering-placeholder-html "Permalink")Rendering placeholder HTML
----------------------------------------------------------------------

By default, Livewire will insert an empty `<div></div>` for your component before it is fully loaded. As the component will initially be invisible to users, it can be jarring when the component suddenly appears on the page.

To signal to your users that the component is being loaded, you can define a `placeholder()` method to render any kind of placeholder HTML you like, including loading spinners and skeleton placeholders:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Transaction; class Revenue extends Component{    public $amount;     public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }     public function placeholder()    {        return <<<'HTML'        <div>            <!-- Loading spinner... -->            <svg>...</svg>        </div>        HTML;    }     public function render()    {        return view('livewire.revenue');    }}

Because the above component specifies a "placeholder" by returning HTML from a `placeholder()` method, the user will see an SVG loading spinner on the page until the component is fully loaded.

The placeholder and the component must share the same element type

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

For instance, if your placeholder's root element type is a 'div,' your component must also use a 'div' element.

### [#](#rendering-a-placeholder-via-a-view "Permalink")Rendering a placeholder via a view

For more complex loaders (such as skeletons) you can return a `view` from the `placeholder()` similar to `render()`.

    public function placeholder(array $params = []){    return view('livewire.placeholders.skeleton', $params);}

Any parameters from the component being lazy loaded will be available as an `$params` argument passed to the `placeholder()` method.

[#](#lazy-loading-outside-of-the-viewport "Permalink")Lazy loading outside of the viewport
------------------------------------------------------------------------------------------

By default, Lazy-loaded components aren't full loaded until they enter the browser's viewport, for example when a user scrolls to one.

If you'd rather lazy load all components on a page as soon as the page is loaded, without waiting for them to enter the viewport, you can do so by passing "on-load" into the `lazy` parameter:

    <livewire:revenue lazy="on-load" />

Now this component will load after the page is ready without waiting for it to be inside the viewport.

[#](#passing-in-props "Permalink")Passing in props
--------------------------------------------------

In general, you can treat `lazy` components the same as normal components, since you can still pass data into them from outside.

For example, here's a scenario where you might pass a time interval into the `Revenue` component from a parent component:

    <input type="date" wire:model="start"><input type="date" wire:model="end"> <livewire:revenue lazy :$start :$end />

You can accept this data in `mount()` just like any other component:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Transaction; class Revenue extends Component{    public $amount;     public function mount($start, $end)    {        // Expensive database query...        $this->amount = Transactions::between($start, $end)->sum('amount');    }     public function placeholder()    {        return <<<'HTML'        <div>            <!-- Loading spinner... -->            <svg>...</svg>        </div>        HTML;    }     public function render()    {        return view('livewire.revenue');    }}

However, unlike a normal component load, a `lazy` component has to serialize or "dehydrate" any passed-in properties and temporarily store them on the client-side until the component is fully loaded.

For example, you might want to pass in an Eloquent model to the `Revenue` component like so:

    <livewire:revenue lazy :$user />

In a normal component, the actual PHP in-memory `$user` model would be passed into the `mount()` method of `Revenue`. However, because we won't run `mount()` until the next network request, Livewire will internally serialize `$user` to JSON and then re-query it from the database before the next request is handled.

Typically, this serialization should not cause any behavioral differences in your application.

[#](#lazy-load-by-default "Permalink")Lazy load by default
----------------------------------------------------------

If you want to enforce that all usages of a component will be lazy-loaded, you can add the `#[Lazy]` attribute above the component class:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Lazy; #[Lazy]class Revenue extends Component{    // ...}

If you want to override lazy loading you can set the `lazy` parameter to `false`:

    <livewire:revenue :lazy="false" />

### [#](#disabling-request-isolation "Permalink")Disabling request isolation

If there are multiple lazy-loaded components on the page, each component will make an independent network request, rather than each lazy update being bundled into a single request.

If you want to disable this isolation behavior and instead bundle all updates together in a single network request you can do so with the `isolate: false` parameter:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Lazy; #[Lazy(isolate: false)] class Revenue extends Component{    // ...}

Now, if there are ten `Revenue` components on the same page, when the page loads, all ten updates will be bundled and sent the server as single network request.

[#](#full-page-lazy-loading "Permalink")Full-page lazy loading
--------------------------------------------------------------

You may want to lazy load full-page Livewire components. You can do this by calling `->lazy()` on the route like so:

    Route::get('/dashboard', \App\Livewire\Dashboard::class)->lazy();

Or alternatively, if there is a component that is lazy-loaded by default, and you would like to opt-out of lazy-loading, you can use the following `enabled: false` parameter:

    Route::get('/dashboard', \App\Livewire\Dashboard::class)->lazy(enabled: false);

[#](#default-placeholder-view "Permalink")Default placeholder view
------------------------------------------------------------------

If you want to set a default placeholder view for all your components you can do so by referencing the view in the `/config/livewire.php` config file:

    'lazy_placeholder' => 'livewire.placeholder',

Now, when a component is lazy-loaded and no `placeholder()` is defined, Livewire will use the configured Blade view (`livewire.placeholder` in this case.)

[#](#disabling-lazy-loading-for-tests "Permalink")Disabling lazy loading for tests
----------------------------------------------------------------------------------

When unit testing a lazy component, or a page with nested lazy components, you may want to disable the "lazy" behavior so that you can assert the final rendered behavior. Otherwise, those components would be rendered as their placeholders during your tests.

You can easily disable lazy loading using the `Livewire::withoutLazyLoading()` testing helper like so:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\Dashboard;use Livewire\Livewire;use Tests\TestCase; class DashboardTest extends TestCase{    /** @test */    public function renders_successfully()    {        Livewire::withoutLazyLoading()             ->test(Dashboard::class)            ->assertSee(...);    }}

Now, when the dashboard component is rendered for this test, it will skip rendering the `placeholder()` and instead render the full component as if lazy loading wasn't applied at all.

---

## Lifecycle Hooks

Lifecycle Hooks
===============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire provides a variety of lifecycle hooks that allow you to execute code at specific points during a component's lifecycle. These hooks enable you to perform actions before or after particular events, such as initializing the component, updating properties, or rendering the template.

Here's a list of all the available component lifecycle hooks:

Hook Method

Description

`mount()`

Called when a component is created

`hydrate()`

Called when a component is re-hydrated at the beginning of a subsequent request

`boot()`

Called at the beginning of every request. Both initial, and subsequent

`updating()`

Called before updating a component property

`updated()`

Called after updating a property

`rendering()`

Called before `render()` is called

`rendered()`

Called after `render()` is called

`dehydrate()`

Called at the end of every component request

`exception($e, $stopPropagation)`

Called when an exception is thrown

[#](#mount "Permalink")Mount
----------------------------

In a standard PHP class, a constructor (`__construct()`) takes in outside parameters and initializes the object's state. However, in Livewire, you use the `mount()` method for accepting parameters and initializing the state of your component.

Livewire components don't use `__construct()` because Livewire components are _re-constructed_ on subsequent network requests, and we only want to initialize the component once when it is first created.

Here's an example of using the `mount()` method to initialize the `name` and `email` properties of an `UpdateProfile` component:

    use Illuminate\Support\Facades\Auth;use Livewire\Component; class UpdateProfile extends Component{    public $name;     public $email;     public function mount()    {        $this->name = Auth::user()->name;         $this->email = Auth::user()->email;    }     // ...}

As mentioned earlier, the `mount()` method receives data passed into the component as method parameters:

    use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public $title;     public $content;     public function mount(Post $post)    {        $this->title = $post->title;         $this->content = $post->content;    }     // ...}

You can use dependency injection with all hook methods

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Livewire allows you to resolve dependencies out of [Laravel's service container](https://laravel.com/docs/container#automatic-injection) by type-hinting method parameters on lifecycle hooks.

The `mount()` method is a crucial part of using Livewire. The following documentation provides further examples of using the `mount()` method to accomplish common tasks:

*   [Initializing properties](/docs/properties#initializing-properties)
*   [Receiving data from parent components](/docs/nesting#passing-props-to-children)
*   [Accessing route parameters](/docs/components#accessing-route-parameters)

[#](#boot "Permalink")Boot
--------------------------

As helpful as `mount()` is, it only runs once per component lifecycle, and you may want to run logic at the beginning of every single request to the server for a given component.

For these cases, Livewire provides a `boot()` method where you can write component setup code that you intend to run every single time the component class is booted: both on initialization and on subsequent requests.

The `boot()` method can be useful for things like initializing protected properties, which are not persisted between requests. Below is an example of initializing a protected property as an Eloquent model:

    use Livewire\Attributes\Locked;use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    #[Locked]    public $postId = 1;     protected Post $post;     public function boot()     {        $this->post = Post::find($this->postId);    }     // ...}

You can use this technique to have complete control over initializing a component property in your Livewire component.

Most of the time, you can use a computed property instead

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

The technique used above is powerful; however, it's often better to use [Livewire's computed properties](/docs/computed-properties) to solve this use case.

Always lock sensitive public properties

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

As you can see above, we are using the `#[Locked]` attribute on the `$postId` property. In a scenario like the above, where you want to ensure the `$postId` property isn't tampered with by users on the client-side, it's important to authorize the property's value before using it or add `#[Locked]` to the property ensure it is never changed.

For more information, check out the [documentation on Locked properties](/docs/locked).

[#](#update "Permalink")Update
------------------------------

Client-side users can update public properties in many different ways, most commonly by modifying an input with `wire:model` on it.

Livewire provides convenient hooks to intercept the updating of a public property so that you can validate or authorize a value before it's set, or ensure a property is set in a given format.

Below is an example of using `updating` to prevent the modification of the `$postId` property.

It's worth noting that for this particular example, in an actual application, you should use the [`#[Locked]` attribute](/docs/locked) instead, like in the above example.

    use Exception;use Livewire\Component; class ShowPost extends Component{    public $postId = 1;     public function updating($property, $value)    {        // $property: The name of the current property being updated        // $value: The value about to be set to the property         if ($property === 'postId') {            throw new Exception;        }    }     // ...}

The above `updating()` method runs before the property is updated, allowing you to catch invalid input and prevent the property from updating. Below is an example of using `updated()` to ensure a property's value stays consistent:

    use Livewire\Component; class CreateUser extends Component{    public $username = '';     public $email = '';     public function updated($property)    {        // $property: The name of the current property that was updated         if ($property === 'username') {            $this->username = strtolower($this->username);        }    }     // ...}

Now, anytime the `$username` property is updated client-side, we will ensure that the value will always be lowercase.

Because you are often targeting a specific property when using update hooks, Livewire allows you to specify the property name directly as part of the method name. Here's the same example from above but rewritten utilizing this technique:

    use Livewire\Component; class CreateUser extends Component{    public $username = '';     public $email = '';     public function updatedUsername()    {        $this->username = strtolower($this->username);    }     // ...}

Of course, you can also apply this technique to the `updating` hook.

### [#](#arrays "Permalink")Arrays

Array properties have an additional `$key` argument passed to these functions to specify the changing element.

Note that when the array itself is updated instead of a specific key, the `$key` argument is null.

    use Livewire\Component; class UpdatePreferences extends Component{    public $preferences = [];     public function updatedPreferences($value, $key)    {        // $value = 'dark'        // $key   = 'theme'    }     // ...}

[#](#hydrate--dehydrate "Permalink")Hydrate & Dehydrate
-------------------------------------------------------

Hydrate and dehydrate are lesser-known and lesser-utilized hooks. However, there are specific scenarios where they can be powerful.

The terms "dehydrate" and "hydrate" refer to a Livewire component being serialized to JSON for the client-side and then unserialized back into a PHP object on the subsequent request.

We often use the terms "hydrate" and "dehydrate" to refer to this process throughout Livewire's codebase and the documentation. If you'd like more clarity on these terms, you can learn more by [consulting our hydration documentation](/docs/hydration).

Let's look at an example that uses both `mount()` , `hydrate()`, and `dehydrate()` all together to support using a custom [data transfer object (DTO)](https://en.wikipedia.org/wiki/Data_transfer_object) instead of an Eloquent model to store the post data in the component:

    use Livewire\Component; class ShowPost extends Component{    public $post;     public function mount($title, $content)    {        // Runs at the beginning of the first initial request...         $this->post = new PostDto([            'title' => $title,            'content' => $content,        ]);    }     public function hydrate()    {        // Runs at the beginning of every "subsequent" request...        // This doesn't run on the initial request ("mount" does)...         $this->post = new PostDto($this->post);    }     public function dehydrate()    {        // Runs at the end of every single request...         $this->post = $this->post->toArray();    }     // ...}

Now, from actions and other places inside your component, you can access the `PostDto` object instead of the primitive data.

The above example mainly demonstrates the abilities and nature of the `hydrate()` and `dehydrate()` hooks. However, it is recommended that you use [Wireables or Synthesizers](/docs/properties#supporting-custom-types) to accomplish this instead.

[#](#render "Permalink")Render
------------------------------

If you want to hook into the process of rendering a component's Blade view, you can do so using the `rendering()` and `rendered()` hooks:

    use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    public function render()    {        return view('livewire.show-posts', [            'post' => Post::all(),        ])    }     public function rendering($view, $data)    {        // Runs BEFORE the provided view is rendered...        //        // $view: The view about to be rendered        // $data: The data provided to the view    }     public function rendered($view, $html)    {        // Runs AFTER the provided view is rendered...        //        // $view: The rendered view        // $html: The final, rendered HTML    }     // ...}

[#](#exception "Permalink")Exception
------------------------------------

Sometimes it can be helpful to intercept and catch errors, eg: to customize the error message or ignore specific type of exceptions. The `exception()` hook allows you to do just that: you can perform check on the `$error`, and use the `$stopPropagation` parameter to catch the issue. This also unlocks powerful patterns when you want to stop further execution of code (return early), this is how internal methods like `validate()` works.

    use Livewire\Component; class ShowPost extends Component{    public function mount()     {        $this->post = Post::find($this->postId);    }     public function exception($e, $stopPropagation) {        if ($e instanceof NotFoundException) {            $this->notify('Post is not found');            $stopPropagation();        }    }     // ...}

[#](#using-hooks-inside-a-trait "Permalink")Using hooks inside a trait
----------------------------------------------------------------------

Traits are a helpful way to reuse code across components or extract code from a single component into a dedicated file.

To avoid multiple traits conflicting with each other when declaring lifecycle hook methods, Livewire supports prefixing hook methods with the _camelCased_ name of the current trait declaring them.

This way, you can have multiple traits using the same lifecycle hooks and avoid conflicting method definitions.

Below is an example of a component referencing a trait called `HasPostForm`:

    use Livewire\Component; class CreatePost extends Component{    use HasPostForm;     // ...}

Now here's the actual `HasPostForm` trait containing all the available prefixed hooks:

    trait HasPostForm{    public $title = '';     public $content = '';     public function mountHasPostForm()    {        // ...    }     public function hydrateHasPostForm()    {        // ...    }     public function bootHasPostForm()    {        // ...    }     public function updatingHasPostForm()    {        // ...    }     public function updatedHasPostForm()    {        // ...    }     public function renderingHasPostForm()    {        // ...    }     public function renderedHasPostForm()    {        // ...    }     public function dehydrateHasPostForm()    {        // ...    }     // ...}

---

## Locked

Locked Properties
=================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire properties are able to be modified freely on both the frontend and backend using utilities like `wire:model`. If you want to prevent a property — like a model ID — from being modified on the frontend, you can use Livewire's `#[Locked]` attribute.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Below is a `ShowPost` component that stores a `Post` model's ID as a public property named `$id`. To keep this property from being modified by a curious or malicious user, you can add the `#[Locked]` attribute to the property:

Make sure you import attribute classes

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Make sure you import any attribute classes. For example, the below `#[Locked]` attribute requires the following import `use Livewire\Attributes\Locked;`.

    use Livewire\Attributes\Locked;use Livewire\Component; class ShowPost extends Component{    #[Locked]     public $id;     public function mount($postId)    {        $this->id = $postId;    }     // ...}

By adding the `#[Locked]` attribute, you are ensured that the `$id` property will never be tampered with.

Model properties are secure by default

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you store an Eloquent model in a public property instead of just the model's ID, Livewire will ensure the ID isn't tampered with, without you needing to explicitly add the `#[Locked]` attribute to the property. For most cases, this is a better approach than using `#[Locked]`:

    class ShowPost extends Component{   public Post $post;     public function mount($postId)   {       $this->post = Post::find($postId);   }   // ...}

### [#](#why-not-use-protected-properties "Permalink")Why not use protected properties?

You might ask yourself: why not just use protected properties for sensitive data?

Remember, Livewire only persists public properties between network requests. For static, hard-coded data, protected properties are suitable. However, for data that is stored at runtime, you must use a public property to ensure that the data is persisted properly.

### [#](#cant-livewire-do-this-automatically "Permalink")Can't Livewire do this automatically?

In a perfect world, Livewire would lock properties by default, and only allow modifications when `wire:model` is used on that property.

Unfortunately, that would require Livewire to parse all of your Blade templates to understand if a property is modified by `wire:model` or a similar API.

Not only would that add technical and performance overhead, it would be impossible to detect if a property is mutated by something like Alpine or any other custom JavaScript.

Therefore, Livewire will continue to make public properties freely mutable by default and give developers the tools to lock them as needed.

---

## Morphing

Morphing
========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

When a Livewire component updates the browser's DOM, it does so in an intelligent way we call "morphing". The term _morph_ is in contrast with a word like _replace_.

Instead of _replacing_ a component's HTML with newly rendered HTML every time a component is updated, Livewire dynamically compares the current HTML with the new HTML, identifies differences, and makes surgical changes to the HTML only in the places where changes are needed.

This has the benefit of preserving existing, un-changed elements on a component. For example, event listeners, focus state, and form input values are all preserved between Livewire updates. Of course, morphing also offers increased performance compared to wiping and re-rending new DOM on every update.

[#](#how-morphing-works "Permalink")How morphing works
------------------------------------------------------

To understand how Livewire determines which elements to update between Livewire requests, consider this simple `Todos` component:

    class Todos extends Component{    public $todo = '';     public $todos = [        'first',        'second',    ];     public function add()    {        $this->todos[] = $this->todo;    }}

    <form wire:submit="add">    <ul>        @foreach ($todos as $item)            <li>{{ $item }}</li>        @endforeach    </ul>     <input wire:model="todo"></form>

The initial render of this component will output the following HTML:

    <form wire:submit="add">    <ul>        <li>first</li>         <li>second</li>    </ul>     <input wire:model="todo"></form>

Now, imagine you typed "third" into the input field and pressed the `[Enter]` key. The newly rendered HTML would be:

     <form wire:submit="add">     <ul>         <li>first</li>           <li>second</li>  +        <li>third</li>      </ul>       <input wire:model="todo"> </form>

When Livewire processes the component update, it _morphs_ the original DOM into the newly rendered HTML. The following visualization should intuitively give you an understanding of how it works:

As you can see, Livewire walks both HTML trees simultaneously. As it encounters each element in both trees, it compares them for changes, additions, and removals. If it detects one, it surgically makes the appropriate change.

[#](#morphing-shortcomings "Permalink")Morphing shortcomings
------------------------------------------------------------

The following are scenarios where morphing algorithms fail to correctly identify the change in HTML trees and therefore cause problems in your application.

### [#](#inserting-intermediate-elements "Permalink")Inserting intermediate elements

Consider the following Livewire Blade template for a fictitious `CreatePost` component:

    <form wire:submit="save">    <div>        <input wire:model="title">    </div>     @if ($errors->has('title'))        <div>{{ $errors->first('title') }}</div>    @endif     <div>        <button>Save</button>    </div></form>

If a user tries submitting the form, but encounters a validation error, the following problem occurs:

As you can see, when Livewire encounters the new `<div>` for the error message, it doesn't know whether to change the existing `<div>` in-place, or insert the new `<div>` in the middle.

To re-iterate what's happening more explicitly:

*   Livewire encounters the first `<div>` in both trees. They are the same, so it continues.
*   Livewire encounters the second `<div>` in both trees and thinks they are the same `<div>`, just one has changed contents. So instead of inserting the error message as a new element, it changes the `<button>` into an error message.
*   Livewire then, after mistakenly modifying the previous element, notices an additional element at the end of the comparison. It then creates and appends the element after the previous one.
*   Therefore, destroying, then re-creating an element that otherwise should have been simply moved.

This scenario is at the root of almost all morph-related bugs.

Here are a few specific problematic impacts of these bugs:

*   Event listeners and element state are lost between updates
*   Event listeners and state are misplaced across the wrong elements
*   Entire Livewire components can be reset or duplicated as Livewire components are also simply elements in the DOM tree
*   Alpine components and state can be lost or misplaced

Fortunately, Livewire has worked hard to mitigate these problems using the following approaches:

### [#](#internal-look-ahead "Permalink")Internal look-ahead

Livewire has an additional step in its morphing algorithm that checks subsequent elements and their contents before changing an element.

This prevents the above scenario from happening in many cases.

Here is a visualization of the "look-ahead" algorithm in action:

### [#](#injecting-morph-markers "Permalink")Injecting morph markers

On the backend, Livewire automatically detects conditionals inside Blade templates and wraps them in HTML comment markers that Livewire's JavaScript can use as a guide when morphing.

Here's an example of the previous Blade template but with Livewire's injected markers:

    <form wire:submit="save">    <div>        <input wire:model="title">    </div>     <!--[if BLOCK]><![endif]-->    @if ($errors->has('title'))        <div>Error: {{ $errors->first('title') }}</div>    @endif    <!--[if ENDBLOCK]><![endif]-->     <div>        <button>Save</button>    </div></form>

With these markers injected into the template, Livewire can now more easily detect the difference between a change and an addition.

This feature is extremely beneficial to Livewire applications, but because it requires parsing templates via regex, it can sometimes fail to properly detect conditionals. If this feature is more of a hindrance than a help to your application, you can disable it with the following configuration in your application's `config/livewire.php` file:

    'inject_morph_markers' => false,

#### [#](#wrapping-conditionals "Permalink")Wrapping conditionals

If the above two solutions don't cover your situation, the most reliable way to avoid morphing problems is to wrap conditionals and loops in their own elements that are always present.

For example, here's the above Blade template rewritten with wrapping `<div>` elements:

    <form wire:submit="save">    <div>        <input wire:model="title">    </div>     <div>         @if ($errors->has('title'))            <div>{{ $errors->first('title') }}</div>        @endif    </div>      <div>        <button>Save</button>    </div></form>

Now that the conditional has been wrapped in a persistent element, Livewire will morph the two different HTML trees properly.

#### [#](#bypassing-morphing "Permalink")Bypassing morphing

If you need to bypass morphing entirely for an element, you can use [wire:replace](/docs/wire-replace) to instruct livewire to replace all children of an element instead of attempting to morph the existing elements.

---

## Navigate

Navigate
========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Many modern web applications are built as "single page applications" (SPAs). In these applications, each page rendered by the application no longer requires a full browser page reload, avoiding the overhead of re-downloading JavaScript and CSS assets on every request.

The alternative to a _single page application_ is a _multi-page application_. In these applications, every time a user clicks a link, an entirely new HTML page is requested and rendered in the browser.

While most PHP applications have traditionally been multi-page applications, Livewire offers a single page application experience via a simple attribute you can add to links in your application: `wire:navigate`.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Let's explore an example of using `wire:navigate`. Below is a typical Laravel routes file (`routes/web.php`) with three Livewire components defined as routes:

    use App\Livewire\Dashboard;use App\Livewire\ShowPosts;use App\Livewire\ShowUsers; Route::get('/', Dashboard::class); Route::get('/posts', ShowPosts::class); Route::get('/users', ShowUsers::class);

By adding `wire:navigate` to each link in a navigation menu on each page, Livewire will prevent the standard handling of the link click and replace it with its own, faster version:

    <nav>    <a href="/" wire:navigate>Dashboard</a>    <a href="/posts" wire:navigate>Posts</a>    <a href="/users" wire:navigate>Users</a></nav>

Below is a breakdown of what happens when a `wire:navigate` link is clicked:

*   User clicks a link
*   Livewire prevents the browser from visiting the new page
*   Instead, Livewire requests the page in the background and shows a loading bar at the top of the page
*   When the HTML for the new page has been received, Livewire replaces the current page's URL, `<title>` tag and `<body>` contents with the elements from the new page

This technique results in much faster page load times — often twice as fast — and makes the application "feel" like a JavaScript powered single page application.

[#](#redirects "Permalink")Redirects
------------------------------------

When one of your Livewire components redirects users to another URL within your application, you can also instruct Livewire to use its `wire:navigate` functionality to load the new page. To accomplish this, provide the `navigate` argument to the `redirect()` method:

    return $this->redirect('/posts', navigate: true);

Now, instead of a full page request being used to redirect the user to the new URL, Livewire will replace the contents and URL of the current page with the new one.

[#](#prefetching-links "Permalink")Prefetching links
----------------------------------------------------

By default, Livewire includes a gentle strategy to _prefetch_ pages before a user clicks on a link:

*   A user presses down on their mouse button
*   Livewire starts requesting the page
*   They lift up on the mouse button to complete the _click_
*   Livewire finishes the request and navigates to the new page

Surprisingly, the time between a user pressing down and lifting up on the mouse button is often enough time to load half or even an entire page from the server.

If you want an even more aggressive approach to prefetching, you may use the `.hover` modifier on a link:

    <a href="/posts" wire:navigate.hover>Posts</a>

The `.hover` modifier will instruct Livewire to prefetch the page after a user has hovered over the link for `60` milliseconds.

Prefetching on hover increases server usage

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Because not all users will click a link they hover over, adding `.hover` will request pages that may not be needed, though Livewire attempts to mitigate some of this overhead by waiting `60` milliseconds before prefetching the page.

[#](#persisting-elements-across-page-visits "Permalink")Persisting elements across page visits
----------------------------------------------------------------------------------------------

Sometimes, there are parts of a user interface that you need to persist between page loads, such as audio or video players. For example, in a podcasting application, a user may want to keep listening to an episode as they browse other pages.

You can achieve this in Livewire with the `@persist` directive.

By wrapping an element with `@persist` and providing it with a name, when a new page is requested using `wire:navigate`, Livewire will look for an element on the new page that has a matching `@persist`. Instead of replacing the element like normal, Livewire will use the existing DOM element from the previous page in the new page, preserving any state within the element.

Here is an example of an `<audio>` player element being persisted across pages using `@persist`:

    @persist('player')    <audio src="{{ $episode->file }}" controls></audio>@endpersist

If the above HTML appears on both pages — the current page, and the next one — the original element will be re-used on the new page. In the case of an audio player, the audio playback won't be interrupted when navigating from one page to another.

Please be aware that the persisted element must be placed outside your Livewire components. A common practice is to position the persisted element in your main layout, such as `resources/views/components/layouts/app.blade.php`.

    <!-- resources/views/components/layouts/app.blade.php --> <!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">         <title>{{ $title ?? 'Page Title' }}</title>    </head>    <body>        <main>            {{ $slot }}        </main>         @persist('player')             <audio src="{{ $episode->file }}" controls></audio>        @endpersist    </body></html>

### [#](#highlighting-active-links "Permalink")Highlighting active links

You might be used to highlighting the currently active page link in a navbar using server-side Blade like so:

    <nav>    <a href="/" class="@if (request->is('/')) font-bold text-zinc-800 @endif">Dashboard</a>    <a href="/posts" class="@if (request->is('/posts')) font-bold text-zinc-800 @endif">Posts</a>    <a href="/users" class="@if (request->is('/users')) font-bold text-zinc-800 @endif">Users</a></nav>

However, this will not work inside persisted elements as they are re-used between page loads. Instead, you should use Livewire's `wire:current` directive to highlight the currently active link.

Simply pass any CSS classes you want to apply to the currently active link to `wire:current`:

    <nav>    <a href="/dashboard" ... wire:current="font-bold text-zinc-800">Dashboard</a>    <a href="/posts" ... wire:current="font-bold text-zinc-800">Posts</a>    <a href="/users" ... wire:current="font-bold text-zinc-800">Users</a></nav>

Now, when the `/posts` page is visited, the "Posts" link will have a stronger font treatment than the other links.

Read more in the [`wire:current` documentation](/docs/wire-current).

### [#](#preserving-scroll-position "Permalink")Preserving scroll position

By default, Livewire will preserve the scroll position of a page when navigating back and forth between pages. However, sometimes you may want to preserve the scroll position of an individual element you are persisting between page loads.

To do this, you must add `wire:scroll` to the element containing a scrollbar like so:

    @persist('scrollbar')<div class="overflow-y-scroll" wire:scroll>     <!-- ... --></div>@endpersist

[#](#javascript-hooks "Permalink")JavaScript hooks
--------------------------------------------------

Each page navigation triggers three lifecycle hooks:

*   `livewire:navigate`
*   `livewire:navigating`
*   `livewire:navigated`

It's important to note that these three hooks events are dispatched on navigations of all types. This includes manual navigation using `Livewire.navigate()`, redirecting with navigation enabled, and back and forward button presses in the browser.

Here's an example of registering listeners for each of these events:

    document.addEventListener('livewire:navigate', (event) => {    // Triggers when a navigation is triggered.     // Can be "cancelled" (prevent the navigate from actually being performed):    event.preventDefault()     // Contains helpful context about the navigation trigger:    let context = event.detail     // A URL object of the intended destination of the navigation...    context.url     // A boolean [true/false] indicating whether or not this navigation    // was triggered by a back/forward (history state) navigation...    context.history     // A boolean [true/false] indicating whether or not there is    // cached version of this page to be used instead of    // fetching a new one via a network round-trip...    context.cached}) document.addEventListener('livewire:navigating', () => {    // Triggered when new HTML is about to swapped onto the page...     // This is a good place to mutate any HTML before the page    // is navigated away from...}) document.addEventListener('livewire:navigated', () => {    // Triggered as the final step of any page navigation...     // Also triggered on page-load instead of "DOMContentLoaded"...})

Event listeners will persist across pages

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

When you attach an event listener to the document it will not be removed when you navigate to a different page. This can lead to unexpected behaviour if you need code to run only after navigating to a specific page, or if you add the same event listener on every page. If you do not remove your event listener it may cause exceptions on other pages when it's looking for elements that do not exist, or you may end up with the event listener executing multiple times per navigation.

An easy method to remove an event listener after it runs is to pass the option `{once: true}` as a third parameter to the `addEventListener` function.

    document.addEventListener('livewire:navigated', () => {    // ...}, { once: true })

[#](#manually-visiting-a-new-page "Permalink")Manually visiting a new page
--------------------------------------------------------------------------

In addition to `wire:navigate`, you can manually call the `Livewire.navigate()` method to trigger a visit to a new page using JavaScript:

    <script>    // ...     Livewire.navigate('/new/url')</script>

[#](#using-with-analytics-software "Permalink")Using with analytics software
----------------------------------------------------------------------------

When navigating pages using `wire:navigate` in your app, any `<script>` tags in the `<head>` only evaluate when the page is initially loaded.

This creates a problem for analytics software such as [Fathom Analytics](https://usefathom.com/). These tools rely on a `<script>` snippet being evaluated on every single page change, not just the first.

Tools like [Google Analytics](https://marketingplatform.google.com/about/analytics/) are smart enough to handle this automatically, however, when using Fathom Analytics, you must add `data-spa="auto"` to your script tag to ensure each page visit is tracked properly:

    <head>    <!-- ... -->     <!-- Fathom Analytics -->    @if (! config('app.debug'))        <script src="https://cdn.usefathom.com/script.js" data-site="ABCDEFG" data-spa="auto" defer></script>     @endif</head>

[#](#script-evaluation "Permalink")Script evaluation
----------------------------------------------------

When navigating to a new page using `wire:navigate`, it _feels_ like the browser has changed pages; however, from the browser's perspective, you are technically still on the original page.

Because of this, styles and scripts are executed normally on the first page, but on subsequent pages, you may have to tweak the way you normally write JavaScript.

Here are a few caveats and scenarios you should be aware of when using `wire:navigate`.

### [#](#dont-rely-on-domcontentloaded "Permalink")Don't rely on `DOMContentLoaded`

It's common practice to place JavaScript inside a `DOMContentLoaded` event listener so that the code you want to run only executes after the page has fully loaded.

When using `wire:navigate`, `DOMContentLoaded` is only fired on the first page visit, not subsequent visits.

To run code on every page visit, swap every instance of `DOMContentLoaded` with `livewire:navigated`:

    -document.addEventListener('DOMContentLoaded', () => { +document.addEventListener('livewire:navigated', () => {      // ... })

Now, any code placed inside this listener will be run on the initial page visit, and also after Livewire has finished navigating to subsequent pages.

Listening to this event is useful for things like initializing third-party libraries.

### [#](#scripts-in-head-are-loaded-once "Permalink")Scripts in `<head>` are loaded once

If two pages include the same `<script>` tag in the `<head>`, that script will only be run on the initial page visit and not on subsequent page visits.

    <!-- Page one --><head>    <script src="/app.js"></script></head> <!-- Page two --><head>    <script src="/app.js"></script></head>

### [#](#new-head-scripts-are-evaluated "Permalink")New `<head>` scripts are evaluated

If a subsequent page includes a new `<script>` tag in the `<head>` that was not present in the `<head>` of the initial page visit, Livewire will run the new `<script>` tag.

In the below example, _page two_ includes a new JavaScript library for a third-party tool. When the user navigates to _page two_, that library will be evaluated.

    <!-- Page one --><head>    <script src="/app.js"></script></head> <!-- Page two --><head>    <script src="/app.js"></script>    <script src="/third-party.js"></script></head>

Head assets are blocking

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you are navigating to a new page that contains an asset like `<script src="...">` in the head tag. That asset will be fetched and processed before the navigation is complete and the new page is swapped in. This might be surprising behavior, but it ensures any scripts that depend on those assets will have immediate access to them.

### [#](#reloading-when-assets-change "Permalink")Reloading when assets change

It's common practice to include a version hash in an application's main JavaScript file name. This ensures that after deploying a new version of your application, users will receive the fresh JavaScript asset, and not an old version served from the browser's cache.

But, now that you are using `wire:navigate` and each page visit is no longer a fresh browser page load, your users may still be receiving stale JavaScript after deployments.

To prevent this, you may add `data-navigate-track` to a `<script>` tag in `<head>`:

    <!-- Page one --><head>    <script src="/app.js?id=123" data-navigate-track></script></head> <!-- Page two --><head>    <script src="/app.js?id=456" data-navigate-track></script></head>

When a user visits _page two_, Livewire will detect a fresh JavaScript asset and trigger a full browser page reload.

If you are using [Laravel's Vite plug-in](https://laravel.com/docs/vite#loading-your-scripts-and-styles) to bundle and serve your assets, Livewire adds `data-navigate-track` to the rendered HTML asset tags automatically. You can continue referencing your assets and scripts like normal:

    <head>    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>

Livewire will automatically inject `data-navigate-track` onto the rendered HTML tags.

Only query string changes are tracked

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Livewire will only reload a page if a `[data-navigate-track]` element's query string (`?id="456"`) changes, not the URI itself (`/app.js`).

### [#](#scripts-in-the-body-are-re-evaluated "Permalink")Scripts in the `<body>` are re-evaluated

Because Livewire replaces the entire contents of the `<body>` on every new page, all `<script>` tags on the new page will be run:

    <!-- Page one --><body>    <script>        console.log('Runs on page one')    </script></body> <!-- Page two --><body>    <script>        console.log('Runs on page two')    </script></body>

If you have a `<script>` tag in the body that you only want to be run once, you can add the `data-navigate-once` attribute to the `<script>` tag and Livewire will only run it on the initial page visit:

    <script data-navigate-once>    console.log('Runs only on page one')</script>

[#](#customizing-the-progress-bar "Permalink")Customizing the progress bar
--------------------------------------------------------------------------

When a page takes longer than 150ms to load, Livewire will show a progress bar at the top of the page.

You can customize the color of this bar or disable it all together inside Livewire's config file (`config/livewire.php`):

    'navigate' => [    'show_progress_bar' => false,    'progress_bar_color' => '#2299dd',],

---

## Nesting

Nesting Components
==================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire allows you to nest additional Livewire components inside of a parent component. This feature is immensely powerful, as it allows you to re-use and encapsulate behavior within Livewire components that are shared across your application.

You might not need a Livewire component

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before you extract a portion of your template into a nested Livewire component, ask yourself: Does this content in this component need to be "live"? If not, we recommend that you create a simple [Blade component](https://laravel.com/docs/blade#components) instead. Only create a Livewire component if the component benefits from Livewire's dynamic nature or if there is a direct performance benefit.

Consult our [in-depth, technical examination of Livewire component nesting](/docs/understanding-nesting) for more information on the performance, usage implications, and constraints of nested Livewire components.

[#](#nesting-a-component "Permalink")Nesting a component
--------------------------------------------------------

To nest a Livewire component within a parent component, simply include it in the parent component's Blade view. Below is an example of a `Dashboard` parent component that contains a nested `TodoList` component:

    <?php namespace App\Livewire; use Livewire\Component; class Dashboard extends Component{    public function render()    {        return view('livewire.dashboard');    }}

    <div>    <h1>Dashboard</h1>     <livewire:todo-list /> </div>

On this page's initial render, the `Dashboard` component will encounter `<livewire:todo-list />` and render it in place. On a subsequent network request to `Dashboard`, the nested `todo-list` component will skip rendering because it is now its own independent component on the page. For more information on the technical concepts behind nesting and rendering, consult our documentation on why [nested components are "islands"](/docs/understanding-nesting#every-component-is-an-island).

For more information about the syntax for rendering components, consult our documentation on [Rendering Components](/docs/components#rendering-components).

[#](#passing-props-to-children "Permalink")Passing props to children
--------------------------------------------------------------------

Passing data from a parent component to a child component is straightforward. In fact, it's very much like passing props to a typical [Blade component](https://laravel.com/docs/blade#components).

For example, let's check out a `TodoList` component that passes a collection of `$todos` to a child component called `TodoCount`:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class TodoList extends Component{    public function render()    {        return view('livewire.todo-list', [            'todos' => Auth::user()->todos,        ]);    }}

    <div>    <livewire:todo-count :todos="$todos" />     <!-- ... --></div>

As you can see, we are passing `$todos` into `todo-count` with the syntax: `:todos="$todos"`.

Now that `$todos` has been passed to the child component, you can receive that data through the child component's `mount()` method:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Todo; class TodoCount extends Component{    public $todos;     public function mount($todos)    {        $this->todos = $todos;    }     public function render()    {        return view('livewire.todo-count', [            'count' => $this->todos->count(),        ]);    }}

Omit`mount()` as a shorter alternative

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If the `mount()` method in above example feels like redundant boilerplate code to you, it can be omitted as long as the property and parameter names match:

    public $todos; 

### [#](#passing-static-props "Permalink")Passing static props

In the previous example, we passed props to our child component using Livewire's dynamic prop syntax, which supports PHP expressions like so:

    <livewire:todo-count :todos="$todos" />

However, sometimes you may want to pass a component a simple static value such as a string. In these cases, you may omit the colon from the beginning of the statement:

    <livewire:todo-count :todos="$todos" label="Todo Count:" />

Boolean values may be provided to components by only specifying the key. For example, to pass an `$inline` variable with a value of `true` to a component, we may simply place `inline` on the component tag:

    <livewire:todo-count :todos="$todos" inline />

### [#](#shortened-attribute-syntax "Permalink")Shortened attribute syntax

When passing PHP variables into a component, the variable name and the prop name are often the same. To avoid writing the name twice, Livewire allows you to simply prefix the variable with a colon:

    -<livewire:todo-count :todos="$todos" />   +<livewire:todo-count :$todos /> 

[#](#rendering-children-in-a-loop "Permalink")Rendering children in a loop
--------------------------------------------------------------------------

When rendering a child component within a loop, you should include a unique `key` value for each iteration.

Component keys are how Livewire tracks each component on subsequent renders, particularly if a component has already been rendered or if multiple components have been re-arranged on the page.

You can specify the component's key by specifying a `:key` prop on the child component:

    <div>    <h1>Todos</h1>     @foreach ($todos as $todo)        <livewire:todo-item :$todo :key="$todo->id" />    @endforeach</div>

As you can see, each child component will have a unique key set to the ID of each `$todo`. This ensures the key will be unique and tracked if the todos are re-ordered.

Keys aren't optional

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you have used frontend frameworks like Vue or Alpine, you are familiar with adding a key to a nested element in a loop. However, in those frameworks, a key isn't _mandatory_, meaning the items will render, but a re-order might not be tracked properly. However, Livewire relies more heavily on keys and will behave incorrectly without them.

[#](#reactive-props "Permalink")Reactive props
----------------------------------------------

Developers new to Livewire expect that props are "reactive" by default. In other words, they expect that when a parent changes the value of a prop being passed into a child component, the child component will automatically be updated. However, by default, Livewire props are not reactive.

When using Livewire, [every component is an island](/docs/understanding-nesting#every-component-is-an-island). This means that when an update is triggered on the parent and a network request is dispatched, only the parent component's state is sent to the server to re-render - not the child component's. The intention behind this behavior is to only send the minimal amount of data back and forth between the server and client, making updates as performant as possible.

But, if you want or need a prop to be reactive, you can easily enable this behavior using the `#[Reactive]` attribute parameter.

For example, below is the template of a parent `TodoList` component. Inside, it is rendering a `TodoCount` component and passing in the current list of todos:

    <div>    <h1>Todos:</h1>     <livewire:todo-count :$todos />     <!-- ... --></div>

Now let's add `#[Reactive]` to the `$todos` prop in the `TodoCount` component. Once we have done so, any todos that are added or removed inside the parent component will automatically trigger an update within the `TodoCount` component:

    <?php namespace App\Livewire; use Livewire\Attributes\Reactive;use Livewire\Component;use App\Models\Todo; class TodoCount extends Component{    #[Reactive]     public $todos;     public function render()    {        return view('livewire.todo-count', [            'count' => $this->todos->count(),        ]);    }}

Reactive properties are an incredibly powerful feature, making Livewire more similar to frontend component libraries like Vue and React. But, it is important to understand the performance implications of this feature and only add `#[Reactive]` when it makes sense for your particular scenario.

[#](#binding-to-child-data-using-wiremodel "Permalink")Binding to child data using `wire:model`
-----------------------------------------------------------------------------------------------

Another powerful pattern for sharing state between parent and child components is using `wire:model` directly on a child component via Livewire's `Modelable` feature.

This behavior is very commonly needed when extracting an input element into a dedicated Livewire component while still accessing its state in the parent component.

Below is an example of a parent `TodoList` component that contains a `$todo` property which tracks the current todo about to be added by a user:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Todo; class TodoList extends Component{    public $todo = '';     public function add()    {        Todo::create([            'content' => $this->pull('todo'),        ]);    }     public function render()    {        return view('livewire.todo-list', [            'todos' => Auth::user()->todos,        ]);    }}

As you can see in the `TodoList` template, `wire:model` is being used to bind the `$todo` property directly to a nested `TodoInput` component:

    <div>    <h1>Todos</h1>     <livewire:todo-input wire:model="todo" />      <button wire:click="add">Add Todo</button>     <div>        @foreach ($todos as $todo)            <livewire:todo-item :$todo :key="$todo->id" />        @endforeach    </div></div>

Livewire provides a `#[Modelable]` attribute you can add to any child component property to make it _modelable_ from a parent component.

Below is the `TodoInput` component with the `#[Modelable]` attribute added above the `$value` property to signal to Livewire that if `wire:model` is declared on the component by a parent it should bind to this property:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Modelable; class TodoInput extends Component{    #[Modelable]     public $value = '';     public function render()    {        return view('livewire.todo-input');    }}

    <div>    <input type="text" wire:model="value" ></div>

Now the parent `TodoList` component can treat `TodoInput` like any other input element and bind directly to its value using `wire:model`.

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Currently Livewire only supports a single `#[Modelable]` attribute, so only the first one will be bound.

[#](#listening-for-events-from-children "Permalink")Listening for events from children
--------------------------------------------------------------------------------------

Another powerful parent-child component communication technique is Livewire's event system, which allows you to dispatch an event on the server or client that can be intercepted by other components.

Our [complete documentation on Livewire's event system](/docs/events) provides more detailed information on events, but below we'll discuss a simple example of using an event to trigger an update in a parent component.

Consider a `TodoList` component with functionality to show and remove todos:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Todo; class TodoList extends Component{    public function remove($todoId)    {        $todo = Todo::find($todoId);         $this->authorize('delete', $todo);         $todo->delete();    }     public function render()    {        return view('livewire.todo-list', [            'todos' => Auth::user()->todos,        ]);    }}

    <div>    @foreach ($todos as $todo)        <livewire:todo-item :$todo :key="$todo->id" />    @endforeach</div>

To call `remove()` from inside the child `TodoItem` components, you can add an event listener to `TodoList` via the `#[On]` attribute:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Todo;use Livewire\Attributes\On; class TodoList extends Component{    #[On('remove-todo')]     public function remove($todoId)    {        $todo = Todo::find($todoId);         $this->authorize('delete', $todo);         $todo->delete();    }     public function render()    {        return view('livewire.todo-list', [            'todos' => Auth::user()->todos,        ]);    }}

Once the attribute has been added to the action, you can dispatch the `remove-todo` event from the `TodoList` child component:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Todo; class TodoItem extends Component{    public Todo $todo;     public function remove()    {        $this->dispatch('remove-todo', todoId: $this->todo->id);     }     public function render()    {        return view('livewire.todo-item');    }}

    <div>    <span>{{ $todo->content }}</span>     <button wire:click="remove">Remove</button></div>

Now when the "Remove" button is clicked inside a `TodoItem`, the parent `TodoList` component will intercept the dispatched event and perform the todo removal.

After the todo is removed in the parent, the list will be re-rendered and the child that dispatched the `remove-todo` event will be removed from the page.

### [#](#improving-performance-by-dispatching-client-side "Permalink")Improving performance by dispatching client-side

Though the above example works, it takes two network requests to perform a single action:

1.  The first network request from the `TodoItem` component triggers the `remove` action, dispatching the `remove-todo` event.
2.  The second network request is after the `remove-todo` event is dispatched client-side and is intercepted by `TodoList` to call its `remove` action.

You can avoid the first request entirely by dispatching the `remove-todo` event directly on the client-side. Below is an updated `TodoItem` component that does not trigger a network request when dispatching the `remove-todo` event:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Todo; class TodoItem extends Component{    public Todo $todo;     public function render()    {        return view('livewire.todo-item');    }}

    <div>    <span>{{ $todo->content }}</span>     <button wire:click="$dispatch('remove-todo', { todoId: {{ $todo->id }} })">Remove</button></div>

As a rule of thumb, always prefer dispatching client-side when possible.

[#](#directly-accessing-the-parent-from-the-child "Permalink")Directly accessing the parent from the child
----------------------------------------------------------------------------------------------------------

Event communication adds a layer of indirection. A parent can listen for an event that never gets dispatched from a child, and a child can dispatch an event that is never intercepted by a parent.

This indirection is sometimes desirable; however, in other cases you may prefer to access a parent component directly from the child component.

Livewire allows you to accomplish this by providing a magic `$parent` variable to your Blade template that you can use to access actions and properties directly from the child. Here's the above `TodoItem` template rewritten to call the `remove()` action directly on the parent via the magic `$parent` variable:

    <div>    <span>{{ $todo->content }}</span>     <button wire:click="$parent.remove({{ $todo->id }})">Remove</button></div>

Events and direct parent communication are a few of the ways to communicate back and forth between parent and child components. Understanding their tradeoffs enables you to make more informed decisions about which pattern to use in a particular scenario.

[#](#dynamic-child-components "Permalink")Dynamic child components
------------------------------------------------------------------

Sometimes, you may not know which child component should be rendered on a page until run-time. Therefore, Livewire allows you to choose a child component at run-time via `<livewire:dynamic-component ...>`, which receives an `:is` prop:

    <livewire:dynamic-component :is="$current" />

Dynamic child components are useful in a variety of different scenarios, but below is an example of rendering different steps in a multi-step form using a dynamic component:

    <?php namespace App\Livewire; use Livewire\Component; class Steps extends Component{    public $current = 'step-one';     protected $steps = [        'step-one',        'step-two',        'step-three',    ];     public function next()    {        $currentIndex = array_search($this->current, $this->steps);         $this->current = $this->steps[$currentIndex + 1];    }     public function render()    {        return view('livewire.todo-list');    }}

    <div>    <livewire:dynamic-component :is="$current" :key="$current" />     <button wire:click="next">Next</button></div>

Now, if the `Steps` component's `$current` prop is set to "step-one", Livewire will render a component named "step-one" like so:

    <?php namespace App\Livewire; use Livewire\Component; class StepOne extends Component{    public function render()    {        return view('livewire.step-one');    }}

If you prefer, you can use the alternative syntax:

    <livewire:is :component="$current" :key="$current" />

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Don't forget to assign each child component a unique key. Although Livewire automatically generates a key for `<livewire:dynamic-child />` and `<livewire:is />`, that same key will apply to _all_ your child components, meaning subsequent renders will be skipped.

See [forcing a child component to re-render](#forcing-a-child-component-to-re-render) for a deeper understanding of how keys affect component rendering.

[#](#recursive-components "Permalink")Recursive components
----------------------------------------------------------

Although rarely needed by most applications, Livewire components may be nested recursively, meaning a parent component renders itself as its child.

Imagine a survey which contains a `SurveyQuestion` component that can have sub-questions attached to itself:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Question; class SurveyQuestion extends Component{    public Question $question;     public function render()    {        return view('livewire.survey-question', [            'subQuestions' => $this->question->subQuestions,        ]);    }}

    <div>    Question: {{ $question->content }}     @foreach ($subQuestions as $subQuestion)        <livewire:survey-question :question="$subQuestion" :key="$subQuestion->id" />    @endforeach</div>

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Of course, the standard rules of recursion apply to recursive components. Most importantly, you should have logic in your template to ensure the template doesn't recurse indefinitely. In the example above, if a `$subQuestion` contained the original question as its own `$subQuestion`, an infinite loop would occur.

[#](#forcing-a-child-component-to-re-render "Permalink")Forcing a child component to re-render
----------------------------------------------------------------------------------------------

Behind the scenes, Livewire generates a key for each nested Livewire component in its template.

For example, consider the following nested `todo-count` component:

    <div>    <livewire:todo-count :$todos /></div>

Livewire internally attaches a random string key to the component like so:

    <div>    <livewire:todo-count :$todos key="lska" /></div>

When the parent component is rendering and encounters a child component like the above, it stores the key in a list of children attached to the parent:

    'children' => ['lska'],

Livewire uses this list for reference on subsequent renders in order to detect if a child component has already been rendered in a previous request. If it has already been rendered, the component is skipped. Remember, [nested components are islands](/docs/understanding-nesting#every-component-is-an-island). However, if the child key is not in the list, meaning it hasn't been rendered already, Livewire will create a new instance of the component and render it in place.

These nuances are all behind-the-scenes behavior that most users don't need to be aware of; however, the concept of setting a key on a child is a powerful tool for controlling child rendering.

Using this knowledge, if you want to force a component to re-render, you can simply change its key.

Below is an example where we might want to destroy and re-initialize the `todo-count` component if the `$todos` being passed to the component are changed:

    <div>    <livewire:todo-count :todos="$todos" :key="$todos->pluck('id')->join('-')" /></div>

As you can see above, we are generating a dynamic `:key` string based on the content of `$todos`. This way, the `todo-count` component will render and exist as normal until the `$todos` themselves change. At that point, the component will be re-initialized entirely from scratch, and the old component will be discarded.

---

## Offline

Offline States
==============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

In real-time applications, it can be helpful to provide a visual indication that the user's device is no longer connected to the internet.

Livewire provides the `wire:offline` directive for such cases.

By adding `wire:offline` to an element inside a Livewire component, it will be hidden by default and become visible when the user loses connection:

    <div wire:offline>    This device is currently offline.</div>

[#](#toggling-classes "Permalink")Toggling classes
--------------------------------------------------

Adding the `class` modifier allows you to add a class to an element when the user loses their connection. The class will be removed again, once the user is back online:

    <div wire:offline.class="bg-red-300">

Or, using the `.remove` modifier, you can remove a class when a user loses their connection. In this example, the `bg-green-300` class will be removed from the `<div>` while the user has lost their connection:

    <div class="bg-green-300" wire:offline.class.remove="bg-green-300">

[#](#toggling-attributes "Permalink")Toggling attributes
--------------------------------------------------------

The `.attr` modifier allows you to add an attribute to an element when the user loses their connection. In this example, the "Save" button will be disabled while the user has lost their connection:

    <button wire:offline.attr="disabled">Save</button>

---

## Pagination

Pagination
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Laravel's pagination feature allows you to query a subset of data and provides your users with the ability to navigate between _pages_ of those results.

Because Laravel's paginator was designed for static applications, in a non-Livewire app, each page navigation triggers a full browser visit to a new URL containing the desired page (`?page=2`).

However, when you use pagination inside a Livewire component, users can navigate between pages while remaining on the same page. Livewire will handle everything behind the scenes, including updating the URL query string with the current page.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Below is the most basic example of using pagination inside a `ShowPosts` component to only show ten posts at a time:

You must use the`WithPagination` trait

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

To take advantage of Livewire's pagination features, each component containing pagination must use the `Livewire\WithPagination` trait.

    <?php namespace App\Livewire; use Livewire\WithPagination;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    use WithPagination;     public function render()    {        return view('show-posts', [            'posts' => Post::paginate(10),        ]);    }}

    <div>    <div>        @foreach ($posts as $post)            <!-- ... -->        @endforeach    </div>     {{ $posts->links() }}</div>

As you can see, in addition to limiting the number of posts shown via the `Post::paginate()` method, we will also use `$posts->links()` to render page navigation links.

For more information on pagination using Laravel, check out [Laravel's comprehensive pagination documentation](https://laravel.com/docs/pagination).

[#](#disabling-url-query-string-tracking "Permalink")Disabling URL query string tracking
----------------------------------------------------------------------------------------

By default, Livewire's paginator tracks the current page in the browser URL's query string like so: `?page=2`.

If you wish to still use Livewire's pagination utility, but disable query string tracking, you can do so using the `WithoutUrlPagination` trait:

    use Livewire\WithoutUrlPagination;use Livewire\WithPagination;use Livewire\Component; class ShowPosts extends Component{    use WithPagination, WithoutUrlPagination;      // ...}

Now, pagination will work as expected, but the current page won't show up in the query string. This also means the current page won't be persisted across page changes.

[#](#customizing-scroll-behavior "Permalink")Customizing scroll behavior
------------------------------------------------------------------------

By default, Livewire's paginator scrolls to the top of the page after every page change.

You can disable this behavior by passing `false` to the `scrollTo` parameter of the `links()` method like so:

    {{ $posts->links(data: ['scrollTo' => false]) }}

Alternatively, you can provide any CSS selector to the `scrollTo` parameter, and Livewire will find the nearest element matching that selector and scroll to it after each navigation:

    {{ $posts->links(data: ['scrollTo' => '#paginated-posts']) }}

[#](#resetting-the-page "Permalink")Resetting the page
------------------------------------------------------

When sorting or filtering results, it is common to want to reset the page number back to `1`.

For this reason, Livewire provides the `$this->resetPage()` method, allowing you to reset the page number from anywhere in your component.

The following component demonstrates using this method to reset the page after the search form is submitted:

    <?php namespace App\Livewire; use Livewire\WithPagination;use Livewire\Component;use App\Models\Post; class SearchPosts extends Component{    use WithPagination;     public $query = '';     public function search()    {        $this->resetPage();    }     public function render()    {        return view('show-posts', [            'posts' => Post::where('title', 'like', '%'.$this->query.'%')->paginate(10),        ]);    }}

    <div>    <form wire:submit="search">        <input type="text" wire:model="query">         <button type="submit">Search posts</button>    </form>     <div>        @foreach ($posts as $post)            <!-- ... -->        @endforeach    </div>     {{ $posts->links() }}</div>

Now, if a user was on page `5` of the results and then filtered the results further by pressing "Search posts", the page would be reset back to `1`.

### [#](#available-page-navigation-methods "Permalink")Available page navigation methods

In addition to `$this->resetPage()`, Livewire provides other useful methods for navigating between pages programmatically from your component:

Method

Description

`$this->setPage($page)`

Set the paginator to a specific page number

`$this->resetPage()`

Reset the page back to 1

`$this->nextPage()`

Go to the next page

`$this->previousPage()`

Go to the previous page

[#](#multiple-paginators "Permalink")Multiple paginators
--------------------------------------------------------

Because both Laravel and Livewire use URL query string parameters to store and track the current page number, if a single page contains multiple paginators, it's important to assign them different names.

To demonstrate the problem more clearly, consider the following `ShowClients` component:

    use Livewire\WithPagination;use Livewire\Component;use App\Models\Client; class ShowClients extends Component{    use WithPagination;     public function render()    {        return view('show-clients', [            'clients' => Client::paginate(10),        ]);    }}

As you can see, the above component contains a paginated set of _clients_. If a user were to navigate to page `2` of this result set, the URL might look like the following:

    http://application.test/?page=2

Suppose the page also contains a `ShowInvoices` component that also uses pagination. To independently track each paginator's current page, you need to specify a name for the second paginator like so:

    use Livewire\WithPagination;use Livewire\Component;use App\Models\Invoices; class ShowInvoices extends Component{    use WithPagination;     public function render()    {        return view('show-invoices', [            'invoices' => Invoice::paginate(10, pageName: 'invoices-page'),        ]);    }}

Now, because of the `pageName` parameter that has been added to the `paginate` method, when a user visits page `2` of the _invoices_, the URL will contain the following:

    https://application.test/customers?page=2&invoices-page=2

When using Livewire's page navigation methods on a named paginator, you must provide the page name as an additional parameter:

    $this->setPage(2, pageName: 'invoices-page'); $this->resetPage(pageName: 'invoices-page'); $this->nextPage(pageName: 'invoices-page'); $this->previousPage(pageName: 'invoices-page');

[#](#hooking-into-page-updates "Permalink")Hooking into page updates
--------------------------------------------------------------------

Livewire allows you to execute code before and after a page is updated by defining either of the following methods inside your component:

    use Livewire\WithPagination; class ShowPosts extends Component{    use WithPagination;     public function updatingPage($page)    {        // Runs before the page is updated for this component...    }     public function updatedPage($page)    {        // Runs after the page is updated for this component...    }     public function render()    {        return view('show-posts', [            'posts' => Post::paginate(10),        ]);    }}

### [#](#named-paginator-hooks "Permalink")Named paginator hooks

The previous hooks only apply to the default paginator. If you are using a named paginator, you must define the methods using the paginator's name.

For example, below is an example of what a hook for a paginator named `invoices-page` would look like:

    public function updatingInvoicesPage($page){    //}

### [#](#general-paginator-hooks "Permalink")General paginator hooks

If you prefer to not reference the paginator name in the hook method name, you can use the more generic alternatives and simply receive the `$pageName` as a second argument to the hook method:

    public function updatingPaginators($page, $pageName){    // Runs before the page is updated for this component...} public function updatedPaginators($page, $pageName){    // Runs after the page is updated for this component...}

[#](#using-the-simple-theme "Permalink")Using the simple theme
--------------------------------------------------------------

You can use Laravel's `simplePaginate()` method instead of `paginate()` for added speed and simplicity.

When paginating results using this method, only _next_ and _previous_ navigation links will be shown to the user instead of individual links for each page number:

    public function render(){    return view('show-posts', [        'posts' => Post::simplePaginate(10),    ]);}

For more information on simple pagination, check out [Laravel's "simplePaginator" documentation](https://laravel.com/docs/pagination#simple-pagination).

[#](#using-cursor-pagination "Permalink")Using cursor pagination
----------------------------------------------------------------

Livewire also supports using Laravel's cursor pagination — a faster pagination method useful in large datasets:

    public function render(){    return view('show-posts', [        'posts' => Post::cursorPaginate(10),    ]);}

By using `cursorPaginate()` instead of `paginate()` or `simplePaginate()`, the query string in your application's URL will store an encoded _cursor_ instead of a standard page number. For example:

    https://example.com/posts?cursor=eyJpZCI6MTUsIl9wb2ludHNUb05leHRJdGVtcyI6dHJ1ZX0

For more information on cursor pagination, check out [Laravel's cursor pagination documentation](https://laravel.com/docs/pagination#cursor-pagination).

[#](#using-bootstrap-instead-of-tailwind "Permalink")Using Bootstrap instead of Tailwind
----------------------------------------------------------------------------------------

If you are using [Bootstrap](https://getbootstrap.com/) instead of [Tailwind](https://tailwindcss.com/) as your application's CSS framework, you can configure Livewire to use Bootstrap styled pagination views instead of the default Tailwind views.

To accomplish this, set the `pagination_theme` configuration value in your application's `config/livewire.php` file:

    'pagination_theme' => 'bootstrap',

Publishing Livewire's configuration file

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before customizing the pagination theme, you must first publish Livewire's configuration file to your application's `/config` directory by running the following command:

    php artisan livewire:publish --config

[#](#modifying-the-default-pagination-views "Permalink")Modifying the default pagination views
----------------------------------------------------------------------------------------------

If you want to modify Livewire's pagination views to fit your application's style, you can do so by _publishing_ them using the following command:

    php artisan livewire:publish --pagination

After running this command, the following four files will be inserted into the `resources/views/vendor/livewire` directory:

View file name

Description

`tailwind.blade.php`

The standard Tailwind pagination theme

`tailwind-simple.blade.php`

The _simple_ Tailwind pagination theme

`bootstrap.blade.php`

The standard Bootstrap pagination theme

`bootstrap-simple.blade.php`

The _simple_ Bootstrap pagination theme

Once the files have been published, you have complete control over them. When rendering pagination links using the paginated result's `->links()` method inside your template, Livewire will use these files instead of its own.

[#](#using-custom-pagination-views "Permalink")Using custom pagination views
----------------------------------------------------------------------------

If you wish to bypass Livewire's pagination views entirely, you can render your own in one of two ways:

1.  The `->links()` method in your Blade view
2.  The `paginationView()` or `paginationSimpleView()` method in your component

### [#](#via--links "Permalink")Via `->links()`

The first approach is to simply pass your custom pagination Blade view name to the `->links()` method directly:

    {{ $posts->links('custom-pagination-links') }}

When rendering the pagination links, Livewire will now look for a view at `resources/views/custom-pagination-links.blade.php`.

### [#](#via-paginationview-or-paginationsimpleview "Permalink")Via `paginationView()` or `paginationSimpleView()`

The second approach is to declare a `paginationView` or `paginationSimpleView` method inside your component which returns the name of the view you would like to use:

    public function paginationView(){    return 'custom-pagination-links-view';} public function paginationSimpleView(){    return 'custom-simple-pagination-links-view';}

### [#](#sample-pagination-view "Permalink")Sample pagination view

Below is an unstyled sample of a simple Livewire pagination view for your reference.

As you can see, you can use Livewire's page navigation helpers like `$this->nextPage()` directly inside your template by adding `wire:click="nextPage"` to buttons:

    <div>    @if ($paginator->hasPages())        <nav role="navigation" aria-label="Pagination Navigation">            <span>                @if ($paginator->onFirstPage())                    <span>Previous</span>                @else                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>                @endif            </span>             <span>                @if ($paginator->onLastPage())                    <span>Next</span>                @else                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>                @endif            </span>        </nav>    @endif</div>

---

## Properties

Properties
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Properties store and manage data inside your Livewire components. They are defined as public properties on component classes and can be accessed and modified on both the server and client-side.

[#](#initializing-properties "Permalink")Initializing properties
----------------------------------------------------------------

You can set initial values for properties within your component's `mount()` method.

Consider the following example:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class TodoList extends Component{    public $todos = [];     public $todo = '';     public function mount()    {        $this->todos = Auth::user()->todos;     }     // ...}

In this example, we've defined an empty `todos` array and initialized it with existing todos from the authenticated user. Now, when the component renders for the first time, all the existing todos in the database are shown to the user.

[#](#bulk-assignment "Permalink")Bulk assignment
------------------------------------------------

Sometimes initializing many properties in the `mount()` method can feel verbose. To help with this, Livewire provides a convenient way to assign multiple properties at once via the `fill()` method. By passing an associative array of property names and their respective values, you can set several properties simultaneously and cut down on repetitive lines of code in `mount()`.

For example:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public $post;     public $title;     public $description;     public function mount(Post $post)    {        $this->post = $post;         $this->fill(             $post->only('title', 'description'),         );     }     // ...}

Because `$post->only(...)` returns an associative array of model attributes and values based on the names you pass into it, the `$title` and `$description` properties will be initially set to the `title` and `description` of the `$post` model from the database without having to set each one individually.

[#](#data-binding "Permalink")Data binding
------------------------------------------

Livewire supports two-way data binding through the `wire:model` HTML attribute. This allows you to easily synchronize data between component properties and HTML inputs, keeping your user interface and component state in sync.

Let's use the `wire:model` directive to bind the `$todo` property in a `TodoList` component to a basic input element:

    <?php namespace App\Livewire; use Livewire\Component; class TodoList extends Component{    public $todos = [];     public $todo = '';     public function add()    {        $this->todos[] = $this->todo;         $this->todo = '';    }     // ...}

    <div>    <input type="text" wire:model="todo" placeholder="Todo...">      <button wire:click="add">Add Todo</button>     <ul>        @foreach ($todos as $todo)            <li>{{ $todo }}</li>        @endforeach    </ul></div>

In the above example, the text input's value will synchronize with the `$todo` property on the server when the "Add Todo" button is clicked.

This is just scratching the surface of `wire:model`. For deeper information on data binding, check out our [documentation on forms](/docs/forms).

[#](#resetting-properties "Permalink")Resetting properties
----------------------------------------------------------

Sometimes, you may need to reset your properties back to their initial state after an action is performed by the user. In these cases, Livewire provides a `reset()` method that accepts one or more property names and resets their values to their initial state.

In the example below, we can avoid code duplication by using `$this->reset()` to reset the `todo` field after the "Add Todo" button is clicked:

    <?php namespace App\Livewire; use Livewire\Component; class ManageTodos extends Component{    public $todos = [];     public $todo = '';     public function addTodo()    {        $this->todos[] = $this->todo;         $this->reset('todo');     }     // ...}

In the above example, after a user clicks "Add Todo", the input field holding the todo that has just been added will clear, allowing the user to write a new todo.

`reset()` won't work on values set in `mount()`

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

`reset()` will reset a property to its state before the `mount()` method was called. If you initialized the property in `mount()` to a different value, you will need to reset the property manually.

[#](#pulling-properties "Permalink")Pulling properties
------------------------------------------------------

Alternatively, you can use the `pull()` method to both reset and retrieve the value in one operation.

Here's the same example from above, but simplified with `pull()`:

    <?php namespace App\Livewire; use Livewire\Component; class ManageTodos extends Component{    public $todos = [];     public $todo = '';     public function addTodo()    {        $this->todos[] = $this->pull('todo');     }     // ...}

The above example is pulling a single value, but `pull()` can also be used to reset and retrieve (as a key-value pair) all or some properties:

    // The same as $this->all() and $this->reset();$this->pull(); // The same as $this->only(...) and $this->reset(...);$this->pull(['title', 'content']);

[#](#supported-property-types "Permalink")Supported property types
------------------------------------------------------------------

Livewire supports a limited set of property types because of its unique approach to managing component data between server requests.

Each property in a Livewire component is serialized or "dehydrated" into JSON between requests, then "hydrated" from JSON back into PHP for the next request.

This two-way conversion process has certain limitations, restricting the types of properties Livewire can work with.

### [#](#primitive-types "Permalink")Primitive types

Livewire supports primitive types such as strings, integers, etc. These types can be easily converted to and from JSON, making them ideal for use as properties in Livewire components.

Livewire supports the following primitive property types: `Array`, `String`, `Integer`, `Float`, `Boolean`, and `Null`.

    class TodoList extends Component{    public $todos = []; // Array     public $todo = ''; // String     public $maxTodos = 10; // Integer     public $showTodos = false; // Boolean     public $todoFilter; // Null}

### [#](#common-php-types "Permalink")Common PHP types

In addition to primitive types, Livewire supports common PHP object types used in Laravel applications. However, it's important to note that these types will be _dehydrated_ into JSON and _hydrated_ back to PHP on each request. This means that the property may not preserve run-time values such as closures. Also, information about the object such as class names may be exposed to JavaScript.

Supported PHP types:

Type

Full Class Name

BackedEnum

`BackedEnum`

Collection

`Illuminate\Support\Collection`

Eloquent Collection

`Illuminate\Database\Eloquent\Collection`

Model

`Illuminate\Database\Eloquent\Model`

DateTime

`DateTime`

Carbon

`Carbon\Carbon`

Stringable

`Illuminate\Support\Stringable`

Eloquent Collections and Models

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

When storing Eloquent Collections and Models in Livewire properties, additional query constraints like select(...) will not be re-applied on subsequent requests.

See [Eloquent constraints aren't preserved between requests](#eloquent-constraints-arent-preserved-between-requests) for more details

Here's a quick example of setting properties as these various types:

    public function mount(){    $this->todos = collect([]); // Collection     $this->todos = Todos::all(); // Eloquent Collection     $this->todo = Todos::first(); // Model     $this->date = new DateTime('now'); // DateTime     $this->date = new Carbon('now'); // Carbon     $this->todo = str(''); // Stringable}

### [#](#supporting-custom-types "Permalink")Supporting custom types

Livewire allows your application to support custom types through two powerful mechanisms:

*   Wireables
*   Synthesizers

Wireables are simple and easy to use for most applications, so we'll explore them below. If you're an advanced user or package author wanting more flexibility, [Synthesizers are the way to go](/docs/synthesizers).

#### [#](#wireables "Permalink")Wireables

Wireables are any class in your application that implements the `Wireable` interface.

For example, let's imagine you have a `Customer` object in your application that contains the primary data about a customer:

    class Customer{    protected $name;    protected $age;     public function __construct($name, $age)    {        $this->name = $name;        $this->age = $age;    }}

Attempting to set an instance of this class to a Livewire component property will result in an error telling you that the `Customer` property type isn't supported:

    class ShowCustomer extends Component{    public Customer $customer;     public function mount()    {        $this->customer = new Customer('Caleb', 29);    }}

However, you can solve this by implementing the `Wireable` interface and adding a `toLivewire()` and `fromLivewire()` method to your class. These methods tell Livewire how to turn properties of this type into JSON and back again:

    use Livewire\Wireable; class Customer implements Wireable{    protected $name;    protected $age;     public function __construct($name, $age)    {        $this->name = $name;        $this->age = $age;    }     public function toLivewire()    {        return [            'name' => $this->name,            'age' => $this->age,        ];    }     public static function fromLivewire($value)    {        $name = $value['name'];        $age = $value['age'];         return new static($name, $age);    }}

Now you can freely set `Customer` objects on your Livewire components and Livewire will know how to convert these objects into JSON and back into PHP.

As mentioned earlier, if you want to support types more globally and powerfully, Livewire offers Synthesizers, its advanced internal mechanism for handling different property types. [Learn more about Synthesizers](/docs/synthesizers).

[#](#accessing-properties-from-javascript "Permalink")Accessing properties from JavaScript
------------------------------------------------------------------------------------------

Because Livewire properties are also available in the browser via JavaScript, you can access and manipulate their JavaScript representations from [AlpineJS](https://alpinejs.dev/).

Alpine is a lightweight JavaScript library that is included with Livewire. Alpine provides a way to build lightweight interactions into your Livewire components without making full server roundtrips.

Internally, Livewire's frontend is built on top of Alpine. In fact, every Livewire component is actually an Alpine component under-the-hood. This means that you can freely utilize Alpine inside your Livewire components.

The rest of this page assumes a basic familiarity with Alpine. If you're unfamiliar with Alpine, [take a look at the Alpine documentation](https://alpinejs.dev/docs).

### [#](#accessing-properties "Permalink")Accessing properties

Livewire exposes a magic `$wire` object to Alpine. You can access the `$wire` object from any Alpine expression inside your Livewire component.

The `$wire` object can be treated like a JavaScript version of your Livewire component. It has all the same properties and methods as the PHP version of your component, but also contains a few dedicated methods to perform specific functions in your template.

For example, we can use `$wire` to show a live character count of the `todo` input field:

    <div>    <input type="text" wire:model="todo">     Todo character length: <h2 x-text="$wire.todo.length"></h2></div>

As the user types in the field, the character length of the current todo being written will be shown and live-updated on the page, all without sending a network request to the server.

If you prefer, you can use the more explicit `.get()` method to accomplish the same thing:

    <div>    <input type="text" wire:model="todo">     Todo character length: <h2 x-text="$wire.get('todo').length"></h2></div>

### [#](#manipulating-properties "Permalink")Manipulating properties

Similarly, you can manipulate your Livewire component properties in JavaScript using `$wire`.

For example, let's add a "Clear" button to the `TodoList` component to allow the user to reset the input field using only JavaScript:

    <div>    <input type="text" wire:model="todo">     <button x-on:click="$wire.todo = ''">Clear</button></div>

After the user clicks "Clear", the input will be reset to an empty string, without sending a network request to the server.

On the subsequent request, the server-side value of `$todo` will be updated and synchronized.

If you prefer, you can also use the more explicit `.set()` method for setting properties client-side. However, you should note that using `.set()` by default immediately triggers a network request and synchronizes the state with the server. If that is desired, then this is an excellent API:

    <button x-on:click="$wire.set('todo', '')">Clear</button>

In order to update the property without sending a network request to the server, you can pass a third bool parameter. This will defer the network request and on a subsequent request, the state will be synchronized on the server-side:

    <button x-on:click="$wire.set('todo', '', false)">Clear</button>

[#](#security-concerns "Permalink")Security concerns
----------------------------------------------------

While Livewire properties are a powerful feature, there are a few security considerations that you should be aware of before using them.

In short, always treat public properties as user input — as if they were request input from a traditional endpoint. In light of this, it's essential to validate and authorize properties before persisting them to a database — just like you would do when working with request input in a controller.

### [#](#dont-trust-property-values "Permalink")Don't trust property values

To demonstrate how neglecting to authorize and validate properties can introduce security holes in your application, the following `UpdatePost` component is vulnerable to attack:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public $id;    public $title;    public $content;     public function mount(Post $post)    {        $this->id = $post->id;        $this->title = $post->title;        $this->content = $post->content;    }     public function update()    {        $post = Post::findOrFail($this->id);         $post->update([            'title' => $this->title,            'content' => $this->content,        ]);         session()->flash('message', 'Post updated successfully!');    }     public function render()    {        return view('livewire.update-post');    }}

    <form wire:submit="update">    <input type="text" wire:model="title">    <input type="text" wire:model="content">     <button type="submit">Update</button></form>

At first glance, this component may look completely fine. But, let's walk through how an attacker could use the component to do unauthorized things in your application.

Because we are storing the `id` of the post as a public property on the component, it can be manipulated on the client just the same as the `title` and `content` properties.

It doesn't matter that we didn't write an input with `wire:model="id"`. A malicious user can easily change the view to the following using their browser DevTools:

    <form wire:submit="update">    <input type="text" wire:model="id">     <input type="text" wire:model="title">    <input type="text" wire:model="content">     <button type="submit">Update</button></form>

Now the malicious user can update the `id` input to the ID of a different post model. When the form is submitted and `update()` is called, `Post::findOrFail()` will return and update a post the user is not the owner of.

To prevent this kind of attack, we can use one or both of the following strategies:

*   Authorize the input
*   Lock the property from updates

#### [#](#authorizing-the-input "Permalink")Authorizing the input

Because `$id` can be manipulated client-side with something like `wire:model`, just like in a controller, we can use [Laravel's authorization](https://laravel.com/docs/authorization) to make sure the current user can update the post:

    public function update(){    $post = Post::findOrFail($this->id);     $this->authorize('update', $post);      $post->update(...);}

If a malicious user mutates the `$id` property, the added authorization will catch it and throw an error.

#### [#](#locking-the-property "Permalink")Locking the property

Livewire also allows you to "lock" properties in order to prevent properties from being modified on the client-side. You can "lock" a property from client-side manipulation using the `#[Locked]` attribute:

    use Livewire\Attributes\Locked;use Livewire\Component; class UpdatePost extends Component{    #[Locked]     public $id;     // ...}

Now, if a user tries to modify `$id` on the front end, an error will be thrown.

By using `#[Locked]`, you can assume this property has not been manipulated anywhere outside your component's class.

For more information on locking properties, [consult the Locked properties documentation](/docs/locked).

#### [#](#eloquent-models-and-locking "Permalink")Eloquent models and locking

When an Eloquent model is assigned to a Livewire component property, Livewire will automatically lock the property and ensure the ID isn't changed, so that you are safe from these kinds of attacks:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public Post $post;     public $title;    public $content;     public function mount(Post $post)    {        $this->post = $post;        $this->title = $post->title;        $this->content = $post->content;    }     public function update()    {        $this->post->update([            'title' => $this->title,            'content' => $this->content,        ]);         session()->flash('message', 'Post updated successfully!');    }     public function render()    {        return view('livewire.update-post');    }}

### [#](#properties-expose-system-information-to-the-browser "Permalink")Properties expose system information to the browser

Another essential thing to remember is that Livewire properties are serialized or "dehydrated" before they are sent to the browser. This means that their values are converted to a format that can be sent over the wire and understood by JavaScript. This format can expose information about your application to the browser, including the names and class names of your properties.

For example, suppose you have a Livewire component that defines a public property named `$post`. This property contains an instance of a `Post` model from your database. In this case, the dehydrated value of this property sent over the wire might look something like this:

    {    "type": "model",    "class": "App\Models\Post",    "key": 1,    "relationships": []}

As you can see, the dehydrated value of the `$post` property includes the class name of the model (`App\Models\Post`) as well as the ID and any relationships that have been eager-loaded.

If you don't want to expose the class name of the model, you can use Laravel's "morphMap" functionality from a service provider to assign an alias to a model class name:

    <?php namespace App\Providers; use Illuminate\Support\ServiceProvider;use Illuminate\Database\Eloquent\Relations\Relation; class AppServiceProvider extends ServiceProvider{    public function boot()    {        Relation::morphMap([            'post' => 'App\Models\Post',        ]);    }}

Now, when the Eloquent model is "dehydrated" (serialized), the original class name won't be exposed, only the "post" alias:

     {     "type": "model",-    "class": "App\Models\Post", +    "class": "post",      "key": 1,     "relationships": [] }

### [#](#eloquent-constraints-arent-preserved-between-requests "Permalink")Eloquent constraints aren't preserved between requests

Typically, Livewire is able to preserve and recreate server-side properties between requests; however, there are certain scenarios where preserving values are impossible between requests.

For example, when storing Eloquent collections as Livewire properties, additional query constraints like `select(...)` will not be re-applied on subsequent requests.

To demonstrate, consider the following `ShowTodos` component with a `select()` constraint applied to the `Todos` Eloquent collection:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class ShowTodos extends Component{    public $todos;     public function mount()    {        $this->todos = Auth::user()            ->todos()            ->select(['title', 'content'])             ->get();    }     public function render()    {        return view('livewire.show-todos');    }}

When this component is initially loaded, the `$todos` property will be set to an Eloquent collection of the user's todos; however, only the `title` and `content` fields of each row in the database will have been queried and loaded into each of the models.

When Livewire _hydrates_ the JSON of this property back into PHP on a subsequent request, the select constraint will have been lost.

To ensure the integrity of Eloquent queries, we recommend that you use [computed properties](/docs/computed-properties) instead of properties.

Computed properties are methods in your component marked with the `#[Computed]` attribute. They can be accessed as a dynamic property that isn't stored as part of the component's state but is instead evaluated on-the-fly.

Here's the above example re-written using a computed property:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component; class ShowTodos extends Component{    #[Computed]     public function todos()    {        return Auth::user()            ->todos()            ->select(['title', 'content'])            ->get();    }     public function render()    {        return view('livewire.show-todos');    }}

Here's how you would access these _todos_ from the Blade view:

    <ul>    @foreach ($this->todos as $todo)        <li>{{ $todo }}</li>    @endforeach</ul>

Notice, inside your views, you can only access computed properties on the `$this` object like so: `$this->todos`.

You can also access `$todos` from inside your class. For example, if you had a `markAllAsComplete()` action:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component; class ShowTodos extends Component{    #[Computed]    public function todos()    {        return Auth::user()            ->todos()            ->select(['title', 'content'])            ->get();    }     public function markAllComplete()     {        $this->todos->each->complete();    }     public function render()    {        return view('livewire.show-todos');    }}

You might wonder why not just call `$this->todos()` as a method directly where you need to? Why use `#[Computed]` in the first place?

The reason is that computed properties have a performance advantage, since they are automatically cached after their first usage during a single request. This means you can freely access `$this->todos` within your component and be assured that the actual method will only be called once, so that you don't run an expensive query multiple times in the same request.

For more information, [visit the computed properties documentation](/docs/computed-properties).

---

## Quickstart

Quickstart
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

To begin your Livewire journey, we will create a simple "counter" component and render it in the browser. This example is a great way to experience Livewire for the first time as it demonstrates Livewire's _liveness_ in the simplest way possible.

[#](#prerequisites "Permalink")Prerequisites
--------------------------------------------

Before we start, make sure you have the following installed:

*   Laravel version 10 or later
*   PHP version 8.1 or later

[#](#install-livewire "Permalink")Install Livewire
--------------------------------------------------

From the root directory of your Laravel app, run the following [Composer](https://getcomposer.org/) command:

    composer require livewire/livewire

Make sure Alpine isn't already installed

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If the application you are using already has AlpineJS installed, you will need to remove it for Livewire to work properly; otherwise, Alpine will be loaded twice and Livewire won't function. For example, if you installed the Laravel Breeze "Blade with Alpine" starter kit, you will need to remove Alpine from `resources/js/app.js`.

[#](#create-a-livewire-component "Permalink")Create a Livewire component
------------------------------------------------------------------------

Livewire provides a convenient Artisan command to generate new components quickly. Run the following command to make a new `Counter` component:

    php artisan make:livewire counter

This command will generate two new files in your project:

*   `app/Livewire/Counter.php`
*   `resources/views/livewire/counter.blade.php`

[#](#writing-the-class "Permalink")Writing the class
----------------------------------------------------

Open `app/Livewire/Counter.php` and replace its contents with the following:

    <?php namespace App\Livewire; use Livewire\Component; class Counter extends Component{    public $count = 1;     public function increment()    {        $this->count++;    }     public function decrement()    {        $this->count--;    }     public function render()    {        return view('livewire.counter');    }}

Here's a brief explanation of the code above:

*   `public $count = 1;` — Declares a public property named `$count` with an initial value of `1`.
*   `public function increment()` — Declares a public method named `increment()` that increments the `$count` property each time it's called. Public methods like this can be triggered from the browser in a variety of ways, including when a user clicks a button.
*   `public function render()` — Declares a `render()` method that returns a Blade view. This Blade view will contain the HTML template for our component.

[#](#writing-the-view "Permalink")Writing the view
--------------------------------------------------

Open the `resources/views/livewire/counter.blade.php` file and replace its content with the following:

    <div>    <h1>{{ $count }}</h1>     <button wire:click="increment">+</button>     <button wire:click="decrement">-</button></div>

This code will display the value of the `$count` property and two buttons that increment and decrement the `$count` property, respectively.

Livewire components MUST have a single root element

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

In order for Livewire to work, components must have just **one** single element as its root. If multiple root elements are detected, an exception is thrown. It is recommended to use a `<div>` element as in the example. HTML comments count as separate elements and should be put inside the root element. When rendering [full-page components](/docs/components#full-page-components), named slots for the layout file may be put outside the root element. These are removed before the component is rendered.

[#](#register-a-route-for-the-component "Permalink")Register a route for the component
--------------------------------------------------------------------------------------

Open the `routes/web.php` file in your Laravel application and add the following code:

    use App\Livewire\Counter; Route::get('/counter', Counter::class);

Now, our _counter_ component is assigned to the `/counter` route, so that when a user visits the `/counter` endpoint in your application, this component will be rendered by the browser.

[#](#create-a-template-layout "Permalink")Create a template layout
------------------------------------------------------------------

Before you can visit `/counter` in the browser, we need an HTML layout for our component to render inside. By default, Livewire will automatically look for a layout file named: `resources/views/components/layouts/app.blade.php`

You may create this file if it doesn't already exist by running the following command:

    php artisan livewire:layout

This command will generate a file called `resources/views/components/layouts/app.blade.php` with the following contents:

    <!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">         <title>{{ $title ?? 'Page Title' }}</title>    </head>    <body>        {{ $slot }}    </body></html>

The _counter_ component will be rendered in place of the `$slot` variable in the template above.

You may have noticed there is no JavaScript or CSS assets provided by Livewire. That is because Livewire 3 and above automatically injects any frontend assets it needs.

[#](#test-it-out "Permalink")Test it out
----------------------------------------

With our component class and templates in place, our component is ready to test!

Visit `/counter` in your browser, and you should see a number displayed on the screen with two buttons to increment and decrement the number.

After clicking one of the buttons, you will notice that the count updates in real time, without the page reloading. This is the magic of Livewire: dynamic frontend applications written entirely in PHP.

We've barely scratched the surface of what Livewire is capable of. Keep reading the documentation to see everything Livewire has to offer.

---

## Redirecting

Redirecting
===========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

After a user performs some action — like submitting a form — you may want to redirect them to another page in your application.

Because Livewire requests aren't standard full-page browser requests, standard HTTP redirects won't work. Instead, you need to trigger redirects via JavaScript. Fortunately, Livewire exposes a simple `$this->redirect()` helper method to use within your components. Internally, Livewire will handle the process of redirecting on the frontend.

If you prefer, you can use [Laravel's built-in redirect utilities](https://laravel.com/docs/responses#redirects) within your components as well.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Below is an example of a `CreatePost` Livewire component that redirects the user to another page after they submit the form to create a post:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);         $this->redirect('/posts');     }     public function render()    {        return view('livewire.create-post');    }}

As you can see, when the `save` action is triggered, a redirect will also be triggered to `/posts`. When Livewire receives this response, it will redirect the user to the new URL on the frontend.

[#](#redirect-to-route "Permalink")Redirect to Route
----------------------------------------------------

In case you want to redirect to a page using its route name you can use the `redirectRoute`.

For example, if you have a page with the route named `'profile'` like this:

    Route::get('/user/profile', function () {    // ...})->name('profile');

You can use `redirectRoute` to redirect to that page using the name of the route like so:

    $this->redirectRoute('profile');

In case you need to pass parameters to the route you may use the second argument of the method `redirectRoute` like so:

    $this->redirectRoute('profile', ['id' => 1]);

[#](#redirect-to-intended "Permalink")Redirect to intended
----------------------------------------------------------

In case you want to redirect the user back to the previous page they were on you can use `redirectIntended`. It accepts an optional default URL as its first argument which is used as a fallback if no previous page can be determined:

    $this->redirectIntended('/default/url');

[#](#redirecting-to-full-page-components "Permalink")Redirecting to full-page components
----------------------------------------------------------------------------------------

Because Livewire uses Laravel's built-in redirection feature, you can use all of the redirection methods available to you in a typical Laravel application.

For example, if you are using a Livewire component as a full-page component for a route like so:

    use App\Livewire\ShowPosts; Route::get('/posts', ShowPosts::class);

You can redirect to the component by providing the component name to the `redirect()` method:

    public function save(){    // ...     $this->redirect(ShowPosts::class);}

[#](#flash-messages "Permalink")Flash messages
----------------------------------------------

In addition to allowing you to use Laravel's built-in redirection methods, Livewire also supports Laravel's [session flash data utilities](https://laravel.com/docs/session#flash-data).

To pass flash data along with a redirect, you can use Laravel's `session()->flash()` method like so:

    use Livewire\Component; class UpdatePost extends Component{    // ...     public function update()    {        // ...         session()->flash('status', 'Post successfully updated.');         $this->redirect('/posts');    }}

Assuming the page being redirected to contain the following Blade snippet, the user will see a "Post successfully updated." message after updating the post:

    @if (session('status'))    <div class="alert alert-success">        {{ session('status') }}    </div>@endif

---

## Security

Security
========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

It's important to make sure your Livewire apps are secure and don't expose any application vulnerabilities. Livewire has internal security features to handle many cases, however, there are times when it's up to your application code to keep your components secure.

[#](#authorizing-action-parameters "Permalink")Authorizing action parameters
----------------------------------------------------------------------------

Livewire actions are extremely powerful, however, any parameters passed to Livewire actions are mutable on the client and should be treated as un-trusted user input.

Arguably the most common security pitfall in Livewire is failing to validate and authorize Livewire action calls before persisting changes to the database.

Here is an example of an insecurity resulting from a lack of authorization:

    <?php use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    // ...     public function delete($id)    {        // INSECURE!         $post = Post::find($id);         $post->delete();    }}

    <button wire:click="delete({{ $post->id }})">Delete Post</button>

The reason the above example is insecure is that `wire:click="delete(...)"` can be modified in the browser to pass ANY post ID a malicious user wishes.

Action parameters (like `$id` in this case) should be treated the same as any untrusted input from the browser.

Therefore, to keep this application secure and prevent a user from deleting another user's post, we must add authorization to the `delete()` action.

First, let's create a [Laravel Policy](https://laravel.com/docs/authorization#creating-policies) for the Post model by running the following command:

    php artisan make:policy PostPolicy --model=Post

After running the above command, a new Policy will be created inside `app/Policies/PostPolicy.php`. We can then update its contents with a `delete` method like so:

    <?php namespace App\Policies; use App\Models\Post;use App\Models\User; class PostPolicy{    /**     * Determine if the given post can be deleted by the user.     */    public function delete(?User $user, Post $post): bool    {        return $user?->id === $post->user_id;    }}

Now, we can use the `$this->authorize()` method from the Livewire component to ensure the user owns the post before deleting it:

    public function delete($id){    $post = Post::find($id);     // If the user doesn't own the post,    // an AuthorizationException will be thrown...    $this->authorize('delete', $post);      $post->delete();}

Further reading:

*   [Laravel Gates](https://laravel.com/docs/authorization#gates)
*   [Laravel Policies](https://laravel.com/docs/authorization#creating-policies)

[#](#authorizing-public-properties "Permalink")Authorizing public properties
----------------------------------------------------------------------------

Similar to action parameters, public properties in Livewire should be treated as un-trusted input from the user.

Here is the same example from above about deleting a post, written insecurely in a different manner:

    <?php use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    public $postId;     public function mount($postId)    {        $this->postId = $postId;    }     public function delete()    {        // INSECURE!         $post = Post::find($this->postId);         $post->delete();    }}

    <button wire:click="delete">Delete Post</button>

As you can see, instead of passing the `$postId` as a parameter to the `delete` method from `wire:click`, we are storing it as a public property on the Livewire component.

The problem with this approach is that any malicious user can inject a custom element onto the page such as:

    <input type="text" wire:model="postId">

This would allow them to freely modify the `$postId` before pressing "Delete Post". Because the `delete` action doesn't authorize the value of `$postId`, the user can now delete any post in the database, whether they own it or not.

To protect against this risk, there are two possible solutions:

### [#](#using-model-properties "Permalink")Using model properties

When setting public properties, Livewire treats models differently than plain values such as strings and integers. Because of this, if we instead store the entire post model as a property on the component, Livewire will ensure the ID is never tampered with.

Here is an example of storing a `$post` property instead of a simple `$postId` property:

    <?php use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    public Post $post;     public function mount($postId)    {        $this->post = Post::find($postId);    }     public function delete()    {        $this->post->delete();    }}

    <button wire:click="delete">Delete Post</button>

This component is now secured because there is no way for a malicious user to change the `$post` property to a different Eloquent model.

### [#](#locking-the-property "Permalink")Locking the property

Another way to prevent properties from being set to unwanted values is to use [locked properties](https://livewire.laravel.com/docs/locked). Locking properties is done by applying the `#[Locked]` attribute. Now if users attempt to tamper with this value an error will be thrown.

Note that properties with the Locked attribute can still be changed in the back-end, so care still needs to taken that untrusted user input is not passed to the property in your own Livewire functions.

    <?php use App\Models\Post;use Livewire\Component;use Livewire\Attributes\Locked; class ShowPost extends Component{    #[Locked]     public $postId;     public function mount($postId)    {        $this->postId = $postId;    }     public function delete()    {        $post = Post::find($this->postId);         $post->delete();    }}

### [#](#authorizing-the-property "Permalink")Authorizing the property

If using a model property is undesired in your scenario, you can of course fall-back to manually authorizing the deletion of the post inside the `delete` action:

    <?php use App\Models\Post;use Livewire\Component; class ShowPost extends Component{    public $postId;     public function mount($postId)    {        $this->postId = $postId;    }     public function delete()    {        $post = Post::find($this->postId);         $this->authorize('delete', $post);          $post->delete();    }}

    <button wire:click="delete">Delete Post</button>

Now, even though a malicious user can still freely modify the value of `$postId`, when the `delete` action is called, `$this->authorize()` will throw an `AuthorizationException` if the user does not own the post.

Further reading:

*   [Laravel Gates](https://laravel.com/docs/authorization#gates)
*   [Laravel Policies](https://laravel.com/docs/authorization#creating-policies)

[#](#middleware "Permalink")Middleware
--------------------------------------

When a Livewire component is loaded on a page containing route-level [Authorization Middleware](https://laravel.com/docs/authorization#via-middleware), like so:

    Route::get('/post/{post}', App\Livewire\UpdatePost::class)    ->middleware('can:update,post'); 

Livewire will ensure those middlewares are re-applied to subsequent Livewire network requests. This is referred to as "Persistent Middleware" in Livewire's core.

Persistent middleware protects you from scenarios where the authorization rules or user permissions have changed after the initial page-load.

Here's a more in-depth example of such a scenario:

    Route::get('/post/{post}', App\Livewire\UpdatePost::class)    ->middleware('can:update,post'); 

    <?php use App\Models\Post;use Livewire\Component;use Livewire\Attributes\Validate; class UpdatePost extends Component{    public Post $post;     #[Validate('required|min:5')]    public $title = '';     public $content = '';     public function mount()    {        $this->title = $this->post->title;        $this->content = $this->post->content;    }     public function update()    {        $this->post->update([            'title' => $this->title,            'content' => $this->content,        ]);    }}

As you can see, the `can:update,post` middleware is applied at the route-level. This means that a user who doesn't have permission to update a post cannot view the page.

However, consider a scenario where a user:

*   Loads the page
*   Loses permission to update after the page loads
*   Tries updating the post after losing permission

Because Livewire has already successfully loaded the page you might ask yourself: "When Livewire makes a subsequent request to update the post, will the `can:update,post` middleware be re-applied? Or instead, will the un-authorized user be able to update the post successfully?"

Because Livewire has internal mechanisms to re-apply middleware from the original endpoint, you are protected in this scenario.

### [#](#configuring-persistent-middleware "Permalink")Configuring persistent middleware

By default, Livewire persists the following middleware across network requests:

    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,\Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,\Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,\Illuminate\Routing\Middleware\SubstituteBindings::class,\App\Http\Middleware\RedirectIfAuthenticated::class,\Illuminate\Auth\Middleware\Authenticate::class,\Illuminate\Auth\Middleware\Authorize::class,

If any of the above middlewares are applied to the initial page-load, they will be persisted (re-applied) to any future network requests.

However, if you are applying a custom middleware from your application on the initial page-load, and want it persisted between Livewire requests, you will need to add it to this list from a [Service Provider](https://laravel.com/docs/providers#main-content) in your app like so:

    <?php namespace App\Providers; use Illuminate\Support\ServiceProvider;use Livewire; class AppServiceProvider extends ServiceProvider{    /**     * Bootstrap any application services.     */    public function boot(): void    {        Livewire::addPersistentMiddleware([             App\Http\Middleware\EnsureUserHasRole::class,        ]);    }}

If a Livewire component is loaded on a page that uses the `EnsureUserHasRole` middleware from your application, it will now be persisted and re-applied to any future network requests to that Livewire component.

Middleware arguments are not supported

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Livewire currently doesn't support middleware arguments for persistent middleware definitions.

    // Bad...Livewire::addPersistentMiddleware(AuthorizeResource::class.':admin'); // Good...Livewire::addPersistentMiddleware(AuthorizeResource::class);

### [#](#applying-global-livewire-middleware "Permalink")Applying global Livewire middleware

Alternatively, if you wish to apply specific middleware to every single Livewire update network request, you can do so by registering your own Livewire update route with any middleware you wish:

    Livewire::setUpdateRoute(function ($handle) {    return Route::post('/livewire/update', $handle)        ->middleware(App\Http\Middleware\LocalizeViewPaths::class);});

Any Livewire AJAX/fetch requests made to the server will use the above endpoint and apply the `LocalizeViewPaths` middleware before handling the component update.

Learn more about [customizing the update route on the Installation page](https://livewire.laravel.com/docs/installation#configuring-livewires-update-endpoint).

[#](#snapshot-checksums "Permalink")Snapshot checksums
------------------------------------------------------

Between every Livewire request, a snapshot is taken of the Livewire component and sent to the browser. This snapshot is used to re-build the component during the next server round-trip.

[Learn more about Livewire snapshots in the Hydration documentation.](https://livewire.laravel.com/docs/hydration#the-snapshot)

Because fetch requests can be intercepted and tampered with in a browser, Livewire generates a "checksum" of each snapshot to go along with it.

This checksum is then used on the next network request to verify that the snapshot hasn't changed in any way.

If Livewire finds a checksum mismatch, it will throw a `CorruptComponentPayloadException` and the request will fail.

This protects against any form of malicious tampering that would otherwise result in granting users the ability to execute or modify unrelated code.

---

## Session Properties

Session Properties
==================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire makes it easy to persist property values across page refreshes/changes using the `#[Session]` attribute.

By adding `#[Session]` to a property in your component, Livewire will store that property's value in the session every time it changes. This way, when a page is refreshed, Livewire will fetch the latest value from the session and use it in your component.

The `#[Session]` attribute is analogous to the [`#[Url]`](/docs/url) attribute. They are both useful in similar scenarios. The primary difference being `#[Session]` persists values without modifying the URL's query string, which is sometimes desired; sometimes not.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Here's a `ShowPosts` component that allows users to filter visible posts by a string stored in a `$search` property:

    <?php use Livewire\Attributes\Session;use Livewire\Component;use App\Models\Post; class ShowPosts extends Component{    #[Session]     public $search;     protected function posts()    {        return $this->search === ''            ? Post::all()            : Post::where('title', 'like', '%'.$this->search.'%');    }     public function render()    {        return view('livewire.show-posts', [            'posts' => $this->posts(),        ]);    }}

Because the `#[Session]` attribute has been added to the `$search` property, after a user enters a search value, they can refresh the page and the search value will be persisted. Every time `$search` is updated, its new value will be stored in the user's session and used across page loads.

Performance implications

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Because Laravel sessions are loaded into memory during every request, you can slow down the performance of your entire application for a given user by storing too much in a user's session.

[#](#setting-a-custom-key "Permalink")Setting a custom key
----------------------------------------------------------

When using `[#Session]`, Livewire will store the property value in the session using a dynamically generated key that consists of the component name combined with the property name.

This ensures that properties across component instances will use the same session value. It also ensures properties of the same name from different components won't conflict.

If you want full control over what session key Livewire uses for a given property, you can pass the `key:` parameter:

    <?php use Livewire\Attributes\Session;use Livewire\Component; class ShowPosts extends Component{    #[Session(key: 'search')]     public $search;     // ...}

When Livewire stores and retrieves the value of the `$search` property, it will use the given key: "search".

Additionally, if you want to generate the key dynamically from other properties in your component, you can do so using the following curly brace notation:

    <?php use Livewire\Attributes\Session;use Livewire\Component;use App\Models\Author; class ShowPosts extends Component{    public Author $author;     #[Session(key: 'search-{author.id}')]     public $search;     // ...}

In the above example, if the `$author` model's id is "4", the session key will become: `search-4`

---

## Synthesizers

Synthesizers
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Because Livewire components are dehydrated (serialized) into JSON, then hydrated (unserialized) back into PHP components between requests, their properties need to be JSON-serializable.

Natively, PHP serializes most primitive values into JSON easily. However, in order for Livewire components to support more sophisticated property types (like models, collections, carbon instances, and stringables), a more robust system is needed.

Therefore, Livewire provides a point of extension called "Synthesizers" that allow users to support any custom property types they wish.

Make sure you understand hydration first

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before using Synthesizers, it's helpful to fully understand Livewire's hydration system. You can learn more by reading the [hydration documentation](/docs/hydration).

[#](#understanding-synthesizers "Permalink")Understanding Synthesizers
----------------------------------------------------------------------

Before exploring the creation of custom Synthesizers, let's first look at the internal Synthesizer that Livewire uses to support [Laravel Stringables](https://laravel.com/docs/strings).

Suppose your application contained the following `CreatePost` component:

    class CreatePost extends Component{    public $title = '';}

Between requests, Livewire might serialize this component's state into a JSON object like the following:

    state: { title: '' },

Now, consider a more advanced example where the `$title` property value is a stringable instead of a plain string:

    class CreatePost extends Component{    public $title = '';     public function mount()    {        $this->title = str($this->title);    }}

The dehydrated JSON representing this component's state now contains a [metadata tuple](/docs/hydration#deeply-nested-tuples) instead of a plain empty string:

    state: { title: ['', { s: 'str' }] },

Livewire can now use this tuple to hydrate the `$title` property back into a stringable on the next request.

Now that you've seen the outside-in effects of Synthesizers, here is the actual source code for Livewire's internal stringable synth:

    use Illuminate\Support\Stringable; class StringableSynth extends Synth{    public static $key = 'str';     public static function match($target)    {        return $target instanceof Stringable;    }     public function dehydrate($target)    {        return [$target->__toString(), []];    }     public function hydrate($value)    {        return str($value);    }}

Let's break this down piece by piece.

First is the `$key` property:

    public static $key = 'str';

Every synth must contain a static `$key` property that Livewire uses to convert a [metadata tuple](/docs/hydration#deeply-nested-tuples) like `['', { s: 'str' }]` back into a stringable. As you may notice, each metadata tuple has an `s` key referencing this key.

Inversely, when Livewire is dehydrating a property, it will use the synth's static `match()` function to identify if this particular Synthesizer is a good candidate to dehydrate the current property (`$target` being the current value of the property):

    public static function match($target){    return $target instanceof Stringable;}

If `match()` returns true, the `dehydrate()` method will be used to take the property's PHP value as input and return the JSONable [metadata](/docs/hydration#deeply-nested-tuples) tuple:

    public function dehydrate($target){    return [$target->__toString(), []];}

Now, at the beginning of the next request, after this Synthesizer has been matched by the `{ s: 'str' }` key in the tuple, the `hydrate()` method will be called and passed the raw JSON representation of the property with the expectation that it returns the full PHP-compatible value to be assigned to the property.

    public function hydrate($value){    return str($value);}

[#](#registering-a-custom-synthesizer "Permalink")Registering a custom Synthesizer
----------------------------------------------------------------------------------

To demonstrate how you might author your own Synthesizer to support a custom property, we will use the following `UpdateProperty` component as an example:

    class UpdateProperty extends Component{    public Address $address;     public function mount()    {        $this->address = new Address();    }}

Here's the source for the `Address` class:

    namespace App\Dtos\Address; class Address{    public $street = '';    public $city = '';    public $state = '';    public $zip = '';}

To support properties of type `Address`, we can use the following Synthesizer:

    use App\Dtos\Address; class AddressSynth extends Synth{    public static $key = 'address';     public static function match($target)    {        return $target instanceof Address;    }     public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }     public function hydrate($value)    {        $instance = new Address;         $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];         return $instance;    }}

To make it available globally in your application, you can use Livewire's `propertySynthesizer` method to register the synthesizer from your service provider boot method:

    class AppServiceProvider extends ServiceProvider{    /**     * Bootstrap any application services.     */    public function boot(): void    {        Livewire::propertySynthesizer(AddressSynth::class);    }}

[#](#supporting-data-binding "Permalink")Supporting data binding
----------------------------------------------------------------

Using the `UpdateProperty` example from above, it is likely that you would want to support `wire:model` binding directly to properties of the `Address` object. Synthesizers allow you to support this using the `get()` and `set()` methods:

    use App\Dtos\Address; class AddressSynth extends Synth{    public static $key = 'address';     public static function match($target)    {        return $target instanceof Address;    }     public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }     public function hydrate($value)    {        $instance = new Address;         $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];         return $instance;    }     public function get(&$target, $key)     {        return $target->{$key};    }     public function set(&$target, $key, $value)    {        $target->{$key} = $value;    }}

---

## Teleport

Teleport
========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire allows you to _teleport_ part of your template to another part of the DOM on the page entirely.

This is useful for things like nested dialogs. When nesting one dialog inside of another, the z-index of the parent modal is applied to the nested modal. This can cause problems with styling backdrops and overlays. To avoid this problem, you can use Livewire's `@teleport` directive to render each nested modal as siblings in the rendered DOM.

This functionality is powered by [Alpine's `x-teleport` directive](https://alpinejs.dev/directives/teleport).

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

To _teleport_ a portion of your template to another part of the DOM, you can wrap it in Livewire's `@teleport` directive.

Below is an example of using `@teleport` to render a modal dialog's contents at the end of the `<body>` element on the page:

    <div>    <!-- Modal -->    <div x-data="{ open: false }">        <button @click="open = ! open">Toggle Modal</button>         @teleport('body')            <div x-show="open">                Modal contents...            </div>        @endteleport    </div></div>

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

The `@teleport` selector can be any string you would normally pass into something like `document.querySelector()`.

You can learn more about `document.querySelector()` by consulting its [MDN documentation](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector).

Now, when the above Livewire template is rendered on the page, the _contents_ portion of the modal will be rendered at the end of `<body>`:

    <body>    <!-- ... -->     <div x-show="open">        Modal contents...    </div></body>

You must teleport outside the component

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Livewire only supports teleporting HTML outside your components. For example, teleporting a modal to the `<body>` tag is fine, but teleporting it to another element within your component will not work.

Teleporting only works with a single root element

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Make sure you only include a single root element inside your `@teleport` statement.

---

## Testing

Testing
=======

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

[#](#creating-your-first-test "Permalink")Creating your first test
------------------------------------------------------------------

By appending the `--test` flag to the `make:livewire` command, you can generate a test file along with a component:

    php artisan make:livewire create-post --test

In addition to generating the component files themselves, the above command will generate the following test file `tests/Feature/Livewire/CreatePostTest.php`:

If you would like to create a [Pest PHP](https://pestphp.com/) test, you may provide the `--pest` option to the make:livewire command:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function renders_successfully()    {        Livewire::test(CreatePost::class)            ->assertStatus(200);    }}

Of course, you can always create these files by hand or even use Livewire's testing utilities inside any other existing PHPUnit test in your Laravel application.

Before reading further, you may wish to familiarize yourself with [Laravel's own built-in testing features](https://laravel.com/docs/testing).

[#](#testing-a-page-contains-a-component "Permalink")Testing a page contains a component
----------------------------------------------------------------------------------------

The simplest Livewire test you can write is asserting that a given endpoint in your application includes and successfully renders a given Livewire component.

Livewire provides an `assertSeeLivewire()` method that can be used from any Laravel test:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function component_exists_on_the_page()    {        $this->get('/posts/create')            ->assertSeeLivewire(CreatePost::class);    }}

These are called smoke tests

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Smoke tests are broad tests that ensure there are no catastrophic problems in your application. Although it may seem like a test that isn't worth writing, pound for pound, these are some of the most valuable tests you can write as they require very little maintenance and provide you a base level of confidence that your application will render successfully with no major errors.

[#](#testing-views "Permalink")Testing views
--------------------------------------------

Livewire provides a simple yet powerful utility for asserting the existence of text in the component's rendered output: `assertSee()`.

Below is an example of using `assertSee()` to ensure that all posts in the database are displayed on the page:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\ShowPosts;use Livewire\Livewire;use App\Models\Post;use Tests\TestCase; class ShowPostsTest extends TestCase{    /** @test */    public function displays_posts()    {        Post::factory()->make(['title' => 'On bathing well']);        Post::factory()->make(['title' => 'There\'s no time like bathtime']);         Livewire::test(ShowPosts::class)            ->assertSee('On bathing well')            ->assertSee('There\'s no time like bathtime');    }}

### [#](#asserting-data-from-the-view "Permalink")Asserting data from the view

In addition to asserting the output of a rendered view, sometimes it's helpful to test the data being passed into the view.

Here's the same test as above, but testing the view data rather than the rendered output:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\ShowPosts;use Livewire\Livewire;use App\Models\Post;use Tests\TestCase; class ShowPostsTest extends TestCase{    /** @test */    public function displays_all_posts()    {        Post::factory()->make(['title' => 'On bathing well']);        Post::factory()->make(['title' => 'The bathtub is my sanctuary']);         Livewire::test(ShowPosts::class)            ->assertViewHas('posts', function ($posts) {                return count($posts) == 2;            });    }}

As you can see, `assertViewHas()` provides control over what assertions you want to make against the specified data.

If you would rather make a simple assertion, such as ensuring a piece of view data matches a given value, you can pass the value directly as the second argument given to the `assertViewHas()` method.

For example, assuming you have a component with a variable named `$postCount` being passed into the view, you can make assertions against its literal value like so:

    $this->assertViewHas('postCount', 3)

[#](#setting-the-authenticated-user "Permalink")Setting the authenticated user
------------------------------------------------------------------------------

Most web applications require users to log in before using them. Rather than manually authenticating a fake user at the beginning of your tests, Livewire provides an `actingAs()` method.

Below is an example of a test where multiple users have posts, yet the authenticated user should only be able to see their own posts:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\ShowPosts;use Livewire\Livewire;use App\Models\User;use App\Models\Post;use Tests\TestCase; class ShowPostsTest extends TestCase{    /** @test */    public function user_only_sees_their_own_posts()    {        $user = User::factory()            ->has(Post::factory()->count(3))            ->create();         $stranger = User::factory()            ->has(Post::factory()->count(2))            ->create();         Livewire::actingAs($user)            ->test(ShowPosts::class)            ->assertViewHas('posts', function ($posts) {                return count($posts) == 3;            });    }}

[#](#testing-properties "Permalink")Testing properties
------------------------------------------------------

Livewire also provides helpful testing utilities for setting and asserting properties within your components.

Component properties are typically updated in your application when users interact with form inputs containing `wire:model`. But, because tests don't typically type into an actual browser, Livewire allows you to set properties directly using the `set()` method.

Below is an example of using `set()` to update the `$title` property of a `CreatePost` component:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function can_set_title()    {        Livewire::test(CreatePost::class)            ->set('title', 'Confessions of a serial soaker')            ->assertSet('title', 'Confessions of a serial soaker');    }}

### [#](#initializing-properties "Permalink")Initializing properties

Often, Livewire components receive data being passed in from a parent component or route parameters. Because Livewire components are tested in isolation, you can manually pass data into them using the second parameter of the `Livewire::test()` method:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\UpdatePost;use Livewire\Livewire;use App\Models\Post;use Tests\TestCase; class UpdatePostTest extends TestCase{    /** @test */    public function title_field_is_populated()    {        $post = Post::factory()->make([            'title' => 'Top ten bath bombs',        ]);         Livewire::test(UpdatePost::class, ['post' => $post])            ->assertSet('title', 'Top ten bath bombs');    }}

The underlying component being tested (`UpdatePost`) will receive `$post` through its `mount()` method. Let's look at the source for `UpdatePost` to paint a clearer picture of this feature:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class UpdatePost extends Component{    public Post $post;     public $title = '';     public function mount(Post $post)    {        $this->post = $post;         $this->title = $post->title;    }     // ...}

### [#](#setting-url-parameters "Permalink")Setting URL parameters

If your Livewire component depends on specific query parameters in the URL of the page it's loaded on, you can use the `withQueryParams()` method to set the query parameters manually for your test.

Below is a basic `SearchPosts` component that uses [Livewire's URL feature](/docs/url) to store and track the current search query in the query string:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Url;use App\Models\Post; class SearchPosts extends Component{    #[Url]     public $search = '';     public function render()    {        return view('livewire.search-posts', [            'posts' => Post::search($this->search)->get(),        ]);    }}

As you can see, the `$search` property above uses Livewire's `#[Url]` attribute to denote that its value should be stored in the URL.

Below is an example of how you would simulate the scenario of loading this component on a page with specific query parameters in the URL:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\SearchPosts;use Livewire\Livewire;use App\Models\Post;use Tests\TestCase; class SearchPostsTest extends TestCase{    /** @test */    public function can_search_posts_via_url_query_string()    {        Post::factory()->create(['title' => 'Testing the first water-proof hair dryer']);        Post::factory()->create(['title' => 'Rubber duckies that actually float']);         Livewire::withQueryParams(['search' => 'hair'])            ->test(SearchPosts::class)            ->assertSee('Testing the first')            ->assertDontSee('Rubber duckies');    }}

### [#](#setting-cookies "Permalink")Setting cookies

If your Livewire component depends on cookies, you can use the `withCookie()` or `withCookies()` methods to set the cookies manually for your test.

Below is a basic `Cart` component that loads a discount token from a cookie on mount:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\Attributes\Url;use App\Models\Post; class Cart extends Component{    public $discountToken;     public mount()    {        $this->discountToken = request()->cookie('discountToken');    }}

As you can see, the `$discountToken` property above gets its value from a cookie in the request.

Below is an example of how you would simulate the scenario of loading this component on a page with cookies:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\Cart;use Livewire\Livewire;use Tests\TestCase; class CartTest extends TestCase{    /** @test */    public function can_load_discount_token_from_a_cookie()    {        Livewire::withCookies(['discountToken' => 'CALEB2023'])            ->test(Cart::class)            ->assertSet('discountToken', 'CALEB2023');    }}

[#](#calling-actions "Permalink")Calling actions
------------------------------------------------

Livewire actions are typically called from the frontend using something like `wire:click`.

Because Livewire component tests don't use an actual browser, you can instead trigger actions in your tests using the `call()` method.

Below is an example of a `CreatePost` component using the `call()` method to trigger the `save()` action:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use App\Models\Post;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function can_create_post()    {        $this->assertEquals(0, Post::count());         Livewire::test(CreatePost::class)            ->set('title', 'Wrinkly fingers? Try this one weird trick')            ->set('content', '...')            ->call('save');         $this->assertEquals(1, Post::count());    }}

In the above test, we assert that calling `save()` creates a new post in the database.

You can also pass parameters to actions by passing additional parameters into the `call()` method:

    ->call('deletePost', $postId);

### [#](#validation "Permalink")Validation

To test that a validation error has been thrown, you can use Livewire's `assertHasErrors()` method:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function title_field_is_required()    {        Livewire::test(CreatePost::class)            ->set('title', '')            ->call('save')            ->assertHasErrors('title');    }}

If you want to test that a specific validation rule has failed, you can pass an array of rules:

    $this->assertHasErrors(['title' => ['required']]);

Or if you'd rather assert a validation message exists, you can do so as well:

    $this->assertHasErrors(['title' => ['The title field is required.']]);

### [#](#authorization "Permalink")Authorization

Authorizing actions relying on untrusted input in your Livewire components is [essential](/docs/properties#authorizing-the-input). Livewire provides `assertUnauthorized()` and `assertForbidden()` methods to ensure that an authentication or authorization check has failed:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\UpdatePost;use Livewire\Livewire;use App\Models\User;use App\Models\Post;use Tests\TestCase; class UpdatePostTest extends TestCase{    /** @test */    public function cant_update_another_users_post()    {        $user = User::factory()->create();        $stranger = User::factory()->create();         $post = Post::factory()->for($stranger)->create();         Livewire::actingAs($user)            ->test(UpdatePost::class, ['post' => $post])            ->set('title', 'Living the lavender life')            ->call('save')            ->assertUnauthorized();         Livewire::actingAs($user)            ->test(UpdatePost::class, ['post' => $post])            ->set('title', 'Living the lavender life')            ->call('save')            ->assertForbidden();    }}

If you prefer, you can also test for explicit status codes that an action in your component may have triggered using `assertStatus()`:

    ->assertStatus(401); // Unauthorized->assertStatus(403); // Forbidden

### [#](#redirects "Permalink")Redirects

You can test that a Livewire action performed a redirect using the `assertRedirect()` method:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function redirected_to_all_posts_after_creating_a_post()    {        Livewire::test(CreatePost::class)            ->set('title', 'Using a loofah doesn\'t make you aloof...ugh')            ->set('content', '...')            ->call('save')            ->assertRedirect('/posts');    }}

As an added convenience, you can assert that the user was redirected to a specific page component instead of a hard-coded URL.

    ->assertRedirect(CreatePost::class);

### [#](#events "Permalink")Events

To assert that an event was dispatched from within your component, you can use the `->assertDispatched()` method:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function creating_a_post_dispatches_event()    {        Livewire::test(CreatePost::class)            ->set('title', 'Top 100 bubble bath brands')            ->set('content', '...')            ->call('save')            ->assertDispatched('post-created');    }}

It is often helpful to test that two components can communicate with each other by dispatching and listening for events. Using the `dispatch()` method, let's simulate a `CreatePost` component dispatching a `create-post` event. Then, we will assert that a `PostCountBadge` component, which listens for that event, updates its post count appropriately:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\PostCountBadge;use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class PostCountBadgeTest extends TestCase{    /** @test */    public function post_count_is_updated_when_event_is_dispatched()    {        $badge = Livewire::test(PostCountBadge::class)            ->assertSee("0");         Livewire::test(CreatePost::class)            ->set('title', 'Tear-free: the greatest lie ever told')            ->set('content', '...')            ->call('save')            ->assertDispatched('post-created');         $badge->dispatch('post-created')            ->assertSee("1");    }}

Sometimes it may come in handy to assert that an event was dispatched with one or more parameters. Let's have a look at a component called `ShowPosts` that dispatches an event called `banner-message` with a parameter called `message`:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\ShowPosts;use Livewire\Livewire;use Tests\TestCase; class ShowPostsTest extends TestCase{    /** @test */    public function notification_is_dispatched_when_deleting_a_post()    {        Livewire::test(ShowPosts::class)            ->call('delete', postId: 3)            ->assertDispatched('notify',                message: 'The post was deleted',            );    }}

If your component dispatches an event of which the parameter values must be asserted conditionally, you can pass in a closure as the second argument to the `assertDispatched` method like below. It receives the event name as the first argument, and an array containing the parameters as the second argument. Make sure the closure returns a boolean.

    <?php namespace Tests\Feature\Livewire; use App\Livewire\ShowPosts;use Livewire\Livewire;use Tests\TestCase; class ShowPostsTest extends TestCase{    /** @test */    public function notification_is_dispatched_when_deleting_a_post()    {        Livewire::test(ShowPosts::class)            ->call('delete', postId: 3)            ->assertDispatched('notify', function($eventName, $params) {                return ($params['message'] ?? '') === 'The post was deleted';            })    }}

[#](#all-available-testing-utilities "Permalink")All available testing utilities
--------------------------------------------------------------------------------

Livewire provides many more testing utilities. Below is a comprehensive list of every testing method available to you, with a short description of how it's intended to be used:

### [#](#setup-methods "Permalink")Setup methods

Method

Description

`Livewire::test(CreatePost::class)`

Test the `CreatePost` component

`Livewire::test(UpdatePost::class, ['post' => $post])`

Test the `UpdatePost` component with the `post` parameter (To be received through the `mount()` method)

`Livewire::actingAs($user)`

Set the provided user as the session's authenticated user

`Livewire::withQueryParams(['search' => '...'])`

Set the test's `search` URL query parameter to the provided value (ex. `?search=...`). Typically in the context of a property using Livewire's [`#[Url]` attribute](/docs/url)

`Livewire::withCookie('color', 'blue')`

Set the test's `color` cookie to the provided value (`blue`).

`Livewire::withCookies(['color' => 'blue', 'name' => 'Taylor])`

Set the test's `color` and `name` cookies to the provided values (`blue`, `Taylor`).

`Livewire::withHeaders(['X-COLOR' => 'blue', 'X-NAME' => 'Taylor])`

Set the test's `X-COLOR` and `X-NAME` headers to the provided values (`blue`, `Taylor`).

`Livewire::withoutLazyLoading()`

Disable lazy loading in this and all child components under test.

### [#](#interacting-with-components "Permalink")Interacting with components

Method

Description

`set('title', '...')`

Set the `title` property to the provided value

`set(['title' => '...', ...])`

Set multiple component properties using an associative array

`toggle('sortAsc')`

Toggle the `sortAsc` property between `true` and `false`

`call('save')`

Call the `save` action / method

`call('remove', $post->id)`

Call the `remove` method and pass the `$post->id` as the first parameter (Accepts subsequent parameters as well)

`refresh()`

Trigger a component re-render

`dispatch('post-created')`

Dispatch the `post-created` event from the component

`dispatch('post-created', postId: $post->id)`

Dispatch the `post-created` event with `$post->id` as an additional parameter (`$event.detail` from Alpine)

### [#](#assertions "Permalink")Assertions

Method

Description

`assertSet('title', '...')`

Assert that the `title` property is set to the provided value

`assertNotSet('title', '...')`

Assert that the `title` property is not set to the provided value

`assertSetStrict('title', '...')`

Assert that the `title` property is set to the provided value using a strict comparison

`assertNotSetStrict('title', '...')`

Assert that the `title` property is not set to the provided value using a strict comparison

`assertReturned('...')`

Assert that the previous `->call(...)` returned a given value

`assertCount('posts', 3)`

Assert that the `posts` property is an array-like value with `3` items in it

`assertSnapshotSet('date', '08/26/1990')`

Assert that the `date` property's raw / dehydrated value (from JSON) is set to `08/26/1990`. Alternative to asserting against the hydrated `DateTime` instance in the case of `date`

`assertSnapshotNotSet('date', '08/26/1990')`

Assert that `date`'s raw / dehydrated value is not equal to the provided value

`assertSee($post->title)`

Assert that the rendered HTML of the component contains the provided value

`assertDontSee($post->title)`

Assert that the rendered HTML does not contain the provided value

`assertSeeHtml('<div>...</div>')`

Assert the provided string literal is contained in the rendered HTML without escaping the HTML characters (unlike `assertSee`, which does escape the provided characters by default)

`assertDontSeeHtml('<div>...</div>')`

Assert the provided string is contained in the rendered HTML

`assertSeeText($post->title)`

Assert that the provided string is contained within the rendered HTML text. The rendered content will be passed to the `strip_tags` PHP function before the assertion is made

`assertDontSeeText($post->title)`

Assert that the provided string is not contained within the rendered HTML text. The rendered content will be passed to the `strip_tags` PHP function before the assertion is made

`assertSeeInOrder(['...', '...'])`

Assert that the provided strings appear in order in the rendered HTML output of the component

`assertSeeHtmlInOrder([$firstString, $secondString])`

Assert that the provided HTML strings appear in order in the rendered output of the component

`assertDispatched('post-created')`

Assert that the given event has been dispatched by the component

`assertNotDispatched('post-created')`

Assert that the given event has not been dispatched by the component

`assertHasErrors('title')`

Assert that validation has failed for the `title` property

`assertHasErrors(['title' => ['required', 'min:6']])`

Assert that the provided validation rules failed for the `title` property

`assertHasNoErrors('title')`

Assert that there are no validation errors for the `title` property

`assertHasNoErrors(['title' => ['required', 'min:6']])`

Assert that the provided validation rules haven't failed for the `title` property

`assertRedirect()`

Assert that a redirect has been triggered from within the component

`assertRedirect('/posts')`

Assert the component triggered a redirect to the `/posts` endpoint

`assertRedirect(ShowPosts::class)`

Assert that the component triggered a redirect to the `ShowPosts` component

`assertRedirectToRoute('name', ['parameters'])`

Assert that the component triggered a redirect to the given route

`assertNoRedirect()`

Assert that no redirect has been triggered

`assertViewHas('posts')`

Assert that the `render()` method has passed a `posts` item to the view data

`assertViewHas('postCount', 3)`

Assert that a `postCount` variable has been passed to the view with a value of `3`

`assertViewHas('posts', function ($posts) { ... })`

Assert that `posts` view data exists and that it passes any assertions declared in the provided callback

`assertViewIs('livewire.show-posts')`

Assert that the component's render method returned the provided view name

`assertFileDownloaded()`

Assert that a file download has been triggered

`assertFileDownloaded($filename)`

Assert that a file download matching the provided file name has been triggered

`assertNoFileDownloaded()`

Assert that no file download has been triggered

`assertUnauthorized()`

Assert that an authorization exception has been thrown within the component (status code: 401)

`assertForbidden()`

Assert that an error response was triggered with the status code: 403

`assertStatus(500)`

Assert that the latest response matches the provided status code

---

## Troubleshooting

Troubleshooting
===============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Here at Livewire HQ, we try to remove problems from your pathway before you hit them. However, sometimes, there are some problems that we can't solve without introducing new ones, and other times, there are problems we can't anticipate.

Here are some common errors and scenarios you may encounter in your Livewire apps.

[#](#component-mismatches "Permalink")Component mismatches
----------------------------------------------------------

When interacting with Livewire components on your page, you may encounter odd behavior or error messages like the following:

    Error: Component already initialized

    Error: Snapshot missing on Livewire component with id: ...

There are lots of reasons why you may encounter these messages, but the most common one is forgetting to add `wire:key` to elements and components inside a `@foreach` loop.

### [#](#adding-wirekey "Permalink")Adding `wire:key`

Any time you have a loop in your Blade templates using something like `@foreach`, you need to add `wire:key` to the opening tag of the first element within the loop:

    @foreach($posts as $post)    <div wire:key="{{ $post->id }}">         ...    </div>@endforeach

This ensures that Livewire can keep track of different elements in the loop when the loop changes.

The same applies to Livewire components within a loop:

    @foreach($posts as $post)    <livewire:show-post :$post :key="$post->id" /> @endforeach

However, here's a tricky scenario you might not have assumed:

When you have a Livewire component deeply nested inside a `@foreach` loop, you STILL need to add a key to it. For example:

    @foreach($posts as $post)    <div wire:key="{{ $post->id }}">        ...        <livewire:show-post :$post :key="$post->id" />         ...    </div>@endforeach

Without the key on the nested Livewire component, Livewire will be unable to match the looped components up between network requests.

#### [#](#prefixing-keys "Permalink")Prefixing keys

Another tricky scenario you may run into is having duplicate keys within the same component. This often results from using model IDs as keys, which can sometimes collide.

Here's an example where we need to add a `post-` and an `author-` prefix to designate each set of keys as unique. Otherwise, if you have a `$post` and `$author` model with the same ID, you would have an ID collision:

    <div>    @foreach($posts as $post)        <div wire:key="post-{{ $post->id }}">...</div>     @endforeach     @foreach($authors as $author)        <div wire:key="author-{{ $author->id }}">...</div>     @endforeach</div>

[#](#multiple-instances-of-alpine "Permalink")Multiple instances of Alpine
--------------------------------------------------------------------------

When installing Livewire, you may run into error messages like the following:

    Error: Detected multiple instances of Alpine running

    Alpine Expression Error: $wire is not defined

If this is the case, you likely have two versions of Alpine running on the same page. Livewire includes its own bundle of Alpine under the hood, so you must remove any other versions of Alpine on Livewire pages in your application.

One common scenario in which this happens is adding Livewire to an existing application that already includes Alpine. For example, if you installed the Laravel Breeze starter kit and then added Livewire later, you would run into this.

The fix for this is simple: remove the extra Alpine instance.

### [#](#removing-laravel-breezes-alpine "Permalink")Removing Laravel Breeze's Alpine

If you are installing Livewire inside an existing Laravel Breeze (Blade + Alpine version), you need to remove the following lines from `resources/js/app.js`:

     import './bootstrap';  -import Alpine from 'alpinejs'; - -window.Alpine = Alpine;- -Alpine.start();

### [#](#removing-a-cdn-version-of-alpine "Permalink")Removing a CDN version of Alpine

Because Livewire version 2 and below didn't include Alpine by default, you may have included an Alpine CDN as a script tag in the head of your layout. In Livewire v3, you can remove this CDN altogether, and Livewire will automatically provide Alpine for you:

         ...-    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>  </head>

Note: you can also remove any additional Alpine plugins, as Livewire includes all Alpine plugins except `@alpinejs/ui`.

[#](#missing-alpinejsui "Permalink")Missing `@alpinejs/ui`
----------------------------------------------------------

Livewire's bundled version of Alpine includes all Alpine plugins EXCEPT `@alpinejs/ui`. If you are using headless components from [Alpine Components](https://alpinejs.dev/components), which relies on this plugin, you may encounter errors like the following:

    Uncaught Alpine: no element provided to x-anchor

To fix this, you can simply include the `@alpinejs/ui` plugin as a CDN in your layout file like so:

         ...+    <script defer src="https://unpkg.com/@alpinejs/[email protected]/dist/cdn.min.js"></script>  </head>

Note: be sure to include the latest version of this plugin, which you can find on [any component's documentation page](https://alpinejs.dev/component/headless-dialog/docs).

---

## Understanding Nesting

Nesting
=======

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Like many other component-based frameworks, Livewire components are nestable — meaning one component can render multiple components within itself.

However, because Livewire's nesting system is built differently than other frameworks, there are certain implications and constraints that are important to be aware of.

Make sure you understand hydration first

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before learning more about Livewire's nesting system, it's helpful to fully understand how Livewire hydrates components. You can learn more by reading the [hydration documentation](/docs/hydration).

[#](#every-component-is-an-island "Permalink")Every component is an island
--------------------------------------------------------------------------

In Livewire, every component on a page tracks its state and makes updates independently of other components.

For example, consider the following `Posts` and nested `ShowPost` components:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class Posts extends Component{    public $postLimit = 2;     public function render()    {        return view('livewire.posts', [            'posts' => Auth::user()->posts()                ->limit($this->postLimit)->get(),        ]);    }}

    <div>    Post Limit: <input type="number" wire:model.live="postLimit">     @foreach ($posts as $post)        <livewire:show-post :$post :key="$post->id">    @endforeach</div>

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;     public function render()    {        return view('livewire.show-post');    }}

    <div>    <h1>{{ $post->title }}</h1>     <p>{{ $post->content }}</p>     <button wire:click="$refresh">Refresh post</button></div>

Here's what the HTML for the entire component tree might look like on initial page load:

    <div wire:id="123" wire:snapshot="...">    Post Limit: <input type="number" wire:model.live="postLimit">     <div wire:id="456" wire:snapshot="...">        <h1>The first post</h1>         <p>Post content</p>         <button wire:click="$refresh">Refresh post</button>    </div>     <div wire:id="789" wire:snapshot="...">        <h1>The second post</h1>         <p>Post content</p>         <button wire:click="$refresh">Refresh post</button>    </div></div>

Notice that the parent component contains both its rendered template and the rendered templates of all the components nested within it.

Because each component is independent, they each have their own IDs and snapshots (`wire:id` and `wire:snapshot`) embedded in their HTML for Livewire's JavaScript core to extract and track.

Let's consider a few different update scenarios to see the differences in how Livewire handles different levels of nesting.

### [#](#updating-a-child "Permalink")Updating a child

If you were to click the "Refresh post" button in one of the child `show-post` components, here is what would be sent to the server:

    {    memo: { name: 'show-post', id: '456' },     state: { ... },}

Here's the HTML that would get sent back:

    <div wire:id="456">    <h1>The first post</h1>     <p>Post content</p>     <button wire:click="$refresh">Refresh post</button></div>

The important thing to note here is that when an update is triggered on a child component, only that component's data is sent to the server, and only that component is re-rendered.

Now let's look at the less intuitive scenario: updating a parent component.

### [#](#updating-the-parent "Permalink")Updating the parent

As a reminder, here's the Blade template of the parent `Posts` component:

    <div>    Post Limit: <input type="number" wire:model.live="postLimit">     @foreach ($posts as $post)        <livewire:show-post :$post :key="$post->id">    @endforeach</div>

If a user changes the "Post Limit" value from `2` to `1`, an update will be solely triggered on the parent.

Here's an example of what the request payload might look like:

    {    updates: { postLimit: 1 },     snapshot: {        memo: { name: 'posts', id: '123' },         state: { postLimit: 2, ... },    },}

As you can see, only the snapshot for the parent `Posts` component is sent along to the server.

An important question you might be asking yourself is: what happens when the parent component re-renders and encounters the child `show-post` components? How will it re-render the children if their snapshots haven't been included in the request payload?

The answer is: they won't be re-rendered.

When Livewire renders the `Posts` component, it will render placeholders for any child components it encounters.

Here is an example of what the rendered HTML for the `Posts` component might be after the above update:

    <div wire:id="123">    Post Limit: <input type="number" wire:model.live="postLimit">     <div wire:id="456"></div></div>

As you can see, only one child has been rendered because `postLimit` was updated to `1`. However, you will also notice that instead of the full child component, there is only an empty `<div></div>` with the matching `wire:id` attribute.

When this HTML is received on the frontend, Livewire will _morph_ the old HTML for this component into this new HTML, but intelligently skip any child component placeholders.

The effect is that, after _morphing_, the final DOM content of the parent `Posts` component will be the following:

    <div wire:id="123">    Post Limit: <input type="number" wire:model.live="postLimit">     <div wire:id="456">        <h1>The first post</h1>         <p>Post content</p>         <button wire:click="$refresh">Refresh post</button>    </div></div>

[#](#performance-implications "Permalink")Performance implications
------------------------------------------------------------------

Livewire's "island" architecture can have both positive and negative implications for your application.

An advantage of this architecture is it allows you to isolate expensive portions of your application. For example, you can quarantine a slow database query to its own independent component, and its performance overhead won't impact the rest of the page.

However, the biggest drawback of this approach is that because components are entirely separate, inter-component communication/dependencies becomes more difficult.

For example, if you had a property passed down from the above parent `Posts` component to the nested `ShowPost` component, it wouldn't be "reactive". Because each component is an island, if a request to the parent component changed the value of the property being passed into `ShowPost`, it wouldn't update inside `ShowPost`.

Livewire has overcome a number of these hurdles and provides dedicated APIs for these scenarios like: [Reactive properties](/docs/nesting#reactive-props), [Modelable components](/docs/nesting#binding-to-child-data-using-wiremodel), and [the `$parent` object](/docs/nesting#directly-accessing-the-parent-from-the-child).

Armed with this knowledge of how nested Livewire components operate, you will be able to make more informed decisions about when and how to nest components within your application.

---

## Upgrading

Upgrade Guide
=============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

[#](#automated-upgrade-tool "Permalink")Automated upgrade tool
--------------------------------------------------------------

To save you time upgrading, we've included an Artisan command to automate as many parts of the upgrade process as possible.

After [installing Livewire version 3](/docs/upgrading#update-livewire-to-version-3), run the following command, and you will receive prompts to upgrade each breaking change automatically:

    php artisan livewire:upgrade

Although the above command can upgrade much of your application, the only way to ensure a complete upgrade is to follow the step-by-step guide on this page.

Hire us to upgrade your app instead

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you have a large Livewire application or just don't want to deal with upgrading from version 2 to version 3, you can hire us to handle it for you. [Learn more about our upgrade service here.](/jumpstart)

[#](#upgrade-php "Permalink")Upgrade PHP
----------------------------------------

Livewire now requires that your application is running on PHP version 8.1 or greater.

[#](#update-livewire-to-version-3 "Permalink")Update Livewire to version 3
--------------------------------------------------------------------------

Run the following composer command to upgrade your application's Livewire dependency from version 2 to 3:

    composer require livewire/livewire "^3.0"

Livewire 3 package compatibility

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Most of the major third-party Livewire packages either currently support Livewire 3 or are working on supporting it soon. However, there will inevitably be packages that take longer to release support for Livewire 3.

[#](#clear-the-view-cache "Permalink")Clear the view cache
----------------------------------------------------------

Run the following Artisan command from your application's root directory to clear any cached/compiled Blade views and force Livewire to re-compile them to be Livewire 3 compatible:

    php artisan view:clear

[#](#merge-new-configuration "Permalink")Merge new configuration
----------------------------------------------------------------

Livewire 3 has changed multiple configuration options. If your application has a published configuration file (`config/livewire.php`), you will need to update it to account for the following changes.

### [#](#new-configuration "Permalink")New configuration

The following configuration keys have been introduced in version 3:

    'legacy_model_binding' => false, 'inject_assets' => true, 'inject_morph_markers' => true, 'navigate' => false, 'pagination_theme' => 'tailwind',

You can reference [Livewire's new configuration file on GitHub](https://github.com/livewire/livewire/blob/master/config/livewire.php) for additional option descriptions and copy-pastable code.

### [#](#changed-configuration "Permalink")Changed configuration

The following configuration items have been updated with new default values:

#### [#](#new-class-namespace "Permalink")New class namespace

Livewire's default `class_namespace` has changed from `App\Http\Livewire` to `App\Livewire`. You are welcome to keep the old namespace configuration value; however, if you choose to update your configuration to the new namespace, you will have to move your Livewire components to `app/Livewire`:

    -'class_namespace' => 'App\\Http\\Livewire', +'class_namespace' => 'App\\Livewire', 

#### [#](#new-layout-view-path "Permalink")New layout view path

When rendering full-page components in version 2, Livewire would use `resources/views/layouts/app.blade.php` as the default layout Blade component.

Because of a growing community preference for anonymous Blade components, Livewire 3 has changed the default location to: `resources/views/components/layouts/app.blade.php`.

    -'layout' => 'layouts.app', +'layout' => 'components.layouts.app', 

### [#](#removed-configuration "Permalink")Removed configuration

Livewire no longer recognizes the following configuration items.

#### [#](#appurl "Permalink")`app_url`

If your application is served under a non-root URI, in Livewire 2 you could use the `app_url` configuration option to configure the URL Livewire uses to make AJAX requests to.

In this case, we've found a string configuration to be too rigid. Therefore, Livewire 3 has chosen to use runtime configuration instead. You can reference our documentation on [configuring Livewire's update endpoint](/docs/installation#configuring-livewires-update-endpoint) for more information.

#### [#](#asseturl "Permalink")`asset_url`

In Livewire 2, if your application was served under a non-root URI, you would use the `asset_url` configuration option to configure the base URL that Livewire uses to serve its JavaScript assets.

Livewire 3 has instead chosen a runtime configuration strategy. You can reference our documentation on [configuring Livewire's script asset endpoint](/docs/installation#customizing-the-asset-url) for more information.

#### [#](#middlewaregroup "Permalink")`middleware_group`

Because Livewire now exposes a more flexible way to customize its update endpoint, the `middleware_group` configuration option has been removed.

You can reference our documentation on [customizing Livewire's update endpoint](/docs/installation#configuring-livewires-update-endpoint) for more information on applying custom middleware to Livewire requests.

#### [#](#manifestpath "Permalink")`manifest_path`

Livewire 3 no longer uses a manifest file for component autoloading. Therefore, the `manifest_path` configuration is no longer necessary.

#### [#](#backbuttoncache "Permalink")`back_button_cache`

Because Livewire 3 now offers an [SPA experience for your application using `wire:navigate`](/docs/navigate), the `back_button_cache` configuration is no longer necessary.

[#](#livewire-app-namespace "Permalink")Livewire app namespace
--------------------------------------------------------------

In version 2, Livewire components were generated and recognized automatically under the `App\Http\Livewire` namespace.

Livewire 3 has changed this default to: `App\Livewire`.

You can either move all of your components to the new location or add the following configuration to your application's `config/livewire.php` configuration file:

    'class_namespace' => 'App\\Http\\Livewire',

### [#](#discovery "Permalink")Discovery

With Livewire 3, there is no manifest present, and there is therefore nothing to “discover” in relation to Livewire Components, and you can safely remove any livewire:discover references from your build scripts without issue.

[#](#page-component-layout-view "Permalink")Page component layout view
----------------------------------------------------------------------

When rendering Livewire components as full pages using a syntax like the following:

    Route::get('/posts', ShowPosts::class);

The Blade layout file used by Livewire to render the component has changed from `resources/views/layouts/app.blade.php` to `resources/views/components/layouts/app.blade.php`:

    -resources/views/layouts/app.blade.php +resources/views/components/layouts/app.blade.php 

You can either move your layout file to the new location or apply the following configuration inside your application's `config/livewire.php` configuration file:

    'layout' => 'layouts.app',

For more information, check out the documentation on [creating and using a page-component layout](/docs/components#layout-files).

[#](#eloquent-model-binding "Permalink")Eloquent model binding
--------------------------------------------------------------

Livewire 2 supported `wire:model` binding directly to Eloquent model properties. For example, the following was a common pattern:

    public Post $post; protected $rules = [    'post.title' => 'required',    'post.description' => 'required',];

    <input wire:model="post.title"><input wire:model="post.description">

In Livewire 3, binding directly to Eloquent models has been disabled in favor of using individual properties, or extracting [Form Objects](/docs/forms#extracting-a-form-object).

However, because this behavior is so heavily relied upon in Livewire applications, version 3 maintains support for this behavior via a configuration item in `config/livewire.php`:

    'legacy_model_binding' => true,

By setting `legacy_model_binding` to `true`, Livewire will handle Eloquent model properties exactly as it did in version 2.

[#](#alpinejs "Permalink")AlpineJS
----------------------------------

Livewire 3 ships with [AlpineJS](https://alpinejs.dev) by default.

If you manually include Alpine in your Livewire application, you will need to remove it, so that Livewire's built-in version doesn't conflict.

### [#](#including-alpine-via-a-script-tag "Permalink")Including Alpine via a script tag

If you include Alpine into your application via a script tag like the following, you can remove it entirely and Livewire will load its internal version instead:

    -<script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script> 

### [#](#including-plugins-via-a-script-tag "Permalink")Including plugins via a script tag

Livewire 3 now ships with the following Alpine plugins out-of-the-box:

*   [Anchor](https://alpinejs.dev/plugins/anchor)
*   [Collapse](https://alpinejs.dev/plugins/collapse)
*   [Focus](https://alpinejs.dev/plugins/focus)
*   [Intersect](https://alpinejs.dev/plugins/intersect)
*   [Mask](https://alpinejs.dev/plugins/mask)
*   [Morph](https://alpinejs.dev/plugins/morph)
*   [Persist](https://alpinejs.dev/plugins/persist)

It is worth keeping an eye on changes to the [package.json](https://github.com/livewire/livewire/blob/main/package.json) file, as new Alpine plugins may be added!

If you have previously included any of these in your application via `<script>` tags like below, you should remove them along with Alpine's core:

    -<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/[email protected]/dist/cdn.min.js"></script> -<!-- ... -->

### [#](#accessing-the-alpine-global-via-a-script-tag "Permalink")Accessing the Alpine global via a script tag

If you are currently accessing the `Alpine` global object from a script tag like so:

    <script>    document.addEventListener('alpine:init', () => {        Alpine.data(...)    })</script>

You may continue to do so, as Livewire internally includes and registers Alpine's global object like before.

### [#](#including-via-js-bundle "Permalink")Including via JS bundle

If you have included Alpine or any of the popular core Alpine plugins mentioned above via NPM into your applications JavaScript bundle like so:

    // Warning: this is a snippet of the Livewire 2 approach to including Alpine import Alpine from 'alpinejs'import intersect from '@alpinejs/intersect' Alpine.plugin(intersect) Alpine.start()

You can remove them entirely, because Livewire includes Alpine and many popular Alpine plugins by default.

#### [#](#accessing-alpine-via-js-bundle "Permalink")Accessing Alpine via JS bundle

If you are registering custom Alpine plugins or components inside your application's JavaScript bundle like so:

    // Warning: this is a snippet of the Livewire 2 approach to including Alpine import Alpine from 'alpinejs'import customPlugin from './plugins/custom-plugin' Alpine.plugin(customPlugin) Alpine.start()

You can still accomplish this by importing the Livewire core ESM module into your bundle and accessing `Alpine` from there.

To import Livewire into your bundle, you must first disable Livewire's normal JavaScript injection and provide the necessary configuration to Livewire by replacing `@livewireScripts` with `@livewireScriptConfig` in your application's primary layout:

         <!-- ... -->  -    @livewireScripts +    @livewireScriptConfig  </body>

Now, you can import `Alpine` and `Livewire` into your application's bundle like so:

    import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';import customPlugin from './plugins/custom-plugin' Alpine.plugin(customPlugin) Livewire.start()

Notice you no longer need to call `Alpine.start()`. Livewire will start Alpine automatically.

For more information, please consult our documentation on [manually bundling Livewire's JavaScript](/docs/installation#manually-bundling-livewire-and-alpine).

[#](#wiremodel "Permalink")`wire:model`
---------------------------------------

In Livewire 3, `wire:model` is "deferred" by default (instead of by `wire:model.defer`). To achieve the same behavior as `wire:model` from Livewire 2, you must use `wire:model.live`.

Below is a list of the necessary substitutions you will need to make in your templates to keep your application's behavior consistent:

    -<input wire:model="..."> +<input wire:model.live="...">   -<input wire:model.defer="..."> +<input wire:model="...">   -<input wire:model.lazy="..."> +<input wire:model.blur="..."> 

[#](#entangle "Permalink")`@entangle`
-------------------------------------

Similar to the changes to `wire:model`, Livewire 3 defers all data binding by default. To match this behavior, `@entangle` has been updated as well.

To keep your application running as expected, make the following `@entangle` substitutions:

    -@entangle(...) +@entangle(...).live   -@entangle(...).defer +@entangle(...) 

[#](#events "Permalink")Events
------------------------------

In Livewire 2, Livewire had two different PHP methods for triggering events:

*   `emit()`
*   `dispatchBrowserEvent()`

Livewire 3 has unified these two methods into a single method:

*   `dispatch()`

Here is a basic example of dispatching and listening for an event in Livewire 3:

    // Dispatching...class CreatePost extends Component{    public Post $post;     public function save()    {        $this->dispatch('post-created', postId: $this->post->id);    }} // Listening...class Dashboard extends Component{    #[On('post-created')]    public function postAdded($postId)    {        //    }}

The three main changes from Livewire 2 are:

1.  `emit()` has been renamed to `dispatch()` (Likewise `emitTo()` and `emitSelf()` are now `dispatchTo()` and `dispatchSelf()`)
2.  `dispatchBrowserEvent()` has been renamed to `dispatch()`
3.  All event parameters must be named

For more information, check out the new [events documentation page](/docs/events).

Here are the "find and replace" differences that should be applied to your application:

    -$this->emit('post-created'); +$this->dispatch('post-created');   -$this->emitTo('foo', 'post-created'); +$this->dispatch('post-created')->to('foo');   -$this->emitSelf('post-created'); +$this->dispatch('post-created')->self();   -$this->emit('post-created', $post->id); +$this->dispatch('post-created', postId: $post->id);   -$this->dispatchBrowserEvent('post-created'); +$this->dispatch('post-created');   -$this->dispatchBrowserEvent('post-created', ['postId' => $post->id]); +$this->dispatch('post-created', postId: $post->id); 

    -<button wire:click="$emit('post-created')">...</button> +<button wire:click="$dispatch('post-created')">...</button>   -<button wire:click="$emit('post-created', 1)">...</button> +<button wire:click="$dispatch('post-created', { postId: 1 })">...</button>   -<button wire:click="$emitTo('foo', post-created', 1)">...</button> +<button wire:click="$dispatchTo('foo', 'post-created', { postId: 1 })">...</button>   -<button x-on:click="$wire.emit('post-created', 1)">...</button> +<button x-on:click="$dispatch('post-created', { postId: 1 })">...</button> 

### [#](#emitup "Permalink")`emitUp()`

The concept of `emitUp` has been removed entirely. Events are now dispatched using browser events and therefore will "bubble up" by default.

You can remove any instances of `$this->emitUp(...)` or `$emitUp(...)` from your components.

### [#](#testing-events "Permalink")Testing events

Livewire has also changed event assertions to match the new unified terminology regarding dispatching events:

    -Livewire::test(Component::class)->assertEmitted('post-created'); +Livewire::test(Component::class)->assertDispatched('post-created');   -Livewire::test(Component::class)->assertEmittedTo(Foo::class, 'post-created'); +Livewire::test(Component::class)->assertDispatchedTo(Foo:class, 'post-created');   -Livewire::test(Component::class)->assertNotEmitted('post-created'); +Livewire::test(Component::class)->assertNotDispatched('post-created');   -Livewire::test(Component::class)->assertEmittedUp() 

### [#](#url-query-string "Permalink")URL query string

In previous Livewire versions, if you bound a property to the URL's query string, the property value would always be present in the query string, unless you used the `except` option.

In Livewire 3, all properties bound to the query string will only show up if their value has been changed after the page load. This default removes the need for the `except` option:

     public $search = '';   protected $queryString = [-    'search' => ['except' => ''], +    'search',  ];

If you'd like to revert back to the Livewire 2 behavior of always showing a property in the query string no matter its value, you can use the `keep` option:

    public $search = ''; protected $queryString = [    'search' => ['keep' => true], ];

[#](#pagination "Permalink")Pagination
--------------------------------------

The pagination system has been updated in Livewire 3 to better support multiple paginators within the same component.

### [#](#update-published-pagination-views "Permalink")Update published pagination views

If you've published Livewire's pagination views, you can reference the new ones in the [pagination directory on GitHub](https://github.com/livewire/livewire/tree/master/src/Features/SupportPagination/views) and update your application accordingly.

### [#](#accessing-this-page-directly "Permalink")Accessing `$this->page` directly

Because Livewire now supports multiple paginators per component, it has removed the `$page` property from the component class and replaced it with a `$paginators` property that stores an array of paginators:

    -$this->page = 2; +$this->paginators['page'] = 2; 

However, it is recommended that you use the provided `getPage` and `setPage` methods to modify and access the current page:

    // Getter...$this->getPage(); // Setter...$this->setPage(2);

### [#](#wireclickprefetch "Permalink")`wire:click.prefetch`

Livewire's prefetching feature (`wire:click.prefetch`) has been removed entirely. If you depended on this feature, your application will still work, it will just be slightly less performant in the instances where you were previously benefiting from `.prefetch`.

    -<button wire:click.prefetch=""> +<button wire:click="..."> 

[#](#component-class-changes "Permalink")Component class changes
----------------------------------------------------------------

The following changes have been made to Livewire's base `Livewire\Component` class that your application's components may have relied on.

### [#](#the-component-id-property "Permalink")The component `$id` property

If you accessed the component's ID directly via `$this->id`, you should instead use `$this->getId()`:

    -$this->id;   +$this->getId(); 

### [#](#duplicate-method-and-property-names "Permalink")Duplicate method and property names

PHP allows you to use the same name for both a class property and method. In Livewire 3, this will cause problems when calling methods from the frontend via `wire:click`.

It is strongly recommended that you use distinct names for all public methods and properties in a component:

    -public $search = '';    public function search() {     // ... }

    +public $query = '';    public function search() {     // ... }

[#](#javascript-api-changes "Permalink")JavaScript API changes
--------------------------------------------------------------

### [#](#livewireload "Permalink")`livewire:load`

In previous versions of Livewire, you could listen for the `livewire:load` event to execute JavaScript code immediately before Livewire initialized the page.

In Livewire 3, that event name has been changed to `livewire:init` to match Alpine's `alpine:init`:

    -document.addEventListener('livewire:load', () => {...}) +document.addEventListener('livewire:init', () => {...}) 

### [#](#page-expired-hook "Permalink")Page expired hook

In version 2, Livewire exposed a dedicated JavaScript method for customizing the page expiration behavior: `Livewire.onPageExpired()`. This method has been removed in favor of using the more powerful `request` hooks directly:

    -Livewire.onPageExpired(() => {...})   +Livewire.hook('request', ({ fail }) => { +    fail(({ status, preventDefault }) => {+        if (status === 419) {+            preventDefault()+ +            confirm('Your custom page expiration behavior...')+        }+    })+})

### [#](#new-lifecycle-hooks "Permalink")New lifecycle hooks

Many of Livewire's internal JavaScript lifecycle hooks have been changed in Livewire 3.

Here is a comparison of the old hooks and their new syntaxes for you to find/replace in your application:

    -Livewire.hook('component.initialized', (component) => {}) +Livewire.hook('component.init', ({ component, cleanup }) => {})   -Livewire.hook('element.initialized', (el, component) => {}) +Livewire.hook('element.init', ({ el, component }) => {})   -Livewire.hook('element.updating', (fromEl, toEl, component) => {}) +Livewire.hook('morph.updating', ({ el, toEl, component }) => {})   -Livewire.hook('element.updated', (el, component) => {}) +Livewire.hook('morph.updated', ({ el, component }) => {})   -Livewire.hook('element.removed', (el, component) => {}) +Livewire.hook('morph.removed', ({ el, component }) => {})   -Livewire.hook('message.sent', (message, component) => {}) -Livewire.hook('message.failed', (message, component) => {}) -Livewire.hook('message.received', (message, component) => {}) -Livewire.hook('message.processed', (message, component) => {})   +Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => { +    // Equivalent of 'message.sent'+ +    succeed(({ snapshot, effects }) => {+        // Equivalent of 'message.received'+ +        queueMicrotask(() => {+            // Equivalent of 'message.processed'+        })+    })+ +    fail(() => {+        // Equivalent of 'message.failed'+    })+})

You may consult the new [JavaScript hook documentation](/docs/javascript) for a more thorough understanding of the new hook system.

[#](#localization "Permalink")Localization
------------------------------------------

If your application uses a locale prefix in the URI such as `https://example.com/en/...`, Livewire 2 automatically preserved this URL prefix when making component updates via `https://example.com/en/livewire/update`.

Livewire 3 has stopped supporting this behavior automatically. Instead, you can override Livewire's update endpoint with any URI prefixes you need using `setUpdateRoute()`:

    Route::group(['prefix' => LaravelLocalization::setLocale()], function (){    // Your other localized routes...     Livewire::setUpdateRoute(function ($handle) {        return Route::post('/livewire/update', $handle);    });});

For more information, please consult our documentation on [configuring Livewire's update endpoint](/docs/installation#configuring-livewires-update-endpoint).

---

## Uploads

File Uploads
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire offers powerful support for uploading files within your components.

First, add the `WithFileUploads` trait to your component. Once this trait has been added to your component, you can use `wire:model` on file inputs as if they were any other input type and Livewire will take care of the rest.

Here's an example of a simple component that handles uploading a photo:

    <?php namespace App\Livewire; use Livewire\Component;use Livewire\WithFileUploads;use Livewire\Attributes\Validate; class UploadPhoto extends Component{    use WithFileUploads;     #[Validate('image|max:1024')] // 1MB Max    public $photo;     public function save()    {        $this->photo->store(path: 'photos');    }}

    <form wire:submit="save">    <input type="file" wire:model="photo">     @error('photo') <span class="error">{{ $message }}</span> @enderror     <button type="submit">Save photo</button></form>

The "upload" method is reserved

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Notice the above example uses a "save" method instead of an "upload" method. This is a common "gotcha". The term "upload" is reserved by Livewire. You cannot use it as a method or property name in your component.

From the developer's perspective, handling file inputs is no different than handling any other input type: Add `wire:model` to the `<input>` tag and everything else is taken care of for you.

However, more is happening under the hood to make file uploads work in Livewire. Here's a glimpse at what goes on when a user selects a file to upload:

1.  When a new file is selected, Livewire's JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.
2.  Once the URL is received, JavaScript does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file's unique hash ID.
3.  Once the file is uploaded and the unique hash ID is generated, Livewire's JavaScript makes a final request to the component on the server, telling it to "set" the desired public property to the new temporary file.
4.  Now, the public property (in this case, `$photo`) is set to the temporary file upload and is ready to be stored or validated at any point.

[#](#storing-uploaded-files "Permalink")Storing uploaded files
--------------------------------------------------------------

The previous example demonstrates the most basic storage scenario: moving the temporarily uploaded file to the "photos" directory on the application's default filesystem disk.

However, you may want to customize the file name of the stored file or even specify a specific storage "disk" to keep the file on (such as S3).

Original file names

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

You can access the original file name of a temporary upload, by calling its `->getClientOriginalName()` method.

Livewire honors the same APIs Laravel uses for storing uploaded files, so feel free to consult [Laravel's file upload documentation](https://laravel.com/docs/filesystem#file-uploads). However, below are a few common storage scenarios and examples:

    public function save(){    // Store the file in the "photos" directory of the default filesystem disk    $this->photo->store(path: 'photos');     // Store the file in the "photos" directory in a configured "s3" disk    $this->photo->store(path: 'photos', options: 's3');     // Store the file in the "photos" directory with the filename "avatar.png"    $this->photo->storeAs(path: 'photos', name: 'avatar');     // Store the file in the "photos" directory in a configured "s3" disk with the filename "avatar.png"    $this->photo->storeAs(path: 'photos', name: 'avatar', options: 's3');     // Store the file in the "photos" directory, with "public" visibility in a configured "s3" disk    $this->photo->storePublicly(path: 'photos', options: 's3');     // Store the file in the "photos" directory, with the name "avatar.png", with "public" visibility in a configured "s3" disk    $this->photo->storePubliclyAs(path: 'photos', name: 'avatar', options: 's3');}

[#](#handling-multiple-files "Permalink")Handling multiple files
----------------------------------------------------------------

Livewire automatically handles multiple file uploads by detecting the `multiple` attribute on the `<input>` tag.

For example, below is a component with an array property named `$photos`. By adding `multiple` to the form's file input, Livewire will automatically append new files to this array:

    use Livewire\Component;use Livewire\WithFileUploads;use Livewire\Attributes\Validate; class UploadPhotos extends Component{    use WithFileUploads;     #[Validate(['photos.*' => 'image|max:1024'])]    public $photos = [];     public function save()    {        foreach ($this->photos as $photo) {            $photo->store(path: 'photos');        }    }}

    <form wire:submit="save">    <input type="file" wire:model="photos" multiple>     @error('photos.*') <span class="error">{{ $message }}</span> @enderror     <button type="submit">Save photo</button></form>

[#](#file-validation "Permalink")File validation
------------------------------------------------

Like we've discussed, validating file uploads with Livewire is the same as handling file uploads from a standard Laravel controller.

Ensure S3 is properly configured

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Many of the validation rules relating to files require access to the file. When [uploading directly to S3](#uploading-directly-to-amazon-s3), these validation rules will fail if the S3 file object is not publicly accessible.

For more information on file validation, consult [Laravel's file validation documentation](https://laravel.com/docs/validation#available-validation-rules).

[#](#temporary-preview-urls "Permalink")Temporary preview URLs
--------------------------------------------------------------

After a user chooses a file, you should typically show them a preview of that file before they submit the form and store the file.

Livewire makes this trivial by using the `->temporaryUrl()` method on uploaded files.

Temporary URLs are restricted to images

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

For security reasons, temporary preview URLs are only supported on files with image MIME types.

Let's explore an example of a file upload with an image preview:

    use Livewire\Component;use Livewire\WithFileUploads;use Livewire\Attributes\Validate; class UploadPhoto extends Component{    use WithFileUploads;     #[Validate('image|max:1024')]    public $photo;     // ...}

    <form wire:submit="save">    @if ($photo)         <img src="{{ $photo->temporaryUrl() }}">    @endif     <input type="file" wire:model="photo">     @error('photo') <span class="error">{{ $message }}</span> @enderror     <button type="submit">Save photo</button></form>

As previously discussed, Livewire stores temporary files in a non-public directory; therefore, typically there's no simple way to expose a temporary, public URL to your users for image previewing.

However, Livewire solves this issue by providing a temporary, signed URL that pretends to be the uploaded image so your page can show an image preview to your users.

This URL is protected against showing files in directories above the temporary directory. And, because it's signed, users can't abuse this URL to preview other files on your system.

S3 temporary signed URLs

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you've configured Livewire to use S3 for temporary file storage, calling `->temporaryUrl()` will generate a temporary, signed URL to S3 directly so that image previews aren't loaded from your Laravel application server.

[#](#testing-file-uploads "Permalink")Testing file uploads
----------------------------------------------------------

You can use Laravel's existing file upload testing helpers to test file uploads.

Below is a complete example of testing the `UploadPhoto` component with Livewire:

    <?php namespace Tests\Feature\Livewire; use Illuminate\Http\UploadedFile;use Illuminate\Support\Facades\Storage;use App\Livewire\UploadPhoto;use Livewire\Livewire;use Tests\TestCase; class UploadPhotoTest extends TestCase{    /** @test */    public function can_upload_photo()    {        Storage::fake('avatars');         $file = UploadedFile::fake()->image('avatar.png');         Livewire::test(UploadPhoto::class)            ->set('photo', $file)            ->call('upload', 'uploaded-avatar.png');         Storage::disk('avatars')->assertExists('uploaded-avatar.png');    }}

Below is an example of the `UploadPhoto` component required to make the previous test pass:

    use Livewire\Component;use Livewire\WithFileUploads; class UploadPhoto extends Component{    use WithFileUploads;     public $photo;     public function upload($name)    {        $this->photo->storeAs('/', $name, disk: 'avatars');    }     // ...}

For more information on testing file uploads, please consult [Laravel's file upload testing documentation](https://laravel.com/docs/http-tests#testing-file-uploads).

[#](#uploading-directly-to-amazon-s3 "Permalink")Uploading directly to Amazon S3
--------------------------------------------------------------------------------

As previously discussed, Livewire stores all file uploads in a temporary directory until the developer permanently stores the file.

By default, Livewire uses the default filesystem disk configuration (usually `local`) and stores the files within a `livewire-tmp/` directory.

Consequently, file uploads are always utilizing your application server, even if you choose to store the uploaded files in an S3 bucket later.

If you wish to bypass your application server and instead store Livewire's temporary uploads in an S3 bucket, you can configure that behavior in your application's `config/livewire.php` configuration file. First, set `livewire.temporary_file_upload.disk` to `s3` (or another custom disk that uses the `s3` driver):

    return [    // ...    'temporary_file_upload' => [        'disk' => 's3',        // ...    ],];

Now, when a user uploads a file, the file will never actually be stored on your server. Instead, it will be uploaded directly to your S3 bucket within the `livewire-tmp/` sub-directory.

Publishing Livewire's configuration file

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before customizing the file upload disk, you must first publish Livewire's configuration file to your application's `/config` directory by running the following command:

    php artisan livewire:publish --config

### [#](#configuring-automatic-file-cleanup "Permalink")Configuring automatic file cleanup

Livewire's temporary upload directory will fill up with files quickly; therefore, it's essential to configure S3 to clean up files older than 24 hours.

To configure this behavior, run the following Artisan command from the environment that is utilizing an S3 bucket for file uploads:

    php artisan livewire:configure-s3-upload-cleanup

Now, any temporary files older than 24 hours will be cleaned up by S3 automatically.

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you are not using S3 for file storage, Livewire will handle file cleanup automatically and there is no need to run the command above.

[#](#loading-indicators "Permalink")Loading indicators
------------------------------------------------------

Although `wire:model` for file uploads works differently than other `wire:model` input types under the hood, the interface for showing loading indicators remains the same.

You can display a loading indicator scoped to the file upload like so:

    <input type="file" wire:model="photo"> <div wire:loading wire:target="photo">Uploading...</div>

Now, while the file is uploading, the "Uploading..." message will be shown and then hidden when the upload is finished.

For more information on loading states, check out our comprehensive [loading state documentation](/docs/wire-loading).

[#](#progress-indicators "Permalink")Progress indicators
--------------------------------------------------------

Every Livewire file upload operation dispatches JavaScript events on the corresponding `<input>` element, allowing custom JavaScript to intercept the events:

Event

Description

`livewire-upload-start`

Dispatched when the upload starts

`livewire-upload-finish`

Dispatched if the upload is successfully finished

`livewire-upload-cancel`

Dispatched if the upload was cancelled prematurely

`livewire-upload-error`

Dispatched if the upload fails

`livewire-upload-progress`

An event containing the upload progress percentage as the upload progresses

Below is an example of wrapping a Livewire file upload in an Alpine component to display an upload progress bar:

    <form wire:submit="save">    <div        x-data="{ uploading: false, progress: 0 }"        x-on:livewire-upload-start="uploading = true"        x-on:livewire-upload-finish="uploading = false"        x-on:livewire-upload-cancel="uploading = false"        x-on:livewire-upload-error="uploading = false"        x-on:livewire-upload-progress="progress = $event.detail.progress"    >        <!-- File Input -->        <input type="file" wire:model="photo">         <!-- Progress Bar -->        <div x-show="uploading">            <progress max="100" x-bind:value="progress"></progress>        </div>    </div>     <!-- ... --></form>

[#](#cancelling-an-upload "Permalink")Cancelling an upload
----------------------------------------------------------

If an upload is taking a long time, a user may want to cancel it. You can provide this functionality with Livewire's `$cancelUpload()` function in JavaScript.

Here's an example of creating a "Cancel Upload" button in a Livewire component using `wire:click` to handle the click event:

    <form wire:submit="save">    <!-- File Input -->    <input type="file" wire:model="photo">     <!-- Cancel upload button -->    <button type="button" wire:click="$cancelUpload('photo')">Cancel Upload</button>     <!-- ... --></form>

When "Cancel upload" is pressed, the file upload will request will be aborted and the file input will be cleared. The user can now attempt another upload with a different file.

Alternatively, you can call `cancelUpload(...)` from Alpine like so:

    <button type="button" x-on:click="$wire.cancelUpload('photo')">Cancel Upload</button>

[#](#javascript-upload-api "Permalink")JavaScript upload API
------------------------------------------------------------

Integrating with third-party file-uploading libraries often requires more control than a simple `<input type="file" wire:model="...">` element.

For these scenarios, Livewire exposes dedicated JavaScript functions.

These functions exist on a JavaScript component object, which can be accessed using Livewire's convenient `$wire` object from within your Livewire component's template:

    @script<script>    let file = $wire.el.querySelector('input[type="file"]').files[0]     // Upload a file...    $wire.upload('photo', file, (uploadedFilename) => {        // Success callback...    }, () => {        // Error callback...    }, (event) => {        // Progress callback...        // event.detail.progress contains a number between 1 and 100 as the upload progresses    }, () => {        // Cancelled callback...    })     // Upload multiple files...    $wire.uploadMultiple('photos', [file], successCallback, errorCallback, progressCallback, cancelledCallback)     // Remove single file from multiple uploaded files...    $wire.removeUpload('photos', uploadedFilename, successCallback)     // Cancel an upload...    $wire.cancelUpload('photos')</script>@endscript

[#](#configuration "Permalink")Configuration
--------------------------------------------

Because Livewire stores all file uploads temporarily before the developer can validate or store them, it assumes some default handling behavior for all file uploads.

### [#](#global-validation "Permalink")Global validation

By default, Livewire will validate all temporary file uploads with the following rules: `file|max:12288` (Must be a file less than 12MB).

If you wish to customize these rules, you can do so inside your application's `config/livewire.php` file:

    'temporary_file_upload' => [    // ...    'rules' => 'file|mimes:png,jpg,pdf|max:102400', // (100MB max, and only accept PNGs, JPEGs, and PDFs)],

### [#](#global-middleware "Permalink")Global middleware

The temporary file upload endpoint is assigned a throttling middleware by default. You can customize exactly what middleware this endpoint uses via the following configuration option:

    'temporary_file_upload' => [    // ...    'middleware' => 'throttle:5,1', // Only allow 5 uploads per user per minute],

### [#](#temporary-upload-directory "Permalink")Temporary upload directory

Temporary files are uploaded to the specified disk's `livewire-tmp/` directory. You can customize this directory via the following configuration option:

    'temporary_file_upload' => [    // ...    'directory' => 'tmp',],

---

## Url

URL Query Parameters
====================

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire allows you to store component properties in the URL's query string. For example, you may want a `$search` property in your component to be included in the URL: `https://example.com/users?search=bob`. This is particularly useful for things like filtering, sorting, and pagination, as it allows users to share and bookmark specific states of a page.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Below is a `ShowUsers` component that allows you to search users by their name via a simple text input:

    <?php namespace App\Livewire; use Livewire\Attributes\Url;use Livewire\Component;use App\Models\User; class ShowUsers extends Component{    public $search = '';     public function render()    {        return view('livewire.show-users', [            'users' => User::search($this->search)->get(),        ]);    }}

    <div>    <input type="text" wire:model.live="search">     <ul>        @foreach ($users as $user)            <li wire:key="{{ $user->id }}">{{ $user->name }}</li>        @endforeach    </ul></div>

As you can see, because the text input uses `wire:model.live="search"`, as a user types into the field, network requests will be sent to update the `$search` property and show a filtered set of users on the page.

However, if the visitor refreshes the page, the search value and results will be lost.

To preserve the search value across page loads so that a visitor can refresh the page or share the URL, we can store the search value in the URL's query string by adding the `#[Url]` attribute above the `$search` property like so:

    <?php namespace App\Livewire; use Livewire\Attributes\Url;use Livewire\Component;use App\Models\User; class ShowUsers extends Component{    #[Url]     public $search = '';     public function render()    {        return view('livewire.show-users', [            'posts' => User::search($this->search)->get(),        ]);    }}

Now, if a user types "bob" into the search field, the URL bar in the browser will show:

    https://example.com/users?search=bob

If they now load this URL from a new browser window, "bob" will be filled in the search field, and the user results will be filtered accordingly.

[#](#initializing-properties-from-the-url "Permalink")Initializing properties from the URL
------------------------------------------------------------------------------------------

As you saw in the previous example, when a property uses `#[Url]`, not only does it store its updated value in the query string of the URL, it also references any existing query string values on page load.

For example, if a user visits the URL `https://example.com/users?search=bob`, Livewire will set the initial value of `$search` to "bob".

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url]    public $search = ''; // Will be set to "bob"...     // ...}

### [#](#nullable-properties "Permalink")Nullable properties

By default, if a page is loaded with an empty query string entry like `?search=`, Livewire will treat that value as an empty string. In many cases, this is expected, however there are times when you want `?search=` to be treated as `null`.

In these cases, you can use a nullable typehint like so:

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url]    public ?string $search;      // ...}

Because `?` is present in the above typehint, Livewire will see `?search=` and set `$search` to `null` instead of an empty string.

This works the other way around as well, if you set `$this->search = null` in your application, it will be represented in the query string as `?search=`.

[#](#using-an-alias "Permalink")Using an alias
----------------------------------------------

Livewire gives you full control over what name displays in the URL's query string. For example, you may have a `$search` property but want to either obfuscate the actual property name or shorten it to `q`.

You can specify a query string alias by providing the `as` parameter to the `#[Url]` attribute:

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url(as: 'q')]    public $search = '';     // ...}

Now, when a user types "bob" into the search field, the URL will show: `https://example.com/users?q=bob` instead of `?search=bob`.

[#](#excluding-certain-values "Permalink")Excluding certain values
------------------------------------------------------------------

By default, Livewire will only put an entry in the query string when it's value has changed from what it was at initialization. Most of the time, this is the desired behavior, however, there are certain scenarios where you may want more control over which value Livewire excludes from the query string. In these cases you can use the `except` parameter.

For example, in the component below, the initial value of `$search` is modified in `mount()`. To ensure the browser will only ever exclude `search` from the query string if the `search` value is an empty string, the `except` parameter has been added to `#[Url]`:

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url(except: '')]    public $search = '';     public function mount() {        $this->search = auth()->user()->username;    }     // ...}

Without `except` in the above example, Livewire would remove the `search` entry from the query string any time the value of `search` is equal to the initial value of `auth()->user()->username`. Instead, because `except: ''` has been used, Livewire will preserve all query string values except when `search` is an empty string.

[#](#display-on-page-load "Permalink")Display on page load
----------------------------------------------------------

By default, Livewire will only display a value in the query string after the value has been changed on the page. For example, if the default value for `$search` is an empty string: `""`, when the actual search input is empty, no value will appear in the URL.

If you want the `?search` entry to always be included in the query string, even when the value is empty, you can provide the `keep` parameter to the `#[Url]` attribute:

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url(keep: true)]    public $search = '';     // ...}

Now, when the page loads, the URL will be changed to the following: `https://example.com/users?search=`

[#](#storing-in-history "Permalink")Storing in history
------------------------------------------------------

By default, Livewire uses [`history.replaceState()`](https://developer.mozilla.org/en-US/docs/Web/API/History/replaceState) to modify the URL instead of [`history.pushState()`](https://developer.mozilla.org/en-US/docs/Web/API/History/pushState). This means that when Livewire updates the query string, it modifies the current entry in the browser's history state instead of adding a new one.

Because Livewire "replaces" the current history, pressing the "back" button in the browser will go to the previous page rather than the previous `?search=` value.

To force Livewire to use `history.pushState` when updating the URL, you can provide the `history` parameter to the `#[Url]` attribute:

    use Livewire\Attributes\Url;use Livewire\Component; class ShowUsers extends Component{    #[Url(history: true)]    public $search = '';     // ...}

In the example above, when a user changes the search value from "bob" to "frank" and then clicks the browser's back button, the search value (and the URL) will be set back to "bob" instead of navigating to the previously visited page.

[#](#using-the-querystring-method "Permalink")Using the queryString method
--------------------------------------------------------------------------

The query string can also be defined as a method on the component. This can be useful if some properties have dynamic options.

    use Livewire\Component; class ShowUsers extends Component{    // ...     protected function queryString()    {        return [            'search' => [                'as' => 'q',            ],        ];    }}

[#](#trait-hooks "Permalink")Trait hooks
----------------------------------------

Livewire offers [hooks](/docs/lifecycle-hooks) for query strings as well.

    trait WithSorting{    // ...     protected function queryStringWithSorting()    {        return [            'sortBy' => ['as' => 'sort'],            'sortDirection' => ['as' => 'direction'],        ];    }}

---

## Validation

Validation
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire aims to make validating a user's input and giving them feedback as pleasant as possible. By building on top of Laravel's validation features, Livewire leverages your existing knowledge while also providing you with robust, additional features like real-time validation.

Here's an example `CreatePost` component that demonstrates the most basic validation workflow in Livewire:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        $validated = $this->validate([             'title' => 'required|min:3',            'content' => 'required|min:3',        ]);         Post::create($validated);         return redirect()->to('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit="save">    <input type="text" wire:model="title">    <div>@error('title') {{ $message }} @enderror</div>     <textarea wire:model="content"></textarea>    <div>@error('content') {{ $message }} @enderror</div>     <button type="submit">Save</button></form>

As you can see, Livewire provides a `validate()` method that you can call to validate your component's properties. It returns the validated set of data that you can then safely insert into the database.

On the frontend, you can use Laravel's existing Blade directives to show validation messages to your users.

For more information, see [Laravel's documentation on rendering validation errors in Blade](https://laravel.com/docs/blade#validation-errors).

[#](#validate-attributes "Permalink")Validate attributes
--------------------------------------------------------

If you prefer to co-locate your component's validation rules with the properties directly, you can use Livewire's `#[Validate]` attribute.

By associating validation rules with properties using `#[Validate]`, Livewire will automatically run the properties validation rules before each update. However, you should still run `$this->validate()` before persisting data to a database so that properties that haven't been updated are also validated.

    use Livewire\Attributes\Validate;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    #[Validate('required|min:3')]     public $title = '';     #[Validate('required|min:3')]     public $content = '';     public function save()    {        $this->validate();         Post::create([            'title' => $this->title,            'content' => $this->content,        ]);         return redirect()->to('/posts');    }     // ...}

Validate attributes don't support Rule objects

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

PHP Attributes are restricted to certain syntaxes like plain strings and arrays. If you find yourself wanting to use run-time syntaxes like Laravel's Rule objects (`Rule::exists(...)`) you should instead [define a `rules()` method](#defining-a-rules-method) in your component.

Learn more in the documentation on [using Laravel Rule objects with Livewire](#using-laravel-rule-objects).

If you prefer more control over when the properties are validated, you can pass a `onUpdate: false` parameter to the `#[Validate]` attribute. This will disable any automatic validation and instead assume you want to manually validate the properties using the `$this->validate()` method:

    use Livewire\Attributes\Validate;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    #[Validate('required|min:3', onUpdate: false)]    public $title = '';     #[Validate('required|min:3', onUpdate: false)]    public $content = '';     public function save()    {        $validated = $this->validate();         Post::create($validated);         return redirect()->to('/posts');    }     // ...}

### [#](#custom-attribute-name "Permalink")Custom attribute name

If you wish to customize the attribute name injected into the validation message, you may do so using the `as:` parameter:

    use Livewire\Attributes\Validate; #[Validate('required', as: 'date of birth')]public $dob;

When validation fails in the above snippet, Laravel will use "date of birth" instead of "dob" as the name of the field in the validation message. The generated message will be "The date of birth field is required" instead of "The dob field is required".

### [#](#custom-validation-message "Permalink")Custom validation message

To bypass Laravel's validation message and replace it with your own, you can use the `message:` parameter in the `#[Validate]` attribute:

    use Livewire\Attributes\Validate; #[Validate('required', message: 'Please provide a post title')]public $title;

Now, when the validation fails for this property, the message will be "Please provide a post title" instead of "The title field is required".

If you wish to add different messages for different rules, you can simply provide multiple `#[Validate]` attributes:

    #[Validate('required', message: 'Please provide a post title')]#[Validate('min:3', message: 'This title is too short')]public $title;

### [#](#opting-out-of-localization "Permalink")Opting out of localization

By default, Livewire rule messages and attributes are localized using Laravel's translate helper: `trans()`.

You can opt-out of localization by passing the `translate: false` parameter to the `#[Validate]` attribute:

    #[Validate('required', message: 'Please provide a post title', translate: false)]public $title;

### [#](#custom-key "Permalink")Custom key

When applying validation rules directly to a property using the `#[Validate]` attribute, Livewire assumes the validation key should be the name of the property itself. However, there are times when you may want to customize the validation key.

For example, you might want to provide separate validation rules for an array property and its children. In this case, instead of passing a validation rule as the first argument to the `#[Validate]` attribute, you can pass an array of key-value pairs instead:

    #[Validate([    'todos' => 'required',    'todos.*' => [        'required',        'min:3',        new Uppercase,    ],])]public $todos = [];

Now, when a user updates `$todos`, or the `validate()` method is called, both of these validation rules will be applied.

[#](#form-objects "Permalink")Form objects
------------------------------------------

As more properties and validation rules are added to a Livewire component, it can begin to feel too crowded. To alleviate this pain and also provide a helpful abstraction for code reuse, you can use Livewire's _Form Objects_ to store your properties and validation rules.

Below is the same `CreatePost` example, but now the properties and rules have been extracted to a dedicated form object named `PostForm`:

    <?php namespace App\Livewire\Forms; use Livewire\Attributes\Validate;use Livewire\Form; class PostForm extends Form{    #[Validate('required|min:3')]    public $title = '';     #[Validate('required|min:3')]    public $content = '';}

The `PostForm` above can now be defined as a property on the `CreatePost` component:

    <?php namespace App\Livewire; use App\Livewire\Forms\PostForm;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public PostForm $form;     public function save()    {        Post::create(            $this->form->all()        );         return redirect()->to('/posts');    }     // ...}

As you can see, instead of listing out each property individually, we can retrieve all the property values using the `->all()` method on the form object.

Also, when referencing the property names in the template, you must prepend `form.` to each instance:

    <form wire:submit="save">    <input type="text" wire:model="form.title">    <div>@error('form.title') {{ $message }} @enderror</div>     <textarea wire:model="form.content"></textarea>    <div>@error('form.content') {{ $message }} @enderror</div>     <button type="submit">Save</button></form>

When using form objects, `#[Validate]` attribute validation will be run every time a property is updated. However, if you disable this behavior by specifying `onUpdate: false` on the attribute, you can manually run a form object's validation using `$this->form->validate()`:

    public function save(){    Post::create(        $this->form->validate()    );     return redirect()->to('/posts');}

Form objects are a useful abstraction for most larger datasets and a variety of additional features that make them even more powerful. For more information, check out the comprehensive [form object documentation](/docs/forms#extracting-a-form-object).

[#](#real-time-validation "Permalink")Real-time validation
----------------------------------------------------------

Real-time validation is the term used for when you validate a user's input as they fill out a form rather than waiting for the form submission.

By using `#[Validate]` attributes directly on Livewire properties, any time a network request is sent to update a property's value on the server, the provided validation rules will be applied.

This means to provide a real-time validation experience for your users on a specific input, no extra backend work is required. The only thing that is required is using `wire:model.live` or `wire:model.blur` to instruct Livewire to trigger network requests as the fields are filled out.

In the below example, `wire:model.blur` has been added to the text input. Now, when a user types in the field and then tabs or clicks away from the field, a network request will be triggered with the updated value and the validation rules will run:

    <form wire:submit="save">    <input type="text" wire:model.blur="title">     <!-- --></form>

If you are using a `rules()` method to declare your validation rules for a property instead of the `#[Validate]` attribute, you can still include a #\[Validate\] attribute with no parameters to retain the real-time validating behavior:

    use Livewire\Attributes\Validate;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    #[Validate]     public $title = '';     public $content = '';     protected function rules()    {        return [            'title' => 'required|min:5',            'content' => 'required|min:5',        ];    }     public function save()    {        $validated = $this->validate();         Post::create($validated);         return redirect()->to('/posts');    }

Now, in the above example, even though `#[Validate]` is empty, it will tell Livewire to run the fields validation provided by `rules()` everytime the property is updated.

[#](#customizing-error-messages "Permalink")Customizing error messages
----------------------------------------------------------------------

Out-of-the-box, Laravel provides sensible validation messages like "The title field is required." if the `$title` property has the `required` rule attached to it.

However, you may need to customize the language of these error messages to better suite your application and its users.

### [#](#custom-attribute-names "Permalink")Custom attribute names

Sometimes the property you are validating has a name that isn't suited for displaying to users. For example, if you have a database field in your app named `dob` that stands for "Date of birth", you would want to show your users "The date of birth field is required" instead of "The dob field is required".

Livewire allows you to specify an alternative name for a property using the `as:` parameter:

    use Livewire\Attributes\Validate; #[Validate('required', as: 'date of birth')]public $dob = '';

Now, if the `required` validation rule fails, the error message will state "The date of birth field is required." instead of "The dob field is required.".

### [#](#custom-messages "Permalink")Custom messages

If customizing the property name isn't enough, you can customize the entire validation message using the `message:` parameter:

    use Livewire\Attributes\Validate; #[Validate('required', message: 'Please fill out your date of birth.')]public $dob = '';

If you have multiple rules to customize the message for, it is recommended that you use entirely separate `#[Validate]` attributes for each, like so:

    use Livewire\Attributes\Validate; #[Validate('required', message: 'Please enter a title.')]#[Validate('min:5', message: 'Your title is too short.')]public $title = '';

If you want to use the `#[Validate]` attribute's array syntax instead, you can specify custom attributes and messages like so:

    use Livewire\Attributes\Validate; #[Validate([    'titles' => 'required',    'titles.*' => 'required|min:5',], message: [    'required' => 'The :attribute is missing.',    'titles.required' => 'The :attribute are missing.',    'min' => 'The :attribute is too short.',], attribute: [    'titles.*' => 'title',])]public $titles = [];

[#](#defining-a-rules-method "Permalink")Defining a `rules()` method
--------------------------------------------------------------------

As an alternative to Livewire's `#[Validate]` attributes, you can define a method in your component called `rules()` and return a list of fields and corresponding validation rules. This can be helpful if you are trying to use run-time syntaxes that aren't supported in PHP Attributes, for example, Laravel rule objects like `Rule::password()`.

These rules will then be applied when you run `$this->validate()` inside the component. You also can define the `messages()` and `validationAttributes()` functions.

Here's an example:

    use Livewire\Component;use App\Models\Post;use Illuminate\Validation\Rule; class CreatePost extends Component{    public $title = '';     public $content = '';     protected function rules()     {        return [            'title' => Rule::exists('posts', 'title'),            'content' => 'required|min:3',        ];    }     protected function messages()     {        return [            'content.required' => 'The :attribute are missing.',            'content.min' => 'The :attribute is too short.',        ];    }     protected function validationAttributes()     {        return [            'content' => 'description',        ];    }     public function save()    {        $this->validate();         Post::create([            'title' => $this->title,            'content' => $this->content,        ]);         return redirect()->to('/posts');    }     // ...}

The`rules()` method doesn't validate on data updates

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

When defining rules via the `rules()` method, Livewire will ONLY use these validation rules to validate properties when you run `$this->validate()`. This is different than standard `#[Validate]` attributes which are applied every time a field is updated via something like `wire:model`. To apply these validation rules to a property every time it's updated, you can still use `#[Validate]` with no extra parameters.

Don't conflict with Livewire's mechanisms

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

While using Livewire's validation utilities, your component should **not** have properties or methods named `rules`, `messages`, `validationAttributes` or `validationCustomValues`, unless you're customizing the validation process. Otherwise, those will conflict with Livewire's mechanisms.

[#](#using-laravel-rule-objects "Permalink")Using Laravel Rule objects
----------------------------------------------------------------------

Laravel `Rule` objects are an extremely powerful way to add advanced validation behavior to your forms.

Here is an example of using Rule objects in conjunction with Livewire's `rules()` method to achieve more sophisticated validation:

    <?php namespace App\Livewire; use Illuminate\Validation\Rule;use App\Models\Post;use Livewire\Form; class UpdatePost extends Form{    public ?Post $post;     public $title = '';     public $content = '';     protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),             ],            'content' => 'required|min:5',        ];    }     public function mount()    {        $this->title = $this->post->title;        $this->content = $this->post->content;    }     public function update()    {        $this->validate();          $this->post->update($this->all());         $this->reset();    }     // ...}

[#](#manually-controlling-validation-errors "Permalink")Manually controlling validation errors
----------------------------------------------------------------------------------------------

Livewire's validation utilities should handle the most common validation scenarios; however, there are times when you may want full control over the validation messages in your component.

Below are all the available methods for manipulating the validation errors in your Livewire component:

Method

Description

`$this->addError([key], [message])`

Manually add a validation message to the error bag

`$this->resetValidation([?key])`

Reset the validation errors for the provided key, or reset all errors if no key is supplied

`$this->getErrorBag()`

Retrieve the underlying Laravel error bag used in the Livewire component

Using`$this->addError()` with Form Objects

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

When manually adding errors using `$this->addError` inside of a form object the key will automatically be prefixed with the name of the property the form is assigned to in the parent component. For example, if in your Component you assign the form to a property called `$data`, key will become `data.key`.

[#](#accessing-the-validator-instance "Permalink")Accessing the validator instance
----------------------------------------------------------------------------------

Sometimes you may want to access the Validator instance that Livewire uses internally in the `validate()` method. This is possible using the `withValidator` method. The closure you provide receives the fully constructed validator as an argument, allowing you to call any of its methods before the validation rules are actually evaluated.

Below is an example of intercepting Livewire's internal validator to manually check a condition and add an additional validation message:

    use Livewire\Attributes\Validate;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    #[Validate('required|min:3')]    public $title = '';     #[Validate('required|min:3')]    public $content = '';     public function boot()    {        $this->withValidator(function ($validator) {            $validator->after(function ($validator) {                if (str($this->title)->startsWith('"')) {                    $validator->errors()->add('title', 'Titles cannot start with quotations');                }            });        });    }     public function save()    {        Post::create($this->all());         return redirect()->to('/posts');    }     // ...}

[#](#using-custom-validators "Permalink")Using custom validators
----------------------------------------------------------------

If you wish to use your own validation system in Livewire, that isn't a problem. Livewire will catch any `ValidationException` exceptions thrown inside of components and provide the errors to the view just as if you were using Livewire's own `validate()` method.

Below is an example of the `CreatePost` component, but instead of using Livewire's validation features, a completely custom validator is being created and applied to the component properties:

    use Illuminate\Support\Facades\Validator;use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        $validated = Validator::make(            // Data to validate...            ['title' => $this->title, 'content' => $this->content],             // Validation rules to apply...            ['title' => 'required|min:3', 'content' => 'required|min:3'],             // Custom validation messages...            ['required' => 'The :attribute field is required'],         )->validate();         Post::create($validated);         return redirect()->to('/posts');    }     // ...}

[#](#testing-validation "Permalink")Testing validation
------------------------------------------------------

Livewire provides useful testing utilities for validation scenarios, such as the `assertHasErrors()` method.

Below is a basic test case that ensures validation errors are thrown if no input is set for the `title` property:

    <?php namespace Tests\Feature\Livewire; use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase; class CreatePostTest extends TestCase{    /** @test */    public function cant_create_post_without_title()    {        Livewire::test(CreatePost::class)            ->set('content', 'Sample content...')            ->call('save')            ->assertHasErrors('title');    }}

In addition to testing the presence of errors, `assertHasErrors` allows you to also narrow down the assertion to specific rules by passing the rules to assert against as the second argument to the method:

    /** @test */public function cant_create_post_with_title_shorter_than_3_characters(){    Livewire::test(CreatePost::class)        ->set('title', 'Sa')        ->set('content', 'Sample content...')        ->call('save')        ->assertHasErrors(['title' => ['min:3']]);}

You can also assert the presence of validation errors for multiple properties at the same time:

    /** @test */public function cant_create_post_without_title_and_content(){    Livewire::test(CreatePost::class)        ->call('save')        ->assertHasErrors(['title', 'content']);}

For more information on other testing utilities provided by Livewire, check out the [testing documentation](/docs/testing).

[#](#deprecated-rule-attribute "Permalink")Deprecated `[#Rule]` attribute
-------------------------------------------------------------------------

When Livewire v3 first launched, it used the term "Rule" instead of "Validate" for it's validation attributes (`#[Rule]`).

Because of naming conflicts with Laravel rule objects, this has since been changed to `#[Validate]`. Both are supported in Livewire v3, however it is recommended that you change all occurrences of `#[Rule]` with `#[Validate]` to stay current.

---

## Volt

Volt
====

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Get comfortable with Livewire first

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Before using Volt, we recommend getting familiar with standard, class-based Livewire usage. This will allow you to quickly transfer your knowledge of Livewire into writing components using Volt's functional API.

Volt is an elegantly crafted functional API for Livewire that supports single-file components, allowing a component's PHP logic and Blade templates to coexist in the same file. Behind the scenes, the functional API is compiled to Livewire class components and linked with the template present in the same file.

A simple Volt component looks like the following:

    <?php use function Livewire\Volt\{state}; state(['count' => 0]); $increment = fn () => $this->count++; ?> <div>    <h1>{{ $count }}</h1>    <button wire:click="increment">+</button></div>

[#](#installation "Permalink")Installation
------------------------------------------

To get started, install Volt into your project using the Composer package manager:

    composer require livewire/volt

After installing Volt, you may execute the `volt:install` Artisan command, which will install Volt's service provider file into your application. This service provider specifies the mounted directories in which Volt will search for single file components:

    php artisan volt:install

[#](#creating-components "Permalink")Creating components
--------------------------------------------------------

You may create a Volt component by placing a file with the `.blade.php` extension in any of your Volt mounted directories. By default, the `VoltServiceProvider` mounts the `resources/views/livewire` and `resources/views/pages` directories, but you may customize these directories in your Volt service provider's `boot` method.

For convenience, you may use the `make:volt` Artisan command to create a new Volt component:

    php artisan make:volt counter

By adding the `--test` directive when generating a component, a corresponding test file will also be generated. If you want the associated test to use [Pest](https://pestphp.com/), you should use the `--pest` flag:

    php artisan make:volt counter --test --pest

By adding the `--class` directive it will generate a class-based volt component.

    php artisan make:volt counter --class

[#](#api-style "Permalink")API style
------------------------------------

By utilizing Volt's functional API, we can define a Livewire component's logic through imported `Livewire\Volt` functions. Volt then transforms and compiles the functional code into a conventional Livewire class, enabling us to leverage the extensive capabilities of Livewire with reduced boilerplate.

Volt's API automatically binds any closure it uses to the underlying component. So, at any time, actions, computed properties, or listeners can refer to the component using the `$this` variable:

    use function Livewire\Volt\{state}; state(['count' => 0]); $increment = fn () => $this->count++; // ...

### [#](#class-based-volt-components "Permalink")Class-based Volt components

If you would like to enjoy the single-file component capabilities of Volt while still writing class-based components, we've got you covered. To get started, define an anonymous class that extends `Livewire\Volt\Component`. Within the class, you may utilize all of the features of Livewire using traditional Livewire syntax:

    <?php use Livewire\Volt\Component; new class extends Component {    public $count = 0;     public function increment()    {        $this->count++;    }} ?> <div>    <h1>{{ $count }}</h1>    <button wire:click="increment">+</button></div>

#### [#](#class-attributes "Permalink")Class attributes

Just like typical Livewire components, Volt components support class attributes. When utilizing anonymous PHP classes, class attributes should be defined after the `new` keyword:

    <?php use Livewire\Attributes\{Layout, Title};use Livewire\Volt\Component; new#[Layout('layouts.guest')]#[Title('Login')]class extends Component{    public string $name = '';     // ...

#### [#](#providing-additional-view-data "Permalink")Providing additional view data

When using class-based Volt components, the rendered view is the template present in the same file. If you need to pass additional data to the view each time it is rendered, you may use the `with` method. This data will be passed to the view in addition to the component's public properties:

    <?php use Livewire\WithPagination;use Livewire\Volt\Component;use App\Models\Post; new class extends Component {    use WithPagination;     public function with(): array    {        return [            'posts' => Post::paginate(10),        ];    }} ?> <div>    <!-- ... --></div>

#### [#](#modifying-the-view-instance "Permalink")Modifying the view instance

Sometimes, you may wish to interact with the view instance directly, for example, to set the view's title using a translated string. To achieve this, you may define a `rendering` method on your component:

    <?php use Illuminate\View\View;use Livewire\Volt\Component; new class extends Component {    public function rendering(View $view): void    {        $view->title('Create Post');         // ...    }     // ...

[#](#rendering-and-mounting-components "Permalink")Rendering and mounting components
------------------------------------------------------------------------------------

Just like a typical Livewire component, Volt components may be rendered using Livewire's tag syntax or the `@livewire` Blade directive:

    <livewire:user-index :users="$users" />

To declare the component's accepted properties, you may use the `state` function:

    use function Livewire\Volt\{state}; state('users'); // ...

If necessary, you can intercept the properties passed to the component by providing a closure to the `state` function, allowing you to interact with and modify the given value:

    use function Livewire\Volt\{state}; state(['count' => fn ($users) => count($users)]);

The `mount` function may be used to define the "mount" [lifecycle hook](/docs/lifecycle-hooks) of the Livewire component. The parameters provided to the component will be injected into this method. Any other parameters required by the mount hook will be resolved by Laravel's service container:

    use App\Services\UserCounter;use function Livewire\Volt\{mount}; mount(function (UserCounter $counter, $users) {    $counter->store('userCount', count($users));     // ...});

### [#](#full-page-components "Permalink")Full-page components

Optionally, you may render a Volt component as a full page component by defining a Volt route in your application's `routes/web.php` file:

    use Livewire\Volt\Volt; Volt::route('/users', 'user-index');

By default, the component will be rendered using the `components.layouts.app` layout. You may customize this layout file using the `layout` function:

    use function Livewire\Volt\{layout, state}; state('users'); layout('components.layouts.admin'); // ...

You may also customize the title of the page using the `title` function:

    use function Livewire\Volt\{layout, state, title}; state('users'); layout('components.layouts.admin'); title('Users'); // ...

If the title relies on component state or an external dependency, you may pass a closure to the `title` function instead:

    use function Livewire\Volt\{layout, state, title}; state('users'); layout('components.layouts.admin'); title(fn () => 'Users: ' . $this->users->count());

[#](#properties "Permalink")Properties
--------------------------------------

Volt properties, like Livewire properties, are conveniently accessible in the view and persist between Livewire updates. You can define a property using the `state` function:

    <?php use function Livewire\Volt\{state}; state(['count' => 0]); ?> <div>    {{ $count }}</div>

If the initial value of a state property relies on outside dependencies, such as database queries, models, or container services, its resolution should be encapsulated within a closure. This prevents the value from being resolved until it is absolutely necessary:

    use App\Models\User;use function Livewire\Volt\{state}; state(['count' => fn () => User::count()]);

If the initial value of a state property is being injected via [Laravel Folio's](https://github.com/laravel/folio) route model binding, it should also be encapsulated within a closure:

    use App\Models\User;use function Livewire\Volt\{state}; state(['user' => fn () => $user]);

Of course, properties may also be declared without explicitly specifying their initial value. In such cases, their initial value will be `null` or will be set based on the properties passed into the component when it is rendered:

    use function Livewire\Volt\{mount, state}; state(['count']); mount(function ($users) {    $this->count = count($users);     //});

### [#](#locked-properties "Permalink")Locked properties

Livewire offers the ability to safeguard properties by enabling you to "lock" them, thereby preventing any modifications from occurring on the client-side. To achieve this using Volt, simply chain the `locked` method on the state you wish to protect:

    state(['id'])->locked();

### [#](#reactive-properties "Permalink")Reactive properties

When working with nested components, you may find yourself in a situation where you need to pass a property from a parent component to a child component, and have the child component [automatically update](/docs/nesting#reactive-props) when the parent component updates the property.

To achieve this using Volt, you may chain the `reactive` method on the state you wish to be reactive:

    state(['todos'])->reactive();

### [#](#modelable-properties "Permalink")Modelable properties

In cases where you don't want to make use of reactive properties, Livewire provides a [modelable feature](/docs/nesting#binding-to-child-data-using-wiremodel) where you may share state between parent component and child component using `wire:model` directly on a child component.

To achieve this using Volt, simply chain the `modelable` method on the state you wish to be modelable:

    state(['form'])->modelable();

### [#](#computed-properties "Permalink")Computed properties

Livewire also allows you to define [computed properties](/docs/computed-properties), which can be useful for lazily fetching information needed by your component. Computed property results are "memoized", or cached in memory, for an individual Livewire request lifecycle.

To define a computed property, you may use the `computed` function. The name of the variable will determine the name of the computed property:

    <?php use App\Models\User;use function Livewire\Volt\{computed}; $count = computed(function () {    return User::count();}); ?> <div>    {{ $this->count }}</div>

You may persist the computed property's value in your application's cache by chaining the `persist` method onto the computed property definition:

    $count = computed(function () {    return User::count();})->persist();

By default, Livewire caches the computed property's value for 3600 seconds. You may customize this value by providing the desired number of seconds to the `persist` method:

    $count = computed(function () {    return User::count();})->persist(seconds: 10);

[#](#actions "Permalink")Actions
--------------------------------

Livewire [actions](/docs/actions) provide a convenient way to listen to page interactions and invoke a corresponding method on your component, resulting in the re-rendering of the component. Often, actions are invoked in response to the user clicking a button.

To define a Livewire action using Volt, you simply need to define a closure. The name of the variable containing the closure will determine the name of the action:

    <?php use function Livewire\Volt\{state}; state(['count' => 0]); $increment = fn () => $this->count++; ?> <div>    <h1>{{ $count }}</h1>    <button wire:click="increment">+</button></div>

Within the closure, the `$this` variable is bound to the underlying Livewire component, giving you the ability to access other methods on the component just as you would in a typical Livewire component:

    use function Livewire\Volt\{state}; state(['count' => 0]); $increment = function () {    $this->dispatch('count-updated');     //};

Your action may also receive arguments or dependencies from Laravel's service container:

    use App\Repositories\PostRepository;use function Livewire\Volt\{state}; state(['postId']); $delete = function (PostRepository $posts) {    $posts->delete($this->postId);     // ...};

### [#](#renderless-actions "Permalink")Renderless actions

In some cases, your component might declare an action that does not perform any operations that would cause the component's rendered Blade template to change. If that's the case, you can [skip the rendering phase](/docs/actions#skipping-re-renders) of Livewire's lifecycle by encapsulating the action within the `action` function and chaining the `renderless` method onto its definition:

    use function Livewire\Volt\{action}; $incrementViewCount = action(fn () => $this->viewCount++)->renderless();

### [#](#protected-helpers "Permalink")Protected helpers

By default, all Volt actions are "public" and may be invoked by the client. If you wish to create a function that is [only accessible from within your actions](/docs/actions#keep-dangerous-methods-protected-or-private), you may use the `protect` function:

    use App\Repositories\PostRepository;use function Livewire\Volt\{protect, state}; state(['postId']); $delete = function (PostRepository $posts) {    $this->ensurePostCanBeDeleted();     $posts->delete($this->postId);     // ...}; $ensurePostCanBeDeleted = protect(function () {    // ...});

[#](#forms "Permalink")Forms
----------------------------

Livewire's [forms](/docs/forms) provide a convenient way to deal with form validation and submission within a single class. To use a Livewire form within a Volt component, you may utilize the `form` function:

    <?php use App\Livewire\Forms\PostForm;use function Livewire\Volt\{form}; form(PostForm::class); $save = function () {    $this->form->store();     // ...}; ?> <form wire:submit="save">    <input type="text" wire:model="form.title">    @error('form.title') <span class="error">{{ $message }}</span> @enderror     <button type="submit">Save</button></form>

As you can see, the `form` function accepts the name of a Livewire form class. Once defined, the form can be accessed via the `$this->form` property within your component.

If you want to use a different property name for your form, you can pass the name as the second argument to the `form` function:

    form(PostForm::class, 'postForm'); $save = function () {    $this->postForm->store();     // ...};

[#](#listeners "Permalink")Listeners
------------------------------------

Livewire's global [event system](/docs/events) enables communication between components. If two Livewire components exist on a page, they can communicate by utilizing events and listeners. When using Volt, listeners can be defined using the `on` function:

    use function Livewire\Volt\{on}; on(['eventName' => function () {    //}]);

If you need to assign dynamic names to event listeners, such as those based on the authenticated user or data passed to the component, you can pass a closure to the `on` function. This closure can receive any component parameter, as well as additional dependencies which will be resolved via Laravel's service container:

    on(fn ($post) => [    'event-'.$post->id => function () {        //    }),]);

For convenience, component data may also be referenced when defining listeners using "dot" notation:

    on(['event-{post.id}' => function () {    //}]);

[#](#lifecycle-hooks "Permalink")Lifecycle hooks
------------------------------------------------

Livewire has a variety of [lifecycle hooks](/docs/lifecycle-hooks) that may be used to execute code at various points in a component's lifecycle. Using Volt's convenient API, you can define these lifecycle hooks using their corresponding functions:

    use function Livewire\Volt\{boot, booted, ...}; boot(fn () => /* ... */);booted(fn () => /* ... */);mount(fn () => /* ... */);hydrate(fn () => /* ... */);hydrate(['count' => fn () => /* ... */]);dehydrate(fn () => /* ... */);dehydrate(['count' => fn () => /* ... */]);updating(['count' => fn () => /* ... */]);updated(['count' => fn () => /* ... */]);

[#](#lazy-loading-placeholders "Permalink")Lazy loading placeholders
--------------------------------------------------------------------

When rendering Livewire components, you may pass the `lazy` parameter to a Livewire component to [defer its loading](/docs/lazy) until the initial page is fully loaded. By default, Livewire inserts `<div></div>` tags into the DOM where the component will be loaded.

If you would like to customize the HTML that is displayed within the component's placeholder while the initial page is loaded, you may use the `placeholder` function:

    use function Livewire\Volt\{placeholder}; placeholder('<div>Loading...</div>');

[#](#validation "Permalink")Validation
--------------------------------------

Livewire offers easy access to Laravel's powerful [validation features](/docs/validation). Using Volt's API, you may define your component's validation rules using the `rules` function. Like traditional Livewire components, these rules will be applied to your component data when you invoke the `validate` method:

    <?php use function Livewire\Volt\{rules}; rules(['name' => 'required|min:6', 'email' => 'required|email']); $submit = function () {    $this->validate();     // ...}; ?> <form wire:submit.prevent="submit">    //</form>

If you need to define rules dynamically, such as rules based on the authenticated user or a information from your database, you can provide a closure to the `rules` function:

    rules(fn () => [    'name' => ['required', 'min:6'],    'email' => ['required', 'email', 'not_in:'.Auth::user()->email]]);

### [#](#error-messages-and-attributes "Permalink")Error messages and attributes

To modify the validation messages or attributes used during validation, you can chain the `messages` and `attributes` methods onto your `rules` definition:

    use function Livewire\Volt\{rules}; rules(['name' => 'required|min:6', 'email' => 'required|email'])    ->messages([        'email.required' => 'The :attribute may not be empty.',        'email.email' => 'The :attribute format is invalid.',    ])->attributes([        'email' => 'email address',    ]);

[#](#file-uploads "Permalink")File uploads
------------------------------------------

When using Volt, [uploading and storing files](/docs/uploads) is much easier thanks to Livewire. To include the `Livewire\WithFileUploads` trait on your functional Volt component, you may use the `usesFileUploads` function:

    use function Livewire\Volt\{state, usesFileUploads}; usesFileUploads(); state(['photo']); $save = function () {    $this->validate([        'photo' => 'image|max:1024',    ]);     $this->photo->store('photos');};

[#](#url-query-parameters "Permalink")URL query parameters
----------------------------------------------------------

Sometimes it's useful to [update the browser's URL query parameters](/docs/url) when your component state changes. In these cases, you can use the `url` method to instruct Livewire to sync the URL query parameters with a piece of component state:

    <?php use App\Models\Post;use function Livewire\Volt\{computed, state}; state(['search'])->url(); $posts = computed(function () {    return Post::where('title', 'like', '%'.$this->search.'%')->get();}); ?> <div>    <input wire:model.live="search" type="search" placeholder="Search posts by title...">     <h1>Search Results:</h1>     <ul>        @foreach($this->posts as $post)            <li wire:key="{{ $post->id }}">{{ $post->title }}</li>        @endforeach    </ul></div>

Additional URL query parameters options supported by Livewire, such as URL query parameters aliases, may also be provided to the `url` method:

    use App\Models\Post;use function Livewire\Volt\{state}; state(['page' => 1])->url(as: 'p', history: true, keep: true); // ...

[#](#pagination "Permalink")Pagination
--------------------------------------

Livewire and Volt also have complete support for [pagination](/docs/pagination). To include Livewire's `Livewire\WithPagination` trait on your functional Volt component, you may use the `usesPagination` function:

    <?php use function Livewire\Volt\{with, usesPagination}; usesPagination(); with(fn () => ['posts' => Post::paginate(10)]); ?> <div>    @foreach ($posts as $post)        //    @endforeach     {{ $posts->links() }}</div>

Like Laravel, Livewire's default pagination view uses Tailwind classes for styling. If you use Bootstrap in your application, you can enable the Bootstrap pagination theme by specifying your desired theme when invoking the `usesPagination` function:

    usesPagination(theme: 'bootstrap');

[#](#custom-traits-and-interfaces "Permalink")Custom traits and interfaces
--------------------------------------------------------------------------

To include any arbitrary trait or interface on your functional Volt component, you may use the `uses` function:

    use function Livewire\Volt\{uses}; use App\Contracts\Sorting;use App\Concerns\WithSorting; uses([Sorting::class, WithSorting::class]);

[#](#anonymous-components "Permalink")Anonymous components
----------------------------------------------------------

Sometimes, you may want to convert a small portion of a page into a Volt component without extracting it into a separate file. For example, imagine a Laravel route that returns the following view:

    Route::get('/counter', fn () => view('pages/counter.blade.php'));

The view's content is a typical Blade template, including layout definitions and slots. However, by wrapping a portion of the view within the `@volt` Blade directive, we can convert that piece of the view into a fully-functional Volt component:

    <?php use function Livewire\Volt\{state}; state(['count' => 0]); $increment = fn () => $this->count++; ?> <x-app-layout>    <x-slot name="header">        Counter    </x-slot>     @volt('counter')        <div>            <h1>{{ $count }}</h1>            <button wire:click="increment">+</button>        </div>    @endvolt</x-app-layout>

#### [#](#passing-data-to-anonymous-components "Permalink")Passing data to anonymous components

When rendering a view that contains an anonymous component, all of the data given to the view will also be available to the anonymous Volt component:

    use App\Models\User; Route::get('/counter', fn () => view('users.counter', [    'count' => User::count(),]));

Of course, you may declare this data as "state" on your Volt component. When initializing state from data proxied to the component by the view, you only need to declare the name of the state variable. Volt will automatically hydrate the state's default value using the proxied view data:

    <?php use function Livewire\Volt\{state}; state('count'); $increment = function () {    // Store the new count value in the database...     $this->count++;}; ?> <x-app-layout>    <x-slot name="header">        Initial value: {{ $count }}    </x-slot>     @volt('counter')        <div>            <h1>{{ $count }}</h1>            <button wire:click="increment">+</button>        </div>    @endvolt</x-app-layout>

[#](#testing-components "Permalink")Testing components
------------------------------------------------------

To begin testing a Volt component, you may invoke the `Volt::test` method, providing the name of the component:

    use Livewire\Volt\Volt; it('increments the counter', function () {    Volt::test('counter')        ->assertSee('0')        ->call('increment')        ->assertSee('1');});

When testing a Volt component, you may utilize all of the methods provided by the standard [Livewire testing API](/docs/testing).

If your Volt component is nested, you may use "dot" notation to specify the component that you wish to test:

    Volt::test('users.stats')

When testing a page that contains an anonymous Volt component, you may use the `assertSeeVolt` method to assert that the component is rendered:

    $this->get('/users')    ->assertSeeVolt('stats');

---

## Wire Click

wire:click
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire provides a simple `wire:click` directive for calling component methods (aka actions) when a user clicks a specific element on the page.

For example, given the `ShowInvoice` component below:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Invoice; class ShowInvoice extends Component{    public Invoice $invoice;     public function download()    {        return response()->download(            $this->invoice->file_path, 'invoice.pdf'        );    }}

You can trigger the `download()` method from the class above when a user clicks a "Download Invoice" button by adding `wire:click="download"`:

    <button type="button" wire:click="download">     Download Invoice</button>

[#](#using-wireclick-on-links "Permalink")Using `wire:click` on links
---------------------------------------------------------------------

When using `wire:click` on `<a>` tags, you must append `.prevent` to prevent the default handling of a link in the browser. Otherwise, the browser will visit the provided link and update the page's URL.

    <a href="#" wire:click.prevent="...">

[#](#going-deeper "Permalink")Going deeper
------------------------------------------

The `wire:click` directive is just one of many different available event listeners in Livewire. For full documentation on its (and other event listeners) capabilities, visit [the Livewire actions documentation page](/docs/actions).

---

## Wire Cloak

wire:cloak
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

`wire:cloak` is a directive that hides elements on page load until Livewire is fully initialized. This is useful for preventing the "flash of unstyled content" that can occur when the page loads before Livewire has a chance to initialize.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

To use `wire:cloak`, add the directive to any element you want to hide during page load:

    <div wire:cloak>    This content will be hidden until Livewire is fully loaded</div>

### [#](#dynamic-content "Permalink")Dynamic content

`wire:cloak` is particularly useful in scenarios where you want to prevent users from seeing uninitialized dynamic content such as element shown or hidden using `wire:show`.

    <div>    <div wire:show="starred" wire:cloak>        <!-- Yellow star icon... -->    </div>     <div wire:show="!starred" wire:cloak>        <!-- Gray star icon... -->    </div></div>

In the above example, without `wire:cloak`, both icons would be shown before Livewire initializes. However, with `wire:cloak`, both elements will be hidden until initialization.

---

## Wire Confirm

wire:confirm
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Before performing dangerous actions in Livewire, you may want to provide your users with some sort of visual confirmation.

Livewire makes this easy to do by adding `wire:confirm` in addition to any action (`wire:click`, `wire:submit`, etc.).

Here's an example of adding a confirmation dialog to a "Delete post" button:

    <button    type="button"    wire:click="delete"    wire:confirm="Are you sure you want to delete this post?">    Delete post </button>

When a user clicks "Delete post", Livewire will trigger a confirmation dialog (The default browser confirmation alert). If the user hits escape or presses cancel, the action won't be performed. If they press "OK", the action will be completed.

[#](#prompting-users-for-input "Permalink")Prompting users for input
--------------------------------------------------------------------

For even more dangerous actions such as deleting a user's account entirely, you may want to present them with a confirmation prompt which they would need to type in a specific string of characters to confirm the action.

Livewire provides a helpful `.prompt` modifier, that when applied to `wire:confirm`, it will prompt the user for input and only confirm the action if the input matches (case-sensitive) the provided string (designated by a "|" (pipe) character at the end if the `wire:confirm` value):

    <button    type="button"    wire:click="delete"    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">    Delete account </button>

When a user presses "Delete account", the action will only be performed if "DELETE" is entered into the prompt, otherwise, the action will be cancelled.

---

## Wire Current

wire:current
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

The `wire:current` directive allows you to easily detect and style currently active links on a page.

Here's a simple example of adding `wire:current` to links in a navbar so that the currently active link has a stronger font weight:

    <nav>    <a href="/dashboard" ... wire:current="font-bold text-zinc-800">Dashboard</a>    <a href="/posts" ... wire:current="font-bold text-zinc-800">Posts</a>    <a href="/users" ... wire:current="font-bold text-zinc-800">Users</a></nav>

Now when a user visits `/posts`, the "Posts" link will have a stronger font treatment than the other links.

You should note that `wire:current` works out of the box with `wire:navigate` links and page changes.

[#](#exact-matching "Permalink")Exact matching
----------------------------------------------

By default, `wire:current` uses a partial matching strategy, meaning it will be applied if the link and current page share the beginning portion of the Url's path.

For example, if the link is `/posts`, and the current page is `/posts/1`, the `wire:current` directive will be applied.

If you wish to use exact matching, you can add the `.exact` modifier to the directive.

Here's an example where you might want to use exact matching to prevent the "Dashboard" link from being highlighted when the user visits `/posts`:

    <nav>    <a href="/" wire:current.exact="font-bold">Dashboard</a></nav>

[#](#strict-matching "Permalink")Strict matching
------------------------------------------------

By default, `wire:current` will remove trailing slashes (`/`) from its comparison.

If you'd like to disable this behavior and force a stract path string comparison, you can append the `.strict` modifier:

    <nav>    <a href="/posts/" wire:current.strict="font-bold">Dashboard</a></nav>

[#](#troubleshooting "Permalink")Troubleshooting
------------------------------------------------

If `wire:current` is not detecting the current link correctly, ensure the following:

*   You have at least one Livewire component on the page, or have hardcoded `@livewireScripts` in your layout
*   You have a `href` attribute on the link.

---

## Wire Dirty

wire:dirty
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

In a traditional HTML page containing a form, the form is only ever submitted when the user presses the "Submit" button.

However, Livewire is capable of much more than traditional form submissions. You can validate form inputs in real-time or even save the form as a user types.

In these "real-time" update scenarios, it can be helpful to signal to your users when a form or subset of a form has been changed, but hasn't been saved to the database.

When a form contains un-saved input, that form is considered "dirty". It only becomes "clean" when a network request has been triggered to synchronize the server state with the client-side state.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Livewire allows you to easily toggle visual elements on the page using the `wire:dirty` directive.

By adding `wire:dirty` to an element, you are instructing Livewire to only show the element when the client-side state diverges from the server-side state.

To demonstrate, here is an example of an `UpdatePost` form containing a visual "Unsaved changes..." indication that signals to the user that the form contains input that has not been saved:

    <form wire:submit="update">    <input type="text" wire:model="title">     <!-- ... -->     <button type="submit">Update</button>     <div wire:dirty>Unsaved changes...</div> </form>

Because `wire:dirty` has been added to the "Unsaved changes..." message, the message will be hidden by default. Livewire will automatically display the message when the user starts modifying the form inputs.

When the user submits the form, the message will disappear again, since the server / client data is back in sync.

### [#](#removing-elements "Permalink")Removing elements

By adding the `.remove` modifier to `wire:dirty`, you can instead show an element by default and only hide it when the component has "dirty" state:

    <div wire:dirty.remove>The data is in-sync...</div>

[#](#targeting-property-updates "Permalink")Targeting property updates
----------------------------------------------------------------------

Imagine you are using `wire:model.blur` to update a property on the server immediately after a user leaves an input field. In this scenario, you can provide a "dirty" indication for only that property by adding `wire:target` to the element that contains the `wire:dirty` directive.

Here is an example of only showing a dirty indication when the title property has been changed:

    <form wire:submit="update">    <input wire:model.blur="title">     <div wire:dirty wire:target="title">Unsaved title...</div>      <button type="submit">Update</button></form>

[#](#toggling-classes "Permalink")Toggling classes
--------------------------------------------------

Often, instead of toggling entire elements, you may want to toggle individual CSS classes on an input when its state is "dirty".

Below is an example where a user types into an input field and the border becomes yellow, indicating an "unsaved" state. Then, when the user tabs away from the field, the border is removed, indicating that the state has been saved on the server:

    <input wire:model.blur="title" wire:dirty.class="border-yellow-500">

---

## Wire Ignore

wire:ignore
===========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire's ability to make updates to the page is what makes it "live", however, there are times when you might want to prevent Livewire from updating a portion of the page.

In these cases, you can use the `wire:ignore` directive to instruct Livewire to ignore the contents of a particular element, even if they change between requests.

This is most useful in the context of working with third-party javascript libraries for custom form inputs and such.

Below is an example of wrapping an element used by a third-party library in `wire:ignore` so that Livewire doesn't tamper with the HTML generated by the library:

    <form>    <!-- ... -->     <div wire:ignore>        <!-- This element would be reference by a -->        <!-- third-party library for initialization... -->        <input id="id-for-date-picker-library">    </div>     <!-- ... --></form>

You can also instruct Livewire to only ignore changes to attributes of the root element rather than observing changes to its contents using `wire:ignore.self`.

    <div wire:ignore.self>    <!-- ... --></div>

---

## Wire Init

wire:init
=========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire offers a `wire:init` directive to run an action as soon as the component is rendered. This can be helpful in cases where you don't want to hold up the entire page load, but want to load some data immediately after the page load.

    <div wire:init="loadPosts">    <!-- ... --></div>

The `loadPosts` action will be run immediately after the Livewire component renders on the page.

In most cases however, [Livewire's lazy loading feature](/docs/lazy) is preferable to using `wire:init`.

---

## Wire Loading

wire:loading
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Loading indicators are an important part of crafting good user interfaces. They give users visual feedback when a request is being made to the server, so they know they are waiting for a process to complete.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Livewire provides a simple yet extremely powerful syntax for controlling loading indicators: `wire:loading`. Adding `wire:loading` to any element will hide it by default (using `display: none` in CSS) and show it when a request is sent to the server.

Below is a basic example of a `CreatePost` component's form with `wire:loading` being used to toggle a loading message:

    <form wire:submit="save">    <!-- ... -->     <button type="submit">Save</button>     <div wire:loading>         Saving post...    </div></form>

When a user presses "Save", the "Saving post..." message will appear below the button while the "save" action is being executed. The message will disappear when the response is received from the server and processed by Livewire.

### [#](#removing-elements "Permalink")Removing elements

Alternatively, you can append `.remove` for the inverse effect, showing an element by default and hiding it during requests to the server:

    <div wire:loading.remove>...</div>

[#](#toggling-classes "Permalink")Toggling classes
--------------------------------------------------

In addition to toggling the visibility of entire elements, it's often useful to change the styling of an existing element by toggling CSS classes on and off during requests to the server. This technique can be used for things like changing background colors, lowering opacity, triggering spinning animations, and more.

Below is a simple example of using the [Tailwind](https://tailwindcss.com/) class `opacity-50` to make the "Save" button fainter while the form is being submitted:

    <button wire:loading.class="opacity-50">Save</button>

Like toggling an element, you can perform the inverse class operation by appending `.remove` to the `wire:loading` directive. In the example below, the button's `bg-blue-500` class will be removed when the "Save" button is pressed:

    <button class="bg-blue-500" wire:loading.class.remove="bg-blue-500">    Save</button>

[#](#toggling-attributes "Permalink")Toggling attributes
--------------------------------------------------------

By default, when a form is submitted, Livewire will automatically disable the submit button and add the `readonly` attribute to each input element while the form is being processed.

However, in addition to this default behavior, Livewire offers the `.attr` modifier to allow you to toggle other attributes on an element or toggle attributes on elements that are outside of forms:

    <button    type="button"    wire:click="remove"    wire:loading.attr="disabled">    Remove</button>

Because the button above isn't a submit button, it won't be disabled by Livewire's default form handling behavior when pressed. Instead, we manually added `wire:loading.attr="disabled"` to achieve this behavior.

[#](#targeting-specific-actions "Permalink")Targeting specific actions
----------------------------------------------------------------------

By default, `wire:loading` will be triggered whenever a component makes a request to the server.

However, in components with multiple elements that can trigger server requests, you should scope your loading indicators down to individual actions.

For example, consider the following "Save post" form. In addition to a "Save" button that submits the form, there might also be a "Remove" button that executes a "remove" action on the component.

By adding `wire:target` to the following `wire:loading` element, you can instruct Livewire to only show the loading message when the "Remove" button is clicked:

    <form wire:submit="save">    <!-- ... -->     <button type="submit">Save</button>     <button type="button" wire:click="remove">Remove</button>     <div wire:loading wire:target="remove">          Removing post...    </div></form>

When the above "Remove" button is pressed, the "Removing post..." message will be displayed to the user. However, the message will not be displayed when the "Save" button is pressed.

### [#](#targeting-multiple-actions "Permalink")Targeting multiple actions

You may find yourself in a situation where you would like `wire:loading` to react to some, but not all, actions on a page. In these cases you can pass multiple actions into `wire:target` separated by a comma. For example:

    <form wire:submit="save">    <input type="text" wire:model.blur="title">     <!-- ... -->     <button type="submit">Save</button>     <button type="button" wire:click="remove">Remove</button>     <div wire:loading wire:target="save, remove">          Updating post...    </div></form>

The loading indicator ("Updating post...") will now only be shown when the "Remove" or "Save" button are pressed, and not when the `$title` field is being sent to the server.

### [#](#targeting-action-parameters "Permalink")Targeting action parameters

In situations where the same action is triggered with different parameters from multiple places on a page, you can further scope `wire:target` to a specific action by passing in additional parameters. For example, consider the following scenario where a "Remove" button exists for each post on the page:

    <div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h2>{{ $post->title }}</h2>             <button wire:click="remove({{ $post->id }})">Remove</button>             <div wire:loading wire:target="remove({{ $post->id }})">                  Removing post...            </div>        </div>    @endforeach</div>

Without passing `{{ $post->id }}` to `wire:target="remove"`, the "Removing post..." message would show when any of the buttons on the page are clicked.

However, because we are passing in unique parameters to each instance of `wire:target`, Livewire will only show the loading message when the matching parameters are passed to the "remove" action.

Multiple action parameters aren't supported

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

At this time, Livewire only supports targeting a loading indicator by a single method/parameter pair. For example `wire:target="remove(1)"` is supported, however `wire:target="remove(1), add(1)"` is not.

### [#](#targeting-property-updates "Permalink")Targeting property updates

Livewire also allows you to target specific component property updates by passing the property's name to the `wire:target` directive.

Consider the following example where a form input named `username` uses `wire:model.live` for real-time validation as a user types:

    <form wire:submit="save">    <input type="text" wire:model.live="username">    @error('username') <span>{{ $message }}</span> @enderror     <div wire:loading wire:target="username">         Checking availability of username...    </div>     <!-- ... --></form>

The "Checking availability..." message will show when the server is updated with the new username as the user types into the input field.

### [#](#excluding-specific-loading-targets "Permalink")Excluding specific loading targets

Sometimes you may wish to display a loading indicator for every Livewire request _except_ a specific property or action. In these cases you can use the `wire:target.except` modifier like so:

    <div wire:loading wire:target.except="download">...</div>

The above loading indicator will now be shown for every Livewire update request on the component _except_ the "download" action.

[#](#customizing-css-display-property "Permalink")Customizing CSS display property
----------------------------------------------------------------------------------

When `wire:loading` is added to an element, Livewire updates the CSS `display` property of the element to show and hide the element. By default, Livewire uses `none` to hide and `inline-block` to show.

If you are toggling an element that uses a display value other than `inline-block`, like `flex` in the following example, you can append `.flex` to `wire:loading`:

    <div class="flex" wire:loading.flex>...</div>

Below is the complete list of available display values:

    <div wire:loading.inline-flex>...</div><div wire:loading.inline>...</div><div wire:loading.block>...</div><div wire:loading.table>...</div><div wire:loading.flex>...</div><div wire:loading.grid>...</div>

[#](#delaying-a-loading-indicator "Permalink")Delaying a loading indicator
--------------------------------------------------------------------------

On fast connections, updates often happen so quickly that loading indicators only flash briefly on the screen before being removed. In these cases, the indicator is more of a distraction than a helpful affordance.

For this reason, Livewire provides a `.delay` modifier to delay the showing of an indicator. For example, if you add `wire:loading.delay` to an element like so:

    <div wire:loading.delay>...</div>

The above element will only appear if the request takes over 200 milliseconds. The user will never see the indicator if the request completes before then.

To customize the amount of time to delay the loading indicator, you can use one of Livewire's helpful interval aliases:

    <div wire:loading.delay.shortest>...</div> <!-- 50ms --><div wire:loading.delay.shorter>...</div>  <!-- 100ms --><div wire:loading.delay.short>...</div>    <!-- 150ms --><div wire:loading.delay>...</div>          <!-- 200ms --><div wire:loading.delay.long>...</div>     <!-- 300ms --><div wire:loading.delay.longer>...</div>   <!-- 500ms --><div wire:loading.delay.longest>...</div>  <!-- 1000ms -->

---

## Wire Model

wire:model
==========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire makes it easy to bind a component property's value with form inputs using `wire:model`.

Here is a simple example of using `wire:model` to bind the `$title` and `$content` properties with form inputs in a "Create Post" component:

    use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        $post = Post::create([            'title' => $this->title            'content' => $this->content        ]);         // ...    }}

    <form wire:submit="save">    <label>        <span>Title</span>         <input type="text" wire:model="title">     </label>     <label>        <span>Content</span>         <textarea wire:model="content"></textarea>     </label>     <button type="submit">Save</button></form>

Because both inputs use `wire:model`, their values will be synchronized with the server's properties when the "Save" button is pressed.

"Why isn't my component live updating as I type?"

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

If you tried this in your browser and are confused why the title isn't automatically updating, it's because Livewire only updates a component when an "action" is submitted—like pressing a submit button—not when a user types into a field. This cuts down on network requests and improves performance. To enable "live" updating as a user types, you can use `wire:model.live` instead. [Learn more about data binding](/docs/properties#data-binding).

[#](#customizing-update-timing "Permalink")Customizing update timing
--------------------------------------------------------------------

By default, Livewire will only send a network request when an action is performed (like `wire:click` or `wire:submit`), NOT when a `wire:model` input is updated.

This drastically improves the performance of Livewire by reducing network requests and provides a smoother experience for your users.

However, there are occasions where you may want to update the server more frequently for things like real-time validation.

### [#](#live-updating "Permalink")Live updating

To send property updates to the server as a user types into an input-field, you can append the `.live` modifier to `wire:model`:

    <input type="text" wire:model.live="title">

#### [#](#customizing-the-debounce "Permalink")Customizing the debounce

By default, when using `wire:model.live`, Livewire adds a 150 millisecond debounce to server updates. This means if a user is continually typing, Livewire will wait until the user stops typing for 150 milliseconds before sending a request.

You can customize this timing by appending `.debounce.Xms` to the input. Here is an example of changing the debounce to 250 milliseconds:

    <input type="text" wire:model.live.debounce.250ms="title">

### [#](#updating-on-blur-event "Permalink")Updating on "blur" event

By appending the `.blur` modifier, Livewire will only send network requests with property updates when a user clicks away from an input, or presses the tab key to move to the next input.

Adding `.blur` is helpful for scenarios where you want to update the server more frequently, but not as a user types. For example, real-time validation is a common instance where `.blur` is helpful.

    <input type="text" wire:model.blur="title">

### [#](#updating-on-change-event "Permalink")Updating on "change" event

There are times when the behavior of `.blur` isn't exactly what you want and instead `.change` is.

For example, if you want to run validation every time a select input is changed, by adding `.change`, Livewire will send a network request and validate the property as soon as a user selects a new option. As opposed to `.blur` which will only update the server after the user tabs away from the select input.

    <select wire:model.change="title">    <!-- ... --></select>

Any changes made to the text input will be automatically synchronized with the `$title` property in your Livewire component.

[#](#all-available-modifiers "Permalink")All available modifiers
----------------------------------------------------------------

Modifier

Description

`.live`

Send updates as a user types

`.blur`

Only send updates on the `blur` event

`.change`

Only send updates on the the `change` event

`.lazy`

An alias for `.change`

`.debounce.[?]ms`

Debounce the sending of updates by the specified millisecond delay

`.throttle.[?]ms`

Throttle network request updates by the specified millisecond interval

`.number`

Cast the text value of an input to `int` on the server

`.boolean`

Cast the text value of an input to `bool` on the server

`.fill`

Use the initial value provided by a "value" HTML attribute on page-load

[#](#input-fields "Permalink")Input fields
------------------------------------------

Livewire supports most native input elements out of the box. Meaning you should just be able to attach `wire:model` to any input element in the browser and easily bind properties to them.

Here's a comprehensive list of the different available input types and how you use them in a Livewire context.

### [#](#text-inputs "Permalink")Text inputs

First and foremost, text inputs are the bedrock of most forms. Here's how to bind a property named "title" to one:

    <input type="text" wire:model="title">

### [#](#textarea-inputs "Permalink")Textarea inputs

Textarea elements are similarly straightforward. Simply add `wire:model` to a textarea and the value will be bound:

    <textarea type="text" wire:model="content"></textarea>

If the "content" value is initialized with a string, Livewire will fill the textarea with that value - there's no need to do something like the following:

    <!-- Warning: This snippet demonstrates what NOT to do... --> <textarea type="text" wire:model="content">{{ $content }}</textarea>

### [#](#checkboxes "Permalink")Checkboxes

Checkboxes can be used for single values, such as when toggling a boolean property. Or, checkboxes may be used to toggle a single value in a group of related values. We'll discuss both scenarios:

#### [#](#single-checkbox "Permalink")Single checkbox

At the end of a signup form, you might have a checkbox allowing the user to opt-in to email updates. You might call this property `$receiveUpdates`. You can easily bind this value to the checkbox using `wire:model`:

    <input type="checkbox" wire:model="receiveUpdates">

Now when the `$receiveUpdates` value is `false`, the checkbox will be unchecked. Of course, when the value is `true`, the checkbox will be checked.

#### [#](#multiple-checkboxes "Permalink")Multiple checkboxes

Now, let's say in addition to allowing the user to decide to receive updates, you have an array property in your class called `$updateTypes`, allowing the user to choose from a variety of update types:

    public $updateTypes = [];

By binding multiple checkboxes to the `$updateTypes` property, the user can select multiple update types and they will be added to the `$updateTypes` array property:

    <input type="checkbox" value="email" wire:model="updateTypes"><input type="checkbox" value="sms" wire:model="updateTypes"><input type="checkbox" value="notification" wire:model="updateTypes">

For example, if the user checks the first two boxes but not the third, the value of `$updateTypes` will be: `["email", "sms"]`

### [#](#radio-buttons "Permalink")Radio buttons

To toggle between two different values for a single property, you may use radio buttons:

    <input type="radio" value="yes" wire:model="receiveUpdates"><input type="radio" value="no" wire:model="receiveUpdates">

### [#](#select-dropdowns "Permalink")Select dropdowns

Livewire makes it simple to work with `<select>` dropdowns. When adding `wire:model` to a dropdown, the currently selected value will be bound to the provided property name and vice versa.

In addition, there's no need to manually add `selected` to the option that will be selected - Livewire handles that for you automatically.

Below is an example of a select dropdown filled with a static list of states:

    <select wire:model="state">    <option value="AL">Alabama</option>    <option value="AK">Alaska</option>    <option value="AZ">Arizona</option>    ...</select>

When a specific state is selected, for example, "Alaska", the `$state` property on the component will be set to `AK`. If you would prefer the value to be set to "Alaska" instead of "AK", you can leave the `value=""` attribute off the `<option>` element entirely.

Often, you may build your dropdown options dynamically using Blade:

    <select wire:model="state">    @foreach (\App\Models\State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select>

If you don't have a specific option selected by default, you may want to show a muted placeholder option by default, such as "Select a state":

    <select wire:model="state">    <option disabled value="">Select a state...</option>     @foreach (\App\Models\State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select>

As you can see, there is no "placeholder" attribute for a select menu like there is for text inputs. Instead, you have to add a `disabled` option element as the first option in the list.

### [#](#dependent-select-dropdowns "Permalink")Dependent select dropdowns

Sometimes you may want one select menu to be dependent on another. For example, a list of cities that changes based on which state is selected.

For the most part, this works as you'd expect, however there is one important gotcha: You must add a `wire:key` to the changing select so that Livewire properly refreshes its value when the options change.

Here's an example of two selects, one for states, one for cities. When the state select changes, the options in the city select will change properly:

    <!-- States select menu... --><select wire:model.live="selectedState">    @foreach (State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select> <!-- Cities dependent select menu... --><select wire:model.live="selectedCity" wire:key="{{ $selectedState }}">     @foreach (City::whereStateId($selectedState->id)->get() as $city)        <option value="{{ $city->id }}">{{ $city->label }}</option>    @endforeach</select>

Again, the only thing non-standard here is the `wire:key` that has been added to the second select. This ensures that when the state changes, the "selectedCity" value will be reset properly.

### [#](#multi-select-dropdowns "Permalink")Multi-select dropdowns

If you are using a "multiple" select menu, Livewire works as expected. In this example, states will be added to the `$states` array property when they are selected and removed if they are deselected:

    <select wire:model="states" multiple>    <option value="AL">Alabama</option>    <option value="AK">Alaska</option>    <option value="AZ">Arizona</option>    ...</select>

[#](#going-deeper "Permalink")Going deeper
------------------------------------------

For a more complete documentation on using `wire:model` in the context of HTML forms, visit the [Livewire forms documentation page](/docs/forms).

---

## Wire Navigate

wire:navigate
=============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire's `wire:navigate` feature makes page navigation much faster, providing an SPA-like experience for your users.

This page is a simple reference for the `wire:navigate` directive. Be sure to read the [page on Livewire's Navigate feature](/docs/navigate) for more complete documentation.

Below is a simple example of adding `wire:navigate` to links in a nav bar:

    <nav>    <a href="/" wire:navigate>Dashboard</a>    <a href="/posts" wire:navigate>Posts</a>    <a href="/users" wire:navigate>Users</a></nav>

When any of these links are clicked, Livewire will intercept the click and, instead of allowing the browser to perform a full page visit, Livewire will fetch the page in the background and swap it with the current page (resulting in much faster and smoother page navigation).

[#](#prefetching-pages-on-hover "Permalink")Prefetching pages on hover
----------------------------------------------------------------------

By adding the `.hover` modifier, Livewire will pre-fetch a page when a user hovers over a link. This way, the page will have already been downloaded from the server when the user clicks on the link.

    <a href="/" wire:navigate.hover>Dashboard</a>

[#](#going-deeper "Permalink")Going deeper
------------------------------------------

For more complete documentation on this feature, visit [Livewire's navigate documentation page](/docs/navigate).

---

## Wire Offline

wire:offline
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

In certain circumstances it can be helpful for your users to know if they are currently connected to the internet.

If for example, you have built a blogging platform on Livewire, you may want to notify your users in some way if they are offline so that they don't draft an entire blog post without the ability for Livewire to save it to the database.

Livewire make this trivial by providing the `wire:offline` directive. By attaching `wire:offline` to an element in your Livewire component, it will be hidden by default and only be displayed when Livewire detects the network connection has been interrupted and is unavailable. It will then disappear again when the network has regained connection.

For example:

    <p class="alert alert-warning" wire:offline>    Whoops, your device has lost connection. The web page you are viewing is offline.</p>

---

## Wire Poll

wire:poll
=========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Polling is a technique used in web applications to "poll" the server (send requests on a regular interval) for updates. It's a simple way to keep a page up-to-date without the need for a more sophisticated technology like [WebSockets](/docs/events#real-time-events-using-laravel-echo).

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Using polling inside Livewire is as simple as adding `wire:poll` to an element.

Below is an example of a `SubscriberCount` component that shows a user's subscriber count:

    <?php namespace App\Livewire; use Illuminate\Support\Facades\Auth;use Livewire\Component; class SubscriberCount extends Component{    public function render()    {        return view('livewire.subscriber-count', [            'count' => Auth::user()->subscribers->count(),        ]);    }}

    <div wire:poll>     Subscribers: {{ $count }}</div>

Normally, this component would show the subscriber count for the user and never update until the page was refreshed. However, because of `wire:poll` on the component's template, this component will now refresh itself every `2.5` seconds, keeping the subscriber count up-to-date.

You can also specify an action to fire on the polling interval by passing a value to `wire:poll`:

    <div wire:poll="refreshSubscribers">    Subscribers: {{ $count }}</div>

Now, the `refreshSubscribers()` method on the component will be called every `2.5` seconds.

[#](#timing-control "Permalink")Timing control
----------------------------------------------

The primary drawback of polling is that it can be resource intensive. If you have a thousand visitors on a page that uses polling, one thousand network requests will be triggered every `2.5` seconds.

The best way to reduce requests in this scenario is simply to make the polling interval longer.

You can manually control how often the component will poll by appending the desired duration to `wire:poll` like so:

    <div wire:poll.15s> <!-- In seconds... --> <div wire:poll.15000ms> <!-- In milliseconds... -->

[#](#background-throttling "Permalink")Background throttling
------------------------------------------------------------

To further cut down on server requests, Livewire automatically throttles polling when a page is in the background. For example, if a user keeps a page open in a different browser tab, Livewire will reduce the number of polling requests by 95% until the user revisits the tab.

If you want to opt-out of this behavior and keep polling continuously, even when a tab is in the background, you can add the `.keep-alive` modifier to `wire:poll`:

    <div wire:poll.keep-alive>

[#](#viewport-throttling "Permalink")Viewport throttling
--------------------------------------------------------

Another measure you can take to only poll when necessary, is to add the `.visible` modifier to `wire:poll`. The `.visible` modifier instructs Livewire to only poll the component when it is visible on the page:

    <div wire:poll.visible>

If a component using `wire:visible` is at the bottom of a long page, it won't start polling until the user scrolls it into the viewport. When the user scrolls away, it will stop polling again.

---

## Wire Replace

wire:replace
============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire's DOM diffing is useful for updating existing elements on your page, but occasionally you may need to force some elements to render from scratch to reset internal state.

In these cases, you can use the `wire:replace` directive to instruct Livewire to skip DOM diffing on the children of an element, and instead completely replace the content with the new elements from the server.

This is most useful in the context of working with third-party javascript libraries and custom web components, or when element re-use could cause problems when keeping state.

Below is an example of wrapping a web component with a shadow DOM `wire:replace` so that Livewire completely replaces the element allowing the custom element to handle its own life-cycle:

    <form>    <!-- ... -->     <div wire:replace>        <!-- This custom element would have its own internal state -->        <json-viewer>@json($someProperty)</json-viewer>    </div>     <!-- ... --></form>

You can also instruct Livewire to replace the target element as well as all children with `wire:replace.self`.

    <div x-data="{open: false}" wire:replace.self>  <!-- Ensure that the "open" state is reset to false on each render --></div>

---

## Wire Show

wire:show
=========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire's `wire:show` directive makes it easy to show and hide elements based on the result of an expression.

The `wire:show` directive is different than using `@if` in Blade in that it toggles an element's visibility using CSS (`display: none`) rather than removing the element from the DOM entirely. This means the element remains in the page but is hidden, allowing for smoother transitions without requiring a server round-trip.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Here's a practical example of using `wire:show` to toggle a "Create Post" modal:

    use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $showModal = false;     public $content = '';     public function save()    {        Post::create(['content' => $this->content]);         $this->reset('content');         $this->showModal = false;    }}

    <div>    <button x-on:click="$wire.showModal = true">New Post</button>     <div wire:show="showModal">        <form wire:submit="save">            <textarea wire:model="content"></textarea>             <button type="submit">Save Post</button>        </form>    </div></div>

When the "Create New Post" button is clicked, the modal appears without a server roundtrip. After successfully saving the post, the modal is hidden and the form is reset.

[#](#using-transitions "Permalink")Using transitions
----------------------------------------------------

You can combine `wire:show` with Alpine.js transitions to create smooth show/hide animations. Since `wire:show` only toggles the CSS `display` property, Alpine's `x-transition` directives work perfectly with it:

    <div>    <button x-on:click="$wire.showModal = true">New Post</button>     <div wire:show="showModal" x-transition.duration.500ms>        <form wire:submit="save">            <textarea wire:model="content"></textarea>            <button type="submit">Save Post</button>        </form>    </div></div>

The Alpine.js transition classes above will create a fade and scale effect when the modal shows and hides.

[View the full x-transition documentation →](https://alpinejs.dev/directives/transition)

---

## Wire Stream

wire:stream
===========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire allows you to stream content to a web page before a request is complete via the `wire:stream` API. This is an extremely useful feature for things like AI chat-bots which stream responses as they are generated.

Not compatible with Laravel Octane

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

Livewire currently does not support using `wire:stream` with Laravel Octane.

To demonstrate the most basic functionality of `wire:stream`, below is a simple CountDown component that when a button is pressed displays a count-down to the user from "3" to "0":

    use Livewire\Component; class CountDown extends Component{    public $start = 3;     public function begin()    {        while ($this->start >= 0) {            // Stream the current count to the browser...            $this->stream(                  to: 'count',                content: $this->start,                replace: true,            );             // Pause for 1 second between numbers...            sleep(1);             // Decrement the counter...            $this->start = $this->start - 1;        };    }     public function render()    {        return <<<'HTML'        <div>            <button wire:click="begin">Start count-down</button>             <h1>Count: <span wire:stream="count">{{ $start }}</span></h1>         </div>        HTML;    }}

Here's what's happening from the user's perspective when they press "Start count-down":

*   "Count: 3" is shown on the page
*   They press the "Start count-down" button
*   One second elapses and "Count: 2" is shown
*   This process continues until "Count: 0" is shown

All of the above happens while a single network request is out to the server.

Here's what's happening from the system's perspective when the button is pressed:

*   A request is sent to Livewire to call the `begin()` method
*   The `begin()` method is called and the `while` loop begins
*   `$this->stream()` is called and immediately starts a "streamed response" to the browser
*   The browser receives a streamed response with instructions to find the element in the component with `wire:stream="count"`, and replace its contents with the received payload ("3" in the case of the first streamed number)
*   The `sleep(1)` method causes the server to hang for one second
*   The `while` loop is repeated and the process of streaming a new number every second continues until the `while` condition is falsy
*   When `begin()` has finished running and all the counts have been streamed to the browser, Livewire finishes it's request lifecycle, rendering the component and sending the final response to the browser

[#](#streaming-chat-bot-responses "Permalink")Streaming chat-bot responses
--------------------------------------------------------------------------

A common use-case for `wire:stream` is streaming chat-bot responses as they are received from an API that supports streamed responses (like [OpenAI's ChatGPT](https://chat.openai.com/)).

Below is an example of using `wire:stream` to accomplish a ChatGPT-like interface:

    use Livewire\Component; class ChatBot extends Component{    public $prompt = '';     public $question = '';     public $answer = '';     function submitPrompt()    {        $this->question = $this->prompt;         $this->prompt = '';         $this->js('$wire.ask()');    }     function ask()    {        $this->answer = OpenAI::ask($this->question, function ($partial) {            $this->stream(to: 'answer', content: $partial);         });    }     public function render()    {        return <<<'HTML'        <div>            <section>                <div>ChatBot</div>                 @if ($question)                    <article>                        <hgroup>                            <h3>User</h3>                            <p>{{ $question }}</p>                        </hgroup>                         <hgroup>                            <h3>ChatBot</h3>                            <p wire:stream="answer">{{ $answer }}</p>                         </hgroup>                    </article>                @endif            </section>             <form wire:submit="submitPrompt">                <input wire:model="prompt" type="text" placeholder="Send a message" autofocus>            </form>        </div>        HTML;    }}

Here's what's going on in the above example:

*   A user types into a text field labeled "Send a message" to ask the chat-bot a question.
*   They press the \[Enter\] key.
*   A network request is sent to the server, sets the message to the `$question` property, and clears the `$prompt` property.
*   The response is sent back to the browser and the input is cleared. Because `$this->js('...')` was called, a new request is triggered to the server calling the `ask()` method.
*   The `ask()` method calls on the ChatBot API and receives streamed response partials via the `$partial` parameter in the callback.
*   Each `$partial` gets streamed to the browser into the `wire:stream="answer"` element on the page, showing the answer progressively reveal itself to the user.
*   When the entire response is received, the Livewire request finishes and the user receives the full response.

[#](#replace-vs-append "Permalink")Replace vs. append
-----------------------------------------------------

When streaming content to an element using `$this->stream()`, you can tell Livewire to either replace the contents of the target element with the streamed contents or append them to the existing contents.

Replacing or appending can both be desirable depending on the scenario. For example, when streaming a response from a chatbot, typically appending is desired (and is therefore the default). However, when showing something like a count-down, replacing is more fitting.

You can configure either by passing the `replace:` parameter to `$this->stream` with a boolean value:

    // Append contents...$this->stream(to: 'target', content: '...'); // Replace contents...$this->stream(to: 'target', content: '...', replace: true);

Append/replace can also be specified at the target element level by appending or removing the `.replace` modifier:

    // Append contents...<div wire:stream="target"> // Replace contents...<div wire:stream.replace="target">

---

## Wire Submit

wire:submit
===========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

Livewire makes it easy to handle form submissions via the `wire:submit` directive. By adding `wire:submit` to a `<form>` element, Livewire will intercept the form submission, prevent the default browser handling, and call any Livewire component method.

Here's a basic example of using `wire:submit` to handle a "Create Post" form submission:

    <?php namespace App\Livewire; use Livewire\Component;use App\Models\Post; class CreatePost extends Component{    public $title = '';     public $content = '';     public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);         $this->redirect('/posts');    }     public function render()    {        return view('livewire.create-post');    }}

    <form wire:submit="save">     <input type="text" wire:model="title">     <textarea wire:model="content"></textarea>     <button type="submit">Save</button></form>

In the above example, when a user submits the form by clicking "Save", `wire:submit` intercepts the `submit` event and calls the `save()` action on the server.

Livewire automatically calls`preventDefault()`

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

`wire:submit` is different than other Livewire event handlers in that it internally calls `event.preventDefault()` without the need for the `.prevent` modifier. This is because there are very few instances you would be listening for the `submit` event and NOT want to prevent it's default browser handling (performing a full form submission to an endpoint).

Livewire automatically disables forms while submitting

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

By default, when Livewire is sending a form submission to the server, it will disable form submit buttons and mark all form inputs as `readonly`. This way a user cannot submit the same form again until the initial submission is complete.

[#](#going-deeper "Permalink")Going deeper
------------------------------------------

`wire:submit` is just one of many event listeners that Livewire provides. The following two pages provide much more complete documentation on using `wire:submit` in your application:

*   [Responding to browser events with Livewire](/docs/actions)
*   [Creating forms in Livewire](/docs/forms)

---

## Wire Text

wire:text
=========

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

`wire:text` is a directive that dynamically updates an element's text content based on a component property or expression. Unlike using Blade's `{{ }}` syntax, `wire:text` updates the content without requiring a network roundtrip to re-render the component.

If you are familiar with Alpine's `x-text` directive, the two are essentially the same.

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Here's an example of using `wire:text` to optimistically show updates to a Livewire property without waiting for a network roundtrip.

    use Livewire\Component;use App\Models\Post; class ShowPost extends Component{    public Post $post;     public $likes;     public function mount()    {        $this->likes = $this->post->like_count;    }     public function like()    {        $this->post->like();         $this->likes = $this->post->fresh()->like_count;    }}

    <div>    <button x-on:click="$wire.likes++" wire:click="like">❤️ Like</button>     Likes: <span wire:text="likes"></span></div>

When the button is clicked, `$wire.likes++` immediately updates the displayed count through `wire:text`, while `wire:click="like"` persists the change to the database in the background.

This pattern makes `wire:text` perfect for building optimistic UIs in Livewire.

---

## Wire Transition

wire:transition
===============

Are you a visual learner?

Master Livewire with our in-depth screencasts

[

Watch now

](/screencasts)

[#](#basic-usage "Permalink")Basic usage
----------------------------------------

Showing or hiding content in Livewire is as simple as using one of Blade's conditional directives like `@if`. To enhance this experience for your users, Livewire provides a `wire:transition` directive that allows you to transition conditional elements smoothly in and out of the page.

For example, below is a `ShowPost` component with the ability to toggle viewing comments on and off:

    use App\Models\Post; class ShowPost extends Component{    public Post $post;     public $showComments = false;}

    <div>    <!-- ... -->     <button wire:click="$set('showComments', true)">Show comments</button>     @if ($showComments)        <div wire:transition>             @foreach ($post->comments as $comment)                <!-- ... -->            @endforeach        </div>    @endif</div>

Because `wire:transition` has been added to the `<div>` containing the post's comments, when the "Show comments" button is pressed, `$showComments` will be set to `true` and the comments will "fade" onto the page instead of abruptly appearing.

[#](#limitations "Permalink")Limitations
----------------------------------------

Currently, `wire:transition` is only supported on a single element inside a Blade conditional like `@if`. It will not work as expected when used in a list of sibling elements. For example, the following will NOT work properly:

    <!-- Warning: The following is code that will not work properly --><ul>    @foreach ($post->comments as $comment)        <li wire:transition wire:key="{{ $comment->id }}">{{ $comment->content }}</li>    @endforeach</ul>

If one of the above comment `<li>` elements were to get removed, you would expect Livewire to transition it out. However, because of hurdles with Livewire's underlying "morph" mechanism, this will not be the case. There is currently no way to transition dynamic lists in Livewire using `wire:transition`.

[#](#default-transition-style "Permalink")Default transition style
------------------------------------------------------------------

By default, Livewire applies both an opacity and a scale CSS transition to elements with `wire:transition`. Here's a visual preview:

[Preview transition in](#)

The above transition uses the following values for transitioning by default:

Transition in

Transition out

`duration: 150ms`

`duration: 75ms`

`opacity: [0 - 100]`

`opacity: [100 - 0]`

`transform: scale([0.95 - 1])`

`transform: scale([1 - 0.95])`

[#](#customizing-transitions "Permalink")Customizing transitions
----------------------------------------------------------------

To customize the CSS Livewire internally uses when transitioning, you can use any combination of the available modifiers:

Modifier

Description

`.in`

Only transition the element "in"

`.out`

Only transition the element "out"

`.duration.[?]ms`

Customize the transition duration in milliseconds

`.duration.[?]s`

Customize the transition duration in seconds

`.delay.[?]ms`

Customize the transition delay in milliseconds

`.delay.[?]s`

Customize the transition delay in seconds

`.opacity`

Only apply the opacity transition

`.scale`

Only apply the scale transition

`.origin.[top|bottom|left|right]`

Customize the scale "origin" used

Below is a list of various transition combinations that may help to better visualize these customizations:

**Fade-only transition**

By default, Livewire both fades and scales the element when transitioning. You can disable scaling and only fade by adding the `.opacity` modifier. This is useful for things like transitioning a full-page overlay, where adding a scale doesn't make sense.

    <div wire:transition.opacity>

[Preview transition in](#)

...

**Fade-out transition**

A common transition technique is to show an element immediately when transitioning in, and fade its opacity when transitioning out. You'll notice this effect on most native MacOS dropdowns and menus. Therefore it's commonly applied on the web to dropdowns, popovers, and menus.

    <div wire:transition.out.opacity.duration.200ms>

[Preview transition in](#)

...

**Origin-top transition**

When using Livewire to transition an element such as a dropdown menu, it makes sense to scale in from the top of the menu as the origin, rather than center (Livewire's default). This way the menu feels visually anchored to the element that triggered it.

    <div wire:transition.scale.origin.top>

[Preview transition in](#)

...

Livewire uses Alpine transitions behind the scenes

.prose .lw-tip pre:last-child { margin-bottom: 0px; }

When using `wire:transition` on an element, Livewire is internally applying Alpine's `x-transition` directive. Therefore you can use most if not all syntaxes you would normally use with `x-transition`. Check out [Alpine's transition documentation](https://alpinejs.dev/directives/transition) for all its capabilities.

---