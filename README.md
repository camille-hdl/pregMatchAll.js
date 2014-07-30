#pregMatchAll.js
===============

Want to use PHP's preg_match_all() in Javascript ?

```javascript
var pattern    = / *([a-z0-9\-]+) *: *([^;]*)/i;
var str        = "X-MyHeader: MyValue; X-AZE: adqdsdfff;USERAGENT: Chrome123123 é'";
var matches    = preg_match_all(pattern,str,"PREG_SET_ORDER");
```
    
##Notes
  * Javascript's build-in regex engine is used, and it is different from PHP's PCRE engine.
  * This code is also available in [php.js (workbench)](https://github.com/kvz/phpjs/blob/master/workbench/pcre/preg_match_all.js)

##TODO
  * I need better tests (especially with the offset parameter)
  * encoding problems (see test #0)
  * No support for flag combinations for now


Know how to fix something ? Want to add test cases ? Please tell me here or by email at camille.hodoul  at gmail.com