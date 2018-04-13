Solution: Challenge 2
======

## Vulnerability Type(s)

- `robots.txt` exposing previously unknown information
- Server Security Misconfiguration -> Directory Listing Enabled (info exposure)
- Plain-text output of credentials in web server log
- "security through obscurity" of the `/user/login` endpoint

## Summary

When the user comes to the initial page for this challenge, they'll be presented with a "Maintenance Mode" notification. There are no other links on the page, hidden or otherwise. There are also no additional cookies set that could be manipulated. The user needs to think about other approaches to gather information about the target.

One common ("hidden") place to gather more information about a site is the `robots.txt` file. This file is used by automated scanners to define where they should search and what they should avoid. In this case, the `robots.txt` file exposes the fact that there's a `files/` directory. Under the challenge.

The web server is incorrectly configured to show the `files/` folder as a litsing of files. These files include a trick `flat.txt` file, a trick `photo.png` with a meme message and a `log.txt` file. This `log.txt` contains a few lines from a web server log where the application was logging the plain-text credentials and the success/fail status of each.

Using this information, the user can then glean the correct username and password to log in to the system as well as learning about the `/user/login` "hidden" endpoint

## Vulnerability

After performing all of this discovery, the user can then visit the `/user/login` page and be presented with a login form. Using the credentials discovered as successful from the `log.txt` file, they can successfuly authenticate with:

```
username: admin
password: 3l33t
```

...and be greated with the success message.