## What and Why?

This is the TEC Labs Extension Template. It allows you to easily extend our plugins: The Events Calendar, Event Tickets, and their associated add-on plugins.

The primary benefits of using this template is that it's gets you up-and-running quicker than building a custom plugin yourself, and it's best to extend one plugin via another plugin instead of adding custom code to your child theme's `functions.php` file.

We ensure your new extension does not run if its required base plugin is not activated, which helps avoid fatal errors and means fewer `class_exists()` checks are applicable.

Extensions have been available since The Events Calendar version 4.3.3 (November 16, 2016). If you try to get this template to work with versions before this date, your extension will not run at all.

Newer extensions will only be compatible with the version of The Events Calendar 5.1.1 or newer.

## Extension template Information

If you have modifications you would like to suggest to our base template, here is the correct place to submit a Pull Request, but if you are looking for a specific extension you should take a look at our [GitHub profile](https://github.com/mt-support) or our [Extensions page on TheEventsCalendar.com](https://theeventscalendar.com/extensions/).

#### If you want to make your own new extension:

1. On Slack use `bot create (tec|et) extension named <plugin name>`
1. Your Extension is currently a functional WordPress plugin at this point! Please refer to our [Good Practices](#good-practices) before the next step.
1. Zip and release your plugin!

#### Good Practices

* Verify if you need any dependencies to activate your plugin. If so, use the bot command to [set a dependency](#setting-a-dependency)
* Set the `== Changelog ==` section of `readme.txt`.
* Remove the unused classes from the `src/Tec` folder.
* Register any other classes you will need inside of `src/Tec/Plugin.php` on the method `register` after the line `// Start binds.` and before `// End binds.`.
* Sanitize all input and escape all output, as appropriate.
* Double-check your plugin's slug, name, and descriptions still apply to the end result of what your code actually accomplishes.
* Generate your *.pot* file by running this WP-CLI command: `wp i18n make-pot . languages/tec-labs-extension-template.pot --headers='{"Report-Msgid-Bugs-To":"The Events Calendar <https://support.theeventscalendar.com/>"}'`
* Remove this `README.md` file.

#### Extension Template Variables

By default, all of these variables will be replaced by the create method from the slack bot, but if you are creating your extension manually you will need to find/replace on all of the below.

* `__TRIBE_BASE__` - "The Events Calendar" or "Event Tickets"
* `__TRIBE_NAME__` - Plugin Human-readable name, e.g. "Sample Extension"
* `__TRIBE_NAMESPACE__` - Which namespace we will use for the plugin. Usually the plugin name or the slug in uppercase without spaces, e.g. "SampleExtension"
* `__TRIBE_SLUG__` - Uses using dashes normally, e.g. "sample-extension"
* `__TRIBE_DOMAIN__` - Translation domain normally with "tribe-" prefix, e.g. "tec-labs-sample-extension"
* `__TRIBE_SLUG_CLEAN__` - Uses underscores, so it's safe for variables, e.g. "sample_extension"
* `__TRIBE_SLUG_CLEAN_ALLCAPS__` - All-caps of clean slug, e.g. "SAMPLE_EXTENSION"
* `__TRIBE_URL__` - The URL of the extension page, by default empty. Usually "https://theeventscalendar.com/extensions/sample-extension/"
* `__TRIBE_VERSION__` - Version number of the extension, by default empty. Follows the "1.0.0" format
* `__TRIBE_DESCRIPTION__` - The description of the extension, by default empty.

#### Slack Bot commands related to Extensions

##### Creating a new Extension

Bot will determine the namespace based on the plugin name:
```
bot create (tec|et) extension named <plugin name>
```

Specifically passing a namespace that is different from the plugin name:
```
bot create (tec|et) extension named <plugin name> with a namespace of <Plugin_Namespace>
```

##### Setting a dependency

```
bot add dependency <plugin-it-depends> version <version> to <extension-repo-name> extension
```

_More bot commands to come in the future._
