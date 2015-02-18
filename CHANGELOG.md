# Version 1.0.2

Fixed issues with Google's Tag Assistant validator. (Thanks to @nja78)
See https://github.com/lukanetconsult/mage-google-adwords/pull/8

# Version 1.0.1

Fixed possible different conversion values in script and noscript
See https://github.com/lukanetconsult/mage-google-adwords/issues/5

# Version 1.0

**Important**:
The system configuration for this module has changed to support multiple conversions!
You have to re-configure your conversion tracking IDs.

* Added support for multiple conversions
* Moved tracking code to `before_body_end` block.
* Moved design components to base package
* Dropped 1.3 and 1.4 support
