
# laravel-json-query-log

add database log into JsonResponse

avoid N+1 query, see query result  

example:

```
\Illuminate\Http\JsonResponse
{
  "hi": "hello",
  "_query_log": [
    "select * from text"
  ]
}
```

## install


## usage

add `DEBUG_QUERY_ENABLED=true` to `.env` 

*default DEBUG_QUERY_ENABLED=false*