# Relify - link all the links

[Relify](http://relify.com/) is an implementation of the HTTP LINK method...at last.

## PHP implementation

### Usage

Add the `php/relify.php` file just outside your `public_html` (or similar)
directory, and include it into the primary `index.php` file that routes the
URLs for your site (rashly assuming your site is setup this way...).

### TODO

* [ ] provide .htaccess file
* [ ] expand `links` object to retain all provided attributes (`title`, etc)


## Python implementation

### Usage

Assuming rashly that you are in the directory you checked this repo into:

```
$ cd aspen-python
$ pip install -r requirements
$ ./serve.sh
```

`./serve.sh` runs the [aspen.io](http://aspen.io/)-based implementation.

### TODO

* [ ] :bug: match PHP implementations `links` object format
* [ ] provide WSGI version for more frameworks


# License

MIT
