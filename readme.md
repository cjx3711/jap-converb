# Jap Converb

v0.4

This is a web application that can conjugate any Japanese verb (hopefully) using the rules of conjugation.
A live example can be found here.
[Japanese Verb Conjugator](http://projects.pixelrife.com/jap) (v0.3)

## Structure
The application is coded in jQuery / Bootstrap.
The backend framework is running on PHP.

## Libraries / Dependencies
- [Wakakana](http://wanakana.com/) - Romaji - Kana conversion library
- [Jisho API](http://jisho.org/forum/54fefc1f6e73340b1f160000-is-there-any-kind-of-search-api) - For dictionary results
- [jQuery](https://jquery.com/) - Javascript interactivity
- [Bootstrap](http://getbootstrap.com/) - Responsive UI
- [QUnit](http://qunitjs.com/) - Test framework
- [Grunt](http://gruntjs.com/) - Test automation

## Setup
1. Clone the repo.
1. Install npm
1. Install grunt-cli `npm install -g grunt-cli`
1. Install all project dependendies `npm install` (must be done in project folder)
1. Run `grunt test` to see if grunt is running.

> Note: There is no reason that the program is in php. It is only so because it happens to be the language I was most familiar with at that time.

## Todo
1. Add a lesson / learning page.
1. Move away from php (maybe?).
(Refer to github issues for more comprehensive list.)

# Changelog

**v0.4**
- Refactored all JS code so it's in different files
- Added QUnit testing framework

**v0.3**
- Added jisho.org API for dictionary lookups

**v0.2**
- Added advanced conjugation rules

**v0.1**
- Added basic conjugation rules
- Added romaji to kana library
