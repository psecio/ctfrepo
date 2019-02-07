Solution: Challenge 8
======

## Vulnerability Type(s)

- Command injection

## Summary

Making the `POST` request to the `/` endpoint with a `match` value in the body will try and match against file names in the `files/` directly. Unfortunately this makes use of the [exec](https://php.net/exec) PHP function and uses the input directly.

Because of this (and no built in controls to prevent it) the attacker could use a string like `test1; uptime` to get access to additional information.

To fix this, use [escape_shell_args](https://php.net/escape_shell_args) to correctly filter the user input before using it in the command.