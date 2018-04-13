Solution: Challenge 1
======

## Vulnerability Type(s)

Below is a list of vulnerability types involved in this challenge:

- Hidden "secret" data on the page (the commented HTML link)
- Default administration path of `/admin`
- User controllable auth handling (the is_admin cookie, can be changed to "1")
- Insufficent data protection (just base64 encoded)

## Summary

When the user visits the main page for this challenge, they're presented with a list of blog entries. They cannot be clicked on so it's left up to the user to determine another course of action.

If they view the source of the page, they'll notice a "hidden" link to the `/admin` page in a commented out anchor tag. If they visit this page, they'll be presented with a login prompt. While it might make sense to try to log in, they'll always be given the "Invalid Credentials" message. They should then start looking at other parts of the request/response that might be useful.

When they request the `/admin` endpoint, an `is_admin` cookie is also set. If they view this cookie, they should notice that the value in the cookie is a URL encoded version of a bas64 string. If they decode this string, they'll be given:

```
admin=0
```

## Vulnerability

To exploit the vulnerability and recieve the flag notification, they should change the `is_admin` cookie value to a base64 encoded version of this string:

```
is_admin=1
OR
YWRtaW49MQ==
```

Once they change this cookie value the page will show the success message.