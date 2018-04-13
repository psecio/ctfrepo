Solution: Challenge 3
======

## Vulnerability Type(s)

- Default (admin) credentials
- Inconsistent authorization checks

## Summary

When the user visits the main page for this challenge, they're greated with a login form. There doesn't seem to be any other useful information on the page directly so they'll have to take another approach. Sometimes when a new application/service/system is set up it will come with a default account. In this case, we've forgotten to disable the `admin` account (password `admin`).

The user can log in with these credentials and will see the three users in the list, one of them the admin user. There are `Delete` buttons next to each to remove them from the system and an `Add User` button. In the case of an administrator user, we should correctly have access to all of these features. But are they protected from normal users?

They should gather information from the current page on actions the Admin is allowed to do: create a new user and delete users.

To test what normal users can do, they'll need to create a user of their own with a known password. Once they've created that user, they can log in. They'll be given a list of users but they can't do anything with them - the `delete` buttons aren't there.

## Vulnerability

While the "Add User" functionality is correctly protected, the endpoint to delete users (`/user/delete/[id]`) is not. Using ZAP they can grab the current request via the proxy, change the URL to the delete path and successfully delete a user.