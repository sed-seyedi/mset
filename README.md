# mset

Mset is a simple and user friendly configuration file format. You can use it instead of .json and .ini files.

**example:**

```
key         => value
another key => another value
third key   => you can also pass a value
               with multiple lines.
```

Keys are case and space insensitive -- it's easier to remember and type them.

## Why?

Simplicity and performance! Some applications just need a simple set of key value pairs 
to configure. For those applications, JSON is an overkill and INI files are too restrictive 
(keys must use _ to separate words and many more).

Mset is also very fast! It's only 50 lines of code and can be included in any project. It's
also very easy to create an Mset parser in any other language.
 
We use Mset at [SunSed](https://www.sunsed.com/) to set file metadata and also to set multiple variables at once using [MSET tag](https://www.sunsed.com/tags/s/mset) (that's where the name comes from: Multi SET).

## How?

```
$ret = mset_parse($str); # assuming above example is passed
print_r($ret);
```

**Result:**

```
Array
(
    [key] => value
    [another-key] => another value
    [third-key] => you can also pass a value with multiple lines.
)
```

## Key format

Keys are lowercased, trimmed and then multiple spaces are replace with one dash (`-`). Users can
use any character in keys (`?!*$(*`) but they cannot repeat these special characters (e.g. `--` will become `-`).

```
api key =>
api-key =>
API   keY   =>
```

## Custom Key format

The built-in key formatter is easy on both developers and users. But, if you have some special ues case
you can easily pass a function as the second argument to `mset_parse` and build it so it accepts a `$key` 
and returns the formatted key.


