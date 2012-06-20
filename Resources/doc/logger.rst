Coregen Logger Service
=====================

Service para gravar log em banco.

Instalando
----------

Para atualizar o banco com nova tabela e relacionamentos:

::

    app/console doctrine:schema:update --force


Entity CoregenAdminBundle:Log
----------------------------

Campos: id, created_at, type, user (user_id) e message.
Possui relação ManyToOne com ``Entity CoregenAdminBundle:User``, então é possível recuperar os logs do usuário
com User::getLogs().


Utilizando
----------

Nas actions, a chamada é:

::

    $this->get('coregen.logger')->doLog($type, $message, $user);

``$type`` é um valor arbitrário, que pode-se futuramente ter uma lista fixa.

``$message`` é a informação a ser registrada, limitada a 1000 caracteres.

``$user`` é uma instância da entity ``CoregenAdminBundle:User`` ou ``NULL`` (não informado)

Deste modo, as formas de registrar são

::

    $this->get('coregen.logger')->doLog(
            'LOGOUT',
            'Usuário realizou login',
            $this->get('security.context')->getToken()->getUser()
            );

ou 

::

    $this->get('coregen.logger')->doLog(
            'WARN',
            'Espaço em disco no limite'
            );


Pesquisando
-----------

Acesse ``http::dominiocoregen.com.br/admin/log``.

A pesquisa ainda não tem paginação e um layout mais preciso, aguardando o template para 
implementar.

Filtro por data ainda não implementado.

