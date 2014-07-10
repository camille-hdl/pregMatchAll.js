#pregMatchAll.js
===============

Want to use PHP's preg_match_all() in Javascript ?

```javascript
var pattern    = / *([a-z0-9\-]+) *: *([^;]*)/i;
var str        = "X-MyHeader: MyValue; X-AZE: adqdsdfff;USERAGENT: Chrome123123 é'";
var matches    = jsPregMatchAll(pattern,str,"PREG_SET_ORDER");
```
    

##TODO
  * I need better tests (especially with the offset parameter)
  * encoding problems (see test #0)
  * No support for flag combinations yet ...
  * For now, if you want to have the exact same output when nothing is matched, you have to provide the "nbP" parameter with the number of capturing parentheses...
