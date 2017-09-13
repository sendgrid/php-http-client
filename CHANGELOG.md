# Change Log
All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/).

## [3.8.0] - 2017-09-13
### Added
- Pull request #23: [Automatically retry when rate limit is reached](https://github.com/sendgrid/php-http-client/pull/23)
- Thanks to [Budi Chandra](https://github.com/budirec) for the pull request!

## [3.7.0] - 2017-05-04
### Added
- Pull request #19: [Added ability to get headers as associative array](https://github.com/sendgrid/php-http-client/pull/19)
- Solves issue #361: [https://github.com/sendgrid/sendgrid-php/issues/361](https://github.com/sendgrid/sendgrid-php/issues/361)
- Thanks to [Alexander](https://github.com/mazanax) for the pull request!

## [3.6.0] - 2017-03-01
### Added
- Pull request #16: [Pass the curlOptions to the client in buildClient](https://github.com/sendgrid/php-http-client/pull/16)
- Thanks to [Baptiste Clavié](https://github.com/Taluu) for the pull request!

## [3.5.1] - 2016-11-17
### Fixed
- Pull request #13, fixed issue #12: [Change from to php union operator to combine curl options](https://github.com/sendgrid/php-http-client/pull/13)
- Thanks to [emil](https://github.com/emilva) for the pull request!

## [3.5.0] - 2016-10-18
### Added
- Pull request #11: [Added curlOptions property to customize curl instance](https://github.com/sendgrid/php-http-client/pull/11)
- Thanks to [Alain Tiemblo](https://github.com/ninsuo) for the pull request!

## [3.4.0] - 2016-09-27
### Added
- Pull request #9: [Add getters for certain properties](https://github.com/sendgrid/php-http-client/pull/9)
- Thanks to [Arjan Keeman](https://github.com/akeeman) for the pull request!

## [3.3.0] - 2016-09-13
### Added
- Pull request #6: [Library refactoring around PSR-2 / PSR-4 code standards](https://github.com/sendgrid/php-http-client/pull/6)
- Thanks to [Alexandr Ivanov](https://github.com/misantron) for the pull request!

## [3.1.0] - 2016-06-10
### Added
- Automatically add Content-Type: application/json when there is a request body

## [3.0.0] - 2016-06-06
### Changed
- Made the Request and Response variables non-redundant. e.g. request.requestBody becomes request.body

## [2.0.2] - 2016-02-29
### Fixed
- Renaming files to conform to PSR-0, git ignored the case in 2.0.1

## [2.0.1] - 2016-02-29
### Fixed
- Renaming files to conform to PSR-0

## [1.0.1] - 2016-02-29
### Fixed
- Composer/Packagist install issues resolved

## [1.0.0] - 2016-02-29
### Added
- We are live!
