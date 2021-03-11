
## Категория

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/categories -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/categories/:id -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X POST -d '{"name":"Name","icon":"Icon", "parent_id": default:0}' https://apimnnzz.tk/api/categories 
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/categories/tutorials/:id -H 'Authorization: Bearer [:token]' для список уроки
              
```

## Уроки (категория)

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/tutorial -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/tutorial/:id -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X POST -d '{"category_id":"1","title":"test", "parent_id": default:0}' https://apimnnzz.tk/api/tutorial 
```

## Медиа (здесь будет видео аудио текст )

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/media/:id -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X POST -d '{"tutorial_id":"1","title":"test", "image": "file","description":"desc","path":"url or pathfile",type:"audio,video,text"}' https://apimnnzz.tk/api/media 
```

## Комментария

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/comments/showComment:id -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X POST -d '{"media_id":"1","title":"test", "body": "text","description":"desc","parent_id":"default:0"}' https://apimnnzz.tk/api/comments 
```

## ModalMessage(random)

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/modalmessage/ -H 'Authorization: Bearer [:token]'
```

## Quiz

```
    $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/get_quiz/:id -H 'Authorization: Bearer [:token]'
    $ curl -H 'content-type: application/json' -v -X POST -d '{"answer_id":"1","quiz_id":"1","question_id":"1"} https://apimnnzz.tk/api/quiz/post_result/ -H 'Authorization: Bearer [:token]'
    Чтоб переходить на другой вопрос $ curl -H 'content-type: application/json' -v -X GET https://apimnnzz.tk/api/get_quiz/:id/?question_id=:id -H 'Authorization: Bearer [:token]'
```

## Регистрация

```
    $ curl  -H 'content-type: application/json' -v -X POST -d '{"name":"ттт","email":"hh@jj.com","password":"secret"}' https://apimnnzz.tk/api/auth/register
```

## Авторизация

```
    $ curl  -H 'content-type: application/json' -v -X POST -d '{"email":"hh@jj.com","password":"secret"}' https://apimnnzz.tk/api/auth/login
```

