<div class="panel panel-default">
    <div class="panel-heading">
        Описание
        <span class="fa fa-pencil pull-right" id="edit_main_info"></span>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <tbody>

              <tr>
                <td>Название</td>
                <td><%= converter.escape('title') %></td>
              </tr>
              <tr>
                <td>Ip</td>
                <td><%= converter.get('ip') %></td>
              </tr>
              <tr>
                <td>Port</td>
                <td><%= converter.get('port') %></td>
              </tr>
              <tr>
                <td>Логин</td>
                <td><%= converter.get('login') %></td>
              </tr>
              <tr>
                <td>Пароль</td>
                <td><%= converter.get('password') %></td>
              </tr>
              <tr>
                <td>Время ожидания соединение</td>
                <td><%= converter.get('timeout_connect') %></td>
              </tr>
              <tr>
                <td>Время ожидания ответа</td>
                <td><%= converter.get('timeout_receive') %></td>
              </tr>


            </tbody> 


        </table>
</div>
</div>