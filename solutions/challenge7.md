Solution: Challenge 7
======

## Vulnerability Type(s)

- API authorization via JWT bypass using "None" algorithm

## Summary

When the user logs into the API, they're provided a `token` to use in the `Authorization` header. This token includes a claim `role` value of `user` for normal users. However, the library is vulnerable to attack via the use of the `None` algorithm.

When the JWT is decoded (as it's not encrypted), they should notice that the `role` value is `user`. It's pretty likely that they can change this to `admin` and gain administrator access. JWT structure uses a signature to protect the contents of the claims from direct modification but if the `algo` value in the header is changed to `None` the vulnerable library doesn't check the signature.

To perform the bypass:

1. Make a valid JWT token and then go decode it
2. See that there's a "role" value in the claims
3. Change this value to "admin" and use the "None" algorithm in the header
4. Use this new token for a username that should just be a user

Boom, auth bypass

Example token for user "test1" with no signature: eyJhbGciOiJOb25lIiwidHlwIjoiSldUIn0.eyJhdWQiOiJodHRwOlwvXC9jYXB0dXJldGYuY29tIiwiZXhwIjoiMTU0OTU0MTU5MyIsImlhdCI6IjE1NDk1Mzc5OTMiLCJpc3MiOiJodHRwOlwvXC9jYXB0dXJldGYuY29tIiwibmJmIjoiMTU0OTUzNzk5MyIsInJvbGUiOiJhZG1pbiIsInVzZXJuYW1lIjoidGVzdDEifQ