# GetSimple Sample Plugins
A repository that aims to provide examples of common plugins and actions done
by plugins.

All plugins:

* Are multi-language compliant
* Work with PHP 5.2+
* Work with GetSimple 3.3.6+
* Work together (can be loaded at the same time)

# Hello World!
Echos "Hello World" in the theme footer.

# Sample Placeholder
Replaces **(% sample %)** with some sample content. The placeholder also takes
parameters separated by |, e.g. `repeat="5" | size="10"`.

# Sample Settings
Gives admin a settings object that can be modified from the admin panel.

# Sample Items
Gives admin an initially empty collection of data that can be viewed/created/edited/deleted
in the admin panel like Pages (or Items from the Items Manager plugin).

# Sample Virtual Page
Displays custom content on a non-existent page with the slug `virtual-page`.

# Sample Pages
Uses the **Sample Items** and **Sample Configuration** plugins to display content from
the items as front-end pages.

# Sample Items Search
Uses the **Sample Items** plugin and [I18N Search](http://get-simple.info/extend/plugin/i18n/82/) to make the sample items searchable.