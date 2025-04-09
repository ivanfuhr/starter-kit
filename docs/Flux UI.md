# Flux UI

## Índice

- [Accordion](#accordion)

- [Autocomplete](#autocomplete)

- [Avatar](#avatar)

- [Badge](#badge)

- [Brand](#brand)

- [Breadcrumbs](#breadcrumbs)

- [Button](#button)

- [Calendar](#calendar)

- [Callout](#callout)

- [Card](#card)

- [Chart](#chart)

- [Checkbox](#checkbox)

- [Command](#command)

- [Context](#context)

- [Customization](#customization)

- [Dark Mode](#dark-mode)

- [Date Picker](#date-picker)

- [Dropdown](#dropdown)

- [Editor](#editor)

- [Field](#field)

- [Header](#header)

- [Heading](#heading)

- [Help](#help)

- [Icon](#icon)

- [Input](#input)

- [Installation](#installation)

- [Modal](#modal)

- [Navbar](#navbar)

- [Pagination](#pagination)

- [Patterns](#patterns)

- [Principles](#principles)

- [Profile](#profile)

- [Radio](#radio)

- [Select](#select)

- [Separator](#separator)

- [Sidebar](#sidebar)

- [Switch](#switch)

- [Table](#table)

- [Tabs](#tabs)

- [Text](#text)

- [Textarea](#textarea)

- [Theming](#theming)

- [Toast](#toast)

- [Tooltip](#tooltip)

- [Upgrading](#upgrading)

## Accordion

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Accordion
=========

Collapse and expand sections of content. Perfect for FAQs and content-heavy areas.

What's your refund policy?

If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.

Do you offer any discounts for bulk purchases?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.

Copy to clipboard

    <flux:accordion>    <flux:accordion.item>        <flux:accordion.heading>What's your refund policy?</flux:accordion.heading>        <flux:accordion.content>            If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.        </flux:accordion.content>    </flux:accordion.item>    <flux:accordion.item>        <flux:accordion.heading>Do you offer any discounts for bulk purchases?</flux:accordion.heading>        <flux:accordion.content>            Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.        </flux:accordion.content>    </flux:accordion.item>    <flux:accordion.item>        <flux:accordion.heading>How do I track my order?</flux:accordion.heading>        <flux:accordion.content>            Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.        </flux:accordion.content>    </flux:accordion.item></flux:accordion>

[Shorthand](#shorthand)
-----------------------

You can save on markup by passing the heading text as a prop directly.

Copy to clipboard

    <flux:accordion.item heading="What's your refund policy?">    If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.</flux:accordion.item>

[With transition](#with-transition)
-----------------------------------

Enable expanding transitions for smoother interactions.

What's your refund policy?

If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.

Do you offer any discounts for bulk purchases?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.

Copy to clipboard

    <flux:accordion transition>    <!-- ... --></flux:accordion>

[Disabled](#disabled)
---------------------

Restrict an accordion item from being expanded.

What's your refund policy?

It all depends how nice you are to me in your email.

Do you offer PPP discounts?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

What do YOU think?

Copy to clipboard

    <flux:accordion.item disabled>    <!-- ... --></flux:accordion.item>

[Exclusive](#exclusive)
-----------------------

Enforce that only a single accordion item is expanded at a time.

What's your refund policy?

If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.

Do you offer any discounts for bulk purchases?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.

Copy to clipboard

    <flux:accordion exclusive>    <!-- ... --></flux:accordion>

[Expanded](#expanded)
---------------------

Expand a specific accordion by default.

What's your refund policy?

If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.

Do you offer any discounts for bulk purchases?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.

Copy to clipboard

    <flux:accordion.item expanded>    <!-- ... --></flux:accordion.item>

[Leading icon](#leading-icon)
-----------------------------

Display the icon before the heading instead of after it.

What's your refund policy?

If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.

Do you offer any discounts for bulk purchases?

Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.

How do I track my order?

Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.

Copy to clipboard

    <flux:accordion variant="reverse">    <!-- ... --></flux:accordion>

Reference
---------

### [flux:accordion](#fluxaccordion)

Prop

Description

variant

When set to reverse, displays the icon before the heading instead of after it.

transition

If true, enables expanding transitions for smoother interactions. Default: false.

exclusive

If true, only one accordion item can be expanded at a time. Default: false.

### [flux:accordion.item](#fluxaccordionitem)

Prop

Description

heading

Shorthand for flux:accordion.heading content.

expanded

If true, the accordion item is expanded by default. Default: false.

disabled

If true, the accordion item cannot be expanded or collapsed. Default: false.

### [flux:accordion.heading](#fluxaccordionheading)

Slot

Description

default

The heading text.

### [flux:accordion.content](#fluxaccordioncontent)

Slot

Description

default

The content to display when the accordion item is expanded.

---

## Autocomplete

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Autocomplete
============

Enhance an input field with autocomplete suggestions.

State of residence

Alabama Arkansas California Colorado Connecticut Delaware Florida Georgia Hawaii Idaho Illinois Indiana Iowa Kansas Kentucky Louisiana Maine Maryland Massachusetts Michigan Minnesota Mississippi Missouri Montana Nebraska Nevada New Hampshire New Jersey New Mexico New York North Carolina North Dakota Ohio Oklahoma Oregon Pennsylvania Rhode Island South Carolina South Dakota Tennessee Texas Utah Vermont Virginia Washington West Virginia Wisconsin Wyoming

Copy to clipboard

    <flux:autocomplete wire:model="state" label="State of residence">    <flux:autocomplete.item>Alabama</flux:autocomplete.item>    <flux:autocomplete.item>Arkansas</flux:autocomplete.item>    <flux:autocomplete.item>California</flux:autocomplete.item>    <!-- ... --></flux:autocomplete>

Related components
------------------

[

Input

Text fields for collecting user input



](/components/input)[

Select

Display a dropdown menu for selecting one option from many



](/components/select)

Reference
---------

### [flux:autocomplete](#fluxautocomplete)

Prop

Description

wire:model

The name of the Livewire property to bind the input value to.

type

HTML input type (e.g., text, email, password, file, date). Default: text.

label

Label text displayed above the input.

description

Descriptive text displayed below the label.

placeholder

Placeholder text displayed when the input is empty.

size

Size of the input. Options: sm, xs.

variant

Visual style variant. Options: filled. Default: outline.

disabled

If true, prevents user interaction with the input.

readonly

If true, makes the input read-only.

invalid

If true, applies error styling to the input.

multiple

For file inputs, allows selecting multiple files.

mask

Input mask pattern using Alpine's mask plugin. Example: 99/99/9999.

icon

Name of the icon displayed at the start of the input.

icon:trailing

Name of the icon displayed at the end of the input.

kbd

Keyboard shortcut hint displayed at the end of the input.

clearable

If true, displays a clear button when the input has content.

copyable

If true, displays a copy button to copy the input's content.

viewable

For password inputs, if true, displays a toggle to show/hide the password.

as

Render the input as a different element. Options: button. Default: input.

class:input

CSS classes applied directly to the input element instead of the wrapper.

Slot

Description

icon

Custom content displayed at the start of the input (e.g., icons).

icon:leading

Custom content displayed at the start of the input (e.g., icons).

icon:trailing

Custom content displayed at the end of the input (e.g., buttons).

### [flux:autocomplete.item](#fluxautocompleteitem)

Prop

Description

value

The value to be set when this item is selected. If not provided, the item's text content is used.

disabled

If present or true, the item cannot be selected.

---

## Avatar

Avatar
======

Display an image or initials as an avatar.

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:avatar src="https://unavatar.io/x/calebporzio" />

[Tooltip](#tooltip)
-------------------

Use the tooltip prop to display a tooltip when hovering over the avatar.

![](https://unavatar.io/x/calebporzio)

Caleb Porzio

Copy to clipboard

    <flux:avatar tooltip="Caleb Porzio" src="https://unavatar.io/x/calebporzio" /><!-- Or infer from the name prop... --><flux:avatar tooltip name="Caleb Porzio" src="https://unavatar.io/x/calebporzio" />

[Initials](#initials)
---------------------

When no src is provided, the name prop will be used to automatically generate initials. You can also use the initials prop directly.

CP

Ca

C

Copy to clipboard

    <flux:avatar name="Caleb Porzio" /><flux:avatar name="calebporzio" /><flux:avatar name="calebporzio" initials:single /><!-- Or use the initials prop directly... --><flux:avatar initials="CP" />

[Size](#size)
-------------

Use the size prop to change the size of the avatar.

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <!-- Extra large: size-16 (64px) --><flux:avatar size="xl" src="https://unavatar.io/x/calebporzio" /><!-- Large: size-12 (48px) --><flux:avatar size="lg" src="https://unavatar.io/x/calebporzio" /><!-- Default: size-10 (40px) --><flux:avatar src="https://unavatar.io/x/calebporzio" /><!-- Small: size-8 (32px) --><flux:avatar size="sm" src="https://unavatar.io/x/calebporzio" /><!-- Extra small: size-6 (24px) --><flux:avatar size="xs" src="https://unavatar.io/x/calebporzio" />

[Icon](#icon)
-------------

Use the icon prop to display an icon instead of an image.

Copy to clipboard

    <flux:avatar icon="user" /><flux:avatar icon="phone" /><flux:avatar icon="computer-desktop" />

[Colors](#colors)
-----------------

Use the color prop to change the color of the avatar.

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

CP

Copy to clipboard

    <flux:avatar name="Caleb Porzio" color="red" /><flux:avatar name="Caleb Porzio" color="orange" /><flux:avatar name="Caleb Porzio" color="amber" /><flux:avatar name="Caleb Porzio" color="yellow" /><flux:avatar name="Caleb Porzio" color="lime" /><flux:avatar name="Caleb Porzio" color="green" /><flux:avatar name="Caleb Porzio" color="emerald" /><flux:avatar name="Caleb Porzio" color="teal" /><flux:avatar name="Caleb Porzio" color="cyan" /><flux:avatar name="Caleb Porzio" color="sky" /><flux:avatar name="Caleb Porzio" color="blue" /><flux:avatar name="Caleb Porzio" color="indigo" /><flux:avatar name="Caleb Porzio" color="violet" /><flux:avatar name="Caleb Porzio" color="purple" /><flux:avatar name="Caleb Porzio" color="fuchsia" /><flux:avatar name="Caleb Porzio" color="pink" /><flux:avatar name="Caleb Porzio" color="rose" />

[Auto color](#auto-color)
-------------------------

Deterministically generate a color based on a user's name.

CP

MJ

KC

KN

KS

BP

AB

Copy to clipboard

    <flux:avatar name="Caleb Porzio" color="auto" /><!-- Use color:seed to generate a consistent color based --><!-- on something unchanging like a user's ID... --><flux:avatar name="Caleb Porzio" color="auto" color:seed="{{ $user->id }}" />

[Circle](#circle)
-----------------

Use the circle prop to make the avatar circular.

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:avatar circle src="https://unavatar.io/x/calebporzio" />

[Badge](#badge)
---------------

Add badges to avatars in various ways. Use the badge prop by itself for a simple dot indicator, provide content like numbers or emojis, or even pass in custom HTML via a slot.

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/x/calebporzio)

25

![](https://unavatar.io/x/calebporzio)

👍

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/github/hugosaintemarie)

Copy to clipboard

    <flux:avatar badge badge:color="green" badge:circle src="https://unavatar.io/x/calebporzio" /><flux:avatar badge badge:color="zinc" badge:position="top right" badge:circle badge:variant="outline" src="https://unavatar.io/x/calebporzio" /><flux:avatar badge="25" src="https://unavatar.io/x/calebporzio" /><flux:avatar circle badge="👍" badge:circle src="https://unavatar.io/x/calebporzio" /><flux:avatar circle src="https://unavatar.io/x/calebporzio">    <x-slot:badge>        <img class="size-3" src="https://unavatar.io/github/hugosaintemarie" />    </x-slot:badge></flux:avatar>

[Groups](#groups)
-----------------

Stack avatars together. By default, grouped avatars have rings that adapt to your theme - white in light mode and a dark color in dark mode. If you need to customize the ring color, to match a different background, you can do so by adding a custom class to the flux:avatar.group component.

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/github/hugosaintemarie)

![](https://unavatar.io/github/joshhanley)

3+

![](https://unavatar.io/x/calebporzio)

![](https://unavatar.io/github/hugosaintemarie)

![](https://unavatar.io/github/joshhanley)

3+

Copy to clipboard

    <flux:avatar.group>    <flux:avatar src="https://unavatar.io/x/calebporzio" />    <flux:avatar src="https://unavatar.io/github/hugosaintemarie" />    <flux:avatar src="https://unavatar.io/github/joshhanley" />    <flux:avatar>3+</flux:avatar></flux:avatar.group><!-- Adapt rings to custom background... --><flux:avatar.group class="**:ring-zinc-100 dark:**:ring-zinc-800">    <flux:avatar circle src="https://unavatar.io/x/calebporzio" />    <flux:avatar circle src="https://unavatar.io/github/hugosaintemarie" />    <flux:avatar circle src="https://unavatar.io/github/joshhanley" />    <flux:avatar circle>3+</flux:avatar></flux:avatar.group>

[As button](#as-button)
-----------------------

Use the as prop to make the avatar a button.

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:avatar as="button" src="https://unavatar.io/x/calebporzio" />

[As link](#as-link)
-------------------

Use the href prop to make the avatar a link.

[![](https://unavatar.io/x/calebporzio)](https://x.com/calebporzio)

Copy to clipboard

    <flux:avatar href="https://x.com/calebporzio" src="https://unavatar.io/x/calebporzio" />

Examples
--------

### [Testimonial](#testimonial)

IMO Livewire takes Blade to the next level. It's basically what Blade should be by default. 🔥

![](https://unavatar.io/x/taylorotwell)

Taylor Otwell

Creator of Laravel

Copy to clipboard

    <div>    <div class="flex items-center gap-2">        <flux:icon.star variant="solid" />        <flux:icon.star variant="solid" />        <flux:icon.star variant="solid" />        <flux:icon.star variant="solid" />        <flux:icon.star variant="solid" />    </div>    <flux:heading size="xl" class="mt-4 italic">        <p>IMO Livewire takes Blade to the next level. It's basically what Blade should be by default. 🔥</p>    </flux:heading>    <div class="mt-6 flex items-center gap-4">        <flux:avatar size="lg" src="https://unavatar.io/x/taylorotwell" />        <div>            <flux:heading size="lg">Taylor Otwell</flux:heading>            <flux:text>Creator of Laravel</flux:text>        </div>    </div></div>

### [Grouped feature](#grouped-feature)

The Laravel Podcast

New

A podcast about Laravel, development best practices, and the PHP ecosystem—hosted by Jeffrey Way, Matt Stauffer, and Taylor Otwell, later joined by Adam Wathan.

![](https://unavatar.io/x/taylorotwell)

![](https://unavatar.io/x/adamwathan)

![](https://unavatar.io/x/jeffrey_way)

![](https://unavatar.io/x/stauffermatt)

Copy to clipboard

    <div>    <flux:heading size="xl">The Laravel Podcast <flux:badge inset="top bottom" class="ml-1 max-sm:hidden">New</flux:badge></flux:heading>    <flux:text class="mt-2">        A podcast about Laravel, development best practices, and the PHP ecosystem—hosted by Jeffrey Way, Matt Stauffer, and Taylor Otwell, later joined by Adam Wathan.    </flux:text>    <flux:avatar.group class="mt-6">        <flux:avatar circle size="lg" src="https://unavatar.io/x/taylorotwell" />        <flux:avatar circle size="lg" src="https://unavatar.io/x/adamwathan" />        <flux:avatar circle size="lg" src="https://unavatar.io/x/jeffrey_way" />        <flux:avatar circle size="lg" src="https://unavatar.io/x/stauffermatt" />    </flux:avatar.group></div>

### [Members table](#members-table)

Include avatars in table rows to make user data more identifiable.

Team members

Invite

![](https://unavatar.io/github/calebporzio)

Caleb Porzio

You

[\[email protected\]](/cdn-cgi/l/email-protection)

Admin Member Guest

![](https://unavatar.io/github/hugosaintemarie)

Hugo Sainte-Marie

[\[email protected\]](/cdn-cgi/l/email-protection)

Admin Member Guest

![](https://unavatar.io/github/joshhanley)

Josh Hanley

[\[email protected\]](/cdn-cgi/l/email-protection)

Admin Member Guest

Copy to clipboard

    <div class="flex justify-between items-center mb-4">    <flux:heading size="lg">Team members</flux:heading>    <flux:button size="sm" icon="plus">Invite</flux:button></div><flux:table>    <flux:table.rows>        <flux:table.row>            <flux:table.cell>                <div class="flex items-center gap-2 sm:gap-4">                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/calebporzio" />                    <div class="flex flex-col">                        <flux:heading>Caleb Porzio <flux:badge size="sm" color="blue" class="ml-1 max-sm:hidden">You</flux:badge></flux:heading>                        <flux:text class="max-sm:hidden">[email protected]</flux:text>                    </div>                </div>            </flux:table.cell>            <flux:table.cell>                <div class="flex justify-end items-center gap-2">                    <flux:select size="sm" class="min-w-fit max-w-fit">                        <flux:select.option value="admin" selected>Admin</flux:select.option>                        <flux:select.option value="member">Member</flux:select.option>                        <flux:select.option value="guest">Guest</flux:select.option>                    </flux:select>                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />                </div>            </flux:table.cell>        </flux:table.row>        <flux:table.row >            <flux:table.cell>                <div class="flex items-center gap-2 sm:gap-4">                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/hugosaintemarie" />                    <div class="flex flex-col">                        <flux:heading>Hugo Sainte-Marie</flux:heading>                        <flux:text class="max-sm:hidden">[email protected]</flux:text>                    </div>                </div>            </flux:table.cell>            <flux:table.cell>                <div class="flex justify-end items-center gap-2">                    <flux:select size="sm" class="min-w-fit max-w-fit">                        <flux:select.option value="admin">Admin</flux:select.option>                        <flux:select.option value="member" selected>Member</flux:select.option>                        <flux:select.option value="guest">Guest</flux:select.option>                    </flux:select>                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />                </div>            </flux:table.cell>        </flux:table.row>        <flux:table.row>            <flux:table.cell>                <div class="flex items-center gap-2 sm:gap-4">                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/joshhanley" />                    <div class="flex flex-col">                        <flux:heading>Josh Hanley</flux:heading>                        <flux:text class="max-sm:hidden">[email protected]</flux:text>                    </div>                </div>            </flux:table.cell>            <flux:table.cell>                <div class="flex justify-end items-center gap-2">                    <flux:select size="sm" class="min-w-fit max-w-fit">                        <flux:select.option value="admin">Admin</flux:select.option>                        <flux:select.option value="member" selected>Member</flux:select.option>                        <flux:select.option value="guest">Guest</flux:select.option>                    </flux:select>                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />                </div>            </flux:table.cell>        </flux:table.row>    </flux:table.rows></flux:table>

### [Assignees list](#assignees-list)

Include avatars in table rows to make user data more identifiable.

Assignees

*   ![](https://unavatar.io/github/calebporzio)
    
    Caleb Porzio
    
*   ![](https://unavatar.io/github/hugosaintemarie)
    
    Hugo Sainte-Marie
    
*   ![](https://unavatar.io/github/joshhanley)
    
    Josh Hanley
    
*   ![](https://unavatar.io/github/jasonlbeggs)
    
    Jason Beggs
    

Copy to clipboard

    <flux:card>    <div class="flex justify-between items-center">        <flux:heading>Assignees</flux:heading>        <flux:button size="sm" variant="subtle" icon="plus" inset="top bottom" />    </div>    <flux:separator class="mt-2 mb-4" variant="subtle" />    <ul class="flex flex-col gap-3">        <li class="flex items-center gap-2">            <flux:avatar size="xs" src="https://unavatar.io/github/calebporzio" />            <flux:heading>Caleb Porzio</flux:heading>        </li>        <li class="flex items-center gap-2">            <flux:avatar size="xs" src="https://unavatar.io/github/hugosaintemarie" />            <flux:heading>Hugo Sainte-Marie</flux:heading>        </li>        <li class="flex items-center gap-2">            <flux:avatar size="xs" src="https://unavatar.io/github/joshhanley" />            <flux:heading>Josh Hanley</flux:heading>        </li>        <li class="flex items-center gap-2">            <flux:avatar size="xs" src="https://unavatar.io/github/jasonlbeggs" />            <flux:heading>Jason Beggs</flux:heading>        </li>    </ul></flux:card>

### [Select options](#select-options)

Enhance select options with avatars to make them more visually recognizable.

Assign to

![](https://unavatar.io/github/calebporzio)

Caleb Porzio

![](https://unavatar.io/github/hugosaintemarie)

Hugo Sainte-Marie

![](https://unavatar.io/github/joshhanley)

Josh Hanley

![](https://unavatar.io/github/jasonlbeggs)

Jason Beggs

Copy to clipboard

    <flux:select variant="listbox" label="Assign to">    <flux:select.option selected>        <div class="flex items-center gap-2 whitespace-nowrap">            <flux:avatar circle size="xs" src="https://unavatar.io/github/calebporzio" /> Caleb Porzio        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2 whitespace-nowrap">            <flux:avatar circle size="xs" src="https://unavatar.io/github/hugosaintemarie" /> Hugo Sainte-Marie        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2 whitespace-nowrap">            <flux:avatar circle size="xs" src="https://unavatar.io/github/joshhanley" /> Josh Hanley        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2 whitespace-nowrap">            <flux:avatar circle size="xs" src="https://unavatar.io/github/jasonlbeggs" /> Jason Beggs        </div>    </flux:select.option></flux:select>

### [User popover](#user-popover)

Display a user's profile information in a popover.

![calebporzio](https://unavatar.io/x/calebporzio)

Follow back

![calebporzio](https://unavatar.io/x/calebporzio)

Caleb Porzio

@calebporzio

Follows you

I'm a full stack developer with a passion for building web applications. Currently working on a new project called [Flux](https://fluxui.dev).

1.2k

Followers

1.2k

Following

Copy to clipboard

    <flux:dropdown hover position="bottom center">    <flux:avatar as="button" name="calebporzio" src="https://unavatar.io/x/calebporzio" />    <flux:popover class="relative max-w-[15rem]">        <div class="absolute top-0 right-0 p-2">            <flux:button icon="user-plus" variant="filled" size="sm">Follow back</flux:button>        </div>        <flux:avatar size="xl" name="calebporzio" src="https://unavatar.io/x/calebporzio" />        <flux:heading class="mt-2">Caleb Porzio</flux:heading>        <flux:text>@calebporzio <flux:badge color="zinc" size="sm" inset="top bottom">Follows you</flux:badge></flux:text>        <flux:text class="mt-3">            I'm a full stack developer with a passion for building web applications. Currently working on a new project called <flux:link href="https://fluxui.dev">Flux</flux:link>.        </flux:text>        <div class="flex gap-4 mt-3">            <div class="flex gap-2 items-center">                <flux:heading>1.2k</flux:heading> <flux:text>Followers</flux:text>            </div>            <div class="flex gap-2 items-center">                <flux:heading>1.2k</flux:heading> <flux:text>Following</flux:text>            </div>        </div>    </flux:popover></flux:dropdown>

Related components
------------------

[

Profile

Display a user's profile with avatar and optional name



](/components/profile)[

Tooltip

Display informative tooltips when hovering over an element



](/components/tooltip)

Reference
---------

### [flux:avatar](#fluxavatar)

Prop

Description

name

User's name to display as initials. If provided without initials, this will be used to generate initials automatically.

src

URL to the image to display as avatar.

initials

Custom initials to display when no src is provided. Will override name if provided.

alt

Alternative text for the avatar image. (Default: name if provided)

size

Size of the avatar. Options: xs (24px), sm (32px), (default: 40px), lg (48px).

color

Background color when displaying initials or icons. Options: red, orange, amber, yellow, lime, green, emerald, teal, cyan, sky, blue, indigo, violet, purple, fuchsia, pink, rose, auto. Default: none (uses system colors).

color:seed

Value used when color="auto" to deterministically generate consistent colors. Useful for using user IDs to generate consistent colors.

circle

If present or true, makes the avatar fully circular instead of rounded corners.

icon

Name of the icon to display instead of an image or initials.

icon:variant

Icon variant to use. Options: outline, solid. Default: solid.

tooltip

Text to display in a tooltip when hovering over the avatar. If set to true, uses the name prop as tooltip content.

tooltip:position

Position of the tooltip. Options: top, right, bottom, left. Default: top.

badge

Content to display as a badge. Can be a string, boolean, or a slot.

badge:color

Color of the badge. Options: same color options as the color prop.

badge:circle

If present or true, makes the badge fully circular instead of slightly rounded corners.

badge:position

Position of the badge. Options: top left, top right, bottom left, bottom right. Default: bottom right.

badge:variant

Variant of the badge. Options: solid, outline. Default: solid.

as

Element to render the avatar as. Options: button, div (default).

href

URL to link to, making the avatar a link element.

Slot

Description

default

Custom content to display inside the avatar. Will override initials if provided.

badge

Custom content to display in the badge (for more complex badge content).

### [flux:avatar.group](#fluxavatargroup)

Prop

Description

class

CSS classes to apply to the group, including customizing ring colors using \*:ring-{color} format.

Slot

Description

default

Place multiple flux:avatar components here to display them as a group.

---

## Badge

Badge
=====

Highlight information like status, category, or count.

New

Copy to clipboard

    <flux:badge color="lime">New</flux:badge>

[Sizes](#sizes)
---------------

Choose between three different sizes for your badges with the size prop.

Small

Default

Large

Copy to clipboard

    <flux:badge size="sm">Small</flux:badge><flux:badge>Default</flux:badge><flux:badge size="lg">Large</flux:badge>

[Icons](#icons)
---------------

Add icons to badges with the icon and icon:trailing props.

Users

Files

Videos

Copy to clipboard

    <flux:badge icon="user-circle">Users</flux:badge><flux:badge icon="document-text">Files</flux:badge><flux:badge icon:trailing="video-camera">Videos</flux:badge>

[Pill variant](#pill-variant)
-----------------------------

Display badges with a fully rounded border radius using the variant="pill" prop.

Users

Copy to clipboard

    <flux:badge variant="pill" icon="user">Users</flux:badge>

[As button](#as-button)
-----------------------

Make the entire badge clickable by wrapping it in a button element.

Amount

Copy to clipboard

    <flux:badge as="button" variant="pill" icon="plus" size="lg">Amount</flux:badge>

[With close button](#with-close-button)
---------------------------------------

Make a badge removable by appending a close button.

Admin

Copy to clipboard

    <flux:badge>    Admin <flux:badge.close /></flux:badge>

[Colors](#colors)
-----------------

Choose from an array of colors to differentiate between badges and convey emotion.

Zinc

Red

Orange

Amber

Yellow

Lime

Green

Emerald

Teal

Cyan

Sky

Blue

Indigo

Violet

Purple

Fuchsia

Pink

Rose

Copy to clipboard

    <flux:badge color="zinc">Zinc</flux:badge><flux:badge color="red">Red</flux:badge><flux:badge color="orange">Orange</flux:badge><flux:badge color="amber">Amber</flux:badge><flux:badge color="yellow">Yellow</flux:badge><flux:badge color="lime">Lime</flux:badge><flux:badge color="green">Green</flux:badge><flux:badge color="emerald">Emerald</flux:badge><flux:badge color="teal">Teal</flux:badge><flux:badge color="cyan">Cyan</flux:badge><flux:badge color="sky">Sky</flux:badge><flux:badge color="blue">Blue</flux:badge><flux:badge color="indigo">Indigo</flux:badge><flux:badge color="violet">Violet</flux:badge><flux:badge color="purple">Purple</flux:badge><flux:badge color="fuchsia">Fuchsia</flux:badge><flux:badge color="pink">Pink</flux:badge><flux:badge color="rose">Rose</flux:badge>

[Solid variant](#solid-variant)
-------------------------------

Bold, high-contrast badges for more important status indicators or alerts.

Zinc

Red

Orange

Amber

Yellow

Lime

Green

Emerald

Teal

Cyan

Sky

Blue

Indigo

Violet

Purple

Fuchsia

Pink

Rose

Copy to clipboard

    <flux:badge variant="solid" color="zinc">Zinc</flux:badge><flux:badge variant="solid" color="red">Red</flux:badge><flux:badge variant="solid" color="orange">Orange</flux:badge><flux:badge variant="solid" color="amber">Amber</flux:badge><flux:badge variant="solid" color="yellow">Yellow</flux:badge><flux:badge variant="solid" color="lime">Lime</flux:badge><flux:badge variant="solid" color="green">Green</flux:badge><flux:badge variant="solid" color="emerald">Emerald</flux:badge><flux:badge variant="solid" color="teal">Teal</flux:badge><flux:badge variant="solid" color="cyan">Cyan</flux:badge><flux:badge variant="solid" color="sky">Sky</flux:badge><flux:badge variant="solid" color="blue">Blue</flux:badge><flux:badge variant="solid" color="indigo">Indigo</flux:badge><flux:badge variant="solid" color="violet">Violet</flux:badge><flux:badge variant="solid" color="purple">Purple</flux:badge><flux:badge variant="solid" color="fuchsia">Fuchsia</flux:badge><flux:badge variant="solid" color="pink">Pink</flux:badge><flux:badge variant="solid" color="rose">Rose</flux:badge>

[Inset](#inset)
---------------

If you're using badges alongside inline text, you might run into spacing issues because of the extra padding around the badge. Use the inset prop to add negative margins to the top and bottom of the badge to avoid this.

Page builder

New

Easily author new pages without leaving your browser.

Copy to clipboard

    <flux:heading>    Page builder <flux:badge color="lime" inset="top bottom">New</flux:badge></flux:heading><flux:text class="mt-2">Easily author new pages without leaving your browser.</flux:text>

Related components
------------------

[

Avatar

Display user profile images or fallback initials



](/components/avatar)[

Navbar

Build responsive navigation bars with item badges



](/components/navbar)

Reference
---------

### [flux:badge](#fluxbadge)

Prop

Description

color

Badge color (e.g., zinc, red, blue). Default: zinc.

size

Badge size. Options: sm, lg.

variant

Badge style variant. Options: pill.

icon

Name of the icon to display before the badge text.

icon:trailing

Name of the icon to display after the badge text.

icon:variant

Icon variant. Options: outline, solid, mini, micro. Default: mini.

as

HTML element to render the badge as. Options: button. Default: div.

inset

Add negative margins to specific sides. Options: top, bottom, left, right, or any combination of the four.

### [flux:badge.close](#fluxbadgeclose)

Prop

Description

icon

Name of the icon to display. Default: x-mark.

icon:variant

Icon variant. Options: outline, solid, mini, micro. Default: mini.

---

## Brand

Brand
=====

Display your company or application's logo and name in a clean, consistent way across your interface.

[

![](/img/demo/logo.png)

Acme Inc.

](#)[

![](/img/demo/dark-mode-logo.png)

Acme Inc.

](#)

Copy to clipboard

    <flux:brand href="#" logo="/img/demo/logo.png" name="Acme Inc." /><flux:brand href="#" name="Acme Inc.">    <x-slot name="logo">        <div class="size-6 rounded shrink-0 bg-accent text-accent-foreground flex items-center justify-center"><i class="font-serif font-bold">A</i></div>    </x-slot></flux:brand>

[Logo slot](#logo-slot)
-----------------------

Use the logo slot to provide a custom logo for your brand.

[

Launchpad

](#)

Copy to clipboard

    <flux:brand href="#" name="Launchpad">    <x-slot name="logo" class="size-6 rounded-full bg-cyan-500 text-white text-xs font-bold">        <flux:icon name="rocket-launch" variant="micro" />    </x-slot></flux:brand>

[Logo only](#logo-only)
-----------------------

Display just the logo without the company name by omitting the name prop.

[

![](/img/demo/logo.png)

](#)[

![](/img/demo/dark-mode-logo.png)

](#)

Copy to clipboard

    <flux:brand href="#" logo="/img/demo/logo.png" />

Examples
--------

### [Header with brand](#header-with-brand)

[

_A_

Acme Inc.

](#)

[

Home

](#)[

Inbox

12](#)

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:header class="px-4! w-full bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-100 dark:border-white/5">    <flux:brand href="#" name="Acme Inc.">        <x-slot name="logo" class="bg-accent text-accent-foreground">            <i class="font-serif font-bold">A</i>        </x-slot>    </flux:brand>    <flux:navbar variant="outline">        <flux:navbar.item href="#" current>Home</flux:navbar.item>        <flux:navbar.item badge="12" href="#">Inbox</flux:navbar.item>    </flux:navbar>    <flux:spacer class="min-w-24" />    <flux:profile circle :chevron="false" avatar="https://unavatar.io/x/calebporzio" /></flux:header>

Related components
------------------

[

Header

Top navigation headers for your application



](/layouts/header)[

Sidebar

Sidebar navigation for your application



](/layouts/sidebar)

Reference
---------

### [flux:brand](#fluxbrand)

Prop

Description

name

Company or application name to display next to the logo.

logo

URL to the image to display as logo, or can pass content via slot.

alt

Alternative text for the logo.

href

URL to navigate to when the brand is clicked. Default: '/'.

Slot

Description

logo

Custom content for the logo section, typically containing an image, SVG, or custom HTML.

---

## Breadcrumbs

Breadcrumbs
===========

Help users navigate and understand their place within your application.

[Home](#)

[Blog](#)

Post

Copy to clipboard

    <flux:breadcrumbs>    <flux:breadcrumbs.item href="#">Home</flux:breadcrumbs.item>    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item></flux:breadcrumbs>

[With slashes](#with-slashes)
-----------------------------

Use slashes instead of chevrons to separate breadcrumb items.

[Home](#)

[Blog](#)

Post

Copy to clipboard

    <flux:breadcrumbs>    <flux:breadcrumbs.item href="#" separator="slash">Home</flux:breadcrumbs.item>    <flux:breadcrumbs.item href="#" separator="slash">Blog</flux:breadcrumbs.item>    <flux:breadcrumbs.item separator="slash">Post</flux:breadcrumbs.item></flux:breadcrumbs>

[With icon](#with-icon)
-----------------------

Use an icon instead of text for a particular breadcrumb item.

[](#)

[Blog](#)

Post

Copy to clipboard

    <flux:breadcrumbs>    <flux:breadcrumbs.item href="#" icon="home" />    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item></flux:breadcrumbs>

[With ellipsis](#with-ellipsis)
-------------------------------

Truncate a long breadcrumb list with an ellipsis.

[](#)

Post

Copy to clipboard

    <flux:breadcrumbs>    <flux:breadcrumbs.item href="#" icon="home" />    <flux:breadcrumbs.item icon="ellipsis-horizontal" />    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item></flux:breadcrumbs>

[With ellipsis dropdown](#with-ellipsis-dropdown)
-------------------------------------------------

Truncate a long breadcrumb list into a single ellipsis dropdown.

[](#)

Client Team User

Post

Copy to clipboard

    <flux:breadcrumbs>    <flux:breadcrumbs.item href="#" icon="home" />    <flux:breadcrumbs.item>        <flux:dropdown>            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" />            <flux:navmenu>                <flux:navmenu.item>Client</flux:navmenu.item>                <flux:navmenu.item icon="arrow-turn-down-right">Team</flux:navmenu.item>                <flux:navmenu.item icon="arrow-turn-down-right">User</flux:navmenu.item>            </flux:navmenu>        </flux:dropdown>    </flux:breadcrumbs.item>    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item></flux:breadcrumbs>

Reference
---------

### [flux:breadcrumbs](#fluxbreadcrumbs)

Slot

Description

default

The breadcrumb items to display.

### [flux:breadcrumbs.item](#fluxbreadcrumbsitem)

Prop

Description

href

URL the breadcrumb item links to. If omitted, renders as non-clickable text.

icon

Name of the icon to display before the badge text.

icon:variant

Icon variant. Options: outline, solid, mini, micro. Default: mini.

separator

Name of the icon to display as the separator. Default: chevron-right.

---

## Button

Button
======

A powerful and composable button component for your application.

Button

Copy to clipboard

    <flux:button>Button</flux:button>

[Variants](#variants)
---------------------

Use the variant prop to change the visual style of the button.

Use primary buttons sparingly; mostly for form submissions.

Default Primary Filled Danger Ghost Subtle

Copy to clipboard

    <flux:button>Default</flux:button><flux:button variant="primary">Primary</flux:button><flux:button variant="filled">Filled</flux:button><flux:button variant="danger">Danger</flux:button><flux:button variant="ghost">Ghost</flux:button><flux:button variant="subtle">Subtle</flux:button>

[Sizes](#sizes)
---------------

The default button size works great for most cases, but here are some additional size options for unique situations.

Default Small Extra small

Copy to clipboard

    <flux:button>Base</flux:button><flux:button size="sm">Small</flux:button><flux:button size="xs">Extra small</flux:button>

[Icons](#icons)
---------------

Automatically sized and styled icons for your buttons.

Export Open

Copy to clipboard

    <flux:button icon="ellipsis-horizontal" /><flux:button icon="arrow-down-tray">Export</flux:button><flux:button icon:trailing="chevron-down">Open</flux:button><flux:button icon="x-mark" variant="subtle" />

[Loading](#loading)
-------------------

Buttons with wire:click or type="submit" will automatically show a loading indicator and disable pointer events during network requests.

Save changes

Copy to clipboard

    <flux:button wire:click="save">    Save changes</flux:button>

You can disable this behavior using :loading="false".

Copy to clipboard

    <flux:button wire:click="save" :loading="false">

[Full width](#full-width)
-------------------------

A button that spans the full width of the container.

Send invite

Copy to clipboard

    <flux:button variant="primary" class="w-full">Send invite</flux:button>

[Button groups](#button-groups)
-------------------------------

Fuse related buttons into a group with shared borders.

Oldest Newest Top

Copy to clipboard

    <flux:button.group>    <flux:button>Oldest</flux:button>    <flux:button>Newest</flux:button>    <flux:button>Top</flux:button></flux:button.group>

[Icon group](#icon-group)
-------------------------

Fuse multiple icon buttons into a visually-linked group.

Copy to clipboard

    <flux:button.group>    <flux:button icon="bars-3-bottom-left"></flux:button>    <flux:button icon="bars-3"></flux:button>    <flux:button icon="bars-3-bottom-right"></flux:button></flux:button.group>

[Attached button](#attached-button)
-----------------------------------

Append or prepend an icon button to another button to add additional functionality.

New product

Copy to clipboard

    <flux:button.group>    <flux:button>New product</flux:button>    <flux:button icon="chevron-down"></flux:button></flux:button.group>

[As a link](#as-a-link)
-----------------------

Display an HTML a tag as a button by passing the href prop.

[Visit Google](https://google.com)

Copy to clipboard

    <flux:button    href="https://google.com"    icon:trailing="arrow-up-right">    Visit Google</flux:button>

[As an input](#as-an-input)
---------------------------

To display a button as an input, pass as="button" to the [input component](/components/input).

Search...

⌘K

Copy to clipboard

    <flux:input as="button" placeholder="Search..." icon="magnifying-glass" kbd="⌘K" />

[Square](#square)
-----------------

Make the height and width of a button equal. Flux does this automatically for icon-only buttons.

...

Copy to clipboard

    <flux:button square>...</flux:button>

[Inset](#inset)
---------------

When using ghost or subtle button variants, you can use the inset prop to negate any invisible padding for better alignment.

Post successfully created.

Copy to clipboard

    <div class="flex justify-between">    <flux:heading>Post successfully created.</flux:heading>    <flux:button size="sm" icon="x-mark" variant="ghost" inset /></div>

Related components
------------------

[

Dropdown

Display expandable menus for navigational options



](/components/dropdown)[

Icon

Display icons for your application



](/components/icon)

Reference
---------

### [flux:button](#fluxbutton)

Prop

Description

as

The HTML tag to render the button as. Options: button (default), a, div.

href

The URL to link to when the button is used as an anchor tag.

type

The HTML type attribute of the button. Options: button (default), submit.

variant

Visual style of the button. Options: outline, primary, filled, danger, ghost, subtle. Default: outline.

size

Size of the button. Options: base (default), sm, xs.

icon

Name of the icon to display at the start of the button.

icon:variant

Visual style of the icon. Options: outline (default), solid, mini, micro.

icon:trailing

Name of the icon to display at the end of the button.

square

If true, makes the button square. (Useful for icon-only buttons.)

inset

Add negative margins to specific sides. Options: top, bottom, left, right, or any combination of the four.

loading

If true, shows a loading spinner and disables the button when used with wire:click or type="submit". If false, the button will not show a loading spinner at all. Default: true.

tooltip

Text to display in a tooltip when hovering over the button.

tooltip:position

Position of the tooltip. Options: top, bottom, left, right. Default: top.

tooltip:kbd

Text to display in a keyboard shortcut tooltip when hovering over the button.

kbd

Text to display in a keyboard shortcut tooltip when hovering over the button.

CSS

Description

class

Additional CSS classes applied to the button. Common use: w-full for full width.

Attribute

Description

data-flux-button

Applied to the root element for styling and identification.

### [flux:button.group](#fluxbuttongroup)

A container component that groups multiple buttons together with shared borders.

Slot

Description

default

The buttons to be grouped together.

---

## Calendar

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Calendar
========

A flexible calendar component for date selection. Supports single dates, multiple dates, and date ranges. Perfect for scheduling and booking systems.

Copy to clipboard

    <flux:calendar />

Basic Usage
-----------

Set the initial selected date using the value prop with a Y-m-d formatted date string:

Copy to clipboard

    <flux:calendar value="2025-04-03" />

You can also bind the selection to a Livewire property using wire:model:

Copy to clipboard

    <flux:calendar wire:model="date" />

Now you can access the selected date from your Livewire component using either a Carbon instance or a Y-m-d formatted string:

Copy to clipboard

    <?phpuse Illuminate\Support\Carbon;use Livewire\Component;class BookAppointment extends Component {    public Carbon $date;    public function mount() {        $this->date = now();    }}

[Multiple dates](#multiple-dates)
---------------------------------

Select multiple non-consecutive dates.

Copy to clipboard

    <flux:calendar multiple />

Set multiple selected dates using a comma-separated list in the value prop:

Copy to clipboard

    <flux:calendar    multiple    value="2025-04-02,2025-04-05,2025-04-15"/>

You can also bind the selection to a Livewire property using wire:model:

Copy to clipboard

    <flux:calendar multiple wire:model="dates" />

You can access the selected dates in your Livewire component using an array of Y-m-d formatted date strings:

Copy to clipboard

    <?phpuse Illuminate\Support\Carbon;use Livewire\Component;class RequestTimeOff extends Component {    public array $dates = [];    public function mount() {        $this->dates = [            now()->format('Y-m-d'),            now()->addDays(1)->format('Y-m-d'),        ];    }}

[Date range](#date-range)
-------------------------

Select a range of dates.

Copy to clipboard

    <flux:calendar mode="range" />

Set the initial range using the value prop with a start and end date separated by a forward slash:

Copy to clipboard

    <flux:calendar mode="range" value="2025-04-02/2025-04-06" />

You can also bind the selection to a Livewire property using wire:model:

Copy to clipboard

    <flux:calendar mode="range" wire:model="range" />

Now you can access the selected range from your Livewire component using an associative array of Y-m-d formatted date strings:

Copy to clipboard

    <?phpuse Livewire\Component;class BookFlight extends Component {    public ?array $range;    public function book() {        // ...        $flight->depart_on = $this->range['start'];        $flight->return_on = $this->range['end'];        // ...    }}

Alternatively, you can use the specialized DateRange object for enhanced functionality:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class BookFlight extends Component {    public ?DateRange $range;    public function book() {        // ...        $flight->depart_on = $this->range->start();        $flight->return_on = $this->range->end();        // ...    }}

We highly recommend using the DateRange object for range selection, it provides a lot of useful functionality.

[Check out everything you can do with the DateRange object ->](#the-daterange-object)

Range Configuration
-------------------

Control range behavior with these props:

Copy to clipboard

    <!-- Set minimum and maximum range limits --><flux:calendar mode="range" min-range="3" max-range="10" /><!-- Control number of months shown --><flux:calendar mode="range" months="2" />

[Size](#size)
-------------

Adjust the calendar's size to fit your layout. Available sizes include xs, sm, lg, xl, and 2xl.

Copy to clipboard

    <flux:calendar size="xl" />

[Static](#static)
-----------------

Create a non-interactive calendar for display purposes.

Copy to clipboard

    <flux:calendar    static    value="2025-04-03"    size="xs"    :navigation="false"/>

[Min/max dates](#minmax-dates)
------------------------------

Restrict the selectable date range by setting minimum and maximum boundaries.

Copy to clipboard

    <flux:calendar max="2025-04-03" />

You can also use the convenient "today" shorthand:

Copy to clipboard

    <!-- Prevent selection before today... --><flux:calendar min="today" /><!-- Prevent selection after today... --><flux:calendar max="today" />

[Unavailable dates](#unavailable-dates)
---------------------------------------

Disable specific dates from being selected. Useful for blocking out holidays, showing booked dates, or indicating unavailable time slots.

Copy to clipboard

    <flux:calendar unavailable="2025-04-02,2025-04-04" />

[With today shortcut](#with-today-shortcut)
-------------------------------------------

Add a shortcut button to quickly navigate to today's date. When viewing a different month, it jumps to the current month. When already viewing the current month, it selects today's date.

Copy to clipboard

    <flux:calendar with-today />

[Selectable header](#selectable-header)
---------------------------------------

Enable quick navigation by making the month and year in the header selectable.

Copy to clipboard

    <flux:calendar selectable-header />

[Fixed weeks](#fixed-weeks)
---------------------------

Display a consistent number of weeks in every month. Prevents layout shifts when navigating between months with different numbers of weeks.

Copy to clipboard

    <flux:calendar fixed-weeks />

[Start day](#start-day)
-----------------------

By default, the first day of the week will be automatically set based on the user's locale. You can override this by setting the start-day attribute to any day of the week.

Copy to clipboard

    <flux:calendar start-day="1" />

[Open to](#open-to)
-------------------

Set the date that the calendar will open to. Otherwise, the calendar defaults to the selected date's month, or the current month.

Copy to clipboard

    <flux:calendar open-to="2026-05-01" />

[Week numbers](#week-numbers)
-----------------------------

Display the week number for each week.

Copy to clipboard

    <flux:calendar week-numbers />

[Localization](#localization)
-----------------------------

By default, the calendar will use the browser's locale (e.g. navigator.language).

You can override this behavior by setting the locale attribute to any valid locale string (e.g. fr for French, en-US for English, etc.):

Copy to clipboard

    <flux:calendar locale="ja-JP" />

The DateRange object
--------------------

Flux provides a specialized Flux\\DateRange object that extends the native CarbonPeriod class. This object provides a number of convenience methods to easily create and manage date ranges.

First, it's worth noting that most of the time, you will want to use wire:model.live to bind the range property to a DateRange object. This will automatically update the range property whenever the user selects a date range:

Copy to clipboard

    <flux:calendar wire:model.live="range" />

Now, in your component, you can type hint the range property as a DateRange object:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;}

Instantiation
-------------

You can initialize a DateRange object by passing a start and end date to the DateRange constructor from something like the mount method:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;    public function mount() {        $this->range = new DateRange(now(), now()->addDays(7));    }}

Persisting to the session
-------------------------

You can persist a DateRange object in the user's session by using the #\[Session\] attribute:

Copy to clipboard

    <?phpuse Livewire\Attributes\Session;use Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    #[Session]    public DateRange $range;}

Using with Eloquent
-------------------

You can use the DateRange object with Eloquent's whereBetween() method to filter queries by date range:

Copy to clipboard

    <?phpuse Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Order;use Flux\DateRange;class Dashboard extends Component {    public ?DateRange $range;    #[Computed]    public function orders() {        return $this->range            ? Order::whereBetween('created_at', $this->range)->get()            : Order::all();    }}

Available methods
-----------------

The DateRange object extends the native CarbonPeriod class, so it inherits all of its methods. Here are a few examples:

Copy to clipboard

    $range = new Flux\DateRange(    now()->subDays(1),    now()->addDays(1),);// Get the start and end dates as Carbon instances...$start = $range->start();$end = $range->end();// Check if the range contains a date...$range->contains(now());// Get the number of days in the range...$range->length();// Loop over the range by day...foreach ($range as $date) {    // $date is a Carbon instance...}// Get the range as an array of Carbon instances representing each day in the range...$range->toArray();

You can also use it anywhere Eloquent utilities expect a CarbonPeriod instance:

Copy to clipboard

    $orders = Order::whereBetween('created_at', $range)->get();

Reference
---------

### [flux:calendar](#fluxcalendar)

Prop

Description

wire:model

Binds the calendar to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

value

Selected date(s). Format depends on mode: single date (Y-m-d), multiple dates (comma-separated Y-m-d), or range (Y-m-d/Y-m-d).

mode

Selection mode. Options: single (default), multiple, range.

min

Earliest selectable date. Can be a date string or "today".

max

Latest selectable date. Can be a date string or "today".

size

Calendar size. Options: base (default), xs, sm, lg, xl, 2xl.

months

Number of months to display. Default: 1 for single/multiple modes, 2 for range mode.

min-range

Minimum number of days that can be selected in range mode.

max-range

Maximum number of days that can be selected in range mode.

navigation

If false, hides month navigation controls. Default: true.

static

If true, makes the calendar non-interactive (display-only). Default: false.

multiple

If true, enables multiple date selection mode. Default: false.

week-numbers

If true, displays week numbers in the calendar. Default: false.

selectable-header

If true, displays month and year dropdowns for quick navigation. Default: false.

with-today

If true, displays a button to quickly navigate to today's date. Default: false.

with-inputs

If true, displays date inputs at the top of the calendar for manual date entry. Default: false.

locale

Set the locale for the calendar. Examples: fr, en-US, ja-JP.

Attribute

Description

data-flux-calendar

Applied to the root element for styling and identification.

### [DateRange Object](#daterange-object)

A specialized object for handling date ranges when using \`mode="range"\`.

Method

Description

$range->start()

Get the start date as a Carbon instance.

$range->end()

Get the end date as a Carbon instance.

$range->days()

Get the number of days in the range.

$range->contains(date)

Check if the range contains a specific date.

$range->length()

Get the length of the range in days.

$range->toArray()

Get the range as an array with start and end keys.

$range->preset()

Get the current preset as a DateRangePreset enum value, if any.

Static Method

Description

DateRange::today()

Create a DateRange for today.

DateRange::yesterday()

Create a DateRange for yesterday.

DateRange::thisWeek()

Create a DateRange for the current week.

DateRange::lastWeek()

Create a DateRange for the previous week.

DateRange::last7Days()

Create a DateRange for the last 7 days.

DateRange::thisMonth()

Create a DateRange for the current month.

DateRange::lastMonth()

Create a DateRange for the previous month.

DateRange::thisYear()

Create a DateRange for the current year.

DateRange::lastYear()

Create a DateRange for the previous year.

DateRange::yearToDate()

Create a DateRange from January 1st to today.

---

## Callout

Callout
=======

Highlight important information or guide users toward key actions.

Upcoming maintenance

Our servers will be undergoing scheduled maintenance this Sunday from 2 AM - 5 AM UTC. Some services may be temporarily unavailable. [Learn more](#)

Copy to clipboard

    <flux:callout icon="clock">    <flux:callout.heading>Upcoming maintenance</flux:callout.heading>    <flux:callout.text>        Our servers will be undergoing scheduled maintenance this Sunday from 2 AM - 5 AM UTC. Some services may be temporarily unavailable.        <flux:callout.link href="#">Learn more</flux:callout.link>    </flux:callout.text></flux:callout>

[Icon inside heading](#icon-inside-heading)
-------------------------------------------

For a more compact layout, place the icon inside the heading by adding the icon prop to flux:callout.heading instead of the root flux:callout component.

Policy update

We've updated our Terms of Service and Privacy Policy. Please review them to stay informed.

Copy to clipboard

    <flux:callout>    <flux:callout.heading icon="newspaper">Policy update</flux:callout.heading>    <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to stay informed.</flux:callout.text></flux:callout>

[With actions](#with-actions)
-----------------------------

Add action buttons to your callout to provide users with clear next steps.

Subscription expiring soon

Your current plan will expire in 3 days. Renew now to avoid service interruption and continue accessing premium features.

Renew now [View plans](#)

Copy to clipboard

    <flux:callout icon="clock">    <flux:callout.heading>Subscription expiring soon</flux:callout.heading>    <flux:callout.text>Your current plan will expire in 3 days. Renew now to avoid service interruption and continue accessing premium features.</flux:callout.text>    <x-slot name="actions">        <flux:button>Renew now</flux:button>        <flux:button variant="ghost" href="/pricing">View plans</flux:button>    </x-slot></flux:callout>

[Inline actions](#inline-actions)
---------------------------------

Use the inline prop to display actions inline with the callout.

Your package is delayed

Track order -> Reschedule

Payment issue detected

Your last payment attempt failed. Update your billing details to prevent service interruption.

Update billing

Copy to clipboard

    <flux:callout icon="cube" variant="secondary" inline>    <flux:callout.heading>Your package is delayed</flux:callout.heading>    <x-slot name="actions">        <flux:button>Track order -></flux:button>        <flux:button variant="ghost">Reschedule</flux:button>    </x-slot></flux:callout><flux:callout icon="exclamation-triangle" variant="secondary" inline>    <flux:callout.heading>Payment issue detected</flux:callout.heading>    <flux:callout.text>Your last payment attempt failed. Update your billing details to prevent service interruption.</flux:callout.text>    <x-slot name="actions">        <flux:button>Update billing</flux:button>    </x-slot></flux:callout>

[Dismissible](#dismissible)
---------------------------

Add a close button, using the controls slot, to allow users to dismiss callouts they no longer care to see.

Callouts do not include built-in dismiss functionality. This is intentional—dismissal behavior depends on your app’s needs. You might want to remove it from the DOM on the frontend or persist the dismissal in a backend database.

Upcoming meeting

10:00 AM

Unusual login attempt

We detected a login from a new device in New York, USA. If this was you, no action is needed. If not, secure your account immediately.

Change password Review activity

Copy to clipboard

    <flux:callout icon="bell" variant="secondary" inline x-data="{ visible: true }" x-show="visible">    <flux:callout.heading class="flex gap-2 @max-md:flex-col items-start">Upcoming meeting <flux:text>10:00 AM</flux:text></flux:callout.heading>    <x-slot name="controls">        <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />    </x-slot></flux:callout><!-- Wrapping divs to add smooth exist transition... --><div x-data="{ visible: true }" x-show="visible" x-collapse>    <div x-show="visible" x-transition>        <flux:callout icon="finger-print" variant="secondary">            <flux:callout.heading>Unusual login attempt</flux:callout.heading>            <flux:callout.text>We detected a login from a new device in <span class="font-medium text-zinc-800 dark:text-white">New York, USA</span>. If this was you, no action is needed. If not, secure your account immediately.</flux:callout.text>            <x-slot name="actions">                <flux:button>Change password</flux:button>                <flux:button variant="ghost">Review activity</flux:button>            </x-slot>            <x-slot name="controls">                <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />            </x-slot>        </flux:callout>    </div></div>

[Variants](#variants)
---------------------

Use predefined variants to convey a specific tone or level of urgency.

Your account has been successfully created.

Your account is verified and ready to use.

Please verify your account to unlock all features.

Something went wrong. Try again or contact support.

Copy to clipboard

    <flux:callout variant="secondary" icon="information-circle" heading="Your account has been successfully created." /><flux:callout variant="success" icon="check-circle" heading="Your account is verified and ready to use." /><flux:callout variant="warning" icon="exclamation-circle" heading="Please verify your account to unlock all features." /><flux:callout variant="danger" icon="x-circle" heading="Something went wrong. Try again or contact support." />

[Colors](#colors)
-----------------

Use the color prop to change the color of the callout to match your use case.

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

You've received a new message.

View message

Copy to clipboard

    <flux:callout color="zinc" ... /><flux:callout color="red" ... /><flux:callout color="orange" ... /><flux:callout color="amber" ... /><flux:callout color="yellow" ... /><flux:callout color="lime" ... /><flux:callout color="green" ... /><flux:callout color="emerald" ... /><flux:callout color="teal" ... /><flux:callout color="cyan" ... /><flux:callout color="sky" ... /><flux:callout color="blue" ... /><flux:callout color="indigo" ... /><flux:callout color="violet" ... /><flux:callout color="purple" ... /><flux:callout color="fuchsia" ... /><flux:callout color="pink" ... /><flux:callout color="rose" ... />

[Custom icon](#custom-icon)
---------------------------

Use a custom icon to match your brand or specific use case using the icon slot.

Notification system updated

We've improved our notification system to deliver alerts faster and more reliably.

Copy to clipboard

    <flux:callout>    <x-slot name="icon">        <!-- Custom icon: https://lucide.dev/icons/alarm-clock -->        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alarm-clock"><circle cx="12" cy="13" r="8"/><path d="M12 9v4l2 2"/><path d="M5 3 2 6"/><path d="m22 6-3-3"/><path d="M6.38 18.7 4 21"/><path d="M17.64 18.67 20 21"/></svg>    </x-slot>    <flux:callout.heading>Notification system updated</flux:callout.heading>    <flux:callout.text>        <p>We've improved our notification system to deliver alerts faster and more reliably.</p>    </flux:callout.text></flux:callout>

Examples
--------

### [Feature spotlight](#feature-spotlight)

Call attention to a new feature or update.

Have a question?

Try our new AI assistant, Jeffrey. Let him handle tasks and answer questions for you. [Learn more](#)

Copy to clipboard

    <flux:callout icon="sparkles" color="purple">    <flux:callout.heading>Have a question?</flux:callout.heading>    <flux:callout.text>        Try our new AI assistant, Jeffrey. Let him handle tasks and answer questions for you.        <flux:callout.link href="#">Learn more</flux:callout.link>    </flux:callout.text></flux:callout>

### [Premium upsell](#premium-upsell)

Encourage users to upgrade.

API access is restricted

Get access to all of our premium features and benefits.

Upgrade to Pro ->

Copy to clipboard

    <flux:callout icon="shield-check" color="blue" inline>    <flux:callout.heading>API access is restricted</flux:callout.heading>    <flux:callout.text>Get access to all of our premium features and benefits.</flux:callout.text>    <x-slot name="actions" class="@md:h-full m-0!">        <flux:button>Upgrade to Pro -></flux:button>    </x-slot></flux:callout>

### [Upgrade offer](#upgrade-offer)

Compact reminders to take advantage of special offers.

You could save $4,900/yr on annual billing.

Switch now ->

Copy to clipboard

    <flux:callout icon="banknotes" color="lime" inline>    <flux:callout.heading>You could save $4,900/yr on annual billing.</flux:callout.heading>    <x-slot name="actions">        <flux:button>Switch now -></flux:button>    </x-slot></flux:callout>

### [Engagement prompt](#engagement-prompt)

Nudge users toward an action or feature.

Team collaboration

Available with Pro

Share projects, manage permissions, and collaborate in real time with your team. Upgrade now to access these features.

Invite member Manage team

Copy to clipboard

    <flux:callout variant="secondary" icon="user-group">    <flux:callout.heading>        Team collaboration <flux:badge color="purple" size="sm" inset="top bottom">Available with Pro</flux:badge>    </flux:callout.heading>    <flux:callout.text>        <p>Share projects, manage permissions, and collaborate in real time with your team. Upgrade now to access these features.</p>    </flux:callout.text>    <x-slot name="actions">        <flux:button>Invite member</flux:button>        <flux:button variant="ghost" class="@max-md:hidden">Manage team</flux:button>    </x-slot></flux:callout>

Related components
------------------

[

Toast

Display temporary notifications with a toast



](/components/toast)[

Card

Display content in a card component



](/components/card)

Reference
---------

### [flux:callout](#fluxcallout)

Prop

Description

icon

Name of the icon displayed next to the heading (e.g., clock). [Explore icons](/components/icon)

icon:variant

Variant of the icon displayed next to the heading (e.g., outline). [Explore icon variants](/components/icon#variants)

variant

Options: secondary, success, warning, danger. Default: secondary

color

Custom color (e.g., red, blue). [View available Tailwind colors ->](https://tailwindcss.com/docs/colors)

inline

If true, actions appear inline. Default: false.

heading

Shorthand for flux:callout.heading.

text

Shorthand for flux:callout.text.

Slot

Description

icon

Custom icon displayed next to the heading.

actions

Buttons or links inside the callout (flux:callout.button).

controls

Extra UI elements placed at the top right of the callout (e.g., close button).

### [flux:callout.heading](#fluxcalloutheading)

Prop

Description

icon

Moves the icon inside the heading instead of the callout root.

icon:variant

Variant of the icon displayed next to the heading (e.g., outline). [Explore icon variants](/components/icon#variants)

Slot

Description

icon

Custom icon displayed next to the heading.

### [flux:callout.text](#fluxcallouttext)

Slot

Description

default

Text content inside the callout.

### [flux:callout.link](#fluxcalloutlink)

Prop

Description

href

The URL the link points to.

external

If true, the link opens in a new tab. Default: false.

---

## Card

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Card
====

A container for related content, such as a form, alert, or data list.

Log in to your account

Welcome back!

Email

Password [Forgot password?](#)

Log in Sign up for a new account

Copy to clipboard

    <flux:card class="space-y-6">    <div>        <flux:heading size="lg">Log in to your account</flux:heading>        <flux:text class="mt-2">Welcome back!</flux:text>    </div>    <div class="space-y-6">        <flux:input label="Email" type="email" placeholder="Your email address" />        <flux:field>            <div class="mb-3 flex justify-between">                <flux:label>Password</flux:label>                <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>            </div>            <flux:input type="password" placeholder="Your password" />            <flux:error name="password" />        </flux:field>    </div>    <div class="space-y-2">        <flux:button variant="primary" class="w-full">Log in</flux:button>        <flux:button variant="ghost" class="w-full">Sign up for a new account</flux:button>    </div></flux:card>

[Small card](#small-card)
-------------------------

Use the small card variant for compact content like notifications, alerts, or brief summaries.

[

Latest on our blog

Stay up to date with our latest insights, tutorials, and product updates.



](#)

Copy to clipboard

    <a href="#" aria-label="Latest on our blog">    <flux:card size="sm" class="hover:bg-zinc-50 dark:hover:bg-zinc-700">        <flux:heading class="flex items-center gap-2">Latest on our blog <flux:icon name="arrow-up-right" class="ml-auto text-zinc-400" variant="micro" /></flux:heading>        <flux:text class="mt-2">Stay up to date with our latest insights, tutorials, and product updates.</flux:text>    </flux:card></a>

[Header actions](#header-actions)
---------------------------------

Use the [button component](/components/button) to add actions to the header.

Are you sure?

Your post will be deleted permanently.

This action cannot be undone.

Undo Delete

Copy to clipboard

    <flux:card class="space-y-6">    <div class="flex">        <div class="flex-1">            <flux:heading size="lg">Are you sure?</flux:heading>            <flux:text class="mt-2">                <p>Your post will be deleted permanently.</p>                <p>This action cannot be undone.</p>            </flux:text>        </div>        <div class="-mx-2 -mt-2">            <flux:button variant="ghost" size="sm" icon="x-mark" inset="top right bottom" />        </div>    </div>    <div class="flex gap-4">        <flux:spacer />        <flux:button variant="ghost">Undo</flux:button>        <flux:button variant="danger">Delete</flux:button>    </div></flux:card>

[Simple card](#simple-card)
---------------------------

Let's be honest, a card is just a div with a border and some padding.

Are you sure?

Your post will be deleted permanently.

This action cannot be undone.

Delete

Copy to clipboard

    <flux:card>    <flux:heading size="lg">Are you sure?</flux:heading>    <flux:text class="mt-2 mb-4">        <p>Your post will be deleted permanently.</p>        <p>This action cannot be undone.</p>    </flux:text>    <flux:button variant="danger">Delete</flux:button></flux:card>

Related components
------------------

[

Heading

Create hierarchical section headings for content



](/components/heading)[

Text

Format paragraphs and textual content with consistent styling



](/components/text)

Reference
---------

### [flux:card](#fluxcard)

Slot

Description

default

Content to display within the card. Can include headings, text, forms, buttons, and other components.

CSS

Description

class

Additional CSS classes applied to the card. Common uses: space-y-6 for spacing between child elements, max-w-md for width control, p-0 to remove padding.

Attribute

Description

data-flux-card

Applied to the root element for styling and identification.

---

## Chart

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Chart
=====

Flux's Chart component is a lightweight, zero-dependency tool for building charts in your Livewire applications. It is designed to be simple but extremely flexible, so that you can assemble and style your charts exactly as you need them.

Currently, Flux supports line and area charts. Additional chart types are planned for future releases.

Copy to clipboard

    <flux:chart wire:model="data" class="aspect-3/1">    <flux:chart.svg>        <flux:chart.line field="visitors" class="text-pink-500 dark:text-pink-400" />        <flux:chart.axis axis="x" field="date">            <flux:chart.axis.line />            <flux:chart.axis.tick />        </flux:chart.axis>        <flux:chart.axis axis="y">            <flux:chart.axis.grid />            <flux:chart.axis.tick />        </flux:chart.axis>        <flux:chart.cursor />    </flux:chart.svg>    <flux:chart.tooltip>        <flux:chart.tooltip.heading field="date" :format="['year' => 'numeric', 'month' => 'numeric', 'day' => 'numeric']" />        <flux:chart.tooltip.value field="visitors" label="Visitors" />    </flux:chart.tooltip></flux:chart>

Data structure
--------------

Flux charts expect a structured array of data, typically provided via wire:model or passed as a value prop. Each data point should be an associative array with named fields:

Copy to clipboard

    <?phpuse Livewire\Component;class Dashboard extends Component{    public array $data = [        ['date' => '2025-04-03', 'visitors' => 267],        ['date' => '2025-04-02', 'visitors' => 259],        ['date' => '2025-04-01', 'visitors' => 269],        // ...    ];}

If you've stored this data as a public property, you can use wire:model to bind the data to the chart:

Copy to clipboard

    <flux:chart wire:model="data" />

Otherwise, you can pass data in any form directly into the :value prop:

Copy to clipboard

    <flux:chart :value="$this->data" />

For things like simple line charts with no axes, you can pass a single array of values as well:

Copy to clipboard

    <flux:chart :value="[1, 2, 3, 4, 5]" />

Examples
--------

Line chart
----------

To create a line chart, you can include the <flux:chart.line> component in the <flux:chart.svg> component:

Memory usage

Copy to clipboard

    <flux:chart wire:model="data" class="aspect-[3/1]">    <flux:chart.svg>        <flux:chart.line field="memory" class="text-pink-500" />        <flux:chart.point field="memory" class="text-pink-400" />        <flux:chart.axis axis="x" field="date">            <flux:chart.axis.tick />            <flux:chart.axis.line />        </flux:chart.axis>        <flux:chart.axis axis="y" tick-values="[0, 128, 256, 384, 512]" :format="['style' => 'unit', 'unit' => 'megabyte']">            <flux:chart.axis.grid />            <flux:chart.axis.tick />        </flux:chart.axis>    </flux:chart.svg></flux:chart>

As you can see above, you can also render circular points on top of the line using the <flux:chart.point> component.

Area chart
----------

Similar to a line chart but with a filled area beneath the line. Great for showing cumulative values or emphasizing volume.

Stock price

Copy to clipboard

    <flux:chart wire:model="data" class="aspect-3/1">    <flux:chart.svg>        <flux:chart.line field="stock" class="text-blue-500 dark:text-blue-400" curve="none" />        <flux:chart.area field="stock" class="text-blue-200/50 dark:text-blue-400/30" curve="none" />        <flux:chart.axis axis="y" position="right" tick-prefix="$" :format="[            'notation' => 'compact',            'compactDisplay' => 'short',            'maximumFractionDigits' => 1,        ]">            <flux:chart.axis.grid />            <flux:chart.axis.tick />        </flux:chart.axis>        <flux:chart.axis axis="x" field="date">            <flux:chart.axis.tick />            <flux:chart.axis.line />        </flux:chart.axis>    </flux:chart.svg></flux:chart>

Multiple lines
--------------

You can plot multiple lines in the same chart by including multiple <flux:chart.line> components. This helps compare different data series against each other.

Instagram

Twitter

Facebook

Copy to clipboard

    <flux:chart wire:model="data">    <flux:chart.viewport class="min-h-[20rem]" >        <flux:chart.svg>            <flux:chart.line field="twitter" class="text-blue-500" curve="none" />            <flux:chart.point field="twitter" class="text-blue-500" r="6" stroke-width="3" />            <flux:chart.line field="facebook" class="text-red-500" curve="none" />            <flux:chart.point field="facebook" class="text-red-500" r="6" stroke-width="3" />            <flux:chart.line field="instagram" class="text-green-500" curve="none" />            <flux:chart.point field="instagram" class="text-green-500" r="6" stroke-width="3" />            <flux:chart.axis axis="x" field="date">                <flux:chart.axis.tick />                <flux:chart.axis.line />            </flux:chart.axis>            <flux:chart.axis axis="y" tick-start="0" tick-end="1" :format="[                'style' => 'percent',                'minimumFractionDigits' => 0,                'maximumFractionDigits' => 0,            ]">                <flux:chart.axis.grid />                <flux:chart.axis.tick />            </flux:chart.axis>        </flux:chart.svg>    </flux:chart.viewport>    <div class="flex justify-center gap-4 pt-4">        <flux:chart.legend label="Instagram">            <flux:chart.legend.indicator class="bg-green-400" />        </flux:chart.legend>        <flux:chart.legend label="Twitter">            <flux:chart.legend.indicator class="bg-blue-400" />        </flux:chart.legend>        <flux:chart.legend label="Facebook">            <flux:chart.legend.indicator class="bg-red-400" />        </flux:chart.legend>    </div></flux:chart>

You might have noticed that the above example includes a <flux:chart.viewport> component. This is used to constrain the chart SVG within the chart component so that you can render siblings like legends or summaries above or below it.

Live summary
------------

Flux charts support live summaries, which are updated as the user hovers over the chart. To enable this feature, you can include the <flux:chart.summary> component in the <flux:chart> component:

Copy to clipboard

    <flux:card>    <flux:chart class="grid gap-6" wire:model="data">        <flux:chart.summary class="flex gap-12">            <div>                <flux:text>Today</flux:text>                <flux:heading size="xl" class="mt-2 tabular-nums">                    <flux:chart.summary.value field="sales" :format="['style' => 'currency', 'currency' => 'USD']" />                </flux:heading>                <flux:text class="mt-2 tabular-nums">                    <flux:chart.summary.value field="date" :format="['hour' => 'numeric', 'minute' => 'numeric', 'hour12' => true]" />                </flux:text>            </div>            <div>                <flux:text>Yesterday</flux:text>                <flux:heading size="lg" class="mt-2 tabular-nums">                    <flux:chart.summary.value field="yesterday" :format="['style' => 'currency', 'currency' => 'USD']" />                </flux:heading>            </div>        </flux:chart.summary>        <flux:chart.viewport class="aspect-[3/1]">            <flux:chart.svg>                <flux:chart.line field="yesterday" class="text-zinc-300 dark:text-white/40" stroke-dasharray="4 4" curve="none" />                <flux:chart.line field="sales" class="text-sky-500 dark:text-sky-400" curve="none" />                <flux:chart.axis axis="x" field="date">                    <flux:chart.axis.grid />                    <flux:chart.axis.tick />                    <flux:chart.axis.line />                </flux:chart.axis>                <flux:chart.axis axis="y">                    <flux:chart.axis.tick />                </flux:chart.axis>                <flux:chart.cursor />            </flux:chart.svg>        </flux:chart.viewport>    </flux:chart></flux:card>

Sparkline
---------

A compact, single-line chart used in tables or dashboards for quick visual insights. Ideal for stock prices, memory usage, or other small-scale trends.

Stock

Price

Change

Trend

AAPL

$193.45

+2.4%

MSFT

$338.12

+1.8%

TSLA

$242.68

\-3.2%

GOOGL

$129.87

+0.9%

Copy to clipboard

    <flux:chart :value="[15, 18, 16, 19, 22, 25, 28, 25, 29, 28, 32, 35]" class="w-[5rem] aspect-[3/1]">    <flux:chart.svg gutter="0">        <flux:chart.line class="text-green-500 dark:text-green-400" />    </flux:chart.svg></flux:chart>

You might have noticed the gutter attribute on the <flux:chart.svg> component. This is because by default, the chart will be rendered with a padding of 8px on all sides. This is to prevent overflowing contents of the chart (like tick labels or stroke lines) from being cut off at the edges of the container.

For simple charts like a sparkline, you don't want that extra padding, so you can set the gutter to 0 to remove it.

[Read more about the gutter prop ->](#chart-padding)

Dashboard stat
--------------

A small card displaying a key metric with an embedded chart in the background. Useful for KPIs like revenue, active users, or system health.

Revenue

$12,345

Copy to clipboard

    <flux:card class="overflow-hidden min-w-[12rem]">    <flux:text>Revenue</flux:text>    <flux:heading size="xl" class="mt-2 tabular-nums">$12,345</flux:heading>    <flux:chart class="-mx-8 -mb-8 h-[3rem]" :value="[10, 12, 11, 13, 15, 14, 16, 18, 17, 19, 21, 20]">        <flux:chart.svg gutter="0">            <flux:chart.line class="text-sky-200 dark:text-sky-400" />            <flux:chart.area class="text-sky-100 dark:text-sky-400/30" />        </flux:chart.svg>    </flux:chart></flux:card>

Chart padding
-------------

By default, the chart will be rendered with a padding of 8px on all sides. This is to prevent overflowing contents of the chart (like tick labels or stroke lines) from being cut off at the edges of the container.

You can control this by setting the gutter attribute on the <flux:chart.svg> component:

Here's an example of adding the following padding to the chart:

Copy to clipboard

    <flux:chart>    <flux:chart.svg gutter="12 0 12 8">        <!-- ... -->    </flux:chart.svg></flux:chart>

The gutter attribute accepts between one and four values, which correspond to the top, right, bottom, and left padding respectively. Similar to the padding property shorthand in CSS.

The example above will result in the following padding:

*   **Top:** 12px
*   **Right:** 0px
*   **Bottom:** 12px
*   **Left:** 8px

Axis scale
----------

You can configure the scale of an axis and its ticks by setting the scale attribute on the <flux:chart.axis> component:

Copy to clipboard

    <flux:chart.axis axis="y" scale="linear">    <!-- ... --></flux:chart.axis>

There are three available types of scales:

*   categorical: For categorical data like names or categories.
*   linear: For numeric data like stock prices or temperatures.
*   time: For date and time data

The "y" axis is linear by default, but you can change it to a time axis by setting the scale attribute to time.

The "x" axis will automatically use a time scale if the data is date or time values. Otherwise, it will use a categorical scale.

Axis lines
----------

By default, axes do not include a visible baseline. You can add an axis line using <flux:chart.axis.line> inside the corresponding axis:

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <flux:chart.axis axis="x">        <!-- Horizontal "X" axis line: -->        <flux:chart.axis.line />    </flux:chart.axis>    <flux:chart.axis axis="y">        <!-- Vertical "Y" axis line: -->        <flux:chart.axis.line />    </flux:chart.axis></flux:chart.svg>

**Styling axis lines**

Because the axis line is rendered as a <line> element, you can style it using any of the SVG attributes that are available for the <line> element.

Copy to clipboard

    <!-- A dark gray axis line that is 2px wide and has a gray color: --><flux:chart.axis.line class="text-zinc-800" stroke-width="2" />

Zero line
---------

The zero line is the line that represents the zero value on the axis. It will only be visible if the axis includes a negative value.

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <!-- Zero line: -->    <flux:chart.zero-line /></flux:chart.svg>

**Styling the zero line**

Because the zero line is rendered as a <line> element, you can style it using any of the SVG attributes that are available for the <line> element.

Copy to clipboard

    <!-- A dark gray zero line that is 2px wide and has a gray color: --><flux:chart.zero-line class="text-zinc-800" stroke-width="2" />

Grid lines
----------

You can render horizontal and vertical grid lines by adding the <flux:chart.axis.grid> component to the appropriate axis:

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <flux:chart.axis axis="x">        <!-- Vertical grid lines: -->        <flux:chart.axis.grid />    </flux:chart.axis>    <flux:chart.axis axis="y">        <!-- Horizontal grid lines: -->        <flux:chart.axis.grid />    </flux:chart.axis></flux:chart.svg>

**Styling grid lines**

Because the grid lines are rendered as a <line> element, you can style them using any of the SVG attributes that are available for the <line> element.

Copy to clipboard

    <!-- A dashed grid line that is 2px wide and has a gray color: --><flux:chart.axis.grid class="text-zinc-200/50" stroke-width="2" stroke-dasharray="4,4" />

Ticks
-----

You can render tick mark lines and labels by adding the <flux:chart.axis.mark> and/or <flux:chart.axis.tick> components to the appropriate axis:

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <flux:chart.axis axis="x">        <!-- X axis tick mark lines: -->        <flux:chart.axis.mark />        <!-- X axis tick labels: -->        <flux:chart.axis.tick />    </flux:chart.axis>    <flux:chart.axis axis="y">        <!-- Y axis tick mark lines: -->        <flux:chart.axis.mark />        <!-- Y axis tick labels: -->        <flux:chart.axis.tick />    </flux:chart.axis></flux:chart.svg>

**Styling tick mark lines**

The tick mark component is a simple wrapper around the <line> SVG element. You can customize the length, width, and color of the tick mark lines using plain CSS and SVG attributes:

Copy to clipboard

    <!-- A tick mark line that is 10px long, 2px wide, and has a gray color: --><flux:chart.axis.mark class="text-zinc-300" stroke-width="2" y1="0" y2="10" />

**Styling tick labels**

The <flux:chart.axis.tick> component is a simple wrapper around the <text> SVG element. You can customize the font size, color, and position of the tick labels using plain CSS and SVG attributes:

Copy to clipboard

    <!-- A tick label that is 12px, has a blue color, is center aligned, and is 2.5rem from the axis line: --><flux:chart.axis.tick class="text-xs text-blue-500" text-anchor="middle" dy="2.5rem"  />

Tick frequency
--------------

You can influence the number of ticks on an axis by setting the tick-count attribute:

**Setting the tick count**

Copy to clipboard

    <flux:chart.axis axis="y" tick-count="5">    <!-- ... --></flux:chart.axis>

Note that the tick-count attribute is only a target number, and the actual number of ticks may vary based on the range of values on the axis.

**Setting the tick start**

By default, the tick marks will start at zero, unless negative values are present. You can override this by setting the tick-start attribute:

Copy to clipboard

    <flux:chart.axis axis="y" tick-start="min">    <!-- ... --></flux:chart.axis>

The available values for tick-start are:

*   auto: Automatically determine the starting tick value.
*   min: Start at the minimum value on the axis.
*   0: Start at zero.
*   123: Start at 123 (or any other number).

**Setting the tick end**

By default, the tick marks will end at the next tick mark after the maximum value on the axis. You can override this by setting the tick-end attribute:

Copy to clipboard

    <flux:chart.axis axis="y" tick-end="max">    <!-- ... --></flux:chart.axis>

The available values for tick-end are:

*   auto: Automatically determine the ending tick value.
*   max: End at the maximum value on the axis.
*   123: End at 123 (or any other number).

**Setting explicit tick values**

You can also set explicit tick values by passing an array of values to the tick-values attribute:

Copy to clipboard

    <flux:chart.axis axis="y" tick-values="[0, 128, 256, 384, 512]" tick-suffix="MB">    <!-- ... --></flux:chart.axis>

Tick formatting
---------------

The tick labels can be formatted using the format attribute.

Under-the-hood, the format attribute is passed to the Intl.NumberFormat constructor.

This means that you can use any of the formatting options that are available for the Intl.NumberFormat constructor.

[See the MDN documentation for more information on the formatting options ->](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat/NumberFormat)

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <!-- Format the X axis tick labels to display the month and day: -->    <flux:chart.axis axis="x" :format="['month' => 'long', 'day' => 'numeric']">        <!-- X axis tick labels: -->        <flux:chart.axis.tick />    </flux:chart.axis>    <!-- Format the Y axis tick labels to display the value in USD: -->    <flux:chart.axis axis="y" :format="['style' => 'currency', 'currency' => 'USD']">        <!-- Y axis tick labels: -->        <flux:chart.axis.tick />    </flux:chart.axis></flux:chart.svg>

**Setting a tick prefix**

You can set a tick prefix by passing a string to the tick-prefix attribute:

Copy to clipboard

    <flux:chart.axis axis="y" tick-prefix="$">    <!-- ... --></flux:chart.axis>

**Setting a tick suffix**

You can set a tick suffix by passing a string to the tick-suffix attribute:

Copy to clipboard

    <flux:chart.axis axis="y" tick-suffix="MB">    <!-- ... --></flux:chart.axis>

Cursor
------

Adds a vertical guide when hovering over the chart to highlight values at specific points. Customizable with stroke styles, colors, and dash patterns.

To enable a cursor, simply include <flux:chart.cursor> inside <flux:chart.svg>:

Copy to clipboard

    <flux:chart.svg>    <!-- ... -->    <flux:chart.cursor /></flux:chart.svg>

**Styling the cursor**

Because the cursor is rendered as a <line> element, you can style it using any of the SVG attributes that are available for the <line> element.

Copy to clipboard

    <!-- A dashed, black cursor that is 1px wide: --><flux:chart.cursor class="text-zinc-800" stroke-width="1" stroke-dasharray="4,4" />

Tooltip
-------

Displays contextual data on hover. Supports multiple values and custom formatting for better readability.

To enable tooltips, include <flux:chart.tooltip> inside <flux:chart>:

Copy to clipboard

    <flux:chart>    <flux:chart.svg>        <!-- ... -->    </flux:chart.svg>    <flux:chart.tooltip>        <flux:chart.tooltip.heading field="date" />        <flux:chart.tooltip.value field="visitors" label="Visitors" />        <flux:chart.tooltip.value field="views" label="Views" :format="['notation' => 'compact']" />    </flux:chart.tooltip></flux:chart>

**Customizing tooltip content**

You can display multiple values and format numbers dynamically.

Copy to clipboard

    <flux:chart.tooltip>    <flux:chart.tooltip.heading field="date" />    <flux:chart.tooltip.value field="visitors" label="Visitors" />    <flux:chart.tooltip.value field="views" label="Page Views" :format="['notation' => 'compact']" /></flux:chart.tooltip>

Legend
------

Identifies multiple data series in the chart. Each legend item corresponds to a different dataset.

When using a legend, you will need to include a <flux:chart.viewport> component to wrap the <flux:chart.svg> component so that the legend is rendered outside of the chart:

Copy to clipboard

    <flux:chart wire:model="data">    <flux:chart.viewport class="aspect-3/1">        <flux:chart.svg>            <flux:chart.line class="text-blue-500" field="visitors" />            <flux:chart.line class="text-red-500" field="views" />        </flux:chart.svg>    </flux:chart.viewport>    <div class="flex justify-center gap-4 pt-4">        <flux:chart.legend label="Visitors">            <flux:chart.legend.indicator class="bg-blue-400" />        </flux:chart.legend>        <flux:chart.legend label="Views">            <flux:chart.legend.indicator class="bg-red-400" />        </flux:chart.legend>    </div></flux:chart>

Summary
-------

Displays a single value from the dataset in a bold, easy-to-read format. Great for key performance indicators.

To enable a summary, include <flux:chart.summary> inside <flux:chart>:

Copy to clipboard

    <flux:chart wire:model="data">    <flux:chart.summary>        <flux:chart.summary.value field="visitors" :format="['notation' => 'compact']" />    </flux:chart.summary>    <flux:chart.viewport class="aspect-[3/1]">        <!-- ... -->    </flux:chart.viewport></flux:chart>

Notice that you will need to include a <flux:chart.viewport> component to wrap the <flux:chart.svg> component so that the summary is rendered outside of the chart.

**Setting a fallback value**

You can set a fallback value by passing a string to the fallback attribute:

Copy to clipboard

    <flux:chart.summary.value field="visitors" fallback="1200" />

This will be the value that is displayed if a data point is not being hovered over.

Formatting
----------

You can customize how numbers and dates appear in your charts to make them more readable. Whether it's formatting currency, percentages, or large numbers, Flux charts let you easily control how values are displayed using the :format prop.

Flux handles formatting for you behind the scenes using the Intl.NumberFormat and Intl.DateTimeFormat API, a built-in browser feature that ensures numbers and dates are displayed consistently based on locale and formatting rules. Just pass your desired format options to the :format prop, and Flux will apply them for you.

Formatting numbers
------------------

You can format numbers by passing an array of formatting options to the :format prop.

Copy to clipboard

    <flux:chart.axis axis="y" :format="['style' => 'currency', 'currency' => 'USD']" />

**Commonly used formatting options**

Here are some commonly used number formatting options you will likely need:

Description

Example Input

Example Output

Format Array

Currency (USD)

1234.56

\['style' => 'currency', 'currency' => 'USD'\]

Currency (EUR)

1234.56

\['style' => 'currency', 'currency' => 'EUR'\]

Percent

0.85

\['style' => 'percent'\]

Compact Number

1000000

\['notation' => 'compact'\]

Scientific

123456789

\['notation' => 'scientific'\]

Fixed Decimal

3.1415926535

\['maximumFractionDigits' => 2\]

Thousands Separator

1234567

\['useGrouping' => true\]

Custom Unit

50

\['style' => 'unit', 'unit' => 'megabyte'\]

Formatting dates
----------------

You can format dates by passing an array of formatting options to the :format prop.

Copy to clipboard

    <flux:chart.axis axis="x" field="date" :format="['month' => 'long', 'day' => 'numeric']" />

**Commonly used date formatting options**

Here are some commonly used date formatting options you will likely need:

Description

Example Input

Example Output

Format Array

Full Date

2024-03-15

\['dateStyle' => 'full'\]

Month and Day

2024-03-15

\['month' => 'long', 'day' => 'numeric'\]

Short Month

2024-03-15

\['month' => 'short', 'day' => 'numeric'\]

Time Only

2024-03-15 14:30

\['hour' => 'numeric', 'minute' => 'numeric', 'hour12' => true\]

24-hour Time

2024-03-15 14:30

\['hour' => '2-digit', 'minute' => '2-digit', 'hour12' => false\]

Weekday

2024-03-15

\['weekday' => 'long'\]

Short Date

2024-03-15

\['month' => '2-digit', 'day' => '2-digit', 'year' => '2-digit'\]

Year Only

2024-03-15

\['year' => 'numeric'\]

Additional resources
--------------------

For more detailed information about formatting options, refer to:

*   [MDN Documentation on Intl.DateTimeFormat](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/DateTimeFormat)
*   [MDN Documentation on Intl.NumberFormat](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat)

Reference
---------

### [flux:chart](#fluxchart)

Prop

Description

wire:model

Binds the chart to a Livewire property containing the data to display. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

value

Array of data points for the chart. Each point should be an associative array with named fields. Used when not binding with wire:model.

curve

Default line curve type for all lines in the chart. Options: smooth (default), none.

Slot

Description

default

Chart components to render. Typically contains a flux:chart.svg component that defines the chart structure.

CSS

Description

class

Additional CSS classes applied to the chart container. Common uses: aspect-3/1 for aspect ratio, h-64 for fixed height.

Attribute

Description

data-flux-chart

Applied to the root element for styling and identification.

### [flux:chart.svg](#fluxchartsvg)

Container for the chart's SVG elements. This component must be included within a \`flux:chart\` to render the chart.

Slot

Description

default

Chart visualization components like lines, areas, axes, and interactive elements.

### [flux:chart.line](#fluxchartline)

Prop

Description

field

Name of the data field to plot on the y-axis. Required.

curve

Line curve type. Options: smooth (default), none.

CSS

Description

class

Additional CSS classes applied to the line. Common use: text-{color} for line color.

### [flux:chart.area](#fluxchartarea)

Prop

Description

field

Name of the data field to plot on the y-axis. Required.

curve

Area curve type. Options: smooth (default), none.

CSS

Description

class

Additional CSS classes applied to the area. Common use: fill-{color}/20 for fill color.

### [flux:chart.point](#fluxchartpoint)

Adds points (dots) to mark data points on a line or area chart.

Prop

Description

field

Name of the data field to plot points for. Required.

CSS

Description

class

Additional CSS classes applied to the points. Common use: fill-{color} for point fill color, r attribute for point radius.

### [flux:chart.axis](#fluxchartaxis)

Prop

Description

axis

Axis to configure. Options: x, y. Required.

field

For x-axis, the data field to use for labels.

format

Date/number formatting options for axis labels. See [Formatting](#formatting) for more details.

### [flux:chart.axis.mark](#fluxchartaxismark)

Adds tick marks to the chart. Must be used within a \`flux:chart.axis\` component.

Prop

Description

position

Position of the tick marks. Options: top, bottom, left, right.

CSS

Description

class

Additional CSS classes applied to the tick marks. Common use: text-{color} for line color, stroke-width="1" for line thickness.

### [flux:chart.axis.line](#fluxchartaxisline)

Adds an axis line to the chart. Must be used within a \`flux:chart.axis\` component.

CSS

Description

class

Additional CSS classes applied to the axis line. Common use: text-{color} for line color, stroke-width="1" for line thickness.

### [flux:chart.axis.grid](#fluxchartaxisgrid)

Adds gridlines to the chart. Must be used within a \`flux:chart.axis\` component.

CSS

Description

class

Additional CSS classes applied to the gridlines. Common use: text-{color} for line color, stroke-width="{width}" for line thickness.

### [flux:chart.axis.tick](#fluxchartaxistick)

Adds tick marks and labels to an axis. Must be used within a \`flux:chart.axis\` component.

Prop

Description

format

Date/number formatting options for tick labels. See [Formatting](#formatting) for more details.

CSS

Description

class

Additional CSS classes applied to the tick marks and labels. Common use: text-{color} for label color, font-{weight} for label weight.

### [flux:chart.zero-line](#fluxchartzero-line)

Adds a horizontal line at y=0. Useful for charts that contain both positive and negative values.

CSS

Description

class

Additional CSS classes applied to the zero line. Common use: text-{color} for line color, stroke-width="{width}" for line thickness.

### [flux:chart.tooltip](#fluxcharttooltip)

Prop

Description

field

Data field to display in the tooltip.

format

Date/number formatting options for tooltip values.

### [flux:chart.tooltip.heading](#fluxcharttooltipheading)

Prop

Description

field

Data field to display in the tooltip heading.

format

Date/number formatting options for tooltip values. See [Formatting](#formatting) for more details.

### [flux:chart.tooltip.value](#fluxcharttooltipvalue)

Prop

Description

field

Data field to display in the tooltip.

format

Date/number formatting options for tooltip values. See [Formatting](#formatting) for more details.

### [flux:chart.cursor](#fluxchartcursor)

Adds an interactive cursor that follows mouse movement over the chart. Activates tooltips when present.

CSS

Description

class

Additional CSS classes applied to the cursor line.

### [flux:chart.summary](#fluxchartsummary)

Adds a summary section typically shown above the chart. Shows the latest values or values at cursor position.

Slot

Description

default

Content to display in the summary section. Can include flux:chart.value components to display specific data values.

### [flux:chart.summaryvalue](#fluxchartsummaryvalue)

Displays a specific data value, typically used within a \`flux:chart.summary\` component.

Prop

Description

field

Data field to display.

fallback

Fallback text to display if the value is not found or cannot be formatted.

format

Date/number formatting options. See [Formatting](#formatting) for more details.

### [flux:chart.legend](#fluxchartlegend)

Prop

Description

field

Data field this legend item represents.

label

Label text for the legend item.

format

Date/number formatting options. See [Formatting](#formatting) for more details.

Slot

Description

default

Content to display in the legend. Can include arbitrary content, including flux:chart.legend.indicator components.

---

## Checkbox

Checkbox
========

Select one or multiple options from a set.

I agree to the terms and conditions

Copy to clipboard

    <flux:checkbox wire:model="terms" label="I agree to the terms and conditions" />

[Checkbox group](#checkbox-group)
---------------------------------

Organize a list of related checkboxes vertically.

When using checkbox groups, you can add wire:model to the group element or the individual checkboxes.

NotificationsPush notifications

Email

In-app alerts

SMS

Copy to clipboard

    <flux:checkbox.group wire:model="notifications" label="Notifications">    <flux:checkbox label="Push notifications" value="push" checked />    <flux:checkbox label="Email" value="email" checked />    <flux:checkbox label="In-app alerts" value="app" />    <flux:checkbox label="SMS" value="sms" /></flux:checkbox.group>

[With descriptions](#with-descriptions)
---------------------------------------

Align descriptions for each checkbox directly below its label.

Subscription preferencesNewsletter Receive our monthly newsletter with the latest updates and offers.

Product updates Stay informed about new features and product updates.

Event invitations Get invitations to our exclusive events and webinars.

Copy to clipboard

    <flux:checkbox.group wire:model="subscription" label="Subscription preferences">    <flux:checkbox checked        value="newsletter"        label="Newsletter"        description="Receive our monthly newsletter with the latest updates and offers."    />    <flux:checkbox        value="updates"        label="Product updates"        description="Stay informed about new features and product updates."    />    <flux:checkbox        value="invitations"        label="Event invitations"        description="Get invitations to our exclusive events and webinars."    /></flux:checkbox.group>

[Horizontal fieldset](#horizontal-fieldset)
-------------------------------------------

Organize a group of related checkboxes horizontally.

Languages Choose the languages you want to support.

English

Spanish

French

German

Copy to clipboard

    <flux:fieldset>    <flux:legend>Languages</flux:legend>    <flux:description>Choose the languages you want to support.</flux:description>    <div class="flex gap-4 *:gap-x-2">        <flux:checkbox checked value="english" label="English" />        <flux:checkbox checked value="spanish" label="Spanish" />        <flux:checkbox value="french" label="French" />        <flux:checkbox value="german" label="German" />    </div></flux:fieldset>

[Check-all](#check-all)
-----------------------

Control a group of checkboxes with a single checkbox.

Name

Caleb Porzio

Hugo Sainte-Marie

Keith Damiani

Copy to clipboard

    <flux:checkbox.group>    <flux:checkbox.all />    <flux:checkbox checked />    <flux:checkbox />    <flux:checkbox /></flux:checkbox.group>

[Checked](#checked)
-------------------

Mark a checkbox as checked by default.

Enable notifications

Copy to clipboard

    <flux:checkbox checked />

[Disabled](#disabled)
---------------------

Prevent users from interacting with and modifying a checkbox.

Read and write

Copy to clipboard

    <flux:checkbox disabled />

[Checkbox cards](#checkbox-cards)
---------------------------------

A bordered alternative to standard checkboxes.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Subscription preferences

Newsletter

Get the latest updates and offers.

Product updates

Learn about new features and products.

Event invitations

Invitatations to exclusive events.

Copy to clipboard

    <flux:checkbox.group wire:model="subscription" label="Subscription preferences" variant="cards" class="max-sm:flex-col">    <flux:checkbox checked        value="newsletter"        label="Newsletter"        description="Get the latest updates and offers."    />    <flux:checkbox        value="updates"        label="Product updates"        description="Learn about new features and products."    />    <flux:checkbox        value="invitations"        label="Event invitations"        description="Invitatations to exclusive events."    /></flux:checkbox.group>

You can swap between vertical and horizontal card layouts by conditionally applying flex-col based on the viewport.

Copy to clipboard

    <flux:checkbox.group ... class="max-sm:flex-col">    <!-- ... --></flux:checkbox.group>

[Vertical cards](#vertical-cards)
---------------------------------

You can arrange a set of checkbox cards vertically by simply adding the flex-col class to the group container.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Subscription preferences

Newsletter

Get the latest updates and offers.

Product updates

Learn about new features and products.

Event invitations

Invitatations to exclusive events.

Copy to clipboard

    <flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">    <flux:checkbox checked        value="newsletter"        label="Newsletter"        description="Get the latest updates and offers."    />    <flux:checkbox        value="updates"        label="Product updates"        description="Learn about new features and products."    />    <flux:checkbox        value="invitations"        label="Event invitations"        description="Invitatations to exclusive events."    /></flux:checkbox.group>

[Cards with icons](#cards-with-icons)
-------------------------------------

You can arrange a set of checkbox cards vertically by simply adding the flex-col class to the group container.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Subscription preferences

Newsletter

Get the latest updates and offers.

Product updates

Learn about new features and products.

Event invitations

Invitatations to exclusive events.

Copy to clipboard

    <flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">    <flux:checkbox checked        value="newsletter"        icon="newspaper"        label="Newsletter"        description="Get the latest updates and offers."    />    <flux:checkbox        value="updates"        icon="cube"        label="Product updates"        description="Learn about new features and products."    />    <flux:checkbox        value="invitations"        icon="calendar"        label="Event invitations"        description="Invitatations to exclusive events."    /></flux:checkbox.group>

[Custom card content](#custom-card-content)
-------------------------------------------

You can compose your own custom cards through the flux:checkbox component slot.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Subscription preferences

Newsletter

Get the latest updates and offers.

Product updates

Learn about new features and products.

Event invitations

Invitatations to exclusive events.

Copy to clipboard

    <flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">    <flux:checkbox checked value="newsletter">        <flux:checkbox.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Newsletter</flux:heading>            <flux:text size="sm" class="mt-2">Get the latest updates and offers.</flux:text>        </div>    </flux:checkbox>    <flux:checkbox value="updates">        <flux:checkbox.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Product updates</flux:heading>            <flux:text size="sm" class="mt-2">Learn about new features and products.</flux:text>        </div>    </flux:checkbox>    <flux:checkbox value="invitations">        <flux:checkbox.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Event invitations</flux:heading>            <flux:text size="sm" class="mt-2">Invitatations to exclusive events.</flux:text>        </div>    </flux:checkbox></flux:checkbox.group>

Related components
------------------

[

Switch

Toggle switches for selecting one or multiple options



](/components/switch)[

Radio

Radio button controls for selecting one option from many



](/components/radio)[

Field

Structured form field with label and validation states



](/components/field)

Reference
---------

### [flux:checkbox](#fluxcheckbox)

Prop

Description

wire:model

Binds the checkbox to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

label

Label text displayed next to the checkbox. When provided, wraps the checkbox in a structure with an adjacent label.

description

Help text displayed below the checkbox. When provided alongside label, appears between the label and checkbox.

value

Value associated with the checkbox when used in a group. When the checkbox is checked, this value will be included in the array returned by the group's wire:model.

checked

Sets the checkbox to be checked by default.

indeterminate

Sets the checkbox to an indeterminate state, represented by a dash instead of a checkmark. Useful for "select all" checkboxes when only some items are selected.

disabled

Prevents user interaction with the checkbox.

invalid

Applies error styling to the checkbox.

Attribute

Description

data-flux-checkbox

Applied to the root element for styling and identification.

data-checked

Applied when the checkbox is checked.

data-indeterminate

Applied when the checkbox is in an indeterminate state.

### [flux:checkbox.group](#fluxcheckboxgroup)

Prop

Description

wire:model

Binds the checkbox group to a Livewire property. The value will be an array of the selected checkboxes' values. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

label

Label text displayed above the checkbox group. When provided, wraps the group in a flux:field component with an adjacent flux:label component.

description

Help text displayed below the group label. When provided alongside label, appears between the label and the checkboxes.

variant

Visual style of the group. Options: default, cards (Pro).

disabled

Prevents user interaction with all checkboxes in the group.

invalid

Applies error styling to all checkboxes in the group.

Slot

Description

default

The checkboxes to be grouped together. Can include flux:checkbox, flux:checkbox.all, and other elements.

### [flux:checkbox.all](#fluxcheckboxall)

A special checkbox that controls all checkboxes within its group. It becomes checked when all checkboxes are checked, unchecked when none are checked, and indeterminate when some (but not all) are checked.

Prop

Description

label

Text label displayed next to the checkbox.

description

Help text displayed below the checkbox.

disabled

Prevents user interaction with the checkbox.

---

## Command

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Command palette
===============

A searchable list of commands.

Assign to…

⌘A

Create new file

Create new project

⌘⇧N

Documentation

Changelog

Settings

⌘,

No results found

Copy to clipboard

    <flux:command>    <flux:command.input placeholder="Search..." />    <flux:command.items>        <flux:command.item wire:click="..." icon="user-plus" kbd="⌘A">Assign to…</flux:command.item>        <flux:command.item wire:click="..." icon="document-plus">Create new file</flux:command.item>        <flux:command.item wire:click="..." icon="folder-plus" kbd="⌘⇧N">Create new project</flux:command.item>        <flux:command.item wire:click="..." icon="book-open">Documentation</flux:command.item>        <flux:command.item wire:click="..." icon="newspaper">Changelog</flux:command.item>        <flux:command.item wire:click="..." icon="cog-6-tooth" kbd="⌘,">Settings</flux:command.item>    </flux:command.items></flux:command>

[As a modal](#as-a-modal)
-------------------------

Open a command palette as a modal for quick access to frequently used commands.

Search...

⌘K

Assign to…

⌘A

Create new file

Create new project

⌘⇧N

Documentation

Changelog

Settings

⌘,

No results found

Copy to clipboard

    <flux:modal.trigger name="search" shortcut="cmd.k">    <flux:input as="button" placeholder="Search..." icon="magnifying-glass" kbd="⌘K" /></flux:modal.trigger><flux:modal name="search" variant="bare" class="w-full max-w-[30rem] my-[12vh] max-h-screen overflow-y-hidden">    <flux:command class="border-none shadow-lg inline-flex flex-col max-h-[76vh]">        <flux:command.input placeholder="Search..." closable />        <flux:command.items>            <flux:command.item icon="user-plus" kbd="⌘A">Assign to…</flux:command.item>            <flux:command.item icon="document-plus">Create new file</flux:command.item>            <flux:command.item icon="folder-plus" kbd="⌘⇧N">Create new project</flux:command.item>            <flux:command.item icon="book-open">Documentation</flux:command.item>            <flux:command.item icon="newspaper">Changelog</flux:command.item>            <flux:command.item icon="cog-6-tooth" kbd="⌘,">Settings</flux:command.item>        </flux:command.items>    </flux:command></flux:modal>

Reference
---------

### [flux:command](#fluxcommand)

The root command palette component that wraps the input and items.

Attribute

Description

data-flux-command

Applied to the root element for styling and identification.

### [flux:command.input](#fluxcommandinput)

Prop

Description

clearable

If true, displays a clear button when the input has content.

closable

If true, displays a close button to dismiss the command palette.

icon

Name of the icon displayed at the start of the input. Default: magnifying-glass.

placeholder

Placeholder text displayed when the input is empty.

### [flux:command.items](#fluxcommanditems)

Container for command items. No props available.

### [flux:command.item](#fluxcommanditem)

Prop

Description

icon

Name of the icon displayed at the start of the item.

icon:variant

Visual style of the icon. Options: outline (default), solid, mini, micro.

kbd

Keyboard shortcut hint displayed at the end of the item (e.g., ⌘K).

Attribute

Description

data-flux-command-item

Applied to the item element for styling and identification.

---

## Context

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Context menu
============

Dropdown menus that open when right clicking a designated area.

Learn more about the menu component on the [dropdown page \->](/components/dropdown)

Right click

New post

Sort by

Name

Date

Popularity

Filter

Draft

Published

Archived

Delete

Copy to clipboard

    <flux:context>    <flux:card class="border-dashed border-2 px-16">        <flux:text>Right click</flux:text>    </flux:card>    <flux:menu>        <flux:menu.item icon="plus">New post</flux:menu.item>        <flux:menu.separator />        <flux:menu.submenu heading="Sort by">            <flux:menu.radio.group>                <flux:menu.radio checked>Name</flux:menu.radio>                <flux:menu.radio>Date</flux:menu.radio>                <flux:menu.radio>Popularity</flux:menu.radio>            </flux:menu.radio.group>        </flux:menu.submenu>        <flux:menu.submenu heading="Filter">            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>            <flux:menu.checkbox checked>Published</flux:menu.checkbox>            <flux:menu.checkbox>Archived</flux:menu.checkbox>        </flux:menu.submenu>        <flux:menu.separator />        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>    </flux:menu></flux:context>

Related components
------------------

[

Dropdown

Display expandable menus for navigational options



](/components/dropdown)[

Command palette

Execute actions with keyboard shortcuts



](/components/command)

Reference
---------

### [flux:context](#fluxcontext)

A wrapper component that enables right-click context menu functionality.

Prop

Description

wire:model

Binds the context menu's state to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

position

Controls the position of the menu relative to the click position. Format: \[vertical\] \[horizontal\]. Vertical options: top, bottom (default). Horizontal options: start, center, end (default).

gap

Distance in pixels between the menu and the click position. Default: 4.

offset

Additional offset in pixels along both axes. Format: \[x\] \[y\].

target

ID of an external element to use as the menu. Use this when you need the menu to be outside the context element's DOM tree.

detail

Custom value to be stored in the menu's data-detail attribute, useful for adding custom styling or behavior based on the source of the context menu.

disabled

Prevents the context menu from being shown when right-clicking.

Slot

Description

default

The first child element functions as the trigger area, which will show the context menu when right-clicked. The second child element should be a flux:menu component that will appear as the context menu.

---

## Customization

Customization
=============

Knowing how to customize components to your own needs is a crucial part of using Flux. Flux provides multiple levels of customization so that it doesn't have to be all or nothing.

Tailwind overrides
------------------

The first level of customization is simply passing your own Tailwind classes into a component.

This often works well for things like custom width:

Copy to clipboard

    <flux:select class="max-w-md">

However, there are times where your one-off Tailwind class conflicts with Flux's internal styling.

For example, here's how you might attempt to customize the background color of a button:

Copy to clipboard

    <flux:button class="bg-zinc-800 hover:bg-zinc-700">

However, because flux applies its own bg-\* attributes, both classes will be rendered in the output HTML, but only one will be applied:

Copy to clipboard

    <button type="button" class="bg-zinc-800 hover:bg-zinc-700 bg-white hover:bg-zinc-100...">

The simplest way to resolve these conflicts is using Tailwind's important (!) modifier like so:

Copy to clipboard

    <flux:button class="bg-zinc-800! hover:bg-zinc-700!">

The conflicting utilities will still both be rendered, however the user-defined ones with the ! modifier will take precedence.

Sometimes, using ! is necessary. Most times, you would be better served creating a new component or customizing the existing one with a new variant. More on that below.

Publishing components
---------------------

When you first install Flux, all the components are automatically available to be used inside any Blade file in your app.

If you wish, you can "publish" any given component into your project so that you own all the Blade files that make up that component.

At first, you might be hesitant to publish components because you won't receive automatic updates, howevever, this isn't as scary as it may first seem. To publish a component, run the following Artisan command:

Copy to clipboard

    php artisan flux:publish

You will be prompted to search and select which components you want to publish. If you want to publish all components at once, you can use the \--all flag:

Copy to clipboard

    php artisan flux:publish --all

Let's say you decided to publish the checkbox component into your project, you would find the component file in the following location:

Copy to clipboard

    resources/    views/        flux/            checkbox.blade.php            ...

Now, you can continue using the checkbox component like normal, but the published Blade files will be used instead of the original ones. This means you can change anything you like about the component such as classes, slots and variants.

Global style overrides
----------------------

Most HTML elements used inside flux component have a data-flux-\* attribute. You can use this attribute to override any styles you'd like to. Here's an example of using Tailwind's @apply directive to change the default background color of all buttons:

Copy to clipboard

    <style>    [data-flux-button] {        @apply bg-zinc-800 dark:bg-zinc-400 hover:bg-zinc-700 dark:hover:bg-zinc-300;    }</style>

---

## Dark Mode

Dark mode
=========

Flux supports dark mode out of the box.

Light Dark System

Set up Tailwind
---------------

To take full advantage of Flux's dark mode controls, you will need to ensure that Tailwind CSS is configured to use the selector strategy for dark mode by adding this to your resources/views/app.css file:

Copy to clipboard

    @import "tailwindcss";@import '../../vendor/livewire/flux/dist/flux.css';"@custom-variant dark (&:where(.dark, .dark *));

By doing this, Flux can now toggle on and off dark mode by adding/removing a .dark class to the <html> element of your application.

Disabling dark mode handling
----------------------------

By default, Flux will handle the appearance of your application by adding a dark class to the html element depending on the user's system preference or selected appearance.

If you don't want Flux to handle this for you, you can remove the @fluxAppearance directive from your layout file.

Copy to clipboard

    <head>    ...--    @fluxAppearance</head>

Now you can handle the appearance of your application manually.

JavaScript utilities
--------------------

Managing dark mode in your own application is cumbersome. Here are a few essential behaviors you have to implement:

*   Add/remove the .dark class to the <html> element
*   Store the users preference in local storage
*   Honor the system preference if system is selected
*   Listen for changes in the system preference after a page has loaded

To save you from this complexity, Flux provides two JavaScript/Alpine utilities for making it easy to manage dark mode:

Copy to clipboard

    // Get/set a users color scheme preference...$flux.appearance = 'light|dark|system'// Get/set the current color scheme of your app...$flux.dark = 'true|false'

Given these two utilities, you can now use Alpine to easily build widgets to manage dark mode.

For example, here's how you would write a simple dark mode toggle button:

Copy to clipboard

    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark">Toggle</flux:button>

Or if you wanted to allow a user to choose their preferred color scheme, you could write:

Copy to clipboard

    <flux:radio.group x-data x-model="$flux.appearance">    <flux:radio value="light">Light</flux:radio>    <flux:radio value="dark">Dark</flux:radio>    <flux:radio value="system">System</flux:radio></flux:radio.group>

If you want to use these utilities outside of Alpine, you can instead access .appearance and .dark on the global window.Flux JavaScript object from anywhere in your application:

Copy to clipboard

    let button = document.querySelector('...')button.addEventListener('click', () => {    Flux.dark = ! Flux.dark})

Examples
--------

Rather than offer a one-size-fits-allnone solution, Flux provides a few examples of how you can use these utilities to build your own dark mode controls.

Toggle button
-------------

A simple toggle button to allow uesrs to control dark mode from something like a navbar or sidebar.

Copy to clipboard

    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />

Dropdown menu
-------------

More robust than a simple toggle button, this dropdown menu allows users to choose between light, dark, and system modes.

Light Dark System

Copy to clipboard

    <flux:dropdown x-data align="end">    <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />    </flux:button>    <flux:menu>        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>    </flux:menu></flux:dropdown>

Toggle switch
-------------

A simple toggle switch to allow users to control dark mode from something like a settings page.

Dark mode

Copy to clipboard

    <flux:switch x-data x-model="$flux.dark" label="Dark mode"  />

Segmented radio
---------------

A simple toggle switch to allow users to control dark mode from something like a settings page.

Light Dark System

Copy to clipboard

    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">    <flux:radio value="light" icon="sun">Light</flux:radio>    <flux:radio value="dark" icon="moon">Dark</flux:radio>    <flux:radio value="system" icon="computer-desktop">System</flux:radio></flux:radio.group>

Alternatively, you can use an icon-only variant to save horizontal space:

Copy to clipboard

    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">    <flux:radio value="light" icon="sun" />    <flux:radio value="dark" icon="moon" />    <flux:radio value="system" icon="computer-desktop" /></flux:radio.group>

---

## Date Picker

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Date picker
===========

Allow users to select dates or date ranges via a calendar overlay. Perfect for filtering data or scheduling events.

Use date inputs instead of date pickers for far-future or past events such as birthdates.

Cancel Select date

Copy to clipboard

    <flux:date-picker />

Basic usage
-----------

Set the initial selected date using the value prop with a Y-m-d formatted date string:

Copy to clipboard

    <flux:date-picker value="2025-04-03" />

You can also bind the selection to a Livewire property using wire:model:

Copy to clipboard

    <flux:date-picker wire:model="date" />

Now you can access the selected date from your Livewire component using either a Carbon instance or a Y-m-d formatted string:

Copy to clipboard

    <?phpuse Illuminate\Support\Carbon;use Livewire\Component;use App\Models\Post;class CreatePost extends Component {    public ?Carbon $date;    public function save()    {        Post::create([            // ...            'published_at' => $this->date,        ])        // ...    }}

[Input trigger](#input-trigger)
-------------------------------

Attach the date picker to a date input for more precise date selection control.

Cancel Select date

Copy to clipboard

    <flux:date-picker wire:model="date">    <x-slot name="trigger">        <flux:date-picker.input />    </x-slot></flux:date-picker>

[Range picker](#range-picker)
-----------------------------

Enable selection of date ranges for reporting, booking systems, or any scenario requiring a start and end date.

Cancel Select range

Copy to clipboard

    <flux:date-picker mode="range" />

Set the initial range using the value prop with a start and end date separated by a forward slash:

Copy to clipboard

    <flux:date-picker mode="range" value="2025-04-02/2025-04-06" />

You can also bind the selection to a Livewire property using wire:model:

Copy to clipboard

    <flux:date-picker mode="range" wire:model="range" />

Now you can access the selected range from your Livewire component using an associative array of Y-m-d formatted date strings:

Copy to clipboard

    <?phpuse Illuminate\Support\Carbon;use Livewire\Component;class Dashboard extends Component {    public array $range;    public function mount() {        $this->range = [            'start' => now()->subMonth()->format('Y-m-d'),            'end' => now()->format('Y-m-d'),        ];    }}

Alternatively, you can use the specialized DateRange object for enhanced functionality:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;    public function mount() {        $this->range = new DateRange(now()->subMonth(), now());    }}

We highly recommend using the DateRange object for range selection, it provides a lot of useful functionality.

[Check out everything you can do with the DateRange object ->](#the-daterange-object)

[Range limits](#range-limits)
-----------------------------

Control the allowed range of dates that can be selected.

Cancel Select range

Copy to clipboard

    <flux:date-picker mode="range" min-range="3" />

Cancel Select range

Copy to clipboard

    <flux:date-picker mode="range" max-range="10" />

[Range with inputs](#range-with-inputs)
---------------------------------------

Use separate inputs for start and end dates to provide a clearer interface for date range selection.

Start

End

Cancel Select range

Copy to clipboard

    <flux:date-picker mode="range">    <x-slot name="trigger">        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">            <flux:date-picker.input label="Start" />            <flux:date-picker.input label="End" />        </div>    </x-slot></flux:date-picker>

[Presets](#presets)
-------------------

Allow users to select from frequently used ranges like "Last 7 days" or "This month".

Today Yesterday This Week Last 7 Days This Month Year to Date All Time Custom

Choose predefined range... Today Yesterday This Week Last 7 Days This Month Year to Date All Time Custom

Cancel Select range

Copy to clipboard

    <flux:date-picker mode="range" with-presets />

You can also specify which presets to show, and in which order, using the presets prop:

Copy to clipboard

    <flux:date-picker    mode="range"    presets="today yesterday thisWeek last7Days thisMonth yearToDate allTime"/>

Available presets
-----------------

Below is a list of all available presets.

Key

Label

Constructor

Date Range

today

Today

DateRange::today()

Current day

yesterday

Yesterday

DateRange::yesterday()

Previous day

thisWeek

This Week

DateRange::thisWeek()

Current week

lastWeek

Last Week

DateRange::lastWeek()

Previous week

last7Days

Last 7 Days

DateRange::last7Days()

Previous 7 days

thisMonth

This Month

DateRange::thisMonth()

Current month

lastMonth

Last Month

DateRange::lastMonth()

Previous month

thisQuarter

This Quarter

DateRange::thisQuarter()

Current quarter

lastQuarter

Last Quarter

DateRange::lastQuarter()

Previous quarter

thisYear

This Year

DateRange::thisYear()

Current year

lastYear

Last Year

DateRange::lastYear()

Previous year

last14Days

Last 14 Days

DateRange::last14Days()

Previous 14 days

last30Days

Last 30 Days

DateRange::last30Days()

Previous 30 days

last3Months

Last 3 Months

DateRange::last3Months()

Previous 3 months

last6Months

Last 6 Months

DateRange::last6Months()

Previous 6 months

yearToDate

Year to Date

DateRange::yearToDate()

January 1st to today

allTime

All Time

DateRange::allTime($start)

Minimum supplied date to today

custom

Custom Range

DateRange::custom()

User-defined date range

All time
--------

When using the allTime preset, you must specify a minimum date using the min prop. This minimum date will be used as the start date of the "All Time" range. Today's date will be used as the end date:

Copy to clipboard

    <flux:date-picker    mode="range"    presets="... allTime"    :min="auth()->user()->created_at->format('Y-m-d')"/>

If you need to construct this via the DateRange object from Livewire, you can do so like this:

Copy to clipboard

    use Flux\DateRange;$this->range = DateRange::allTime(start: auth()->user()->created_at);

If you are using this date range to filter data, you may want to remove "where" constraints from the query when allTime is selected:

Copy to clipboard

    $orders = Order::when($this->range->isNotAllTime(), function ($query) => {    $query->whereBetween('created_at', $this->range);})->get();

Custom range preset
-------------------

When a user selects a custom date range that doesn't match any other preset, the picker will automatically switch to the custom preset if it is included in the presets prop.

Copy to clipboard

    <flux:date-picker mode="range" presets="... custom" />

[With today shortcut](#with-today-shortcut)
-------------------------------------------

Add a shortcut button to quickly navigate to today's date. When viewing a different month, it jumps to the current month. When already viewing the current month, it selects today's date.

Cancel Select date

Copy to clipboard

    <flux:date-picker with-today />

[Selectable header](#selectable-header)
---------------------------------------

Enable quick navigation by making the month and year in the header selectable.

Cancel Select date

Copy to clipboard

    <flux:date-picker selectable-header />

[Fixed weeks](#fixed-weeks)
---------------------------

Display a consistent number of weeks in every month. Prevents layout shifts when navigating between months with different numbers of weeks.

Cancel Select date

Copy to clipboard

    <flux:date-picker fixed-weeks />

[Start day](#start-day)
-----------------------

By deafult the first day of the week will be automatically set based on the user's locale. You can override this by setting the start-day attribute to any day of the week.

Cancel Select date

Copy to clipboard

    <flux:date-picker start-day="1" />

[Open to](#open-to)
-------------------

Set the date that the calendar will open to. Otherwise, the calendar defaults to the selected date's month, or the current month.

Cancel Select date

Copy to clipboard

    <flux:date-picker open-to="2026-05-01" />

[Week numbers](#week-numbers)
-----------------------------

Display the week number for each week.

Cancel Select date

Copy to clipboard

    <flux:date-picker week-numbers />

[Localization](#localization)
-----------------------------

By default, the date picker will use the browser's locale (e.g. navigator.language).

You can override this behavior by setting the locale attribute to any valid locale string (e.g. fr for French, en-US for English, etc.):

Cancel Select date

Copy to clipboard

    <flux:date-picker locale="ja-JP" />

The DateRange object
--------------------

Flux provides a specialized Flux\\DateRange object that extends the native CarbonPeriod class. This object provides a number of convenience methods to easily create and manage date ranges.

First, it's worth noting that most of the time, you will want to use wire:model.live to bind the range property to a DateRange object. This will automatically update the range property whenever the user selects a date range:

Copy to clipboard

    <flux:calendar wire:model.live="range" />

Now, in your component, you can type hint the range property as a DateRange object:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;}

Instantiation
-------------

You can initialize a DateRange object by passing a start and end date to the DateRange constructor from something like the mount method:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;    public function mount() {        $this->range = new DateRange(now(), now()->addDays(7));    }}

Persisting to the session
-------------------------

You can persist a DateRange object in the user's session by using the #\[Session\] attribute:

Copy to clipboard

    <?phpuse Livewire\Attributes\Session;use Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    #[Session]    public DateRange $range;}

Using with Eloquent
-------------------

You can use the DateRange object with Eloquent's whereBetween() method to filter queries by date range:

Copy to clipboard

    <?phpuse Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Order;use Flux\DateRange;class Dashboard extends Component {    public ?DateRange $range;    #[Computed]    public function orders() {        return $this->range            ? Order::whereBetween('created_at', $this->range)->get()            : Order::all();    }}

Available methods
-----------------

The DateRange object extends the native CarbonPeriod class, so it inherits all of its methods. Here are a few examples:

Copy to clipboard

    $range = new Flux\DateRange(    now()->subDays(1),    now()->addDays(1),);// Get the start and end dates as Carbon instances...$start = $range->start();$end = $range->end();// Check if the range contains a date...$range->contains(now());// Get the number of days in the range...$range->length();// Loop over the range by day...foreach ($range as $date) {    // $date is a Carbon instance...}// Get the range as an array of Carbon instances representing each day in the range...$range->toArray();

You can also use it anywhere Eloquent utilities expect a CarbonPeriod instance:

Copy to clipboard

    $orders = Order::whereBetween('created_at', $range)->get();

Range presets
-------------

When using the presets prop, the calendar will get/set an associative array of dates as well as a preset key:

Copy to clipboard

    [    'start' => null,    'end' => null,    'preset' => 'lastMonth',]

You can directly get/set the preset string through a simple array binding:

Copy to clipboard

    <?phpuse Livewire\Component;class Dashboard extends Component {    public array $range;    public function mount() {        $this->range = [            'start' => null,            'end' => null,            'preset' => 'lastMonth',        ];    }}

However, the DateRange object is equipped to manage the preset internally.

For example, you can create a range using the lastMonth() method:

Copy to clipboard

    <?phpuse Livewire\Component;use Flux\DateRange;class Dashboard extends Component {    public DateRange $range;    public function mount() {        $this->range = DateRange::lastMonth();    }}

[View the complete list of available presets ->](#available-presets)

You can access the preset as an enum value via the preset() method:

Copy to clipboard

    $this->range->preset();// This will return a value like `DateRangePreset::LastMonth`...

Related components
------------------

[

Calendar

Displays a calendar interface for selecting dates



](/components/calendar)[

Input

Text fields for collecting user input



](/components/input)

Reference
---------

### [flux:date-picker](#fluxdate-picker)

Prop

Description

wire:model

Binds the date picker to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

value

Selected date(s). Format depends on mode: single date (Y-m-d) or range (Y-m-d/Y-m-d).

mode

Selection mode. Options: single (default), range.

min-range

Minimum number of days that can be selected in range mode.

max-range

Maximum number of days that can be selected in range mode.

min

Earliest selectable date. Can be a date string or "today".

max

Latest selectable date. Can be a date string or "today".

months

Number of months to display. Default: 1 in single mode, 2 in range mode.

label

Label text displayed above the date picker. When provided, wraps the component in a flux:field with an adjacent flux:label.

description

Help text displayed below the date picker. When provided alongside label, appears between the label and date picker within the flux:field wrapper.

description:trailing

The description provided will be displayed below the date picker instead of above it.

badge

Badge text displayed at the end of the flux:label component when the label prop is provided.

placeholder

Placeholder text displayed when no date is selected. Default depends on mode.

size

Size of the calendar day cells. Options: sm, default, lg, xl, 2xl.

week-numbers

If true, displays week numbers in the calendar.

selectable-header

If true, displays month and year dropdowns for quick navigation.

with-today

If true, displays a button to quickly navigate to today's date.

with-inputs

If true, displays date inputs at the top of the calendar for manual date entry.

with-confirmation

If true, requires confirmation before applying the selected date(s).

with-presets

If true, displays preset date ranges. Use with presets to customize available options.

presets

Space-separated list of preset date ranges to display. Default: today yesterday thisWeek last7Days thisMonth yearToDate allTime.

clearable

Displays a clear button when a date is selected.

disabled

Prevents user interaction with the date picker.

invalid

Applies error styling to the date picker.

locale

Set the locale for the date picker. Examples: fr, en-US, ja-JP.

Slot

Description

trigger

Custom trigger element to open the date picker. Usually a flux:date-picker.input or flux:date-picker.button.

Attribute

Description

data-flux-date-picker

Applied to the root element for styling and identification.

### [flux:date-picker.input](#fluxdate-pickerinput)

Prop

Description

label

Label text displayed above the input. When provided, wraps the input in a flux:field component with an adjacent flux:label component.

description

Help text displayed below the input. When provided alongside label, appears between the label and input within the flux:field wrapper.

placeholder

Placeholder text displayed when no date is selected.

format

Date format string for display. Default: localized format.

clearable

Displays a clear button when a date is selected.

disabled

Prevents user interaction with the input.

invalid

Applies error styling to the input.

### [flux:date-picker.button](#fluxdate-pickerbutton)

Prop

Description

placeholder

Text displayed when no date is selected.

size

Size of the button. Options: sm, xs.

clearable

Displays a clear button when a date is selected.

disabled

Prevents user interaction with the button.

invalid

Applies error styling to the button.

### [DateRange Object](#daterange-object)

A specialized object for handling date ranges when using mode="range".

Method

Description

$range->start()

Get the start date as a Carbon instance.

$range->end()

Get the end date as a Carbon instance.

$range->days()

Get the number of days in the range.

$range->preset()

Get the current preset as a DateRangePreset enum value.

$range->toArray()

Get the range as an array with start and end keys.

Static Method

Description

DateRange::today()

Create a DateRange for today.

DateRange::yesterday()

Create a DateRange for yesterday.

DateRange::thisWeek()

Create a DateRange for the current week.

DateRange::lastWeek()

Create a DateRange for the previous week.

DateRange::last7Days()

Create a DateRange for the last 7 days.

DateRange::last30Days()

Create a DateRange for the last 30 days.

DateRange::thisMonth()

Create a DateRange for the current month.

DateRange::lastMonth()

Create a DateRange for the previous month.

DateRange::thisQuarter()

Create a DateRange for the current quarter.

DateRange::lastQuarter()

Create a DateRange for the previous quarter.

DateRange::thisYear()

Create a DateRange for the current year.

DateRange::lastYear()

Create a DateRange for the previous year.

DateRange::yearToDate()

Create a DateRange from January 1st to today.

DateRange::allTime()

Create a DateRange with no limits.

---

## Dropdown

Dropdown
========

A composable dropdown component that can handle both simple navigation menus as well as complex action menus with checkboxes, radios, and submenus.

Options New post

Sort by

Name

Date

Popularity

Filter

Draft

Published

Archived

Delete

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Options</flux:button>    <flux:menu>        <flux:menu.item icon="plus">New post</flux:menu.item>        <flux:menu.separator />        <flux:menu.submenu heading="Sort by">            <flux:menu.radio.group>                <flux:menu.radio checked>Name</flux:menu.radio>                <flux:menu.radio>Date</flux:menu.radio>                <flux:menu.radio>Popularity</flux:menu.radio>            </flux:menu.radio.group>        </flux:menu.submenu>        <flux:menu.submenu heading="Filter">            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>            <flux:menu.checkbox checked>Published</flux:menu.checkbox>            <flux:menu.checkbox>Archived</flux:menu.checkbox>        </flux:menu.submenu>        <flux:menu.separator />        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>    </flux:menu></flux:dropdown>

[Navigation menus](#navigation-menus)
-------------------------------------

Display a simple set of links in a dropdown menu.

Use the navmenu component for a simple collections of links. Otherwise, use the menu component for action menus that require keyboard navigation, submenus, etc.

![Olivia Martin](/img/demo/user.png)

Olivia Martin

[Account](#) [Profile](#) [Billing](#) [Logout](#) [Delete](#)

Copy to clipboard

    <flux:dropdown position="bottom" align="end">    <flux:profile avatar="/img/demo/user.png" name="Olivia Martin" />    <flux:navmenu>        <flux:navmenu.item href="#" icon="user">Account</flux:navmenu.item>        <flux:navmenu.item href="#" icon="building-storefront">Profile</flux:navmenu.item>        <flux:navmenu.item href="#" icon="credit-card">Billing</flux:navmenu.item>        <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>        <flux:navmenu.item href="#" icon="trash" variant="danger">Delete</flux:navmenu.item>    </flux:navmenu></flux:dropdown>

[Positioning](#positioning)
---------------------------

Customize the position of the dropdown menu via the position and align props. You can first pass the base position: top, bottom, left, and right, then an alignment modifier like start, center, or end.

[Account](#) [Profile](#) [Billing](#) [Logout](#)

Copy to clipboard

    <flux:dropdown position="top" align="start"><!-- More positions... --><flux:dropdown position="right" align="center"><flux:dropdown position="bottom" align="center"><flux:dropdown position="left" align="end">

[Offset & gap](#offset-gap)
---------------------------

Customize the offset/gap of the dropdown menu via the offset and gap props. These properties accept values in pixels.

[Account](#) [Profile](#) [Billing](#) [Logout](#)

Copy to clipboard

    <flux:dropdown offset="-15" gap="2">

[Keyboard hints](#keyboard-hints)
---------------------------------

Add keyboard shortcut hints to menu items to teach users how to navigate your app faster.

Options Save

⌘S

Duplicate

⌘D

Delete

⌘⌫

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Options</flux:button>    <flux:menu>        <flux:menu.item icon="pencil-square" kbd="⌘S">Save</flux:menu.item>        <flux:menu.item icon="document-duplicate" kbd="⌘D">Duplicate</flux:menu.item>        <flux:menu.item icon="trash" variant="danger" kbd="⌘⌫">Delete</flux:menu.item>    </flux:menu></flux:dropdown>

[Checkbox items](#checkbox-items)
---------------------------------

Select one or many menu options.

Permissions

Read

Write

Delete

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Permissions</flux:button>    <flux:menu>        <flux:menu.checkbox wire:model="read" checked>Read</flux:menu.checkbox>        <flux:menu.checkbox wire:model="write" checked>Write</flux:menu.checkbox>        <flux:menu.checkbox wire:model="delete">Delete</flux:menu.checkbox>    </flux:menu></flux:dropdown>

[Radio items](#radio-items)
---------------------------

Select a single menu option.

Sort by

Latest activity

Date created

Most popular

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Sort by</flux:button>    <flux:menu>        <flux:menu.radio.group wire:model="sortBy">            <flux:menu.radio checked>Latest activity</flux:menu.radio>            <flux:menu.radio>Date created</flux:menu.radio>            <flux:menu.radio>Most popular</flux:menu.radio>        </flux:menu.radio.group>    </flux:menu></flux:dropdown>

[Groups](#groups)
-----------------

Visually group related menu items with a separator line.

Options

View

Transfer

Publish

Share

Delete

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Options</flux:button>    <flux:menu>        <flux:menu.item>View</flux:menu.item>        <flux:menu.item>Transfer</flux:menu.item>        <flux:menu.separator />        <flux:menu.item>Publish</flux:menu.item>        <flux:menu.item>Share</flux:menu.item>        <flux:menu.separator />        <flux:menu.item variant="danger">Delete</flux:menu.item>    </flux:menu></flux:dropdown>

[Groups with headings](#groups-with-headings)
---------------------------------------------

Group options under headings to make them more discoverable.

Options

Account

Profile

Permissions

Billing

Transactions

Payouts

Refunds

Logout

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Options</flux:button>    <flux:menu>        <flux:menu.group heading="Account">            <flux:menu.item>Profile</flux:menu.item>            <flux:menu.item>Permissions</flux:menu.item>        </flux:menu.group>        <flux:menu.group heading="Billing">            <flux:menu.item>Transactions</flux:menu.item>            <flux:menu.item>Payouts</flux:menu.item>            <flux:menu.item>Refunds</flux:menu.item>        </flux:menu.group>        <flux:menu.item>Logout</flux:menu.item>    </flux:menu></flux:dropdown>

[Submenus](#submenus)
---------------------

Nest submenus for more condensed menus.

Options

Sort by

Name

Date

Popularity

Filter

Draft

Published

Archived

Delete

Copy to clipboard

    <flux:dropdown>    <flux:button icon:trailing="chevron-down">Options</flux:button>    <flux:menu>        <flux:menu.submenu heading="Sort by">            <flux:menu.radio checked>Name</flux:menu.radio>            <flux:menu.radio>Date</flux:menu.radio>            <flux:menu.radio>Popularity</flux:menu.radio>        </flux:menu.submenu>        <flux:menu.submenu heading="Filter">            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>            <flux:menu.checkbox checked>Published</flux:menu.checkbox>            <flux:menu.checkbox>Archived</flux:menu.checkbox>        </flux:menu.submenu>        <flux:menu.separator />        <flux:menu.item variant="danger">Delete</flux:menu.item>    </flux:menu></flux:dropdown>

Related components
------------------

[

Navbar

Build responsive navigation bars with dropdown menus



](/components/navbar)[

Profile

Show user avatars and profile information



](/components/profile)[

Button

Interactive controls for forms and UI actions



](/components/button)

Reference
---------

### [flux:dropdown](#fluxdropdown)

Prop

Description

position

Position of the dropdown menu. Options: top, right, bottom (default), left.

align

Alignment of the dropdown menu. Options: start, center, end. Default: start.

offset

Offset in pixels from the trigger element. Default: 0.

gap

Gap in pixels between trigger and menu. Default: 4.

Attribute

Description

data-flux-dropdown

Applied to the root element for styling and identification.

### [flux:menu](#fluxmenu)

A complex menu component that supports keyboard navigation, submenus, checkboxes, and radio buttons.

Slot

Description

default

The menu items, separators, and submenus.

Attribute

Description

data-flux-menu

Applied to the root element for styling and identification.

### [flux:menu.item](#fluxmenuitem)

Prop

Description

icon

Name of the icon to display at the start of the item.

icon:trailing

Name of the icon to display at the end of the item.

icon:variant

Variant of the icon. Options: outline, solid, mini, micro.

kbd

Keyboard shortcut hint displayed at the end of the item.

suffix

Text displayed at the end of the item.

variant

Visual style of the item. Options: default, danger.

disabled

If true, prevents interaction with the menu item.

Attribute

Description

data-flux-menu-item

Applied to the root element for styling and identification.

data-active

Applied when the item is hovered/active.

### [flux:menu.submenu](#fluxmenusubmenu)

Prop

Description

heading

Text displayed as the submenu heading.

icon

Name of the icon to display at the start of the submenu.

icon:trailing

Name of the icon to display at the end of the submenu.

icon:variant

Variant of the icon. Options: outline, solid, mini, micro.

Slot

Description

default

The submenu items (checkboxes, radio buttons, etc.).

### [flux:menu.separator](#fluxmenuseparator)

A horizontal line that separates menu items.

### [flux:menu.checkbox-group](#fluxmenucheckbox-group)

Prop

Description

wire:model

Binds the checkbox group to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

Slot

Description

default

The checkboxes.

### [flux:menu.checkbox](#fluxmenucheckbox)

Prop

Description

wire:model

Binds the checkbox to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

checked

If true, the checkbox is checked by default.

disabled

If true, prevents interaction with the checkbox.

Attribute

Description

data-active

Applied when the checkbox is hovered/active.

data-checked

Applied when the checkbox is checked.

### [flux:menu.radio.group](#fluxmenuradiogroup)

Prop

Description

wire:model

Binds the radio group to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

Slot

Description

default

The radio buttons.

### [flux:menu.radio](#fluxmenuradio)

Prop

Description

checked

If true, the radio button is selected by default.

disabled

If true, prevents interaction with the radio button.

Attribute

Description

data-active

Applied when the radio button is hovered/active.

data-checked

Applied when the radio button is selected.

---

## Editor

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Rich text editor
================

A basic rich text editor for your application. Built using [ProseMirror](https://prosemirror.net) and [Tiptap](https://tiptap.dev/).

Because of large external dependencies, the editor's JavaScript is not included in the core Flux bundle. It will be loaded on-the-fly as a separate JS file when you use the flux:editor component.

Release notes Explain what's new in this release.

Text

Styles

Text

Heading 1

Heading 2

Heading 3

Bold ⌘B

Italic ⌘I

Strikethrough ⌘+Shift+S

Bullet list

Ordered list

Blockquote ⌘+Shift+B

Insert link ⌘K

Insert link

Unlink

Left

Align

Left

Center

Right

### What's changed

*   Markdown notation support
*   Accessible toolbar
*   Shortcut keys

**Full changelog:** [v1.0.25...v1.0.26](https://github.com/livewire/flux/compare/v1.0.25...v1.0.26)

Copy to clipboard

    <flux:editor wire:model="content" label="…" description="…" />

[Toolbar](#toolbar)
-------------------

Flux's editor toolbar is both keyboard/screen-reader accessible and completely customizable to suit your application's needs.

Configuring items
-----------------

You can configure which toolbar items are visible, and in what order, by passing in a space-separated list of items to the toolbar prop.

Text

Styles

Text

Heading 1

Heading 2

Heading 3

Bold ⌘B

Italic ⌘I

Underline ⌘U

Left

Align

Left

Center

Right

Undo ⌘Z

Redo ⌘+Shift+Z

Copy to clipboard

    <flux:editor toolbar="heading | bold italic underline | align ~ undo redo" />

You may have noticed the | and ~ characters in the toolbar configuration. These are shorthand for separator and spacer respectively.

The following toolbar items are available:

*   heading
*   bold
*   italic
*   strike
*   underline
*   bullet
*   ordered
*   blockquote
*   subscript
*   superscript
*   highlight
*   link
*   code
*   undo
*   redo

Custom items
------------

You can add your own toolbar items by adding new files to the resources/views/flux/editor directory in your project.

    - resources    - views        - flux            - editor                - copy.blade.php

Here's an example of what a custom "Copy to clipboard" item in a blade file might look like:

Copy to clipboard

    <flux:tooltip content="{{ __('Copy to clipboard') }}" class="contents">    <flux:editor.button x-on:click="navigator.clipboard?.writeText($el.closest('[data-flux-editor]').value); $el.setAttribute('data-copied', ''); setTimeout(() => $el.removeAttribute('data-copied'), 2000)">        <flux:icon.clipboard variant="outline" class="[[data-copied]_&]:hidden size-5!" />        <flux:icon.clipboard-document-check variant="outline" class="hidden [[data-copied]_&]:block size-5!" />    </flux:editor.button></flux:tooltip>

Now you can reference your new component by name in any toolbar configuration like so:

Text

Styles

Text

Heading 1

Heading 2

Heading 3

Bold ⌘B

Italic ⌘I

Strikethrough ⌘+Shift+S

Bullet list

Ordered list

Blockquote ⌘+Shift+B

Insert link ⌘K

Insert link

Unlink

Left

Align

Left

Center

Right

Copy to clipboard

Copy to clipboard

    <flux:editor toolbar="heading | […] | align ~ copy" />

Customization
-------------

If you have deeper customization needs, you can compose your own editor component. Here's an example of putting a custom dropdown menu in an editor's toolbar:

Text

Styles

Text

Heading 1

Heading 2

Heading 3

Bold ⌘B

Italic ⌘I

Strikethrough ⌘+Shift+S

Bullet list

Ordered list

Blockquote ⌘+Shift+B

Insert link ⌘K

Insert link

Unlink

Left

Align

Left

Center

Right

More

Preview Export Share

Copy to clipboard

    <flux:editor>    <flux:editor.toolbar>        <flux:editor.heading />        <flux:editor.separator />        <flux:editor.bold />        <flux:editor.italic />        <flux:editor.strike />        <flux:editor.separator />        <flux:editor.bullet />        <flux:editor.ordered />        <flux:editor.blockquote />        <flux:editor.separator />        <flux:editor.link />        <flux:editor.separator />        <flux:editor.align />        <flux:editor.spacer />        <flux:dropdown position="bottom end" offset="-15">            <flux:editor.button icon="ellipsis-horizontal" tooltip="More" />            <flux:menu>                <flux:menu.item wire:click="…" icon="arrow-top-right-on-square">Preview</flux:menu.item>                <flux:menu.item wire:click="…" icon="arrow-down-tray">Export</flux:menu.item>                <flux:menu.item wire:click="…" icon="share">Share</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:editor.toolbar>    <flux:editor.content /></flux:editor>

[Height](#height)
-----------------

By default, the editor will have a minimum height of 200px, and a maximum height of 500px. If you want to customize this behavior, you can use Tailwind utilties to target the content slot and set your own min/max height and overflow behavior.

Text

Styles

Text

Heading 1

Heading 2

Heading 3

Bold ⌘B

Italic ⌘I

Strikethrough ⌘+Shift+S

Bullet list

Ordered list

Blockquote ⌘+Shift+B

Insert link ⌘K

Insert link

Unlink

Left

Align

Left

Center

Right

Copy to clipboard

    <flux:editor class="**:data-[slot=content]:min-h-[100px]" />

The \[&\_\[data-slot=content\]\]: selector targets a child element with a data-slot="content" attribute.

This is an advanced Tailwind technique used to style a nested element inline without needing direct access to it.

[Shortcut keys](#shortcut-keys)
-------------------------------

Flux's editor uses Tiptap's default shortcut keys which are common amongst most rich text editors.

Operation

Windows/Linux

Mac

Apply paragraph style

Ctrl+Alt+0

Cmd+Alt+0

Apply heading level 1

Ctrl+Alt+1

Cmd+Alt+1

Apply heading level 2

Ctrl+Alt+2

Cmd+Alt+2

Apply heading level 3

Ctrl+Alt+3

Cmd+Alt+3

Bold

Ctrl+B

Cmd+B

Italic

Ctrl+I

Cmd+I

Underline

Ctrl+U

Cmd+U

Strikethrough

Ctrl+Shift+X

Cmd+Shift+X

Bullet list

Ctrl+Shift+8

Cmd+Shift+8

Ordered list

Ctrl+Shift+7

Cmd+Shift+7

Blockquote

Ctrl+Shift+B

Cmd+Shift+B

Code

Ctrl+E

Cmd+E

Highlight

Ctrl+Shift+H

Cmd+Shift+H

Align left

Ctrl+Shift+L

Cmd+Shift+L

Align center

Ctrl+Shift+E

Cmd+Shift+E

Align right

Ctrl+Shift+R

Cmd+Shift+R

Paste without formatting

Ctrl+Shift+V

Cmd+Shift+V

Add a line break

Ctrl+Shift+Enter

Cmd+Shift+Enter

Undo

Ctrl+Z

Cmd+Z

Redo

Ctrl+Shift+Z

Cmd+Shift+Z

[Markdown syntax](#markdown-syntax)
-----------------------------------

Although Flux's editor isn't a markdown editor itself, it allows you to use markdown syntax to trigger styling changes while authoring your content.

Markdown

Operation

#

Apply heading level 1

##

Apply heading level 2

###

Apply heading level 3

\*\*

Bold

\*

Italic

~~

Strikethrough

\-

Bullet list

1.

Ordered list

\>

Blockquote

\`

Inline code

\`\`\`

Code block

\`\`\`?

Code block (with class="language-?")

\---

Horizontal rule

[Localization](#localization)
-----------------------------

If you need to localize the editor's aria-label or tooltip copy, you'll need to register the following translation keys in one of your app's lang files.

Here's an example of supporting Spanish localization:

    // lang/es.json{    "Rich text editor": "Editor de texto enriquecido",    "Formatting": "Formato",    "Text": "Texto",    "Heading 1": "Encabezado 1",    "Heading 2": "Encabezado 2",    "Heading 3": "Encabezado 3",    "Styles": "Estilos",    "Bold": "Negrita",    "Italic": "Cursiva",    "Underline": "Subrayado",    "Strikethrough": "Tachado",    "Subscript": "Subíndice",    "Superscript": "Superíndice",    "Highlight": "Resaltar",    "Code": "Código",    "Bullet list": "Lista con viñetas",    "Ordered list": "Lista numerada",    "Blockquote": "Cita",    "Insert link": "Insertar enlace",    "Unlink": "Quitar enlace",    "Align": "Alinear",    "Left": "Izquierda",    "Center": "Centro",    "Right": "Derecha",    "Undo": "Deshacer",    "Redo": "Rehacer"}

Related components
------------------

[

Field

Structured form field with label



](/components/field)[

Textarea

Multi-line text input areas for longer form content



](/components/textarea)

Reference
---------

### [flux:editor](#fluxeditor)

Prop

Description

wire:model

Binds the editor to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

value

Initial content for the editor. Used when not binding with wire:model.

label

Label text displayed above the editor. When provided, wraps the editor in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the editor. When provided alongside label, appears between the label and editor within the flux:field wrapper. See the [field component](/components/field).

description:trailing

The description provided will be displayed below the editor instead of above it.

badge

Badge text displayed at the end of the flux:label component when the label prop is provided.

placeholder

Placeholder text displayed when the editor is empty.

toolbar

Space-separated list of toolbar items to display. Use | for separator and ~ for spacer. By default, includes heading, bold, italic, strike, bullet, ordered, blockquote, link, and align tools.

disabled

Prevents user interaction with the editor.

invalid

Applies error styling to the editor.

Slot

Description

default

The editor content and toolbar components. If omitted, the standard toolbar and an empty content area will be used.

Attribute

Description

data-flux-editor

Applied to the root element for styling and identification.

### [flux:editor.toolbar](#fluxeditortoolbar)

Container for editor toolbar items. Can be used for custom toolbar layouts.

Prop

Description

items

Space-separated list of toolbar items to display. Use | for separator and ~ for spacer. If not provided, displays the default toolbar.

Slot

Description

default

The toolbar items, separators, and spacers. Use this slot to create a completely custom toolbar.

### [flux:editor.button](#fluxeditorbutton)

Prop

Description

icon

Name of the icon to display in the button.

iconVariant

The variant of the icon to display. Options: mini, micro, outline. Default: mini (without slot) or micro (with slot).

tooltip

Text to display in a tooltip when hovering over the button.

disabled

Prevents interaction with the button.

Slot

Description

default

Content to display inside the button. If provided alongside an icon, the icon will be displayed before this content.

### [flux:editor.content](#fluxeditorcontent)

Container for the editor's editable content. Typically used when creating a custom editor layout.

Slot

Description

default

The initial HTML content for the editor. This content will be processed and managed by the editor.

### [Toolbar Items](#toolbar-items)

Available toolbar items that can be referenced in the \`toolbar\` prop or used directly in a custom toolbar.

Component

Description

heading

Heading level selector.

bold

Bold text formatting.

italic

Italic text formatting.

strike

Strikethrough text formatting.

underline

Underline text formatting.

bullet

Bulleted list.

ordered

Numbered list.

blockquote

Block quote formatting.

code

Code block formatting.

link

Link insertion.

align

Text alignment options.

undo

Undo last action.

redo

Redo last action.

---

## Field

Field
=====

Encapsulate input elements with labels, descriptions, and validation.

Explore the [input component \->](/components/input)

Email

Copy to clipboard

    <flux:field>    <flux:label>Email</flux:label>    <flux:input wire:model="email" type="email" />    <flux:error name="email" /></flux:field>

[Shorthand props](#shorthand-props)
-----------------------------------

Because using the field component in its full form can be verbose and repetitive, all form controls in flux allow you pass a label and a description parameter directly. Under the hood, they will be wrapped in a field with an error component automatically.

Copy to clipboard

    <flux:input wire:model="email" label="Email" type="email" />

[With trailing description](#with-trailing-description)
-------------------------------------------------------

Position the field description directly below the input.

Password

Must be at least 8 characters long, include an uppercase letter, a number, and a special character.

Copy to clipboard

    <flux:field>    <flux:label>Password</flux:label>    <flux:input type="password" />    <flux:error name="password" />    <flux:description>Must be at least 8 characters long, include an uppercase letter, a number, and a special character.</flux:description></flux:field><!-- Alternative shorthand syntax... --><flux:input    type="password"    label="Password"    description:trailing="Must be at least 8 characters long, include an uppercase letter, a number, and a special character."/>

[With badge](#with-badge)
-------------------------

Badges allow you to enhance a field with additional information such as being "required" or "optional" when it might not be expected.

Email Required

Phone number Optional

Copy to clipboard

    <flux:field>    <flux:label badge="Required">Email</flux:label>    <flux:input type="email" required />    <flux:error name="email" /></flux:field><flux:field>    <flux:label badge="Optional">Phone number</flux:label>    <flux:input type="phone" placeholder="(555) 555-5555" mask="(999) 999-9999"  />    <flux:error name="phone" /></flux:field>

[Split layout](#split-layout)
-----------------------------

Display multiple fields horizontally in the same row.

First name

Last name

Copy to clipboard

    <div class="grid grid-cols-2 gap-4">    <flux:input label="First name" placeholder="River" />    <flux:input label="Last name" placeholder="Porzio" /></div>

[Fieldset](#fieldset)
---------------------

Group related fields using the fieldset and legend component.

Shipping address

Street address line 1

Street address line 2

City

State / Province

Postal / Zip code

Country United States

Copy to clipboard

    <flux:fieldset>    <flux:legend>Shipping address</flux:legend>    <div class="space-y-6">        <flux:input label="Street address line 1" placeholder="123 Main St" class="max-w-sm" />        <flux:input label="Street address line 2" placeholder="Apartment, studio, or floor" class="max-w-sm" />        <div class="grid grid-cols-2 gap-x-4 gap-y-6">            <flux:input label="City" placeholder="San Francisco" />            <flux:input label="State / Province" placeholder="CA" />            <flux:input label="Postal / Zip code" placeholder="12345" />            <flux:select label="Country">                <option selected>United States</option>                <!-- ... -->            </flux:select>        </div>    </div></flux:fieldset>

Related components
------------------

[

Input

Text fields for collecting user input



](/components/input)[

Textarea

Multi-line text input areas for longer form content



](/components/textarea)[

Switch

Toggleable input control for making selections



](/components/switch)

Reference
---------

### [flux:field](#fluxfield)

A container component that provides structure for form inputs with labels, descriptions, and error messages.

Prop

Description

variant

Visual style variant. Options: block, inline. Default: block.

Slot

Description

default

The form control elements (input, select, etc.) and their associated labels, descriptions, and error messages.

Attribute

Description

data-flux-field

Applied to the root element for styling and identification.

### [flux:label](#fluxlabel)

Prop

Description

badge

Optional text to display as a badge (e.g., "Required", "Optional").

Slot

Description

default

The label text content.

### [flux:description](#fluxdescription)

Slot

Description

default

The descriptive text content.

### [flux:error](#fluxerror)

Prop

Description

name

The name of the field to display validation errors for.

message

Custom error message content (optional).

Slot

Description

default

Custom error message content (optional).

### [flux:fieldset](#fluxfieldset)

Prop

Description

legend

The fieldset's heading text.

description

Optional description text for the fieldset.

Slot

Description

default

The grouped form fields and their associated legend.

### [flux:legend](#fluxlegend)

Slot

Description

default

The fieldset's heading text.

### [flux:description](#fluxdescription)

Slot

Description

default

The descriptive text content.

---

## Header

Header
======

A full-width top navigation layout for your application.

[Fullscreen](/demo/header) Demo Code

 ![](/img/demo/layout-header.png) ![](/img/demo/layout-header-dark.png)

Copy to clipboard

    <head>    <!-- ... -->    @fluxAppearance</head><body class="min-h-screen bg-white dark:bg-zinc-800">    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />        <flux:navbar class="-mb-px max-lg:hidden">            <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>            <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>            <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>            <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>            <flux:separator vertical variant="subtle" class="my-2"/>            <flux:dropdown class="max-lg:hidden">                <flux:navbar.item icon:trailing="chevron-down">Favorites</flux:navbar.item>                <flux:navmenu>                    <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>                    <flux:navmenu.item href="#">Android app</flux:navmenu.item>                    <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>                </flux:navmenu>            </flux:dropdown>        </flux:navbar>        <flux:spacer />        <flux:navbar class="me-4">            <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />        </flux:navbar>        <flux:dropdown position="top" align="start">            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />            <flux:menu>                <flux:menu.radio.group>                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                    <flux:menu.radio>Truly Delta</flux:menu.radio>                </flux:menu.radio.group>                <flux:menu.separator />                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:header>    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />        <flux:navlist variant="outline">            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>            <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>            <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>            <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>            <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">                <flux:navlist.item href="#">Marketing site</flux:navlist.item>                <flux:navlist.item href="#">Android app</flux:navlist.item>                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>            </flux:navlist.group>        </flux:navlist>        <flux:spacer />        <flux:navlist variant="outline">            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>        </flux:navlist>    </flux:sidebar>    <flux:main container>        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>        <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>        <flux:separator variant="subtle" />    </flux:main>    @fluxScripts</body>

[Secondary sidebar](#secondary-sidebar)
---------------------------------------

Use a sidebar for secondary navigation.

[Fullscreen](/demo/header-with-sidebar) Demo Code

 ![](/img/demo/layout-header-with-sidebar.png) ![](/img/demo/layout-header-with-sidebar-dark.png)

Copy to clipboard

    <head>    <!-- ... -->    @fluxAppearance</head><body class="min-h-screen bg-white dark:bg-zinc-800">    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />        <flux:navbar class="-mb-px max-lg:hidden">            <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>            <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>            <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>            <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>            <flux:separator vertical variant="subtle" class="my-2"/>            <flux:dropdown class="max-lg:hidden">                <flux:navbar.item icon:trailing="chevron-down">Favorites</flux:navbar.item>                <flux:navmenu>                    <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>                    <flux:navmenu.item href="#">Android app</flux:navmenu.item>                    <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>                </flux:navmenu>            </flux:dropdown>        </flux:navbar>        <flux:spacer />        <flux:navbar class="me-4">            <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />        </flux:navbar>        <flux:dropdown position="top" align="start">            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />            <flux:menu>                <flux:menu.radio.group>                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                    <flux:menu.radio>Truly Delta</flux:menu.radio>                </flux:menu.radio.group>                <flux:menu.separator />                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:header>    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />        <flux:navlist variant="outline">            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>            <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>            <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>            <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>            <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">                <flux:navlist.item href="#">Marketing site</flux:navlist.item>                <flux:navlist.item href="#">Android app</flux:navlist.item>                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>            </flux:navlist.group>        </flux:navlist>        <flux:spacer />        <flux:navlist variant="outline">            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>        </flux:navlist>    </flux:sidebar>    <flux:main container>        <div class="flex max-md:flex-col items-start">            <div class="w-full md:w-[220px] pb-4 me-10">                <flux:navlist>                    <flux:navlist.item href="#" current>Dashboard</flux:navlist.item>                    <flux:navlist.item href="#" badge="32">Orders</flux:navlist.item>                    <flux:navlist.item href="#">Catalog</flux:navlist.item>                    <flux:navlist.item href="#">Payments</flux:navlist.item>                    <flux:navlist.item href="#">Customers</flux:navlist.item>                    <flux:navlist.item href="#">Billing</flux:navlist.item>                    <flux:navlist.item href="#">Quotes</flux:navlist.item>                    <flux:navlist.item href="#">Configuration</flux:navlist.item>                </flux:navlist>            </div>            <flux:separator class="md:hidden" />            <div class="flex-1 max-md:pt-6 self-stretch">                <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>                <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>                <flux:separator variant="subtle" />            </div>        </div>    </flux:main>    @fluxScripts</body>

Related components
------------------

[

Sidebar

Create primary or secondary navigation sidebars



](/layouts/sidebar)[

Brand

Display your company logo and name consistently



](/components/brand)[

Navbar

Build responsive navigation bars with dropdown menus



](/components/navbar)[

Profile

Show user avatars and profile information



](/components/profile)

Reference
---------

### [flux:header](#fluxheader)

Prop

Description

sticky

When present, makes the header sticky when scrolling.

container

When present, constrains the header content to a container width.

Slot

Description

default

Content to display within the header, typically including branding, navigation, and user profile elements.

CSS

Description

class

Additional CSS classes applied to the header. Common uses: bg-zinc-50, border-b, sticky, etc.

### [flux:sidebar.toggle](#fluxsidebartoggle)

Attribute

Description

icon

The icon to display in the toggle button (e.g., bars-2, x-mark).

inset

Positioning of the toggle button (e.g., left).

CSS

Description

class

Additional CSS classes applied to the toggle button. Common uses: lg:hidden to show only on mobile.

### [flux:main](#fluxmain)

Prop

Description

container

When present, constrains the main content to a container width.

Slot

Description

default

Content to display within the main content area.

---

## Heading

Heading
=======

A consistent heading component for your application.

User profile

This information will be displayed publicly.

Copy to clipboard

    <flux:heading>User profile</flux:heading><flux:text class="mt-2">This information will be displayed publicly.</flux:text>

[Sizes](#sizes)
---------------

Flux offers three different heading sizes that should cover most use cases in your app.

Default

14px · Use liberally—think input and toast labels.

Large

16px · Use sparingly—think modal and card headings.

Extra large

24px · Use rarely—think hero text.

Copy to clipboard

    <flux:heading>Default</flux:heading><flux:heading size="lg">Large</flux:heading><flux:heading size="xl">Extra large</flux:heading>

[Heading level](#heading-level)
-------------------------------

Control the heading level: h1, h2, h3, that will be used for the heading element. Without a level prop, the heading will default to a div.

### User profile

This information will be displayed publicly.

Copy to clipboard

    <flux:heading level="3">User profile</flux:heading><flux:text class="mt-2">This information will be displayed publicly.</flux:text>

Examples
--------

### [Leading subheading](#leading-subheading)

Subheadings can be placed above headings for a more interesting arrangment.

Year to date

$7,532.16

15.2%

Copy to clipboard

    <div>    <flux:text>Year to date</flux:text>    <flux:heading size="xl" class="mb-1">$7,532.16</flux:heading>    <div class="flex items-center gap-2">        <flux:icon.arrow-trending-up variant="micro" class="text-green-600 dark:text-green-500" />        <span class="text-sm text-green-600 dark:text-green-500">15.2%</span>    </div></div>

Related components
------------------

[

Text

Format paragraphs and textual content with consistent styling



](/components/text)[

Card

Containers for content with consistent styling



](/components/card)

Reference
---------

### [flux:heading](#fluxheading)

Prop

Description

size

Size of the heading. Options: base, lg, xl. Default: base.

level

HTML heading level. Options: 1, 2, 3, 4. Default: renders as a div if not specified.

accent

If true, applies accent color styling to the heading.

### [flux:text](#fluxtext)

Prop

Description

size

Size of the text. Options: sm, base, lg, xl. Default: base.

---

## Help

Help
====

Our number one priority is to make Flux the best UI library for Livewire applications. If you're having trouble with Flux, please reach out to us for help.

Found a bug?
------------

Please create an isolated, succinct, snippet of code that we can use to reproduce your issue and submit it via a GitHub issue on the livewire/flux repository.

[\-> Submit a bug report](https://github.com/livewire/flux/issues/new?template=bug_report.yml)

Have a feature request?
-----------------------

Please submit your feature request via a GitHub discussion on the livewire/flux repository.

[\-> Submit a feature request](https://github.com/livewire/flux/discussions/new?category=feature-requests)

Need help with billing, licensing, etc.
---------------------------------------

If you have any questions related to purchases, refunds, licensing, discounts, etc., you can email our support inbox.

[\-> Send us an email at \[email protected\]](/cdn-cgi/l/email-protection#added8ddddc2dfd9edcbc1d8d5d8c483c9c8db)

---

## Icon

Icon
====

Flux uses the excellent Heroicons project for its icon collection. Heroicons is a set of beautiful and functional icons crafted by the fine folks at [Tailwind Labs](https://tailwindcss.com)

Search for the exact icon you need over at [Heroicons](https://heroicons.com/)

Copy to clipboard

    <flux:icon.bolt />

[Variants](#variants)
---------------------

There are four variants for each icon: outline (default), solid, mini, and micro.

Copy to clipboard

    <flux:icon.bolt />                  <!-- 24px, outline --><flux:icon.bolt variant="solid" />  <!-- 24px, filled --><flux:icon.bolt variant="mini" />   <!-- 20px, filled --><flux:icon.bolt variant="micro" />  <!-- 16px, filled -->

[Sizes](#sizes)
---------------

Control the size (height/width) of an icon using the size-\* Tailwind utility.

Avoid tweaking icon sizes. Each variant is specifically designed for its default size.

Copy to clipboard

    <flux:icon.bolt class="size-12" /><flux:icon.bolt class="size-10" /><flux:icon.bolt class="size-8" />

[Color](#color)
---------------

You can customize the color of an icon using Tailwind's [text color utilities](https://tailwindcss.com/docs/text-color)

Copy to clipboard

    <flux:icon.bolt variant="solid" class="text-amber-500 dark:text-amber-300" />

[Loading spinner](#loading-spinner)
-----------------------------------

Flux has a special loading spinner icon that isn't part of the Heroicons collection. You can use this special icon anywhere you would normally use a standard icon.

Copy to clipboard

    <flux:icon.loading />

[Lucide icons](#lucide-icons)
-----------------------------

We love Heroicons, but we acknowledge that it's a fairly limited icon set. If you need more icons, we recommend using [Lucide](https://lucide.dev/) instead.

To make it trivial to use Lucide icons, Flux provides a convenient artisan command to import them into your project:

    php artisan flux:icon

This command will prompt you to select which icons you want to import. You can also manually specify the icons you want to import by passing in their names as arguments to the command:

    php artisan flux:icon crown grip-vertical github

Copy to clipboard

    <flux:icon.crown /><flux:icon.grip-vertical /><flux:icon.github />

[Custom icons](#custom-icons)
-----------------------------

For full control over your icons, you can create your own Blade files in the resources/views/flux/icon directory in your project.

    - resources    - views        - flux            - icon                - wink.blade.php

You can simply paste SVG code directly into the Blade file, however we recommend using the following template structure to ensure compatibility with other components:

Copy to clipboard

    @php $attributes = $unescapedForwardedAttributes ?? $attributes; @endphp@props([    'variant' => 'outline',])@php$classes = Flux::classes('shrink-0')    ->add(match($variant) {        'outline' => '[:where(&)]:size-6',        'solid' => '[:where(&)]:size-6',        'mini' => '[:where(&)]:size-5',        'micro' => '[:where(&)]:size-4',    });@endphp{{-- Your SVG code here: --}}<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" ... >    ...</svg>

Copy to clipboard

    <flux:icon.wink />

Related components
------------------

[

Button

Interactive controls with integrated icons



](/components/button)[

Input

Text fields with leading or trailing icons



](/components/input)[

Badge

Small indicators with optional icon content



](/components/badge)

Reference
---------

### [flux:icon.\*](#fluxicon)

All icon components (e.g., flux:icon.bolt, flux:icon.loading) share the same props and behavior.

Prop

Description

variant

Visual style of the icon. Options: outline (default), solid, mini, micro.

Class

Description

size-\*

Control the size of the icon using Tailwind's size utilities (e.g., size-8, size-12).

text-\*

Control the color of the icon using Tailwind's text color utilities (e.g., text-blue-500).

Attribute

Description

data-flux-icon

Applied to the root SVG element for styling and identification.

### [Icon sizes](#icon-sizes)

Size

Description

outline

24x24 pixels (default)

solid

24x24 pixels

mini

20x20 pixels

micro

16x16 pixels

---

## Input

Input
=====

Capture user data with various forms of text input.

Username This will be publicly displayed.

Copy to clipboard

    <flux:input wire:model="username" label="Username" description="This will be publicly displayed." />

[Longhand](#longhand)
---------------------

Flux makes it easy to wrap your inputs in a field with label/description and error messages. If you need more control over the layout of these fields, you can assemble the individual field components.

Copy to clipboard

    <flux:field>    <flux:label>Username</flux:label>    <flux:description>This will be publicly displayed.</flux:description>    <flux:input />    <flux:error name="username" /></flux:field>

[Class targeting](#class-targeting)
-----------------------------------

Unlike other form components, Flux's input component is composed of two underlying elements: an input element and a wrapper div. The wrapper div is there to add padding where icons should go.

This is typically fine, however, if you need to pass classes into the input component and have them directly applied to the input element, you can do so using the class:input attribute instead of simply class:

Copy to clipboard

    <flux:input class="max-w-xs" class:input="font-mono" />

[Types](#types)
---------------

Use the browser's various input types for different situations: text, email, password, etc.

Email

Password

Date

Copy to clipboard

    <flux:input type="email" label="Email" /><flux:input type="password" label="Password" /><flux:input type="date" max="2999-12-31" label="Date" />

[File](#file)
-------------

Flux provides a special input component for file uploads. It's a simple wrapper around the native input\[type="file"\] element.

Logo

Choose file

No file chosen

Attachments

Choose files

No file chosen

Copy to clipboard

    <flux:input type="file" wire:model="logo" label="Logo"/><flux:input type="file" wire:model="attachments" label="Attachments" multiple />

[Smaller](#smaller)
-------------------

Use the size prop to make the input's height more compact.

Copy to clipboard

    <flux:input size="sm" placeholder="Filter by..." />

[Disabled](#disabled)
---------------------

Prevent users from interacting with an input by disabling it.

Email

Copy to clipboard

    <flux:input disabled label="Email" />

[Readonly](#readonly)
---------------------

Useful for locking an input during a form submission.

Public API key

Copy to clipboard

    <flux:input readonly variant="filled" />

[Invalid](#invalid)
-------------------

Signal to users that the contents of an input are invalid.

Copy to clipboard

    <flux:input invalid />

[Input masking](#input-masking)
-------------------------------

Restrict the formatting of text content for unique cases by using [Alpine's mask plugin](https://alpinejs.dev/plugins/mask)

Copy to clipboard

    <flux:input mask="(999) 999-9999" value="7161234567" />

[Icons](#icons)
---------------

Append or prepend an icon to the inside of a form input.

Copy to clipboard

    <flux:input icon="magnifying-glass" placeholder="Search orders" /><flux:input icon:trailing="credit-card" placeholder="4444-4444-4444-4444" /><flux:input icon:trailing="loading" placeholder="Search transactions" />

[Icon buttons](#icon-buttons)
-----------------------------

Append a button to the inside of an input to provide associated functionality.

Copy to clipboard

    <flux:input placeholder="Search orders">    <x-slot name="iconTrailing">        <flux:button size="sm" variant="subtle" icon="x-mark" class="-mr-1" />    </x-slot></flux:input><flux:input type="password" value="password">    <x-slot name="iconTrailing">        <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />    </x-slot></flux:input>

[Clearable, copyable, and viewable inputs](#clearable-copyable-and-viewable-inputs)
-----------------------------------------------------------------------------------

Flux provides three special input properties to configure common input button behaviors. clearable for clearing contents, copyable for copying contents, and viewable for toggling password visibility.

Copy to clipboard

    <flux:input placeholder="Search orders" clearable /><flux:input type="password" value="password" viewable /><flux:input icon="key" value="FLUX-1234-5678-ABCD-EFGH" readonly copyable />

[Keyboard hint](#keyboard-hint)
-------------------------------

Hint to users what keyboard shortcuts they can use with this input.

⌘K

Copy to clipboard

    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..."/>

[As a button](#as-a-button)
---------------------------

To render an input using a button element, pass "button" into the as prop.

Search...

⌘K

Copy to clipboard

    <flux:input as="button" placeholder="Search..." icon="magnifying-glass" kbd="⌘K" />

[With buttons](#with-buttons)
-----------------------------

Attach buttons to the beginning or end of an input element.

New post

USD EUR GBP CAD AUD JPY CNY INR

Copy to clipboard

    <flux:input.group>    <flux:input placeholder="Post title" />    <flux:button icon="plus">New post</flux:button></flux:input.group><flux:input.group>    <flux:select class="max-w-fit">        <flux:select.option selected>USD</flux:select.option>        <!-- ... -->    </flux:select>    <flux:input placeholder="$99.99" /></flux:input.group>

[Text prefixes and suffixes](#text-prefixes-and-suffixes)
---------------------------------------------------------

Append text inside a form input.

https://

.brand.com

Copy to clipboard

    <flux:input.group>    <flux:input.group.prefix>https://</flux:input.group.prefix>    <flux:input placeholder="example.com" /></flux:input.group><flux:input.group>    <flux:input placeholder="chunky-spaceship" />    <flux:input.group.suffix>.brand.com</flux:input.group.suffix></flux:input.group>

[Input group labels](#input-group-labels)
-----------------------------------------

If you want to use an input group in a form field with a label, you will need to wrap the input group in a field component.

Website

https://

Copy to clipboard

    <flux:field>    <flux:label>Website</flux:label>    <flux:input.group>        <flux:input.group.prefix>https://</flux:input.group.prefix>        <flux:input wire:model="website" placeholder="example.com" />    </flux:input.group>    <flux:error name="website" /></flux:field>

Related components
------------------

[

Field

Structured form field with label and validation states



](/components/field)[

Textarea

Multi-line text input areas for longer form content



](/components/textarea)[

Autocomplete

Enhanced text input with predictive suggestions



](/components/autocomplete)

Reference
---------

### [flux:input](#fluxinput)

Prop

Description

wire:model

Binds the input to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

label

Label text displayed above the input. When provided, wraps the input in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed above the input. When provided alongside label, appears between the label and input within the flux:field wrapper. See the [field component](/components/field).

description:trailing

Help text displayed below the input. When provided alongside label, appears between the label and input within the flux:field wrapper. See the [field component](/components/field).

placeholder

Placeholder text displayed when the input is empty.

size

Size of the input. Options: sm, xs.

variant

Visual style variant. Options: filled. Default: outline.

disabled

Prevents user interaction with the input.

readonly

Makes the input read-only.

invalid

Applies error styling to the input.

multiple

For file inputs, allows selecting multiple files.

mask

Input mask pattern using Alpine's mask plugin. Example: 99/99/9999.

icon

Name of the icon displayed at the start of the input.

icon:trailing

Name of the icon displayed at the end of the input.

kbd

Keyboard shortcut hint displayed at the end of the input.

clearable

If true, displays a clear button when the input has content.

copyable

If true, displays a copy button to copy the input's content.

viewable

For password inputs, displays a toggle to show/hide the password.

as

Render the input as a different element. Options: button. Default: input.

class:input

CSS classes applied directly to the input element instead of the wrapper.

Slot

Description

icon

Custom content displayed at the start of the input (e.g., icons).

icon:leading

Custom content displayed at the start of the input (e.g., icons).

icon:trailing

Custom content displayed at the end of the input (e.g., buttons).

Attribute

Description

data-flux-input

Applied to the root element for styling and identification.

### [flux:input.group](#fluxinputgroup)

Slot

Description

default

The input group content, typically containing an input and prefix/suffix elements.

### [flux:input.group.prefix](#fluxinputgroupprefix)

Slot

Description

default

Content displayed before the input (e.g., icons, text, buttons).

### [flux:input.group.suffix](#fluxinputgroupsuffix)

Slot

Description

default

Content displayed after the input (e.g., icons, text, buttons).

See the [field component documentation](/components/field) for more information.

---

## Installation

Installation
============

Flux is a robust, hand-crafted, UI component library for your Livewire applications. It's built using [Tailwind CSS](https://tailwindcss.com/) and provides a set of components that are easy to use and customize.

Starting a new project? Flux comes baked into the new [Livewire starter kit \->](https://laravel.com/docs/12.x/starter-kits#livewire)

Prerequisites
-------------

Flux requires the following before installing:

[

Laravel

Version 10 or later

](https://laravel.com/docs/11.x/installation)[

Livewire

Version 3.5.19 or later

](https://livewire.laravel.com/docs/installation)[

Tailwind CSS

Version 4 or later

](https://tailwindcss.com/docs/installation)

Getting started
---------------

1

Install Flux

Flux can be installed via composer from your project root:

Copy to clipboard

    composer require livewire/flux

2

Install Flux Pro (optional)

If you have purchased a Flux Pro license, you can install it using the following command:

Copy to clipboard

    php artisan flux:activate

During the activation process, you will be prompted to enter an email and license key.

_If you haven't purchased a Flux Pro license, [you can purchase one here \->](/pricing)._

The above command will create an auth.json file in your project's root directory. This file contains your email and license key for downloading and installing Flux and should not be added to version control.

Because auth.json is not version controlled, you will need to manually recreate it in every new project environment. See below for how to [activate in CI](#activating-in-ci) or [activate using Laravel Forge](#activating-using-laravel-forge).

You can also view your [licenses and their associated install instructions here \->](/dashboard)

3

Include Flux assets

Now, add the @fluxAppearance and @fluxScripts Blade directives to your layout file:

Copy to clipboard

    <head>    ...    @fluxAppearance</head><body>    ...    @fluxScripts</body>

4

Set up Tailwind CSS

The last step is to set up Tailwind CSS. Flux uses Tailwind CSS for its default styling.

_Flux v2.0 requires Tailwind CSS v4.0 or later._

If you already have Tailwind installed in your project, just add the following configuration to your resources/css/app.css file:

Copy to clipboard

    @import 'tailwindcss';@import '../../vendor/livewire/flux/dist/flux.css';@custom-variant dark (&:where(.dark, .dark *));

If you don't have Tailwind installed, you can learn how to install it on the [Tailwind website](https://tailwindcss.com/docs/guides/laravel).

5

Use the Inter font family

Although completely optional, we recommend using the [Inter font family](https://rsms.me/inter) for your application.

Add the following to the head tag in your layout file to ensure the font is loaded:

Copy to clipboard

    <head>    ...    <link rel="preconnect" href="https://fonts.bunny.net">    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" /></head>

You can configure Tailwind to use this font family in your resources/css/app.css file:

Copy to clipboard

    @import 'tailwindcss';@import '../../vendor/livewire/flux/dist/flux.css';...@theme {    --font-sans: Inter, sans-serif;}

Theming
-------

We've meticulously designed Flux to look great out of the box, however, every project has its own identity. You can choose from our hand-picked color schemes or build your own theme by customizing CSS variables.

[Learn more about theming Flux \->](/docs/theming)

Disable dark mode
-----------------

By default, Flux will handle the appearance of your application by adding a dark class to the html element depending on the user's system preference or selected appearance.

[Learn more about dark mode \->](/docs/dark-mode)

If you don't want Flux to handle this for you, you can remove the @fluxAppearance directive from your layout file.

Copy to clipboard

    <head>    ...--    @fluxAppearance</head>

Now you can handle the appearance of your application manually.

Publishing components
---------------------

To keep things simple, you can use the internal Flux components in your Blade files directly. However, if you'd like to customize a specific Flux component, you can publish its blade file(s) into your project using the following Artisan command:

Copy to clipboard

    php artisan flux:publish

You will be prompted to search and select which components you want to publish. If you want to publish all components at once, you can use the \--all flag.

[Learn more about customizing Flux \->](/docs/customization)

Keeping Flux updated
--------------------

To ensure you have the latest version of Flux, regularly update your composer dependencies:

Copy to clipboard

    composer update livewire/flux livewire/flux-pro

If you've published Flux components, make sure to check the changelog for any breaking changes before updating:

[Flux release notes (changelog) \->](https://github.com/livewire/flux/releases)

Activating in CI
----------------

If you are using Flux in a CI environment without an auth.json file, you can add the following environment variables and command to your CI script:

Copy to clipboard

    composer config http-basic.composer.fluxui.dev "${FLUX_USERNAME}" "${FLUX_LICENSE_KEY}"

Activating using Laravel Forge
------------------------------

If you are using Laravel Forge, you can take advantage of their built in [Packages](https://forge.laravel.com/docs/sites/packages.html) feature for authenticating private composer packages.

Laravel Forge allows you to manage packages on a server or site level. If you have multiple sites using Flux, then it's recommended to manage Packages on the server level.

To authenticate Flux, head over to the packages page on either the server or site. You will then see the following:

![Laravel Forge Packages](/img/forge-activation.png)

Click the "Add Credential" button to authenticate with a new private composer package and enter the following details:

*   Enter composer.fluxui.dev as the Repository URL
*   Enter your Flux account email as the username
*   Enter your Flux license key as the password

Finally, click the "Save" button. You should now be authenticated with the Flux private composer server and be able install Flux using composer require livewire/flux-pro

For more information, please refer to the [Laravel Forge Packages documentation](https://forge.laravel.com/docs/sites/packages.html).

Activating using Laravel Cloud
------------------------------

If you are using Laravel Cloud, you will need to use their [Build Commands](https://cloud.laravel.com/docs/environments#build-commands) feature for authenticating private composer packages.

To authenticate Flux, open up the environment you wish to use Flux in and go to "Settings" and then "Deployments".

![Laravel Cloud Environment Settings](/img/cloud-install.png)

There you will find a "Build Commands" section. Add the following command above the existing composer install command:

Copy to clipboard

    composer config http-basic.composer.fluxui.dev your-email your-license-key

Make sure to replace \`your-email\` and \`your-license-key\` with your actual Flux account email and license key, which you can find on your [dashboard \->](/dashboard).

Finally, click the "Save" button. You should now be authenticated with the Flux private composer server and be able deploy your application.

For more information, please refer to the [Laravel Cloud Private Composer Packages documentation](https://cloud.laravel.com/docs/environments#private-composer-packages).

Configuring nginx
-----------------

If you run into problems loading Flux's JavaScript and CSS assets, you may need to configure your nginx server to allow for this.

By default, Flux exposes two routes in your application to serve its assets from: /flux/flux.js and /flux/flux.css.

This is fine for most applications, however, if you are using nginx with a custom configuration, you may receive a 404 from this endpoint.

To fix this issue, you can add the following to your nginx configuration:

Copy to clipboard

    location ~ ^/flux/flux(\.min)?\.(js|css)$ {    expires off;    try_files $uri $uri/ /index.php?$query_string;}

---

## Modal

Modal
=====

Display content in a layer above the main page. Ideal for confirmations, alerts, and forms.

Edit profile

Update profile

Make changes to your personal details.

Name

Date of birth

Save changes

Copy to clipboard

    <flux:modal.trigger name="edit-profile">    <flux:button>Edit profile</flux:button></flux:modal.trigger><flux:modal name="edit-profile" class="md:w-96">    <div class="space-y-6">        <div>            <flux:heading size="lg">Update profile</flux:heading>            <flux:text class="mt-2">Make changes to your personal details.</flux:text>        </div>        <flux:input label="Name" placeholder="Your name" />        <flux:input label="Date of birth" type="date" />        <div class="flex">            <flux:spacer />            <flux:button type="submit" variant="primary">Save changes</flux:button>        </div>    </div></flux:modal>

[Unique modal names](#unique-modal-names)
-----------------------------------------

If you are placing modals inside a loop, ensure that you are dynamically generating unique modal names. Otherwise, one modal trigger, will trigger all modals of that name on the page causing unexpected behavior.

Copy to clipboard

    @foreach ($users as $user)    <flux:modal :name="'edit-profile-'.$user->id">        ...    </flux:modal>@endforeach

[Livewire methods](#livewire-methods)
-------------------------------------

In addition to triggering modals in your Blade templates, you can also control them directly from Livewire.

Consider a "confirm" modal in your Blade template like so:

Copy to clipboard

    <flux:modal name="confirm">    <!-- ... --></flux:modal>

You can now open and close this modal from your Livewire component using the following methods:

Copy to clipboard

    <?phpclass ShowPost extends \Livewire\Component {    public function delete() {        // Control "confirm" modals anywhere on the page...        Flux::modal('confirm')->show();        Flux::modal('confirm')->close();        // Control "confirm" modals within this Livewire component...        $this->modal('confirm')->show();        $this->modal('confirm')->close();        // Closes all modals on the page...        Flux::modals()->close();    }}

[JavaScript methods](#javascript-methods)
-----------------------------------------

You can also control modals from Alpine directly using Flux's magic methods:

Copy to clipboard

    <button x-on:click="$flux.modal('confirm').show()">    Open modal</button><button x-on:click="$flux.modal('confirm').close()">    Close modal</button><button x-on:click="$flux.modals().close()">    Close all modals</button>

Or you can use the window.Flux global object to control modals from any JavaScript in your application:

Copy to clipboard

    // Control "confirm" modals anywhere on the page...Flux.modal('confirm').show()Flux.modal('confirm').close()// Closes all modals on the page...Flux.modals().close()

[Data binding](#data-binding)
-----------------------------

If you prefer, you can bind a Livewire property directly to a modal to control its states from your Livewire component.

Consider a confirmation modal in your Blade template like so:

Copy to clipboard

    <flux:modal wire:model.self="showConfirmModal">    <!-- ... --></flux:modal>

It's important to add the .self modifier to the wire:model attribute to prevent nested elements from dispatching input events that would interfere with the state of the modal.

You can now open and close this modal from your Livewire component by toggling the wire:model property.

Copy to clipboard

    <?phpclass ShowPost extends \Livewire\Component {    public $showConfirmModal = false;    public function delete() {        $this->showConfirmModal = true;    }}

One advantage of this approach is being able to control the state of the modal directly from the browser without making a server roundtrip:

Copy to clipboard

    <flux:button x-on:click="$wire.showConfirmModal = true">Delete post</flux:button>

[Close events](#close-events)
-----------------------------

If you need to perform some logic after a modal closes, you can register a close listener like so:

Copy to clipboard

    <flux:modal @close="someLivewireAction">    <!-- ... --></flux:modal>

You can also use wire:close or x-on:close if you prefer those syntaxes.

[Cancel events](#cancel-events)
-------------------------------

If you need to perform some logic after a modal is cancelled, you can register a cancel listener like so:

Copy to clipboard

    <flux:modal @cancel="someLivewireAction">    <!-- ... --></flux:modal>

You can also use wire:cancel or x-on:cancel if you prefer those syntaxes.

[Disable click outside](#disable-click-outside)
-----------------------------------------------

By default, clicking outside the modal will close it. If you want to disable this behavior, you can use the :dismissible="false" prop.

Copy to clipboard

    <flux:modal :dismissible="false">    <!-- ... --></flux:modal>

[Confirmation](#confirmation)
-----------------------------

Prompt a user for confirmation before performing a dangerous action.

Delete

Delete project?

You're about to delete this project.

This action cannot be reversed.

Cancel

Delete project

Copy to clipboard

    <flux:modal.trigger name="delete-profile">    <flux:button variant="danger">Delete</flux:button></flux:modal.trigger><flux:modal name="delete-profile" class="min-w-[22rem]">    <div class="space-y-6">        <div>            <flux:heading size="lg">Delete project?</flux:heading>            <flux:text class="mt-2">                <p>You're about to delete this project.</p>                <p>This action cannot be reversed.</p>            </flux:text>        </div>        <div class="flex gap-2">            <flux:spacer />            <flux:modal.close>                <flux:button variant="ghost">Cancel</flux:button>            </flux:modal.close>            <flux:button type="submit" variant="danger">Delete project</flux:button>        </div>    </div></flux:modal>

[Flyout](#flyout)
-----------------

Use the "flyout" variant for a more anchored and long-form dialog.

Edit profile

Update profile

Make changes to your personal details.

Name

Date of birth

Save changes

Copy to clipboard

    <flux:modal.trigger name="edit-profile">    <flux:button>Edit profile</flux:button></flux:modal.trigger><flux:modal name="edit-profile" variant="flyout">    <div class="space-y-6">        <div>            <flux:heading size="lg">Update profile</flux:heading>            <flux:text class="mt-2">Make changes to your personal details.</flux:text>        </div>        <flux:input label="Name" placeholder="Your name" />        <flux:input label="Date of birth" type="date" />        <div class="flex">            <flux:spacer />            <flux:button type="submit" variant="primary">Save changes</flux:button>        </div>    </div></flux:modal>

Flyout positioning
------------------

By default, flyouts will open from the right. You can change this behavior by passing "left", or "bottom" into the position prop.

Copy to clipboard

    <flux:modal variant="flyout" position="left">    <!-- ... --></flux:modal>

Related components
------------------

[

Dropdown

Display expandable action or navigation menus



](/components/dropdown)[

Command

Keyboard command palettes for application navigation



](/components/command)

Reference
---------

### [flux:modal](#fluxmodal)

Prop

Description

name

Unique identifier for the modal. Required when using triggers.

variant

Visual style of the modal. Options: default, flyout, bare.

position

For flyout modals, the direction they open from. Options: right (default), left, bottom.

dismissible

If false, prevents closing the modal by clicking outside. Default: true.

wire:model

Optional Livewire property to bind the modal's open state to.

Event

Description

close

Triggered when the modal is closed by any means.

cancel

Triggered when the modal is closed by clicking outside or pressing escape.

Slot

Description

default

The modal content.

Class

Description

w-\*

Common use: md:w-96 for width.

### [flux:modal.trigger](#fluxmodaltrigger)

Prop

Description

name

Name of the modal to trigger. Must match the modal's name.

shortcut

Keyboard shortcut to open the modal (e.g., cmd.k).

Slot

Description

default

The trigger element (e.g., button).

### [flux:modal.close](#fluxmodalclose)

Slot

Description

default

The close trigger element (e.g., button).

### [Flux::modal()](#fluxmodal)

PHP method for controlling modals from Livewire components.

Parameter

Description

default|name

Name of the modal to control.

Method

Description

close()

Closes the modal.

### [Flux::modals()](#fluxmodals)

PHP method for controlling all modals on the page.

Method

Description

close()

Closes all modals on the page.

### [$flux.modal()](#fluxmodal)

Alpine.js magic method for controlling modals.

Parameter

Description

default|name

Name of the modal to control.

Method

Description

show()

Shows the modal.

close()

Closes the modal.

---

## Navbar

Navbar
======

Arrange navigation links vertically or horizontally.

Discover more about the navbar on the [layout documentation \->](/layouts/sidebar)

[

Home

](#)[

Features

](#)[

Pricing

](#)[

About

](#)

Copy to clipboard

    <flux:navbar>    <flux:navbar.item href="#">Home</flux:navbar.item>    <flux:navbar.item href="#">Features</flux:navbar.item>    <flux:navbar.item href="#">Pricing</flux:navbar.item>    <flux:navbar.item href="#">About</flux:navbar.item></flux:navbar>

[Detecting the current page](#detecting-the-current-page)
---------------------------------------------------------

Navbars and navlists will try to automatically detect and mark the current page based on the href attribute passed in. However, if you need full control, you can pass the current prop to the item directly.

Copy to clipboard

    <flux:navbar.item href="/" current>Home</flux:navbar.item><flux:navbar.item href="/" :current="false">Home</flux:navbar.item><flux:navbar.item href="/" :current="request()->is('/')">Home</flux:navbar.item>

[With icons](#with-icons)
-------------------------

Add a leading icons for visual context.

[

Home

](#)[

Features

](#)[

Pricing

](#)[

About

](#)

Copy to clipboard

    <flux:navbar>    <flux:navbar.item href="#" icon="home">Home</flux:navbar.item>    <flux:navbar.item href="#" icon="puzzle-piece">Features</flux:navbar.item>    <flux:navbar.item href="#" icon="currency-dollar">Pricing</flux:navbar.item>    <flux:navbar.item href="#" icon="user">About</flux:navbar.item></flux:navbar>

[With badges](#with-badges)
---------------------------

Add a trailing badge to a navbar item using the badge prop.

[

Home

](#)[

Inbox

12](#)[

Contacts

](#)[

Calendar

Pro](#)

Copy to clipboard

    <flux:navbar>    <flux:navbar.item href="#">Home</flux:navbar.item>    <flux:navbar.item href="#" badge="12">Inbox</flux:navbar.item>    <flux:navbar.item href="#">Contacts</flux:navbar.item>    <flux:navbar.item href="#" badge="Pro" badge-color="lime">Calendar</flux:navbar.item></flux:navbar>

[Dropdown navigation](#dropdown-navigation)
-------------------------------------------

Condense multiple navigation items into a single dropdown menu to save on space and group related items.

[

Dashboard

](#)[

Transactions

](#)

Account

[Profile](#) [Settings](#) [Billing](#)

Copy to clipboard

    <flux:navbar>    <flux:navbar.item href="#">Dashboard</flux:navbar.item>    <flux:navbar.item href="#">Transactions</flux:navbar.item>    <flux:dropdown>        <flux:navbar.item icon:trailing="chevron-down">Account</flux:navbar.item>        <flux:navmenu>            <flux:navmenu.item href="#">Profile</flux:navmenu.item>            <flux:navmenu.item href="#">Settings</flux:navmenu.item>            <flux:navmenu.item href="#">Billing</flux:navmenu.item>        </flux:navmenu>    </flux:dropdown></flux:navbar>

[Navlist (sidebar)](#navlist-sidebar)
-------------------------------------

Arrange your navbar vertically using the navlist component.

[

Home

](#)[

Features

](#)[

Pricing

](#)[

About

](#)

Copy to clipboard

    <flux:navlist class="w-64">    <flux:navlist.item href="#" icon="home">Home</flux:navlist.item>    <flux:navlist.item href="#" icon="puzzle-piece">Features</flux:navlist.item>    <flux:navlist.item href="#" icon="currency-dollar">Pricing</flux:navlist.item>    <flux:navlist.item href="#" icon="user">About</flux:navlist.item></flux:navlist>

[Navlist group](#navlist-group)
-------------------------------

Group related navigation items.

Account

[

Profile

](#)[

Settings

](#)[

Billing

](#)

Copy to clipboard

    <flux:navlist>    <flux:navlist.group heading="Account" class="mt-4">        <flux:navlist.item href="#">Profile</flux:navlist.item>        <flux:navlist.item href="#">Settings</flux:navlist.item>        <flux:navlist.item href="#">Billing</flux:navlist.item>    </flux:navlist.group></flux:navlist>

[Collapsible groups](#collapsible-groups)
-----------------------------------------

Group related navigation items into collapsible sections using the expandable prop.

[

Dashboard

](#)[

Transactions

](#)

Account

[

Profile

](#)[

Settings

](#)[

Billing

](#)

Copy to clipboard

    <flux:navlist class="w-64">    <flux:navlist.item href="#" icon="home">Dashboard</flux:navlist.item>    <flux:navlist.item href="#" icon="list-bullet">Transactions</flux:navlist.item>    <flux:navlist.group heading="Account" expandable>        <flux:navlist.item href="#">Profile</flux:navlist.item>        <flux:navlist.item href="#">Settings</flux:navlist.item>        <flux:navlist.item href="#">Billing</flux:navlist.item>    </flux:navlist.group></flux:navlist>

If you want a group to be collapsed by default, you can use the expanded prop:

Copy to clipboard

    <flux:navlist.group heading="Account" expandable :expanded="false">

[Navlist badges](#navlist-badges)
---------------------------------

Show additional information related to a navlist item using the badge prop.

[

Home

](#)[

Inbox

12](#)[

Contacts

](#)[

Calendar

Pro](#)

Copy to clipboard

    <flux:navlist class="w-64">    <flux:navlist.item href="#" icon="home">Home</flux:navlist.item>    <flux:navlist.item href="#" icon="envelope" badge="12">Inbox</flux:navlist.item>    <flux:navlist.item href="#" icon="user-group">Contacts</flux:navlist.item>    <flux:navlist.item href="#" icon="calendar-days" badge="Pro" badge-color="lime">Calendar</flux:navlist.item></flux:navlist>

Related components
------------------

[

Tabs

Organize content into separate panels



](/components/tabs)[

Header

Top navigation headers for your application



](/layouts/header)[

Sidebar

Primary or secondary navigation sidebars



](/layouts/sidebar)

Reference
---------

### [flux:navbar](#fluxnavbar)

A horizontal navigation container.

Slot

Description

default

The navigation items.

Attribute

Description

data-flux-navbar

Applied to the root element for styling and identification.

### [flux:navbar.item](#fluxnavbaritem)

Prop

Description

href

URL the item links to.

current

If true, applies active styling to the item. Auto-detected based on current URL if not specified.

icon

Name of the icon to display at the start of the item.

icon:trailing

Name of the icon to display at the end of the item.

Attribute

Description

data-current

Applied when the item is active/current.

### [flux:navlist](#fluxnavlist)

A vertical navigation container (sidebar).

Slot

Description

default

The navigation items and groups.

Attribute

Description

data-flux-navlist

Applied to the root element for styling and identification.

### [flux:navlist.item](#fluxnavlistitem)

Prop

Description

href

URL the item links to.

current

If true, applies active styling to the item. Auto-detected based on current URL if not specified.

icon

Name of the icon to display at the start of the item.

Attribute

Description

data-current

Applied when the item is active/current.

### [flux:navlist.group](#fluxnavlistgroup)

Prop

Description

heading

Text displayed as the group heading.

expandable

If true, makes the group collapsible.

expanded

If true, expands the group by default when expandable.

Slot

Description

default

The group's navigation items.

### [Profile switcher](#profile-switcher)

---

## Pagination

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Pagination
==========

Display a series of buttons to navigate through a list of items.

Showing 1 to 5 of 24 results

1

2 3 4 5

Copy to clipboard

    <!-- $orders = Order::paginate() --><flux:pagination :paginator="$orders" />

[Simple paginator](#simple-paginator)
-------------------------------------

Use the simple paginator when working with large datasets where counting the total number of results would be expensive. The simple paginator provides "Previous" and "Next" buttons without displaying the total number of pages or records.

Copy to clipboard

    <!-- $orders = Order::simplePaginate() --><flux:pagination :paginator="$orders" />

[Large result set](#large-result-set)
-------------------------------------

When working with large result sets, the pagination component automatically adapts to show a reasonable number of page links. It shows the first and last pages, along with a window of pages around the current page, and adds ellipses for any gaps to ensure efficient navigation through numerous pages.

Showing 1 to 75 of 1000 results

1

2 3 4 5 6 7 8 9 10

...

66 67

Copy to clipboard

    <!-- $orders = Order::paginate(5) --><flux:pagination :paginator="$orders" />

Related components
------------------

[

Table

Display tabular data



](/components/table)

Reference
---------

### [flux:pagination](#fluxpagination)

Prop

Description

paginator

The paginator instance to display.

---

## Patterns

Patterns
========

Every design decision in flux was carefully and intentionally made. Understanding these intentions will make your experience with flux more intuitive.

  

Ideally, after internalizing some of flux's design philosophy, you will be able to almost guess how to use a component you're unfamiliar with.

Props vs attributes
-------------------

Props and attributes are indistinguishable on the surface, however, we've found it helpful to make a distinction between flux-provided properties called "props" and bespoke "attributes" that will be forwarded directly to an underlying HTML element.

For example, the following component uses a prop called variant as well as a bespoke x-on:change.prevent attribute:

Copy to clipboard

    <flux:button variant="primary" x-on:change.prevent="...">

When the component is rendered in the browser, the output HTML might will look something like this:

Copy to clipboard

    <button type="button" class="bg-zinc-900 ..." x-on:change.prevent="...">

As you can see, the x-on:change.prevent attribute was forwarded directly to the underlying HTML element, while the variant prop was instead internally used to customize which classes were applied to the input.

Class merging
-------------

Most flux components apply Tailwind classes to their underlying elements, however, you can also pass your own classes into components and they will be automatically merged with the classes applied by flux.

Here's an example of making a button full width by passing in the w-full Tailwind utility class:

Copy to clipboard

    <flux:button class="w-full">

Now, when the component is rendered, the output HTML will contain both the w-full class and other classes applied by flux:

Copy to clipboard

    <button type="button" class="w-full border border-zinc-200 ...">

Dealing with class merging conflicts
------------------------------------

Occasionally, you may run into conflicts when passing in a Tailwind utility that flux also applies internally.

For example, you may try to customize the background color of a button by passing in the bg-zinc-800 Tailwind utility class:

Copy to clipboard

    <flux:button class="bg-zinc-800 hover:bg-zinc-700">

However, because flux applies it's own bg-\* attributes, both classes will be rendered in the output HTML:

Copy to clipboard

    <button type="button" class="bg-zinc-800 hover:bg-zinc-700 bg-white hover:bg-zinc-100...">

Because both classes exist on the element, the one defined last in CSS wins.

Tailwind's important (!) modifier is the simplest way to resolve these conflicts:

Copy to clipboard

    <flux:button class="bg-zinc-800! hover:bg-zinc-700!">

The conflicting utilities will still both be rendered, however the user-defined ones with the ! modifier will take precedence.

Usage of the ! modifier can cause more problems than it solves. Below are a few alternatives to consider instead:

*   Publishing the component and adding your own variant
*   Globally customizing the component by styling the data attributes
*   Writing a new component for your unique case

Split attribute forwarding
--------------------------

In a perfect world, each flux component would directly render a single HTML element. However, in practice, some components are more complex than that.

For example, the flux:input component actually renders two HTML elements by default. A wrapping <div> and an underlying <input> element:

Copy to clipboard

    <div class="...">    <input type="text" class="..."></div>

This presents a problem when passing bespoke Tailwind classes into the component: which element should receive the provided classes?

In these cases flux will often split up the forwarded attributes into two groups: styling related ones like class and behavioral ones like autofocus. It will then apply each to wherever is most appropriate.

For example consider passing in the following class and autofocus attributes:

Copy to clipboard

    <flux:input class="w-full" autofocus>

Flux will apply the w-full class to the wrapping <div> element and the autofocus attribute to the underlying <input> element:

Copy to clipboard

    <div class="w-full ...">    <input type="text" class="..." autofocus></div>

Common props
------------

Now that you've seen some of the nuances of attributes, let's look at some common prop patterns you will encounter as you use Flux.

Variant
-------

First up is "variant". Any component that offers an alternate visual style uses the variant prop to do so.

Here's a list of a few common component variants:

Copy to clipboard

    <flux:button variant="primary" /><flux:input variant="filled" /><flux:modal variant="flyout" /><flux:badge variant="solid" /><flux:select variant="combobox" /><flux:separator variant="subtle" /><flux:tabs variant="segmented" />

If you find the need for a variant we don't offer, don't be afraid to [publish a component and add your own.](/docs/customization#publishing-components)

Icon
----

Rather than manually adding, styling, and spacing icons inside component slots, you can simply pass the icon prop to any component that supports it.

Flux uses [Heroicons](https://heroicons.com/) for its icon collection. Heroicons is a set of beautiful and functional icons crafted by the fine folks at [Tailwind Labs](https://tailwindcss.com).

Here's a handful of components you can pass icons into:

Copy to clipboard

    <flux:button icon="magnifying-glass" /><flux:input icon="magnifying-glass" /><flux:tab icon="cog-6-tooth" /><flux:badge icon="user" /><flux:breadcrumbs.item icon="home" /><flux:navlist.item icon="user" /><flux:navbar.item icon="user" /><flux:menu.item icon="plus" />

Occasionally, if a component supports adding an icon to the end of an element instead of the beginning by default, you can pass the icon:trailing prop as well:

Copy to clipboard

    <flux:button icon:trailing="chevron-down" /><flux:input icon:trailing="credit-card" /><flux:badge icon:trailing="x-mark" /><flux:navbar.item icon:trailing="chevron-down" />

Size
----

Some components offer size variations through the size prop.

Here are a few components that can be sized-down:

Copy to clipboard

    <flux:button size="sm" /><flux:select size="sm" /><flux:input size="sm" /><flux:tabs size="sm" />

Here are a few that can be sized up for larger visual contexts:

Copy to clipboard

    <flux:heading size="lg" /><flux:badge size="lg" />

Keyboard hints
--------------

Similar to the icon prop, many components allow you to add decorative hints for keyboard shortcuts using the kbd prop:

Copy to clipboard

    <flux:button kbd="⌘S" /><flux:tooltip kbd="D" /><flux:input kbd="⌘K" /><flux:menu.item kbd="⌘E" /><flux:command.item kbd="⌘N" />

Inset
-----

Certain components offer the inset prop which makes it easy to add the exact amount of negative margin needed to "inset" an element on any axis you specify.

This is extremely useful for putting a button or a badge inline with other text and not stretching the entire height of the container.

Copy to clipboard

    <flux:badge inset="top bottom"><flux:button variant="ghost" inset="left">

Prop forwarding
---------------

Occasionally, one component will wrap another and expose it as a simple prop.

For example, here is the Button component that allows you to set the icon using the simple icon prop instead of passing an entire Icon component into the Button as a child:

Copy to clipboard

    <flux:button icon="bell" />

This is often a more desirable alternative to composing the entire component like so:

Copy to clipboard

    <flux:button>   <flux:icon.bell /></flux:button>

However, when using the icon prop, you are unable to add additional props to the Icon component like variant.

In these cases, flux will often expose nested props via prefixes like so:

Copy to clipboard

    <flux:button icon="bell" icon:variant="solid" />

Opt-out props
-------------

Sometimes flux will turn a prop "on" by default, or manage its state internally. For example, the current prop on the navbar.item component.

However, you may want to enforce that its value remains false for a specific instance of the component.

In these cases, you can use Laravel's dynamic prop syntax (:) and pass in false.

Copy to clipboard

    <flux:navbar.item :current="false">

Shorthand props
---------------

Sometimes a component arrangement is both common and verbose enough that it warrants a shorthand syntax.

For example, here's a full input field:

Copy to clipboard

    <flux:field>    <flux:label>Email</flux:label>    <flux:input wire:model="email" type="email" />    <flux:error name="email" /></flux:field>

This can be shortened to the following:

Copy to clipboard

    <flux:input type="email" wire:model="email" label="Email" />

Internally, flux will expand the above into the full assembly of field, label, input, and error components.

This way you can keep syntax short and concise, but still have the ability to fully customize things if you'd like to use the full longform syntax.

You'll also encounter this pattern with tooltips and buttons.

Here's a long-form toolip:

Copy to clipboard

    <flux:tooltip content="Settings">    <flux:button icon="cog-6-tooth" /></flux:tooltip>

Because the above is often repetitive, you can shorten it to a simple tooltip prop:

Copy to clipboard

    <flux:button icon="cog-6-tooth" tooltip="Settings" />

Data binding
------------

In Livewire you are used to adding wire:model directly to input elements inside your forms.

In Flux, the experience is no different. Here are some common components you will often be adding wire:model to:

Copy to clipboard

    <flux:input wire:model="email" /><flux:checkbox wire:model="terms" /><flux:switch wire:model.live="enabled" /><flux:textarea wire:model="content" /><flux:select wire:model="state" />

In addition to these common ones you'd expect, here are a few other components you can control via wire:model:

Copy to clipboard

    <flux:checkbox.group wire:model="notifications"><flux:radio.group wire:model="payment"><flux:tabs wire:model="activeTab">

Of course, you can also pass x-model or x-on:change to any of these and they should behave exactly like native input elements.

Component Groups
----------------

When a Flux component can be "grouped", but is otherwise a stand-alone component, its wrapper component has a .group suffix.

All of the following components can be used on their own, or grouped together:

Copy to clipboard

    <flux:button.group>    <flux:button /></flux:button.group><flux:input.group>    <flux:input /></flux:input.group><flux:checkbox.group>    <flux:checkbox /></flux:checkbox.group><flux:radio.group>    <flux:radio /></flux:radio.group>

Alternatively, if a component can NOT be used on its own, but can be grouped, the wrapper will often be the main name of the component, and each child will have a .item suffix:

Copy to clipboard

    <flux:accordion>    <flux:accordion.item /></flux:accordion><flux:menu>    <flux:menu.item /></flux:menu><flux:breadcrumbs>    <flux:breadcrumbs.item /></flux:breadcrumbs><flux:navbar>    <flux:navbar.item /></flux:navbar><flux:navlist>    <flux:navlist.item /></flux:navlist><flux:navmenu>    <flux:navmenu.item /></flux:navmenu><flux:command>    <flux:command.item /></flux:command><flux:autocomplete>    <flux:autocomplete.item /></flux:autocomplete>

Root components
===============

Most of the time, when a component can be composed of many sub-components, you will see compound names like the ones mentioned above.

However, for components that are larger or more "primitive" feeling than the others, they will lack a common prefix, and instead use the name of the component itself.

For example, this is flux's field component:

Copy to clipboard

    <flux:field>    <flux:label></flux:label>    <flux:description></flux:description>    <flux:error></flux:error></flux:field>

You'll notice bare component names like flux:label, instead of flux:field.label.

The reasoning for this is to avoid overly verbose heirarchies in common components that would result in naming like: flux:field.label.badge.

You will also see this pattern with <flux:table>.

Anomalies
---------

As painful as it is, sometimes for something to "feel right", you have to abandon consistency for one reason or another.

For example, the flux:tabs component doesn't follow the aforementioned rules:

Copy to clipboard

    <flux:tab.group>    <flux:tabs>        <flux:tab>    </flux:tabs>    <flux:tab.panel></flux:tab.group>

Slots
-----

In general, Flux prefers composing multiple components together rather than using slots.

However, there are times where there is no substitute and slots are the perfect solution.

To demonstrate, consider the following input component with an x-mark icon:

Copy to clipboard

    <flux:input icon:trailing="x-mark" />

If you wanted to wrap the icon in a clickable button to perform an action there is no way to achieve that without slots (or without offering an extremely verbose, custom syntax).

Here is the above, rewritten with a wrapping button:

Copy to clipboard

    <flux:input>    <x-slot name="iconTrailing">        <flux:button icon="x-mark" size="sm" variant="subtle" wire:click="clear" />    </x-slot></flux:input>

Paper cuts
----------

Here are a few gotchas that you might encounter while using Flux.

Blade components vs HTML elements
---------------------------------

When dealing with plain HTML elements in Blade, you are free to use expressions like @if inside opening tags.

However, those expressions are not supported inside the opening tag of a Blade or Flux component.

Instead, you must stay within the confines of the Blade component [dynamic attribute syntax](https://laravel.com/docs/11.x/blade#component-attributes):

Copy to clipboard

    <!-- Conditional attributes: --><input @if ($disabled) disabled @endif><flux:input :disabled="$disabled">

---

## Principles

Principles
==========

Flux is not a _set_ of UI Blade components, it's a _system_ of them. The design of this system is guided by a set of principles that, when applied, result in a cleaner, more creative, and more intuitive, app-building experience.

Simplicity
----------

Above all else, simplicity is the quality Flux aims for in its syntax, implementation, and visuals.

Take for example, a basic input field written with Flux:

Copy to clipboard

    <flux:input wire:model="email" label="Email" />

It's _simple_.

Now, consider a dystopian version of the same input field where simplicity is not valued as highly:

Copy to clipboard

    <flux:form.field>    <flux:form.field.label>Email</flux:form.field.label>    <div>        <flux:form.field.text-input wire:model="email" />    </div>    @error('email')        <p class="mt-2 text-red-500 dark:text-red-400 text-xs">{{ $message }}</p>    @enderror</flux:form.field>

It's a _mess_.

Complexity
----------

Of course simplicity comes with trade-offs. It's harder to customize smaller parts of a single component that "does too much".

That's why Flux offers composable alternatives to overly _simple_ components.

Consider the previous version of the input field:

Copy to clipboard

    <flux:input wire:model="email" label="Email" />

If you want more control, you can _compose_ the form field manually from its individual parts:

Copy to clipboard

    <flux:field>    <flux:label>Email</flux:label>    <flux:input wire:model="email" />    <flux:error name="email" /></flux:field>

This gives you the best of both worlds. A short, succinct, syntax for the common case, and the ability to customize each part on an as-needed basis.

Friendliness
------------

When given the chance, Flux chooses familiar, friendly, names for its components instead of overly technical ones.

For example, you won't find words like "form controls" in Flux. Most developers use simple terminology like "form inputs" instead.

You also won't find the word "popover" either. Most developers use "dropdown" instead.

Even if a word like "popover" is more acurate, we won't use it because it's not familiar enough.

Another example is "accordion" instead of "disclosure" for collapsible sections. "disclosure" is the more acurate UI pattern, however, "accordion" is the more commonly used term amongst application developers.

Composition
-----------

After simplicity, _composability_ is the next highest value. Ideally, you learn a handful of core components, and then you mix and match them to create (or _compose_) more robust components.

For example, the following is a common Button component in Flux:

Copy to clipboard

    <flux:button>Options</flux:button>

If you want to trigger a dropdown using that button, simply wrap it in <flux:dropdown>:

Copy to clipboard

    <flux:dropdown>    <flux:button>Options</flux:button>    <flux:navmenu>        <!-- ... -->    </flux:navmenu></flux:dropdown>

Many other libraries force you into more rigid component shapes, dissalowing use of a simple button inside a dropdown and instead forcing you to use a more perscriptive alternative like <flux:dropdown.button>.

Because composition is a priority, you can turn this navigation dropdown into a "system menu" containing submenus, checkable items, and keyboard control by swapping navmenu for menu:

Copy to clipboard

    <flux:dropdown>    <flux:button>Options</flux:button>    <flux:menu>        <!-- ... -->    </flux:menu></flux:dropdown>

Because <flux:menu> is a standalone component in its own right, you can use it to create a context menu that opens on right click instead using the <flux:context> component:

Copy to clipboard

    <flux:context>    <flux:button>Options</flux:button>    <flux:menu>        <!-- ... -->    </flux:menu></flux:context>

_This_ is the power of composition; the ability to combine independent components into new and more powerful ones.

Consistency
-----------

Inconsistent naming, component structure, etc. leads to confusion and frustration. It robs from the intuitiveness of a system.

Therefore, you will find repeated syntax patterns all over Flux.

One simple example is the use of the word "heading" instead of "title" or "name" in many components.

This way, you can more easily memorize component terms without having to guess or look them up.

Here are a few examples of Flux components that use the word "heading":

Copy to clipboard

    <flux:heading>...</flux:heading><flux:menu.submenu heading="..."><flux:accordion.heading>...</flux:accordion.heading>

Brevity
-------

Next to simplicity, brevity is another priority. Flux aims to be as brief as possible without sacrificing any of the above principles.

In general, we avoid compound words that require hyphens in Flux syntax. We also avoid too many levels of nested (dot-seperated) names.

For example, we use the simple word "input" instead of "text-input", "input-text", "form-input", or "form-control":

Copy to clipboard

    <flux:input>

Composition helps with this quest for brevity. Consider the following dropdown menu component:

Copy to clipboard

    <flux:dropdown>    <flux:button>Options</flux:button>    <flux:menu>        <!-- ... -->    </flux:menu></flux:dropdown>

Notice the simple, single-word names for the dropdown component.

Consider what it might look like if composability and brevity weren't as high a priority:

Copy to clipboard

    <flux:dropdown-menu>    <flux:dropdown-menu.button>Options</flux:dropdown-menu.button>    <flux:dropdown-menu.items>        <!-- ... -->    </flux:dropdown-menu.items></flux:dropdown-menu>

Use the browser
---------------

Modern browsers have a lot to offer. Flux aims to leverage this to its full potential.

When you use native browser features, you are depending on reliable behavior that you don't have to download any JavaScript libraries for.

For example, anytime you see a dropdown (popover) in Flux, it will likely by using the popover attribute under the hood. This is a relatively new, but widely supported, feature that solves many problems that plague hand-built dropdown menus:

Copy to clipboard

    <div popover>    <!-- ... --></div>

[Read more about the popover attribute](https://developer.mozilla.org/en-US/docs/Web/API/Popover_API)

Another example is using the <dialog> element for modals instead of something hand written:

Copy to clipboard

    <dialog>    <!-- ... --></dialog>

By using the native <dialog> element, you get a much more consistent and reliable modal experience with things like focus management, accessibility, and keyboard navigation out of the box.

[Read more about the dialog element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dialog)

Use CSS
-------

CSS is becoming a more and more powerful tool for authoring composable design systems. With new feature like :has(), :not() and :where(), things that historically required JavaScript, can be done with CSS alone.

When you peer into the source of a Flux component, you may notice some complicated Tailwind utilities being used.

This is a tradeoff in complexity. In Flux, if a component _can_ use CSS to solve a problem, instead of using PHP or JavaScript, that component _will_ use CSS.

For example, consider how the search icon in the flux:command.input component changes color when the input field is focused:

Copy to clipboard

    <flux:command.input placeholder="Search..." />

When rendered in the browser, the search icon turns darker when the input is focused. This elegant interaction happens without any JavaScript.

It's accomplished using CSS's :has() selector. Here's the actual Tailwind utility used in the component:

Copy to clipboard

    [&:has(+input:focus)]:text-zinc-800

The above selector will match any element that has a sibling input element with focus, and changes its text color to a darker shade. This is a simple but powerful example of using modern CSS to enhance the user experience without additional JavaScript.

We style, you space
-------------------

In general, Flux provides _styling_ out of the box, and leaves _spacing_ to you. Another, more practical way to put it is: We provide padding, you provide margins.

For example, take a look at the following "Create account" form:

Copy to clipboard

    <form wire:submit="createAccount">    <div class="mb-6">        <flux:heading>Create an account</flux:heading>        <flux:text class="mt-2">We're excited to have you on board.</flux:text>    </div>    <flux:input class="mb-6" label="Email" wire:model="email" />    <div class="mb-6 flex *:w-1/2 gap-4">        <flux:input label="Password" wire:model="password" />        <flux:input label="Confirm password" wire:model="password_confirmation" />    </div>    <flux:button type="submit" variant="primary">Create account</flux:button></form>

Notice how Flux handles the styling of individual components, but leaves the spacing and layout to you.

The reason for this pattern is that _spacing_ is contextual, and _styling_ is less-so. Therefore, if we baked spacing into Flux, you would be constantly overriding it, or worse, preserving it and risking your app looking disjointed.

It takes slightly more work to manage spacing and layout yourself, however, the payoff in flexibility is well worth it.

---

## Profile

Profile
=======

Display a user's profile with an avatar and optional name in a compact, interactive component.

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:profile avatar="https://unavatar.io/x/calebporzio" />

[With name](#with-name)
-----------------------

Display a user's name next to their avatar.

![Caleb Porzio](https://unavatar.io/x/calebporzio)

Caleb Porzio

Copy to clipboard

    <flux:profile name="Caleb Porzio" avatar="https://unavatar.io/x/calebporzio" />

[Without chevron](#without-chevron)
-----------------------------------

Hide the chevron icon by setting the :chevron prop to false.

![](https://unavatar.io/x/calebporzio)

Copy to clipboard

    <flux:profile :chevron="false" avatar="https://unavatar.io/x/calebporzio" />

[Circle avatar](#circle-avatar)
-------------------------------

Use the circle prop to display a circular avatar.

![](https://unavatar.io/x/calebporzio)

![Caleb Porzio](https://unavatar.io/x/calebporzio)

Caleb Porzio

Copy to clipboard

    <flux:profile circle :chevron="false" avatar="https://unavatar.io/x/calebporzio" /><flux:profile circle name="Caleb Porzio" avatar="https://unavatar.io/x/calebporzio" />

[Avatar with initials](#avatar-with-initials)
---------------------------------------------

When no avatar image is provided, initials will be automatically generated from the name or they can be specified directly.

CP

Caleb Porzio

CP

Copy to clipboard

    <!-- Automatically generates initials from name --><flux:profile name="Caleb Porzio" /><!-- Specify color... --><flux:profile name="Caleb Porzio" avatar:color="cyan" /><!-- Manually specify initials... --><flux:profile initials="CP" /><!-- Provide name only for avatar initial generation... --><flux:profile avatar:name="Caleb Porzio" />

[Custom trailing icon](#custom-trailing-icon)
---------------------------------------------

Replace the default chevron with a custom icon using the icon:trailing prop.

![Caleb Porzio](https://unavatar.io/x/calebporzio)

Caleb Porzio

Copy to clipboard

    <flux:profile    icon:trailing="chevron-up-down"    avatar="https://unavatar.io/x/calebporzio"    name="Caleb Porzio"/>

Examples
--------

### [Profile menu](#profile-menu)

[

_A_

Acme Inc.

](#)

[

Home

](#)[

Inbox

12](#)

![](https://unavatar.io/x/calebporzio)

Signed in as

[\[email protected\]](/cdn-cgi/l/email-protection)

Teams

[Personal](#)[

Wireable LLC](#)

[Licenses](/dashboard) [Account](/account)

[Logout](/logout)

Copy to clipboard

    <flux:dropdown align="end">    <flux:profile avatar="https://unavatar.io/x/calebporzio" />    <flux:navmenu class="max-w-[12rem]">        <div class="px-2 py-1.5">            <flux:text size="sm">Signed in as</flux:text>            <flux:heading class="mt-1! truncate">[email protected]</flux:heading>        </div>        <flux:navmenu.separator />        <div class="px-2 py-1.5">            <flux:text size="sm" class="pl-7">Teams</flux:text>        </div>        <flux:navmenu.item href="#" icon="check" class="text-zinc-800 dark:text-white truncate">Personal</flux:navmenu.item>        <flux:navmenu.item href="#" indent class="text-zinc-800 dark:text-white truncate">Wireable LLC</flux:navmenu.item>        <flux:navmenu.separator />        <flux:navmenu.item href="/dashboard" icon="key" class="text-zinc-800 dark:text-white">Licenses</flux:navmenu.item>        <flux:navmenu.item href="/account" icon="user" class="text-zinc-800 dark:text-white">Account</flux:navmenu.item>        <flux:navmenu.separator />        <flux:navmenu.item href="/logout" icon="arrow-right-start-on-rectangle" class="text-zinc-800 dark:text-white">Logout</flux:navmenu.item>    </flux:navmenu></flux:dropdown>

### [Profile switcher](#profile-switcher)

[

_A_

Acme Inc.

](#)

[

Home

](#)[

Inbox

12](#)[

Documents

](#)[

Calendar

](#)

![Caleb Porzio](https://unavatar.io/x/calebporzio)

Caleb Porzio

Caleb Porzio

Hugo Sainte-Marie

Josh Hanley

Logout

Copy to clipboard

    <flux:dropdown position="top" align="start">    <flux:profile avatar="https://unavatar.io/x/calebporzio" name="Caleb Porzio" />    <flux:menu>        <flux:menu.radio.group>            <flux:menu.radio checked>Caleb Porzio</flux:menu.radio>            <flux:menu.radio>Hugo Sainte-Marie</flux:menu.radio>            <flux:menu.radio>Josh Hanley</flux:menu.radio>        </flux:menu.radio.group>        <flux:menu.separator />        <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>    </flux:menu></flux:dropdown>

Related components
------------------

[

Avatar

Display user profile images or fallback initials



](/components/avatar)[

Header

Top navigation headers for your application



](/layouts/header)[

Brand

Display your brand name and logo



](/components/brand)

Reference
---------

### [flux:profile](#fluxprofile)

Prop

Description

name

User's name to display next to the avatar.

avatar

URL to the image to display as avatar, or can pass content via slot.

avatar:name

Name to use for avatar initial generation.

avatar:color

Color to use for the avatar. (See [Avatar color documentation](/components/avatar#colors) for available options.)

circle

Whether to display a circular avatar. Default: false.

initials

Custom initials to display when no avatar image is provided. Automatically generated from name if not provided.

chevron

Whether to display a chevron icon (dropdown indicator). Default: true.

icon:trailing

Custom icon to display instead of the chevron. Accepts any icon name.

icon:variant

Icon variant to use for the trailing icon. Options: micro (default), outline.

Slot

Description

avatar

Custom content for the avatar section, typically containing a flux:avatar component.

---

## Radio

Radio
=====

Select one option from a set of mutually exclusive choices. Perfect for single-choice questions and settings.

Select your payment methodCredit Card

Paypal

Bank transfer

Copy to clipboard

    <flux:radio.group wire:model="payment" label="Select your payment method">    <flux:radio value="cc" label="Credit Card" checked />    <flux:radio value="paypal" label="Paypal" />    <flux:radio value="ach" label="Bank transfer" /></flux:radio.group>

[With descriptions](#with-descriptions)
---------------------------------------

Align descriptions for each radio directly below its label.

RoleAdministrator Administrator users can perform any action.

Editor Editor users have the ability to read, create, and update.

Viewer Viewer users only have the ability to read. Create, and update are restricted.

Copy to clipboard

    <flux:radio.group label="Role">    <flux:radio        name="role"        value="administrator"        label="Administrator"        description="Administrator users can perform any action."        checked    />    <flux:radio        name="role"        value="editor"        label="Editor"        description="Editor users have the ability to read, create, and update."    />    <flux:radio        name="role"        value="viewer"        label="Viewer"        description="Viewer users only have the ability to read. Create, and update are restricted."    /></flux:radio.group>

[Within fieldset](#within-fieldset)
-----------------------------------

Group radio inputs inside a fieldset and provide more context with descriptions for each radio option.

RoleAdministrator Administrator users can perform any action.

Editor Editor users have the ability to read, create, and update.

Viewer Viewer users only have the ability to read. Create, and update are restricted.

Copy to clipboard

    <flux:fieldset>    <flux:legend>Role</flux:legend>    <flux:radio.group>        <flux:radio            value="administrator"            label="Administrator"            description="Administrator users can perform any action."            checked        />        <flux:radio            value="editor"            label="Editor"            description="Editor users have the ability to read, create, and update."        />        <flux:radio            value="viewer"            label="Viewer"            description="Viewer users only have the ability to read. Create, and update are restricted."        />    </flux:radio.group></flux:fieldset>

[Segmented](#segmented)
-----------------------

A more compact alternative to standard radio buttons.

Role Admin Editor Viewer

Copy to clipboard

    <flux:radio.group wire:model="role" label="Role" variant="segmented">    <flux:radio label="Admin" />    <flux:radio label="Editor" />    <flux:radio label="Viewer" /></flux:radio.group>

You can also use the size="sm" prop to make the radios smaller.

Role Admin Editor Viewer

Copy to clipboard

    <flux:radio.group wire:model="role" label="Role" variant="segmented" size="sm">    <flux:radio label="Admin" />    <flux:radio label="Editor" />    <flux:radio label="Viewer" /></flux:radio.group>

[Segmented with icons](#segmented-with-icons)
---------------------------------------------

Combine segmented radio buttons with icon prefixes.

Role Admin Editor Viewer

Copy to clipboard

    <flux:radio.group wire:model="role" variant="segmented">    <flux:radio label="Admin" icon="wrench" />    <flux:radio label="Editor" icon="pencil-square" />    <flux:radio label="Viewer" icon="eye" /></flux:radio.group>

[Radio cards](#radio-cards)
---------------------------

A bordered alternative to standard radio buttons.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Shipping

Standard

4-10 business days

Fast

2-5 business days

Next day

1 business day

Copy to clipboard

    <flux:radio.group wire:model="shipping" label="Shipping" variant="cards" class="max-sm:flex-col">    <flux:radio value="standard" label="Standard" description="4-10 business days" checked />    <flux:radio value="fast" label="Fast" description="2-5 business days" />    <flux:radio value="next-day" label="Next day" description="1 business day" /></flux:radio.group>

You can swap between vertical and horizontal card layouts by conditionally applying flex-col based on the viewport.

Copy to clipboard

    <flux:radio.group ... class="max-sm:flex-col">    <!-- ... --></flux:radio.group>

[Vertical cards](#vertical-cards)
---------------------------------

You can arrange a set of radio cards vertically by simply adding the flex-col class to the group container.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Shipping

Standard

4-10 business days

Fast

2-5 business days

Next day

1 business day

Copy to clipboard

    <flux:radio.group label="Shipping" variant="cards" class="flex-col">    <flux:radio value="standard" label="Standard" description="4-10 business days" />    <flux:radio value="fast" label="Fast" description="2-5 business days" />    <flux:radio value="next-day" label="Next day" description="1 business day" /></flux:radio.group>

[Cards with icons](#cards-with-icons)
-------------------------------------

You can arrange a set of radio cards vertically by simply adding the flex-col class to the group container.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Shipping

Standard

4-10 business days

Fast

2-5 business days

Next day

1 business day

Copy to clipboard

    <flux:radio.group label="Shipping" variant="cards" class="max-sm:flex-col">    <flux:radio value="standard" icon="truck" label="Standard" description="4-10 business days" />    <flux:radio value="fast" icon="cube" label="Fast" description="2-5 business days" />    <flux:radio value="next-day" icon="clock" label="Next day" description="1 business day" /></flux:radio.group>

[Cards without indicators](#cards-without-indicators)
-----------------------------------------------------

For a cleaner look, you can remove the radio indicator using :indicator="false".

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Shipping

Standard

4-10 business days

Fast

2-5 business days

Next day

1 business day

Copy to clipboard

    <flux:radio.group label="Shipping" variant="cards" :indicator="false" class="max-sm:flex-col">    <flux:radio value="standard" icon="truck" label="Standard" description="4-10 business days" />    <flux:radio value="fast" icon="cube" label="Fast" description="2-5 business days" />    <flux:radio value="next-day" icon="clock" label="Next day" description="1 business day" /></flux:radio.group>

[Custom card content](#custom-card-content)
-------------------------------------------

You can compose your own custom cards through the flux:radio component slot.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Shipping

Standard

4-10 business days

Fast

2-5 business days

Next day

1 business day

Copy to clipboard

    <flux:radio.group label="Shipping" variant="cards" class="max-sm:flex-col">    <flux:radio value="standard" checked>        <flux:radio.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Standard</flux:heading>            <flux:text size="sm" class="mt-2">4-10 business days</flux:text>        </div>    </flux:radio>    <flux:radio value="fast">        <flux:radio.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Fast</flux:heading>            <flux:text size="sm" class="mt-2">2-5 business days</flux:text>        </div>    </flux:radio>    <flux:radio value="next-day">        <flux:radio.indicator />        <div class="flex-1">            <flux:heading class="leading-4">Next day</flux:heading>            <flux:text size="sm" class="mt-2">1 business day</flux:text>        </div>    </flux:radio></flux:radio.group>

Related components
------------------

[

Field

Structured form field with label and validation states



](/components/field)[

Checkbox

Toggleable input control for making multiple selections



](/components/checkbox)[

Select

Dropdown selection menus for choosing from options



](/components/select)

Reference
---------

### [flux:radio.group](#fluxradiogroup)

Prop

Description

wire:model

Binds the radio group selection to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

label

Label text displayed above the radio group. When provided, wraps the radio group in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the radio group. When provided alongside label, appears between the label and radio group within the flux:field wrapper. See the [field component](/components/field).

variant

Visual style of the group. Options: default, segmented, cards.

invalid

Applies error styling to the radio group.

Slot

Description

default

The radio buttons to be grouped together.

Attribute

Description

data-flux-radio-group

Applied to the root element for styling and identification.

### [flux:radio](#fluxradio)

Prop

Description

label

Label text displayed above the radio button. When provided, wraps the radio button in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the radio button. When provided alongside label, appears between the label and radio button within the flux:field wrapper. See the [field component](/components/field).

value

Value associated with the radio button when used in a group.

checked

If true, the radio button is selected by default.

disabled

Prevents user interaction with the radio button.

icon

Name of the icon to display (for segmented variant).

Slot

Description

default

Custom content for card variant.

Attribute

Description

data-flux-radio

Applied to the root element for styling and identification.

data-checked

Applied when the radio button is selected.

### [flux:radio.indicator](#fluxradioindicator)

Used for custom radio button layouts in card variant.

---

## Select

Select
======

Choose a single option from a dropdown list.

For lists of up to 5 items, consider using [checkboxes](/components/checkbox) or [radio buttons](/components/radio) instead.

Choose industry... Photography Design services Web development Accounting Legal services Consulting Other

Copy to clipboard

    <flux:select wire:model="industry" placeholder="Choose industry...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

[Small](#small)
---------------

A smaller select element for more compact layouts.

Choose industry... Photography Design services Web development Accounting Legal services Consulting Other

Copy to clipboard

    <flux:select size="sm" placeholder="Choose industry...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

[Custom select](#custom-select)
-------------------------------

An alternative to the browser's native select element. Typically used when you need custom option styling like icons, images, and other treatments.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Photography

Design services

Web development

Accounting

Legal services

Consulting

Other

Copy to clipboard

    <flux:select variant="listbox" placeholder="Choose industry...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

The button slot
---------------

If you need full control over the button used to trigger the custom select, you can use the button slot to render it yourself.

Copy to clipboard

    <flux:select variant="listbox">    <x-slot name="button">        <flux:select.button class="rounded-full!" placeholder="Choose industry..." :invalid="$errors->has('...')" />    </x-slot>    <flux:select.option>Photography</flux:select.option>    ...</flux:select>

Clearable
---------

If you want to make the selected value clearable, you can use the clearable prop to add an "x" button to the right side of the input:

Copy to clipboard

    <flux:select variant="listbox" clearable>    ...</flux:select>

Options with images/icons
-------------------------

One distinct advantage of using a custom listbox select over the native <select> element is that you can now add icons and images to your options.

Owner

Administrator

Member

Viewer

Copy to clipboard

    <flux:select variant="listbox" placeholder="Select role...">    <flux:select.option>        <div class="flex items-center gap-2">            <flux:icon.shield-check variant="mini" class="text-zinc-400" /> Owner        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2">            <flux:icon.key variant="mini" class="text-zinc-400" /> Administrator        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2">            <flux:icon.user variant="mini" class="text-zinc-400" /> Member        </div>    </flux:select.option>    <flux:select.option>        <div class="flex items-center gap-2">            <flux:icon.eye variant="mini" class="text-zinc-400" /> Viewer        </div>    </flux:select.option></flux:select>

[Searchable select](#searchable-select)
---------------------------------------

The searchable select variant makes navigating large option lists easier for your users.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Photography

Design services

Web development

Accounting

Legal services

ConsultingOther No results found

Copy to clipboard

    <flux:select variant="listbox" searchable placeholder="Choose industries...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

The search slot
---------------

If you need full control over the search field inside the listbox, you can use the search slot to render it yourself.

Copy to clipboard

    <flux:select variant="listbox" searchable>    <x-slot name="search">        <flux:select.search class="px-4" placeholder="Search industries..." />    </x-slot>    ...</flux:select>

[Multiple select](#multiple-select)
-----------------------------------

Allow your users to select multiple options from a list of options.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Photography

Design services

Web development

Accounting

Legal services

Consulting

Other

Copy to clipboard

    <flux:select variant="listbox" multiple placeholder="Choose industries...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

Selected suffix
---------------

By default, when more than one option is selected, the suffix " selected" will be appended to the number of selected options. You can customize this language by passing a selected-suffix prop to the select component.

Copy to clipboard

    <flux:select variant="listbox" selected-suffix="industries selected" multiple>    ...</flux:select>

If you pass a custom suffix, and need localization, you can use the \_\_() helper function to translate the suffix:

Copy to clipboard

    <flux:select variant="listbox" selected-suffix="{{ __('industries selected') }}" multiple>    ...</flux:select>

Checkbox indicator
------------------

If you prefer a checkbox indicator instead of the default checkmark icon, you can use the indicator="checkbox" prop.

Copy to clipboard

    <flux:select variant="listbox" indicator="checkbox" multiple>    ...</flux:select>

Clearing search
---------------

By default, a searchable select will clear the search input when the user selects an option. If you want to disable this behavior, you can use the clear="close" prop to only clear the search input when the user closes the select.

Copy to clipboard

    <flux:select variant="listbox" searchable multiple clear="close">    ...</flux:select>

[Combobox](#combobox)
---------------------

A versatile combobox that can be used for anything from basic autocomplete to complex multi-selects.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Photography

Design services

Web development

Accounting

Legal services

ConsultingOther No results found

Copy to clipboard

    <flux:select variant="combobox" placeholder="Choose industry...">    <flux:select.option>Photography</flux:select.option>    <flux:select.option>Design services</flux:select.option>    <flux:select.option>Web development</flux:select.option>    <flux:select.option>Accounting</flux:select.option>    <flux:select.option>Legal services</flux:select.option>    <flux:select.option>Consulting</flux:select.option>    <flux:select.option>Other</flux:select.option></flux:select>

The input slot
--------------

If you need full control over the input element used to trigger the combobox, you can use the input slot to render it yourself.

Copy to clipboard

    <flux:select variant="combobox">    <x-slot name="input">        <flux:select.input x-model="search" :invalid="$errors->has('...')" />    </x-slot>    ...</flux:select>

[Dynamic options](#dynamic-options)
-----------------------------------

If you want to dynamically generate options on the server, you can use the :filter="false" prop to disable client-side filtering.

This variant is only available in the Pro version of Flux.

[Upgrade to unlock ->](/pricing)

Copy to clipboard

    <flux:select :filter="false">    @foreach ($options as $option)        <flux:select.option value="{{ $option->value }}">            {{ $option->label }}        </flux:select.option>    @endforeach</flux:select>

Related components
------------------

[

Field

Structured form field with label and validation states



](/components/field)[

Autocomplete

Enhanced text input with predictive suggestions



](/components/autocomplete)[

Radio

Control for selecting one option from many



](/components/radio)

Reference
---------

### [flux:select](#fluxselect)

Prop

Description

wire:model

Binds the select to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

placeholder

Text displayed when no option is selected.

label

Label text displayed above the select. When provided, wraps the select in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the select. When provided alongside label, appears between the label and select within the flux:field wrapper. See the [field component](/components/field).

description:trailing

The description provided will be displayed below the select instead of above it.

badge

Badge text displayed at the end of the flux:label component when the label prop is provided.

size

Size of the select. Options: sm, xs.

variant

Visual style of the select. Options: default (native select), listbox, combobox.

multiple

Allows selecting multiple options (listbox and combobox variants only).

filter

If false, disables client-side filtering.

searchable

Adds a search input to filter options (listbox and combobox variants only).

clearable

Displays a clear button when an option is selected (listbox and combobox variants only).

selected-suffix

Text appended to the number of selected options in multiple mode (listbox variant only).

clear

When to clear the search input. Options: select (default), close (listbox and combobox variants only).

disabled

Prevents user interaction with the select.

invalid

Applies error styling to the select.

Slot

Description

default

The select options.

trigger

Custom trigger content. Typically the select.button or select.input component (listbox and combobox variants only).

Attribute

Description

data-flux-select

Applied to the root element for styling and identification.

### [flux:select.option](#fluxselectoption)

Prop

Description

value

Value associated with the option.

disabled

Prevents selecting the option.

Slot

Description

default

The option content (can include icons, images, etc. in listbox variant).

### [flux:select.button](#fluxselectbutton)

Prop

Description

placeholder

Text displayed when no option is selected.

invalid

Applies error styling to the button.

size

Size of the button. Options: sm, xs.

disabled

Prevents selecting the option.

clearable

Displays a clear button when an option is selected.

### [flux:select.input](#fluxselectinput)

Prop

Description

placeholder

Text displayed when no option is selected.

invalid

Applies error styling to the input.

size

Size of the input. Options: sm, xs.

---

## Separator

Separator
=========

Visually divide sections of content or groups of items.

Copy to clipboard

    <flux:separator />

[With text](#with-text)
-----------------------

Add text to the separator for a more descriptive element.

or

Copy to clipboard

    <flux:separator text="or" />

[Vertical](#vertical)
---------------------

Seperate contents with a vertical seperator when horizontally stacked.

Switch to dark theme

Log in

Copy to clipboard

    <flux:separator vertical />

[Limited height](#limited-height)
---------------------------------

You can limit the height of the vertical separator by adding vertical margin.

Switch to dark theme

Log in

Copy to clipboard

    <flux:separator vertical class="my-2" />

[Subtle](#subtle)
-----------------

Flux offers a subtle variant for a separator that blends into the background.

Switch to dark theme

Log in

Copy to clipboard

    <flux:separator vertical variant="subtle" />

Reference
---------

### [flux:separator](#fluxseparator)

Prop

Description

vertical

Displays a vertical separator. Default is horizontal.

variant

Visual style variant. Options: subtle. Default: standard separator.

text

Optional text to display in the center of the separator.

orientation

Alternative to vertical prop. Options: horizontal, vertical. Default: horizontal.

Class

Description

my-\*

Commonly used to shorten vertical separators.

Attribute

Description

data-flux-separator

Applied to the root element for styling and identification.

---

## Sidebar

Sidebar
=======

Use a sidebar navigation layout to keep your application content front and center.

[Fullscreen](/demo/sidebar) Demo Code

 ![](/img/demo/layout-sidebar.png) ![](/img/demo/layout-sidebar-dark.png)

Copy to clipboard

    <head>    <!-- ... -->    @fluxAppearance</head><body class="min-h-screen bg-white dark:bg-zinc-800">    <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />        <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />        <flux:navlist variant="outline">            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>            <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>            <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>            <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>            <flux:navlist.group expandable heading="Favorites" class="hidden lg:grid">                <flux:navlist.item href="#">Marketing site</flux:navlist.item>                <flux:navlist.item href="#">Android app</flux:navlist.item>                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>            </flux:navlist.group>        </flux:navlist>        <flux:spacer />        <flux:navlist variant="outline">            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>        </flux:navlist>        <flux:dropdown position="top" align="start" class="max-lg:hidden">            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />            <flux:menu>                <flux:menu.radio.group>                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                    <flux:menu.radio>Truly Delta</flux:menu.radio>                </flux:menu.radio.group>                <flux:menu.separator />                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:sidebar>    <flux:header class="lg:hidden">        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />        <flux:spacer />        <flux:dropdown position="top" alignt="start">            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />            <flux:menu>                <flux:menu.radio.group>                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                    <flux:menu.radio>Truly Delta</flux:menu.radio>                </flux:menu.radio.group>                <flux:menu.separator />                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:header>    <flux:main>        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>        <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>        <flux:separator variant="subtle" />    </flux:main>    @fluxScripts</body>

[Secondary header](#secondary-header)
-------------------------------------

Use a top header for secondary navigation.

[Fullscreen](/demo/sidebar-with-header) Demo Code

 ![](/img/demo/layout-sidebar-with-header.png) ![](/img/demo/layout-sidebar-with-header-dark.png)

Copy to clipboard

    <head>    <!-- ... -->    @fluxAppearance</head><body class="min-h-screen bg-white dark:bg-zinc-800">    <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />        <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />        <flux:navlist variant="outline">            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>            <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>            <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>            <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>            <flux:navlist.group expandable heading="Favorites" class="hidden lg:grid">                <flux:navlist.item href="#">Marketing site</flux:navlist.item>                <flux:navlist.item href="#">Android app</flux:navlist.item>                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>            </flux:navlist.group>        </flux:navlist>        <flux:spacer />        <flux:navlist variant="outline">            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>        </flux:navlist>        <flux:dropdown position="top" align="start" class="max-lg:hidden">            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />            <flux:menu>                <flux:menu.radio.group>                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                    <flux:menu.radio>Truly Delta</flux:menu.radio>                </flux:menu.radio.group>                <flux:menu.separator />                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>            </flux:menu>        </flux:dropdown>    </flux:sidebar>    <flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">        <flux:navbar class="lg:hidden w-full">            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />            <flux:spacer />            <flux:dropdown position="top" align="start">                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />                <flux:menu>                    <flux:menu.radio.group>                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>                        <flux:menu.radio>Truly Delta</flux:menu.radio>                    </flux:menu.radio.group>                    <flux:menu.separator />                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>                </flux:menu>            </flux:dropdown>        </flux:navbar>        <flux:navbar scrollable>            <flux:navbar.item href="#" current>Dashboard</flux:navbar.item>            <flux:navbar.item badge="32" href="#">Orders</flux:navbar.item>            <flux:navbar.item href="#">Catalog</flux:navbar.item>            <flux:navbar.item href="#">Configuration</flux:navbar.item>        </flux:navbar>    </flux:header>    <flux:main>        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>        <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>        <flux:separator variant="subtle" />    </flux:main>    @fluxScripts</body>

Related components
------------------

[

Header

Create top navigation headers for your application



](/layouts/header)[

Brand

Display your company logo and name consistently



](/components/brand)[

Navlist

Build vertical navigation lists with nested groups



](/components/navlist)[

Profile

Show user avatars and profile information



](/components/profile)

Reference
---------

### [flux:sidebar](#fluxsidebar)

Prop

Description

sticky

When present, makes the sidebar sticky when scrolling.

stashable

When present, allows the sidebar to be toggled on/off on smaller screens.

Slot

Description

default

Content to display within the sidebar, typically including branding, navigation elements, and user profile.

CSS

Description

class

Additional CSS classes applied to the sidebar. Common uses: bg-zinc-50, border-r, etc.

### [flux:sidebar.toggle](#fluxsidebartoggle)

Attribute

Description

icon

The icon to display in the toggle button (e.g., bars-2, x-mark).

inset

Positioning of the toggle button (e.g., left).

CSS

Description

class

Additional CSS classes applied to the toggle button. Common uses: lg:hidden to show only on mobile.

### [flux:main](#fluxmain)

Prop

Description

container

When present, constrains the main content to a container width.

Slot

Description

default

Content to display within the main content area.

---

## Switch

Switch
======

Toggle a setting on or off. Suitable for binary options like enabling or disabling features.

Use switches as auto-saving controls outside forms; checkboxes otherwise.

Enable notifications

Copy to clipboard

    <flux:switch wire:model.live="notifications" label="Enable notifications" />

[Fieldset](#fieldset)
---------------------

Group related switches within a fieldset.

Email notifications

Communication emails Receive emails about your account activity.

Marketing emails Receive emails about new products, features, and more.

Social emails Receive emails for friend requests, follows, and more.

Security emails Receive emails about your account activity and security.

Copy to clipboard

    <flux:fieldset>    <flux:legend>Email notifications</flux:legend>    <div class="space-y-4">        <flux:switch wire:model.live="communication" label="Communication emails" description="Receive emails about your account activity." />        <flux:separator variant="subtle" />        <flux:switch wire:model.live="marketing" label="Marketing emails" description="Receive emails about new products, features, and more." />        <flux:separator variant="subtle" />        <flux:switch wire:model.live="social" label="Social emails" description="Receive emails for friend requests, follows, and more." />        <flux:separator variant="subtle" />        <flux:switch wire:model.live="security" label="Security emails" description="Receive emails about your account activity and security." />    </div></flux:fieldset>

[Left align](#left-align)
-------------------------

Left align switches for more compact layouts using the align prop.

Email notifications

Communication emails

Marketing emails

Social emails

Security emails

Copy to clipboard

    <flux:fieldset>    <flux:legend>Email notifications</flux:legend>    <div class="space-y-3">        <flux:switch label="Communication emails" align="left" />        <flux:switch label="Marketing emails" align="left" />        <flux:switch label="Social emails" align="left" />        <flux:switch label="Security emails" align="left" />    </div></flux:fieldset>

Related components
------------------

[

Field

Structured form field with label



](/components/field)[

Checkbox

Toggleable control for multiple selections



](/components/checkbox)

Reference
---------

### [flux:switch](#fluxswitch)

Prop

Description

wire:model

Binds the switch to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

label

Label text displayed above the switch. When provided, wraps the switch in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the switch. When provided alongside label, appears between the label and switch within the flux:field wrapper. See the [field component](/components/field).

align

Alignment of the switch relative to its label. Options: right|start (default), left|end.

disabled

Prevents user interaction with the switch.

Attribute

Description

data-flux-switch

Applied to the root element for styling and identification.

data-checked

Applied when the switch is in the "on" state.

---

## Table

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Table
=====

Display structured data in a condensed, searchable format.

Customer

Date

Status

Amount

![](https://i.pravatar.cc/100?img=13)

Gustavo Mango

Jul 31, 9:50 AM

Paid

$162.00

View invoice Refund Archive

![](https://i.pravatar.cc/100?img=7)

Desirae George

Jul 31, 12:08 PM

Paid

$32.00

View invoice Refund Archive

![](https://i.pravatar.cc/100?img=23)

Emery Madsen

Jul 31, 11:50 AM

Paid

$163.00

View invoice Refund Archive

![](https://i.pravatar.cc/100?img=4)

[\[email protected\]](/cdn-cgi/l/email-protection)

Jul 31, 11:15 AM

Incomplete

$29.00

View invoice Refund Archive

![](https://i.pravatar.cc/100?img=16)

Kaiya Bator

Jul 31, 11:08 AM

Failed

$72.00

View invoice Refund Archive

Showing 1 to 5 of 24 results

1

2 3 4 5

Copy to clipboard

    <flux:table :paginate="$this->orders">    <flux:table.columns>        <flux:table.column>Customer</flux:table.column>        <flux:table.column sortable :sorted="$sortBy === 'date'" :direction="$sortDirection" wire:click="sort('date')">Date</flux:table.column>        <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>        <flux:table.column sortable :sorted="$sortBy === 'amount'" :direction="$sortDirection" wire:click="sort('amount')">Amount</flux:table.column>    </flux:table.columns>    <flux:table.rows>        @foreach ($this->orders as $order)            <flux:table.row :key="$order->id">                <flux:table.cell class="flex items-center gap-3">                    <flux:avatar size="xs" src="{{ $order->customer_avatar }}" />                    {{ $order->customer }}                </flux:table.cell>                <flux:table.cell class="whitespace-nowrap">{{ $order->date }}</flux:table.cell>                <flux:table.cell>                    <flux:badge size="sm" :color="$order->status_color" inset="top bottom">{{ $order->status }}</flux:badge>                </flux:table.cell>                <flux:table.cell variant="strong">{{ $order->amount }}</flux:table.cell>                <flux:table.cell>                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>                </flux:table.cell>            </flux:table.row>        @endforeach    </flux:table.rows></flux:table><!-- Livewire component example code...    use \Livewire\WithPagination;    public $sortBy = 'date';    public $sortDirection = 'desc';    public function sort($column) {        if ($this->sortBy === $column) {            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';        } else {            $this->sortBy = $column;            $this->sortDirection = 'asc';        }    }    #[\Livewire\Attributes\Computed]    public function orders()    {        return \App\Models\Order::query()            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)            ->paginate(5);    }-->

[Simple](#simple)
-----------------

The primary table example above is a full-featured table with sorting, pagination, etc. Here's a clean example of a simple data table that you can use as a simpler starting point.

Customer

Date

Status

Amount

Lindsey Aminoff

Jul 29, 10:45 AM

Paid

$49.00

Hanna Lubin

Jul 28, 2:15 PM

Paid

$312.00

Kianna Bushevi

Jul 30, 4:05 PM

Refunded

$132.00

Gustavo Geidt

Jul 27, 9:30 AM

Paid

$31.00

Copy to clipboard

    <flux:table>    <flux:table.columns>        <flux:table.column>Customer</flux:table.column>        <flux:table.column>Date</flux:table.column>        <flux:table.column>Status</flux:table.column>        <flux:table.column>Amount</flux:table.column>    </flux:table.columns>    <flux:table.rows>        <flux:table.row>            <flux:table.cell>Lindsey Aminoff</flux:table.cell>            <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>            <flux:table.cell variant="strong">$49.00</flux:table.cell>        </flux:table.row>        <flux:table.row>            <flux:table.cell>Hanna Lubin</flux:table.cell>            <flux:table.cell>Jul 28, 2:15 PM</flux:table.cell>            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>            <flux:table.cell variant="strong">$312.00</flux:table.cell>        </flux:table.row>        <flux:table.row>            <flux:table.cell>Kianna Bushevi</flux:table.cell>            <flux:table.cell>Jul 30, 4:05 PM</flux:table.cell>            <flux:table.cell><flux:badge color="zinc" size="sm" inset="top bottom">Refunded</flux:badge></flux:table.cell>            <flux:table.cell variant="strong">$132.00</flux:table.cell>        </flux:table.row>        <flux:table.row>            <flux:table.cell>Gustavo Geidt</flux:table.cell>            <flux:table.cell>Jul 27, 9:30 AM</flux:table.cell>            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>            <flux:table.cell variant="strong">$31.00</flux:table.cell>        </flux:table.row>    </flux:table.rows></flux:table>

[Pagination](#pagination)
-------------------------

Allow users to navigate through different pages of data by passing in any model paginator to the paginate prop.

Showing 1 to 5 of 24 results

1

2 3 4 5

Copy to clipboard

    <!-- $orders = \App\Models\Order::paginate(5) --><flux:table :paginate="$orders">    <!-- ... --></flux:table>

[Sortable](#sortable)
---------------------

Allow users to sort rows by specific columns using a combination of the sortable, sorted, and direction props.

Customer

Date

Amount

![](https://i.pravatar.cc/100?img=13)

Gustavo Mango

Jul 31, 9:50 AM

$162.00

![](https://i.pravatar.cc/100?img=7)

Desirae George

Jul 31, 12:08 PM

$32.00

![](https://i.pravatar.cc/100?img=23)

Emery Madsen

Jul 31, 11:50 AM

$163.00

![](https://i.pravatar.cc/100?img=4)

[\[email protected\]](/cdn-cgi/l/email-protection)

Jul 31, 11:15 AM

$29.00

Copy to clipboard

    <flux:table>    <flux:table.columns>        <flux:table.column>Customer</flux:table.column>        <flux:table.column sortable sorted direction="desc">Date</flux:table.column>        <flux:table.column sortable>Amount</flux:table.column>    </flux:table.columns>    <!-- ... --></flux:table>

Related components
------------------

[

Avatar

Display user profile images or fallback initials



](/components/avatar)[

Badge

Display small counts, status indicators, or labels



](/components/badge)[

Dropdown

Display expandable menus for row actions



](/components/dropdown)

Reference
---------

### [flux:table](#fluxtable)

Prop

Description

paginate

A Laravel paginator instance to enable pagination.

Attribute

Description

data-flux-table

Applied to the root element for styling and identification.

### [flux:table.columns](#fluxtablecolumns)

Slot

Description

default

The table columns.

### [flux:table.column](#fluxtablecolumn)

Prop

Description

align

Alignment of the column content. Options: start, center, end.

sortable

Enables sorting functionality for the column.

sorted

Indicates this column is currently being sorted.

direction

Sort direction when column is sorted. Options: asc, desc.

### [flux:table.rows](#fluxtablerows)

Slot

Description

default

The table rows.

### [flux:table.row](#fluxtablerow)

Prop

Description

key

An alias for wire:key: the unique identifier for the row.

Slot

Description

default

The table cells for this row.

### [flux:table.cell](#fluxtablecell)

Prop

Description

align

Alignment of the cell content. Options: start, center, end.

variant

Visual style of the cell. Options: default, strong.

---

## Tabs

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Tabs
====

Organize content into separate panels within a single container. Easily switch between sections without leaving the page.

For full-page navigation, use the [navbar component \->](/components/navbar)

Profile Account Billing

Copy to clipboard

    <flux:tab.group>    <flux:tabs wire:model="tab">        <flux:tab name="profile">Profile</flux:tab>        <flux:tab name="account">Account</flux:tab>        <flux:tab name="billing">Billing</flux:tab>    </flux:tabs>    <flux:tab.panel name="profile">...</flux:tab.panel>    <flux:tab.panel name="account">...</flux:tab.panel>    <flux:tab.panel name="billing">...</flux:tab.panel></flux:tab.group>

[With icons](#with-icons)
-------------------------

Associate tab labels with icons to visually distinguish different sections.

Profile Account Billing

Copy to clipboard

    <flux:tab.group>    <flux:tabs>        <flux:tab name="profile" icon="user">Profile</flux:tab>        <flux:tab name="account" icon="cog-6-tooth">Account</flux:tab>        <flux:tab name="billing" icon="banknotes">Billing</flux:tab>    </flux:tabs>    <flux:tab.panel name="profile">...</flux:tab.panel>    <flux:tab.panel name="account">...</flux:tab.panel>    <flux:tab.panel name="billing">...</flux:tab.panel></flux:tab.group>

[Padded edges](#padded-edges)
-----------------------------

By default, the tabs will have no horizontal padding around the edges. If you want to add padding you can do by adding Tailwind utilities to the tabs and/or tab.panel components.

Profile Account Billing

Copy to clipboard

    <flux:tabs class="px-4">    <flux:tab name="profile">Profile</flux:tab>    <flux:tab name="account">Account</flux:tab>    <flux:tab name="billing">Billing</flux:tab></flux:tabs>

[Segmented tabs](#segmented-tabs)
---------------------------------

Tab through content with visually separated, button-like tabs. Ideal for toggling between views inside a container with a constrained width.

List Board Timeline

Copy to clipboard

    <flux:tabs variant="segmented">    <flux:tab>List</flux:tab>    <flux:tab>Board</flux:tab>    <flux:tab>Timeline</flux:tab></flux:tabs>

[Segmented with icons](#segmented-with-icons)
---------------------------------------------

Combine segmented tabs with icon prefixes.

List Board Timeline

Copy to clipboard

    <flux:tabs variant="segmented">    <flux:tab icon="list-bullet">List</flux:tab>    <flux:tab icon="squares-2x2">Board</flux:tab>    <flux:tab icon="calendar-days">Timeline</flux:tab></flux:tabs>

[Small segmented tabs](#small-segmented-tabs)
---------------------------------------------

For more compact layouts, you can use the size="sm" prop to make the tabs smaller.

Demo Code

Copy to clipboard

    <flux:tabs variant="segmented" size="sm">    <flux:tab>Demo</flux:tab>    <flux:tab>Code</flux:tab></flux:tabs>

[Pill tabs](#pill-tabs)
-----------------------

Tab through content with visually separated, pill-like tabs.

List Board Timeline

Copy to clipboard

    <flux:tabs variant="pills">    <flux:tab>List</flux:tab>    <flux:tab>Board</flux:tab>    <flux:tab>Timeline</flux:tab></flux:tabs>

[Dynamic tabs](#dynamic-tabs)
-----------------------------

If you need, you can dynamically generate additional tabs and panels in your Livewire component. Just make sure you use matching names for the new tabs and panels.

Tab #1 Tab #2 Add tab

Copy to clipboard

    <flux:tab.group>    <flux:tabs>        @foreach($tabs as $id => $tab)            <flux:tab :name="$id">{{ $tab }}</flux:tab>        @endforeach        <flux:tab icon="plus" wire:click="addTab" action>Add tab</flux:tab>    </flux:tabs>    @foreach($tabs as $id => $tab)        <flux:tab.panel :name="$id">            <!-- ... -->        </flux:tab.panel>    @endforeach</flux:tab.group><!-- Livewire component example code...    public array $tabs = [        'tab-1' => 'Tab #1',        'tab-2' => 'Tab #2',    ];    public function addTab(): void    {        $id = 'tab-' . str()->random();        $this->tabs[$id] = 'Tab #' . count($this->tabs) + 1;    }-->

Related components
------------------

[

Navbar

Build responsive navigation bars



](/components/navbar)[

Radio

Allow users to select a single option from a list



](/components/radio)

Reference
---------

### [flux:tab.group](#fluxtabgroup)

Container for tabs and their associated panels.

Slot

Description

default

The tabs and panels components.

### [flux:tabs](#fluxtabs)

Prop

Description

wire:model

Binds the active tab to a Livewire property. See [wire:model documentation](https://livewire.laravel.com/docs/wire-model)

variant

Visual style of the tabs. Options: default, segmented, pills.

size

Size of the tabs. Options: base (default), sm.

Slot

Description

default

The individual tab components.

Attribute

Description

data-flux-tabs

Applied to the root element for styling and identification.

### [flux:tab](#fluxtab)

Prop

Description

name

Unique identifier for the tab, used to match with its panel.

icon

Name of the icon to display at the start of the tab.

icon:trailing

Name of the icon to display at the end of the tab.

icon:variant

Variant of the icon. Options: outline, solid, mini, micro.

action

Converts the tab to an action button (used for "Add tab" functionality).

accent

If true, applies accent color styling to the tab.

size

Size of the tab (only applies when variant="segmented"). Options: base (default), sm.

disabled

Disables the tab.

Slot

Description

default

The tab label content.

Attribute

Description

data-flux-tab

Applied to the tab element for styling and identification.

data-selected

Applied when the tab is selected/active.

### [flux:tab.panel](#fluxtabpanel)

Prop

Description

name

Unique identifier matching the associated tab.

Slot

Description

default

The panel content displayed when the associated tab is selected.

Attribute

Description

data-flux-tab-panel

Applied to the panel element for styling and identification.

---

## Text

Text
====

Consistent typographical components like text and link.

Text component

This is the standard text component for body copy and general content throughout your application.

Copy to clipboard

    <flux:heading>Text component</flux:heading><flux:text class="mt-2">This is the standard text component for body copy and general content throughout your application.</flux:text>

[Size](#size)
-------------

Use standard Tailwind to control the size of the text so that you can more easily adapt to different screen sizes.

Larger text size

Default text size

Smaller text

Copy to clipboard

    <flux:text class="text-base">Base text size</flux:text><flux:text>Default text size</flux:text><flux:text class="text-xs">Smaller text</flux:text>

[Color](#color)
---------------

Use standard Tailwind to control the color of the text so that you can more easily adapt to different screen sizes.

Strong text color

Default text color

Muted text color

Colored text

Copy to clipboard

    <flux:text variant="strong">Strong text color</flux:text><flux:text>Default text color</flux:text><flux:text variant="subtle">Muted text color</flux:text><flux:text color="blue">Colored text</flux:text>

[Link](#link)
-------------

Use the link component to create clickable text that navigates to other pages or resources.

Visit our [documentation](#) for more information.

Copy to clipboard

    <flux:text>Visit our <flux:link href="#">documentation</flux:link> for more information.</flux:text>

[Link variants](#link-variants)
-------------------------------

Links can be styled differently based on their context and importance.

[Default link](#)

[Ghost link](#)

[Subtle link](#)

Copy to clipboard

    <flux:link href="#">Default link</flux:link><flux:link href="#" variant="ghost">Ghost link</flux:link><flux:link href="#" variant="subtle">Subtle link</flux:link>

Related components
------------------

[

Heading

Create hierarchical section headings



](/components/heading)[

Card

Containers for content with consistent styling



](/components/card)

Reference
---------

### [flux:text](#fluxtext)

Prop

Description

size

Size of the text. Options: xs, sm, base, lg. Default: base.

variant

Text variant. Options: strong, subtle. Default: default.

color

Color of the text. Options: default, red, orange, yellow, lime, green, emerald, teal, cyan, sky, blue, indigo, violet, purple, fuchsia, pink, rose. Default: default.

inline

If true, the text element will be a span instead of a p.

### [flux:link](#fluxlink)

Prop

Description

href

The URL that the link points to. Required.

variant

Link style variant. Options: default, ghost, subtle. Default: default.

external

If true, the link will open in a new tab.

---

## Textarea

Textarea
========

Capture multi-line text input from users. Ideal for comments, descriptions, and feedback.

Description

Copy to clipboard

    <flux:textarea />

[With placeholder](#with-placeholder)
-------------------------------------

Display a hint inside the textarea to guide users on what to enter.

Order notes

Copy to clipboard

    <flux:textarea    label="Order notes"    placeholder="No lettuce, tomato, or onion..."/>

[Fixed row height](#fixed-row-height)
-------------------------------------

Customize the height of the textarea by passing a rows prop.

Note

Copy to clipboard

    <flux:textarea rows="2" label="Note" />

[Auto-sizing textarea](#auto-sizing-textarea)
---------------------------------------------

Using CSS's new field-sizing property, the textarea will automatically adjust its height to fit the content by passing in the rows="auto" prop.

This feature is not available in all web browsers. Visit [caniuse.com](https://caniuse.com/?search=field-sizing) to see which browsers support this feature.

Copy to clipboard

    <flux:textarea rows="auto" />

[Configure resize](#configure-resize)
-------------------------------------

If you want to restrict the user from resizing the textarea, you can use the resize="none" prop.

Copy to clipboard

    <flux:textarea resize="vertical" /><flux:textarea resize="none" /><flux:textarea resize="horizontal" /><flux:textarea resize="both" />

Related components
------------------

[

Field

Structured form field with label



](/components/field)[

Input

Text fields for collecting user input



](/components/input)

Reference
---------

### [flux:textarea](#fluxtextarea)

Prop

Description

wire:model

Binds the textarea to a Livewire property. See the [wire:model documentation](https://livewire.laravel.com/docs/wire-model) for more information.

placeholder

Placeholder text displayed when the textarea is empty.

label

Label text displayed above the textarea. When provided, wraps the textarea in a flux:field component with an adjacent flux:label component. See the [field component](/components/field).

description

Help text displayed below the textarea. When provided alongside label, appears between the label and textarea within the flux:field wrapper. See the [field component](/components/field).

description:trailing

The description provided will be displayed below the textarea instead of above it.

badge

Badge text displayed at the end of the flux:label component when the label prop is provided.

rows

Number of visible text lines. Use "auto" for automatic height adjustment. Default: 4.

resize

Control how the textarea can be resized. Options: vertical (default), horizontal, both, none.

invalid

If true, applies error styling to the textarea.

Attribute

Description

data-flux-textarea

Applied to the textarea element for styling and identification.

---

## Theming

Theming
=======

We've meticulously designed Flux to look great out of the box, however, every project has its own identity. You can choose from our hand-picked color schemes or build your own theme by customizing CSS variables.

[Build your theme with our interactive theme builder ->](/themes)

Base color
----------

There are essentially two colors in a Flux project: the **base color** and the **accent color**.

The base color is the color of the majority of your application's content. It's used for things like text, backgrounds, borders, etc.

The accent color is the color of the primary action buttons and other interactive elements in your application.

Flux ships with "zinc" as the default base color, but you are free to use any shade of gray you'd like.

Because zinc is hard-coded throughout Flux's source code, you will need to redefine it in your CSS file if you'd like to use a different base color.

Here is an example of redefining "zinc" to "slate" in your CSS file:

Copy to clipboard

    /* resources/css/app.css *//* Re-assign Flux's gray of choice... */@theme {  --color-zinc-50: var(--color-slate-50);  --color-zinc-100: var(--color-slate-100);  --color-zinc-200: var(--color-slate-200);  --color-zinc-300: var(--color-slate-300);  --color-zinc-400: var(--color-slate-400);  --color-zinc-500: var(--color-slate-500);  --color-zinc-600: var(--color-slate-600);  --color-zinc-700: var(--color-slate-700);  --color-zinc-800: var(--color-slate-800);  --color-zinc-900: var(--color-slate-900);  --color-zinc-950: var(--color-slate-950);}

Now, Flux will use "slate" as the base color instead of "zinc", and you can use "slate" inside your application utilities like you normally would:

Copy to clipboard

    <flux:text class="text-slate-800 dark:text-white">...</flux:text>

Accent color
------------

Under the hood, flux uses CSS variables for its accent colors. This means that you can change the accent color to any color you'd like.

We recommend you use the [interactive theme builder](/themes) with pre-selected colors, however, if you'd like to use a different accent color, you can define the following CSS variables in your own css file:

Copy to clipboard

    /* resources/css/app.css */@theme {    --color-accent: var(--color-red-500);    --color-accent-content: var(--color-red-600);    --color-accent-foreground: var(--color-white);}@layer theme {    .dark {        --color-accent: var(--color-red-500);        --color-accent-content: var(--color-red-400);        --color-accent-foreground: var(--color-white);    }}

You'll notice Flux uses three different hues in both light mode and dark mode for its accent color palette. Here are descriptions of each hue:

Variable

Description

\--color-accent

The main accent color used is the background for primary buttons.

\--color-accent-content

A (typically) darker hue used for text content because it's more readable.

\--color-accent-foreground

The color of (typically) text content on top of an accent colored background.

Tailwind allows you to use reference CSS variable colors inline like so:

Copy to clipboard

    <button class="bg-[var(--color-accent)] text-[var(--color-accent-foreground)]">

However, this is not a very ergonomic syntax. Instead you can use utility classes such as:

Copy to clipboard

    <button class="bg-accent text-accent-foreground">

Accent props
------------

Certain design elements like tabs and links use the accent color by default. If you'd like to opt out of this behavior, and use the base color instead, you can use the :accent="false" prop:

Copy to clipboard

    <!-- Link --><flux:link :accent="false">Profile</flux:tab><!-- Tabs --><flux:tabs>    <flux:tab :accent="false">Profile</flux:tab>    <flux:tab :accent="false">Account</flux:tab>    <flux:tab :accent="false">Billing</flux:tab></flux:tabs><!-- Navbar --><flux:navbar>    <flux:navbar.item :accent="false">Profile</flux:navbar.item>    <flux:navbar.item :accent="false">Account</flux:navbar.item>    <flux:navbar.item :accent="false">Billing</flux:navbar.item></flux:navbar><!-- Navlist --><flux:navlist>    <flux:navlist.item :accent="false">Profile</flux:navlist.item>    <flux:navlist.item :accent="false">Account</flux:navlist.item>    <flux:navlist.item :accent="false">Billing</flux:navlist.item></flux:navlist>

---

## Toast

Flux Pro component

This component is only available in the Pro version of Flux.

[Upgrade to Pro ->](/pricing) [Upgrade to Pro ->](/pricing)

Toast
=====

A message that provides feedback to users about an action or event, often temporary and dismissible.

To use the Toast component from Livewire, you must include it somewhere on the page; often in your layout file:

Copy to clipboard

    <body>    <!-- ... -->    <flux:toast /></body>

If you are using wire:navigate to navigate between pages, you may want to persist the toast component so that toast messages don't suddenly disappear when navigating away from the page.

Copy to clipboard

    <body>    <!-- ... -->    @persist('toast')        <flux:toast />    @endpersist</body>

Once the toast component is present on the page, you can use the Flux::toast() method to trigger a toast message from your Livewire components:

Save changes

Copy to clipboard

    <?phpnamespace App\Livewire;use Livewire\Component;use Flux\Flux;class EditPost extends Component{    public function save()    {        // ...        Flux::toast('Your changes have been saved.');    }}

You can also trigger a toast from Alpine directly using Flux's magic methods:

Copy to clipboard

    <button x-on:click="$flux.toast('Your changes have been saved.')">    Save changes</button>

Or you can use the window.Flux global object to trigger a toast from any JavaScript in your application:

Copy to clipboard

    <script>    let button = document.querySelector('...')    button.addEventListener('alpine:init', () => {        Flux.toast('Your changes have been saved.')    })</script>

Both $flux and window.Flux support the following method parameter signatures:

Copy to clipboard

    Flux.toast('Your changes have been saved.')// Or...Flux.toast({    heading: 'Changes saved',    text: 'Your changes have been saved.',    variant: 'success',})

[With heading](#with-heading)
-----------------------------

Use a heading to provide additional context for the toast.

Save changes

Copy to clipboard

    Flux::toast(    heading: 'Changes saved.',    text: 'You can always update this in your settings.',);

[Variants](#variants)
---------------------

Use the variant prop to change the visual style of the toast.

Success Warning Danger

Copy to clipboard

    Flux::toast(variant: 'success', ...);Flux::toast(variant: 'warning', ...);Flux::toast(variant: 'danger', ...);

[Positioning](#positioning)
---------------------------

By default, the toast will appear in the bottom right corner of the page. You can customize this position using the position prop.

Save changes

Copy to clipboard

    <flux:toast position="top right" /><!-- Customize top padding for things like navbars... --><flux:toast position="top right" class="pt-24" />

[Duration](#duration)
---------------------

By default, the toast will automatically dismiss after 5 seconds. You can customize this duration by passing a number of milliseconds to the duration prop.

Save changes

Copy to clipboard

    // 1 second...Flux::toast(duration: 1000, ...);

[Permanent](#permanent)
-----------------------

Use a value of 0 as the duration prop to make the toast stay open indefinitely.

Save changes

Copy to clipboard

    // Show indefinitely...Flux::toast(duration: 0, ...);

Related components
------------------

[

Callout

A flexible content container for alerts, messages, and notifications



](/components/callout)[

Modal

Display temporary content in a modal dialog



](/components/modal)

Reference
---------

### [flux:toast](#fluxtoast)

Prop

Description

position

Position of the toast on the screen. Options: bottom right (default), bottom left, top right, top left.

duration

Duration in milliseconds before the toast auto-dismisses. Use 0 for permanent toasts. Default: 5000.

variant

Visual style of the toast. Options: success, warning, danger.

### [Flux::toast()](#fluxtoast)

The PHP method used to trigger toasts from Livewire components.

Parameter

Description

heading

Optional heading text for the toast.

text

Main content text of the toast.

variant

Visual style. Options: success, warning, danger.

duration

Duration in milliseconds. Use 0 for permanent toasts. Default: 5000.

### [$flux.toast()](#fluxtoast)

The Alpine.js magic method used to trigger toasts from Alpine components. It can be used in two ways:

    // Simple usage with just a message...$flux.toast('Your changes have been saved')// Advanced usage with full configuration...$flux.toast({    heading: 'Success!',    text: 'Your changes have been saved',    variant: 'success',    duration: 3000})

Parameter

Description

message

A string containing the toast message. When using this simple form, the message becomes the toast's text content.

options

Alternatively, an object containing: - heading: Optional title text - text: Main message text - variant: Visual style (success, warning, danger) - duration: Display time in milliseconds

---

## Tooltip

Tooltip
=======

Provide additional information when users hover over or focus on an element.

Because tooltips rely on hover states, touch devices like mobile phones often don't show them. Therefore, it is recommended that you convey essential information via the UI rather than relying on a tooltip for mobile users.

Settings

Copy to clipboard

    <flux:tooltip content="Settings">    <flux:button icon="cog-6-tooth" icon:variant="outline" /></flux:tooltip>

As a shorthand, you can pass a tooltip prop into a button component directly.

Copy to clipboard

    <flux:button tooltip="Settings" ... />

[Info tooltip](#info-tooltip)
-----------------------------

In cases where a tooltip's content is essential, you should make it toggleable. This way, users on touch devices will be able to trigger it on click/press rather than hover.

Tax identification number

For US businesses, enter your 9-digit Employer Identification Number (EIN) without hyphens.

For European companies, enter your VAT number including the country prefix (e.g., DE123456789).

Copy to clipboard

    <flux:heading class="flex items-center gap-2">    Tax identification number    <flux:tooltip toggleable>        <flux:button icon="information-circle" size="sm" variant="ghost" />        <flux:tooltip.content class="max-w-[20rem] space-y-2">            <p>For US businesses, enter your 9-digit Employer Identification Number (EIN) without hyphens.</p>            <p>For European companies, enter your VAT number including the country prefix (e.g., DE123456789).</p>        </flux:tooltip.content>    </flux:tooltip></flux:heading>

[Position](#position)
---------------------

Position tooltips around the element for optimal visibility. Choose from top, right, bottom, or left.

Settings

Settings

Settings

Settings

Copy to clipboard

    <flux:tooltip content="Settings" position="top">    <flux:button icon="cog-6-tooth" icon:variant="outline" /></flux:tooltip><flux:tooltip content="Settings" position="right">    <flux:button icon="cog-6-tooth" icon:variant="outline" /></flux:tooltip><flux:tooltip content="Settings" position="bottom">    <flux:button icon="cog-6-tooth" icon:variant="outline" /></flux:tooltip><flux:tooltip content="Settings" position="left">    <flux:button icon="cog-6-tooth" icon:variant="outline" /></flux:tooltip>

[Disabled buttons](#disabled-buttons)
-------------------------------------

By default, tooltips on disabled buttons won't be triggered because pointer events are disabled as well. However, as a workaround, you can target a wrapping element instead of the button directly.

Merge pull request

Cannot merge until reviewed by a team member

Copy to clipboard

    <flux:tooltip content="Cannot merge until reviewed by a team member">    <div>        <flux:button disabled icon="arrow-turn-down-right">Merge pull request</flux:button>    </div></flux:tooltip>

Related components
------------------

[

Button

Interactive elements for user actions



](/components/button)[

Icon

Visual symbols and metaphors for UI elements



](/components/icon)

Reference
---------

### [flux:tooltip](#fluxtooltip)

Prop

Description

content

Text content to display in the tooltip. Alternative to using the flux:tooltip.content component.

position

Position of the tooltip relative to the trigger element. Options: top (default), right, bottom, left.

align

Alignment of the tooltip. Options: center (default), start, end.

gap

Spacing between the trigger element and the tooltip. Default: 5px.

offset

Offset of the tooltip from the trigger element. Default: 0px.

toggleable

Makes the tooltip clickable instead of hover-only. Useful for touch devices.

interactive

Uses the proper ARIA attributes (aria-expanded and aria-controls) to signal that the tooltip has interactive content.

kbd

Keyboard shortcut hint displayed at the end of the tooltip.

Attribute

Description

data-flux-tooltip

Applied to the root element for styling and identification.

### [flux:tooltip.content](#fluxtooltipcontent)

Prop

Description

kbd

Keyboard shortcut hint displayed at the end of the tooltip content.

---

## Upgrading

Upgrade guide
=============

Follow this guide to upgrade from Flux v1.x to v2.x.

Prerequisites
-------------

Before upgrading to Flux v2, make sure you have the following:

*   Laravel version 10 or later
*   Livewire version 3.5.19 or later
*   Tailwind CSS version 4 or later

Flux v2 is built on top of Tailwind CSS v4, so if you are using an older version of Tailwind CSS, you need to upgrade it to v4 or later by following the [Tailwind CSS upgrade guide](https://tailwindcss.com/docs/upgrade-guide).

Update Flux
-----------

Run the following composer command to upgrade your application's Flux and Flux Pro dependencies to v2:

Copy to clipboard

    composer require livewire/flux:^2.0 livewire/flux-pro:^2.0

Rename @fluxStyles
------------------

In Flux v2, the @fluxStyles directive has been removed as these styles are now imported directly into your app.css file.

However, the @fluxAppearance directive has been added as a replacement to manage dark mode in your application—it controls the .dark class on the <html> element.

Copy to clipboard

    <head>    ...--    @fluxStyles++    @fluxAppearance</head>

Clear the view cache
--------------------

Run the following Artisan command from your application's root directory to clear any cached/compiled Blade views:

Copy to clipboard

    php artisan view:clear

Tailwind Config
---------------

Because Flux's styles are no longer added via the @fluxStyles directive, you will need to import the Flux CSS file directly into your ./resources/css/app.css file like so:

Copy to clipboard

    @import "tailwindcss";@import '../../vendor/livewire/flux/dist/flux.css';/* Required for dark mode in Flux... */@custom-variant dark (&:where(.dark, .dark *));...

Migrating accent colors
-----------------------

If you had previously defined custom accent colors in your app.css and tailwind.config.js file, then you will need to update them in your app.css file.

Before, these were defined in a single @layer base block within your app.css file, but now they are defined as two separate blocks:

*   default colors are now inside the @theme block
*   dark mode colors are now inside the @layer theme block

Here's an example of defining sky as your application's accent color:

Copy to clipboard

    @theme {    --color-accent: var(--color-sky-600);    --color-accent-content: var(--color-sky-600);    --color-accent-foreground: var(--color-white);}@layer theme {    .dark {        --color-accent: var(--color-sky-600);        --color-accent-content: var(--color-sky-400);        --color-accent-foreground: var(--color-white);    }}

If you're still using your old Tailwind config, you can now remove the following lines:

Copy to clipboard

    export default {    ...    theme: {        extend: {            colors: {                ...--             accent: {--                  DEFAULT: 'var(--color-accent)',--                  content: 'var(--color-accent-content)',--                  foreground: 'var(--color-accent-foreground)',--              },            },        },    },};

Re-assigning gray
-----------------

If you had previously re-assigned Flux's gray of choice in your tailwind.config.js file, then you will need to move this to your app.css file.

Here's an example of re-assigning zinc to neutral:

Copy to clipboard

    /* Re-assign Flux's gray of choice... */@theme {  --color-zinc-50: var(--color-neutral-50);  --color-zinc-100: var(--color-neutral-100);  --color-zinc-200: var(--color-neutral-200);  --color-zinc-300: var(--color-neutral-300);  --color-zinc-400: var(--color-neutral-400);  --color-zinc-500: var(--color-neutral-500);  --color-zinc-600: var(--color-neutral-600);  --color-zinc-700: var(--color-neutral-700);  --color-zinc-800: var(--color-neutral-800);  --color-zinc-900: var(--color-neutral-900);  --color-zinc-950: var(--color-neutral-950);}

If you are continuing to use your tailwind.config.js file in your application, then you can remove the following:

Copy to clipboard

    -- import colors from 'tailwindcss/colors';export default {    ...    theme: {        extend: {            colors: {--              // Re-assign Flux's gray of choice...--              zinc: colors.neutral,                ...            },        },    },};

Dark mode changes
-----------------

If you had previously set darkMode: null in your tailwind.config.js file to prevent Flux from controlling the .dark class and handling dark mode automatically, you can now accomplish this by not including the @fluxAppearance directive in your layout file:

Copy to clipboard

    <head>    ...--    @fluxAppearance</head>

Rename components
-----------------

In Flux v2, some components have been renamed. You will need to update your code accordingly:

v1

v2

flux:options

flux:select.options

flux:option

flux:select.option

flux:cell

flux:table.cell

flux:columns

flux:table.columns

flux:column

flux:table.column

flux:rows

flux:table.rows

flux:row

flux:table.row

---