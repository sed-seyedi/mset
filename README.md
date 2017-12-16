# mset

Mset is a simple and userfriendly configuration file format. You can use it instead of .json and .ini files.

**example:**

```
key => value
another key => another value
third key => multi line
 values will be turned into a single line and separated by a single space.
```

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
    [third-key] => multi line values will be turned into a single line and separated by a single space.
)
```

## Key format

Keys are lowercased and then spaces is replaced with one dash. For example:

```
(original key) => (transformation)
is good test? => is-good-test?
is good test??? => is-good-good?
user    is    good? => is-good-test?
something((good)) => something(good)
```

Remember, keep it simple! For example, `api key` can be provided in any of the following ways and it still works:

```
api key =>
api-key =>
  API   key   =>
```

## Custom Key format

The built-in key formatter is easy on both developers and users. But, if you have some special ues case
you can easily pass a function as the second argument to `mset_parse` and build it so it accepts a `$key` 
and returns the formatted key.


