# GetSimple Sample Plugins
A repository that aims to provide examples of common plugins and actions done
by plugins.

All plugins:

* Are multi-language compliant
* Work with PHP 5.2+
* Work with GetSimple 3.3.6+
* Work together (can be loaded at the same time)

## Hello World!
Echos "Hello World" in the theme footer. Updated from the GetSimple wiki to be language-compliant.

## Sample Placeholder
Replaces **(% placeholder %)** with some sample content. The placeholder also takes
parameters separated by |, e.g. `repeat="5" | size="10"`.

## Sample Settings
Gives admin a settings object that can be modified from the admin panel. Demonstrates how to build
a working administration panel and how to save data in GetSimple.

## Sample Items
Gives admin an initially empty collection of data that can be viewed/created/edited/deleted
in the admin panel like Pages (or Items from the Items Manager plugin). Demonstrates how to build
and manage collections of data in GetSimple, as well as how to allow a plugin to be interacted with through
the hook system (used by other plugins in the repository).

## Sample Virtual Page
Displays custom content on a non-existent page with the slug `virtual-page`.

## Sample Pages
Uses the **Sample Items** and **Sample Settings** plugins to display content from the items as front-end pages
with the slug prefix `sample-ipage-`.

## Sample Items Search
Uses the **Sample Items** plugin and **[I18N Search](http://get-simple.info/extend/plugin/i18n/82/)** to make the sample items searchable.

## Sample Items AJAX
Uses **Sample Items Search** to display the items on a virtual page `sample-items-ajax`, where
the items are requested via AJAX. Demonstrates the basics of building an API that returns JSON data.