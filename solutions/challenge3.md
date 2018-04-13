Solution: Challenge 3
======

## Vulnerability Type(s)

- Stored cross-site scripting (XSS)
- Filtering bypass

## Summary

When the user visits the main page for Challenge 3 they're greeted with a listing of blog posts with clickable titles. When they click on each of those titles, they can view the blog post's detail page (`/view/[id]`). Included in this page is the contents of the post as well as a form input for the user to submit contents.

The user can then try out making a comment, both with normal text and text with HTML markup. A hint should be provided that form inputs should be seen as a good attack path for injection attacks. Users should then progress to trying out different kinds of markup input to see what might be successful.

Most of the input will be blocked, however, as there is detection on both `<script>` tags and a call to `strip_tags` before the value is pushed into the database. However, there is one exception: the `img` tag. This tag is allowed through the filtering process and can be discovered with a bit of trial and error (persistence pays off).

## Vulnerability

Once the user figures out that they can inject an `img` tag into the content, they can then use that to inject a stored XSS attack that will execute for any visitor to the page. There are several different ways that Javascript can be injected into an `img` tag. One such method is to provide an invalid image source location and use the `onerror` to trigger the Javascript:

```
<img src=x onerror="alert(1)"/>
```

When that content is saved, it will bypass the tag filtering and save directly to the database. When the page reloads, the `alert` will fire and the XSS attack will be performed.