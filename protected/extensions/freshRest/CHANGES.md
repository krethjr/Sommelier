# Version 0.93

* Fixed no input bug via POST using php://input
* Auth token can be passed via GET, POST, or PUT issue #1
* Cache component is optional (but still recommended)

# Version 0.94

* Partially merged with fork from Paul Preibsich (https://bitbucket.org/onebesky/freshrest/pull-request/8/upgrades/diff)
* Auth token can be loaded from POST/PUT/GET and auth headers (X-Access-Token, Authorization)
* added missing errs function
* Wrong authentication returns 401 instead of 403 error code
* Cached authentication data are deleted after new authentication
* Errors set by model setters are persistent after validation