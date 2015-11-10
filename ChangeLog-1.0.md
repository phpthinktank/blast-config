# Changes in Blast facades 1.0

All notable changes of the Blast facades 1.0 release series are documented in this file using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [1.1.0] - 2015-11-10

### Added

- Add xml loader to generate php configuration from xml

## [1.0.1] - 2015-11-04
### Changed

- store clover.xml while ci testing ./build/logs/ instead of ./

### Removed

- Remove logging section from phpunit since clover.xml is stored in ./build/logs with --coverage-clover build/logs/clover.xml
- Remove .coveralls.yml since we are using default config from coveralls

### Added

- Add .editorconfig to provide PSR-2 by default
