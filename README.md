## What and Why?

This is the Modern Tribe Extension Template. It allows you to easily extend our plugins: The Events Calendar, Event Tickets, and their associated add-on plugins.

The primary benefits of using this template is that it's gets you up-and-running quicker than building a custom plugin yourself, and it's best to extend one plugin via another plugin instead of adding custom code to your child theme's `functions.php` file.

We ensure your new extension does not run if its required base plugin is not activated, which helps avoid fatal errors and means fewer `class_exists()` checks are applicable.

Extensions have been available since The Events Calendar version 4.3.3 (November 16, 2016). If you try to use this template to work with versions before this date, your extension will not run at all.

## How?

If you want to suggest an edit to this _template_, submit a pull request to this repo.

#### If you want to make your own new extension:

1. Create your own new repository, prefixing its name with the required `tribe-ext-` prefix (or else your extension will not run at all, even if activated).
1. Download the `master` branch of _this template_ as a .zip and unzip it.
1. Because you cannot make a new branch until you have an initial commit to your own new repo's `master` branch, copy this template's `license.txt` file and commit it to your repo's `master` branch.
1. Create a new branch called `initial` or `v1` or whatever is appropriate and check out this branch.
1. Place the remainder of this template's files in your repo's new branch.
1. Find and replace these strings throughout all file names and file contents:
    1. Extension plugin's slug: `tribe-ext-extension-template`
    1. `[Base Plugin Name] Extension: [Extension Name]`:
        1. `[Base Plugin Name]` should be something like `The Events Calendar`
        1. `[Extension Name]` should be the name of your extension, such as `Remove Export Links`
    1. `[Extension Description]` with your extension plugin's short description.
    1. PHP namespace: `Tribe\Extensions\Example` (must be unique among all extensions)
1. Set `Plugin URI` accordingly.
1. Set `GitHub Plugin URI` accordingly.
1. Set `Author:` and `Author URI:` accordingly if not being authored by Modern Tribe.
1. Set the `== Description ==` section of `readme.txt`
1. Add your required plugin(s) via `$this->add_required_plugin()`.
    1. You should have at least one required plugin and/or conditionally-required plugin(s), making use of `Tribe__Dependency`.
    1. If you're requiring a specific version, add a small code comment why this version is required. You should probably also mention this in `readme.txt`.
1. Remove the starter bits that don't apply to your extension, such as required PHP version comments.
    1. Look for `TODO` comments to identify some things to modify or remove, as applicable. For example, remove the entire `src` directory and the `Tribe__Autoloader` code if you do not have any settings to add to the admin UI and do not need the autoloader for any other purpose.
    1. It might be advisable to leave the PHP version checking logic (and matching part of readme.txt) unmodified until one of your last commits to ensure you correctly determine the required version.
1. Add your filters and actions in the `init()` method, creating your custom methods as needed.
1. Remove all unused/unnecessary code and comments, as this template may handle edge cases that do not apply to your extension.
1. Sanitize all input and escape all output, as appropriate.
1. Double-check your plugin's slug, name, and descriptions still apply to the end result of what your code actually accomplishes.
1. Set the `== Changelog ==` section of `readme.txt`.
1. Delete this `README.md` file.
1. Zip and release your plugin!