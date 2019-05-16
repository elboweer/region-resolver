Symfony Region resolver
========================

Install
-------

```bash
composer install -o && \
bin/console cache:clear --env=dev && \
```

```bash
composer install -o && \
bin/console cache:clear --env=prod && \
```

Response format - json
------------------
------------------

Resolve region by IP
---------

`/ip/resolve/127.0.0.1`

Resolve region by Phone
----

`/phone/resolve/9101234567`